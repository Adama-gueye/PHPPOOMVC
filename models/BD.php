<?php
class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $SERVER = "localhost";
        $BD = "gestiondecontacts";
        $USER = "root";
        $MDP = "";
        $bdcon = 'mysql:host=' . $SERVER . ';dbname=' . $BD . ';charset=utf8';
        $option = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        try {
            $this->conn = new PDO($bdcon, $USER, $MDP, $option);
        } catch (PDOException $th) {
            die("Erreur de connexion :" . $th->getMessage());
        }
    }

    // public static function getInstance() {
    //     if (self::$instance === null) {
    //         self::$instance = new self();
    //     }
    //     return self::$instance;
    // }

    public static function getInstance() {
        static $instance = null;
        if ($instance === null) {
            $instance = new Database();
        }
        return $instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}
