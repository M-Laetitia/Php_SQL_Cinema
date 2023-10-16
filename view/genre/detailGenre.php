<?php ob_start();
$genre = $requeteGenre->fetch();?>

<div class="container container-genre">
    <h1><?= $genre["label_genre"] ?></h1>

    <div class="edit_delete">
        <div><i id="confirmationBox" class="fa-solid fa-x"></i></a></div>
        <div><a href="index.php?action=updateGenre&id=<?=$genre["id_genre"]?>"><i class="fa-solid fa-file-pen"></i></a></div>
    </div>

    <div id="deleteConfirmationGenre">
        <p>Are you sure to want to delete this genre? This action can't be undone.</p>   
        <div class="confirm_cancel">
        <a href="index.php?action=supprimerGenre&id=<?=$genre["id_genre"]?>"><i class="fa-solid fa-check fa-lg"></i></a>
            <i id="confirmationClose-btn" class="fa-solid fa-x fa-lg" ></i>
        </div>
    </div>

    <div class="list">
        <?php foreach($requeteDetailGenre->fetchAll() as $genre) { ?>
            <div class="card">
                <div class="poster">
                    <?php
                    if($genre["movie_image"] == NULL){
                        echo '<a href="index.php?action=detailFilm&id=' . $genre["id_movie"] . '"><img src="./public/Images/default_movie.jpg" alt="black and white film stock"></a>';
                    }
                    else{
                    echo '<a href="index.php?action=detailFilm&id=' . $genre["id_movie"] . '"><img src="' . $genre["movie_image"] . '"  alt= "' . $genre["movie_alt_desc"] . '"  ></a>';
                    }
                    ?> 
                </div>

                <div class="info">
                    <p><a href="index.php?action=detailFilm&id=<?= $genre["id_movie"]?>"><?= $genre["movie_title"]?></a></p>
                    <p><a href="index.php?action=detailRealisateur&id=<?= $genre["id_director"]?>"><?= $genre["directorComplete"]?></a></p>
                </div>
            </div>
        <?php } ?>

        <div class="messages_neutral">
            <?php
                if (isset($_SESSION["message"])) {
                    echo "<p>" . $_SESSION["message"] . "</p>";
                    unset($_SESSION["message"]); 
            }?>
        </div>
    </div>
</div>

<script>

    const confirmationPopUP = document.getElementById("confirmationBox")
    const popUpConfirmation = document.getElementById("deleteConfirmationGenre")
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
$titre = $genre["label_genre"] .  " movies list";
$meta_description = "Find out more about the genre :" .$genre["label_genre"];
$contenu = ob_get_clean();
require "view/template.php";
?>