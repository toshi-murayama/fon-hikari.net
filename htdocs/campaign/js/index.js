$(function () {
    $(window).on('scroll', function() {
        var scroll_top = $(window).scrollTop();
        $('.effect').each(function() {
            var offset_top = $(this).offset().top,
                top_margin = 570;
            if (scroll_top > offset_top - top_margin) {
                $(this).addClass('fadein');
            } else {
            }
        });
        $('.border1').each(function() {
            var offset_top = $(this).offset().top,
                top_margin = 570;
            if (scroll_top > offset_top - top_margin) {
                $(this).addClass('fadein');
            } else {
            }
        });
        $('.border2').each(function() {
            var offset_top = $(this).offset().top,
                top_margin = 570;
            if (scroll_top > offset_top - top_margin) {
                $(this).addClass('fadein');
            } else {
            }
        });
        $('.border3').each(function() {
            var offset_top = $(this).offset().top,
                top_margin = 570;
            if (scroll_top > offset_top - top_margin) {
                $(this).addClass('fadein');
            } else {
            }
        });
    });
});

$(function() {
    "use strict";
    var flag = "view";

    $(window).on("scroll", function() {
        if ($(this).scrollTop() > 200) {
            if (flag === "view") {
                $(".fix-header_top").stop().css({
                    opacity: '1.0'
                }).animate({
                    top: 0
                }, 500);

                flag = "hide";
            }
        } else {
            if (flag === "hide") {
                $(".fix-header_top").stop().animate({
                    top: "-66px",
                    opacity: 0
                }, 500);
                flag = "view";
            }
        }
    });
});

$(function(){
  var slider = "#slider_top"; // スライダー
  var thumbnailItem = "#thumbnail-list .thumbnail-item"; // サムネイル画像アイテム
  
  // サムネイル画像アイテムに data-index でindex番号を付与
  $(thumbnailItem).each(function(){
   var index = $(thumbnailItem).index(this);
   $(this).attr("data-index",index);
  });
  
  // スライダー初期化後、カレントのサムネイル画像にクラス「thumbnail-current」を付ける
  // 「slickスライダー作成」の前にこの記述は書いてください。
  $(slider).on('init',function(slick){
   var index = $(".slide-item.slick-slide.slick-current").attr("data-slick-index");
   $(thumbnailItem+'[data-index="'+index+'"]').addClass("thumbnail-current");
  });

  //slickスライダー初期化  
  $(slider).slick({
    autoplay: true,
    autoplaySpeed:5000,
    arrows: false,
    infinite: true
  });
  //サムネイル画像アイテムをクリックしたときにスライダー切り替え
  $(thumbnailItem).on('click',function(){
    var index = $(this).attr("data-index");
    $(slider).slick("slickGoTo",index,false);
  });
  
  //サムネイル画像のカレントを切り替え
  $(slider).on('beforeChange',function(event,slick, currentSlide,nextSlide){
    $(thumbnailItem).each(function(){
      $(this).removeClass("thumbnail-current");
    });
    $(thumbnailItem+'[data-index="'+nextSlide+'"]').addClass("thumbnail-current");
  });
});

$(function(){
  var slider = "#slider_fon"; // スライダー
  var thumbnailItem = "#thumbnail-list_fon .thumbnail-item_fon"; // サムネイル画像アイテム
  
  // サムネイル画像アイテムに data-index でindex番号を付与
  $(thumbnailItem).each(function(){
   var index = $(thumbnailItem).index(this);
   $(this).attr("data-index",index);
  });
  
  // スライダー初期化後、カレントのサムネイル画像にクラス「thumbnail-current」を付ける
  // 「slickスライダー作成」の前にこの記述は書いてください。
  $(slider).on('init',function(slick){
   var index = $(".slide-item.slick-slide.slick-current").attr("data-slick-index");
   $(thumbnailItem+'[data-index="'+index+'"]').addClass("thumbnail-current");
  });

  //slickスライダー初期化 
function sliderSetting(){
	var width = $(window).width();
	if(width <= 750){
		$('#slider_fon').not('.slick-initialized').slick({
			autoplay: false,
			arrows: false,
			infinite: true
		});
	} else {
		$('.slide.slick-initialized').slick('unslick');
	}
}
	sliderSetting();
	$(window).resize( function() {
		sliderSetting();
	});
	
  //サムネイル画像アイテムをクリックしたときにスライダー切り替え
  $(thumbnailItem).on('click',function(){
    var index = $(this).attr("data-index");
    $(slider).slick("slickGoTo",index,false);
  });
  
  //サムネイル画像のカレントを切り替え
  $(slider).on('beforeChange',function(event,slick, currentSlide,nextSlide){
    $(thumbnailItem).each(function(){
      $(this).removeClass("thumbnail-current");
    });
    $(thumbnailItem+'[data-index="'+nextSlide+'"]').addClass("thumbnail-current");
  });
});


$(function(){
    $('.slider').slick({
        autoplay:true,
        autoplaySpeed:5000,
        dots:true,
    });
    $('.slider2').slick({
        arrows: true,
        slidesToShow:5,
        centerMode:true,
        responsive: [{
            breakpoint: 1024, //1024px以下のサイズに適用
            settings: {
                slidesToShow: 5
            },
            breakpoint: 768, //767px以下のサイズに適用
            settings: {
                slidesToShow: 3
            },
            breakpoint: 480, //480px以下のサイズに適用
            settings: {
                slidesToShow: 1
            }
        }]
    });
    $('.slider3').slick({
		slidesToShow: 3,
		slidesToScroll: 1,
        autoplay:true,
        autoplaySpeed:3000,
        dots:false,
		arrows: false
    });

	var $logo = $('#logo');
	var mainHeight = $('#main').outerHeight();
	var window_width = $(window).width();

	$(window).scroll(function () {
		mainHeight = $('#main').outerHeight();
		window_width = $(window).width();

		if ( window_width <= 767 ) {
			mainHeight = mainHeight + 110;
		}

		if ( $(this).scrollTop() <= mainHeight ) {
			$logo.addClass('top');
		} else {
			$logo.removeClass('top');
		}
	});


	// jquery.inview.min.js
	$('.flag').on('inview', function(event, isInView) {
		if (isInView) {
			// $(this).css("background","#333");
			$(this).empty();
			$(this).append('<img src="./images/icon_now.gif?' + (new Date).getTime() + '" alt="travel now" width="100" height="100">');
		} else {
			$(this).empty();
		}
	});

	// slider
	var setElm = $('#slide'),
	slideSpeed = 6000;

	setElm.each(function(){
	  var self = $(this),
	  selfWidth = self.innerWidth(),
	  findUl = self.find('ul'),
	  findLi = findUl.find('li'),
	  listWidth = findLi.outerWidth(),
	  listCount = findLi.length,
	  loopWidth = listWidth * listCount;

	  findUl.wrapAll('<div id="slide_wrapper" />');
	  var selfWrap = self.find('#slide_wrapper');

	  if(loopWidth > selfWidth){
	    findUl.css({width:loopWidth}).clone().appendTo(selfWrap);

	    selfWrap.css({width:loopWidth*2});

	    function loopMove(){
	      selfWrap.animate({left:'-' + (loopWidth) + 'px'},slideSpeed*listCount,'linear',function(){
	        selfWrap.css({left:'0'});
	        loopMove();
	      });
	    };
	    loopMove();

	    setElm.hover(function() {
	      selfWrap.pause();
	    }, function() {
	      selfWrap.resume();
	    });
	  }
	});
});

$(function(){
	$('#faq dt').click(function(){
		$(this).next().slideToggle();
	});
});
