<?php ob_start(); ?>

<?php 
    $person = $requetedetailActeur->fetch(); 
?>

<div class="container_detail_actor">
    <h2> <?= $person["acteurComplete"] ?> </h2>
    <div class="detail_actor">
        <div class="image">
            <figure>
                <img src="#" alt="">
            </figure>
        </div>
        <div class="info">
            <div class="filmo_role">
                <ul>
                    <li>Filmography</li>
                    <li>Role</li>
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



<?php
$titre = "Detail Actor";
$contenu = ob_get_clean();
require "view/template.php";
?>

