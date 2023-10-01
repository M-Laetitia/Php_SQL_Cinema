<?php
ob_start();
$movie = $requeteUpdateFilm->fetch(); ?>

<div class="wrapper-form">
    <div class="container_form">
        <div class="left_section">
            <h1>Let's Build a <br> <span class="text-colored">Cinematic Treasure <br> Trove</span>  together.</h1>
        </div>

        <div class="form_section">
            <p>Share Your Movie Wisdom</p>
            <h2>Update : <?= $movie["movie_title"]?> </h2>
            <div class="form_info">

            <form enctype="multipart/form-data" action="index.php?action=updateFilm&id=<?= $movie["id_movie"]?>" method="POST">
                
                <div class="info_input">
                    <div class="form-input">
                        <label for="movie_title"></label>
                        <input type="text" placeholder="Movie Title*" name="movie_title" id="movie_title" value="<?= $movie["movie_title"]?>" required>
                    </div>

                    <div class="form-input">
                        <label for="movie_release_date"></label>
                        <input type="text" placeholder="Release Date*" name="movie_release_date" id="movie_release_date" value="<?= $movie["movie_release_date"]?>" required>
                    </div>

                    <div class="form-input">
                        <label for="movie_duration"></label>
                        <input type="time" placeholder="Run time*" name="movie_duration" id="movie_duration" value="<?= $movie["movie_duration"]?>" required>
                    </div>

                    <div class="form-input">
                        <label for="movie_rating"></label>
                        <input type="number" placeholder="★" name="movie_rating" id="movie_rating" required min="0" max="5" value="<?= $movie["movie_rating"]?>">
                    </div>

                    <div class="form-input">
                        <label for="movie_country"></label>
                        <input type="text" placeholder="Movie Country*" name="movie_country" id="movie_country" value="<?= $movie["movie_country"]?>" required >
                    </div>

                    <!-- Choisir parmis les réalisateurs -->
                    <div class="form-input">
                        <label for="director">Director :</label>
                        <select class="select" name="director" required>
                        <!-- // Boucle à travers tous les réalisateurs récupérés de la base de données -->
                            <?php foreach ($requeteRealisateur->fetchAll() as $director) {
                                // Récupérer l'ID du réalisateur actuel
                                // $directorId = $director["id_director"];
                            ?>
                                <option value="<?= $director["id_director"] ?>" <?php if ($director["id_director"] == $movie["id_director"]) echo "selected"; ?>>
                                    <?= $director["person_first_name"] . ' ' .  $director["person_last_name"] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Choisir parmis les genres -->
                    <div class="form-input">
                        <label for="genre">Genre :</label>
                        <select id="genre" name="genre[]" multiple required>
                            <?php foreach ($requeteGenre->fetchAll() as $genre) { ?>
                            <option value="<?= $genre["id_genre"] ?>"><?= $genre["label_genre"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-input-synopsys">
                    <label for="movie_synopsys"></label>
                    <textarea  placeholder="Synopsys" name="movie_synopsys" id="movie_synopsys" value="<?= $movie["movie_synopsys"]?>"></textarea>
                </div>
                
                <div class="input-images">
                    <div class="input_image">
                            <label for="movie_image">Let's add a picture :</label>
                            <input type="file"  name="movie_image" >
                    </div>

                    <div class="input_image">
                        <label for="movie_background">And what about a background? :</label>
                        <input type="file"  name="movie_background" >
                        <p id="autorised-format">Autorised format : jpg, jpeg, png, WebP</p>
                    </div>

                </div>

                <div class="btn-submit">
                    <input type="submit" class="submit" name="updateFilm" value="update" >
                </div>

            </form>
        </div>
    </div>
</div>

<?php
$titre = "Update ". $movie["movie_title"];
$meta_description = "Update the informations about " .$movie["movie_title"];
$contenu = ob_get_clean();
require "view/template.php";
?>