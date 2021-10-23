<?php
$db = new DBController();
$product = new Product($db);
$Cart = new Cart($db);
?>
<?php
$product_shuffle = $product->getData();
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if (isset($_POST['promo_price_submit'])){
        // wywołanie metody addToCart
        $Cart->addToCart($_POST['user_id'], $_POST['item_id']);
    }
}

$in_cart = $Cart->getCartId($product->getData('koszyk'));

?>
<!--promocja i wszystkie produkty- -->
<a id="etyk"></a>
<section class="promo-price">
    <div class="container">
        <h4 class="font-roboto font-size-10">Produkty - wszystkie i przecenione</h4>
        <div id="filters" class="button-group text-center">
            <button class="btn" data-filter=".Mydla">Mydła</button>  <!--dodanie atrybutu do filtrowania-->
            <button class="btn" data-filter=".Reczniki">Ręczniki</button>
            <button class="btn" data-filter=".Plyny">Płyny i szampony</button>
            <button class="btn is-checked" data-filter="*">Wszystkie</button>
        </div>

        <!-- dołączenie funkcji która pozwala filtrować po naciśnięciu przycisku-->
        <div class="grid">
            <?php array_map(function ($item) use($in_cart){?>  <!--otwarcie funkcji array map-->
            <div class="grid-item border <?php echo $item['item_brand'] ?? "Brand"?>">
                <div class="item py-2" style="width:200px;">
                    <div class="product font-raleway">
                        <a href="<?php printf('%s?item_id=%s', 'product.php',  $item['id']); ?>"><img src="<?php echo $item['item_image'] ??"./images/product3.jpg";?>" alt="mydła różne" class="img-fluid"></a>
                        <div class="text-center">
                            <h6><?php echo $item['item_name'] ?? "Unknown"; ?></h6>
                            <div class="rating text-warning font-size-10">
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="far fa-star"></i></span>
                            </div>
                            <div class="price py-2">
                                <span><?php echo $item['item_price'] ?? "0"; ?></span>
                            </div>
                            <form method="post">
                                <input type="hidden" name="item_id" value="<?php echo $item['id']?? 1;?>">
                                <input type="hidden" name="user_id" value="<?php echo 1;?>">
                                <?php
                                if(in_array($item['id'],$in_cart?? [])){
                                    echo '<button type="submit" name="recom_submit" disabled class="btn btn-success font-size-10">W koszyku!</button>';

                                }else{
                                    echo '<button type="submit" name="recom_submit" class="btn btn-warning font-size-10">Dodaj do koszyka</button>';

                                }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <?php }, $product_shuffle) ?> <!--zamknięcie funkcji array map-->
        </div>
</section>