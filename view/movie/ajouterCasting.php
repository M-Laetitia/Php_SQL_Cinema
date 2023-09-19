<?php

ob_start();

?>

<form action="index.php?action=ajouterCasting" enctype="multipart/form-data" method="POST">
    <h2>Add Casting</h2>
    <div>
        <label for="movie">Movie :</label>
        <select name="movie" id="movie" required>

                <?php
                    
                    foreach($requeteFilm->fetchAll() as $movie){
                ?>
                    <option value="<?= $movie["id_movie"] ?>"><?= $movie["movie_title"]?></option>
                <?php
                
                    }
                ?>

            </select>
    </div>

    <div class="form-input">
        <label for="role">Role :</label>
        <select name="role" id="role" required>

                <?php
                  
                    foreach($requeteRole->fetchAll() as $role){
                ?>
                    <option value="<?= $role["id_role"] ?>"><?= $role["name_role"] ?></option>
                <?php
                       
                    }
                ?>

            </select>

    </div>

    <div class="form-input">
        <label for="actor">Actor :</label>
        <select name="actor" id="actor" required>

                <?php
                  
                    foreach($requeteActeur->fetchAll() as $actor){
                ?>
                    <option value="<?= $actor["id_actor"] ?>"><?= $actor["person_first_name"] . " " . $actor["person_last_name"]  ?></option>
                <?php
                       
                    }
                ?>

            </select>
    </div>

    <div class="button-container">
        <input type="submit" name="submitCasting" value="Submit" class="button-casting">
    </div>


</form>

<?php
$titre = "Casting";
$titre_secondaire = "Add Casting";
$contenu = ob_get_clean();
require "view/template.php";