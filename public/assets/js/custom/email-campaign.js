$(document).ready(function() {
    "use strict";
    $(".schedule_block_item").hide();
    $(document.body).on('change','input[name=schedule_type]',function(){
        if($("input[name=schedule_type]:checked").val()=="later") {
            $(".schedule_block_item").show();
        } else {
            $("#schedule_time").val("");
            $(".schedule_block_item").hide();
        }
    });

    $(document.body).on('click','#submit_campaign',function(){
        let schedule_type = $("input[name=schedule_type]:checked").val();
        let schedule_time = $("#schedule_time").val();
        if(schedule_type=='later' && (schedule_time==""))
        {
            alert("Please select schedule time");
            return;
        }
    });

    $('#email_template_id').on('change', function(){
        let siteUrl = $('meta[name="site-url"]').attr('content');
        let emailTemplateId = $("#email_template_id").val();
        if(emailTemplateId=="") {
            $('#message').val('');
            return;
        }
        $.post(siteUrl + '/emailCampaign/generateTemplateData',{emailTemplateId},function(data,status) {
            if(data.status == '1') {
                let report = data.message;
                $('#message').val(report);
            } else {
                Swal.fire(
                    'Oops...',
                    data.message,
                    'error'
                );
                $('#message').val('');
            }
        });
    });

    $(document.body).on('click','#textarea_name',function(){
        let $txt = $("#message");
        let caretPos = $txt[0].selectionStart;
        let textAreaTxt = $txt.val();
        let txtToAdd = " #NAME# ";
        $txt.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos));
    });

    $(document.body).on('click','#textarea_phone',function() {
        let $txt = $("#message");
        let caretPos = $txt[0].selectionStart;
        let textAreaTxt = $txt.val();
        let txtToAdd = " #PHONE# ";
        $txt.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos));
    });

    $(document.body).on('click','#textarea_email_address',function() {
        let $txt = $("#message");
        let caretPos = $txt[0].selectionStart;
        let textAreaTxt = $txt.val();
        let txtToAdd = " #Email_ADDRESS# ";
        $txt.val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos));
    });
});
