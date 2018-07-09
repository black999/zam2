$(document).ready(function() {
	//obsługa przycisku zamknij w oknie .dial
	$('.dialog').on('click', '#zamknij', function(){
		$('.dialog').fadeOut('fast');
	});
	function btnClick (){
		$('.btn').off('click');
		$('.btn').on('click', function(e) {
			var dane = $(this);
			var idZam = $(dane).data('idzam');
			var BtnVal = $(dane).val();
			var url = "<?= SITEROOT ?>/ajax/zamowienia/" + BtnVal + ".php";
			if (BtnVal == 'usun' ||
				BtnVal == 'zatwierdz'){
				$.ajax({
			        type    : "POST",
			        url     : url,
			        data    : {
		            idZam 	: idZam,
			        },
			        success: function(ret) {
			            dane.parents().eq(1).hide('slow')
			        },
		            error: function(jqXHR, errorText, errorThrown) {
		            	alert(errorText);
		            }
		    	});
			};
			if (BtnVal == 'komentarz') {
				$.ajax({
			        type    : "POST",
			        url     : url,
			        data    : { 
			        	akcja	: 'pobierz',
			        	idZam	: idZam
			        },
			        success: function(ret) {
			        	$('#p2').html(ret);
			        	$('#input1').attr('data-idzam', idZam);
			            // $('.dialog').fadeIn('fast');
			            $('.dialog').slideDown('fast');
			        },
		            error: function(jqXHR, errorText, errorThrown) {
		            }
		    	});
			};
			if (BtnVal == 'pokaz') {
				dane.parents('tr').siblings('tr.ukr').hide(50);
				dane.parents('tr').next('tr.ukr').delay(400).fadeToggle('slow');
			}
		});
	}
	btnClick();
	// obsługa formatki dodawania komentarza
	var form = $('#dodaj-msg');
    $(form).submit(function(event) {
	    event.preventDefault();
		var idZam = $('#input1').attr('data-idzam');
	    var komentarz = ($('#input1').val());
	    if (komentarz == ""){
	    	return false;	
	    }
		$("input[type=submit]").attr("disabled", "disabled");
	    $.ajax({
	    	url: $(form).attr('action'),
	    	type: 'POST',
	    	data: { akcja 		: 'dodaj', 
	    			idZam		: idZam,
	    			komentarz 	: komentarz}
	    })
	    .done(function(e) {
	    	$('#p2').html(e);
	    	$('#input1').val("");
	    	$("input[type=submit]").removeAttr("disabled");
	    })
	    .fail(function() {
	    	console.log("error");
	    });
	});
    // obsługa akcetpuj/odrzuc
    $('i[name=yes]').on('click', function(){
    	var url = "<?= SITEROOT ?>/ajax/zamowienia/akceptuj.php";
    	var idZam = $(this).attr('data-idzam');
    	var ukryj = $(this).parent('div');
	   	var szczegoly = $('tr[data-idzam=' + idZam +']') 
    	$.post(url, {idZam: idZam, ok: true}, function(data, textStatus, xhr) {
    		szczegoly.html(data);
    		btnClick();
    		ukryj.hide();
    	});
    });
    $('i[name=no]').on('click', function(){
    	var url = "<?= SITEROOT ?>/ajax/zamowienia/akceptuj.php";
    	var idZam = $(this).attr('data-idzam');
    	var ukryj = $(this).parent('div');	
    	var szczegoly = $('tr[data-idzam=' + idZam +']') 
    	$.post(url, {idZam: idZam, ok: false}, function(data, textStatus, xhr) {
    		szczegoly.html(data);
    		btnClick();
    		ukryj.hide();
    	});
    });
	// podstawianie ceny towaru do okienka ceny zakupu
	var cenaZak = $('#sel1 :selected').data('cenazak');
	$("#cenaZak").val(cenaZak)
	$("#sel1").change(function() {
		var cenaZak = $('#sel1 :selected').data('cenazak');
		$("#cenaZak").val(cenaZak)
	});
});
