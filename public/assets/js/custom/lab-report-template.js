$(document).ready(function() {
    "use strict";
    $(document.body).on('click','#textarea_patient_name',function() {
         var $txt = $("#template");
         var caretPos = $txt[0].selectionStart;
        var textAreaTxt = $txt.val();
        var txtToAdd = " #PATIENT_NAME# ";
        $txt.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos));
    });
    $(document.body).on('click','#textarea_patient_gender',function() {
         var $txt = $("#template");
         var caretPos = $txt[0].selectionStart;
        var textAreaTxt = $txt.val();
        var txtToAdd = " #PATIENT_GENDER# ";
        $txt.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos));
    });
    $(document.body).on('click','#textarea_patient_blood',function() {
         var $txt = $("#template");
         var caretPos = $txt[0].selectionStart;
        var textAreaTxt = $txt.val();
        var txtToAdd = " #PATIENT_BLOOD# ";
        $txt.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos));
    });
    $(document.body).on('click','#textarea_doctor_name',function() {
         var $txt = $("#template");
         var caretPos = $txt[0].selectionStart;
        var textAreaTxt = $txt.val();
        var txtToAdd = " #DOCTOR_NAME# ";
        $txt.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos));
    });
    $(document.body).on('click','#textarea_report_date',function() {
         var $txt = $("#template");
         var caretPos = $txt[0].selectionStart;
        var textAreaTxt = $txt.val();
        var txtToAdd = " #REPORT_DATE# ";
        $txt.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos));
    });
    $(document.body).on('click','#textarea_hospital_name',function() {
         var $txt = $("#template");
         var caretPos = $txt[0].selectionStart;
        var textAreaTxt = $txt.val();
        var txtToAdd = " #HOSPITAL_NAME# ";
        $txt.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos));
    });
});
