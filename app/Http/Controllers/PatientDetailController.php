<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PatientDetailController extends Controller
{
    /**
     * Constructor
     */
    function __construct()
    {
        $this->middleware('permission:patient-detail-read|patient-detail-create|patient-detail-update|patient-detail-delete', ['only' => ['index','show']]);
        $this->middleware('permission:patient-detail-create', ['only' => ['create','store']]);
        $this->middleware('permission:patient-detail-update', ['only' => ['edit','update']]);
        $this->middleware('permission:patient-detail-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->export)
            return $this->doExport($request);

        $patientDetails = $this->filter($request)->paginate(10);
        return view('patient-detail.index', compact('patientDetails'));
    }

    /**
     * Performs exporting
     *
     * @param Request $request
     * @return void
     */
    private function doExport(Request $request)
    {
        return Excel::download(new UserExport($request, 'Patient'), 'Patients.xlsx');
    }

    /**
     * Filter function
     *
     * @param Request $request
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function filter(Request $request)
    {
        if (auth()->user()->hasRole('Patient'))
            $query = User::role('Patient')->where('company_id', session('company_id'))->where('id', auth()->id())->latest();
        else
            $query = User::role('Patient')->where('company_id', session('company_id'))->latest();

        if ($request->name)
            $query->where('name', 'like', $request->name.'%');

        if ($request->phone)
            $query->where('phone', 'like', $request->phone.'%');

        if ($request->email)
            $query->where('email', 'like', $request->email.'%');

        return $query;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patient-detail.create');
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
        $userData = $request->only(['name','email','phone','address','gender','blood_group','status']);
        $userData['company_id'] = session('company_id');
        $userData['password'] = bcrypt($request->password);
        if ($request->photo) {
            $userData['photo'] = 'storage/'.$request->photo->store('user-images');
        }
        if ($request->date_of_birth) {
            $userData['date_of_birth'] = Carbon::parse($request->date_of_birth);
        }

        DB::transaction(function () use ($userData) {
            $user = User::create($userData);
            $role = Role::where('name', 'Patient')->first();
            $user->assignRole([$role->id]);
            $user->companies()->attach(session('company_id'));
        });
        return redirect()->route('patient-details.index')->with('success', trans('Patient Added Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $patientDetail
     * @return \Illuminate\Http\Response
     */
    public function show(User $patientDetail)
    {
        if (auth()->user()->hasRole('Patient') && auth()->id() != $patientDetail->id)
            return redirect()->route('dashboard');

        return view('patient-detail.show', compact('patientDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $patientDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(User $patientDetail)
    {
        return view('patient-detail.edit',compact('patientDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $patientDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $patientDetail)
    {
        $this->validation($request, $patientDetail->id);

        $userData = $request->only(['name','email','phone','address','gender','blood_group','status',]);
        if ($request->password)
            $userData['password'] = bcrypt($request->password);

        if ($request->photo)
            $userData['photo'] = 'storage/'.$request->photo->store('user-images');

        if ($request->date_of_birth)
            $userData['date_of_birth'] = Carbon::parse($request->date_of_birth);

        DB::transaction(function () use ($patientDetail, $userData) {
            $patientDetail->update($userData);
        });

        return redirect()->route('patient-details.index')->with('success', trans('Patient Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $patientDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $patientDetail)
    {
        $patientDetail->delete();
        return redirect()->route('patient-details.index')->with('success', trans('Patient Deleted Successfully'));
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,'.$id, 'max:255'],
            'phone' => ['nullable', 'string', 'max:14'],
            'gender' => ['nullable', 'in:male,female'],
            'blood_group' => ['nullable', 'in:A+,A-,B+,B-,O+,O-,AB+,AB-'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'address' => ['nullable', 'string', 'max:1000'],
            'date_of_birth' => ['nullable', 'date'],
            'status' => ['required', 'in:0,1']
        ]);

        if (empty($id)) {
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'max:255']
            ]);
        } else {
            $request->validate([
                'password' => ['nullable', 'string', 'min:8', 'max:255']
            ]);
        }
    }
}
