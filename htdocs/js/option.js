$(function(){
	$('#remote_support').hide();
	$('#hikari_tv').hide();
	$("#button1").click(function() {
		$("#hikari_tel").fadeIn();
		$("#remote_support").fadeOut();
		$("#hikari_tv").fadeOut();
	});
	$("#button2").click(function() {
		$("#hikari_tel").fadeOut();
		$("#remote_support").fadeIn();
		$("#hikari_tv").fadeOut();
	});
	$("#button3").click(function() {
		$("#hikari_tel").fadeOut();
		$("#remote_support").fadeOut();
		$("#hikari_tv").fadeIn();
	});
});