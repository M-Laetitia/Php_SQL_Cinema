
<?php ob_start(); ?>

<div class="container-list">
    <!-- <div class="searchBar"></div> -->

    <div class="list">
        <table class="table-role">
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Actor</th>
                    <th>Movie</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach($requeteListRole->fetchAll() as $play) { ?>
                        <tr>
                            <td><a href="index.php?action=detailRole&id=<?= $play["id_role"] ?>"><?= $play["name_role"] ?></a></td>
                            <td><a href="index.php?action=detailActeur&id=<?= $play["id_actor"] ?>"><?= $play["actorComplete"] ?></a></td>
                            <td><a href="index.php?action=detailFilm&id=<?= $play["id_movie"]?>"><?= $play["movie_title"] ?></a></td>
                        </tr>
                <?php 
                    } 
                ?>
            </tbody>
        </table>
    </div>

</div>


<?php
$titre = "Role";
$titre_secondaire = "Roles List";
$contenu = ob_get_clean();
require "view/template.php";
?>


