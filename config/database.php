<?php
require_once __DIR__ . '/../vendor/autoload.php';

class Database {
    private $clientemongodb;
    private $db;

    public function __construct(){
        try{
            $this->clientemongodb = new MongoDB\client("mongodb+srv://dsi4:PnYCeNJbOq45B5CG@dsi4.i4wtx.mongodb.net/?retryWrites=true&w=majority&appName=dsi4");
           //$this->clientemongodb = new MongoDB\Client("mongodb://localhost:27017/");
           $this->db = $this->clientemongodb->restaurante;
        }catch (Exception $e){
            die("Error en la conexión a MongoDB".$e->getMessage());
        }
    }
    public function getDatabase(){
        return $this->db;
    }
}