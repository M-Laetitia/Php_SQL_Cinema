<?php
ob_start();
$movie = $requeteUpdateFilm->fetch(); ?>


    
    <form enctype="multipart/form-data" action="index.php?action=updateFilm&id=<?= $movie["id_movie"]?>" method="post">
        
        <h3>Edit a movie</h3>
        
        <div class="form-input">
            <label for="movie_title">Movie Title :</label>
            <input type="text" placeholder="movie_title" name="movie_title" value="<?= $movie["movie_title"]?>">
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
                    <option value="<?= $director["id_director"]?>"><?= $director["person_first_name"] . ' ' .  $director["person_last_name"] ?></option>
                <?php
                    }
                ?>
            </select>
        </div>


        



        <div class="form-input">
            <label>Release Date :</label>
            <input type="text" name="movie_release_date" id="movie_release_date" required value="<?= $movie["movie_release_date"]?>">
        </div>


        <div class="form-input">
            <label for="movie_rating">Movie rating :</label>
            <input type="number" placeholder="Movie Rating" name="movie_rating" id="movie_rating" required min="0" max="5" value="<?= $movie["movie_rating"]?>" >
        </div>

        <div class="form-input">
            <label for="movie_duration">Movie duration :</label>
            <input type="time" name="movie_duration" id="movie_duration" required value="<?= $movie["movie_duration"]?>">
        </div>

        <div class="form-input">
            <label>Movie synopsis :</label>
            <textarea name="movie_synopsys" id="movie_synopsys" type="text" value="<?= $movie["movie_synopsys"]?>"></textarea>
        </div>

        





        <!-- <div class="form-input">
            <label for="movie_image">Movie Image(poster) :</label>
            <input type="file" name="movie_image" id="movie_image" required>
        </div> -->

        
        <div class="form-input">
            <input type="submit" class="submit" name="updateFilm" id="updateFilm">

        </div>
    </form>




<?php
$titre = "movie";
$titre_secondaire = "update movie" ;
$contenu = ob_get_clean();
require "view/template.php";
?>