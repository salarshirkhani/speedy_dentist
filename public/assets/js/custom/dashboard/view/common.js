$(function () {
    "use strict";
    function ini_events(ele) {
        ele.each(function () {
            var eventObject = {
                title: $.trim($(this).text())
            }
            $(this).data('eventObject', eventObject)
            $(this).draggable({
                zIndex        : 1070,
                revert        : true,
                revertDuration: 0
            })
        })
    }
    ini_events($('#external-events div.external-event'))
    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendar.Draggable;
    var calendarEl = document.getElementById('calendar');
    var calendar = new Calendar(calendarEl, {
        headerToolbar: {
            left  : 'prev,next today',
            center: 'title',
            right : 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        themeSystem: 'bootstrap',
        events: [],
        editable  : true,
        droppable : true,
    });
    calendar.render();
    var currColor = '#3c8dbc'
    $(document).on('click', '#color-chooser > li > a', function (e) {
        e.preventDefault();
        currColor = $(this).css('color')
        $('#add-new-event').css({
        'background-color': currColor,
        'border-color'    : currColor
        })
    })
    $(document).on('click', '#add-new-event', function (e) {
        e.preventDefault();
        var val = $('#new-event').val()
        if (val.length == 0) {
            return
        }
        var event = $('<div />')
        event.css({
            'background-color': currColor,
            'border-color'    : currColor,
            'color'           : '#fff'
        }).addClass('external-event')
        event.text(val)
        $('#external-events').prepend(event)
        ini_events(event)
    $('#new-event').val('')
  })
});
