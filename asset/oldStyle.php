 <!-- AFFICHAGE REVIEW --------------------------------------------->
            <div class="movie-review">

            <div id="reviewContainer">
      
            </div>

                        <div class="likes">
                            
                        <?php if (isset($_SESSION["user"])) : ?>
                            <!-- Afficher le formulaire de like uniquement si l'utilisateur est connecté -->
                        
                                <i data-id_review="<?=  $review['id_rating'] ?>" class="fa-solid fa-heart fa-heart-click"></i>
                 
                        <?php else : ?>
                            <!-- Afficher une icône de like pour les utilisateurs non connectés -->
                            <i  class="fa-solid fa-heart" style="cursor: default;"></i>
                        <?php endif; ?>

                        <div class="likes-count" data-id_review="<?=  $review['id_rating'] ?>"></div>
                        
       
                        <?php if (isset($_SESSION["user"])) : ?>
                            
                                    <i data-id_review="<?=  $review['id_rating'] ?>" class="fa-solid fa-heart-crack"></i>
             
                        <?php else : ?>
                            <!-- Afficher une icône de like pour les utilisateurs non connectés -->
                            <i class="fa-solid fa-heart-crack" style="cursor: default;"></i>
                        <?php endif; ?>
                     
                            <div class="dislikes-count" data-id_review="<?=  $review['id_rating'] ?>"></div>
                            
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
                        <?php } else { ?>

                            <div class="edit_delete" style="visibility: hidden;">
                                 <div><i class="fa-solid fa-x"></i></div>
                                 <div><i class="fa-solid fa-file-pen"></i></div>
                             </div>
                        <?php } ?>

                    </div>
                    
                    <div class="info">
                        <!-- <p><?= $review["pseudo"] ?> - <?= $review["formatted_date"]?></p> -->
                    </div>
                
            </div>