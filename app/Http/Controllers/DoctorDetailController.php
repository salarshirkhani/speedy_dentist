<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Models\User;
use App\Models\DoctorDetail;
use App\Models\HospitalDepartment;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Facades\Excel;

class DoctorDetailController extends Controller
{
    /**
     * Constructor
     */
    function __construct()
    {
        $this->middleware('permission:doctor-detail-read|doctor-detail-create|doctor-detail-update|doctor-detail-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:doctor-detail-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:doctor-detail-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:doctor-detail-delete', ['only' => ['destroy']]);
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

        $doctorDetails = $this->filter($request)->paginate(10);
        return view('doctor-detail.index', compact('doctorDetails'));
    }

    /**
     * Performs exporting
     *
     * @param Request $request
     * @return void
     */
    private function doExport(Request $request)
    {
        return Excel::download(new UserExport($request, 'Doctor'), 'Doctors.xlsx');
    }

    /**
     * Filter function
     *
     * @param Request $request
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function filter(Request $request)
    {
        $query = DoctorDetail::with(['hospitalDepartment', 'user'])
            ->whereHas('user', function ($q) use ($request) {
                $q->where('company_id', session('company_id'));

                if ($request->name)
                    $q->where('name', 'like', $request->name . '%');

                if ($request->email)
                    $q->where('email', 'like', $request->email . '%');

                if ($request->phone)
                    $q->where('phone', 'like', $request->phone . '%');
            });

        return $query;
    }

    /**
     * Get active doctor list
     *
     * @return \Illuminate\Http\Response
     */
    public function getDoctorList(Request $request)
    {
        if ($request->lang)
            app()->setLocale($request->lang);

        $doctors = User::role('Doctor')->where('status', '1')->get();
        $output = '<option value="">' . __('Select Doctor') . '*</option>';
        foreach ($doctors as $doctor) {
            $output .= '<option value="' . $doctor->id . '">' . $doctor->name . '</option>';
        }
        return response()->json($output, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hospitalDepartments = HospitalDepartment::where('status', '1')->get();
        return view('doctor-detail.create', compact('hospitalDepartments'));
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

        $userData = $request->only(['name', 'email', 'phone', 'address', 'gender', 'blood_group', 'status']);
        $userData['company_id'] = session('company_id');
        $userData['password'] = bcrypt($request->password);

        if ($request->photo)
            $userData['photo'] = 'storage/' . $request->photo->store('user-images');

        if ($request->date_of_birth)
            $userData['date_of_birth'] = Carbon::parse($request->date_of_birth);

        $doctorData = $request->only(['specialist', 'designation', 'biography']);
        $doctorData['hospital_department_id'] = $request->hospital_department_id;

        DB::transaction(function () use ($userData, $doctorData) {
            $user = User::create($userData);
            $role = Role::where('name', 'Doctor')->first();
            $user->assignRole([$role->id]);
            $user->companies()->attach(session('company_id'));
            $doctorData['user_id'] = $user->id;
            DoctorDetail::create($doctorData);
        });

        return redirect()->route('doctor-details.index')->with('success', trans('Doctor Added Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DoctorDetail  $doctorDetail
     * @return \Illuminate\Http\Response
     */
    public function show(DoctorDetail $doctorDetail)
    {
        return view('doctor-detail.show', compact('doctorDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DoctorDetail  $doctorDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(DoctorDetail $doctorDetail)
    {
        $hospitalDepartments = HospitalDepartment::where('status', '1')->get();
        return view('doctor-detail.edit', compact('doctorDetail', 'hospitalDepartments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DoctorDetail  $doctorDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DoctorDetail $doctorDetail)
    {
        $this->validation($request, $doctorDetail->user_id);

        $userData = $request->only(['name', 'email', 'phone', 'address', 'gender', 'blood_group', 'status']);

        if ($request->password)
            $userData['password'] = bcrypt($request->password);

        if ($request->photo)
            $userData['photo'] = 'storage/' . $request->photo->store('user-images');

        if ($request->date_of_birth)
            $userData['date_of_birth'] = Carbon::parse($request->date_of_birth);

        $doctorData = $request->only(['specialist', 'designation', 'biography']);
        $doctorData['hospital_department_id'] = $request->hospital_department_id;

        DB::transaction(function () use ($userData, $doctorData, $doctorDetail) {
            $doctorDetail->user->update($userData);
            $doctorDetail->update($doctorData);
        });

        return redirect()->route('doctor-details.index')->with('success', trans('Doctor Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DoctorDetail  $doctorDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(DoctorDetail $doctorDetail)
    {
        $doctorDetail->user->delete();
        return redirect()->route('doctor-details.index')->with('success', trans('Doctor Deleted Successfully'));
    }

    /**
     * Validation function
     *
     * @param Request $request
     * @return void
     */
    private function validation(Request $request, $id = 0)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $id, 'max:255'],
            'phone' => ['nullable', 'string', 'max:14'],
            'specialist' => ['nullable', 'string', 'max:255'],
            'designation' => ['nullable', 'string', 'max:255'],
            'gender' => ['nullable', 'in:male,female'],
            'blood_group' => ['nullable', 'in:A+,A-,B+,B-,O+,O-,AB+,AB-'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'address' => ['nullable', 'string', 'max:1000'],
            'date_of_birth' => ['nullable', 'date'],
            'biography' => ['nullable', 'string', 'max:1000'],
            'hospital_department_id' => ['required', 'exists:hospital_departments,id'],
            'status' => ['required', 'in:0,1']
        ]);

        if (empty($id))
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'max:255']
            ]);
        else
            $request->validate([
                'password' => ['nullable', 'string', 'min:8', 'max:255']
            ]);
    }
}
