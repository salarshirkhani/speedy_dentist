$(document).ready( function () {
    "use strict";
    var rolefor = $('#role_for').val();
    if(rolefor == '1') {
        $('#staff_block').show();
        $('#user_block').hide();
    } else {
        $('#staff_block').hide();
        $('#user_block').show();
    }

    $('#role_for').change(function(){
        if($('#role_for').val() == '1') {
            $('#staff_block').show();
            $('#user_block').hide();
        } else {
            $('#staff_block').hide();
            $('#user_block').show();
        }
    });

    var quill = new Quill('#input_address', {
        theme: 'snow'
    });

    var address = $("#address").val();
    quill.clipboard.dangerouslyPasteHTML(address);
    quill.root.blur();
    $('#input_address').on('keyup', function(){
        var input_address = quill.container.firstChild.innerHTML;
        $("#address").val(input_address);
    });

    $(".select2").select2();
});
