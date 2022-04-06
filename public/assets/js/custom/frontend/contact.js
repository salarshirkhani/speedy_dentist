window.onscroll = function () {
    "use strict";
    scrollFunction()
};

function scrollFunction() {
    "use strict";
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("movetop").style.display = "block";
    } else {
        document.getElementById("movetop").style.display = "none";
    }
}

$(document).on('click', '#movetop', function() {
    "use strict";
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
});

$(function () {
    "use strict";
    $(document).on('click', '.navbar-toggler', function () {
        $('body').toggleClass('noscroll');
    })
});

$(document).ready(function () {
    "use strict";
    let sweetSuccess = $('meta[name="success-title"]').attr('content');
    let sweetMessage = $('meta[name="success-message"]').attr('content');
    if(sweetSuccess && sweetSuccess.length)
        Swal.fire(
            sweetSuccess,
            sweetMessage,
            'success'
        );
});
