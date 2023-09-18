<!-- On commence et on termine la vue par "ob_start()" et "ob_get_clean()" -->

<!-- On va donc "aspirer" tout ce qui se trouve entre ces 2 fonctions (temporisation de sortie)
pour stocker le contenu dans une variable $contenu -->



<?php ob_start(); ?>


<p class=""> Il y a  <?= $requete->rowCount() ?> films </p>



<table class="">
    <thead>
        <tr>
            <th>Title</th>
            <th>Release Date</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach($requete->fetchAll() as $movie) { ?>
            <tr>
                <td><?= $movie["movie_title"] ?></td>
                <td><?= $movie["movie_release_date"] ?></td>
            <tr>

        <?php } ?>
    </tbody>
</table>

<?php

$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();

// Le require de fin permet d'injecter le contenu dans le template "squelette" > template.php
require "view/template.php";

// Du coup dans notre "template.php" on aura des variables qui vont accueillir les éléments
// provenant des vues
// Donc DANS CHAQUE VUE, il faudra toujours donner une valeur à $titre, $contenu et
// $titre_secondaire

?>

