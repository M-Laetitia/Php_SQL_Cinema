<?php 
ob_start(); 
?>


<div class="container-list register">

    <div class="list">

        <?php
            if(isset($_SESSION["user"])) {
                $infoSession = $_SESSION["user"];
            } 

        ?>

        <div>
            <h1>Profil : </h1>
        </div>

        <div class="user-profile">
            <p><span>Username:</span> <?= $infoSession["pseudo"] ?></p>
            <p><span>Mail:</span> <?= $infoSession["email"] ?></p>
            <p><span>Register Date:</span> <?= date("d-m-Y", strtotime($infoSession["register_date"])) ?></p>
        
        </div>


        <div class="theme-pref">
        <form action="">
            <div class="">
                <label for="theme">Theme preference :</label>
                    Dark:<input type="radio" name="theme" class="radio" value="dark"  required >
                    Light:<input type="radio" name="theme" class="radio" value="light" required>
            </div>
        </form>

        </div>

        <div id="logoutDelete">
            <p><a href="index.php?action=logout"> <span class="text-highlight"><i class="fa-solid fa-power-off"></i></span> Log out</a></p>
            <p><a href="index.php?action=deleteAccount"> <span class="text-highlight"><i class="fa-regular fa-circle-xmark"></i></span> Delete Account</a></p>
        </div>
        

        

           

    </div>

    
    


</div>

<!-- <p><a href="index.php?action=logout"><i class="fa-solid fa-power-off"></i>
</a></p>
        
    <i class="fa-regular fa-circle-xmark"></i> -->

<!-- bouton delete de compte avec demande de confirmation -->
<!-- bouton logout -->




<?php

$titre = "Profile";
$meta_description = "";
$contenu = ob_get_clean();
require "view/template.php";

?>