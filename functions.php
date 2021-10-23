<?php

/*przywołanie połączenia z bazą danych*/
require ('DB/DBController.php');

/*dołączenie pliku do kodu*/
require ('DB/Product.php');

/*dołączenie pliku do kodu*/
require ('DB/cart.php');

/*obiekt DBController*/
$db = new DBController();

/*obiekt produkty*/
$product = new Product($db);
$product_shuffle= $product->getData();

/*obiekt koszyk*/
$Cart = new Cart($db);