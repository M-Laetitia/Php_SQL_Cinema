<?php ob_start(); ?>


<class class="wrapper-review">
    <class class="form_section">
        <h1>Your opinion matters, share a review for</p>
        <h2> titre film</h2>
        
        <div class="form">
        <!-- <form enctype="multipart/form-data" action="" method="POST"> -->

        <form enctype="multipart/form-data" action="index.php?action=ajouterReview&id=<?= $movie["id_movie"]?>" method="post">

                <!-- <label for="review-title">Title</label>
                <input type="text" placeholder="Title" name="title" id="review-title" required> -->

                <label for="review">Your review</label>
                <textarea placeholder="Your review" name="review" id="review"  required></textarea>


                <div class="btn-submit">
                        <input type="submit" class="submit" name="submitReview" >
                </div>


            </form>
        </div>
    </class>
</class>

<?php

$titre = "Add review";
$meta_description = "";
$contenu = ob_get_clean();
require "view/template.php";

?>