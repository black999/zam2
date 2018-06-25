<?php
function dd($string){
  die(var_dump($string));
}

// funkcja sprawdza czy sesja jest wciaż aktywan jeśli nie to wylogowuje
function sprawdzSesje () {
  session_start();
  if (!isset($_SESSION['zam2']['auth'])) {
    header("Location:login.php");
  } else {
        if ((time() - $_SESSION['zam2']["loginTime"]) > TIMEOUT) {   //sprawdzamy kiedy ostatni raz byla aktywnosc
            header("Location: login.php?menu=logout");  // jesli powyzej TIMEOUT sekund to wylogowujemy
          } else {
            $_SESSION['zam2']["loginTime"] = time();
          }
        }
}

//funkcja do podłączenia do bazy i ustawienia parametrów jezykowych
function  polaczZBaza($host, $uzytkownik, $haslo, $nazwabazydanych) {
	try {
    $pdo = new PDO('mysql:host='.$host.';dbname='.$nazwabazydanych, $uzytkownik, $haslo);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->query("SET NAMES utf8");
    $pdo->query("SET CHARACTER SET utf8");
    $pdo->query("SET collation_connection = utf8_polish_ci");
  } catch (PDOException $e){
    echo "Połączenie z bazą danych nie zostało utworzone." .$e->getMessage();
  }
  return $pdo;
}

// funkcja dodaje do bazy zamowienie 
function addZamowienie($dane) {
	global $pdo;
  $sql = "INSERT into zamowienia values (NULL, '1', CURDATE(), :idTowaru, :cenaZak, :ilosc, :kosztOpis, :kosztCena, '0')";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':idTowaru', $dane['idTowaru'], PDO::PARAM_INT);
  $stmt->bindValue(':cenaZak', str_replace(",",".",$dane['cenaZak']), PDO::PARAM_INT);
  $stmt->bindValue(':ilosc', $dane['ilosc'], PDO::PARAM_INT);
  $stmt->bindValue(':kosztOpis', $dane['kosztOpis'], PDO::PARAM_STR);
  $stmt->bindValue(':kosztCena', str_replace(",",".",$dane['kosztCena']), PDO::PARAM_INT);
  try {
  	$stmt->execute();
  	return true;
  } catch (PDOException $e) {
  	die($e->getMessage());
  }
}

// funkcja pobiera z bazy informację o wszystkich zamowieniach
function getZamowienia($warunek = "") {
	global $pdo;
  $tab = [];
  if ($warunek) {
    $warunek = 'WHERE ' . $warunek;
  }
  $sql = "SELECT z.*, t.nazwa from zamowienia z
          join towary t on z.idTowaru = t.id " . $warunek; 
  $rows = $pdo->prepare($sql);
  try {
  	$rows->execute();
  } catch (PDOException $e) {
    die($e->getMessage());
  }
	foreach ($rows as $row) {
  	$tab[$row['id']] = $row;
	}
  return $tab;
}

// funkcja usuwa zamowienie
function delZamowienie($id) {
	global $pdo;
  $sql = "DELETE FROM zamowienia WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  try {
  	$stmt->execute();
  	return true;
  } catch (PDOException $e) {
  	die($e->getMessage());
  }
}

// funkcja zmienia zamowienie
function updateZamowienie($dane){
  global $pdo;
  $sql = "UPDATE zamowienia SET idTowaru    = :idTowaru, 
                                cenaZak   = :cenaZak, 
                                ilosc     = :ilosc, 
                                kosztOpis = :kosztOpis, 
                                kosztCena = :kosztCena
          WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':id', $dane['id'], PDO::PARAM_INT);
  $stmt->bindValue(':idTowaru', $dane['idTowaru'], PDO::PARAM_INT);
  $stmt->bindValue(':cenaZak', str_replace(",",".",$dane['cenaZak']), PDO::PARAM_INT);
  $stmt->bindValue(':ilosc', $dane['ilosc'], PDO::PARAM_INT);
  $stmt->bindValue(':kosztOpis', $dane['kosztOpis'], PDO::PARAM_STR);
  $stmt->bindValue(':kosztCena', str_replace(",",".",$dane['kosztCena']), PDO::PARAM_INT);
  try {
    $stmt->execute();
    return true;
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

// funkcja zatwierdza zamowienie o podanym id
function zatwierdzZam($id){
  global $pdo;
  $sql = "UPDATE zamowienia SET  
          statusZatw = '1'
          WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  try {
    $stmt->execute();
    return true;
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}
// funkcja dodaje do bazy towar
function addTowar($dane) {
  global $pdo;
  $dane['biurowy'] = isset($dane['biurowy']) ? $dane['biurowy'] : "0";
  $sql = "INSERT into towary values (NULL, :idDzial, :nazwa, :cenaZak, :dostawca, :uwagi, :biurowy)";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':idDzial', $dane['idDzial'], PDO::PARAM_INT);
  $stmt->bindValue(':nazwa', $dane['nazwa'], PDO::PARAM_STR);
  $stmt->bindValue(':cenaZak', str_replace(",",".",$dane['cenaZak']), PDO::PARAM_STR);
  $stmt->bindValue(':dostawca', $dane['dostawca'], PDO::PARAM_STR);
  $stmt->bindValue(':uwagi', $dane['uwagi'], PDO::PARAM_STR);
  $stmt->bindValue(':biurowy', $dane['biurowy'], PDO::PARAM_INT);
  try {
    $stmt->execute();
    return true;
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

// funkcja pobiera z bazy informację o wszystkich towarach
function getTowary($warunek = "") {
  $tab = [];
  if ($warunek) {
    $warunek = 'WHERE ' . $warunek;
  }
  global $pdo;
  $tab = [];
  $sql = "SELECT t.*, d.nazwa as dzial from towary t 
          left join dzialy d on d.id = t.idDzial " . $warunek; 
  $stmt = $pdo->prepare($sql);
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    die($e->getMessage());
  }
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $tab[$row['id']] = $row;
  }
  return $tab;
}

// funkcja zmienia towar o podanym id
function updateTowar($dane){
  global $pdo;
  $dane['biurowy'] = isset($dane['biurowy']) ? $dane['biurowy'] : "0";
  $sql = "UPDATE towary SET idDzial   = :idDzial, 
                            nazwa     = :nazwa, 
                            cenaZak   = :cenaZak, 
                            dostawca  = :dostawca, 
                            uwagi     = :uwagi, 
                            biurowy   = :biurowy 
          WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':id', $dane['id'], PDO::PARAM_INT);
  $stmt->bindValue(':idDzial', $dane['idDzial'], PDO::PARAM_INT);
  $stmt->bindValue(':nazwa', $dane['nazwa'], PDO::PARAM_STR);
  $stmt->bindValue(':cenaZak', str_replace(",",".",$dane['cenaZak']), PDO::PARAM_STR);
  $stmt->bindValue(':dostawca', $dane['dostawca'], PDO::PARAM_STR);
  $stmt->bindValue(':uwagi', $dane['uwagi'], PDO::PARAM_STR);
  $stmt->bindValue(':biurowy', $dane['biurowy'], PDO::PARAM_INT);
  try {
    $stmt->execute();
    return true;
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

// funkcja pobiera z bazy informację o wszystkich dzialach
function getDzialy() {
  global $pdo;
  $tab = [];
  $sql = "SELECT * from dzialy "; 
  $stmt = $pdo->prepare($sql);
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    die($e->getMessage());
  }
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $tab[] = $row;
  }
  return $tab;
}