<?php ob_start(); ?>


<div>
    <?php 
    $person = $requetedetailRealisateur->fetch(); 
    ?>

    <h2> <?= $person["realComplete"]?> </h2>

    <h3>Details : </h3>

    <p><?= $person["person_sexe"] ?> </p>
    <p>Date de naissance : <?= $person["dateDMY"] ?></p>
    <p>Age : <?= $person["ActorAge"] ?></p>

    <h2>Filmography</h2>

    <?php 
    foreach($requeteFilms->fetchAll() as $movie) {
    ?> 
    <p><a href="index.php?action=detailFilm&id=<?= $movie["id_movie"]?>"><?= $movie["movie_title"] ?></a><p>   
    <?php
    }
    ?>

</div>

<div>
    <form action="index.php?action=supprimerRealisateur&id=<?=$director["id_director"]?>" method="post">
        <input name="deleteDirector" type="submit" value="Delete this director">
    </form>
</div>



<?php

$titre = "Détail d'un réalisateur";
$titre_secondaire = "Détail d'un réalisateur";
$contenu = ob_get_clean();


require "view/template.php";

?>
