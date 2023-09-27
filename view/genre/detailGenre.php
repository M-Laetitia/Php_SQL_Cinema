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
                <div class="poster">
                    <?php
                    if($genre["movie_image"] == NULL){
                        // echo '<img src="./public/Images/default_movie.jpg" alt="black and white film stock">';
                        echo '<a href="index.php?action=detailFilm&id=' . $genre["id_movie"] . '"><img src="./public/Images/default_movie.jpg" alt="black and white film stock"></a>';
                    }
                    else{
                    // echo "<img src=". $genre["movie_image"] .">";
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
    </div>
</div>

<?php
$titre = $genre["label_genre"] .  " movies list";
$meta_description = "Find out more about the genre :" .$genre["label_genre"];
$contenu = ob_get_clean();
require "view/template.php";
?>