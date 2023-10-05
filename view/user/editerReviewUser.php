<style>
#review {
    border : 1px solid grey;
}

</style>

<?php ob_start(); 
$review = $requeteReviewUser ->fetch();
?>



<h1>edit the review </h1>
<p>Date : <?= $review["formatted_date"]?></p>
<p>Movie : <?= $review["movie_title"]?></p>



<div class="form">

    <form id="" enctype="multipart/form-data" action="index.php?action=editerReviewUser&id=<?= $review["id_rating"]?>" method="post">

        <label for="review"></label>
        <textarea name="review" id="review"  value="<?= $review["review"]?>"   required><?= $review["review"]?></textarea>

        <div class="btn-submit">
                <input type="submit" class="submit" name="editReviewUser" value="publish" >
        </div>

    </form>

    <div class="messages_neutral">
        <?php
            if (isset($_SESSION["message"])) {
                echo "<p>" . $_SESSION["message"] . "</p>";
                unset($_SESSION["message"]); // Supprimer le message de la session
        }?>
    </div>
</div>
   



<?php

$titre = "Add review";
$meta_description = "";
$contenu = ob_get_clean();
require "view/template.php";

?>

