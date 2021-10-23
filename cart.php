<?php
ob_start();
/*header*/
include ('header.php');
?>


<?php
/*koszyk*/
include ('Template/_cart.php');
?>
<?php
/*sekcja rekomendowanych produktów*/
include ('Template/_recom.php');
?>

<?php
/*stopka*/
include ('footer.php');
?>
