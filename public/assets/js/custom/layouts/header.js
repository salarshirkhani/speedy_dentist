$(document).ready(function() {
    "use strict";
    $(document).on('click', '#header-logout', function () {
        event.preventDefault();
        $('#logout-form').submit();
    });
});
