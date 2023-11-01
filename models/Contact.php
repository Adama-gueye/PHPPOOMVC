<?php
include_once('BD.php');
class Contact extends BD{
    private $erreur = [];
    private $erreur2 = [];
    private $conn;

    public function __construct() {
        $this->connectBD();
    }
    function connectBD() {
        $SERVER="localhost"; 
        $BD="gestiondecontacts"; 
        $USER="root"; 
        $MDP=""; 
        $bdcon='mysql:host='.$SERVER.';dbname='.$BD.';charset=utf8';
        $option=array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
        try {
             $this->conn=new PDO($bdcon,$USER,$MDP,$option);
        } catch (PDOException $th) {
            die("Erreur de connexion :".$th->getMessage());
        }
        
    }

    public function ajout($nom,$prenom,$tel){
        $conn =$this->conn;
        
        $req = "INSERT INTO contact(id,nom,prenom,tel) VALUES (NULL,'$nom','$prenom','$tel')";
        $resul = $conn->exec($req);
        echo "<h3 style='text-align : center; color : green'>Contact Enregistré avec succes</h3>"; 
        echo "<h3 style='text-align : center; color : red'>".implode(". ",$this->erreur)."</h3>";
    }
    public function modif($nom,$prenom,$tel,$id){
        $conn =$this->conn;
        if(empty($nom)|| empty($prenom)|| empty($tel)){
            $this->erreur[]= "Tout les champs sont obligatoires";
        }
        elseif((!(preg_match("/^(77|78|76|75)+[0-9]/", $tel)) || strlen($tel)!=9)){
            $this->erreur[]= "Veuillez enregistré un numéro de téléphone valide";
        }elseif((!(preg_match('/[a-zA-Zéè]$/', $nom)))||(!(preg_match('/[a-zA-Zéè]$/', $prenom))) || strlen($nom)<2 || strlen($prenom)<3){
            $this->erreur[]= "Une erreur s'est produite sur la saisie de votre nom ou de votre prénom";
        }
        else{
        $req = "UPDATE contact SET nom = '$nom', prenom = '$prenom', tel = '$tel' where id = $id";
        $resul = $conn->exec($req);
        echo "<h3 style='text-align : center; color : green'>Contact Modifié avec succes</h3>"; 
        }
        echo "<h3 style='text-align : center; color : red'>".implode(". ",$this->erreur)."</h3>";
    }

    public function sup($id){
        $conn =$this->conn;
        $req = "DELETE FROM contact WHERE id = $id";
        $resul = $conn->exec($req);
        echo "<h3 style='text-align : center; color : green'>Contact Supprimé avec succes</h3>";
    }
    public function getContactById($id){
        $conn =$this->conn;
        $req = "SELECT * from contact where id = $id";
        return $conn->query($req)->fetch();
    }
    public function favoris($id){
        $conn =$this->conn;
        $req = "UPDATE contact SET favori = 1 where id = $id";
        return $conn->exec($req);
    }
    public function defavoris($id){
        $conn =$this->conn;
        $req = "UPDATE contact SET favori = 0 where id = $id";
        return $conn->exec($req);
    }
    public function listeFavoris(){
        $conn =$this->conn;
        $req = "SELECT * from contact where favori = 1";
        return $conn->query($req)->fetchAll();
    }

    function listeContact() {
        $conn = $this->conn;
        $req = "SELECT * FROM contact";
        return $conn->query($req)->fetchAll();
    }
    function connexion($nomU, $mdp)
    {
        $conn = $this->conn;
        if(empty($nomU)|| empty($mdp))
            { $this->erreur2[]= "Tout les champs sont obligatoires";
            }
            elseif(!(preg_match('/[-0-9a-zA-Z.+_à^]+@[-0-9a-zA-Z.+_]+.[a-z]{2,4}/', $nomU))) {
                $this->erreur2[]= "Veuillez enregistré un bon mail";
            }else{
                $req = "SELECT * FROM user where nomU = '$nomU' and mdp = '$mdp'";
                $resul = $conn->query($req)->fetch();
                if($resul!=null){
                    $_SESSION['id'] = $resul['id'];
                    $_SESSION['nom'] = $resul['nom'];
                    $_SESSION['prenom'] = $resul['prenom'];
                    header("location:index.php");
                }else  $erreur[]= "Login ou Mot de Passe incorrect !";
     }
     echo "<h3 style='text-align : center; color : red'>".implode(". ",$this->erreur2)."</h3>";
        
    }
}