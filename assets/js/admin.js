$(document).ready(function(){
	$(".on-filter").change(function(){
		$('input[name=filter_hidden]').val('on_filter');
		$('.admin-form').submit();
	});
	$(".on-search").click(function(event){
		event.preventDefault();
		$('.admin-form').submit();
	});
	$(".on-reset").click(function(event){
		event.preventDefault();
		$(this).closest('form').find("input[type=text]").val('');
		$('input[name=filter_hidden]').val('reset');
		$('.admin-form').submit();
	});
});
