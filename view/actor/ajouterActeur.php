<?php ob_start(); ?>


    <!-- The enctype attribute specifies how the form-data should be encoded when submitting it to the server. 
    This value is necessary if the user will upload a file through the form-->
    <form enctype="multipart/form-data" action="index.php?action=ajouterActeur" method="post">
        
        <h3>Add an actor/actress</h3>
        
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
            <input type="submit" class="submit" name="submitActor" id="submitActor">

        </div>
    </form>


<?php

$titre = "Actor";
$titre_secondaire = "Add actor";
$contenu = ob_get_clean();
require "view/template.php";

?>