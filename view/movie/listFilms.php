<!-- On commence et on termine la vue par "ob_start()" et "ob_get_clean()" -->

<!-- On va donc "aspirer" tout ce qui se trouve entre ces 2 fonctions (temporisation de sortie)
pour stocker le contenu dans une variable $contenu -->

<?php ob_start(); ?>

<h1 class="title_ref"> Movies List</h1>
    <div class="container-list-movie">
        <div class="searchBar"></div>
        <div class="list-movie">

            <?php foreach($requete->fetchAll() as $movie) { ?>
                <div class="movie-card">

                


                    <div class="poster">
                        <?php if($movie["movie_image"] == NULL) {
                                echo '<a href="index.php?action=detailFilm&id=' . $movie["id_movie"] . '"><img src="./public/Images/default_movie.jpg" alt="black and white film stock"></a>';
                            }
                            else{
                                // echo "<img src=". $movie["movie_image"] .">";
                                echo '<a href="index.php?action=detailFilm&id=' . $movie["id_movie"] . '"><img src="' . $movie["movie_image"] . '"  alt= "' . $movie["movie_alt_desc"] . '" ></a>';
                            }
                        ?> 
                    </div>

                    <div class="info">
                        <div class="primary">
                            <p class="title"><a href="index.php?action=detailFilm&id=<?= $movie["id_movie"]?>"><?= $movie["movie_title"]?></a><p>

                            <div class="star_rating">
                                <?php
                                $note = $movie["noteMoyenne"]; 
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $note) {
                                        echo '<i class="fa-solid fa-star fa-xs star_filled"></i>'; 
                                    } else {
                                        echo '<i class="far fa-star fa-xs star_empty"></i>'; 
                                    }
                                }
                                ?>
                            </div>
                            
                        </div>


                        

                        <div class="secondary">
                            
                            <p>Run Time : <?= $movie["formatted_duration"]?></p>
                            <p>Release : <?= $movie["movie_release_date"]?></p>
                            <p class="director">Director : <a href="index.php?action=detailRealisateur&id=<?= $movie["id_director"]?>"><?= $movie["realComplete"]?></a></p>
                        </div>
                        
                    </div>
                </div>
     
            <?php } ?>
        </div>
    </div>
<?php

$titre = "Movies";
$meta_description = "Browse through the movies list";
$contenu = ob_get_clean();
// Le require de fin permet d'injecter le contenu dans le template "squelette" > template.php
require "view/template.php";
// Du coup dans notre "template.php" on aura des variables qui vont accueillir les éléments
// provenant des vues
// Donc DANS CHAQUE VUE, il faudra toujours donner une valeur à $titre, $contenu et
// $titre_secondaire
?>