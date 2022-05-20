(function ($) {
    'use strict';

    var $window = $(window);

    /**
    * Document ready (jQuery)
    */
    $(function () {

        $('.wpz_pattern_16 .wp-block-query li .wp-block-group__inner-container').each(function(){
           $(this).children().not(':last').wrapAll("<div class='wpz-posts-inner-info'></div>");

        });

        $('.wpz_pattern_17 .wp-block-query li .wp-block-group__inner-container').each(function(){
           $(this).children().not(':last').wrapAll("<div class='wpz-posts-inner-info'></div>");

        });

    });

    $window.ready(function() {

        $.fn.queryLoopLayout();

    });

    $(document).ready(function() {
        $.fn.queryLoopLayout();
    });

    $(window).resize(function(){
        $.fn.queryLoopLayout();
    });


    $.fn.queryLoopLayout = function () {
        $(window).on('resize orientationchange', update);

        function update() {
            $('.wpz_pattern_16 .wp-block-query li .wp-block-group__inner-container').each(function(){
               $(this).children().not(':last').wrapAll("<div class='wpz-posts-inner-info'></div>");

            });

            $('.wpz_pattern_17 .wp-block-query li .wp-block-group__inner-container').each(function(){
               $(this).children().not(':last').wrapAll("<div class='wpz-posts-inner-info'></div>");

            });
        }

        update();
    };

})(jQuery);