<?php
/* klasa koszyk*/
class cart
{
    public $db = null;
    public function __construct(DBController $db)
    {
        if (!isset($db->con)) return null;
        $this->db = $db;
    }

/* wsadzenie produktów do koszyka  - metoda ( do db)*/
    public  function insertIntoCart($params = null, $table = "koszyk")
    {
        if ($this->db->con != null) {
            if ($params != null) {
                $columns = implode(',', array_keys($params));
                $values = implode(',', array_values($params));

                // zapytanie sql
                $query_string = sprintf("INSERT INTO %s(%s) VALUES(%s)", $table, $columns, $values);
                echo $query_string;

                $result = $this->db->con->query($query_string);
                return $result;
            }
        }
    }

    /* (get) user_id oraz item_id do tabeli koszyk*/
    public function addToCart($userid,$itemid){
        if(isset($userid)&&isset($itemid)){
            $params = array(
                "user_id"=> $userid,
                "item_id"=> $itemid
            );
    /* umieszczenie w koszyku*/
            $result = $this->insertIntoCart($params);
            if($result){
                header("Location: " . $_SERVER['PHP_SELF']); // po wywołaniu wraca na tą samą stronę
            }
        }
    }
    /* usuwanie produktu z koszyka*/
    public function deleteCart($id= null, $table='koszyk'){
        if($id != null){
            $result = $this->db->con->query("DELETE FROM {$table} WHERE item_id={$id}");
            if($result){
                header("Location:" .$_SERVER['PHP_SELF']);
            }
            return $result;
        }
    }

    /* sumowanie produktów w koszyku */
    public function getSum($arr){
        $sum=0;
        foreach ($arr as $item){
            $sum += floatval($item[0]);  //wyjaśnić
        }
        return sprintf('%.2f', $sum); //konwertowanie na liczbę
    }

    /*pobranie item_id z listy koszyka*/

    public function getCartId($cartArray = null, $key = "item_id"){ // jezeli w koszyku nie ma tego produktu
                                                                    // to go wsadź, jeżeli ejst to pokaz ze sa zduplikowane
        if($cartArray != null){
            $cart_id = array_map(function ($value) use($key){
                return $value[$key];
            },$cartArray);
            return $cart_id;
        }
    }
    }