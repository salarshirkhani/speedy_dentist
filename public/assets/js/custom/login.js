$(document).ready(function() {
    "use strict";
    $(document).on('click', '#credTable tr', function () {
        $('#email').val($(this).find("td").eq(0).html());
        $('#password').val($(this).find("td").eq(1).html());
    });
});
