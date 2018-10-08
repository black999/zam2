$(document).ready(function(){
	$('#zamknij').on('click',  function() {
		event.preventDefault();
		$('.dialog').fadeOut()
	});
	$("#btOpAt").on('click', function() {
		event.preventDefault();
		$("#opAt").show();
	});
});
