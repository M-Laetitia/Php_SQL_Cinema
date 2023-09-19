<?php ob_start(); ?>


    <form enctype="multipart/form-data" action="index.php?action=ajouterFilm" method="post">
        
        <h3>Add a movie</h3>
        
        <div class="form-input">
            <label for="movie_title">Movie Title :</label>
            <input type="text" placeholder="Movie Title" name="movie_title" id="movie_title">
        </div>

        <div class="form-input">
            <label for="movie_release_date">Release Date :</label>
            <input type="date" name="movie_release_date" id="movie_release_date" required>
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
            <label for="movie_image">Movie Image(poster) :</label>
            <input type="file" name="movie_image" id="movie_image" required>
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