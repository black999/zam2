$(document).ready(function() {
	$.getJSON('<?= SITEROOT . "/ajax/towary/test.php" ?>', function(data) {
		$.each(data, function(index, val) {
			$('#dodaj').append(
				'<tr><td>'+data[index].nazwa+'</td></tr>')
		});		
	});	
});