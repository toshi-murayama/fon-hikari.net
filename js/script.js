// JavaScript Document

$(document).ready(function(){
	$("#faq dd").hide();
	$("#faq dt").click(function(){
		$(this).toggleClass("active");
		$(this).parents("dl").children("dd").slideToggle();
	});
});

$(document).ready(function(){
	$("#device .spec ul").hide();
	$("#device .spec h5").click(function(){
		$(this).toggleClass("active");
		$(this).parents(".spec").children("ul").slideToggle();
	});
});


$(document).ready(function(){
 
    $(".gotop").hide();
 
    $(window).on("scroll", function() {
 
        if ($(this).scrollTop() > 100) {
         $('.gotop').slideDown("fast");
        } else {
            $('.gotop').slideUp("fast");
        }
       
        scrollHeight = $(document).height(); 
        scrollPosition = $(window).height() + $(window).scrollTop(); 
        footHeight = $("footer").innerHeight();
                 
        if ( scrollHeight - scrollPosition  <= footHeight ) {
            $(".gotop").css({
                "position":"absolute",
                "bottom": footHeight
            });
        } else {
            $(".gotop").css({
                "position":"fixed",
                "bottom": "0px"
            });
        }
    });
 
});



$(function(){
setInterval(function(){
  var now = new Date();
  var h = now.getHours();
  var mi = now.getMinutes();
  var s = now.getSeconds();
	$(".time dl dd span.time_text").text(h + "時" + mi + "分" + s + "秒");
}, 1000);
});

$(function(){
    var now_hour = new Date().getHours();

    if ( 0 <= now_hour && now_hour <= 09 ){
        $('.time dd .time_text').css('display','none');
		$('.time dd .status_text').text('WEBでの受付のみになります。');
    } else if ( 10 <= now_hour && now_hour <= 21 ) {
        $('.time dd .time_text').css('display','inline');
		$('.time dd .status_text').text('お電話が繋がりやすい状態です。');		
    } else if ( 22 <= now_hour && now_hour <= 23) {
        $('.time dd .time_text').css('display','none');
		$('.time dd .status_text').text('WEBでの受付のみになります。');		
	}
});



$(function() {
    $('.tab li').click(function() {
        var tabnum = $('.tab li').index(this);
        $('.content .show').css('display','none');
        $('.content .show').eq(tabnum).css('display','block');
        $('.tab li').removeClass('select');
        $(this).addClass('select')
    });
});




$(function(){

	//メニュー
	$(".menu").css("display","none");
	$("#panel-btn").click(function() {
		$(".menu").slideToggle(200);
		// $("#panel-btn-icon").toggleClass("close");
		return false;
	});
	$("#panel-btn-close-icon").click(function() {
		$(".menu").slideUp(200);
		// $("#panel-btn-icon").removeClass("close");
		return false;
	});
	$(".menu a").click(function(){
		$(".menu").hide();
		$("#panel-btn-icon").removeClass("close");
	});

	//アコーディオン
	$(".button-link").click(function () {
		$(this).toggleClass("on_under");
		$(this).next("p").toggle();
		$(this).next(".kaihei").toggle();
	});

	// $('.fancybox').fancybox();

});

	//カウントダウン
	jQuery(function(){
		$.preloadImages = function(){
			for(var i = 0; i < arguments.length; i++){
				jQuery('<img>').attr('src', arguments[i]);
			}
		};
		$.preloadImages(
			'img/img_countdown_0.png',
			'img/img_countdown_1.png',
			'img/img_countdown_2.png',
			'img/img_countdown_3.png',
			'img/img_countdown_4.png',
			'img/img_countdown_5.png',
			'img/img_countdown_6.png',
			'img/img_countdown_7.png',
			'img/img_countdown_8.png',
			'img/img_countdown_9.png'
		);
	});

	function CountdownTimer(elm,tl,mes){
		this.initialize.apply(this,arguments);
	}
	CountdownTimer.prototype={
		initialize:function(elm,tl,mes) {
			this.elem = document.getElementById(elm);
			this.tl = tl;
			this.mes = mes;
		},countDown:function(){
			var timer='';
			var today=new Date();
			//※残り時間が土日の最大48時間なので、%(24*60*60*1000))を%(48*60*60*1000))にしただけです
			//1日、3日以上では使えません
			var day =Math.floor( ( (this.tl-today)/(24*60*60*1000) ) );
            var hour=Math.floor( ( (this.tl-today)%(24*60*60*1000) ) / (60*60*1000) );
            var min =Math.floor( ( (this.tl-today)%(24*60*60*1000) ) / (60*1000))%60;
            var sec =Math.floor( ( (this.tl-today)%(24*60*60*1000) ) / 1000)%60%60;			var me=this;
			if( ( this.tl - today ) > 0 ){
                //timer += '<span class="day"><img src="/img/img_countdown_'+day+'.png" alt="'+this.addZero(day).substring(0, 1)+'"></span>日';
				
				timer += '<span class="day1"><img src="img/img_countdown_'+this.addZero(day).substring(0, 1)+'.png" alt="'+this.addZero(day).substring(0, 1)+'"></span>';
				timer += '<span class="day2"><img src="img/img_countdown_'+this.addZero(day).substring(1, 2)+'.png" alt="'+this.addZero(day).substring(1, 2)+'"></span>日';
				
				
				timer += '<span class="hour1"><img src="img/img_countdown_'+this.addZero(hour).substring(0, 1)+'.png" alt="'+this.addZero(hour).substring(0, 1)+'"></span>';
				timer += '<span class="hour2"><img src="img/img_countdown_'+this.addZero(hour).substring(1, 2)+'.png" alt="'+this.addZero(hour).substring(1, 2)+'"></span>時間';
				timer += '<span class="minute1"><img src="img/img_countdown_'+this.addZero(min).substring(0, 1)+'.png" alt="'+this.addZero(min).substring(0, 1)+'"></span>';
				timer += '<span class="minute2"><img src="img/img_countdown_'+this.addZero(min).substring(1, 2)+'.png" alt="'+this.addZero(min).substring(1, 2)+'"></span>分';
				timer += '<span class="second1"><img src="img/img_countdown_'+this.addZero(sec).substring(0, 1)+'.png" alt="'+this.addZero(sec).substring(0, 1)+'"></span>';
				timer += '<span class="second2"><img src="img/img_countdown_'+this.addZero(sec).substring(1, 2)+'.png" alt="'+this.addZero(sec).substring(1, 2)+'"></span>秒';
				this.elem.innerHTML = timer;
				tid = setTimeout( function(){me.countDown();},10 );
			}else{
                timer += '<span class="day1"><img src="img/img_countdown_0.png" alt="0"></span>';
                timer += '<span class="day2"><img src="img/img_countdown_0.png" alt="0"></span>';
				timer += '<span class="hour1"><img src="img/img_countdown_0.png" alt="0"></span>';
				timer += '<span class="hour2"><img src="img/img_countdown_0.png" alt="0"></span>';
				timer += '<span class="minute1"><img src="img/img_countdown_0.png" alt="0"></span>';
				timer += '<span class="minute2"><img src="img/img_countdown_0.png" alt="0"></span>';
				timer += '<span class="second1"><img src="img/img_countdown_0.png" alt="0"></span>';
				timer += '<span class="second2"><img src="img/img_countdown_0.png" alt="0"></span>';
				this.elem.innerHTML = timer;
				/*
				this.elem.innerHTML = this.mes;
				return;
				*/
			}
		},addZero:function(num){ return ('0'+num).slice(-2); }
	}
	function CDT(){
		var week_number = $("input[name=week]").val();
		var limit_date = $("input[name=limit_date]").val();
		console.log(limit_date);

		var limit = new Date(limit_date);

        var first_day = new Date('2015/09/01');
        //もし月初と次の期限が3日未満の場合は次の期限に設定する。
		var timer = new CountdownTimer('campaign-rest-time', limit, '<p>キャンペーンは終了しました</p>');
		timer.countDown();
	}
	window.onload=function(){
		CDT();
	}




