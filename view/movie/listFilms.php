<!-- On commence et on termine la vue par "ob_start()" et "ob_get_clean()" -->

<!-- On va donc "aspirer" tout ce qui se trouve entre ces 2 fonctions (temporisation de sortie)
pour stocker le contenu dans une variable $contenu -->



<?php ob_start(); ?>



    <div class="container-list-movie">
        <div class="searchBar"></div>

        <div class="list-movie">

            <?php 
                foreach($requete->fetchAll() as $movie) { ?>

                <div class="movie-card">

                    <div class="poster">
                        <img src="#" alt="">
                    </div>

                    <div class="info">
                        <div class="primary">

                            <p class="title"><a href="index.php?action=detailFilm&id=<?= $movie["id_movie"]?>"><?= $movie["movie_title"]?></a><p>
                            
                            <p>Genre : </p>
                            <p><span class="text-colored">★</span></p>

                        </div>

                        <div class="secondary">
                            <p>Release :</p>
                            <p>Director : <a href="index.php?action=detailRealisateur&id=<?= $movie["id_director"]?>"><?= $movie["realComplete"]?></a></p>
                        </div>
                    </div>
                </div>
     
            <?php 
            } 
            ?>



            
        </div>
    </div>


<?php

$titre = "List movies";
$contenu = ob_get_clean();

// Le require de fin permet d'injecter le contenu dans le template "squelette" > template.php
require "view/template.php";

// Du coup dans notre "template.php" on aura des variables qui vont accueillir les éléments
// provenant des vues
// Donc DANS CHAQUE VUE, il faudra toujours donner une valeur à $titre, $contenu et
// $titre_secondaire

?>

