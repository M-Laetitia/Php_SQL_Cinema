<?php ob_start(); 
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>


<h3>Résultats de la recherche :</h3>

<?php if (empty($results['films']) && empty($results['acteurs']) && empty($results['realisateurs']) && empty($results['genres']) && empty($results['roles'])) { ?>
    <p>Aucun résultat trouvé.</p>
<?php } else { ?>

    <?php if (!empty($results['films'])) { ?>
        <h4>Films :</h4>
        <ul>
            <?php foreach ($results['films'] as $film) { ?>
                <li>
                    <span>Titre du film : <?= $film["movie_title"] ?></span>
                  
                </li>
            <?php } ?>
        </ul>
    <?php } ?>

    <?php if (!empty($results['acteurs'])) { ?>
        <h4>Acteurs :</h4>
        <ul>
            <?php foreach ($results['acteurs'] as $acteur) { ?>
                <li>
                    <span>Nom de l'acteur : <?= $acteur["person_first_name"] ?> <?= $acteur["person_last_name"] ?></span>
                    
                </li>
            <?php } ?>
        </ul>
    <?php } ?>

    <?php if (!empty($results['realisateurs'])) { ?>
        <h4>Réalisateurs :</h4>
        <ul>
            <?php foreach ($results['realisateurs'] as $realisateur) { ?>
                <li>
                    <span>Nom du réalisateur : <?= $realisateur["person_first_name"] ?> <?= $realisateur["person_last_name"] ?></span>
                  
                </li>
            <?php } ?>
        </ul>
    <?php } ?>

    <?php if (!empty($results['roles'])) { ?>
        <h4>roles :</h4>
        <ul>
            <?php foreach ($results['roles'] as $role) { ?>
                <li>
                    <span>role : <?= $role["name_role"] ?></span>
                   
                </li>
            <?php } ?>
        </ul>
    <?php } ?>



    <?php if (!empty($results['genres'])) { ?>
        <h4>Genres :</h4>
        <ul>
            <?php foreach ($results['genres'] as $genre) { ?>
                <li>
                    <span>Genre : <?= $genre["label_genre"] ?></span>
                
                </li>
            <?php } ?>
        </ul>
    <?php } ?>







<?php } ?>



<?php
$titre = "Result";
$contenu = ob_get_clean();
require "view/template.php";
?>


