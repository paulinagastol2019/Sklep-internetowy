<?php
$db = new DBController();
/*obiekt produktu*/
$product = new Product($db);
/*obiekt koszyka*/
$Cart = new Cart($db);
?>

<?php
    $product_shuffle = $product->getData();
    shuffle($product_shuffle);

/* metoda post - dodanie do koszyka po wcisnieciu przycisku o recom_submit*/
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if (isset($_POST['recom_submit'])){
        // wywołanie metody addToCart
        $Cart->addToCart($_POST['user_id'], $_POST['item_id']);
    }
}
?>

<!--produkty polecane - style bootstrap-->
<section class="recom">
    <div class="container py-5">
        <h4 class="font-roboto font-size-10">Polecane</h4>
        <hr>

        <!-- owl carousel 2 - produkty-->
        <div class="owl-carousel owl-theme">
            <?php foreach ($product_shuffle as $item){?>  <!-- otwarcie foreacha-->
            <div class="product font-realway">
                <!-- php w atrybucie powoduje pobranie danych dla każdego produkty o danym id-->
            <a href="<?php printf('%s?item_id=%s', 'product.php',  $item['id']); ?>"><img src="<?php echo $item['item_image'] ??"./images/product1.jpg";?>" alt="product" class="img-fluid"></a>
            <div class="text-center">
                <h6><?php echo $item['item_name']??"Unknown";?></h6>
                <div class="rating text-warning font-size-10">
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="far fa-star"></i></span>
                </div>
                <div class="price py-2">
                    <span><?php echo $item['item_price']??'0'; ?></span>
                </div>
                <form method="post">
                    <input type="hidden" name="item_id" value="<?php echo $item['id']?? 1;?>">
                    <input type="hidden" name="user_id" value="<?php echo 1;?>">
                    <?php
                    //jeżeli do koszyka jest dodany produkt to zmień button na zielony
                    if(in_array($item['id'],$Cart->getCartId($product->getData('koszyk')) ?? [])){
                        echo '<button type="submit" name="recom_submit" disabled class="btn btn-success font-size-10">W koszyku!</button>';

                    }else{
                        echo '<button type="submit" name="recom_submit" class="btn btn-warning font-size-10">Dodaj do koszyka</button>';

                    }
                    ?>
                </form>
            </div>
        </div>
            <?php } ?>  <!--zamknięcie foreacha-->
    </div>
</section>