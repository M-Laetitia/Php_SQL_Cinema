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
        <form action="index.php?action=supprimerGenre&id=<?=$genre["id_genre"]?>" method="post">
            <input name="deleteGenre" type="submit" value="Delete this genre">
        </form>
    </div>






<?php

$titre = "Genre";
$titre_secondaire = "Detail genre";
$contenu = ob_get_clean();


require "view/template.php";



?>


