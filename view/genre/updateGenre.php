<?php
ob_start();
$genre = $requeteGenre->fetch(); ?>



<div>

<form action="index.php?action=updateGenre&id=<?=$genre["id_genre"]?>" method="POST">
    
    <h1>Update this genre</h1>
    
    <div class="form-input">
        <label for="label_genre">Genre :</label>
        <input name="label_genre" type="text"required value="<?= $genre["label_genre"] ?>">
    </div>

    <div class="button-input">
        <input type="submit" name="updateGenre" value="Update">
    </div>
</form>
</div>


<?php
$titre = "genre";
$titre_secondaire = "update genre" ;
$contenu = ob_get_clean();
require "view/template.php";
?>