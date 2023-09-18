<?php ob_start(); ?>


<div>
    <?php 
    $role = $requeteDetailRole->fetch(); 
    ?>

    <h3> <?= $role["name_role"]?> </h3>

    <h4>Details : </h4>


    <p>Actor :<a href="index.php?action=detailActeur&id=<?= $role["id_actor"] ?>"><?= $role["actorComplete"] ?></a></p>
    <p>Movie : <a href="index.php?action=detailFilm&id=<?= $role["id_movie"]?>"><?= $role["movie_title"]?></a></p>


</div>



<?php

$titre = "Role";
$titre_secondaire = "Role detail";
$contenu = ob_get_clean();


require "view/template.php";

?>
