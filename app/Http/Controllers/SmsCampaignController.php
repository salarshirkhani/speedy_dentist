<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\SmsCampaign;
use App\Models\SmsCampaignLog;
use App\Models\SmsTemplate;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Session;

class SmsCampaignController extends Controller
{
    /**
     * Constructor
     */
    function __construct()
    {
        $this->middleware('permission:sms-campaign-read|sms-campaign-create|sms-campaign-update|sms-campaign-delete', ['only' => ['index','show']]);
        $this->middleware('permission:sms-campaign-create', ['only' => ['create','store']]);
        $this->middleware('permission:sms-campaign-update', ['only' => ['edit','update']]);
        $this->middleware('permission:sms-campaign-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $company = Company::findOrFail(Session::get('company_id'));
        $company->setSettings();
        $smsCampaigns = $this->filter($request)->paginate(10);
        return view('sms-campaign.index', compact('smsCampaigns','company'));
    }

    /**
     * Filter function
     *
     * @param Request $request
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function filter(Request $request)
    {
        $query = SmsCampaign::where('company_id', session('company_id'))->latest();
        if ($request->campaign_name) {
            $query->where('campaign_name', 'like', $request->campaign_name.'%');
        }
        return $query;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all()->pluck('name','id');
        $smsTemplates = SmsTemplate::where('company_id', session('company_id'))->get();
        return view('sms-campaign.create', compact('smsTemplates','roles'));
    }

    public function generateTemplateData(Request $request)
    {
        $this->validate($request,[
            'smsTemplateId' => 'required'
        ]);
        $smsTemplate = SmsTemplate::where('id', $request->smsTemplateId)->first();
        $data['status']  = '1';
        $data['message'] = $smsTemplate->template;
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request);
        $data = $request->only(['campaign_name','contact_type','sms_template_id','message','schedule_time']);
        $data['company_id'] = session('company_id');
        if($request->schedule_time == null && $request->schedule_type == "now")
        {
            $data['schedule_time'] = date("Y-m-d h:i:s");
        }
        SmsCampaign::create($data);
        return redirect()->route('sms-campaigns.index')->with('success', trans('Sms Campaign Create Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SmsCampaign  $smsCampaign
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, SmsCampaign $smsCampaign)
    {
        $smsCampaignReports = $this->campaignReportFilter($request, $smsCampaign)->paginate(10);
        return view('sms-campaign.campaign-report', compact('smsCampaignReports'));
    }

    private function campaignReportFilter(Request $request, SmsCampaign $smsCampaign)
    {
        $query = SmsCampaignLog::with('user')->where('sms_campaign_id', $smsCampaign->id)->latest();
        return $query;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SmsCampaign  $smsCampaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(SmsCampaign $smsCampaign)
    {
        $smsCampaign->delete();
        return redirect()->route('sms-campaigns.index')->with('success', trans('SMS Campaigns Deleted Successfully'));
    }

    /**
     * validation check for create & edit
     *
     * @param Request $request
     * @param integer $id
     * @return void
     */
    private function validation(Request $request)
    {
        $request->validate([
            'campaign_name' => ['required'],
            'contact_type' => ['required','string'],
            'sms_template_id' => ['nullable','numeric'],
            'message' => ['required'],
            'schedule_type' => ['required', 'in:now,later'],
            'schedule_time' => ['required_if:schedule_type,later']
        ]);
    }
}
