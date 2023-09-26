<?php ob_start(); 
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>


<div class="container-list">
    
    <div class="list list-search">
        

        <?php if (empty($results['films']) && empty($results['acteurs']) && empty($results['realisateurs']) && empty($results['genres']) && empty($results['roles'])) { ?>
            <p>No result found. </p>
        <?php } else { ?>

            <?php if (!empty($results['films'])) { ?>
                <div class="results-search">
                
                    <p><span class="title text-highlight">Movies :</span></p>
                    
                    <div class="result-ind">
                        <?php foreach ($results['films'] as $film) { ?>
                            <p>
                                <a href="index.php?action=detailFilm&id=<?= $film["id_movie"]?>"><?= $film["movie_title"] ?></a> - 

                                <a href="index.php?action=detailRealisateur&id=<?= $film["id_director"]?>"><?= $film["directorComplete"]?></a>

                            </p>
                            <p>
                                <?= $film["movie_release_date"] ?>

                            </p>
                        <?php } ?>
                    </div>
                        
                </div>
            <?php } ?>

            <?php if (!empty($results['acteurs'])) { ?>
                <div class="results-search">
                    
                        <p><span class="title text-highlight">Actors :</span></p>
                        
                        <div class="result-ind">
                            <?php foreach ($results['acteurs'] as $acteur) { ?>
                                <p>
                            
                                <a href="index.php?action=detailActeur&id=<?= $acteur["id_actor"]?>"><?= $acteur["person_first_name"] ?> <?= $acteur["person_last_name"] ?></a>

                                </p>

                            <?php } ?>
                        </div>
                </div>
            <?php } ?>


            <?php if (!empty($results['realisateurs'])) { ?>
                <div class="results-search">
                    
                        <p><span class="title text-highlight">Directors :</span></p>
                        
                        <div class="result-ind">
                            <?php foreach ($results['realisateurs'] as $realisateur) { ?>
                                <p>
                            
                                <a href="index.php?action=detailRealisateur&id=<?= $realisateur["id_director"]?>"><?= $realisateur["person_first_name"] ?> <?= $realisateur["person_last_name"] ?></a>

                                </p>

                            <?php } ?>
                        </div>
                </div>
            <?php } ?>


            <?php if (!empty($results['roles'])) { ?>
                <div class="results-search">
                    
                        <p><span class="title text-highlight">Roles :</span></p>
                        
                        <div class="result-ind">
                            <?php foreach ($results['roles'] as $role) { ?>
                                <p>
                                    <a href="index.php?action=detailRole&id=<?= $role["id_role"]?>"><?= $role["name_role"] ?></a> - <a href="index.php?action=detailActeur&id=<?= $role["id_actor"]?>"><?= $role["acteurComplete"] ?></a> 
                                </p>

                                <p>
                                    <a href="index.php?action=detailFilm&id=<?= $role["id_movie"]?>"><?= $role["movie_title"] ?></a>
                                </p>

                            <?php } ?>
                        </div>
                </div>
            <?php } ?>


            <?php if (!empty($results['genres'])) { ?>
                <div class="results-search">
                    
                        <p><span class="title text-highlight">Genres :</span></p>
                        
                        <div class="result-ind">
                            <?php foreach ($results['genres'] as $genre) { ?>
                                <p>
                                    <a href="index.php?action=detailGenre&id=<?= $genre["id_genre"]?>"><?= $genre["label_genre"] ?></a>
                                </p>

                                <p>
                                    <!-- <?= $genre["nb_movie"]?> movie/s -->
                                </p>

                            <?php } ?>
                        </div>
                </div>
            <?php } ?>




        <?php } ?>


        
    </div>

</div>

<!-- <h3>Résultats de la recherche :</h3> -->



<?php
$titre = "Result";
$contenu = ob_get_clean();
require "view/template.php";
?>


