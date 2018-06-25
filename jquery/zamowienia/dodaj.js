$(document).ready(function() {
	//obsługa przycisku zamknij w oknie .dial
	$('.dial').on('click', 'button', function() {
		$('.dial').fadeOut('slow');
	});
	$('.btn').on('click', function() {
		var dane = $(this);
		var id = $(this).data('id');
		var BtnVal = $(this).val();
		var url = "<?= SITEROOT ?>/ajax/zamowienia/" + BtnVal + ".php";

		if (BtnVal == 'usun' ||
			BtnVal == 'zatwierdz'){
			$.ajax({
		        type    : "POST",
		        url     : url,
		        data    : {
	            id 		: id,
		        },
		        success: function(ret) {
		        	// $('.dial').fadeIn('fast');
		            dane.parents().eq(1).hide('slow')
		        },
	            error: function(jqXHR, errorText, errorThrown) {
	            	alert(errorText);
	            }
	    	});
		}
		if (BtnVal == 'edycja') {
				
		}
	});
	// podstawianie ceny towaru do okienka ceny zakupu
	var cenaZak = $('#sel1 :selected').data('cenazak');
	$("#cenaZak").val(cenaZak)
	
	$("#sel1").change(function() {
		var cenaZak = $('#sel1 :selected').data('cenazak');
		$("#cenaZak").val(cenaZak)
	});

});
