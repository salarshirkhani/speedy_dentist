$(document).ready(function() {
    "use strict";
    $('[data-magnify]').magnify({
        headerToolbar: ['close'],
        footerToolbar: ['zoomIn','zoomOut','prev','fullscreen','next','actualSize','rotateRight'],
        title: false
    });
});
