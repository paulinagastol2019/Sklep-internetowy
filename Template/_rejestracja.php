<?php

$host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "shoponline";

?>

<?php

session_start();

if(isset($_POST['email']))
{
    //Zalozenie udanej walidacji
    $ok=true;  //flaga

    // sprawdz poprawnosc name - sprawdzenie po kolei poprawności wprowadzonych wartosci do forumularza
    $name = $_POST['name'];

    // sprawdzenie dlugosci imienia
    if ((strlen($name)<3) || (strlen($name)>20)){
    $ok=false;
    $_SESSION['e_name']= "Imię musi posiadać od 3 do 20 znaków!";
    }

    //sprawdz poprawnosc nazwiska
    $surname= $_POST['surname'];

    // sprawdzenie dlugosci nazwiska
    if ((strlen($surname)<3) || (strlen($surname)>20)){
        $ok=false;
        $_SESSION['e_surname']= "Nazwisko musi posiadać od 3 do 20 znaków!";
    }

    //sprawdz poprawność adresu e-mail
    $email = $_POST['email'];
    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);  //sanityzacja kodu

    if((filter_var($emailB,FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
    {
        $ok=false;
        $_SESSION['e_email']="Podaj poprawny adres e-mail!";
    }

    // sprawdz poprawność hasła
    $haslo1= $_POST['haslo1'];
    $haslo2= $_POST['haslo2'];

    if((strlen($haslo1)<8) || (strlen($haslo1)>20))
    {
        $ok=false;
        $_SESSION['e_haslo'] = "Hasło musi posiadać od 8 do 20 znaków!";
    }

    if ($haslo1!=$haslo2)
    {
        $ok=false;
        $_SESSION['e_haslo']="Podane hasła nie są identyczne!";
    }

    $haslo_hash= password_hash($haslo1, PASSWORD_DEFAULT); //haszowanie hasła

    //sprawdzenie czy zatwierdzono checbox z regulaminem

    if(!isset($_POST['regulamin'])){
        $ok=false;
        $_SESSION['e_regulamin'] = "Potwierdź akceptację regulaminu!";
    }

    //reCaptcha - sprawdzenie czy użytkownik nie jest botem - klucz prywatny
    $Skey= "6Ld9fOUcAAAAAG6T0hoMgulGlIEj3J26zH3s4xjv";

    //sprawdzanie odpowiedzi googla czy weryfikacja sie udała, połączenie z serwerem googla
    $sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$Skey.'&response='.$_POST['g-recaptcha-response']);
    $odp = json_decode($sprawdz); // format wymiany danych, przesył danych, do obslugi recaptchy wybrany przez google

    if($odp->success==false) //sprawdzenie czy weryfikacja sie udała
    {
        $ok=false;
        $_SESSION['e_bot'] = "Potwierdź, że nie jesteś botem!";
    }

    require_once "connectdb.php"; // połączenie z bazą w celu sprawdzenia czy juz nie ma konta
    mysqli_report(MYSQLI_REPORT_STRICT);

    try  // przechwycanie wyjątków za pomocą "catch"
    {
        $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
        if($polaczenie->connect_errno!=0)
        {
            throw new Exception(mysqli_connect_errno());
        }
        else{
            //zapytanie czy e-mail już jest w bazie?
            $rezultat = $polaczenie->query("SELECT user_id FROM uzytkownicy WHERE email='$email'");

            if(!$rezultat) throw new Exception($polaczenie->error);

            $ilosc_maili = $rezultat->num_rows;
            if($ilosc_maili>0)
            {
                $ok=false;
                $_SESSION['e_email']="Użytkownik o podanym adresie e-mail już istnieje!";
            }
                if($ok==true){
                //umieszczanie w bazie nowego użytkownika

                if($polaczenie->query("INSERT INTO uzytkownicy VALUES (NULL, '$name','$email','$haslo_hash','$surname',1)"))
                {
                    $_SESSION['pomyslnarejestracja']=true;
                    header('Location: witamy.php');
                }
                else {
                    throw new Exception($polaczenie->error);
                }
            }
            $polaczenie->close();
        }
    }
    catch (Exception $e){
        echo '<span style="color:red;">Błąd serwera! Spróbuj ponownie później.</span>';

    }
}
?>

<main class="rejestr">
    <form method="post">
        Imię: <br/> <input type="text" name="name"/><br/>
        <?php
        if(isset($_SESSION['e_name'])){         //jeżeli nie przechodzi testu to wyświetl błąd
            echo '<div class="error">'.$_SESSION['e_name'].'</div>';
            unset($_SESSION['e_name']);  // wyczyszczenie błędu sesji i wyświetlenie informacji z testu o błędzie
        }
        ?>

        Nazwisko: <br/> <input type="text" name="surname"/><br/>
        <?php
        if(isset($_SESSION['e_surname'])){
            echo '<div class="error">'.$_SESSION['e_surname'].'</div>';
            unset($_SESSION['e_surname']);
        }
        ?>

        E-mail: <br/> <input type="text" name="email"/><br/>
        <?php
        if(isset($_SESSION['e_email'])){
            echo '<div class="error">'.$_SESSION['e_email'].'</div>';
            unset($_SESSION['e_email']);
        }
        ?>

        Twoje hasło: <br/> <input type="password" name="haslo1"/><br/>
        <?php
        if(isset($_SESSION['e_haslo'])){
            echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
            unset($_SESSION['e_haslo']);
        }
        ?>

        Powtórz hasło: <br/> <input type="password" name="haslo2"/><br/>

        <label>
        <input type="checkbox" name="regulamin"/> Akceptuję regulamin
            <?php
            if(isset($_SESSION['e_regulamin'])){
                echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
                unset($_SESSION['e_regulamin']);
            }
            ?>
        </label>
<!--                        klucz witryny recaptcha-->
        <div class="g-recaptcha" data-sitekey="6Ld9fOUcAAAAAJfBtkOvtRqS3gcW8t7mvkyZK92a"></div>
            <?php
            if(isset($_SESSION['e_bot'])){
                echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
                unset($_SESSION['e_bot']);
            }
            ?>
        <br/>
        <input type="submit" class="btnzar" value="Zarejestruj się"/>
    </form>
</main>