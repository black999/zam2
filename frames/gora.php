<?php 
  // session_start();
  // if (!isset($_SESSION['auth'])) {
  // header("Location:login.php");
  // }
  require_once "../core/init.php";
?>
<html lang=pl>
<head>
  <?php 
	 include APP_DIR . "/inc/naglowek.inc.php";
  ?>
  <title></title>
</head>
<body>
<div class="head" style="overflow: auto;">
  <div style="float: left; width: 33%; padding: 0; margin: 0;">
    <span>Zalogowany :  <b><?= $_SESSION[APP_NAME]['imie'] . " " . $_SESSION[APP_NAME]['nazwisko'] ?></b></span>
  </div>
  <div style="float: left; width: 33%; padding: 0; margin: 0;">dział : <b></b></div>
  <div style="float: left; width: 33%; text-align: right; padding: 0; margin: 0;"><a href='<?= SITEROOT . '/core/logout.php' ?>' TARGET='srodek'><i class="fas fa-sign-out-alt fa-lg" style="color: gray"></i></a></div>
</div>

</body>
</html>