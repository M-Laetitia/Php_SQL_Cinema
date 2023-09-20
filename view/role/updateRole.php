<?php
ob_start();
$role = $requeteRole->fetch(); ?>



<div>


<form enctype="multipart/form-data" action="index.php?action=updateRole&id=<?=$role["id_role"]?>" method="post">
        
        <h3>Update this role</h3>
        
        <div class="form-input">
            <label for="name_role">Role :</label>
            <input type="text" placeholder="Role name" name="name_role" value="<?= $role["name_role"] ?>" >
        </div>

        
        <div class="form-input">
            <input type="submit" class="submit" name="updateRole" id="updateRole">

        </div>
</form>

</div>




<?php
$titre = "Role";
$titre_secondaire = "update Role" ;
$contenu = ob_get_clean();
require "view/template.php";
?>

