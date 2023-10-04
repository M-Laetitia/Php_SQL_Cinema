<?php ob_start(); ?>

<div>
    <?php 
    // initialiser un tableau pour stocker les genres
    $genres = array();
    foreach($requeteGenres->fetchAll() as $movie) {
        $genres[] = '<a href="index.php?action=detailGenre&id=' . $movie["id_genre"] . '">' . $movie["genres"] . '</a>';
    }
        $genresConcatenated = implode(', ', $genres);
        // echo '<p>'. $genresConcatenated . '</p>';
    $movie = $requetedetailFilm->fetch(); 
    ?>

    <div class="container_detail container_movie">
        <h1 id="name"> <?= $movie["movie_title"]?> </h1>
        <div class="detail">

            <div class="image">
                <figure>
                    <?php if($movie["movie_image"] == NULL){
                            echo '<img src="./public/Images/default_movie.jpg" alt="black and white film stock">';
                        }
                        else {
                        echo "<img    src=". $movie["movie_image"] ." alt= '" . $movie["movie_alt_desc"]. "' >";
                        } ?>
                </figure>
            </div>

            <div class="info">
                <div class="description">
                    <ul>
                        <li> <span class="text-highlight ">★</span> <?= $notes["noteMoyenne"] ?></li>

                        
                        <li>Genre : <span class="text-highlight genre"><?= $genresConcatenated ?></span> </li>
                        <li>Run Time : <?= $movie["formatted_duration"] ?></li>
                        <li>Country : <span class="text-highlight"><?= $movie["movie_country"] ?></span></li>
                        <li>Release : <?= $movie["movie_release_date"] ?></li>
                    </ul>
                </div>

                <div class="crew">
                    <ul>
                        <li>Director : <span class="text-highlight"><a href="index.php?action=detailRealisateur&id=<?= $movie["id_director"]?>"><?= $movie["realisateurComplete"] ?></a></span></li>
                        <li>Actors : 
                            <?php foreach($requeteCastingFilm->fetchAll() as $play) { ?>  
                                <span class="text-highlight"><a href="index.php?action=detailActeur&id=<?= $play["id_actor"] ?>"><?= $play["actorComplete"] . "," ?></a></span>
                            <?php } ?>
                        </li>
                    </ul>
                    
                    <div class="edit_delete">
                        <div><a href="index.php?action=supprimerFilm&id=<?=$movie["id_movie"]?>"><i class="fa-solid fa-x"></i></a></div>
                        <div><a href="index.php?action=updateFilm&id=<?=$movie["id_movie"]?>"> <i class="fa-solid fa-file-pen"></i></a></div> 
                    </div>
                </div>
            </div>

            <div class="storyline">
                <p><span class="text-highlight">Storyline : </span></p>
                <textarea readonly> <?= $movie["movie_synopsys"]?></textarea>
            </div>
        </div>


        <div class="test-like">
            <i class="fa-solid fa-heart"></i>
            <span>Liked !</span>              
        </div>

        <div class="review">

            <div class="rate-average">
                <div class="rate">
                    <p><span class="text-highlight ">★</span> <?= $notes["noteMoyenne"] ?> /5</p>
                    <p> <?= $nombreNotes["nb_note"] ?> Ratings</p>
                </div>

                 <!-- Possibilité de laisser une note uniquement si user connecté -->
                <?php 
                if(isset($_SESSION["user"])) {
                    $userId = $_SESSION['user']['id_user'];?>

                    <div class="rating">
                        <p id="add-rating-btn"><i class="text-highlight  fa-solid fa-plus"></i></p>
                        <p>Rate this Movie :</p>
                    </div>
                <?php } ?>
            </div>


            <div class="review-top">
                <div class="left">
                    <p>User reviews : </p>
                    <p><?= $nb_review["nb_review"] ?></p>
                    <p id="reviews-btn" class="text-highlight">▼</p>
                </div>


                <!-- Possibilité de laisser une review uniquement si user connecté -->
                <?php 
                if(isset($_SESSION["user"])) {
                    $userId = $_SESSION['user']['id_user'];?>
                    <div class="right">
                        <p id="add-review-btn"><i class="text-highlight  fa-solid fa-plus"></i></p>
                    <p>Review</p>
                </div>
                <?php } ?>   
            </div>


            <!-- AFFICHAGE REVIEW --------------------------------------------->
            <div class="movie-review">
                <?php foreach ($reviews as $review) { 
                    // $formattedDate = date('d M Y', strtotime($review['formatted_date']));
                    ?>
                    <div class="review-text">

                        <div class="text">
                            <p><span class="text-highlight">★</span> <?= $review["note"] ?>/5</p>
                            <p><?= $review["review"] ?></p>
                        </div>

                        <div class="likes">
                            <form  enctype="multipart/form-data" action="index.php?action=addLike&id=<?=$review['id_rating']?>" method="post">
                                <button type="submit" class="submit" name="submitLike" id="submitLike">
                                <i class="fa-solid fa-heart"></i>
                                <span>liked!</span>

                            </button>
                            </form>

                            <!-- <div><?= $review['nb_likes'] ?></div> -->
                            
                            <form  enctype="multipart/form-data" action="index.php?action=addDislike&id=<?=$review['id_rating']?>" method="post">
                                <button type="submit" class="submit" name="submitDislike" id="submitDislike">
                                    <i class="fa-solid fa-heart-crack"></i>
                                </button>
                            </form>

                            <!-- <div><?= $review['nb_dislikes']?></div> -->
                        
                        </div>

                        <!-- Possibilité d'éditer/supprimer une review uniquement si user moderateur-->
                        <?php 
                        // mauvaise façon de vérifier la présence de la clé role et de sa valeur
                        // if(isset($_SESSION["user"]['role'] === 'moderateur')) { 
                        if (isset($_SESSION["user"]) && isset($_SESSION["user"]["role"]) && $_SESSION["user"]["role"] === 'moderateur') {

                            $userId = $_SESSION['user']['id_user'];
                            // var_dump($review['id_rating']); die; ?>

                        <div class="edit_delete">
                            <div><a href="index.php?action=supprimerReview&id=<?=$review['id_rating']?>"> <i class="fa-solid fa-x"></i></a></div> 
                            <div><a href="index.php?action=editerReview&id=<?=$review['id_rating']?>"> <i class="fa-solid fa-file-pen"></i></a></div> 
                        </div>
                        <?php } ?>
                    </div>
                    
                    <div class="info">
                        <p><?= $review["pseudo"] ?> - <?= $review["formatted_date"]?></p>
                    </div>
                <?php } ?>
            </div>

            <div class="addReview-popUp">
                <div class="reviewplace">
                    <p> <i id="reviewClose-btn" class="fa-solid fa-x fa-lg"></i> </p>
                    <p></p>
                    <p>Your opinion matters, share your review for </p>
                    <p class="text-highlight"> <?= $movie["movie_title"]?></p>
                    
                    <div class="form">

                        <form id="" enctype="multipart/form-data" action="index.php?action=ajouterReview&id=<?= $movie["id_movie"]?>" method="post">

                            <!-- <label for="review-title">Title</label>
                            <input type="text" placeholder="Title" name="title" id="review-title" required> -->

                            <label for="review"></label>
                            <textarea placeholder="Write here..." name="review" id="review" maxlength="800" minlength="200" required></textarea>

                            <div class="btn-submit">
                                    <input type="submit" class="submit" name="submitReview" value="publish" >
                            </div>

                        </form>

                        <?php
                            if (isset($_SESSION["message"])) {
                                echo "<p>" . $_SESSION["message"] . "</p>";
                                unset($_SESSION["message"]); // Supprimer le message de la session
                        }?>
                    </div>
                </div>
            </div>

            <div class="addRating-popUp">
                <div class="ratingPlace">
                    <p> <i id="ratingClose-btn" class="fa-solid fa-x fa-lg"></i> </p>
                    <p></p>
                    <p>Rate this</p>
                    <p class="text-highlight"> <?= $movie["movie_title"]?></p>
                    
                    <div class="form">
                        <div class="popUpRating" >
                            <form id="rating-form" action="index.php?action=addRating&id=<?=$movie["id_movie"]?>" enctype="multipart/form-data" method="POST">

                            <!-- <div class="stars-rating">
                                <span class="star" data-rating="1"></span>
                                <span class="star" data-rating="2"></span>
                                <span class="star" data-rating="3"></span>
                                <span class="star" data-rating="4"></span>
                                <span class="star" data-rating="5"></span>
                            </div> -->
                                                                    
                            <div>
                                <input type="number" name="user_rating" id="user_rating" min="1" max="5">
                                <!-- Champ input hidden pour stocker la note -->
                                <!-- <input type="hidden" name="user_rating_hidden" id="user_rating_hidden" value=""> -->
                            </div>

                            <div class="btn-submit">
                                <button   id="submitForm" type="submit">RATE</button>
                            </div>
                    

                            </form>

                            <div>
                                <?php
                                    if (isset($_SESSION["message"])) {
                                        echo "<p>" . $_SESSION["message"] . "</p>";
                                        unset($_SESSION["message"]); // Supprimer le message de la session
                                }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function bgImageLoader(bgImage){

    const url = window.location.href;
    let backgroundPath = ''; // Déclarer la variable JavaScript

    if (url.includes("action=detailFilm")) {
        const main = document.querySelector('main');
        main.classList.add('custom-background');
        main.style.backgroundImage = "url("+bgImage+")";
        console.log(main)}
    }
</script>

<?php if ($filmBackgroundPath != null){ ?>
    <script>
        bgImageLoader("<?= $filmBackgroundPath ?>") 
    </script>
<?php } ?>


<script>
    //displaying review popUp
    const displayReviewBtn = document.getElementById('reviews-btn')
    const reviewList = document.querySelector('.movie-review')
    // console.log(reviewList);
    displayReviewBtn.addEventListener('click', () => {
    if (reviewList.style.display === 'none' || reviewList.style.display === '') {
        displayReviewBtn.textContent = '▲';
        reviewList.style.display = 'block'
    }else {
        displayReviewBtn.textContent = '▼';
        reviewList.style.display = 'none'
    }
    });

    // add review popUp
    const addReview_btn = document.getElementById('add-review-btn')
    console.log(addReview_btn);
    const addReview_popUp = document.querySelector('.addReview-popUp')

    addReview_btn.addEventListener('click', () => {
    if (addReview_popUp.style.display === 'none' || addReview_popUp.style.display === '') {
        addReview_popUp.style.display = 'block'
    }else {
        addReview_popUp.style.display = 'none'
    }
    });

    const reviewClose_btn = document.getElementById('reviewClose-btn')
    reviewClose_btn.addEventListener('click', () => {
        addReview_popUp.style.display = 'none'
        
    });

    // add rating popUP
    const addRating_btn = document.getElementById('add-rating-btn')
    const addRatingPopUp = document.querySelector('.addRating-popUp')
    addRating_btn.addEventListener('click', () => {
    if (addRatingPopUp.style.display === 'none' || addRatingPopUp.style.display === '') {
        addRatingPopUp.style.display = 'block'
    }else {
        addRatingPopUp.style.display = 'none'
    }
    });

    const ratingClose_btn = document.getElementById('ratingClose-btn')
    ratingClose_btn.addEventListener('click', () => {
        addRatingPopUp.style.display = 'none'
    });

</script>


<?php
$titre = "More about " .$movie["movie_title"];
$meta_description = "Browse through the movies catalogue";
$contenu = ob_get_clean();
require "view/template.php";
?>