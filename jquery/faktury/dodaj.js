$(document).ready(function() {
	$('#zamknij').on('click',  function() {
		event.preventDefault();
		$('.dialog').fadeOut()
	});
	$(".pokaz").on('click', function(){
		event.preventDefault();
		var sciezka = $(this).data('sciezka');
		$('.dialog > embed').attr('src', sciezka);
		$('.dialog > .opis').attr('data-sciezka', sciezka);
		$('.dialog').fadeIn();
	})
	$(".opis").on('click', function(){
		event.preventDefault();
		var sciezka = $(this).data('sciezka');
		window.location.href = 'opis.php?src=' + sciezka;
	})
});