<?php
$db = new DBController();
$product = new Product($db);
?>

<?php
    $item_id= $_GET['item_id']?? 1;
    foreach ($product->getData()as $item):
    if($item['id'] == $item_id):    //rozpoczęcie foreacha
?>
       <?php
        if($_SERVER['REQUEST_METHOD'] == "POST"){
        if (isset($_POST['products_submit'])){
        // wywołanie metody addToCart
        $Cart->addToCart($_POST['user_id'], $_POST['item_id']);
        }
        } ?>

<!-- produkt i jego opis-->
<section id="product" class="py-3">  <!--przyciski -->
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <img src="<?php echo $item['item_image']??"./images/product1.jpg"?>" alt="produkt" class="img-fluid">
                <div class="form-row pt-4 font-size-16 font-roboto">
                    <div class="col">
                        <form method="post">
                            <input type="hidden" name="item_id" value="<?php echo $item['id']?? 1;?>">
                            <input type="hidden" name="user_id" value="<?php echo 1;?>">
                            <?php
                            if(in_array($item['id'],$Cart->getCartId($product->getData('koszyk')) ?? [])){
                                echo '<button type="submit" name="recom_submit" disabled class="btn btn-lg btn-block btn-success font-size-10">W koszyku!</button>';

                            }else{
                                echo '<button type="submit" name="products_submit" class="btn btn-lg btn-block btn-warning font-size-10">Dodaj do koszyka</button>';
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 py-3"> <!--inofrmacje o produkcie-->
                <h5 class="font-roboto font-size-20"><?php echo $item['item_name']??"Unknown"; ?></h5>
                <small>by H Company</small>
                <div class="d-fle">
                    <div class="rating text-warning font-size-10">
                        <span><i class="fas fa-star"></i></span>
                        <span><i class="fas fa-star"></i></span>
                        <span><i class="fas fa-star"></i></span>
                        <span><i class="fas fa-star"></i></span>
                        <span><i class="far fa-star"></i></span>
                    </div>
                </div>
                <hr class="m-o">
                <!--cena produktu-->
                <table class="my-3">
                    <tr class="font-roboto font-size-14 py-2">
                        <td>Cena: </td>
                        <td class="font-size-20 text-dark"><span><?php echo $item['item_price']??'0'; ?> </span></td>
                    </tr>
                    <!-- informacje-->
                    <div class="policy">
                        <div class="d-flex">
                            <div class="return text-center mr-5">
                                <div class="font-size-12 my-2 color-second">
                                    <span class="fas fa-retweet border p-3 "></span>
                                </div>
                                <a href="#" class="font-roboto font-size-9">7 dni<br>na zwrotu</a>
                            </div>
                            <div class="return text-center mr-5">
                                <div class="font-size-12 my-2 color-second">
                                    <span class="fas fa-truck border p-3 "></span>
                                </div>
                                <a href="#" class="font-roboto font-size-9">Wysyłka 24h</a>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <!--opis produktu-->
                </table>
                <table class="my-3">
                    <tr class="font-roboto font-size-14"> Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Accusamus adipisci culpa error, labore libero neque porro quasi voluptate? Aliquid amet
                        exercitationem natus nostrum obcaecati odio reiciendis voluptas. Accusamus, error, vero!

                    </tr>
                </table>

                <div class="col-6">
                    <!-- wybór ilości produktu-->
                    <div class="amnt d-flex">
                        <h6 class="font-baloo">Ilość</h6>
                        <div class="px-4 d-flex font-rale">
                            <button class="amnt-up border bg-light" data-id="pro1"><i class="fas fa-angle-up"></i></button>
                                <input type="text" data-id="pro1" class="amnt_input border px-2 w-50 bg-light" disabled value="1" placeholder="1">
                            <button data-id="pro1" class="amnt-down border bg-light"><i class="fas fa-angle-down"></i></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<?php

    endif;
    endforeach;
        ?>   <!--zakończenie foreacha-->