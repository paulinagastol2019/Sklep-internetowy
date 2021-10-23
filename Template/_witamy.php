<?php
session_start();

if(!isset($_SESSION['pomyslnarejestracja']))
{
 header('Location: login.php');
 exit();
}
else
{
    unset($_SESSION['pomyslnarejestracja']);
}
?>

<main class="podziekowanie">
    <h4>Dziękujęmy za rejestrację w serwisie!</h4>
    <a href="login.php"> >> Zaloguj się na swoje konto! << </a>
</main>
