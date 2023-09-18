<?php ob_start(); ?>


<p class=""> There is/are <?= $requete->rowCount() ?> actor/s : </p>

<table class="">
    <thead>
        <tr>
            <th>Name : </th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach($requete->fetchAll() as $person) { ?>
            <tr>
                <td><a href="index.php?action=detailActeur&id=<?= $person["id_actor"] ?>"><?= $person["acteurComplete"] ?></a></td>
            <tr>

        <?php } ?>
    </tbody>
</table>

<?php

$titre = "Actors";
$titre_secondaire = "Actors List";
$contenu = ob_get_clean();


require "view/template.php";

?>

