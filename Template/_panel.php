<main class="panel">
<?php

session_start();
if (!isset($_SESSION['zalogowany'])) //jeżeli niezalogowany to nie bedzie ustawiona i od razu przekierowuje do logowania
{
    header('Location: login.php');
    exit();

}

echo "<p>Witaj ".$_SESSION['name'].'! [<a href="wylogowanie.php"> Wyloguj się! </a>]</p>'; //wartość zmiennej sesyjnej | podlinkowanie pliku niszczacego sesje - wylogowującego
echo "<p>Twoje dane do wysyłki zamówienia: <br>";
echo "<b>Imię: </b>".$_SESSION['name']."<br>";
echo "<b>Nazwisko: </b>".$_SESSION['surname']."<br>";
echo "<b>Adres: </b>".$_SESSION['adres']."<br>";
echo "<b>Adres e-mail do kontaktu: </b> ".$_SESSION['email']."<br>";
']</p>';
?>
</main>
