<?php
include('../header.php');
include('../models/Contact.php');
$contact = new Contact();
$id = $_GET['id'];
$items = $contact->getContactById($id); 

if (isset($_POST['btnModif'])) {
    extract($_POST);
    $contact->modif($nom,$prenom,$tel,$id);
    header('Location : http://localhost/simplon/PHP%20-%20MVC%20-%20POO/views/ajout.php');
    
}
?>
<body>
<div class="col-md-6 offset-2">
    <div class="card">
        <div class="card-header">MODIFICATION CONTACT</div>
        <div class="card-body">
            <form action="" method="post">
                <div>
                    <label for="" class="h6">Prénom</label>
                    <input type="text" name="prenom" id="" class="form-control" value="<?=$items['prenom']?>">
                </div>
                <div>
                    <label for="" class="h6">Nom</label>
                    <input type="text" name="nom" id="" class="form-control" value="<?=$items['nom']?>">
                </div>
                <div>
                    <label for="" class="h6">Téléphone</label>
                    <input type="text" name="tel" id="" class="form-control" value="<?=$items['tel']?>">
                </div>
                <div class="float-right">
                    <button class="btn btn-info mt-2 btn-sm" name="btnModif">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>