<?php ob_start(); ?>

<?php 
    $person = $requetedetailRealisateur->fetch(); 
?>

<div class="container_detail_director">
    <h2> <?= $person["realComplete"]?> </h2>
    <div class="detail_director">
        <div class="image">
            <figure>
                    <?php
                        if($person["person_image"] == NULL){
                            echo '<img src="./public/Images/default_movie.jpg" alt="black and white film stock">';
                        }
                        else{
                        echo "<img src=". $person["person_image"] .">";
                        }
                    ?>
            </figure>
        </div>
        <div class="info">
            <div class="bio-filmo">
                <ul>
                    <!-- <li>Biography</li> -->
                    <li>Filmographie</li>
                </ul>
            </div>

            <div class="list-filmo_real">

                    
                <?php 
                    foreach($requeteFilms->fetchAll() as $movie) {
                    ?> 
                    <div class="movie-detail">
                        <p><a href="index.php?action=detailFilm&id=<?= $movie["id_movie"]?>"><?= $movie["movie_title"] ?></a></p>
                        <p><?= $movie["movie_release_date"] ?></p>
                        
                    </div>   
                    <?php
                    }
                ?>

            </div>

        </div>

        <div class="description">
            <ul>
                <li>Born : <span class="text_colored "><?= $person["dateDMY"] ?></span></li>
                <li>Age : <span class= "text_colored"><?= $person["ActorAge"] ?> years </span></li>
                <li>Gender : <span class= "text_colored"><?= $person["person_sexe"] ?></span></li>
                <li>Nationality : <span class= "text_colored"><?= $person["person_nationality"] ?></span></li>
            </ul>
        </div>
    </div>



    <div class="edit_delete">
        <div>
            <a href="index.php?action=supprimerRealisateur&id=<?=$person["id_director"]?>"><i class="fa-solid fa-x"></i></a>
            <a href="index.php?action=updateRealisateur&id=<?=$person["id_director"]?>"> <i class="fa-solid fa-file-pen"></i></a>    
        </div>
    </div>






<?php

$titre = "Détail d'un réalisateur";
$titre_secondaire = "Détail d'un réalisateur";
$contenu = ob_get_clean();


require "view/template.php";

?>
