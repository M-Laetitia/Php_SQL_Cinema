<!-- On commence et on termine la vue par "ob_start()" et "ob_get_clean()" -->

<!-- On va donc "aspirer" tout ce qui se trouve entre ces 2 fonctions (temporisation de sortie)
pour stocker le contenu dans une variable $contenu -->



<?php ob_start(); ?>


<p class=""> There is/are<?= $requete->rowCount() ?> movie/s </p>



<table class="">
    <thead>
        <tr>
            <th>Title</th>
            <th>Director</th>

        </tr>
    </thead>
    <tbody>
        <?php 
        foreach($requete->fetchAll() as $movie) { ?>
            <tr>
                <td><a href="index.php?action=detailFilm&id=<?= $movie["id_movie"]?>"><?= $movie["movie_title"]?></a></td>
                <td><a href="index.php?action=detailRealisateur&id=<?= $movie["id_director"]?>"><?= $movie["realComplete"]?></a></td>
            </tr>

        <?php } ?>
    </tbody>
</table>

<?php

$titre = "Movie";
$titre_secondaire = "Movies List";
$contenu = ob_get_clean();

// Le require de fin permet d'injecter le contenu dans le template "squelette" > template.php
require "view/template.php";

// Du coup dans notre "template.php" on aura des variables qui vont accueillir les éléments
// provenant des vues
// Donc DANS CHAQUE VUE, il faudra toujours donner une valeur à $titre, $contenu et
// $titre_secondaire

?>

