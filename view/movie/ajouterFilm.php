<?php ob_start(); ?>

<div class="container_form">
    <div class="left_section">
        <h1>Let's Build a <br> <span class="text-colored">Cinematic Treasure <br> Trove</span>  together.</h1>
    </div>

    <div class="form_section">
        <h2>Share Your Movie Wisdom</h2>
        <h3>Add a Movie </h3>
        <div class="form_info">

            <form enctype="multipart/form-data" action="index.php?action=ajouterFilm" method="post">
            
                <div class="info_input">
                    <div class="form-input">
                        <label for="movie_title"></label>
                        <input type="text" placeholder="Movie Title*" name="movie_title" id="movie_title" required>
                    </div>

                    <div class="form-input">
                        <label for="movie_release_date"></label>
                        <input type="text" placeholder="Release Date*" name="movie_release_date" id="movie_release_date" required>
                    </div>

                    <div class="form-input">
                        <label for="movie_duration"></label>
                        <input type="time" placeholder="Run time*" name="movie_duration" id="movie_duration" required>
                    </div>

                    <div class="form-input">
                        <label for="movie_rating"></label>
                        <input type="number" placeholder="★" name="movie_rating" id="movie_rating" required min="0" max="5">
                    </div>

                    <!-- Choisir parmis les réalisateurs -->
                    <div class="form-input">
                        <label for="director">Director :</label>
                        <select class="select" name="director">
                            <option disabled selected>Select a name</option>
                            <?php foreach($requeteRealisateur->fetchAll() as $director){ ?>
                                <option value="<?= $director["id_director"]?>"><?= $director["directorComplete"] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Choisir parmis les genres -->
                    <div class="form-input">
                        <label for="genre">Genre :</label>
                        <select id="genre" name="genre[]" multiple>
                            <?php foreach ($requeteGenre->fetchAll() as $genre) { ?>
                            <option value="<?= $genre["id_genre"] ?>"><?= $genre["label_genre"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                                                    
                </div>

                <div class="form-input-synopsys">
                    <label for="movie_synopsys"></label>
                    <textarea  placeholder="Synopsys" name="movie_synopsys" id="movie_synopsys"></textarea>
                </div>

                <div class="input-images">
                    <div class="input_image">
                        <label for="movie_image">Let's add a picture :</label>
                        <input type="file"  name="movie_image" >
                    </div>

                    <div class="input_image">
                        <label for="movie_bg">And what about a background? :</label>
                        <input type="file"  name="movie_bg" >
                        <p id="autorised-format">Autorised format : jpg, jpeg, png, WebP</p>
                    </div>
                </div>

                <div class="btn-submit">
                    <input type="submit" class="submit" name="submitFilm" id="submitFilm">
                </div>

            </form>
        </div>
    </div>
</div>

<?php
$titre = "Movie";
$contenu = ob_get_clean();
require "view/template.php";
?>