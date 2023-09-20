<?php 

ob_start(); ?>






    <form enctype="multipart/form-data" action="index.php?action=ajouterFilm" method="post">
        
        <h3>Add a movie</h3>
        
        <div class="form-input">
            <label for="movie_title">Movie Title :</label>
            <input type="text" placeholder="Movie Title" name="movie_title" id="movie_title">
        </div>

       <!-- Choisir parmis les genres -->
       <div class="form-input">
            <label>Genre :</label>
            <?php
            foreach ($requeteGenre->fetchAll() as $genre) {
            ?>
            <input type="checkbox" name="genre[]" value="<?= $genre["id_genre"] ?>">
            <label><?= $genre["label_genre"] ?></label><br>
            <?php
            }
            ?>
        </div>


        <!-- Choisir parmis les réalisateur -->

        <div class="form-input">
        <label for="director">Director :</label>
            <select class="select" name="director">

                <?php
                   
                    foreach($requeteRealisateur->fetchAll() as $director){
                ?>
                    <option value="<?= $director["id_director"]?>"><?= $director["directorComplete"] ?></option>
                <?php
                    }
                ?>
            </select>
        </div>



        <div class="form-input">
            <label for="movie_release_date">Release Date :</label>
            <input type="text" name="movie_release_date" id="movie_release_date" required>
        </div>

        <div class="form-input">
            <label for="movie_rating">Movie rating :</label>
            <input type="number" placeholder="Movie Rating" name="movie_rating" id="movie_rating" required min="0" max="5">
        </div>

        <div class="form-input">
            <label for="movie_duration">Movie duration :</label>
            <input type="time" name="movie_duration" id="movie_duration" required>
        </div>

        <div class="form-input">
            <label for="movie_synopsys">Movie synopsis :</label>
            <input type="text"  placeholder="Synopsys" name="movie_synopsys" id="movie_synopsys" required>
        </div>

        <div class="form-input">
            <!-- label est associé a un input ce qu'on met dans le for va correspondre au name du chemin input que l'on veut associé -->
            <label for="movie_image">image :</label>
            <input type="file"  name="movie_image" >
            <button type="submit"> Send</button>
        </div>

  
        <div class="form-input">
            <input type="submit" class="submit" name="submitFilm" id="submitFilm">
             
        </div>
    </form>

   


<?php

$titre = "Movie";
$titre_secondaire = "Add movie";
$contenu = ob_get_clean();
require "view/template.php";

?>