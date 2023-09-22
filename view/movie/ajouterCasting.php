<?php

ob_start();

?>


    <div class="container_form">
        <div class="left_section">
            <h1>Let's Build a <br> <span class="text-colored">Cinematic Treasure <br> Trove</span>  together.</h1>
        </div>

        <div class="form_section">
            <h2>Share Your Movie Wisdom</h2>
            <h3>Add a Casting</h3>
            <div class="form_info">

                <!-- The enctype attribute specifies how the form-data should be encoded when submitting it to the server. 
                This value is necessary if the user will upload a file through the form-->
                <form action="index.php?action=ajouterCasting" enctype="multipart/form-data" method="POST">
                
                    <div class="info_input_cast">

                        <div class="selection-info">
                            <label for="movie"></label>
                            <select name="movie" id="movie" required>
                                <option disabled selected>Select a Movie</option>
                                    <?php
                                        
                                        foreach($requeteFilm->fetchAll() as $movie){
                                    ?>
                                        <option value="<?= $movie["id_movie"] ?>"><?= $movie["movie_title"]?></option>
                                    <?php
                                    
                                        }
                                    ?>

                            </select>
                        </div>


                        <div class="selection-info">
                            <label for="role"></label>
                            <select name="role" id="role" required>
                                <option disabled selected>Select a Role</option>
                                    <?php
                                    
                                        foreach($requeteRole->fetchAll() as $role){
                                    ?>
                                        <option value="<?= $role["id_role"] ?>"><?= $role["name_role"] ?></option>
                                    <?php
                                        
                                        }
                                    ?>

                                </select>

                        </div>

                        <div class="selection-info">
                            <label for="actor"></label>
                            <select name="actor" id="actor" required>
                                <option disabled selected>Select an Actor</option>
                                    <?php
                                    
                                        foreach($requeteActeur->fetchAll() as $actor){
                                    ?>
                                        <option value="<?= $actor["id_actor"] ?>"><?= $actor["person_first_name"] . ' ' . $actor["person_last_name"]?></option>
                                    <?php
                                        
                                        }
                                    ?>

                                </select>
                        </div>

        
                    </div>

                    <div class="btn-submit">
                        <input type="submit" name="submitCasting" value="Submit" class="button-casting">
                    </div>


                </form>
            
            </div>
        </div>
    </div>







    

    



    


</form>

<?php
$titre = "Casting";
$titre_secondaire = "Add Casting";
$contenu = ob_get_clean();
require "view/template.php";