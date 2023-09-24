<?php ob_start();
$person = $requetedetailActeur->fetch(); 
?>

<div class="container_detail container_actor">
    <h2> <?= $person["acteurComplete"] ?> </h2>
    <div class="detail">
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
            <div class="listing">
                <ul>
                    <li id="filmo">Filmography</li>
                    <li id="role">Role</li>
                </ul>

                <div class="list-role">
                    <?php 
                        foreach($requeteRole->fetchAll() as $play) {
                        ?> 
                        <div class="movie-detail">
                            <p>
                                <span class="text-colored"><a href="index.php?action=detailFilm&id=<?= $play["id_actor"]?>"><?= $play["name_role"]?></a> </span> -
                                <a href="index.php?action=detailRole&id=<?= $play["id_role"] ?>"><?= $play["movie_title"]  ?></a>
                            </p>
                            <p><?= $play["movie_release_date"]?></p>
                        </div>   
                        <?php
                        }
                    ?>
 
                </div>

                <div class="list-filmo">
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
        </div>

        <div class="description">
            <ul>
                <li>Born : <span class="text-highlight "><?= $person["dateDMY"] ?></span></li>
                <li>Age : <span class= "text-highlight"><?= $person["ActorAge"] ?> years </span></li>
                <li>Gender : <span class= "text-highlight"><?= $person["person_sexe"] ?></span></li>
                <li>Nationality : <span class= "text-highlight"><?= $person["person_nationality"] ?></span></li>
            </ul>

            <div class="edit_delete">
                <div><a href="index.php?action=supprimerActeur&id=<?=$person["id_actor"]?>"><i class="fa-solid fa-x"></i></a></div>
                <div><a href="index.php?action=updateActeur&id=<?=$person["id_actor"]?>"> <i class="fa-solid fa-file-pen"></i></a>   </div> 
            </div> 

        </div>
    </div>
</div>

<?php
$titre = "Detail Actor";
$contenu = ob_get_clean();
require "view/template.php";
?>