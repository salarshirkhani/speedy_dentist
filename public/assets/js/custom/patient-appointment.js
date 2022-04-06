$(document).ready(function() {
    "use strict";
    $(document).on('change', '#doctor_id, #appointment_date', function() {
        let userId = $('#doctor_id').val();
        let appointmentDate = $('#appointment_date').val();
        let siteUrl = $('meta[name="site-url"]').attr('content');
        let url = siteUrl + '/patient-appointments/get-schedule/doctorwise';
        if (userId && appointmentDate)
            $.get(url, {userId, appointmentDate},function(data, status){
                $('#appointment_slot').html(data);
            });
    });
});
