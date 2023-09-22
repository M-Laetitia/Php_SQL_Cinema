<?php ob_start(); ?>


<div>
 
    <?php 
    // initialiser un tableau pour stocker les genres
    $genres = array();
    foreach($requeteGenres->fetchAll() as $movie) {
        $genres[] = '<a href="index.php?action=detailGenre&id=' . $movie["id_genre"] . '">' . $movie["genres"] . '</a>';
    }
        $genresConcatenated = implode(', ', $genres);
        // echo '<p>'. $genresConcatenated . '</p>';
 
    $movie = $requetedetailFilm->fetch(); 
    ?>

    <div class="container_detail_movie">
        <h2> <?= $movie["movie_title"]?> </h2>
        <div class="detail_movie">
            <div class="image">
                <figure>
                    <?php
                        if($movie["movie_image"] == NULL){
                            echo '<img src="./public/Images/default_movie.jpg" alt="black and white film stock">';
                        }
                        else{
                        echo "<img src=". $movie["movie_image"] ." width='300'>";
                        }
                    ?>
                </figure>
            </div>
            <div class="info">
                <div class="description">
                    <ul>
                        <li> <span class="text_colored ">★</span> <?= $movie["movie_rating"] ?></li>
                        <li>Genre : <span class="text-colored genre"><?= $genresConcatenated ?></span> </li>
                        <li>Run Time : <?= $movie["formatted_duration"] ?></li>
                        <li>Country : <span class="text_colored"><?= $movie["movie_country"] ?></span></li>
                        <li>Release : <?= $movie["movie_release_date"] ?></li>
                        
                    </ul>
                </div>

                <div class="crew">
                    <ul>
                        <li>Director : <span class="text_colored"><a href="index.php?action=detailRealisateur&id=<?= $movie["id_director"]?>"><?= $movie["realisateurComplete"] ?></a></span></li>
                        <li>Actors : 
                            <?php 
                                foreach($requeteCastingFilm->fetchAll() as $play) {
                                ?>  

                                <span class="text_colored"><a href="index.php?action=detailActeur&id=<?= $play["id_actor"] ?>"><?= $play["actorComplete"] . "," ?></a></span>
                                <?php
                                }
                            ?>
                        </li>

                    </ul>
                    <div class="edit_delete">
                        <div>
                            <a href="index.php?action=supprimerFilm&id=<?=$movie["id_movie"]?>"><i class="fa-solid fa-x"></i></a>
                            <a href="index.php?action=updateFilm&id=<?=$movie["id_movie"]?>"> <i class="fa-solid fa-file-pen"></i></a>    
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="storyline">
                <p><span class="text_colored">Storyline : </span></p>
                <textarea readonly> <?= $movie["movie_synopsys"]?>
                </textarea>
            </div>
        </div>
        

 



    </div>

    


<div>
    

<?php

$titre = "Detail Movie";
$contenu = ob_get_clean();

require "view/template.php";

?>


