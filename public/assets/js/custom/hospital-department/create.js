$(document).ready(function() {
    "use strict";
    var quill = new Quill('#description', {
        theme: 'snow',
    });

    quill.root.innerHTML = $('#dText').val();
    quill.root.blur();
    $(document).on('submit', '#departmentForm', function(e){
        $('#dText').val(quill.container.firstChild.innerHTML);
    });
});
