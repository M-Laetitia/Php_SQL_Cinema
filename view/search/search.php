<?php ob_start(); 
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>


<h3>Résultats de la recherche :</h3>

<?php if (empty($results)) { ?>
    <p>Aucun résultat trouvé.</p>
<?php } else { ?>
    <ul>
        <?php foreach ($results as $result) { ?>
            <li>
                <span>Titre du film : <?= $result["movie_title"] ?></span>
                
            </li>
        <?php } ?>
    </ul>
<?php } ?>


<?php
$titre = "Result";
$contenu = ob_get_clean();
require "view/template.php";
?>


