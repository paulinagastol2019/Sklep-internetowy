$(document).ready(function(){  //jQuery code
// banner owl carousel
    $("#baner .owl-carousel").owlCarousel({
        autoPlay: 1000,
        loop:true,
        dots: true,
        items: 1
    });

//polecane na głównej stronie - owl carousel2
    $(".recom .owl-carousel").owlCarousel({
        nav:true,
        dots:false,
        responsive: {
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
        }
    });

//zwiększanie ilości w koszyku
    let $amnt_up = $(".amnt .amnt-up");
    let $amnt_down = $(".amnt .amnt-down");

// zwiększanie - przycisk strzałka w górę
    $amnt_up.click(function(e){
        //zmiana ceny przy zmianie ilości sztuk produktu - ajax call
        $.ajax({url: "template/ajax.php", type : 'post', data : { itemid : $(this).data("id")}, success: function(result){
                console.log(result);
            } });

        let $input = $(`.amnt_input[data-id='${$(this).data("id")}']`);
        if($input.val() >= 1 && $input.val() <= 9){
            $input.val(function(i, oldval){
                return ++oldval;
            });
        }
    });

    // zmniejszanie - przycisk strzałka w dół
    $amnt_down.click(function(e){
        let $input = $(`.amnt_input[data-id='${$(this).data("id")}']`);
        if($input.val() > 1 && $input.val() <= 10){
            $input.val(function(i, oldval){
                return --oldval;
            });
        }
    });



// isotope filter
    var $grid = $(".grid").isotope({
        itemSelector : '.grid-item',
        layoutMode : 'fitRows'
    });

// filtrowanie produktów po kategoriach
    $(".button-group").on("click", "button", function(){
        var filterValue = $(this).attr('data-filter');
        $grid.isotope({ filter: filterValue});
    })

});



