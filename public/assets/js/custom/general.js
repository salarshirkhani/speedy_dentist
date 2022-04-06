$(document).ready(function() {
    "use strict";
    var equill = new Quill('#edit_input_address', {
        theme: 'snow'
    });
    var company_address = $("#company_address").val();
    equill.clipboard.dangerouslyPasteHTML(company_address);
    equill.root.blur();
    $('#edit_input_address').on('keyup', function(){
        var edit_input_address = equill.container.firstChild.innerHTML;
        $("#company_address").val(edit_input_address);
    });

    if($('#sku_type').val() == '1') {
        $('#sku_random').show(500);
        $('#sku_define').hide(500);
    } else {
        $('#sku_random').hide(500);
        $('#sku_define').show(500);
    }
    $('#sku_type').change(function() {
        if($('#sku_type').val() == '1') {
            $('#sku_random').show(500);
            $('#sku_define').hide(500);
        } else {
            $('#sku_random').hide(500);
            $('#sku_define').show(500);
        }
    });

    $("#financial_start").flatpickr({
        enableTime: false,
        dateFormat: "d-m"
    });
});
