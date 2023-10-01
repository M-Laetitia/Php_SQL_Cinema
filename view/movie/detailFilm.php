<?php ob_start(); ?>

<style>
    main.custom-background {
        /* background-color: #c03f5d;
        background-image: url('public/Images/bg.jpg'); */
        background-image: url('<?php echo $filmBackgroundPath; ?>');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        position: relative;
        z-index: 1
    }
    main.custom-background::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: linear-gradient(rgba(40, 39, 55, 0.7), rgba(32, 31, 44, 0.7));
        z-index: -1; 
    }
</style>

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

    <div class="container_detail container_movie">
        <h1 id="name"> <?= $movie["movie_title"]?> </h1>
        <div class="detail">

            <div class="image">
                <figure>
                    <?php if($movie["movie_image"] == NULL){
                            echo '<img src="./public/Images/default_movie.jpg" alt="black and white film stock">';
                        }
                        else {
                        echo "<img    src=". $movie["movie_image"] ." alt= '" . $movie["movie_alt_desc"]. "' >";
                        } ?>
                </figure>
            </div>

            <div class="info">
                <div class="description">
                    <ul>
                        <li> <span class="text-highlight ">★</span> <?= $notes["noteMoyenne"] ?></li>

                        <?php 
                            if(isset($_SESSION["user"])) { ?>
                            <div id="add-rating-button">Add a rating + </div>

                            <div class="popUpRating" >

                                <form id="rating-form" action="index.php?action=addRating&id=<?=$movie["id_movie"]?>" enctype="multipart/form-data" method="POST">

                                    
                                    
                                <div>
                                    <input type="number" name="user_rating" min="1" max="5">
                                    <button id="submitForm" type="submit"><i class="fa-solid fa-check"></i></button>
                                </div>
                                    <p><span id="closePopUp"> <i class="fa-regular fa-circle-xmark"></i> </span></p>


                                </form>
                            </div>

                        <?php } ?>





                        <li>Genre : <span class="text-highlight genre"><?= $genresConcatenated ?></span> </li>
                        <li>Run Time : <?= $movie["formatted_duration"] ?></li>
                        <li>Country : <span class="text-highlight"><?= $movie["movie_country"] ?></span></li>
                        <li>Release : <?= $movie["movie_release_date"] ?></li>
                    </ul>
                </div>

                <div class="crew">
                    <ul>
                        <li>Director : <span class="text-highlight"><a href="index.php?action=detailRealisateur&id=<?= $movie["id_director"]?>"><?= $movie["realisateurComplete"] ?></a></span></li>
                        <li>Actors : 
                            <?php foreach($requeteCastingFilm->fetchAll() as $play) { ?>  
                                <span class="text-highlight"><a href="index.php?action=detailActeur&id=<?= $play["id_actor"] ?>"><?= $play["actorComplete"] . "," ?></a></span>
                            <?php } ?>
                        </li>
                    </ul>
                    
                    <div class="edit_delete">
                        <div><a href="index.php?action=supprimerFilm&id=<?=$movie["id_movie"]?>"><i class="fa-solid fa-x"></i></a></div>
                        <div><a href="index.php?action=updateFilm&id=<?=$movie["id_movie"]?>"> <i class="fa-solid fa-file-pen"></i></a>   </div> 
                    </div>
                </div>
            </div>

            <div class="storyline">
                <p><span class="text-highlight">Storyline : </span></p>
                <textarea readonly> <?= $movie["movie_synopsys"]?></textarea>
            </div>
        </div>



        
        


    </div>
    
    <script>

       const url = window.location.href;
       let backgroundPath = ''; // Déclarer la variable JavaScript

       <?php
       // Injecter le chemin de l'image PHP dans la variable JavaScript
       echo "backgroundPath = '" . $filmBackgroundPath . "';";
       ?>

       if (url.includes("action=detailFilm")) {
           const main = document.querySelector('main');
           main.classList.add('custom-background');

       }

    </script>


</div>


<?php

$titre = "More about " .$movie["movie_title"];
$meta_description = "Browse through the movies catalogue";
$contenu = ob_get_clean();
require "view/template.php";
?>