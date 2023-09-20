<?php
ob_start();
$director = $requeteUpdateRealisateur->fetch(); ?>

<form enctype="multipart/form-data" action="index.php?action=updateRealisateur&id=<?= $director["id_director"]?>" method="post">
        
        <h3>update director</h3>
        
        
        <h2> <?= $director["directorComplete"] ?> </h2>
        
        <div class="form-input">
            <label for="person_first_name">First Name :</label>
            <input type="text" placeholder="First Name" name="person_first_name" value="<?= $director["person_first_name"]?>">


        </div>
        <div class="form-input">
            <label for="person_last_name">Last Name :</label>
            <input type="text" placeholder="Last Name" name="person_last_name" value="<?= $director["person_last_name"]?>">
        </div>

        <div class="form-input">
            <label for="person_sexe">Gender :</label>
            M:<input type="radio" name="person_sexe" class="radio" value="male" <?php if ($director["person_sexe"] === "male") echo "checked"; ?>>
            F:<input type="radio" name="person_sexe" class="radio" value="female" <?php if ($director["person_sexe"] === "female") echo "checked"; ?>>

        </div>

        <div class="form-input">
            <label for="person_birthday">Date of birth :</label>
            <input type="date" name="person_birthday" id="person_birthday" required value="<?= $director["person_birthday"]?>">
        </div>
        
        <div class="form-input">
            <input type="submit" class="submit" name="updateDirector">

        </div>
    </form>


<?php
$titre = "actor";
$titre_secondaire = "update actor" ;
$contenu = ob_get_clean();
require "view/template.php";
?>