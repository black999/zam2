jQuery.ajax({
    type: 'POST',
    url: '<?php echo admin_url('admin-ajax.php'); ?>',
    data: data, 
    dataType: 'json', // ** ensure you add this line **
    success: function(data) {
        jQuery.each(data, function(index, item) {
            //now you can access properties using dot notation
        });
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
        alert("some error");
    }
});

lub 
$(document).ready(function() {
    $.getJSON('<?= SITEROOT . "/ajax/towary/test.php" ?>', function(data) {
        $.each(data, function(index, val) {
            $('#dodaj').append(
                '<tr><td>'+data[index].nazwa+'</td></tr>')
        });     
    }); 
});
