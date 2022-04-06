$(document).ready(function() {
    "use strict";
    var quill = new Quill('#input_report', {
        theme: 'snow'
    });

    $('.generate_report_template').on('change', function(){
        let siteUrl = $('meta[name="site-url"]').attr('content');
        let patientId = $("#patient_id").val();
        let labReportTemplateId = $("#lab_report_template_id").val();
        let doctorId = $("#doctor_id").val();
        let date = $("#date").val();
        if(labReportTemplateId) {
            if(patientId=="") {
                Swal.fire(
                    'Warning!',
                    $('meta[name="warning-patient-first"]').attr('content'),
                    'warning'
                );
                $('#lab_report_template_id').val("").change();
                return;
            }
            if(date=="") {
                Swal.fire(
                    'Warning!',
                    $('meta[name="warning-report-date"]').attr('content'),
                    'warning'
                );
                return;
            }
            if(labReportTemplateId=="") {
                Swal.fire(
                    'Warning!',
                    $('meta[name="warning-template-first"]').attr('content'),
                    'warning'
                );
                return;
            }
            $.post(siteUrl + '/labreport/generateTemplateData',
                {date,patientId,labReportTemplateId,doctorId},
                    function(data,status) {
                    if(data.status == '2') {
                        Swal.fire(
                            'Oops...',
                            data.message,
                            'error'
                        );
                        $('#lab_report_template_id').val("").change();
                        quill.clipboard.dangerouslyPasteHTML("");
                        $('#input_report').on('keyup', function(){
                            $("#report").val("");
                        });
                    }
                    if(data.status == '1') {
                        let report = data.message;
                        quill.root.innerHTML = report;
                        quill.root.blur();
                        $(document).on('submit', '#labReportFrom', function(e){
                            $('#report').val(quill.container.firstChild.innerHTML);
                        });
                    }
            });
        } else {
            quill.root.innerHTML = $('#report').val();
            quill.root.blur();
            $(document).on('submit', '#labReportFrom', function(e){
                $('#report').val(quill.container.firstChild.innerHTML);
            });
        }
    });
});
