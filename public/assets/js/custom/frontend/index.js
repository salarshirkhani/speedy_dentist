$('.counter').countUp();
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
    });
});

$(document).ready(function () {
    "use strict";
    let service = $('#service').html();
    let siteUrl = $('meta[name="site-url"]').attr('content');
    let locale = $('meta[name="locale"]').attr('content');
    $(document).on('click', '.ser-add', function() {
        $('#services').append(service);
    });

    $(document).on('click', '.ser-rm', function() {
        $(this).parent().remove();
    });

    let review = $('#review').html();
    $(document).on('click', '.rev-add', function() {
        $('#reviews').append(review);
    });

    $(document).on('click', '.rev-rm', function() {
        $(this).parent().remove();
    });

    $('.popup-with-zoom-anim').magnificPopup({
        type: 'inline',
        fixedContentPos: false,
        fixedBgPos: true,
        overflowY: 'auto',
        closeBtnInside: true,
        preloader: false,
        midClick: true,
        removalDelay: 300,
        mainClass: 'my-mfp-zoom-in'
    });

    $('.popup-with-move-anim').magnificPopup({
        type: 'inline',
        fixedContentPos: false,
        fixedBgPos: true,
        overflowY: 'auto',
        closeBtnInside: true,
        preloader: false,
        midClick: true,
        removalDelay: 300,
        mainClass: 'my-mfp-slide-bottom'
    });

    $('.owl-two').owlCarousel({
        loop: true,
        margin: 20,
        nav: false,
        responsiveClass: true,
        autoplay: false,
        autoplayTimeout: 5000,
        autoplaySpeed: 1000,
        autoplayHoverPause: false,
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            480: {
                items: 1,
                nav: false
            },
            667: {
                items: 1,
                nav: false
            },
            1000: {
                items: 1,
                nav: false
            }
        }
    });

    $(".flatpickr").flatpickr({
        enableTime: false
    });

    $.get(siteUrl + '/api/doctor-list?lang='+locale, function(data, status){
        $('#doctor_id').html(data);
    });

    $(document).on('change', '#doctor_id, #appointment_date', function() {
        let userId = $('#doctor_id').val();
        let appointmentDate = $('#appointment_date').val();
        let url = siteUrl + '/api/doctor-schedules?lang='+locale;
        if (userId && appointmentDate)
            $.get(url, {userId, appointmentDate},function(data, status){
                $('#appointment_slot').html(data);
            });
    });

    $(document).on('submit', '#appointmentForm', function(e) {
        e.preventDefault();
        let url = siteUrl + '/api/book-schedules?lang='+locale;
        let form = $(this);
        $.ajax({
            method: 'GET',
            url: url,
            data: form.serialize(),
            success: function(data) {
                form.trigger("reset");
                $('#appointment_slot').html('<option value="">Select Appointment Slot*</option>');
                Swal.fire(
                    'Successfull!',
                    data.message,
                    'success'
                );
            },
            error: function(data) {
                Swal.fire(
                    'Error!',
                    data.message ? data.message : 'Please fill the form correctly!',
                    'error'
                );
            }
        });
    });
});
