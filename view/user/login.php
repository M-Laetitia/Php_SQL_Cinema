<?php ob_start(); ?>

<div>
    <p>login</p>
</div>

<form enctype="multipart/form-data" action="index.php?action=login" method="POST">

    <!-- <label for="pseudo">Pseudo</label>
    <input type="text" name="pseudo" id="pseudo"><br> -->

    <label for="email">Email</label>
    <input type="text" name="email" id="email"><br>

    <label for="password">password</label>
    <input type="password" name="password" id="password"><br>

    <input type="submit" name="submit" value="Se connecter">

</form>


<?php

$titre = "login";
$contenu = ob_get_clean();
require "view/template.php";

?>
