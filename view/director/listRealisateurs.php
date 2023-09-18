<?php ob_start(); ?>


<p class=""> Il y a <?= $requete->rowCount() ?> réalisateurs </p>

<table class="">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Date de naissance</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach($requete->fetchAll() as $person) { ?>
            <tr>
                <td><a href="index.php?action=detailRealisateur&id=<?= $person["id_director"]?>"><?= $person["realComplete"] ?></a></td>
                <td><?= $person["person_birthday"] ?></td>
            <tr>

        <?php } ?>
    </tbody>
</table>

<?php

$titre = "Liste des réalisateurs";
$titre_secondaire = "Liste des réalisateurs";
$contenu = ob_get_clean();


require "view/template.php";

?>