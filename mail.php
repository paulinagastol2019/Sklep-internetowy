<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name1'];
    $emailFrom= $_POST['emailFrom'];
    $message = $_POST['message1'];

    $mailTo = "p.pasaz@interia.pl";

    $headers = "From: ".$emailFrom;
    $txt = "Nowa wiadomość e-mail od ". $name.".\n\n";

    mail($mailTo, $txt, $headers, $message);
    header("Location: potwierdzeniewyslaniawiadomosci.php");
}