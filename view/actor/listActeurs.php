<?php ob_start(); ?>


<p class=""> Il y a <?= $requete->rowCount() ?> acteurs </p>

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

$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";
$contenu = ob_get_clean();

// Le require de fin permet d'injecter le contenu dans le template "squelette" > template.php
require "view/template.php";

// Du coup dans notre "template.php" on aura des variables qui vont accueillir les éléments
// provenant des vues
// Donc DANS CHAQUE VUE, il faudra toujours donner une valeur à $titre, $contenu et
// $titre_secondaire

?>

