<?php ob_start(); ?>


<div>
    <?php 
    $person = $requetedetailActeur->fetch(); 
    ?>

    <h2> <?= $person["person_first_name"] . " " . $person["person_last_name"] ?> </h2>

    <h3>Details : </h3>

    <p><?= $person["person_sexe"] ?> </p>
    <p>Date de naissance : <?= $person["person_birthday"] ?></p>

</div>



<?php

$titre = "Détail d'un acteur";
$titre_secondaire = "Détail d'un acteur";
$contenu = ob_get_clean();


require "view/template.php";

?>

