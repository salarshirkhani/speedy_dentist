@component('mail::message')

Dear {{ $patientAppointment->user->name }}<br>
<br>
Your appointment with {{ $patientAppointment->doctor->name }} has been booked successfully.<br>
<br>
Your serial no: {{ $patientAppointment->sequence }}<br>
Your appointment time (approx.): {{ $patientAppointment->start_time }} - {{ $patientAppointment->end_time }}<br>
Your appointment date: {{ date('l jS F Y', strtotime($patientAppointment->appointment_date)) }}<br>
@if ($patientAppointment->problem)
Appointment reason:<br>
"{!! nl2br(str_replace(["script"], ["noscript"], $patientAppointment->problem)) !!}"
@endif

@component('mail::button', ['url' => url('/')])
Log in
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
