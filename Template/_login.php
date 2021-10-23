<?php

session_start();

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
{
    header('Location: panel.php');
    exit();  //opuszczamy plik jeżeli powyższy if jest prawdziwy
}
?>

<main class="login">
    <div class="bg1">
    <a href="rejestracja.php"> Zarejestruj się!</a>
    <form action="zaloguj.php" method="post">
        Login(e-mail): <br/> <input type="text" name="login"/> <br/>
        Hasło: <br/> <input type="password" name="haslo"/> <br/><br/>
        <input type="submit" class="btnlog" value="Zaloguj się">
    </form>
    </div>
    <?php
    if(isset($_SESSION['blad'])) echo $_SESSION['blad']; //jeżeli jest ustawiona zmienna blad pokaż infotmacje o nieprawidlowym logowaniu
    ?>

</main>