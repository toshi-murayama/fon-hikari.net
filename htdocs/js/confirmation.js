animate_flg = 0;
$(window).scroll(function(){
	var submit = $('#submit');
	var position_next = submit.offset().top + 100 - $(window).height();
	if ($(window).scrollTop() > position_next && animate_flg == 0) {
		submit.addClass('animated rubberBand');
		animate_flg = 1;
		setTimeout(function(){
			submit.removeClass('animated').removeClass('rubberBand');
			animate_flg = 0;
		},1000);		
	}	
});