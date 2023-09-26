<?php ob_start(); ?>



<div class="container-list">

    <div class="list">

        <?php
            if(isset($_SESSION["user"])) {
                $infoSession = $_SESSION["user"];
            } 

        ?>

        <div>
            <p>Hi - <?= $infoSession["pseudo"] ?> </p>
        </div>

        <div class="user-profile">
            <p>Username: <?= $infoSession["pseudo"] ?></p>
            <p>Mail: <?= $infoSession["email"] ?></p>
            <p>Mail: <?= $infoSession["register_date"] ?></p>
        </div>

        

    </div>

</div>

<?php

$titre = "Profile";
$contenu = ob_get_clean();
require "view/template.php";

?>