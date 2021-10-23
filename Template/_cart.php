<?php
$db = new DBController();
$product = new Product($db);
?>
<?php
if($_SERVER['REQUEST_METHOD']=='POST'){   //jeżeli button posiada id delete-cart-submit to wykonaj
    if(isset($_POST['delete-cart-submit'])){
        $deletedrecord = $Cart->deleteCart($_POST['id']);
    }
}
?>
<!--sekcja zakupu-->
<section id="cart" class="py-3">
    <div class="container-fluid w-75">
        <h5 class="font-roboto font-size-20">Koszyk</h5>

        <!-- produkty-->
        <div class="row">
            <div class="col-sm-9">
                <?php
                foreach ($product->getData('koszyk') as $item):  //rozpoczęcie foreacha
                    $cart = $product->getProduct($item['item_id']);
                    $subTotal[] = array_map(function ($item){
                    ?>
                <!--produkt w koszyku-->
                <div class="row border-top py-3 mt-3">
                    <div class="col-sm-2">
                        <img src="<?php echo $item['item_image']??"./images/product1.jpg"?>" style="height: 120px;" alt="koszyk" class="img-fluid">
                    </div>
                    <div class="col-sm-8">
                        <h5 class="font-roboto font-size-20"><?php echo $item['item_name']??"Unknown"?></h5>
                        <small>by H Company</small>
                        <div class="d-flex">
                            <div class="rating text-warning font-size-10">
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="far fa-star"></i></span>
                            </div>
                        </div>

                        <!-- zwiększanie ilości produktów-->
                        <div class="amnt d-flex pt-2">
                            <div class="d-flex font-roboto w-25">
                                <button class="amnt-up border px-1 bg-light" data-id="pro1 <?php echo $item['id']??'0'?>"><i class="fas fa-angle-up"></i></button>
                                    <input type="text" data-id="pro1 <?php echo $item['id']??'0' ?>" class="amnt_input border w-100 bg-light" disabled value="1" placeholder="1">
                                <button data-id="pro1 <?php echo $item['id']??'0' ?>" class="amnt-down border px-1 bg-light"><i class="fas fa-angle-down"></i></button>
                            </div>
                            <form method="post">
                                <input type="hidden" value="<?php echo $item['id']?? '0' ?>" name="id">
                                <button type="submit" name="delete-cart-submit" class="btn font-roboto text-danger px-3 border-right">Usuń z koszyka</button>
                            </form>
                        </div>

                        <!--cena produktu-->
                    </div>
                    <div class="col-sm-2">
                        <div class="font-size-20 text-dark font-roboto">
                            <span class="price"><?php echo $item['item_price']??0?></span>
                        </div>
                    </div>
                </div>
                <?php
                        return $item['item_price'];
                    }, $cart); // zamknięcie funkcji array_map function i foreacha
                    endforeach;
                ?>
            </div>
            <!--sumowanie kosztu produktów-->
                    <div class="col-sm-3">
                        <div class="sub-total border text-center mt-2">
                            <h6 class="font-size-12 font-rale text-success py-3">Podsumowanie zamówienia</h6>
                            <div class="border-top py-4">
                                <h5 class="font-roboto font-size-20">Ilość produktów w koszyku(<?php echo isset($subTotal)?count($subTotal):0; ?>szt.):&nbsp;<span class="text-danger"><span class="text-danger" id="deal-price"><?php echo isset($subTotal)?$Cart->getSum($subTotal):0 ?></span></span></h5>
                                <button type="submit" class="btn btn-warning mt-3"><a href="zamowienie.php">Złóż zamówienie</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</section>