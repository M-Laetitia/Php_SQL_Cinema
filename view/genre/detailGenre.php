<?php ob_start();
$genre = $requeteGenre->fetch();?>

<div class="container container-genre">
    <h1><?= $genre["label_genre"] ?></h1>

    <div class="edit_delete">
        <div><a href="index.php?action=supprimerGenre&id=<?=$genre["id_genre"]?>"><i class="fa-solid fa-x"></i></a></div>
        <div><a href="index.php?action=updateGenre&id=<?=$genre["id_genre"]?>"><i class="fa-solid fa-file-pen"></i></a></div>
    </div>

    <div class="list">
        <?php foreach($requeteDetailGenre->fetchAll() as $genre) { ?>
            <div class="card">
                <figure>
                    <?php
                    if($genre["movie_image"] == NULL){
                        echo '<img src="./public/Images/default_movie.jpg" alt="black and white film stock">';
                    }
                    else{
                    echo "<img src=". $genre["movie_image"] .">";
                    }
                    ?> 
                </figure>

                <div class="info">
                    <p><a href="index.php?action=detailFilm&id=<?= $genre["id_movie"]?>"><?= $genre["movie_title"]?></a></p>
                    <p><a href="index.php?action=detailRealisateur&id=<?= $genre["id_director"]?>"><?= $genre["directorComplete"]?></a></p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php
$titre = "List Genre";
$contenu = ob_get_clean();
require "view/template.php";
?>