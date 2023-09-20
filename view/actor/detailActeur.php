<?php ob_start(); ?>


<div>
    <?php 
    $person = $requetedetailActeur->fetch(); 
    ?>

    <h2> <?= $person["acteurComplete"] ?> </h2>

    <p>Born : <?= $person["dateDMY"] ?></p>
    <p>Age : <?= $person["ActorAge"] ?> years old</p>
    <p>Gender : <?= $person["person_sexe"] ?> </p>

    


    <h3>Filmography :</h3>

    <?php 
    foreach($requeteFilms->fetchAll() as $movie) {
    ?> 
    <p><a href="index.php?action=detailFilm&id=<?= $movie["id_movie"]?>"><?= $movie["movie_title"] ?></a><p>   
    <?php
    }
    ?>

    <h3>Role played :</h3>

    <?php
    foreach($requeteRole->fetchAll() as $play) {
    ?>
    <p><a href="index.php?action=detailRole&id=<?= $play["id_role"] ?>"><?= $play["name_role"] ?></a> - <a href="index.php?action=detailFilm&id=<?= $play["id_actor"]?>"><?= $play["movie_title"] ?></a></p>
    <?php
    }
    ?>

</div>



<div>
    <a href="index.php?action=supprimerActeur&id=<?=$person["id_actor"]?>"> X</a>
</div>




<?php

$titre = "Actor";
$titre_secondaire = "Actor details";
$contenu = ob_get_clean();


require "view/template.php";

?>

