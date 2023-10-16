<?php
namespace Controller;
use Model\Connect;

class DirectorController {
    // ^ Lister les réalisateurs
    public function listRealisateurs() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("SELECT director.id_director, CONCAT(person.person_first_name, ' ' ,person.person_last_name) AS realComplete, person.person_nationality,  DATE_FORMAT(person.person_birthday, '%d' ' ' '%M' ' ' '%Y') AS dateDMY, person.person_sexe, 
        (DATE_FORMAT(CURDATE(), '%Y') - DATE_FORMAT(person.person_birthday, '%Y')) AS ActorAge, person.person_image, person.person_alt_desc
        FROM person
        INNER JOIN director ON person.id_person = director.id_person");
        $requete->execute();
        require "view/director/listRealisateurs.php";
    }
    // ^ Afficher détails réalisateur
    public function detailRealisateur($id) {
        $pdo = Connect::seConnecter();
        $requetedetailRealisateur = $pdo->prepare("SELECT director.id_director, CONCAT(person.person_first_name, ' ' ,person.person_last_name) AS realComplete, DATE_FORMAT(person.person_birthday, '%d' ' ' '%M' ' ' '%Y') AS dateDMY, person.person_sexe,  (DATE_FORMAT(CURDATE(), '%Y') - DATE_FORMAT(person.person_birthday, '%Y')) AS ActorAge , person.person_sexe, person.person_nationality, person.person_image, person.person_alt_desc
        FROM person
        INNER JOIN director ON person.id_person = director.id_person
        WHERE id_director = :id");
        $requetedetailRealisateur->execute (["id" => $id]);

        // ^ Liste des films 
        $requeteFilms = $pdo->prepare("SELECT movie.movie_title, movie.movie_release_date, director.id_director, movie.id_movie
        FROM movie
        INNER JOIN director ON movie.id_director = director.id_director
        INNER JOIN person ON person.id_person = director.id_person
        WHERE director.id_director = :id");
        $requeteFilms->execute(["id" => $id]);
        require "view/director/detailRealisateur.php";
    }

    // ^ Aller à la page d'ajout d'un acteur 
    public function getAjouterRealisateur(){
        $pdo = Connect::seConnecter(); 
        $requeteGetAjouterRealisateur = $pdo->query(" SELECT person.person_first_name, person.person_last_name
        FROM director
        INNER JOIN person ON person.id_person = director.id_person");
        $requeteGetAjouterRealisateur->execute();
        require "view/director/ajouterRealisateur.php";
    }

    // ^ Ajouter Réalisateur 
    public function ajouterRealisateur(){
        $pdo = Connect::seConnecter();
        if(isset($_POST["submitRealisateur"])){

            $movieImageChemin = NULL; // Définir la variable avec une valeur par défaut 
            if(isset($_FILES["director_image"])){ 
                $tmpName = $_FILES["director_image"]["tmp_name"];
                $name = $_FILES["director_image"]["name"];
                $size = $_FILES["director_image"]["size"];
                $error = $_FILES["director_image"]["error"];
                $tabExtension = explode(".", $name); 
                $extension = strtolower(end($tabExtension)); 
                $extensionsAutorisees = ['jpg', 'jpeg', 'png', 'WebP' ];
                $tailleMax = 5242880;
            
                if ($error != 0) {
                    echo 'Une erreur s\'est produite lors du téléchargement de l\'image.';
                } elseif (!in_array($extension, $extensionsAutorisees)) {
                    echo 'Mauvais format d\'image. Formats autorisés : JPG, JPEG, PNG, WebP.';
                } elseif ($size > $tailleMax) {
                    echo 'L\'image est trop grande. La taille maximale autorisée est de 5 Mo.';
                } else {
                    $uniqueName = uniqid('', true);
                    $FileNameUnique = $uniqueName. '.' .$extension;
                    move_uploaded_file($tmpName, './public/Images/upload/'.$FileNameUnique);
                    $movieImageChemin = './public/Images/upload/'.$FileNameUnique;
                }
            } else {
                    $movieImageChemin = NULL;
                }

            $person_first_name = filter_input(INPUT_POST, "person_first_name", FILTER_SANITIZE_SPECIAL_CHARS);
            $person_last_name = filter_input(INPUT_POST, "person_last_name", FILTER_SANITIZE_SPECIAL_CHARS);
            $person_sexe = filter_input(INPUT_POST, "person_sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $person_birthday = filter_input(INPUT_POST, "person_birthday", FILTER_SANITIZE_SPECIAL_CHARS);
            $person_nationality = filter_input(INPUT_POST, "person_nationality", FILTER_SANITIZE_SPECIAL_CHARS);

            if($person_first_name && $person_last_name && $person_sexe && $person_birthday){
                $imageAlt = "Portrait of " . $person_first_name . ' ' . $person_last_name;
                $requeteAjouterPersonne = $pdo->prepare("INSERT INTO person (person_first_name, person_last_name, person_sexe, person_birthday, person_nationality, person_image, person_alt_desc) 
                VALUES (:person_first_name, :person_last_name, :person_sexe, :person_birthday, :person_nationality, :movieImageChemin, :imageAlt)");
                $requeteAjouterPersonne ->execute([
                    "person_first_name" => $person_first_name,
                    "person_last_name" => $person_last_name,
                    "person_sexe" => $person_sexe,
                    "person_birthday" => $person_birthday,
                    "person_nationality" => $person_nationality,
                    "movieImageChemin" => $movieImageChemin,
                    "imageAlt" => $imageAlt,]);
                $id_realisateur = $pdo->lastInsertID();
                $requeteAjouterRealisateur = $pdo->prepare("INSERT INTO director (id_person) VALUES (:id_director)");   
                $requeteAjouterRealisateur ->execute(["id_director" => $id_realisateur]);
            }
            $_SESSION["message"] = " This director has been added ! <i class='fa-solid fa-check'></i> ";
            echo "<script>setTimeout(\"location.href = 'index.php?action=listRealisateurs';\",1500);</script>";
            // header("Location: index.php?action=listRealisateurs");
        } else {
            $_SESSION["message"] = " an error has occurred please check that you have filled in all required fields";
        }
    }

    // ^ Supprimer un réalisateur 
    public function supprimerRealisateur($id) {
        $pdo = Connect::seConnecter();
        if (isset($id) && is_numeric($id)) {
            $requeteSupprimerMovie = $pdo->prepare("DELETE FROM movie WHERE id_director = :id");
            $requeteSupprimerMovie->execute(["id"=>$id]);
            $requeteSupprimerActor = $pdo->prepare("DELETE FROM director WHERE id_director = :id");
            $requeteSupprimerActor->execute(["id" => $id]);
        }
        $_SESSION["message"] = " This director has been deleted! <i class='fa-solid fa-check'></i> ";
        echo "<script>setTimeout(\"location.href = 'index.php?action=listRealisateurs';\",1500);</script>";
        // header("Location: index.php?action=listRealisateurs");
    }

    // ^ Editer un réalisateur
    public function updateRealisateur($id) {
        $pdo = Connect::seConnecter();
        $requeteUpdateRealisateur = $pdo->prepare(" SELECT director.id_director, CONCAT(person.person_first_name, ' ', person.person_last_name) AS directorComplete, person.person_sexe, person.person_birthday, person.person_first_name, person.person_last_name, person.person_nationality
        FROM director
        INNER JOIN person ON person.id_person = director.id_person
        WHERE director.id_director = :id");
        $requeteUpdateRealisateur->execute(["id"=>$id]);

        $movieImageChemin = NULL; 
        if(isset($_POST["updateDirector"])){ 
            if(isset($_FILES["director_image"])){
                $tmpName = $_FILES["director_image"]["tmp_name"];
                $name = $_FILES["director_image"]["name"];
                $size = $_FILES["director_image"]["size"];
                $error = $_FILES["director_image"]["error"];
                $tabExtension = explode(".", $name); 
                $extension = strtolower(end($tabExtension)); 
                $extensionsAutorisees = ['jpg', 'jpeg', 'png', 'WebP' ];
                $tailleMax = 5242880; 
                
                if ($error != 0) {
                    echo 'Une erreur s\'est produite lors du téléchargement de l\'image.';
                } elseif (!in_array($extension, $extensionsAutorisees)) {
                    echo 'Mauvais format d\'image. Formats autorisés : JPG, JPEG, PNG, WebP.';
                } elseif ($size > $tailleMax) {
                    echo 'L\'image est trop grande. La taille maximale autorisée est de 5 Mo.';
                } else {
                    $uniqueName = uniqid('', true);
                    $FileNameUnique = $uniqueName. '.' .$extension;
                    move_uploaded_file($tmpName, './public/Images/upload/'.$FileNameUnique);
                    $movieImageChemin = './public/Images/upload/'.$FileNameUnique;
                }
            } else {
                    $movieImageChemin = NULL;
                }
            
                $person_first_name = filter_input(INPUT_POST, "person_first_name", FILTER_SANITIZE_SPECIAL_CHARS);
                $person_last_name = filter_input(INPUT_POST, "person_last_name", FILTER_SANITIZE_SPECIAL_CHARS);
                $person_sexe = filter_input(INPUT_POST, "person_sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $person_birthday = filter_input(INPUT_POST, "person_birthday", FILTER_SANITIZE_SPECIAL_CHARS);
                $person_nationality = filter_input(INPUT_POST, "person_nationality", FILTER_SANITIZE_SPECIAL_CHARS);

            if($person_first_name !== false  && $person_last_name !== false  && $person_sexe !== false  && $person_birthday !== false  && $person_nationality !== false){
                $pdo = Connect::seConnecter();
                $requeteAjouterPersonne = $pdo->prepare(" UPDATE person
                INNER JOIN director ON director.id_person = person.id_person
                SET person_first_name = :person_first_name, person_last_name = :person_last_name, person_sexe = :person_sexe, person_birthday = :person_birthday, person_nationality = :person_nationality, person_image =:movieImageChemin
                WHERE director.id_director = :id");
                $requeteAjouterPersonne ->execute([
                    "person_first_name" => $person_first_name,
                    "person_last_name" => $person_last_name,
                    "person_sexe" => $person_sexe,
                    "person_birthday" => $person_birthday,
                    "id" => $id,
                    "person_nationality" => $person_nationality,
                    "movieImageChemin" => $movieImageChemin,]);
            
            $_SESSION["message"] = " This director has been updated ! <i class='fa-solid fa-check'></i> ";
            echo "<script>setTimeout(\"location.href = 'index.php?action=listRealisateurs';\",1500);</script>";
            }
        }
    require "view/director/updateRealisateur.php" ;
    }
}
?>