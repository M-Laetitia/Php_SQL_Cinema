<?php ob_start(); ?>


<div>
    <?php 
    $movie = $requetedetailFilm->fetch(); 
    ?>

    <h2> <?= $movie["movie_title"]?> </h2>

    <h3>Details : </h3>

    <p>Run time : <?= $movie["formatted_duration"] ?></p>
    <p>Release date: <?= $movie["movie_release_date"] ?></p>
    <p>Director : <a href="index.php?action=detailRealisateur&id=<?= $movie["id_director"]?>"><?= $movie["realisateurComplete"] ?></a></p>
    <p>Genre/s: <?= $movie["genres"] ?></p>
    <p>Movie rating: <?= $movie["movie_rating"] ?>★</p>

    <h3>Casting : </h3>

    <?php 
    foreach($requeteCastingFilm->fetchAll() as $play) {
    ?>  

    <p><a href="index.php?action=detailActeur&id=<?= $play["id_actor"] ?>"><?= $play["actorComplete"] ?></a></p>
    <?php
    }
    ?>

    
</div>





<?php

$titre = "Movie";
$titre_secondaire = "Movie detail";
$contenu = ob_get_clean();


require "view/template.php";

?>
