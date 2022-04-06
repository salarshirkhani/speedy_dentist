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
    $(".select2").select2();
    var equill = new Quill('#edit_input_address', {
        theme: 'snow'
    });
    var address = $("#address").val();
    equill.clipboard.dangerouslyPasteHTML(address);
    equill.root.blur();
    $('#edit_input_address').on('keyup', function(){
        var edit_input_address = equill.container.firstChild.innerHTML;
        $("#address").val(edit_input_address);
    });
});
