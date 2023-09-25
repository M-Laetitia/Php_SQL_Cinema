<?php ob_start(); ?>

<div class="container-list-person">
    <div class="searchBar"></div>
    <div class="list-person">
        <?php 
        foreach($requete->fetchAll() as $person) { ?>
            <div class="person-card">
                <div class="portrait">
                    <?php
                        if($person["person_image"] == NULL){
                            // echo '<img src="./public/Images/default_movie.jpg" alt="black and white film stock">';
                            echo '<a href="index.php?action=detailActeur&id=' . $person["id_actor"] . '"><img src="./public/Images/default_movie.jpg" alt="black and white film stock"></a>';
                        }
                        else{
                            echo '<a href="index.php?action=detailActeur&id=' . $person["id_actor"] . '"><img src="' . $person["person_image"] . '"></a>';

                            // Another ways to make the redirection with the hyperlink by clicking on the picture

                            // echo '<a href="index.php?action=detailActeur&id=' . $person["id_actor"] . '">';
                            // echo '<img src="' . $person["person_image"] . '">';
                            // echo '</a>';
                        
                            // echo '<img src="' . $person["person_image"] . '" onclick="window.location=\'index.php?action=detailActeur&id=' . $person["id_actor"] . '\'">';

                        }
                    ?>
                </div>

                <div class="info">
                    <p><a href="index.php?action=detailActeur&id=<?= $person["id_actor"] ?>"><?= $person["acteurComplete"] ?></a></p>
                    <p><?= $person["person_nationality"] . ' - ' . $person["ActorAge"] ?> years</p>
                </div>

            </div>
        <?php } ?>  
    </div>

<?php

$titre = "Actors List";
$contenu = ob_get_clean();
require "view/template.php";
?>