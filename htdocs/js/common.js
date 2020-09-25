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


$(function(){
	
	//ちょっと遅れてくるマウスストーカー
	//=================================
	//カーソル要素
	var cursor=$("#cursor");
	//ちょっと遅れてくる要素
	var stalker=$("#stalker");
	
	//mousemoveイベントでカーソル要素を移動
	$(document).on("mousemove",function(e){
		//マウス位置を取得するプロパティ
		var x=e.clientX;
		var y=e.clientY;
		
		//カーソル要素のcssを書き換え。重複しなければtransformを使うのがおすすめ
		cursor.css({
			"opacity":"1",
			"top":y+"px",
			"left":x+"px"
		});
		
		//ちょっと遅れて要素のcssを書き換え
		setTimeout(function(){
			stalker.css({
				"opacity":"0.5",
				"transform":"translate("+x+"px,"+y+"px)"
			});
		},300);
	});
	
	//aタグホバー
	$("a").on({
		"mouseenter": function() {
			//activeクラス付与
			cursor.addClass("active");
			stalker.addClass("active");
		},
		"mouseleave": function() {
			cursor.removeClass("active");
			stalker.removeClass("active");
			
		}
	});
});