<?php ob_start(); ?>


    <form enctype="multipart/form-data" action="index.php?action=ajouterGenre" method="post">
        
        <h3>Add a movie</h3>
        
        <div class="form-input">
            <label for="label_genre">Genre :</label>
            <input type="text" placeholder="Genre" name="label_genre" id="label_genre">
        </div>

        
        <div class="form-input">
            <input type="submit" class="submit" name="submitGenre" id="submitGenre">

        </div>
    </form>


<?php

$titre = "Genre";
$titre_secondaire = "Add genre";
$contenu = ob_get_clean();
require "view/template.php";

?>