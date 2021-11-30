<?php
session_start();

//Connexion a la base de donnée et recupération de tous les apprenants qui ont émargés.
require('../model/database.php');
$date = date('d-m-Y');
$jour = date('l F dS\ Y');
$selection = $bdd->query("SELECT * FROM liste_emargement WHERE date_connexion='$date'");
if (isset($_GET['search']) and !empty($_GET['search'])) {
    $recherche = htmlspecialchars($_GET['search']);
    $selection = $bdd->query('SELECT * FROM liste_emargement WHERE nom LIKE "%' . $recherche . '%"');
}
if (isset($_GET['date']) and !empty($_GET['date'])) {
    $rech = htmlspecialchars($_GET['date']);
    $jour = $rech;
    $selection = $bdd->query("SELECT * FROM liste_emargement WHERE date_connexion ='$rech'");
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include('styleLinks.php') ?>
    <title>Dashbord-admin</title>
</head>

<body>

<!-- Menu de navigation  -->
    <div class="">
        <nav class="disp-flex justify-between align-items-center pad-10">
            <h1 class="text-white">Dashbord Admin</h1>
            <div class="row">
                <ul class="nav disp-flex align-items-center">
                    <li class="nav-item ft-size-22 m-2"><a href="../index.php">Accueil</a></li>
                    <li class="nav-item ft-size-22 m-2 "><a href="../logoutAdmin.php">Deconnexion</a></li>
                </ul>
            </div>
        </nav>
    </div>

    <!-- Les differents onglets dans la partie verticale  -->
    <div class="row">
        <div class="disp-flex aside col-1 mt-5 flex-col bg-orange">
            <a href="apprenant.php" class="m-2">Apprenants</a>
            <a href="insertPartenaire.php" class="m-2">Partenaires</a>
            <a href="insertFormation.php" class="m-2">Formations</a>
        </div>
        <div class="col-10 mt-5">
            <div class="d-flex justify-content-between">

                <!-- Filtrage par le nom de l'apprenant -->
                <h4><?php echo $jour ?> </h4>
                <form action="" method="GET">
                    <input type="search" name="search" placeholder="Rechercher apprenant">
                    <input type="submit" value="rechercher">
                </form>

                <!-- Filtrage par date  -->
                <form action="" method="GET">
                    <input type="date" name="date">
                    <input type="submit" value="rechercher">
                </form>
            </div>
            <table class="table table-striped text-center table-bordered">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prenoms</th>
                        <th>Adresse e-mail</th>
                        <th>Heure d'arrivée</th>
                        <th>Heure de depart</th>
                    </tr>
                </thead>
                <tbody>

                    <!-- Recuperer toutes les lignes de la base de donnée puis enregistrer les information dans $admin -->
                    <?php
                    if ($selection->rowCount() > 0) {
                        while ($admin = $selection->fetch()) {
                    ?>

                    <!-- affichage des informations de l'apprenant sous forme de tableau -->
                        <tr>
                            <td><?= $admin['nom'] ?></td>
                            <td><?= $admin['prenom'] ?></td>
                            <td><?= $admin['mail'] ?></td>
                            <td><?= $admin['arrivee'] ?></td>
                            <td><?= $admin['depart'] ?></td>
                        </tr>
                        
                    <?php
                        }
                    } else {
                    ?>
                        <p><?= $admin['date_connexion'];?></p>
                    <?php
                    }
                    ?>

                </tbody>
            </table>

        </div>
    </div>
</body>

</html>