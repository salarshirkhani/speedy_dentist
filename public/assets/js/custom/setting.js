$(document).ready(function() {
    "use strict";
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
