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
                                echo '<img src="./public/Images/default_movie.jpg" alt="black and white film stock">';
                            }
                            else{
                            echo "<img src=". $person["person_image"] .">";
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

