<?php 
ob_start(); 
?>




<div class="container-list register">
    <div class="list">
        <?php
            if(isset($_SESSION["user"])) {
                $infoSession = $_SESSION["user"];
            } 
        ?>

        <div>
            <h1><?= $infoSession["pseudo"] ?> </h1>
        </div>

        <div class="user-profile">
            <p><span>Username:</span> <?= $infoSession["pseudo"] ?></p>
            <p><span>Mail:</span> <?= $infoSession["email"] ?></p>
            <p><span>CineVault member since:</span> <?= date("d-m-Y", strtotime($infoSession["register_date"])) ?></p>
        </div>

        <div class="theme-pref">
            <p id="title">Set preferred theme : </p>
            <div class="themes">
                <form enctype="multipart/form-data" action="index.php?action=themePreference" method="POST">
                    <p>
                        <label for="lightTheme">Light:</label>
                        <input type="radio" id="lightTheme" name="theme" value="light">
                    </p>
                    <p>
                        <label for="darkTheme">Dark:</label>
                        <input type="radio" id="darkTheme" name="theme" value="dark">
                    </p>
            </div>    
                <input type="submit" class="submit" name="submitTheme" id="submitRole" value="Update">
            </form>
        </div>

        <div>
            <p></p>
        </div>

        <div class="liste-notes">
            <p>My movie reviews: </p>
            <p><span class="text-highlight" id="toggle-list">▼</span></p>
            </div>
                <div class="container01">
                    
                    <div class="un" id="divUn" style="visibility: visible;" >
                        <?php 
                            $reviews = $requeteReviews->fetchAll();
                            if (empty($reviews)) {
                                echo '<p>No review here yet!</p>';
                            } else {
                                foreach ($reviews as $reviews) {
                                    ?>
                                    <div class="review">
                                        <p> <span class="text-highlight" >•</span>
                                            <a href="index.php?action=detailFilm&id=<?= $reviews["id_movie"]?>"><?= $reviews["movie_title"] ?></a> : 
                                        </p>

                                        <p> Date : <?= $reviews["formatted_date"]?></p>

                                        <p><?= $reviews["review"]?></p>

                                       

                                        <div><i id="toggleButton2" class="fa-solid fa-file-pen"></i></a></div> 
                                    </div>

                                        
                                <?php }
                            }?>
                    </div>

                    <div class="deux" id="divDeux"  style="visibility: hidden;">
                        <?php 
                            $review = $requeteReviews->fetch(); ?>
                                    <div class="review">
                                        <p> <span class="text-highlight" >•</span>
                                            <a href=""></a> : 
                                        </p>

                                        <p> Date : </p>

                                        <form id="" enctype="multipart/form-data" action="index.php?action=editerReview&id=<?= $review["id_rating"]?>" method="post">

                                            <label for="review"></label>
                                            <textarea name="review" id="review"   required></textarea>

                                            <div class="btn-submit">
                                                    <input type="submit" class="submit" name="editReview" value="publish" >
                                            </div>

                                        </form>

                                        <div ><i class="fa-solid fa-file-pen"></i></div> 
                                    </div>               
                    </div>

            </div>


            <div class="liste-notes">
            <p>My movie ratings: </p>
            <p><span class="text-highlight" id="toggle-review">▼</span></p>
            </div>
                <div class="ratings-section">
                    
                    <div class="liste-notes-film" id="review-list" style="display: none;">
                        <?php 
                            $notes = $requete->fetchAll();
                            if (empty($notes)) {
                                echo '<p>No reviews here yet!</p>';
                            } else {
                                foreach ($notes as $note) {
                                    ?>
                                        <p> <span class="text-highlight" >•</span>
                                            <a href="index.php?action=detailFilm&id=<?= $note["id_movie"]?>"><?= $note["movie_title"] ?></a> : 
                                            <?= $note["note"]?> /5
                                        </p>
                                    <?php
                                }
                            }
                        ?>
                    </div>
            </div>



        <div id="logoutDelete">
            <p><a href="index.php?action=logout"> <span class="text-highlight"><i class="fa-solid fa-power-off"></i></span> Log out</a></p>
            <p><a href="index.php?action=deleteAccount"> <span class="text-highlight"><i class="fa-regular fa-circle-xmark"></i></span> Delete Account</a></p>
        </div>

        <div>
            
        <?php
            if (isset($_SESSION["message"])) {
                echo "<p>" . $_SESSION["message"] . "</p>";
                unset($_SESSION["message"]); // Supprimer le message de la session
        }?>
        </div>
        
    </div>
    





</div>





<script>

    // display or hide the movie ratings list
    const toggleButton = document.getElementById('toggle-list');
    const ratingsList = document.getElementById('ratings-list');

    toggleButton.addEventListener('click', () => {
        if (ratingsList.style.display === 'none' || ratingsList.style.display === '') {
            ratingsList.style.display = 'block';
            toggleButton.textContent = '▲'; // Flèche vers le haut
        } else {
            ratingsList.style.display = 'none';
            toggleButton.textContent = '▼'; // Flèche vers le bas
        }
    });



    // display or hide the movie reviews list
    const toggleReviewButton = document.getElementById('toggle-review');
    const reviews_list = document.getElementById('review-list');

    toggleReviewButton.addEventListener('click', () => {
        if (reviews_list.style.display === 'none' || reviews_list.style.display === '') {
            reviews_list.style.display = 'block';
            toggleReviewButton.textContent = '▲'; // Flèche vers le haut
        } else {
            reviews_list.style.display = 'none';
            toggleReviewButton.textContent = '▼'; // Flèche vers le bas
        }
    });

    // essai édit sur place
    const divUn = document.getElementById("divUn");
    const divDeux = document.getElementById("divDeux");
    const toggleButton2 = document.getElementById("toggleButton2");

    toggleButton2.addEventListener("click", function() {
    if (divUn.style.visibility === "hidden") {
        divUn.style.visibility = "visible";
        divDeux.style.visibility = "hidden";
    } else {
        divUn.style.visibility = "hidden";
        divDeux.style.visibility = "visible";
    }
    });



</script>

<?php

$titre = "Profile";
$meta_description = "";
$contenu = ob_get_clean();
require "view/template.php";

?>