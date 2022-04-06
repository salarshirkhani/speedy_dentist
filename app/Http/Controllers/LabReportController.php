<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\LabReport;
use App\Models\LabReportTemplate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LabReportController extends Controller
{
    /**
     * Constructor
     */
    function __construct()
    {
        $this->middleware('permission:lab-report-read|lab-report-create|lab-report-update|lab-report-delete', ['only' => ['index','show']]);
        $this->middleware('permission:lab-report-create', ['only' => ['create','store']]);
        $this->middleware('permission:lab-report-update', ['only' => ['edit','update']]);
        $this->middleware('permission:lab-report-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $labReports = $this->filter($request)->paginate(10);
        return view('lab-report.index', compact('labReports'));
    }

    /**
     * Filter function
     *
     * @param Request $request
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function filter(Request $request)
    {
        $query = LabReport::with(['user'])
            ->whereHas('user', function($q) use ($request) {
                $q->where('company_id', session('company_id'));
                if (auth()->user()->hasRole('Patient'))
                    $q->where('id', auth()->id());
            });

        if ($request->date)
            $query->where('date', $request->date);

        if ($request->name) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', $request->name.'%');
            });
        }

        if ($request->email) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('email', 'like', $request->email.'%');
            });
        }

        if ($request->phone) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('phone', 'like', $request->phone.'%');
            });
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
        $patientInfo = User::role('Patient')->where('company_id', session('company_id'))->where('status', '1')->get();
        $doctorInfo = User::role('Doctor')->where('company_id', session('company_id'))->where('status', '1')->get();
        $labReportTemplates = LabReportTemplate::where('company_id', session('company_id'))->get();
        return view('lab-report.create',compact('labReportTemplates','patientInfo','doctorInfo'));
    }

    /**
     * Generates output using template
     *
     * @param Request $request
     * @return json
     */
    public function generateTemplateData(Request $request)
    {
        $this->validate($request,[
            'date' => 'required',
            'patientId' => 'required',
            'labReportTemplateId' => 'required'
        ]);
        $companyInfo = Company::where('id', session('company_id'))->first();
        $companyInfo->setSettings();
        $patientInfo = User::role('Patient')->where('id',$request->patientId)->first();
        $labReportTemplate = LabReportTemplate::where('id', $request->labReportTemplateId)->first();
        $message_replaced = $labReportTemplate->template;
        if ( strstr( $labReportTemplate->template, '#DOCTOR_NAME#' ) ) {
            $doctorId = $request->doctorId;
            if($doctorId == null) {
                $response['status']  = '2';
                $response['message'] = 'For This Template Please select Doctor';
                return $response;
            }
            $doctorInfo = User::role('Doctor')->where('id',$doctorId)->first();
            $message_replaced=str_replace("#DOCTOR_NAME#", $doctorInfo->name, $message_replaced);
        }
        $message_replaced=str_replace("#HOSPITAL_NAME#", $companyInfo->company_name, $message_replaced);
        $message_replaced=str_replace("#PATIENT_NAME#", $patientInfo->name, $message_replaced);
        $message_replaced=str_replace("#PATIENT_GENDER#", $patientInfo->gender, $message_replaced);
        $message_replaced=str_replace("#PATIENT_BLOOD#", $patientInfo->blood_group, $message_replaced);
        $message_replaced=str_replace("#REPORT_DATE#", $request->date, $message_replaced);
        $data['status']  = '1';
        $data['message'] = $message_replaced;
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
        $data = $request->only(['date','patient_id','doctor_id','lab_report_template_id','report']);
        $data['company_id'] = session('company_id');
        if ($request->photo) {
            $photos = [];
            foreach ($request->photo as $reportPicure) {
                $photos[] = $reportPicure->store('user-images');
            }
            $myfiles = json_encode($photos);
            $data['photo'] = $myfiles;
        }
        DB::transaction(function () use ($data) {
            LabReport::create($data);
        });
        return redirect()->route('lab-reports.index')->with('success', trans('Lab Report Create Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LabReport  $labReport
     * @return \Illuminate\Http\Response
     */
    public function show(LabReport $labReport)
    {
        if (auth()->user()->hasRole('Patient') && auth()->id() != $labReport->patient_id)
            return redirect()->route('dashboard');
        
        $company = Company::find($labReport->company_id);
        $company->setSettings();
        return view('lab-report.show', compact('company', 'labReport'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LabReport  $labReport
     * @return \Illuminate\Http\Response
     */
    public function edit(LabReport $labReport)
    {
        $patientInfo = User::role('Patient')->where('company_id', session('company_id'))->where('status', '1')->get();
        $doctorInfo = User::role('Doctor')->where('company_id', session('company_id'))->where('status', '1')->get();
        $labReportTemplates = LabReportTemplate::where('company_id', session('company_id'))->get();
        return view('lab-report.edit',compact('labReport','patientInfo','doctorInfo','labReportTemplates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LabReport  $labReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LabReport $labReport)
    {
        $data = $request->only(['report']);
        $labReport->update($data);
        return redirect()->route('lab-reports.index')->with('success', trans('Lab Report Edited Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LabReport  $labReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(LabReport $labReport)
    {
        $labReport->delete();
        return redirect()->route('lab-reports.index')->with('success', trans('Lab Report Deleted Successfully'));
    }

    /**
     * validation check for create & edit
     *
     * @param Request $request
     * @param integer $id
     * @return void
     */
    private function validation(Request $request, $id = 0)
    {
        $request->validate([
            'date' => ['required','date'],
            'patient_id' => ['required','numeric'],
            'doctor_id' => ['nullable','numeric'],
            'lab_report_template_id' => ['nullable','numeric']
        ]);

        $request->validate([
            'photo.*' => 'mimes:pdf,jpeg,png,jpg','max:4096'
        ]);
    }
}
