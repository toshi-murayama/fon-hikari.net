$(function($){
	jQuery("#areaForm").validationEngine();

	$(document).on("click",".area_btn",function(){
		$('#areaForm').slideToggle();
	});	
});