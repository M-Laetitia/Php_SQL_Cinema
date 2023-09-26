<?php ob_start(); ?>



<div class="container-list">

    <div class="list">

    <div>
        <p>Join Us !</p>
    </div>

    <form enctype="multipart/form-data" action="index.php?action=register" method="POST">

        <label for="pseudo">Username</label>
        <input type="text" name="pseudo" id="pseudo"><br>

        <label for="Mail">Email</label>
        <input type="email" name="email" id="email"><br>

        <label for="pass1">Password</label>
        <input type="password" name="pass1" id="pass1"><br>

        <label for="pass2">Password confirmation</label>
        <input type="password" name="pass2" id="pass2"><br>

        <input type="submit" name="submit" value="S'enregistrer">

    </form>



    </div>
</div>









<?php

$titre = "register";
$contenu = ob_get_clean();
require "view/template.php";

?>
