<?php

namespace App\Http\Controllers;

use App\Models\HospitalDepartment;

use Illuminate\Http\Request;

class HospitalDepartmentController extends Controller
{
    /**
     * Constructor
     */
    function __construct()
    {
        $this->middleware('permission:hospital-department-read|hospital-department-create|hospital-department-update|hospital-department-delete', ['only' => ['index','show']]);
        $this->middleware('permission:hospital-department-create', ['only' => ['create','store']]);
        $this->middleware('permission:hospital-department-update', ['only' => ['edit','update']]);
        $this->middleware('permission:hospital-department-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hospitalDepartments = HospitalDepartment::where('company_id', session('company_id'))->paginate(10);
        return view('hospital-department.index',compact('hospitalDepartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hospital-department.create');
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

        $data = $request->only(['name', 'description', 'status']);
        $data['company_id'] = session('company_id');
        HospitalDepartment::create($data);

        return redirect()->route('hospital-departments.index')->with('success', trans('Department Created Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HospitalDepartment  $hospitalDepartment
     * @return \Illuminate\Http\Response
     */
    public function show(HospitalDepartment $hospitalDepartment)
    {
        return view('hospital-department.show',compact('hospitalDepartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HospitalDepartment  $hospitalDepartment
     * @return \Illuminate\Http\Response
     */
    public function edit(HospitalDepartment $hospitalDepartment)
    {
        return view('hospital-department.edit',compact('hospitalDepartment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HospitalDepartment  $hospitalDepartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HospitalDepartment $hospitalDepartment)
    {
        $this->validation($request, $hospitalDepartment->id);

        $data = $request->only(['name', 'description', 'status']);
        $hospitalDepartment->update($data);

        return redirect()->route('hospital-departments.index')->with('success', trans('Department Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HospitalDepartment  $hospitalDepartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(HospitalDepartment $hospitalDepartment)
    {
        if ($hospitalDepartment->doctorDetails()->exists())
            return redirect()->route('hospital-departments.index')->with('error', trans('Department cannot be deleted'));

        $hospitalDepartment->delete();
        return redirect()->route('hospital-departments.index')->with('success', trans('Department Deleted Successfully'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private function validation(Request $request, $id = 0)
    {
        $request->validate([
            'name' => ['required', 'unique:hospital_departments,name,'.$id, 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'status' => ['required', 'in:0,1']
        ]);
    }
}
