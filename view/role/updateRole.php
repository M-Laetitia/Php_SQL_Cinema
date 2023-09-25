<?php
ob_start();
$role = $requeteRole->fetch(); ?>

<div class="wrapper-form">
    <div class="container_form">
        <div class="left_section">
            <h1>Let's Build a <br> <span class="text-colored">Cinematic Treasure <br> Trove</span>  together.</h1>
        </div>

        <div class="form_section">
            <h2>Share Your Movie Wisdom</h2>
            <h3>Update : <?=$role["name_role"]?></h3>
            <div class="form_info">

                <form enctype="multipart/form-data" action="index.php?action=updateRole&id=<?=$role["id_role"]?>" method="post">
                    <div class="info_input">
                        <div class="form-input">
                            <label for="name_role"></label>
                            <input type="text" placeholder="Role name*" name="name_role" id="name_role" value="<?= $role["name_role"] ?>" required>
                        </div>
                    </div>

                    <div class="btn-submit">
                        <input type="submit" class="submit" name="updateRole" id="submitRole" value="Update">
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

<?php
$titre = "Role";
$titre_secondaire = "update Role" ;
$contenu = ob_get_clean();
require "view/template.php";
?>