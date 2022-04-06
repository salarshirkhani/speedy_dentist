<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\EmailTemplate;
use App\Models\EmailCampaign;
use App\Models\EmailCampaignLog;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Session;

class EmailCampaignController extends Controller
{
    /**
     * Constructor
     */
    function __construct()
    {
        $this->middleware('permission:email-campaign-read|email-campaign-create|email-campaign-update|email-campaign-delete', ['only' => ['index','show']]);
        $this->middleware('permission:email-campaign-create', ['only' => ['create','store']]);
        $this->middleware('permission:email-campaign-update', ['only' => ['edit','update']]);
        $this->middleware('permission:email-campaign-delete', ['only' => ['destroy']]);
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
        $emailCampaigns = $this->filter($request)->paginate(10);
        return view('email-campaign.index', compact('emailCampaigns','company'));
    }

    /**
     * Filter function
     *
     * @param Request $request
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function filter(Request $request)
    {
        $query = EmailCampaign::where('company_id', session('company_id'))->latest();
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
        $emailTemplates = EmailTemplate::where('company_id', session('company_id'))->get();
        return view('email-campaign.create', compact('emailTemplates','roles'));
    }

    public function generateTemplateData(Request $request)
    {
        $this->validate($request,['emailTemplateId' => 'required']);
        $emailTemplate = EmailTemplate::where('id', $request->emailTemplateId)->first();
        $data['status']  = '1';
        $data['message'] = $emailTemplate->template;
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
        $data = $request->only(['campaign_name','contact_type','email_template_id','message','schedule_time']);
        $data['company_id'] = session('company_id');
        if($request->schedule_time == null && $request->schedule_type == "now")
        {
            $data['schedule_time'] = date("Y-m-d h:i:s");
        }
        EmailCampaign::create($data);
        return redirect()->route('email-campaigns.index')->with('success', trans('Email Campaign Create Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmailCampaign  $emailCampaign
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, EmailCampaign $emailCampaign)
    {
        $emailCampaignReports = $this->campaignReportFilter($request, $emailCampaign)->paginate(10);
        return view('email-campaign.campaign-report', compact('emailCampaignReports'));
    }

    private function campaignReportFilter(Request $request, EmailCampaign $emailCampaign)
    {
        $query = EmailCampaignLog::with('user')->where('email_campaign_id', $emailCampaign->id)->latest();
        return $query;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmailCampaign  $emailCampaign
     * @return \Illuminate\Http\Response
     */
    public function edit(EmailCampaign $emailCampaign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmailCampaign  $emailCampaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmailCampaign $emailCampaign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmailCampaign  $emailCampaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailCampaign $emailCampaign)
    {
        //
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
            'email_template_id' => ['nullable','numeric'],
            'message' => ['required'],
            'schedule_type' => ['required', 'in:now,later'],
            'schedule_time' => ['required_if:schedule_type,later']
        ]);
    }
}
