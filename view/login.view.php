<!doctype html>
<html lang='pl'>
<head>
	<?php 
    	require APP_DIR . "/inc/naglowek.inc.php";
  	?>
   <title>Logowanie</title>
</head>
<body>
<div class="center" style="display: none;">
	<div id="panel">
		<form action="#" method ="post">
			<label for="username">Nazwa użytkownika:</label>
			<input type="text" id="username" name="login" required autofocus>
			<label for="password">Hasło:</label>
			<input type="password" id="password" name="haslo" required>
			<div id="lower">
				<input type="submit" value="Zaloguj">
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('div.center').fadeIn('slow');
	});
</script>
</body>
</html>