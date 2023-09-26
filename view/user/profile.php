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
            <p>Username: <?= $infoSession["pseudo"] ?></p>
            <p>Mail: <?= $infoSession["email"] ?></p>
            <p>Register date: <?= $infoSession["register_date"] ?></p>
        
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
$contenu = ob_get_clean();
require "view/template.php";

?>