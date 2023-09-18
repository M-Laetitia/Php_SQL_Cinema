<?php ob_start(); ?>


<p class=""> Il y a <?= $requete->rowCount() ?> genre </p>

<table class="">
    <thead>
        <tr>
            <th>Genre</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach($requete->fetchAll() as $genre) { ?>
            <tr>
                <td><?= $genre["label_genre"] ?></td>

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
