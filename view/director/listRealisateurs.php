<?php ob_start(); ?>


<p class=""> There is/are <?= $requete->rowCount() ?> director/s </p>

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
                <td><a href="index.php?action=detailRealisateur&id=<?= $person["id_director"]?>"><?= $person["realComplete"] ?></a></td>
            <tr>

        <?php } ?>
    </tbody>
</table>

<?php

$titre = "Director";
$titre_secondaire = "Director List";
$contenu = ob_get_clean();


require "view/template.php";

?>