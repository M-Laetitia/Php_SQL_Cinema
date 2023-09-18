
<?php ob_start(); ?>


<p class=""> There is/are <?= $requeteListRole->rowCount() ?> role/s </p>


<table class="">
    <thead>
        <tr>
            <th>Actor's name</th>
            <th>Role</th>
            <th>Movie</th>

        </tr>
    </thead>
    <tbody>
        <?php 
        foreach($requeteListRole->fetchAll() as $play) { ?>
            <tr>
                <td><a href="index.php?action=detailActeur&id=<?= $play["id_actor"] ?>"><?= $play["actorComplete"] ?></a></td>
                <td><a href="index.php?action=detailRole&id=<?= $play["id_role"] ?>"><?= $play["name_role"] ?></a></td>
                <td><a href="index.php?action=detailFilm&id=<?= $play["id_movie"]?>"><?= $play["movie_title"] ?></a></td>
            </tr>

        <?php } ?>
    </tbody>
</table>

<?php

$titre = "Role";
$titre_secondaire = "Roles List";
$contenu = ob_get_clean();
require "view/template.php";

?>


