<?php
ob_start();
$director = $requeteUpdateRealisateur->fetch(); ?>


<div class="container_form">
                <div class="left_section">
                    <h1>Let's Build a <br> <span class="text-colored">Cinematic Treasure <br> Trove</span>  together.</h1>
                </div>

                <div class="form_section">
                    <h2>Share Your Movie Wisdom</h2>
                    <h3>Update: <?= $director["directorComplete"] ?> </h3>
                    <div class="form_info">

                        <!-- The enctype attribute specifies how the form-data should be encoded when submitting it to the server. 
                            This value is necessary if the user will upload a file through the form-->
                         <form enctype="multipart/form-data" action="index.php?action=updateRealisateur&id=<?= $director["id_director"]?>" method="post">
                        
                            <div class="info_input">
                
                                <div class="form-input">
                                    <label for="person_first_name"></label>
                                    <input type="text" placeholder="First Name*" name="person_first_name" id="person_first_name" value="<?= $director["person_first_name"]?>" required>
                                </div>


                                <div class="form-input">
                                    <label for="person_last_name"></label>
                                    <input type="text" placeholder="Last Name*" name="person_last_name" id="person_last_name" value="<?= $director["person_last_name"]?>" required>
                                </div>

                                <div class="form-input">
                                    <label for="person_sexe">Gender* :</label>
                                        M:<input type="radio" name="person_sexe" class="radio" value="male" <?php if ($director["person_sexe"] === "male") echo "checked"; ?>>
                                        F:<input type="radio" name="person_sexe" class="radio" value="female" <?php if ($director["person_sexe"] === "female") echo "checked"; ?>>
                                </div>

                                <div class="form-input">
                                    <label for="person_birthday"></label>
                                    <input type="date" placeholder="Date of birth*" name="person_birthday" id="person_birthday" value="<?= $director["person_birthday"]?>" required >
                                </div>

                                <div class="form-input">
                                    <label for="person_nationality"></label>
                                    <input type="text" placeholder="Nationality*" name="person_nationality" id="person_nationality" value="<?= $director["person_nationality"]?>" required>
                                </div>

                                
                            </div>

                            <div class="input_image">
                                    <!-- label est associé a un input ce qu'on met dans le for va correspondre au name du chemin input que l'on veut associé -->
                                    <label for="director_image">Let's add a picture :</label>
                                    <input type="file"  name="director_image" >
                                    <!-- <button type="submit"> Send</button> -->
                                    <p id="autorised-format">Autorised format : jpg, jpeg, png, WebP</p>
                            </div>

                            <div class="btn-submit">
                                <input type="submit" class="submit" name="updateDirector" value="update">
                            </div>
                        </form>
                    
                    </div>
                </div>
        </div>



<?php
$titre = "actor";
$titre_secondaire = "update actor" ;
$contenu = ob_get_clean();
require "view/template.php";
?>