<?php

include_once "../header.php";
session_start();

require_once "../models/Contact.php";

if (isset($_POST['btnConnect'])) {
    extract($_POST);
    $contact = new Contact();
    $contact->connexion($login,$mdp);
    header("location:ajout.php");
}

?>

<div class="card mt-5 container col-md-5">
    <div class="card-header bg-info text-white text-center">
        <h4>AUTHENTIFICATION</h4>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div>
                <label for="" class="h6">Nom d'utilisateur</label>
                <input type="text" name="login" id="" class="form-control">
            </div>
            <div>
                <label for="" class="h6">Mot de Passe</label>
                <input type="password" name="mdp" id="" class="form-control">
            </div>
            <div class="float-right">
                <button class="btn btn-info mt-2 btn-lg" name="btnConnect">Se Connecter</button>
            </div>
        </form>
    </div>
</div>