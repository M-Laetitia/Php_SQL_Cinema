<?php ob_start(); ?>

<div class="container-list">
    <!-- <div class="searchBar"></div> -->
    <div class="list">
        <?php 
            foreach($requete->fetchAll() as $genre) { ?>
            <div class="element-list">
                <p><a href="index.php?action=detailGenre&id=<?= $genre["id_genre"]?>"><?= $genre["label_genre"]?></a><p>
                <p><span class="text-highlight"><?= $genre["nb_movie"]?></span> Movie/s</p>
            </div>
        <?php } ?>
    </div>

<?php
$titre = "Genres List";
$contenu = ob_get_clean();
require "view/template.php";
?>

