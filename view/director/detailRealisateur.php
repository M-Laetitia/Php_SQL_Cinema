<?php ob_start(); 
$person = $requetedetailRealisateur->fetch(); 
?>

<div class="container_detail container_director">
    <h1 id="name"> <?= $person["realComplete"]?> </h1>
    <div class="detail">
        <div class="image">
            <figure>
                <?php
                    if($person["person_image"] == NULL){
                        echo '<img src="./public/Images/default_movie.jpg" alt="black and white film stock">';
                    }
                    else{
                    echo "<img src=". $person["person_image"] ." alt= '" . $person["person_alt_desc"]. "' >";
                    }
                ?>
            </figure>
        </div>

        <div class="info">
            <div class="listing">
                <ul>
                    <li>Filmographie</li>
                </ul>
            </div>

            <div class="list-filmo_real">
                <?php 
                    foreach($requeteFilms->fetchAll() as $movie) {
                    ?> 
                    <div class="movie-detail">
                        <p><a href="index.php?action=detailFilm&id=<?= $movie["id_movie"]?>"><?= $movie["movie_title"] ?></a></p>
                        <p><?= $movie["movie_release_date"] ?></p>
                    </div>   
                    <?php
                    }
                ?>
            </div>
        </div>

        <div class="description">
            <ul>
                <li>Born : <span class="text-highlight "><?= $person["dateDMY"] ?></span></li>
                <li>Age : <span class= "text-highlight"><?= $person["ActorAge"] ?> years </span></li>
                <li>Gender : <span class= "text-highlight"><?= $person["person_sexe"] ?></span></li>
                <li>Nationality : <span class= "text-highlight"><?= $person["person_nationality"] ?></span></li>
            </ul>
        
            <div class="edit_delete">
                <div><i id="confirmationBox" class="fa-solid fa-x"></i></div>
                <div><a href="index.php?action=updateRealisateur&id=<?=$person["id_director"]?>"> <i class="fa-solid fa-file-pen"></i></a>   </div> 
            </div>
        </div>
    </div>

    <div id="deleteConfirmation">
        <p>Are you sure to want to delete this director? This action can't be undone.</p>   
        <div class="confirm_cancel">
            <a href="index.php?action=supprimerRealisateur&id=<?=$person["id_director"]?>"><i class="fa-solid fa-check fa-lg"></i></a>
            <i id="confirmationClose-btn" class="fa-solid fa-x fa-lg" ></i>
        </div>
    </div>

    
<script>

    const confirmationPopUP = document.getElementById("confirmationBox")
    const popUpConfirmation = document.getElementById("deleteConfirmation")
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
$titre = "More about " . $person["realComplete"];
$meta_description = "Find out more about the director :" . $person["realComplete"];
$contenu = ob_get_clean();
require "view/template.php";
?>