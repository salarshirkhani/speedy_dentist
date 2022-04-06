<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\PatientCaseStudy;
use App\Models\Prescription;
use App\Models\User;

use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    /**
     * Constructor
     */
    function __construct()
    {
        $this->middleware('permission:prescription-read|prescription-create|prescription-update|prescription-delete', ['only' => ['index','show']]);
        $this->middleware('permission:prescription-create', ['only' => ['create','store']]);
        $this->middleware('permission:prescription-update', ['only' => ['edit','update']]);
        $this->middleware('permission:prescription-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $prescriptions = $this->filter($request)->paginate(10);
        
        if (auth()->user()->hasRole('Doctor'))
            $doctors = User::role('Doctor')->where('id', auth()->id())->where('status', '1')->get(['id', 'name']);
        else
            $doctors = User::role('Doctor')->where('status', '1')->get(['id', 'name']);

        if (auth()->user()->hasRole('Patient'))
            $patients = User::role('Patient')->where('id', auth()->id())->where('status', '1')->get(['id', 'name']);
        else
            $patients = User::role('Patient')->where('status', '1')->get(['id', 'name']);

        return view('prescriptions.index', compact('prescriptions', 'patients', 'doctors'));
    }

    /**
     * Filter function
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    private function filter(Request $request)
    {
        $query = Prescription::query();

        if (auth()->user()->hasRole('Doctor'))
            $query->where('doctor_id', auth()->id());
        elseif ($request->doctor_id)
            $query->where('doctor_id', $request->doctor_id);

        if (auth()->user()->hasRole('Patient'))
            $query->where('user_id', auth()->id());
        elseif ($request->user_id)
            $query->where('user_id', $request->user_id);

        if ($request->prescription_date)
            $query->where('prescription_date', $request->prescription_date);

        return $query;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $patients = User::role('Patient')->where('status', '1')->get(['id', 'name']);
        $patientCaseStudy = null;

        if ($request->user_id)
            $patientCaseStudy = PatientCaseStudy::where('user_id', $request->user_id)->first();

        return view('prescriptions.create', compact('patients', 'patientCaseStudy'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->hasRole('Doctor'))
            return redirect()->route('prescriptions.index')->with('error', trans('Only Doctor Can Create Prescription'));

        $this->validation($request);

        $prescriptionData = $request->only(['user_id', 'weight', 'height', 'blood_pressure', 'chief_complaint', 'note', 'prescription_date']);
        $caseStudyData = $request->only(['user_id','food_allergy','heart_disease','high_blood_pressure','diabetic','surgery','accident','others','family_medical_history','current_medication','pregnancy','breastfeeding','health_insurance']);

        $prescriptionData['doctor_id'] = auth()->id();
        $prescriptionData['medicine_info'] = $this->makeMedicineJson($request);
        $prescriptionData['diagnosis_info'] = $this->makeDiagnosisJson($request);

        Prescription::create($prescriptionData);
        PatientCaseStudy::updateOrCreate(['user_id' => $request->user_id], $caseStudyData);

        return redirect()->route('prescriptions.index')->with('success', trans('Prescription Created Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function show(Prescription $prescription)
    {
        if ((auth()->user()->hasRole('Patient') && auth()->id() != $prescription->user_id)
            || (auth()->user()->hasRole('Doctor') && auth()->id() != $prescription->doctor_id))
            return redirect()->route('dashboard');
        
        $company = Company::find($prescription->user->company_id);
        $company->setSettings();
        return view('prescriptions.show', compact('company', 'prescription'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prescription  $prescription
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Prescription $prescription)
    {
        $patients = User::role('Patient')->where('status', '1')->get(['id', 'name']);
        $patientCaseStudy = null;

        if ($request->user_id)
            $patientCaseStudy = PatientCaseStudy::where('user_id', $request->user_id)->first();

        return view('prescriptions.edit', compact('patients', 'patientCaseStudy', 'prescription'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prescription $prescription)
    {
        if (auth()->id() != $prescription->doctor_id)
            return redirect()->route('dashboard');
        
        $this->validation($request);

        $prescriptionData = $request->only(['user_id', 'weight', 'height', 'blood_group', 'chief_complaint', 'note', 'prescription_date']);
        $caseStudyData = $request->only(['user_id','food_allergy','heart_disease','high_blood_pressure','diabetic','surgery','accident','others','family_medical_history','current_medication','pregnancy','breastfeeding','health_insurance']);

        $prescriptionData['doctor_id'] = auth()->id();
        $prescriptionData['medicine_info'] = $this->makeMedicineJson($request);
        $prescriptionData['diagnosis_info'] = $this->makeDiagnosisJson($request);

        $prescription->update($prescriptionData);
        PatientCaseStudy::updateOrCreate(['user_id' => $request->user_id], $caseStudyData);

        return redirect()->route('prescriptions.index')->with('success', trans('Prescription Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prescription  $prescription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prescription $prescription)
    {
        if (auth()->user()->hasRole('Doctor') && auth()->id() != $prescription->doctor_id)
            return redirect()->route('dashboard');
        
        $prescription->delete();
        return redirect()->route('prescriptions.index')->with('success', trans('Prescription Deleted Successfully'));
    }

    /**
     * Makes data json
     *
     * @param Request $request
     * @return json
     */
    private function makeMedicineJson(Request $request)
    {
        $medicines = [];
        foreach ($request->medicine_name as $key => $value) {
            if (empty($request->medicine_name[$key]))
                continue;

            $medicines[] = [
                'medicine_name' => $request->medicine_name[$key],
                'medicine_type' => $request->medicine_type[$key],
                'instruction' => $request->instruction[$key],
                'day' => $request->day[$key]
            ];
        }

        return json_encode($medicines);
    }

    /**
     * Makes data json
     *
     * @param Request $request
     * @return json
     */
    private function makeDiagnosisJson(Request $request)
    {
        $diagnosis = [];
        foreach ($request->diagnosis as $key => $value) {
            if (empty($request->diagnosis[$key]))
                continue;

            $diagnosis[] = [
                'diagnosis' => $request->diagnosis[$key],
                'diagnosis_instruction' => $request->diagnosis_instruction[$key]
            ];
        }

        return json_encode($diagnosis);
    }

    /**
     * Validation function
     *
     * @param Request $request
     * @return void
     */
    private function validation(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'weight' => ['required', 'numeric'],
            'height' => ['required', 'numeric'],
            'blood_pressure' => ['required', 'string', 'max:255'],
            'chief_complaint' => ['required', 'string', 'max:1000'],
            'medicine_name' => ['nullable', 'array'],
            'medicine_type' => ['nullable', 'array'],
            'instruction' => ['nullable', 'array'],
            'day' => ['nullable', 'array'],
            'diagnosis' => ['nullable', 'array'],
            'diagnosis_instruction' => ['nullable', 'array'],
            'note' => ['nullable', 'string', 'max:1000'],
            'prescription_date' => ['required', 'date']
        ]);
    }
}
