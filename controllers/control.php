<?php
session_start();
include ('../models/Contact.php');
$contacts = new Contact();

if (isset($_GET['deconnexion'])) {
    session_unset();
    header("location:http://localhost/simplon/PHP%20-%20MVC%20-%20POO/views/auth.php");
}

if (isset($_POST['btnAjout'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $tel = $_POST['tel'];
    $erreur = [];

    if (empty($nom) || empty($prenom) || empty($tel)) {
        $erreur[] = "Tous les champs sont obligatoires";
    }

    if (!(preg_match("/^(77|78|76|75)+[0-9]/", $tel) && strlen($tel) == 9)) {
        $erreur[] = "Veuillez enregistrer un numéro de téléphone valide";
    }

    if (!(preg_match('/[a-zA-Zéè]$/', $nom) && preg_match('/[a-zA-Zéè]$/', $prenom) && strlen($nom) >= 2 && strlen($prenom) >= 3)) {
        $erreur[] = "Une erreur s'est produite sur la saisie de votre nom ou de votre prénom";
    }

    if (empty($erreur)) {
        $contacts->ajout($nom, $prenom, $tel);
        header('location: http://localhost/simplon/PHP%20-%20MVC%20-%20POO/views/ajout.php');
    } else {
        echo "<h3 style='text-align : center; color : red'>".implode(". ",$erreur)."</h3>";
    }
}

if (isset($_POST['btnModif'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $tel = $_POST['tel'];
    $erreur = [];

    if(empty($nom)|| empty($prenom)|| empty($tel)){
        $this->erreur[]= "Tout les champs sont obligatoires";
    }
    elseif((!(preg_match("/^(77|78|76|75)+[0-9]/", $tel)) || strlen($tel)!=9)){
        $this->erreur[]= "Veuillez enregistré un numéro de téléphone valide";
    }elseif((!(preg_match('/[a-zA-Zéè]$/', $nom)))||(!(preg_match('/[a-zA-Zéè]$/', $prenom))) || strlen($nom)<2 || strlen($prenom)<3){
        $this->erreur[]= "Une erreur s'est produite sur la saisie de votre nom ou de votre prénom";
    }

    if (empty($erreur)) {
        $contacts->modif($nom,$prenom,$tel,$id);
        header('Location : http://localhost/simplon/PHP%20-%20MVC%20-%20POO/views/ajout.php');  
    } else {
        echo "<h3 style='text-align : center; color : red'>".implode(". ",$erreur)."</h3>";
    }
}

if (isset($_POST['sup'])) {
    extract($_POST);
    $contacts->sup($_POST['sup']);
    header('location: http://localhost/simplon/PHP%20-%20MVC%20-%20POO/views/ajout.php');
}

$results = $contacts->listeContact();
$results2 = $contacts->listeFavoris();



if (isset($_POST['favoris'])) {
    extract($_POST);
    $contacts->favoris($_POST['favoris']);
    header('location: http://localhost/simplon/PHP%20-%20MVC%20-%20POO/views/ajout.php');
}
if (isset($_POST['defavoris'])) {
    extract($_POST);
    $contacts->defavoris($_POST['defavoris']);
    header('location: http://localhost/simplon/PHP%20-%20MVC%20-%20POO/views/ajout.php');
}

