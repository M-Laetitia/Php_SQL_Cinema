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
    <p>Movie rating: <?= $movie["movie_rating"] ?>★</p>

        <!-- ajout de l'affiche' -->
    <?php
            if($movie["movie_image"] == NULL){
                echo "pas d'image";
            }
            else{
            echo "<img src=". $movie["movie_image"] ." width='300'>";
            }
    ?>

    
    <?php 
    // initialiser un tableau pour stocker les genres
    $genres = array();
    foreach($requeteGenres->fetchAll() as $movie) {
        $genres[] = '<a href="index.php?action=detailGenre&id=' . $movie["id_genre"] . '">' . $movie["genres"] . '</a>';
    }

    // vérifier si un film a un genre, si non, ajouter message 
    if (!empty($genres)) {
        // fonction implode() pour concaténer les genres avec une virgule
        $genresConcatenated = implode(', ', $genres);
        echo '<p>'. $genresConcatenated . '</p>';
    } else {
        echo '<p> Pas de genre </p>';
    }

    ?>

    <h3>Casting : </h3>

    <?php 
    foreach($requeteCastingFilm->fetchAll() as $play) {
    ?>  

    <p><a href="index.php?action=detailActeur&id=<?= $play["id_actor"] ?>"><?= $play["actorComplete"] ?></a> as 
    <a href="index.php?action=detailRole&id=<?= $play["id_role"] ?>"><?= $play["name_role"] ?></a></p>
    <?php
    }
    ?>


       





<div>
    <a href="index.php?action=supprimerFilm&id=<?=$play["id_movie"]?>"> X</a>
</div>

<div>
    <a href="index.php?action=updateFilm&id=<?=$movie["id_movie"]?>"> EDIT MOVIE</a>
</div>



<?php

$titre = "Movie";
$titre_secondaire = "Movie detail";
$contenu = ob_get_clean();


require "view/template.php";

?>
