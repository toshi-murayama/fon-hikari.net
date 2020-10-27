$(function(){
	$('#remote_support').hide();
	$('#hikari_tv').hide();
	$('#security').hide();
	$("#button1").click(function() {
		$("#hikari_tel").fadeIn();
		$("#remote_support").fadeOut();
		$("#hikari_tv").fadeOut();
		$("#security").fadeOut();
	});
	$("#button2").click(function() {
		$("#hikari_tel").fadeOut();
		$("#remote_support").fadeIn();
		$("#hikari_tv").fadeOut();
		$("#security").fadeOut();
	});
	$("#button3").click(function() {
		$("#hikari_tel").fadeOut();
		$("#remote_support").fadeOut();
		$("#hikari_tv").fadeIn();
		$("#security").fadeOut();
	});
	$("#button4").click(function() {
		$("#hikari_tel").fadeOut();
		$("#remote_support").fadeOut();
		$("#hikari_tv").fadeOut();
		$("#security").fadeIn();
	});
});