<?php ob_start(); ?>

<h1 class="title_ref"> Genres List</h1>
<div class="container-list">
    <div class="list">
        <?php 
            foreach($requete->fetchAll() as $genre) { ?>
            <div class="element-list">
                <p><a href="index.php?action=detailGenre&id=<?= $genre["id_genre"]?>"><?= $genre["label_genre"]?></a><p>
                <p><span class="text-highlight"><?= $genre["nb_movie"]?></span> Movie/s</p>
            </div>
        <?php } ?>
    </div>
</div>

<?php
$titre = "Genres";
$meta_description = "Browse through the Genres list";
$contenu = ob_get_clean();
require "view/template.php";
?>

