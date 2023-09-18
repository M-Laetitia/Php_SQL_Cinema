<?php ob_start(); ?>


<p class=""> Il y a <?= $requete->rowCount() ?> réalisateurs </p>

<table class="">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach($requete->fetchAll() as $person) { ?>
            <tr>
                <td><?= $person["person_first_name"] ?></td>
                <td><?= $person["person_last_name"] ?></td>
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