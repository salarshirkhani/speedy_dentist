$('#code').change(function() {
    "use strict";
    let siteUrl = $('meta[name="site-url"]').attr('content');
    $.ajax({
        url: siteUrl + '/c/c',
        type: 'GET',
        dataType: 'JSON',
        data: 'code=' + $(this).val(),
        success: function(data) {
            $('#rate').val(data.rate);
            $('#precision').val(data.precision);
            $('#symbol').val(data.symbol);
            $('#symbol_first').val(data.symbol_first);
            $('#decimal_mark').val(data.decimal_mark);
            $('#thousands_separator').val(data.thousands_separator);
            $('#symbol_first').trigger('change');
        }
    });
});
