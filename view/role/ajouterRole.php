<?php ob_start(); ?>


    <form enctype="multipart/form-data" action="index.php?action=ajouterRole" method="post">
        
        <h3>Add a role</h3>
        
        <div class="form-input">
            <label for="name_role">Role :</label>
            <input type="text" placeholder="Role name" name="name_role" id="name_role">
        </div>

        
        <div class="form-input">
            <input type="submit" class="submit" name="submitRole" id="submitRole">

        </div>
    </form>


<?php

$titre = "Role";
$titre_secondaire = "Add role";
$contenu = ob_get_clean();
require "view/template.php";

?>