<!DOCTYPE html>
<html>
<head>
	<?php 
    	require APP_DIR . "/inc/naglowek.inc.php";
  	?>	
	<title>Opis faktry</title>
</head>
<body>
<div id="opAt" class="dialog">
	<button class="btn btn-edit" id="zamknij" style="float: right;">Zamknij</button>
	<p>Tu bedzie dodawany opis działu A-T</p>
	<form>
		<label>Zużyto na cele </label>
		<input type="text" name=""><br>
		<label>Dla kogo</label>
		<input type="text" name="">
	</form>
</div>
<div class="tytul">Opis faktury</div>
<div>
	<button id="btOpAt">A-T</button>
	<button id="btOpKs">księgowość</button>
	<button>jakis tam</button>
	<button class="btn btn-edit" style="float: right;" onclick="javascript:history.back();" >powrót</button>
</div>
<div>
	<embed src="<?= $sciezka ?>" width="100%" height="500">	
</div>
<script type="text/javascript">
	<?php
		require APP_DIR . "/jquery/faktury/opis.js";
	?>
</script>
</body>
</html>