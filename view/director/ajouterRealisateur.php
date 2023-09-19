<?php ob_start(); ?>


    <form enctype="multipart/form-data" action="index.php?action=ajouterRealisateur" method="post">
        
        <h3>Add a director</h3>
        
        <div class="form-input">
            <label for="person_first_name">First Name :</label>
            <input type="text" placeholder="First Name" name="person_first_name" id="person_first_name">
        </div>
        <div class="form-input">
            <label for="person_last_name">Last Name :</label>
            <input type="text" placeholder="Last Name" name="person_last_name" id="person_last_name">
        </div>

        <div class="form-input">
            <label for="person_sexe">Gender :</label>
                M:<input type="radio" name="person_sexe" class="radio" value="male" >
                F:<input type="radio" name="person_sexe" class="radio" value="female">
        </div>

        <div class="form-input">
            <label for="person_birthday">Date of birth :</label>
            <input type="date" name="person_birthday" id="person_birthday" required>
        </div>
        
        <div class="form-input">
            <input type="submit" class="submit" name="submitRealisateur" id="submitRealisateur">

        </div>
    </form>


<?php

$titre = "Director";
$titre_secondaire = "Add Director";
$contenu = ob_get_clean();
require "view/template.php";

?>