<?php
ob_start();
 ?>



<?php
$titre = "Home";
$meta_description = "CineVault provides a large database of movies, actors, directors created and updated by a cinephile community ";
$contenu = ob_get_clean();
require "view/template.php";
?>

