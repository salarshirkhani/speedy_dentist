$(document).ready(function() {
    "use strict";
    var quill = new Quill('#description', {
        theme: 'snow',
    });

    quill.root.innerHTML = $('#dText').val();
    quill.root.blur();
    $(document).on('submit', '#insuranceForm', function(e){
        $('#dText').val(quill.container.firstChild.innerHTML);
    });


    let disease = $('#disease').html();
    $(document).on('click', '.m-add', function () {
        $('#disease').append(disease);
    });

    $(document).on('click', '.m-remove', function () {
        $(this).parent().parent().remove();
    });
});
