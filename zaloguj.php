<?php
session_start();

if((!isset($_POST['login'])) || (!isset($_POST['haslo']))) //jeżeli nie ma login i haslo to przekieruj od razu do logowania
{
    header('Location: login.php');
    exit(); // zakańcza jeżeli if nie jest spełniony
}

require_once "connectdb.php";
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name); //ustanowienie polaczenia z bazą przy użyciu instancji klasy msqli

if($polaczenie->connect_errno!=0){
    echo "Error: ".$polaczenie->connect_errno;
}
else {
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];
    $login = htmlentities($login, ENT_QUOTES,"UTF-8");

    if ($rezultat = @$polaczenie->query(
        sprintf("SELECT * FROM uzytkownicy WHERE email='%s'",
    mysqli_real_escape_string($polaczenie,$login))))
    {
        $ilu_userów = $rezultat->num_rows;
        if($ilu_userów>0){

            $wiersz = $rezultat->fetch_assoc(); // tablica przechowująca dane pobrane z bazy - tablica asocjacyjna
                if(password_verify($haslo, $wiersz['pass']))
                {
                $_SESSION['zalogowany'] = true;
                $_SESSION['id'] = $wiersz['user_id'];
                $_SESSION['name'] = $wiersz['name'];
                $_SESSION['email'] = $wiersz['email'];
                $_SESSION['surname'] = $wiersz['surname'];
                $_SESSION['adres'] = $wiersz['adres'];

                unset($_SESSION['blad']);
                $rezultat->free_result();
                header('Location: panel.php'); //przekierowanie
                }
                else
                {
                    $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>'; // dobry login, zle haslo
                    header('Location: login.php'); //przekierowanie do logowania
                }

        } else {

            $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';  // zly login i obojetmie jakie haslo
            header('Location: login.php');
        }
    }
    $polaczenie->close(); //zamkniecie połaczenia z bazą
}

?>