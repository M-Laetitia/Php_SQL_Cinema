<?php ob_start(); ?>


<div>
    <?php 
    $person = $requetedetailRealisateur->fetch(); 
    ?>

    <h2> <?= $person["realComplete"]?> </h2>

    <h3>Details : </h3>

    <p><?= $person["person_sexe"] ?> </p>
    <p>Date de naissance : <?= $person["person_birthday"] ?></p>

</div>



<?php

$titre = "Détail d'un réalisateur";
$titre_secondaire = "Détail d'un réalisateur";
$contenu = ob_get_clean();


require "view/template.php";

?>
