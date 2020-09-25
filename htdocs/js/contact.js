$(function($){

	jQuery("#appForm").validationEngine();
	var cmn = [];
	var w = $(window).width();	
	cmn.ua = window.navigator.userAgent.toLowerCase();
	cmn.ua_iPhone = (cmn.ua.indexOf('iPhone') > 0) ? true : false;
	cmn.ua_iPod = (cmn.ua.indexOf('iPod') > 0) ? true : false;
	cmn.ua.Android = (cmn.ua.indexOf('Android') > 0 && cmn.ua.indexOf('Mobile') > 0) ? true : false;
	cmn.ua_WinPhone = (cmn.ua.indexOf('Windows Phone') > 0) ? true : false;
	cmn.ua_Blackberry = (cmn.ua.indexOf('Brackberry') > 0) ? true : false;	
	if(cmn.ua_iphone || cmn.ua_iPod || cmn.ua.Android || cmn.ua_WinPhone || cmn.ua_Blackberry || w < 680) {
		$('.modalInnerBox2 .initial').css('display','none');
		$('input').each(function(){
			var input_class = String($(this).attr('class'));
			if(input_class.match(/validate/)){
				$(this).attr('data-prompt-position','topLeft');
			}
		});
		$('#agree').attr('data-prompt-position','centerLeft');
		$('select').each(function(){
			var input_class = String($(this).attr('class'));
			if(input_class.match(/validate/)){
				$(this).attr('data-prompt-position','topLeft');
			}
		});		
		$('textarea').each(function(){
			var input_class = String($(this).attr('class'));
			if(input_class.match(/validate/)){
				$(this).attr('data-prompt-position','topLeft');
			}
		});				
		sp_flg = 1;
	} else {
		$('.modalInnerBox2 .initial_sp').css('display','none');
		sp_flg = 0;
	}

});

$(window).on('load', function() {
    $.fn.autoKana('#lastName', '#lastNameKana', {
        katakana : true
    });	    
    $.fn.autoKana('#firstName', '#firstNameKana', {
        katakana : true
    });	    	
});

