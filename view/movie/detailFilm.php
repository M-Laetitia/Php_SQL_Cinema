<?php ob_start(); ?>


<div>
    <?php 
    $movie = $requetedetailFilm->fetch(); 
    ?>

    <h2> <?= $movie["movie_title"]?> </h2>

    <h3>Details : </h3>

    <p>Run time : <?= $movie["movie_duration"] ?></p>
    <p>Release date: <?= $movie["movie_release_date"] ?></p>
    <p>Director: <?= $movie["person_last_name"] . " " . $movie["person_first_name"]  ?></p>
    <!-- <p>Genre/s: <?= $movie["label_genre"] ?></p> -->
    <p>Movie rating: <?= $movie["movie_rating"] ?></p>

</div>



<?php

$titre = "Détail d'un film";
$titre_secondaire = "Détail d'un film";
$contenu = ob_get_clean();


require "view/template.php";

?>
