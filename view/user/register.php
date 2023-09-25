<?php ob_start(); ?>

<div>
    <p>Register</p>
</div>

<form enctype="multipart/form-data" action="index.php?action=register" method="POST">

    <label for="pseudo">Pseudo</label>
    <input type="text" name="pseudo" id="pseudo"><br>

    <label for="email">Email</label>
    <input type="email" name="email" id="email"><br>

    <label for="pass1">password</label>
    <input type="password" name="pass1" id="pass1"><br>

    <label for="pass2">Confirmation du password</label>
    <input type="password" name="pass2" id="pass2"><br>

    <input type="submit" name="submit" value="S'enregistrer">

</form>


<?php

$titre = "register";
$contenu = ob_get_clean();
require "view/template.php";

?>
