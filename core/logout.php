<?php
	require_once "init.php";

	session_unset(); 
	session_destroy();
	echo "<script>
		if(typeof(parent) != 'undefined') {
			parent.window.location.href='login.php';
		} else {
			window.location.href='login.php';
		}
	</script>";
?>