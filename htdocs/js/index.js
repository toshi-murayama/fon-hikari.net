
$(function () {
    $(window).on('scroll', function() {
        var scroll_top = $(window).scrollTop();
        $('.bEffect01').each(function() {
            var offset_top = $(this).offset().top,
                top_margin = 650;
            if (scroll_top > offset_top - top_margin) {
                $(this).addClass('fadein');
            } else {
            }
        });
        $('.bEffect02').each(function() {
            var offset_top = $(this).offset().top,
                top_margin = 650;
            if (scroll_top > offset_top - top_margin) {
                $(this).addClass('fadein');
            } else {
            }
        });
        $('.bEffect03').each(function() {
            var offset_top = $(this).offset().top,
                top_margin = 650;
            if (scroll_top > offset_top - top_margin) {
                $(this).addClass('fadein');
            } else {
            }
        });
        $('.bEffect04').each(function() {
            var offset_top = $(this).offset().top,
                top_margin = 650;
            if (scroll_top > offset_top - top_margin) {
                $(this).addClass('fadein');
            } else {
            }
        });
        $('.ani1').each(function() {
            var offset_top = $(this).offset().top,
                top_margin = 650;
            if (scroll_top > offset_top - top_margin) {
                $(this).addClass('fadein');
            } else {
            }
        });
        $('.ani2').each(function() {
            var offset_top = $(this).offset().top,
                top_margin = 650;
            if (scroll_top > offset_top - top_margin) {
                $(this).addClass('fadein');
            } else {
            }
        });
    });
});