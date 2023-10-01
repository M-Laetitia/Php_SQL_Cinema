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

*

        <div class="theme-pref">
            <form enctype="multipart/form-data" action="index.php?action=themePreference" method="POST">
                <label for="lightTheme">Light Theme</label>
                <input type="radio" id="lightTheme" name="theme" value="light">
                
                <label for="darkTheme">Dark Theme</label>
                <input type="radio" id="darkTheme" name="theme" value="dark">
                
                <input type="submit" class="submit" name="submitTheme" id="submitRole" value="Update">
            </form>
        </div>

        <div id="logoutDelete">
            <p><a href="index.php?action=logout"> <span class="text-highlight"><i class="fa-solid fa-power-off"></i></span> Log out</a></p>
            <p><a href="index.php?action=deleteAccount"> <span class="text-highlight"><i class="fa-regular fa-circle-xmark"></i></span> Delete Account</a></p>
        </div>
        

        <div class="liste-notes-film">
            <p>My movies ratings:</p>
            <?php 
                $notes = $requete->fetchAll();
                if (empty($notes)) {
                    echo '<p>No rating here yet!</p>';
                } else {
                    foreach ($notes as $note) {
                        ?>
                        <p>
                            <?= $note["note"] ." - ". $note["movie_title"]?>
                            <a href="#">Éditer</a>
                        </p>
                        <?php
                    }
                }
            ?>
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