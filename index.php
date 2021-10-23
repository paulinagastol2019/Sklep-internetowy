<?php
ob_start();
include ('header.php');
?>

<?php
/*skecja baneru głównego*/
include ('Template/_baner.php');

/*sekcja rekomendowanych produktów*/
include ('Template/_recom.php');

/*sekcja produktów na promocji*/
include ('Template/_promo-price.php');

/*sekcja banerów informacyjnych*/
include ('Template/_banner-adds.php');
?>

<?php
/*stopka*/
include ('footer.php');
?>