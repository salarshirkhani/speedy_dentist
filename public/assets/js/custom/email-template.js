$(document).ready(function() {
    "use strict";
    $(document.body).on('click','#textarea_name',function(){
         var $txt = $("#template");
         var caretPos = $txt[0].selectionStart;
        var textAreaTxt = $txt.val();
        var txtToAdd = " #NAME# ";
        $txt.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos));
    });
    $(document.body).on('click','#textarea_phone',function(){
         var $txt = $("#template");
         var caretPos = $txt[0].selectionStart;
        var textAreaTxt = $txt.val();
        var txtToAdd = " #PHONE# ";
        $txt.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos));
    });
    $(document.body).on('click','#textarea_email_address',function(){
         var $txt = $("#template");
         var caretPos = $txt[0].selectionStart;
        var textAreaTxt = $txt.val();
        var txtToAdd = " #Email_ADDRESS# ";
        $txt.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos));
    });
});
