<?php
include_once "../header.php";
session_start();
// if (empty($_SESSION)) {
//     header("location:http://localhost/simplon/PHP%20-%20MVC%20-%20POO/views/auth.php");
// }

if (isset($_GET['deconnexion'])) {
    session_unset();
    header("location:http://localhost/simplon/PHP%20-%20MVC%20-%20POO/views/auth.php");
}
include ('../models/Contact.php');
$contacts = new Contact();
$results = $contacts->listeContact();
$results2 = $contacts->listeFavoris();


if (isset($_POST['btnAjout'])) {
    extract($_POST);
    $contacts->ajout($nom,$prenom,$tel);
    
}
if (isset($_POST['sup'])) {
    extract($_POST);
    $contacts->sup($_POST['sup']);
    
}
if (isset($_POST['favoris'])) {
    extract($_POST);
    $contacts->favoris($_POST['favoris']);
    
}
if (isset($_POST['defavoris'])) {
    extract($_POST);
    $contacts->defavoris($_POST['defavoris']);
    
}
?>

<div class="container mt-2">
    <div class="row bg-info p-3 mb-4">
        <h3>Bienvenue <?php
          
           ?></h3>
        <a href="?deconnexion" class=" btn btn-danger offset-6">Se déconnecter</a>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">NOUVEAU CONTACT</div>
                <div class="card-body">
                    <form action="" method="post">
                        <div>
                            <label for="" class="h6">Prénom</label>
                            <input type="text" name="prenom" id="" class="form-control">
                        </div>
                        <div>
                            <label for="" class="h6">Nom</label>
                            <input type="text" name="nom" id="" class="form-control">
                        </div>
                        <div>
                            <label for="" class="h6">Téléphone</label>
                            <input type="text" name="tel" id="" class="form-control">
                        </div>
                        <div class="float-right">
                            <button class="btn btn-info mt-2 btn-sm" name="btnAjout">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">LISTE DES CONTACTS</div>
                <?php
                 if (sizeof($results) == 0) {
                    echo '<h5 class="text-primary text-center">Aucun contact n\'a été enregistré !</h5>';
                 } else { ?>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>PRENOM</th>
                                <th>NOM</th>
                                <th>TELEPHONE</th>
                                <th>ACTIONS</th>
                            </tr>
                            <?php foreach ($results as $result) {?>
                                <tr>
                                    <td><?=$result['nom']?></td>
                                    <td><?=$result['prenom']?></td>
                                    <td><?=$result['tel']?></td>
                                    <td>
                                    <form action="" method="post">
                                        <a href="modif.php?id=<?=$result['id']?>" class="btn btn-sm btn-warning">Modifier</a>
                                        <button name="favoris" class="btn btn-sm btn-success" value="<?=$result['id']?>">Favoris</button>
                                        <button name="sup" class="btn btn-sm btn-danger" value="<?=$result['id']?>">Supprimer</button>
                                        <form action="" method="post">
                                    </td>
                                </tr>
                           <?php } ?>
                            
                        </table>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-md-8 offset-4">
            <div class="card">
                <div class="card-header text-center">LISTE DES FAVORIS</div>
                <?php
                 if (sizeof($results2) == 0) {
                    echo '<h5 class="text-primary text-center">Aucun favoris n\'a été enregistré !</h5>';
                 } else { ?>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>PRENOM</th>
                                <th>NOM</th>
                                <th>TELEPHONE</th>
                                <th>ACTIONS</th>
                            </tr>
                            <?php foreach ($results2 as $result) {?>
                                <tr>
                                    <td><?=$result['nom']?></td>
                                    <td><?=$result['prenom']?></td>
                                    <td><?=$result['tel']?></td>
                                    <td>
                                        <form action="" method="post">
                                            <a href="modif.php?id=<?=$result['id']?>" class="btn btn-sm btn-warning">Modifier</a>
                                            <button name="defavoris" class="btn btn-sm btn-success" value="<?=$result['id']?>">Enlever</button>
                                            <button name="sp" class="btn btn-sm btn-danger" value="<?=$result['id']?>">Supprimer</button>
                                        </form>
                                    
                                    </td>
                                </tr>
                           <?php } ?>
                            
                        </table>
                    </div>
                <?php } ?>
            </div>
        </div>
</div>