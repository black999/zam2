$(document).ready(function() {
	//obsługa przycisku zamknij w oknie .dial
	$('.dialog').on('click', '#zamknij', function() {
		$('.dialog').fadeOut('fast');
	});
	$('.btn').on('click', function() {
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
		        	console.log('success');
		        	$('#input1').attr('data-idzam', idZam);
		            // $('.dialog').fadeIn('fast');
		            $('.dialog').slideDown('fast');
		        },
	            error: function(jqXHR, errorText, errorThrown) {
	            }
	    	});
		};
		if (BtnVal == 'pokaz') {
			// jQuery.getJSON(url, {idZam: idZam}, function(json, textStatus) {
			// 	var okno = dane.parents('tr').next('tr.ukr').children('td');
			// 	okno.html('<div class=\'szczegoly-zam\'>Zamownienie nr : '+idZam+'<br><br><br><br></div>');
			// });
			dane.parents('tr').siblings('tr.ukr').hide(50);
			dane.parents('tr').next('tr.ukr').delay(400).fadeToggle('slow');
			// dane.text('ukryj');
			// dane.val('ukryj');
		}
	});

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
	    	console.log("success");
	    })
	    .fail(function() {
	    	console.log("error");
	    });
	});
    // obsługa akcetpuj/odrzuc
    $('i[name=yes]').on('click', function(){
    	var url = "<?= SITEROOT ?>/ajax/zamowienia/akceptuj.php";
    	var idZam = $(this).attr('data-idzam');
    	$.post(url, {idZam: idZam, ok: true}, function(data, textStatus, xhr) {
    		console.log('wykonane');
    		/*optional stuff to do after success */
    	});
    	console.log('jest '+$(this).attr('data-idzam'));
    });
    $('i[name=no]').on('click', function(){
    	var url = "<?= SITEROOT ?>/ajax/zamowienia/akceptuj.php";
    	var idZam = $(this).attr('data-idzam');
    	$.post(url, {idZam: idZam, ok: false}, function(data, textStatus, xhr) {
    		console.log('wykonane');
    		/*optional stuff to do after success */
    	});
    	console.log('jest '+$(this).attr('data-idzam'));
    });
	// podstawianie ceny towaru do okienka ceny zakupu
	var cenaZak = $('#sel1 :selected').data('cenazak');
	$("#cenaZak").val(cenaZak)
	$("#sel1").change(function() {
		var cenaZak = $('#sel1 :selected').data('cenazak');
		$("#cenaZak").val(cenaZak)
	});
});
