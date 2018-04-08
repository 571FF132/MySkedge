(function($) {
$(function() {
    $('.jcarousel')
        .jcarousel({
            // Core configuration goes here
            wrap: 'circular'   
        })
        .jcarouselAutoscroll({
            interval: 3000,
            target: '+=1',
            autostart: true
        })
    ;
});
})(jQuery);

