<?php

class BD{
    private $SERVEUR="localhost"; 
    private $BD="taxibokbok"; 
    private $USER="root"; 
    private $MDP="";
    private $bdcon; 
    private $option;
    private $conn;

    public function __construct() {
    }
    public function connexionBD(){
        $this->bdcon='mysql:host='.$this->SERVEUR.';dbname='.$this->BD.';charset=utf8';
        $this->option=array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
        try {
            $this->conn=new PDO($this->bdcon,$this->USER,$this->MDP,$this->option);
        } catch (PDOException $th) {
            die("Erreur de connexion :".$th->getMessage());
        }
    }
    
}