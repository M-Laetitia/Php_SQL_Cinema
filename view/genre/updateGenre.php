<?php
ob_start();
$genre = $requeteGenre->fetch(); ?>

<div class="container_form">
    <div class="left_section">
        <h1>Let's Build a <br> <span class="text-colored">Cinematic Treasure <br> Trove</span>  together.</h1>
    </div>

    <div class="form_section">
        <h2>Share Your Movie Wisdom</h2>
        <h3>Update : <?=$genre["label_genre"]?> </h3>
        <div class="form_info">

            <form action="index.php?action=updateGenre&id=<?=$genre["id_genre"]?>" method="POST">

                <div class="info_input">
                    <div class="form-input">
                        <label for="label_genre"></label>
                        <input type="text" placeholder="Genre*" name="label_genre" id="label_genre" value="<?= $genre["label_genre"] ?>" required>
                    </div>
                </div>

                <div class="btn-submit">
                    <input type="submit" class="submit" name="updateGenre"  value="Update">
                </div>

            </form>
        </div>
    </div>
<div>

<?php
$titre = "genre";
$titre_secondaire = "update genre" ;
$contenu = ob_get_clean();
require "view/template.php";
?>