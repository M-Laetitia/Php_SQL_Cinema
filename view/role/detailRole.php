<?php ob_start();
$role = $requeteDetailRole->fetch();
// var_dump($role);die;?>


<div class="container container-genre">
    <h1> <?= $role["name_role"]?></h1>

    <div class="edit_delete">
        <div><i id="confirmationBox" class="fa-solid fa-x"></i></a></div>
        <div><a href="index.php?action=updateRole&id=<?=$role["id_role"]?>"><i class="fa-solid fa-file-pen"></i></a></div>
    </div>

    <div id="deleteConfirmationRole">
        <p>Are you sure to want to delete this role? This action can't be undone.</p>   
        <div class="confirm_cancel">
        <a href="index.php?action=supprimerRole&id=<?=$role["id_role"]?>"><i class="fa-solid fa-check fa-lg"></i></a>
            <i id="confirmationClose-btn" class="fa-solid fa-x fa-lg" ></i>
        </div>
    </div>

    <div class="list">
        <?php $requeteDetailRole->fetch(); { ?>
            <div class="card">
                <div class="poster">
                    <?php
                    if($role["person_image"] == NULL){
                        echo '<img src="./public/Images/default_movie.jpg" alt="black and white film stock">';
                    }
                    else{
                    echo "<img src=". $role["person_image"] .">";
                    }
                    ?> 
                </div>

                <div class="info">
                    <?php if ($role["id_actor"]) { ?>
                        <p><a href="index.php?action=detailActeur&id=<?= $role["id_actor"] ?>"><?= $role["actorComplete"] ?></a></p>
                       
                    
                    <?php } ?>

                    <?php if ($role["id_movie"]) { ?>
                        <p><a href="index.php?action=detailFilm&id=<?= $role["id_movie"]?>"><?= $role["movie_title"]?></a></p>
              
                    <?php } ?>
                </div>
                
            </div>
        <?php } ?>
    </div>
</div>


<script>

    const confirmationPopUP = document.getElementById("confirmationBox")
    const popUpConfirmation = document.getElementById("deleteConfirmationRole")
    const closeConfirmationPopUp = document.getElementById("confirmationClose-btn")
    confirmationPopUP.addEventListener('click', () => {
    if (popUpConfirmation.style.display === 'none' || popUpConfirmation.style.display === '') {
        popUpConfirmation.style.display = 'flex'
    }else {
        popUpConfirmation.style.display = 'none'
    }
    });

    closeConfirmationPopUp.addEventListener('click', () => {
        popUpConfirmation.style.display = 'none'
    });

</script>

<?php
$titre = "More about ". $role["name_role"];
$meta_description = "Find out more about the role :" .$role["name_role"];
$contenu = ob_get_clean();
require "view/template.php";
?>
