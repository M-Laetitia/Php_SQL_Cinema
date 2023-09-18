<?php ob_start(); ?>


<div>
    <?php 
    $person = $requetedetailActeur->fetch(); 
    ?>

    <h2> <?= $person["person_first_name"] . " " . $person["person_last_name"] ?> </h2>

    <h3>Details : </h3>

    <p><?= $person["person_sexe"] ?> </p>
    <p>Date de naissance : <?= $person["person_birthday"] ?></p>


    <h3>Movie/s related :</h3>

    <?php 
    foreach($requeteFilms->fetchAll() as $movie) {
    ?>

        <p> <?= $movie["movie_title"] ?> </p>

    <!-- <p><a href="index.php?action=detailRealisateur&id=<?= $movie["id_movie"]?>"><?= $movie["movie_title"] ?></a><p> -->
        


    <?php
    }
    ?>

</div>





<?php

$titre = "Détail d'un acteur";
$titre_secondaire = "Détail d'un acteur";
$contenu = ob_get_clean();


require "view/template.php";

?>

