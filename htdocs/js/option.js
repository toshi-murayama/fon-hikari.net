$(function(){
	$('#hikari_tv').hide();
	$('#denki').hide();
	$("#button1").click(function() {
		$("#hikari_tel").fadeIn();
		$("#hikari_tv").fadeOut();
		$("#denki").fadeOut();
	});
	$("#button2").click(function() {
		$("#hikari_tel").fadeOut();
		$("#hikari_tv").fadeIn();
		$("#denki").fadeOut();
	});
	$("#button3").click(function() {
		$("#hikari_tel").fadeOut();
		$("#hikari_tv").fadeOut();
		$("#denki").fadeIn();
	});
});

$(function(){
	$('#security').hide();
	$("#button4").click(function() {
		$("#remote_support").fadeIn();
		$("#security").fadeOut();
	});
	$("#button5").click(function() {
		$("#remote_support").fadeOut();
		$("#security").fadeIn();
	});
});