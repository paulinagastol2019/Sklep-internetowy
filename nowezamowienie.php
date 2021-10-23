<?php
if (isset($_POST['submitzam'])) {
    $name1 = $_POST['name1zam'];
    $adreszam = $_POST['adreszam'];
    $message1 = $_POST['message1zam'];

    $mailTo1 = "p.pasaz@interia.pl";

    $headers1 = "From: ".$adreszam;
    $txt1 = "Nowe zamówienie od ". $name1.".\n\n";

    mail($mailTo1, $txt1, $headers1, $message1);
    header("Location: podziekowaniezazamowienie.php");
}
