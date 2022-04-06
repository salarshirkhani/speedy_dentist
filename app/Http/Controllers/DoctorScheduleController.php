<?php

namespace App\Http\Controllers;

use App\Models\DoctorSchedule;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorScheduleController extends Controller
{
    /**
     * Constructor
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:doctor-schedule-read|doctor-schedule-create|doctor-schedule-update|doctor-schedule-delete', ['only' => ['index','show']]);
        $this->middleware('permission:doctor-schedule-create', ['only' => ['create','store']]);
        $this->middleware('permission:doctor-schedule-update', ['only' => ['edit','update']]);
        $this->middleware('permission:doctor-schedule-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctorSchedules = DoctorSchedule::with(['user'])->paginate(10);
        return view('doctor-schedule.index', compact('doctorSchedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = User::role('Doctor')->where('status', '1')->get(['id', 'name']);
        return view('doctor-schedule.create', compact('doctors'));
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
        $data = $request->only(['user_id', 'weekday', 'start_time', 'end_time', 'avg_appointment_duration', 'serial_type', 'status']);
        DoctorSchedule::create($data);
        return redirect()->route('doctor-schedules.index')->with('success', trans('Doctor Schedule Added Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DoctorSchedule  $doctorSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(DoctorSchedule $doctorSchedule)
    {
        return view('doctor-schedule.show', compact('doctorSchedule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DoctorSchedule  $doctorSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(DoctorSchedule $doctorSchedule)
    {
        $doctors = User::role('Doctor')->where('status', '1')->get(['id', 'name']);
        return view('doctor-schedule.edit', compact('doctors', 'doctorSchedule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DoctorSchedule  $doctorSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DoctorSchedule $doctorSchedule)
    {
        $this->validation($request, $doctorSchedule->id);
        $data = $request->only(['user_id', 'weekday', 'start_time', 'end_time', 'avg_appointment_duration', 'serial_type', 'status']);
        $doctorSchedule->update($data);

        return redirect()->route('doctor-schedules.index')->with('success', trans('Doctor Schedule Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DoctorSchedule  $doctorSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(DoctorSchedule $doctorSchedule)
    {
        $doctorSchedule->delete();
        return redirect()->route('doctor-schedules.index')->with('success', trans('Doctor Schedule Deleted Successfully'));
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
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'weekday' => ['required', 'in:Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'avg_appointment_duration' => ['required', 'integer'],
            'serial_type' => ['required', 'in:Sequential,Timestamp'],
            'status' => ['required', 'in:0,1']
        ]);
        $this->scheduleOverlapCheck($request, $id);
    }

    /**
     * Schedul ovlap validation check
     *
     * @param Request $request
     * @param integer $id
     * @return void
     */
    private function scheduleOverlapCheck(Request $request, $id = 0)
    {
        $overlap = DoctorSchedule::where('user_id', $request->user_id)
            ->where('weekday', $request->weekday)
            ->where('start_time', '<=', $request->end_time)
            ->where('end_time', '>=', $request->start_time);

        if ($id)
            $overlap->where('id', '<>', $id);

        if ($overlap->count()) // overlap count > 0
            $this->validate(
                $request,
                [
                    'start_time' => 'image', // using image to make invalid
                    'end_time' => 'image'
                ],
                [
                    'start_time.image' => 'Schedule overlaped',
                    'end_time.image' => 'Schedule overlaped'
                ]
            );
    }
}
