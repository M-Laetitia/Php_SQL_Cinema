<?php ob_start(); ?>



<div class="container_form">
    <div class="left_section">
        <h1>Let's Build a <br> <span class="text-colored">Cinematic Treasure <br> Trove</span>  together.</h1>
    </div>

    <div class="form_section">
        <h2>Share Your Movie Wisdom</h2>
        <h3>Add a Role</h3>
        <div class="form_info">

            <!-- The enctype attribute specifies how the form-data should be encoded when submitting it to the server. 
            This value is necessary if the user will upload a file through the form-->
            <form enctype="multipart/form-data" action="index.php?action=ajouterRole" method="post">
            
                <div class="info_input">

                    <div class="form-input">
                        <label for="name_role"></label>
                        <input type="text" placeholder="Role name*" name="name_role" id="name_role" required>
                    </div>
    
                </div>

                <div class="btn-submit">
                        <input type="submit" class="submit" name="submitRole" id="submitRole">
                </div>

            </form>
        
        </div>
    </div>
</div>





    
        

        
    


<?php

$titre = "Role";
$titre_secondaire = "Add role";
$contenu = ob_get_clean();
require "view/template.php";

?>

