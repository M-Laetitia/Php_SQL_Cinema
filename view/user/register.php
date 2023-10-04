<?php ob_start(); ?>



<div class="container-list register">

    <div class="list">

    <div>
        <h1>Join Us !</h1>
    </div>

    

    <form enctype="multipart/form-data" action="index.php?action=register" method="POST">

        <div class="register-input">
            <label for="pseudo">Username : </label>
            <input type="text" name="pseudo" id="pseudo">

            <label for="Mail">Email : </label>
            <input type="email" name="email" id="Mail">

            <label for="pass1">Password : </label>
            <input type="password" name="pass1" id="pass1">

            <label for="pass2">Password confirmation : </label>
            <input type="password" name="pass2" id="pass2">
        </div>

        
        
        <div id=btn-register >
            <input  type="submit" name="submit" value="Register">
        </div>

        
    </form>

        <div>
            <?php
                if (isset($_SESSION["message"])) {
                    echo "<p>" . $_SESSION["message"] . "</p>";
                    unset($_SESSION["message"]); // Supprimer le message de la session
             }?>
        </div>

    


    </div>
</div>





<?php

$titre = "Register";
$meta_description = "";
$contenu = ob_get_clean();
require "view/template.php";

?>


