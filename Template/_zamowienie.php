<div class="infoozamowieniu">
    <h4>Dokończ składanie zamówienia</h4>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos
        laboriosam maxime soluta tenetur vitae voluptatum! Aspernatur corporis eius eligendi
        molestiae nisi non optio perspiciatis quis similique voluptatum? Architecto, explicabo,
        illum!Lorem ipsum dolor sit amet, consectetur adipisicing elit.
        Ab alias consectetur eligendi eos labore maiores nisi numquam quam ullam voluptates.
        Blanditiis dignissimos distinctio eaque expedita iusto non, odio reiciendis vero.
        Tutaj podać cene produktów</p>

</div>
<?php
$db = new DBController();
$product = new Product($db);
?>
<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
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
                foreach ($product->getData('koszyk') as $item):
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
                                    </div>
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
                    }, $cart); // zamknięcie funkcji array_map function
                endforeach;
                ?>
            </div>
            <!--sumowanie kosztu produktów-->
            <div class="col-sm-3">
                <div class="sub-total border text-center mt-2">
                    <h6 class="font-size-12 font-rale text-success py-3">Podsumowanie zamówienia</h6>
                    <div class="border-top py-4">
                        <h5 class="font-roboto font-size-20">Kwota zamówienia(<?php echo isset($subTotal)?count($subTotal):0; ?>szt.):&nbsp;<span class="text-danger"><span class="text-danger" id="deal-price"><?php echo isset($subTotal)?$Cart->getSum($subTotal):0 ?></span></span></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<h4>Formularz zamówienia</h4>
<div class="zamowienieform">
    <h4 class="formtitlezamowienie">Dane do wysyłki zamówienia</h4>
    <form method="post" name="zamowienieform1" action="nowezamowienie.php">
        <input type="text"  class="in1zam" name="name1zam" placeholder="Imię i nazwisko"  required/>
        <input type="text" class="in1zam" name="adreszam" placeholder="Adres wysyłki zamówienia "  required/>
        <textarea name="message1zam" class="in1zam" placeholder="" >Kwota zamówienia to: <?php echo isset($subTotal)?$Cart->getSum($subTotal):0?></textarea>
        <button type="submit" name="submitzam" class="btnformzam" >Potwierdź zamówienie!</button>
    </form>
</div>