<?php ob_start(); ?>

<div class="container-list register">

    <div class="list">
        <div>
            <h1>Welcome Back ! </h1>
        </div>

        <form enctype="multipart/form-data" action="index.php?action=login" method="POST">

            <!-- <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" id="pseudo"><br> -->
            <div class="register-input">

                <label for="loggin">Pseudo or email:</label>
                <input type="text" name="loggin" id="loggin"><br>

                <label for="password">Password :</label>
                <input type="password" name="password" id="password"><br>
            </div>

            <div id="btn-register" >
                <input type="submit" name="submit" value="Connect">
            </div>

        </form>

        <?php
        if(isset($_SESSION["user"])) { ?>
            <div>
            </div>     
            
        <?php } else { ?>
            <div id="sign-up">
            <p>Don't have an account? <a href="index.php?action=register"><span class="text-highlight">Sign up !</span></a></p>
            </div>
        <?php } ?>


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
$titre = "Login";
$meta_description = "";
$contenu = ob_get_clean();
require "view/template.php";
?>

<!-- John
john@gmail.com
123456AB!65 -->

<!-- lisa
lisa@exemple.com
123456AB!67 -->
