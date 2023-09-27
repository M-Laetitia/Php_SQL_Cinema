<?php ob_start(); ?>

<h1 class="title_ref"> Directors List</h1>
<div class="container-list-person">
    <div class="searchBar"></div>
    <div class="list-person">
        <?php 
        foreach($requete->fetchAll() as $person) { ?>
            <div class="person-card">
                <div class="portrait">
                    <?php
                        if($person["person_image"] == NULL){
                            echo '<a href="index.php?action=detailRealisateur&id=' . $person["id_director"] . '"><img src="./public/Images/default_movie.jpg" alt="black and white film stock"></a>';
                        }
                        else{
                            echo '<a href="index.php?action=detailRealisateur&id=' . $person["id_director"] . '"><img src="' . $person["person_image"] . '" alt= "' . $person["person_alt_desc"] . '" ></a>';
                        }
                    ?>  
                </div>

                <div class="info">
                    <p><a href="index.php?action=detailRealisateur&id=<?= $person["id_director"] ?>"><?= $person["realComplete"] ?></a></p>
                    <p><?= $person["person_nationality"] . ' - ' . $person["ActorAge"] ?> years</p>
                </div>
            </div>
            
        <?php } ?>     
    </div>
<?php

$titre = " Directors";
$meta_description = "Browse through the directors list";
$contenu = ob_get_clean();
require "view/template.php";
?>