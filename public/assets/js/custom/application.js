$(document).ready(function() {
    "use strict";
    var quill = new Quill('#company_address', {
        theme: 'snow',
    });
    var address = $("#address").val();
    quill.clipboard.dangerouslyPasteHTML(address);
    quill.root.blur();
    $('#company_address').on('keyup', function(){
        var company_address = quill.container.firstChild.innerHTML;
        $("#address").val(company_address);
    });
});
