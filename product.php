<?php
ob_start();
/*header*/
include ('header.php');
?>

<?php
$db = new DBController();
/*Obiekt produkt*/
$product = new Product($db);
?>

<?php
/*sekcja produktów*/
include ('Template/_products.php');
/*sekcja rekomendowanych produktów*/
include ('Template/_recom.php');
?>

<?php
/*stopka*/
include ('footer.php');
?>
