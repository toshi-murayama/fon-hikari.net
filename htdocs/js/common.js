$(function() {
    "use strict";
    var flag = "view";

    $(window).on("scroll", function() {
        if ($(this).scrollTop() > 200) {
            if (flag === "view") {
                $(".fix-header").stop().css({
                    opacity: '1.0'
                }).animate({
                    top: 0
                }, 500);

                flag = "hide";
            }
        } else {
            if (flag === "hide") {
                $(".fix-header").stop().animate({
                    top: "-66px",
                    opacity: 0
                }, 500);
                flag = "view";
            }
        }
    });
});