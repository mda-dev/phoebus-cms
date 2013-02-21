
// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());



$("#social-links a").tooltip({
    placement: "bottom",
});








$("#ajax-close").click(function(){
    $(this).tooltip("hide");
        portfolioSingle.slideUp();   
    return false;
}).tooltip({placement: "right", title: "Close panel."})
/*=============================================*/

$(document).ready(function(){
        $(window).resize(function(){

            $("#ww").html($(window).width());
        });

    });

/*=====
        To Top 
===============================================*/



