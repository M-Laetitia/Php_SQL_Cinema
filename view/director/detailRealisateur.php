<?php ob_start(); ?>

<?php 
    $person = $requetedetailRealisateur->fetch(); 
?>

<div class="container_detail_director">
    <h2> <?= $person["realComplete"]?> </h2>
    <div class="detail_director">
        <div class="image">
            <figure>
                <img src="#" alt="">
            </figure>
        </div>
        <div class="info">
            <div class="bio-filmo">
                <ul>
                    <!-- <li>Biography</li> -->
                    <li>Filmographie</li>
                </ul>
            </div>
        </div>

        <div class="description">
            <ul>
                <li>Born : <span class="text_colored "><?= $person["dateDMY"] ?></span></li>
                <li>Age : <span class= "text_colored"><?= $person["ActorAge"] ?> years </span></li>
                <li>Gender : <span class= "text_colored"><?= $person["person_sexe"] ?></span></li>
            </ul>
        </div>
    </div>

    
</div>




<div>
 
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
    <a href="index.php?action=supprimerRealisateur&id=<?=$person["id_director"]?>"> X </a>
</div>

<div>
    <a href="index.php?action=updateRealisateur&id=<?=$person["id_director"]?>"> EDIT DIRECTOR</a>
</div>





<?php

$titre = "Détail d'un réalisateur";
$titre_secondaire = "Détail d'un réalisateur";
$contenu = ob_get_clean();


require "view/template.php";

?>
