<?php ob_start(); ?>


<div>
    <?php
        $genre = $requeteGenre->fetch();
    ?>
        <h2><?= $genre["label_genre"] ?></h2>
        <h3>Movies related : </h3>


    <?php 
    foreach($requeteDetailGenre->fetchAll() as $genre) {
    ?>
    <p><a href="index.php?action=detailFilm&id=<?= $genre["id_movie"]?>"><?= $genre["movie_title"]?></a></p>
    <?php
    }
    ?>

</div>

    <div>
    <a href="index.php?action=supprimerGenre&id=<?=$genre["id_genre"]?>">X</a>
    </div>


    <div>
    <a href="index.php?action=updateGenre&id=<?=$genre["id_genre"]?>"> EDIT  genre</a>
</div>




<?php

$titre = "Genre";
$titre_secondaire = "Detail genre";
$contenu = ob_get_clean();

require "view/template.php";


?>


