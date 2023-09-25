<?php ob_start(); ?>


<?php

$titre = "Home";
$contenu = ob_get_clean();
require "view/template.php";

?>

