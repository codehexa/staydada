$(function () {
    var $window = $(window);
    var doAnimations = function doAnimations() {
        var offset = $window.scrollTop() + $window.height(),
            $animatables = $('.ani_paused'),
            point = !!($('html').hasClass('V3') || $('html').hasClass('V4')) ? 250 : $window.height() / 4;
        // console.log(offset);

        if ($animatables.length == 0) {
            $window.off('scroll', doAnimations);
        }

        $animatables.each(function (i) {
            var $animatable = $(this);
            // if (($animatable.offset().top + 250) < offset) {
            if ($animatable.offset().top + point < offset) {
                $animatable.removeClass('ani_paused').addClass('ani_start');
            }
        });
    };
    $window.on('scroll', doAnimations).trigger('scroll');
    $window.trigger("resize");
    var elements = $('.ieSticky');
    if (elements.length > 0) {
        Stickyfill.add(elements);
    }
    //fullKv();
});