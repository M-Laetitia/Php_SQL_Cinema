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

    
    <?php 
    // initialiser un tableau pour stocker les genres
    $genres = array();
    foreach($requeteGenres->fetchAll() as $movie) {
        $genres[] = '<a href="index.php?action=detailGenre&id=' . $movie["id_genre"] . '">' . $movie["genres"] . '</a>';
        
    }

    // fonction implode() pour concaténer les genres avec une virgule
    $genresConcatenated = implode(', ', $genres);
    ?>

    <p><?= $genresConcatenated ?></p>

    <h3>Casting : </h3>

    <?php 
    foreach($requeteCastingFilm->fetchAll() as $play) {
    ?>  

    <p><a href="index.php?action=detailActeur&id=<?= $play["id_actor"] ?>"><?= $play["actorComplete"] ?></a></p>
    <?php
    }
    ?>

    
</div>

<div>
    <form action="index.php?action=supprimerFilm&id=<?=$movie["id_movie"]?>" method="post">
        <input name="deleteMovie" type="submit" value="Delete this movie">
    </form>
</div>






<?php

$titre = "Movie";
$titre_secondaire = "Movie detail";
$contenu = ob_get_clean();


require "view/template.php";

?>
