<?php
$host_db = 'mysql:host=localhost;dbname=repertoire'; //adresse serveur nom de la BDD
$login = 'root'; // identifiant pour la BDD
$password = ''; // le mdp de connexion a la BDD
$options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

$pdo = new PDO($host_db, $login, $password, $options);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annuaire</title>
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
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Téléphone</th>
                    <th scope="col">Profession</th>
                    <th scope="col">Ville</th>
                    <th scope="col">Code postal</th>
                    <th scope="col">Adresse</th>
                    <th scope="col">Date de naissance</th>
                    <th scope="col">Sexe</th>
                    <th scope="col">Description</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php // debut affichage en tableau des contacts de la table annuaire
                $liste_annuaire = $pdo->query("SELECT * FROM annuaire");
                while($contact = $liste_annuaire->fetch(PDO::FETCH_ASSOC)){
                    echo '<tr>';
                    echo '<td>'. $contact['nom'] .'</td>';
                    echo '<td>'. $contact['prenom'] .'</td>';
                    echo '<td>'. $contact['telephone'] .'</td>';
                    echo '<td>'. $contact['profession'] .'</td>';
                    echo '<td>'. $contact['ville'] .'</td>';
                    echo '<td>'. $contact['codepostal'] .'</td>';
                    echo '<td>'. $contact['adresse'] .'</td>';
                    echo '<td>'. $contact['date_de_naissance'] .'</td>';
                    echo '<td>'. $contact['sexe'] .'</td>';
                    echo '<td>'. $contact['description'] .'</td>';
                    echo '<td><a href="?action=modifier&id_annuaire='. $contact['id_annuaire'] . '" class="btn btn-warning"><i class="fas fa-pen-nib"></i></a></td>';
                    echo '<td><a href="?action=supprimer&id_annuaire='. $contact['id_annuaire'] . '" class="btn btn-danger" onclick="return(confirm(\'Etes-vous sûr ?\'))"><i class="fas fa-minus-square"></i></a></td>';
                    echo '</tr>';

                    // mettre un accordeon pour masquer et aficher le menu de modification sur le clique du bouton
                    if(isset($_GET['action']) && $_GET['action'] == 'modifier'){
                        $id_contact = $_GET['id_annuaire'];
                        ?>
                    <!--mise en pause du php pour ecrire le formulaire de modification en html -->
                    <td colspan="10">
                    <div class="container">
                    <form id="form-modif"class="row" method="POST" action="">
                        <div class="col-6">
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
                        </div>
                        <div class="col-6">
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
                                    <input class="form-check-input" type="radio" id="homme" name="sexe" value="m"
                                        checked>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="femme">Femme: </label>
                                    <input class="form-check-input" type="radio" id="femme" name="sexe" value="f">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label><br>
                                <textarea type="description" id="description" name="description" rows="5"
                                    cols="30"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
                </td>
                <?php
                        echo '</tr>';}
                    if(isset($_GET['action']) && $_GET['action'] == 'supprimer'){
                        $id_contact = $_GET['id_annuaire'];                        
                        $delete_contact = $pdo->query("DELETE * FROM annuaire WHERE id_annuaire = $_id_contact");
                    }
                }?>
            </tbody>
        </table>
        <?php
        $homme_annuaire = $pdo->query("SELECT * FROM annuaire WHERE sexe = 'm'");
        $femme_annuaire = $pdo->query("SELECT * FROM annuaire WHERE sexe = 'f'");
        $nombre_homme = $homme_annuaire->rowCount();
        $nombre_femme = $homme_annuaire->rowCount();
        echo '<p>Il y a '.$nombre_homme.' homme(s) et '.$nombre_femme.' femme(s). </p>';
        ?>

    </div>

</body>

</html>