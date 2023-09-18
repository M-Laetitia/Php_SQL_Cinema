<?php ob_start(); ?>


<p class=""> Il y a <?= $requete->rowCount() ?> acteurs </p>

<table class="">
    <thead>
        <tr>
            <th>Acteur</th>
            <th>Date de naissance</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach($requete->fetchAll() as $person) { ?>
            <tr>
                <td><a href="index.php?action=detailActeur&id=<?= $person["id_actor"] ?>"><?= $person["acteurComplete"] ?></a></td>
                <td><?= $person["person_birthday"] ?></td>
            <tr>

        <?php } ?>
    </tbody>
</table>

<?php

$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";
$contenu = ob_get_clean();


require "view/template.php";

?>

