<?php ob_start(); ?>

<div class="wrapper-form">
    <div class="container_form">
        <div class="left_section">
            <h1>Let's Build a <br> <span class="text-colored">Cinematic Treasure <br> Trove</span>  together.</h1>
        </div>

        <div class="form_section">
            <h2>Share Your Movie Wisdom</h2>
            <h3>Add a Genre</h3>
            <div class="form_info">
                <form enctype="multipart/form-data" action="index.php?action=ajouterGenre" method="post">

                    <div class="info_input">
                        <div class="form-input">
                            <label for="label_genre"></label>
                            <input type="text" placeholder="Genre*" name="label_genre" id="label_genre" required>
                        </div>
                    </div>

                    <div class="btn-submit">
                        <input type="submit" class="submit" name="submitGenre" id="submitGenre">
                    </div>

                </form>
            
            </div>
        </div>
    </div>
</div>
<?php

$titre = "Genre";
$titre_secondaire = "Add genre";
$contenu = ob_get_clean();
require "view/template.php";
?>