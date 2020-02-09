<?php
function vd($i) {
    echo '<pre>'; var_dump($i); echo '</pre>';
}
// connexion à la base de données

$host_db = 'mysql:host=localhost;dbname=repertoire'; //adresse serveur nom de la BDD
$login = 'root'; // identifiant pour la BDD
$password = ''; // le mdp de connexion a la BDD
$options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

$pdo = new PDO($host_db, $login, $password, $options);

$msg= '';
// verification de l'existence des variables $_POST
if(
    isset($_POST['name']) &&
    isset($_POST['surname']) &&
    isset($_POST['phone']) &&
    isset($_POST['job']) &&
    isset($_POST['town']) &&
    isset($_POST['cp']) &&
    isset($_POST['adress']) &&
    isset($_POST['date']) &&(
    isset($_POST['sexe'])) &&
    isset($_POST['description'])) {
        vd($_POST);
        $name = trim($_POST['name']);
        $surname = trim($_POST['surname']);
        $phone = trim($_POST['phone']); 
        $job = trim($_POST['job']); 
        $town = trim($_POST['town']); 
        $cp = trim($_POST['cp']); 
        $adress = trim($_POST['adress']);
        $date = trim($_POST['date']);
        $sexe = trim($_POST['sexe']); 
        $description = trim($_POST['description']);

        // enregistrement des variables $_POST dans la BDD

        $enregistrement = $pdo->prepare("INSERT INTO annuaire (id_annuaire, nom, prenom, telephone, profession, ville, codepostal, adresse, date_de_naissance, sexe, description)
                                         VALUES(NULL, :name, :surname, :phone, :job, :town, :cp, :adress, :date, :sexe, :description)");
        $enregistrement->bindParam(':name', $name, PDO::PARAM_STR); 
        $enregistrement->bindParam(':surname', $surname, PDO::PARAM_STR); 
        $enregistrement->bindParam(':phone', $phone, PDO::PARAM_STR); 
        $enregistrement->bindParam(':job', $job, PDO::PARAM_STR); 
        $enregistrement->bindParam(':town', $town, PDO::PARAM_STR); 
        $enregistrement->bindParam(':cp', $cp, PDO::PARAM_STR); 
        $enregistrement->bindParam(':adress', $adress, PDO::PARAM_STR); 
        $enregistrement->bindParam(':date', $date, PDO::PARAM_STR); 
        $enregistrement->bindParam(':sexe', $sexe, PDO::PARAM_STR); 
        $enregistrement->bindParam(':description', $description, PDO::PARAM_STR);
        $enregistrement->execute();
        $msg = 'enregistrement effectué avec succés';
    }
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulaire répertoire</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- OWN CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container">
        <form class="w-50 mx-auto" method="POST" action="">
            <h3 id="title-form" class="text-center mx-auto">Informations</h3>
            <div class="form-group">
                <label for="name">Nom *</label><br>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="surname">Prenom *</label><br>
                <input type="text" name="surname" id="surname" class="form-control">
            </div>
            <div class="form-group">
                <label for="phone">Téléphone *</label><br>
                <input type="number" name="phone" id="phone" class="form-control">
            </div>
            <div class="form-group">
                <label for="job">Profession *</label><br>
                <input type="text" name="job" id="job" class="form-control">
            </div>
            <div class="form-group">
                <label for="town">Ville *</label><br>
                <input type="text" name="town" id="town" class="form-control">
            </div>
            <div class="form-group">
                <label for="cp">Code postal *</label><br>
                <input type="text" name="cp" id="cp" class="form-control">
            </div>
            <div class="form-group">
                <label for="adress">Adresse *</label><br>
                <input type="text" name="adress" id="adress" class="form-control">
            </div>
            <div class="form-group">
                <label for="date">Date de naissance</label><br>
                <input type="date" id="date" name="date">
            </div>
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label" for="sexe">Sexe</label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="homme">Homme :</label>
                    <input class="form-check-input" type="radio" id="homme" name="sexe" value="m" checked>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="femme">Femme: </label>
                    <input class="form-check-input" type="radio" id="femme" name="sexe" value="f">
                </div>
            </div>
            <div class="form-group">
                <label for="description">Description</label><br>
                <textarea type="description" id="description" name="description" rows="5" cols="30"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <h3><?php echo $msg; ?></h3>
            </div>
        </div>
    </div>
</body>

</html>