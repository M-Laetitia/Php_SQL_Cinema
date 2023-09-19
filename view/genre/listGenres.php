<?php ob_start(); ?>


<p class=""> Il y a <?= $requete->rowCount() ?> genre/s </p>

<table class="">
    <thead>
        <tr>
            <th>Genre</th>
            <th>Number of movie/s</th>


        </tr>
    </thead>
    <tbody>
        <?php 
        foreach($requete->fetchAll() as $genre) { ?>
            <tr>
                <td><a href="index.php?action=detailGenre&id=<?= $genre["id_genre"]?>"><?= $genre["label_genre"]?></a></td>
                <td><?= $genre["nb_movies"]?></td>


            <tr>

        <?php } ?>
    </tbody>
</table>

<?php

$titre = "Liste des genres";
$titre_secondaire = "Liste des genres";
$contenu = ob_get_clean();


require "view/template.php";

?>
