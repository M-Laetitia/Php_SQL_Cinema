<?php ob_start();
$role = $requeteDetailRole->fetch();?>

<div class="container container-genre">
    <h1> <?= $role["name_role"]?></h1>

    <div class="edit_delete">
        <div><a href="index.php?action=supprimerRole&id=<?=$role["id_role"]?>"><i class="fa-solid fa-x"></i></a></div>
        <div><a href="index.php?action=updateRole&id=<?=$role["id_role"]?>"><i class="fa-solid fa-file-pen"></i></a></div>
    </div>

    <div class="list">
        <?php foreach($requeteDetailRole->fetchAll() as $role) { ?>
            <div class="card">
                <figure>
                    <?php
                    if($role["person_image"] == NULL){
                        echo '<img src="./public/Images/default_movie.jpg" alt="black and white film stock">';
                    }
                    else{
                    echo "<img src=". $role["person_image"] .">";
                    }
                    ?> 
                </figure>

                <div class="info">
                    <p><a href="index.php?action=detailActeur&id=<?= $role["id_actor"] ?>"><?= $role["actorComplete"] ?></a></p>
                    <p><a href="index.php?action=detailFilm&id=<?= $role["id_movie"]?>"><?= $role["movie_title"]?></a></p>
                </div>
                
            </div>
        <?php } ?>
    </div>
</div>

<?php
$titre = "Role";
$contenu = ob_get_clean();
require "view/template.php";
?>
