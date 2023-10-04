<?php
ob_start();
?>
<div class="wrapper-form">
    <div class="container_form">
        <div class="left_section">
            <h1>Let's Build a <br> <span class="text-colored">Cinematic Treasure <br> Trove</span>  together.</h1>
        </div>

        <div class="form_section">
            <p>Share Your Movie Wisdom</p>
            <h2>Add a Casting</h2>
            <div class="form_info">

                <form action="index.php?action=ajouterCasting" enctype="multipart/form-data" method="POST">
                    <div class="info_input_cast">

                        <div class="selection-info">
                            <label for="movie"></label>
                            <select name="movie" id="movie" required>
                            <!-- The first child option element of a select element with a required attribute, and without a multiple attribute, and without a size attribute whose value is greater than 1, must have either an empty value attribute, or must have no text content. Consider either adding a placeholder option label, or adding a size attribute with a value equal to the number of option elements. -->
                                <option disabled selected>Select a Movie</option>
                                    <?php foreach($requeteFilm->fetchAll() as $movie){ ?>
                                    <option value="<?= $movie["id_movie"] ?>"><?= $movie["movie_title"]?></option>
                                    <?php } ?>
                            </select>
                        </div>

                        <div class="selection-info">
                            <label for="role"></label>
                            <select name="role" id="role" required>
                                <option disabled selected>Select a Role</option>
                                    <?php foreach($requeteRole->fetchAll() as $role){ ?>
                                    <option value="<?= $role["id_role"] ?>"><?= $role["name_role"] ?></option>
                                    <?php } ?>
                            </select>
                        </div>

                        <div class="selection-info">
                            <label for="actor"></label>
                            <select name="actor" id="actor" required>
                                <option disabled selected>Select an Actor</option>
                                    <?php foreach($requeteActeur->fetchAll() as $actor){ ?>
                                        <option value="<?= $actor["id_actor"] ?>"><?= $actor["person_first_name"] . ' ' . $actor["person_last_name"]?></option>
                                    <?php } ?>
                                </select>
                        </div>
                    </div>

                    <div class="btn-submit">
                        <input type="submit" name="submitCasting" value="Submit" class="button-casting">
                    </div>
                </form>

                <div class="messages_neutral">
                    <?php
                        if (isset($_SESSION["message"])) {
                            echo "<p>" . $_SESSION["message"] . "</p>";
                            unset($_SESSION["message"]); // Supprimer le message de la session
                    }?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$titre = "Castings";
$meta_description = "Form to add a Casting and to expand the database";
$contenu = ob_get_clean();
require "view/template.php";