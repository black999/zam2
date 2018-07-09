<?php
	@define('SITEROOT',"http://" . $_SERVER['SERVER_ADDR'] . '/zam2' );
	$uri = explode('/', $_SERVER['REQUEST_URI']);
?>
<meta charset='utf-8'>
<meta http-equiv='X-UA-Compatible' content='IE=edge'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<script src='<?=SITEROOT ?>/script/jquery.js' type='text/javascript'></script> 
<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js' type='text/javascript'></script>  -->
 
<?php if (end($uri) == 'menu.php') : ?>
  	<link rel='stylesheet' type='text/css' href='<?= SITEROOT ?>/css/menu.css'>
  	<link rel='stylesheet' type='text/css' href='<?= SITEROOT ?>/css/styles.css'>
  	<script src='<?=SITEROOT ?>/script/menu.js' type='text/javascript'></script>
<?php elseif (end($uri) == 'login.php') : ?>	
  	<link rel='stylesheet' type='text/css' href='<?= SITEROOT ?>/css/login.css'>
<?php else : ?>	
	<link rel='stylesheet' type='text/css' href='<?= SITEROOT ?>/css/styles.css'>
	<link rel='stylesheet' type='text/css' href='<?= SITEROOT ?>/css/select2.css'>
	<link rel='stylesheet' type='text/css' href='<?= SITEROOT ?>/css/dataTable.css'>
	<link rel="stylesheet" type='text/css' href='<?= SITEROOT ?>/css/fa-all.css'>
	<script src='<?=SITEROOT ?>/script/select2.js' type='text/javascript'></script>
	<script src='<?=SITEROOT ?>/script/dataTable.js' type='text/javascript'></script>
<?php endif ?>