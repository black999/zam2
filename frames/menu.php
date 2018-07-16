<?php 
  // session_start();
  // if (!isset($_SESSION['auth'])) {
  // header("Location:login.php");
  // }
  require_once "../core/init.php";

?>
<!DOCTYPE html>
<html>
<head>
  <?php 
    include APP_DIR . "/inc/naglowek.inc.php";
  ?>
  <title></title>
</head>
<body>
<div id='cssmenu'>
<ul>
   <li class='active'><a href='srodek.php' TARGET='srodek'><span>Home</span></a></li>
   <li class='has-sub'><a href='#'><span>Zamowienia</span></a>
      <ul>
       <li><a href='../core/zamowienia/dodaj.php' TARGET='srodek'><span>Nowe</span></a></li>
       <li><a href='../core/zamowienia/doakceptacji.php' TARGET='srodek'><span>do akceptacji</span></a></li>
       <li><a href='../core/zamowienia/dorealizacji.php' TARGET='srodek'><span>do realizacji</span></a></li>
       <li class='last'><a href='../core/zamowienia/odrzucone.php' TARGET='srodek'><span>odrzucone</span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Towary</span></a>
      <ul>
         <li class='last'><a href='../core/towary/dodaj.php' TARGET='srodek'><span>Dodaj/Edycja</span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Admin</span></a>
      <ul>
         <li><a href='nic' TARGET='srodek'><span>Personel</span></a></li>
         <li class='last'><a href='nic' TARGET='srodek'><span>Wydziały</span></a></li>
      </ul>
   </li>
   <li class='last'><a href='#'><span>Info</span></a></li>
</ul>
</div>
</body>
</html>
