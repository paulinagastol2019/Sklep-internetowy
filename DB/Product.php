<?php

// klasa do pobierania danych o produkcie
class Product
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) return null;
        $this->db = $db;
    }

    /*pobieranie danych o produkcie za pomocą metody getData*/
    public function getData($table = 'produkty'): array
    {
        $result = $this->db->con->query("SELECT * FROM {$table}");

        $resultArray = array(); //umieszczenie danych w pustej tablicy

        /*pobieranie produktu jeden po drugim z tablicy*/
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }

        return $resultArray;
    }
        /*pobieranie produktu za pomocą id produktu*/
    public function getProduct($id=null,$table='produkty'){
        if(isset($id)){
            $result = $this->db->con->query("SELECT * FROM {$table} WHERE id={$id}");

            $resultArray = array();

            /*pobieranie produktu jeden po drugim*/
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $resultArray[] = $item;
            }
            return $resultArray;
        }
    }
}