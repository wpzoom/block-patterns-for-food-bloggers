/**
 * Theme functions file
 */
(function ($) {
    'use strict';

    var $window = $(window);


    /**
    * Document ready (jQuery)
    */
    $(function () {

       var section_topbar = $('.top-navbar').outerHeight();

        $('.wpz_pattern_16 .wp-block-query li .wp-block-group__inner-container').each(function(){
           $(this).children().not(':last').wrapAll("<div class='wpz-posts-inner-info'></div>");

        });


    });


})(jQuery);