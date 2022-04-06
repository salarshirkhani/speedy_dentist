<?php

namespace App\Http\Controllers;

use App\Models\Insurance;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InsuranceController extends Controller
{
    /**
     * Constructor
     */
    function __construct()
    {
        $this->middleware('permission:insurance-read|insurance-create|insurance-update|insurance-delete', ['only' => ['index','show']]);
        $this->middleware('permission:insurance-create', ['only' => ['create','store']]);
        $this->middleware('permission:insurance-update', ['only' => ['edit','update']]);
        $this->middleware('permission:insurance-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $insurances = $this->filter($request)->paginate(10);
        return view('insurance.index', compact('insurances'));
    }

    /**
     * Filter function
     *
     * @param Request $request
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function filter(Request $request)
    {
        $query = Insurance::where('company_id', session('company_id'))->latest();
        return $query;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('insurance.create');
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
        $data = $request->only(['name','service_tax','discount','insurance_no','insurance_code','hospital_rate','insurance_rate','total','status','description']);
        $data['company_id'] = session('company_id');
        $diseaseChargeJson = $this->makeDiseaseChargeJson($request);
        $data['disease_charge'] = $diseaseChargeJson;
        Insurance::create($data);

        return redirect()->route('insurances.index')->with('success', trans('Insurances Added Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Insurance  $insurance
     * @return \Illuminate\Http\Response
     */
    public function show(Insurance $insurance)
    {
        return view('insurance.show',compact('insurance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Insurance  $insurance
     * @return \Illuminate\Http\Response
     */
    public function edit(Insurance $insurance)
    {
        return view('insurance.edit',compact('insurance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Insurance  $insurance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Insurance $insurance)
    {
        $this->validation($request, $insurance->id);
        $data = $request->only(['name', 'service_tax', 'discount', 'insurance_no', 'insurance_code','hospital_rate','insurance_rate','total', 'status','description']);
        $diseaseChargeJson = $this->makeDiseaseChargeJson($request);
        $data['disease_charge'] = $diseaseChargeJson;
        $insurance->update($data);
        return redirect()->route('insurances.index')->with('success', trans('Insurance Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Insurance  $insurance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Insurance $insurance)
    {
        $insurance->delete();
        return redirect()->route('insurances.index')->with('success', trans('Insurance Deleted Successfully'));
    }

    /**
     * Makes data json
     *
     * @param Request $request
     * @return json
     */
    private function makeDiseaseChargeJson(Request $request)
    {
        $diseaseCharge = [];
        foreach ($request->disease_name as $key => $value) {
            if (empty($request->disease_name[$key])) {
                continue;
            }
            $diseaseCharge[] = [
                'disease_name' => $request->disease_name[$key],
                'disease_type' => $request->disease_type[$key]
            ];
        }
        return json_encode($diseaseCharge);
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
            'service_tax' => ['nullable','numeric'],
            'discount' => ['nullable','numeric'],
            'hospital_rate' => ['nullable','numeric'],
            'insurance_no' => ['nullable','string','max:255'],
            'insurance_code' => ['nullable','string','max:255'],
            'disease_name' => ['nullable', 'array'],
            'disease_type' => ['nullable', 'array'],
            'insurance_rate' => ['nullable','numeric'],
            'total' => ['nullable','numeric'],
        ]);

        if (empty($id)) {
            $request->validate([
                'name' => ['required','unique:insurances'],
            ]);
        } else {
            $request->validate([
                'name' => ['required', Rule::unique('insurances')->ignore($id)]
            ]);
        }
    }
}
