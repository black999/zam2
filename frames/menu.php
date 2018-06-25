<?php 
  // session_start();
  // if (!isset($_SESSION['auth'])) {
  // header("Location:login.php");
  // }
  require_once "../core/funkcje.php";
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
       <li><a href='listaodrzuconych.php' TARGET='srodek'><span>Odrzucone</span></a></li>
       <li class='last'><a href='listazrealizowanych.php' TARGET='srodek'><span>Zrealizowane</span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Towary</span></a>
      <ul>
         <li class='last'><a href='../core/towary/dodaj.php' TARGET='srodek'><span>Dodaj/Edycja</span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Personel</span></a>
      <ul>
         <li><a href='personel.php?menu=dodaj' TARGET='srodek'><span>Dodaj</span></a></li>
         <li class='last'><a href='personel.php?menu=lista' TARGET='srodek'><span>Lista/Edycja</span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Wydziały</span></a>
      <ul>
      <li class='last'><a href='dzialy.php?menu=dodaj' TARGET='srodek'><span>Dodaj/Edytuj</span></a></li>
      </ul>
   </li>
   <li class='last'><a href='#'><span>Info</span></a></li>
</ul>
</div>
</body>
</html>
