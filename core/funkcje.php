<?php
function dd($string){
  die(var_dump($string));
}

function zaloguj($dane){
  global $pdo;
  $row = "";
  $sql = "SELECT * FROM personel WHERE login = :login";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':login', $dane['login'], PDO::PARAM_STR);
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    die($e->getMessage());
  }
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if (isset($row['login']) && $row['haslo'] == $dane['haslo']){
    $_SESSION[APP_NAME]['auth'] = 'true';
    $_SESSION[APP_NAME]['loginTime'] = time();
    $_SESSION[APP_NAME]['imie'] = $row['imie'];
    $_SESSION[APP_NAME]['nazwisko'] = $row['nazwisko'];
    $_SESSION[APP_NAME]['idOsoby'] = $row['id'];
    $_SESSION[APP_NAME]['idDzial'] = $row['idDzial'];
    $_SESSION[APP_NAME]['realBiuro'] = $row['realBiuro'];
    $_SESSION[APP_NAME]['uAdmin'] = $row['uAdmin'];
    // uprawnienia wyciagamy w odwrotnej kolejności niż w bazie aby pracownik mial najnizsze 000001
    $_SESSION[APP_NAME]['upr'] = bindec($row['uAdmin'].$row['uPrez'].$row['uKsieg'].$row['uZampub'].$row['uKier'].$row['uPrac']);
    return $_SESSION;
  } else {
    return false;
  }
}


// funkcja sprawdza czy sesja jest wciaż aktywan jeśli nie to wylogowuje
function sprawdzSesje () {
  session_start();
  if (!isset($_SESSION[APP_NAME]['auth'])) {
    header("Location:". SITEROOT . "/core/login.php");
  } else {
    if ((time() - $_SESSION[APP_NAME]["loginTime"]) > TIMEOUT) {   //sprawdzamy kiedy ostatni raz byla aktywnosc
      header("Location:". SITEROOT . "/core/logout.php"); // jesli powyzej TIMEOUT sekund to wylogowujemy
    } else {
      $_SESSION[APP_NAME]["loginTime"] = time();
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
  $sql = "INSERT into zamowienia values (NULL, :idOsoby, CURDATE(), :idTowaru, :cenaZak, :cel, :ilosc, '0', :kosztOpis, :kosztCena, '0', '0', '0000-00-00', '0', '0000-00-00', '0', '0000-00-00', '0', '0000-00-00', '0', '0000-00-00')";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':idOsoby', $dane['idOsoby'], PDO::PARAM_INT);
  $stmt->bindValue(':idTowaru', $dane['idTowaru'], PDO::PARAM_INT);
  $stmt->bindValue(':cenaZak', str_replace(",",".",$dane['cenaZak']), PDO::PARAM_INT);
  $stmt->bindValue(':cel', $dane['cel'], PDO::PARAM_STR);
  $stmt->bindValue(':ilosc', $dane['ilosc'], PDO::PARAM_INT);
  $stmt->bindValue(':kosztOpis', $dane['kosztOpis'], PDO::PARAM_STR);
  $stmt->bindValue(':kosztCena', str_replace(",",".",$dane['kosztCena']), PDO::PARAM_INT);
  try {
  	$stmt->execute();
  	return $pdo->lastInsertId();
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
  $sql = "SELECT z.*, t.nazwa, p.imie, p.nazwisko, p.idDzial from zamowienia z
          join towary t on z.idTowaru = t.id 
          join personel p on z.idOsoby = p.id " . $warunek; 
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

//funkcja updateuje zamowienie akceptacją zgodnie z wartością zmiennej typ
function akceptujZamowienie($idZam, $typ, $ok = true){
  global $pdo;
  if ($typ == 'akcKie') $sql = "UPDATE zamowienia SET akcKie= :id, dataAkcKie='" . date('Y-m-d') . "' WHERE id = :idZam";
  if ($typ == 'akcZam') $sql = "UPDATE zamowienia SET akcZam= :id, dataAkcZam='" . date('Y-m-d') . "' WHERE id = :idZam";
  if ($typ == 'akcKsie') $sql = "UPDATE zamowienia SET akcKsie= :id, dataAkcKsie='" . date('Y-m-d') . "' WHERE id = :idZam";
  if ($typ == 'akcPre') $sql = "UPDATE zamowienia SET akcPre= :id, dataAkcPre='" . date('Y-m-d') . "' WHERE id = :idZam";
  $stmt = $pdo->prepare($sql);
  if ($ok == 'true') {
    $stmt->bindValue(':id', $_SESSION[APP_NAME]['idOsoby'], PDO::PARAM_INT);
  } else {
    $stmt->bindValue(':id', $_SESSION[APP_NAME]['idOsoby']*(-1), PDO::PARAM_INT);  //jesli zamiast akcepbacji mamy odrzucenie to dodajemy liczbę przeciwną zam 10 -10
  }
  $stmt->bindValue(':idZam', $idZam, PDO::PARAM_INT);
  try {
    $stmt->execute();
    return true;
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}
//funkcja updateuje zamowienie - zmienia status na zrealizowane
function realizujZamowienie($dane){
  global $pdo;
  if (($dane['iloscZreal'] + $dane['iloscZak']) == $dane['ilosc']){
    $sql = "UPDATE zamowienia SET iloscZreal = '" . $dane['ilosc'] . "',
                                  statusReal = '1', 
                                  dataReal='" . date('Y-m-d') . "' 
                              WHERE id = :idZam";
  } else {
    $sql = "UPDATE zamowienia SET iloscZreal = '" . ($dane['iloscZreal'] + $dane['iloscZak']) . "'
                          WHERE id = :idZam";
  };
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':idZam', $dane['id'], PDO::PARAM_INT);
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
    $tab[$row['id']] = $row;
    //$tab[$row['id']] = $row['nazwa'];
  }
  return $tab;
}

// funkcja pobiera z bazy informację o wszystkich komentarzach
function getKomentarze($warunek = "") {
  $tab = [];
  if ($warunek) {
    $warunek = 'WHERE ' . $warunek;
  }
  global $pdo;
  $sql = "SELECT * from  komentarze " . $warunek . " ORDER BY data DESC";
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

// funkcja dodaje do bazy komentarz
function addKomentarz($dane) {
  global $pdo;
  $sql = "INSERT into komentarze values (NULL, :idZam, :idOsoby, :imieNazwisko, NOW(),  :komentarz, :ok)";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':idZam', $dane['idZam'], PDO::PARAM_STR);
  $stmt->bindValue(':komentarz', $dane['komentarz'], PDO::PARAM_STR);
  $stmt->bindValue(':imieNazwisko', $dane['imieNazwisko'], PDO::PARAM_STR);
  $stmt->bindValue(':ok', $dane['ok'], PDO::PARAM_INT);
  $stmt->bindValue(':idOsoby', $dane['idOsoby'], PDO::PARAM_INT);
  try {
    $stmt->execute();
    return true;
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

// funkcja zwraca najwyższe uprawnienie danej osoby 
function getPozycja() {
  $poz = '';
  $poz =  ($_SESSION[APP_NAME]['upr']  & PRACOWNIK) > 0  ? 'akcPra' : $poz;
  $poz =  ($_SESSION[APP_NAME]['upr']  & KIEROWNIK) > 0  ? 'akcKie' : $poz;
  $poz =  ($_SESSION[APP_NAME]['upr']  & ZAM_PUB) > 0  ? 'akcZam' : $poz;
  $poz =  ($_SESSION[APP_NAME]['upr']  & KSIEGOWY) > 0  ? 'akcKsie' : $poz;
  $poz =  ($_SESSION[APP_NAME]['upr']  & PREZES) > 0  ? 'akcPre' : $poz;
  return $poz;
}

// funkcja pobiera z bazy informację o wszystkich pracownikach
function getPersonel($warunek = "") {
  global $pdo;
  $tab = [];
  if ($warunek) {
    $warunek = 'WHERE ' . $warunek;
  }
  $sql = "SELECT *  from personel " . $warunek;
  $stmt = $pdo->prepare($sql);
  try {
    $stmt->execute();
  } catch (PDOException $e) {
    die($e->getMessage());
  }
  if ($warunek) {
    $tab = $stmt->fetch(PDO::FETCH_ASSOC);
  } else {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $tab[$row['id']] = $row;
    }
  }
  return $tab;
}



// funkcja dodaje do bazy nowego pracownika
function addPersonel($dane) {
  global $pdo;
  $dane['uPrac'] = isset($dane['uPrac']) ? $dane['uPrac'] : "0";
  $dane['uKier'] = isset($dane['uKier']) ? $dane['uKier'] : "0";
  $dane['uKsieg'] = isset($dane['uKsieg']) ? $dane['uKsieg'] : "0";
  $dane['uKsieg'] = isset($dane['uKsieg']) ? $dane['uKsieg'] : "0";
  $dane['uZampub'] = isset($dane['uZampub']) ? $dane['uZampub'] : "0";
  $dane['uPrez'] = isset($dane['uPrez']) ? $dane['uPrez'] : "0";
  $dane['uAdmin'] = isset($dane['uAdmin']) ? $dane['uAdmin'] : "0";
  $dane['realBiuro'] = isset($dane['realBiuro']) ? $dane['realBiuro'] : "0";
  $dane['haslo'] = md5($dane['haslo']);
  $sql = "INSERT into personel values (NULL, :imie, :nazwisko, :email, :login, :haslo, :idDzial, :uPrac, :uKier, :uZampub, :uKsieg, :uPrez, :uAdmin, :realBiuro)";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':imie', $dane['imie'], PDO::PARAM_STR);
  $stmt->bindValue(':nazwisko', $dane['nazwisko'], PDO::PARAM_STR);
  $stmt->bindValue(':email', $dane['email'], PDO::PARAM_STR);
  $stmt->bindValue(':login', $dane['login'], PDO::PARAM_STR);
  $stmt->bindValue(':haslo', $dane['haslo'], PDO::PARAM_STR);
  $stmt->bindValue(':idDzial', $dane['idDzial'], PDO::PARAM_INT);
  $stmt->bindValue(':uPrac', $dane['uPrac'], PDO::PARAM_INT);
  $stmt->bindValue(':uKier', $dane['uKier'], PDO::PARAM_INT);
  $stmt->bindValue(':uZampub', $dane['uZampub'], PDO::PARAM_INT);
  $stmt->bindValue(':uKsieg', $dane['uKsieg'], PDO::PARAM_INT);
  $stmt->bindValue(':uPrez', $dane['uPrez'], PDO::PARAM_INT);
  $stmt->bindValue(':uAdmin', $dane['uAdmin'], PDO::PARAM_INT);
  $stmt->bindValue(':realBiuro', $dane['realBiuro'], PDO::PARAM_INT);
  try {
    $stmt->execute();
    return true;
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}

// funkcja aktualizuje pracownika
function updatePersonel($dane) {
  global $pdo;
  $dane['uPrac'] = isset($dane['uPrac']) ? $dane['uPrac'] : "0";
  $dane['uKier'] = isset($dane['uKier']) ? $dane['uKier'] : "0";
  $dane['uKsieg'] = isset($dane['uKsieg']) ? $dane['uKsieg'] : "0";
  $dane['uKsieg'] = isset($dane['uKsieg']) ? $dane['uKsieg'] : "0";
  $dane['uZampub'] = isset($dane['uZampub']) ? $dane['uZampub'] : "0";
  $dane['uPrez'] = isset($dane['uPrez']) ? $dane['uPrez'] : "0";
  $dane['uAdmin'] = isset($dane['uAdmin']) ? $dane['uAdmin'] : "0";
  $dane['realBiuro'] = isset($dane['realBiuro']) ? $dane['realBiuro'] : "0";
  if($dane['haslo'] != ""){  //jesli haslo nie puste to zmieniamy też haslo jesli puste to hasla nie zmieniamy
    $dane['haslo'] = md5($dane['haslo']);
    $sql = "UPDATE personel SET imie = :imie, nazwisko = :nazwisko, email = :email, login = :login, haslo = :haslo, idDzial = :idDzial,
                              uPrac = :uPrac, uKier = :uKier, uZampub = :uZampub, uKsieg = :uKsieg, uPrez = :uPrez, uAdmin = :uAdmin, realBiuro = :realBiuro
                          WHERE id = :id";
  } else {
    $sql = "UPDATE personel SET imie = :imie, nazwisko = :nazwisko, email = :email, login = :login, idDzial = :idDzial,
                              uPrac = :uPrac, uKier = :uKier, uZampub = :uZampub, uKsieg = :uKsieg, uPrez = :uPrez, uAdmin = :uAdmin, realBiuro = :realBiuro
                            WHERE id = :id";
  }

  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':id', $dane['id'], PDO::PARAM_INT);
  $stmt->bindValue(':imie', $dane['imie'], PDO::PARAM_STR);
  $stmt->bindValue(':nazwisko', $dane['nazwisko'], PDO::PARAM_STR);
  $stmt->bindValue(':email', $dane['email'], PDO::PARAM_STR);
  $stmt->bindValue(':login', $dane['login'], PDO::PARAM_STR);
  if($dane['haslo'] != "") {
    $stmt->bindValue(':haslo', $dane['haslo'], PDO::PARAM_STR);
  }
  $stmt->bindValue(':idDzial', $dane['idDzial'], PDO::PARAM_INT);
  $stmt->bindValue(':uPrac', $dane['uPrac'], PDO::PARAM_INT);
  $stmt->bindValue(':uKier', $dane['uKier'], PDO::PARAM_INT);
  $stmt->bindValue(':uZampub', $dane['uZampub'], PDO::PARAM_INT);
  $stmt->bindValue(':uKsieg', $dane['uKsieg'], PDO::PARAM_INT);
  $stmt->bindValue(':uPrez', $dane['uPrez'], PDO::PARAM_INT);
  $stmt->bindValue(':uAdmin', $dane['uAdmin'], PDO::PARAM_INT);
  $stmt->bindValue(':realBiuro', $dane['realBiuro'], PDO::PARAM_INT);
  try {
    $stmt->execute();
    return true;
  } catch (PDOException $e) {
    die($e->getMessage());
  }
}