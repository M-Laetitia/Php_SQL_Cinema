<?php ob_start(); ?>

<div class="wrapper-form">
    <div class="container_form">
        <div class="left_section">
            <h1>Let's Build a <br> <span class="text-colored">Cinematic Treasure <br> Trove</span>  together.</h1>
        </div>

        <div class="form_section">
            <p>Share Your Movie Wisdom</p>
            <h2>Add a Director </h2>
            <div class="form_info">

                <form enctype="multipart/form-data" action="index.php?action=ajouterRealisateur" method="post">
                    <div class="info_input">
                        <div class="form-input">
                            <label for="person_first_name"></label>
                            <input type="text" placeholder="First Name*" name="person_first_name" id="person_first_name" required>
                        </div>

                        <div class="form-input">
                            <label for="person_last_name"></label>
                            <input type="text" placeholder="Last Name*" name="person_last_name" id="person_last_name" required>
                        </div>

                        <div class="form-input">
                            <label for="person_sexe">Gender* :</label>
                                M:<input type="radio" name="person_sexe" class="radio" value="male" id="person_sexe" required >
                                F:<input type="radio" name="person_sexe" class="radio" value="female" required>
                        </div>

                        <div class="form-input">
                            <label for="person_birthday"></label>
                            <input type="date" name="person_birthday" id="person_birthday" required>
                        </div>

                        <div class="form-input">
                            <label for="person_nationality"></label>
                            <input type="text" placeholder="Nationality*" name="person_nationality" id="person_nationality" required>
                        </div>
                    </div>

                    <div class="input_image">
                        <label for="actor_image">Let's add a picture :</label>
                        <input type="file"  name="director_image" id="actor_image" >
                        <p id="autorised-format">Autorised format : jpg, jpeg, png, WebP</p>
                    </div>

                    <div class="btn-submit">
                        <input type="submit" class="submit" name="submitRealisateur" id="submitRealisateur">
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
        </div>
    </div>
</div>

<?php
$titre = "Add a Director";
$meta_description = " form to add a Director and to expand the database";
$contenu = ob_get_clean();
require "view/template.php";
?>