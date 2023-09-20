<?php
ob_start();
$actor = $requeteUpdateActeur->fetch(); ?>

<form enctype="multipart/form-data" action="index.php?action=updateActeur&id=<?= $actor["id_actor"]?>" method="post">
        
        <h3>update actor</h3>
        
        
        <h2> <?= $actor["acteurComplete"] ?> </h2>
        
        <div class="form-input">
            <label for="person_first_name">First Name :</label>
            <input type="text" placeholder="First Name" name="person_first_name" value="<?= $actor["person_first_name"]?>">


        </div>
        <div class="form-input">
            <label for="person_last_name">Last Name :</label>
            <input type="text" placeholder="Last Name" name="person_last_name" value="<?= $actor["person_last_name"]?>">
        </div>

        <div class="form-input">
            <label for="person_sexe">Gender :</label>
            M:<input type="radio" name="person_sexe" class="radio" value="male" <?php if ($actor["person_sexe"] === "male") echo "checked"; ?>>
            F:<input type="radio" name="person_sexe" class="radio" value="female" <?php if ($actor["person_sexe"] === "female") echo "checked"; ?>>

        </div>

        <div class="form-input">
            <label for="person_birthday">Date of birth :</label>
            <input type="date" name="person_birthday" id="person_birthday" required value="<?= $actor["person_birthday"]?>">
        </div>
        
        <div class="form-input">
            <input type="submit" class="submit" name="updateActor">

        </div>
    </form>


<?php
$titre = "actor";
$titre_secondaire = "update actor" ;
$contenu = ob_get_clean();
require "view/template.php";
?>