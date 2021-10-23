<?php

class DBController
{
    /*Połączenie z lokalną bazą danych*/
    protected $host = "localhost";
    protected $user = "root";
    protected $password = "";
    protected $database = "shoponline";


    /*connection property*/
    public $con = null;

    /*konstruktor dla klasy DBController*/
    public function  __construct(){
        $this->con = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        if($this->con->connect_error){
            echo "Błąd".$this->con->connect_error;
        }
    }
//
        public function __destruct(){
        $this->closeConnection();
    }

    /*zamknięcie połączenia kiedy obiekt nie jest w użyciu */
    protected function closeConnection(){
        if($this->con != null){
            $this->con->close();
            $this->con = null;
        }
}

}
