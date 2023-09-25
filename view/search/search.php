<?php ob_start(); 
error_reporting(E_ALL);
?>


<h3>result:</h3>

<ul>
    <?php foreach ($requeteSearch->fetchAll() as $result) { 
         ?>
        
        <li>
            <?php if (isset($result["movie_title"])) { ?>
                <span>Titre du film : <?= $result["movie_title"] ?></span>
            <?php } elseif (isset($result["person_first_name"])) { ?>
                <span>Nom de l'acteur/réalisateur : <?= $result["person_first_name"] ?> <?= $result["person_last_name"] ?></span>
            <?php } elseif (isset($result["label_genre"])) { ?>
                <span>Genre : <?= $result["label_genre"] ?></span>
            <?php } elseif (isset($result["name_role"])) { ?>
                <span>Rôle : <?= $result["name_role"] ?></span>
            <?php } else { ?>
                <span>Type de résultat inconnu</span>
            <?php } ?>
        </li>
    <?php } ?>
</ul>




<?php
$titre = "Result";
$contenu = ob_get_clean();
require "view/template.php";
?>


