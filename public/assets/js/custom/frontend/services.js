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

$('.counter').countUp();

$(document).ready(function () {
    "use strict";
    let service = $('#service').html();
    $('#service').remove();
    $('#services').append(service);
    $(document).on('click', '.ser-add', function() {
        $('#services').append(service);
    });
    $(document).on('click', '.ser-rm', function() {
        $(this).parent().remove();
    });
});
