<?php
// On remarquera ici l'utilisation du "use" pour accéder à la classe Connect située dans le
// namespace "Model"
namespace Controller;
use Model\Connect;
// session_start();
// var_dump($_SESSION); die;

// Ajoutez ces lignes pour activer l'affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ini_set('file_uploads', 'On');

class MovieController {

    // ^ landing page 
    public function landingPage(){
        require "view/landingPage/landingPage.php";
    }

    // ^ Lister les films
    public function listFilms() {
        // On se connecte
        $pdo = Connect::seConnecter();
        // On exécute la requête de notre choix
        $requete = $pdo->query(" SELECT
        movie.id_movie,
        director.id_director,
        movie.id_director,
        movie_title,
        movie_release_date,
        CONCAT(person.person_first_name, ' ' ,person.person_last_name) AS realComplete,
        movie.id_movie,
        DATE_FORMAT(movie.movie_duration, '%H:%i') AS formatted_duration,
        movie.movie_rating,
        movie.movie_image,
        movie.movie_alt_desc,
        (SELECT ROUND(AVG(rating.note), 0) FROM rating WHERE rating.id_movie = movie.id_movie) AS noteMoyenne
        FROM  movie
        INNER JOIN director ON director.id_director = movie.id_director
        INNER JOIN person ON person.id_person = director.id_person
        ");
        // On relie par un "require" la vue qui nous intéresse (située dans le dossier "view")
        require "view/movie/listFilms.php";
    }

    // ^ Détail d'un film
    public function detailFilm($id){
        
        $pdo = Connect::seConnecter();
        $requetedetailFilm = $pdo->prepare("
        SELECT movie.id_movie, categorise.id_movie,  movie.movie_title, CONCAT(person.person_first_name, ' ', person.person_last_name) AS realisateurComplete, DATE_FORMAT(movie.movie_duration, '%H:%i') AS formatted_duration,
        movie.movie_rating, movie.movie_release_date, movie.movie_rating, director.id_director, genre.label_genre AS genres, movie.movie_image, movie.movie_synopsys, movie.movie_country, movie.movie_alt_desc
        FROM movie
        INNER JOIN director ON director.id_director = movie.id_director
        INNER JOIN person ON person.id_person = director.id_person
        INNER JOIN categorise ON categorise.id_movie = movie.id_movie
        INNER JOIN genre ON genre.id_genre = categorise.id_genre
        WHERE movie.id_movie = :id"
        );
        $requetedetailFilm->execute (["id" => $id]);

        $requeteGenres = $pdo->prepare("
        SELECT  movie.movie_title, label_genre AS genres, genre.id_genre, movie.id_movie
        FROM movie
        INNER JOIN director ON director.id_director = movie.id_director
        INNER JOIN person ON person.id_person = director.id_person
        INNER JOIN categorise ON categorise.id_movie = movie.id_movie
        INNER JOIN genre ON genre.id_genre = categorise.id_genre
        WHERE movie.id_movie = :id
        ");
        $requeteGenres->execute(["id" => $id]);

        $requeteCastingFilm = $pdo->prepare("
        SELECT CONCAT(person.person_first_name, ' ',  person.person_last_name) AS actorComplete, actor.id_actor, movie.id_movie, role.id_role, role.name_role
        FROM play
        INNER JOIN actor ON play.id_actor = actor.id_actor
        INNER JOIN person ON actor.id_person = person.id_person
        INNER JOIN movie ON movie.id_movie = play.id_movie
        INNER JOIN role ON role.id_role = play.id_role
        WHERE movie.id_movie = :id
        ");
        $requeteCastingFilm->execute(["id" => $id]);
        

        $requeteNoteMoyenne = $pdo->prepare("SELECT movie.id_movie, movie.movie_title, ROUND(AVG(rating.note), 0) AS noteMoyenne
        FROM movie
        INNER JOIN rating ON rating.id_movie = movie.id_movie
        WHERE movie.id_movie = :id");
        $requeteNoteMoyenne->execute(["id" => $id]);
        $notes = $requeteNoteMoyenne->fetch();


        $requeteNombreNote = $pdo->prepare("SELECT COUNT(rating.note) AS nb_note
        FROM rating
        INNER JOIN movie ON movie.id_movie = rating.id_movie
        WHERE movie.id_movie = :id
        ");
        $requeteNombreNote->execute(["id" => $id]);
        $nombreNotes = $requeteNombreNote->fetch();



        $requeteBackground = $pdo->prepare("SELECT  movie.movie_background
        FROM movie WHERE movie.id_movie = :id"
        );
        $requeteBackground->execute(["id" => $id]);
        $backgroundData = $requeteBackground->fetch();
        $filmBackgroundPath = $backgroundData['movie_background'];
        // var_dump($filmBackgroundPath); die; 
        $backgroundDataForJS = [
            'backgroundPath' => $filmBackgroundPath, // Chemin de l'image de fond 
        ];
        $backgroundDataJSON = json_encode($backgroundDataForJS);
        // var_dump($backgroundDataJSON);die;


        
        $filmId = $_GET['id'];
        
        // $pdo = Connect::seConnecter();
        
        $requeteReview = $pdo->prepare("SELECT rating.review , DATE_FORMAT(rating.date_review, '%d-%m-%Y %H:%i') AS formatted_date, user.pseudo, rating.note, rating.id_rating
        FROM rating
        INNER JOIN user ON user.id_user = rating.id_user
        INNER JOIN movie ON movie.id_movie = rating.id_movie
        WHERE movie.id_movie = :filmId  AND rating.review IS NOT NULL ORDER BY rating.date_review
        ");
        $requeteReview->execute(["filmId" => $filmId]);
        $reviews = $requeteReview->fetchAll();

        foreach ($reviews as &$review) {
            $requeteNbLikes = $pdo->prepare("SELECT COUNT(review_likes.is_like) AS nb_likes
                FROM rating
                INNER JOIN review_likes ON review_likes.id_rating = rating.id_rating
                WHERE rating.id_rating = :idRating AND review_likes.is_like = 1
            ");
            $requeteNbLikes->execute([":idRating" => $review['id_rating']]);
            $nb_likes = $requeteNbLikes->fetch();
            $review['nb_likes'] = $nb_likes['nb_likes']; // Ajoutez le nombre de likes à chaque review


            $requeteNbDislikes = $pdo->prepare("SELECT COUNT(review_likes.is_like) AS nb_dislikes
                FROM rating
                INNER JOIN review_likes ON review_likes.id_rating = rating.id_rating
                WHERE rating.id_rating = :idRating AND review_likes.is_like = 0
            ");
            $requeteNbDislikes->execute([":idRating" => $review['id_rating']]);
            $nb_dislikes = $requeteNbDislikes->fetch();
            $review['nb_dislikes'] = $nb_dislikes['nb_dislikes']; 
        }

      




        $requeteNbReview = $pdo->prepare("SELECT COUNT(rating.review) AS nb_review
        FROM rating
        INNER JOIN movie ON movie.id_movie = rating.id_movie
        WHERE movie.id_movie = :filmId
        ");
        $requeteNbReview->execute(["filmId" => $filmId]);
        $nb_review = $requeteNbReview->fetch();
        

        $filmId = $_GET['id'];
        
        

      
        
        require "view/movie/detailFilm.php";
    }

    // ^ Aller à la page d'ajout d'un film
    public function getAjouterFilm(){
        $pdo = Connect::seConnecter(); 
        $requeteRealisateur = $pdo->query("SELECT CONCAT(person.person_first_name, ' ' , person.person_last_name) AS directorComplete, director.id_director
        FROM director
        INNER JOIN person ON person.id_person = director.id_person
        ");
        $requeteRealisateur->execute();

        $requeteGenre = $pdo->query("SELECT * FROM genre");
        $requeteGenre-> execute();

        require ("view/movie/ajouterFilm.php");
    }


    // ^ Ajouter film
    public function ajouterFilm() {

        $pdo = Connect::seConnecter();

        if(isset($_POST["submitFilm"])) {

            //rajouter iMAGE
            if(isset($_FILES["movie_image"])){  // name de l'input dans le formulaire de l'ajout du film
                // voir upload-img_php pour détail du process
                $tmpName = $_FILES["movie_image"]["tmp_name"];
                $name = $_FILES["movie_image"]["name"];
                $size = $_FILES["movie_image"]["size"];
                $error = $_FILES["movie_image"]["error"];
                $tabExtension = explode(".", $name); 
                $extension = strtolower(end($tabExtension)); 
                $extensionsAutorisees = ['jpg', 'jpeg', 'png', 'WebP' ];
                $tailleMax = 5242880; // 5 Mo (en octets)
            
                if ($error != 0) {
                    echo 'Une erreur s\'est produite lors du téléchargement de l\'image.';
                } elseif (!in_array($extension, $extensionsAutorisees)) {
                    echo 'Mauvais format d\'image. Formats autorisés : JPG, JPEG, PNG, WebP.';
                } elseif ($size > $tailleMax) {
                    echo 'L\'image est trop grande. La taille maximale autorisée est de 5 Mo.';
                } else {
                    // L'image est valide, on procède au traitement
                    $uniqueName = uniqid('', true);
                    $FileNameUnique = $uniqueName. '.' .$extension;
                    move_uploaded_file($tmpName, './public/Images/upload/'.$FileNameUnique);
                    $movieImageChemin = './public/Images/upload/'.$FileNameUnique;
                }

                } else {
                    /* Si pas de fichier car NULL autorisé dans la BDD pour les images */
                    $movieImageChemin = NULL;
                }



            //rajouter background
            if(isset($_FILES["movie_background"])){  // name de l'input dans le formulaire de l'ajout du film
                // voir upload-img_php pour détail du process
                $tmpName = $_FILES["movie_background"]["tmp_name"];
                $name = $_FILES["movie_background"]["name"];
                $size = $_FILES["movie_background"]["size"];
                $error = $_FILES["movie_background"]["error"];
                $tabExtension = explode(".", $name); 
                $extension = strtolower(end($tabExtension)); 
                $extensionsAutorisees = ['jpg', 'jpeg', 'png', 'WebP' ];
                $tailleMax = 5242880; // 5 Mo (en octets)
            
                if ($error != 0) {
                    echo 'Une erreur s\'est produite lors du téléchargement de l\'image.';
                } elseif (!in_array($extension, $extensionsAutorisees)) {
                    echo 'Mauvais format d\'image. Formats autorisés : JPG, JPEG, PNG, WebP.';
                } elseif ($size > $tailleMax) {
                    echo 'L\'image est trop grande. La taille maximale autorisée est de 5 Mo.';
                } else {
                    // L'image est valide, on procède au traitement
                    $uniqueName = uniqid('', true);
                    $FileNameUnique = $uniqueName. '.' .$extension;
                    move_uploaded_file($tmpName, './public/Images/upload/'.$FileNameUnique);
                    $movieBackgroundChemin = './public/Images/upload/'.$FileNameUnique;
                }

                } else {
                    /* Si pas de fichier car NULL autorisé dans la BDD pour les images */
                    $movieBackgroundChemin = NULL;
                }






                $movie_title = filter_input(INPUT_POST, "movie_title", FILTER_SANITIZE_SPECIAL_CHARS);
                $movie_duration = filter_input(INPUT_POST, "movie_duration", FILTER_SANITIZE_SPECIAL_CHARS);
                $movie_release_date = filter_input(INPUT_POST, "movie_release_date", FILTER_SANITIZE_SPECIAL_CHARS);
                $movie_synopsys  = filter_input(INPUT_POST, "movie_synopsys", FILTER_SANITIZE_SPECIAL_CHARS);
                $movie_rating = filter_input(INPUT_POST, "movie_rating", FILTER_SANITIZE_NUMBER_INT);
                $director = filter_input(INPUT_POST, "director", FILTER_SANITIZE_NUMBER_INT);
                $genre = filter_input(INPUT_POST, "genre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $movie_country = filter_input(INPUT_POST, "movie_country", FILTER_SANITIZE_SPECIAL_CHARS);

                // ajouter vérif pour bien que l'user rentre une année à 4 chiffres
                if($movie_title !== false && $movie_duration !== false && $movie_release_date !== false && strlen($movie_release_date) === 4 && $movie_synopsys && $movie_rating && $director && $movie_country) {

                $imageAlt = "Poster of " .$movie_title ;
                    
                $requeteAjouterFilm = $pdo->prepare("INSERT INTO movie (movie_title, movie_duration, movie_release_date, movie_synopsys, movie_rating, id_director, movie.movie_image, movie_country, movie_alt_desc, movie.movie_background)
                    VALUES (:movie_title, :movie_duration, :movie_release_date, :movie_synopsys, :movie_rating, :director, :movieImageChemin, :movie_country, :imageAlt, :movieBackgroundChemin)
                ");

                $requeteAjouterFilm ->execute([
                    "movie_title"=> $movie_title, 
                    "movie_duration"=> $movie_duration, 
                    "movie_release_date"=> $movie_release_date, 
                    "movie_synopsys"=> $movie_synopsys, 
                    "movie_rating"=> $movie_rating,
                    "director" => $director,
                    "movieImageChemin" =>$movieImageChemin,
                    "movieBackgroundChemin" =>$movieBackgroundChemin,
                    "movie_country" =>$movie_country,
                    "imageAlt" => $imageAlt,
                ]);

                // Ajout de la note soumise dans le formulaire dans la table rating
                // récupérer l'id du dernier film ajouté


               
                $id_movie = $pdo->lastInsertId();
                

                //insertion de la table "rating"
                $id_user = $_SESSION['user']['id_user'];
                $requeteAjouterNote = $pdo->prepare("INSERT INTO rating (id_movie, id_user, note)
                VALUES (:id_movie, :id_user, :movie_rating)
                "); 
                $requeteAjouterNote->execute([
                    "id_movie" => $id_movie,
                    "id_user" => $id_user,
                    "movie_rating" => $movie_rating,

                ]);
    

                $requeteGenre = $pdo->query("SELECT id_genre, label_genre FROM genre");
                $requeteGenre-> execute();
                
                $genresChecked = isset($_POST["genre"]) ? $_POST["genre"] : [];

                foreach ($genresChecked as $genre) {
                    $requeteAjoutGenre = $pdo->prepare("INSERT INTO categorise (id_movie, id_genre)
                    VALUES (:id_movie, :id_genre)");
                    $requeteAjoutGenre->execute([
                        "id_movie" => $id_movie,
                        "id_genre" => $genre
                    ]);
                }
                header("Location: index.php?action=listFilms");
            }
            
        }
        
    }

    // ^ Aller à la page d'ajout de casting

    public function getAjouterCasting(){
        $pdo = Connect::seConnecter(); 
        
        $requeteFilm = $pdo->query(" SELECT movie.id_movie, movie.movie_title
        FROM movie
        ");

        $requeteActeur = $pdo->query(" SELECT actor.id_actor, person.person_first_name, person.person_last_name
        FROM person
        INNER JOIN actor ON person.id_person = actor.id_person
        ");

        $requeteRole = $pdo->query(" SELECT role.id_role, role.name_role
        FROM role
        ");

        require "view/movie/ajouterCasting.php";
    }


    // ^ Ajouter casting

    public function ajouterCasting() {
        $pdo= Connect::seConnecter();

        $requeteFilm = $pdo->query("SELECT movie.id_movie, movie.movie_title FROM movie");

        $requeteActeur = $pdo->query("SELECT actor.id_actor, person.person_first_name, ' ', person.person_last_name
        FROM person
        INNER JOIN actor ON person.id_person = actor.id_person");
        $requeteRole = $pdo->query("SELECT id_role, role.name_role
        FROM role
        ");

        if(isset($_POST["submitCasting"])) {
            $movie = filter_input(INPUT_POST, "movie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $role = filter_input(INPUT_POST, "role", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $actor = filter_input(INPUT_POST, "actor", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($movie  &&  $role  && $actor) {
                $requeteAjouterCasting = $pdo->prepare("INSERT INTO play(id_movie, id_actor, id_role)
                VALUES (:movie, :actor, :role)");

                $requeteAjouterCasting ->execute([
                    "movie" => $movie,
                    "role" => $role,
                    "actor" => $actor,
                ]);
                header("Location: index.php?action=listRoles");
            }
        }
        require "view/movie/ajouterCasting.php";
       
    }


    // ^ Supprimer un film 
    public function supprimerFilm($id) {
        $pdo = Connect::seConnecter();
        if (isset($id) && is_numeric($id)) {

            $requeteDeleteFilmPlay = $pdo->prepare("DELETE FROM play WHERE id_movie = :id"); //D'abord supprimer les clés étrangères
            $requeteDeleteFilmPlay ->execute(["id"=>$id]);

            $requeteDeleteFilmCategorise = $pdo->prepare("DELETE FROM categorise WHERE id_movie = :id");
            $requeteDeleteFilmCategorise->execute(["id"=>$id]);

            $requeteSupprimerFilm = $pdo->prepare("DELETE FROM movie WHERE id_movie = :id");
            $requeteSupprimerFilm->execute(["id" => $id]);

        }
        header("Location: index.php?action=listFilms");
        // require "view/movie/detailFilm.php";
    }


    // ^ Update un film 
    public function updateFilm($id) {

        $pdo = Connect::seConnecter();
        $requeteUpdateFilm = $pdo->prepare("SELECT movie.id_movie, movie.movie_title,  movie_release_date, person.person_first_name, person.person_last_name, movie.movie_duration, movie.movie_synopsys, movie.movie_rating, movie.id_director, movie.movie_image, movie.movie_country, movie.movie_synopsys
        FROM movie
        INNER JOIN director ON director.id_director = movie.id_director
        INNER JOIN person ON person.id_person = director.id_person
        WHERE movie.id_movie = :id
        ");        
        $requeteUpdateFilm->execute(["id" => $id]);

        // afficher les infos déjà existantes
        $requeteRealisateur = $pdo->query("SELECT director.id_director , person.person_first_name, person.person_last_name
        FROM director
        INNER JOIN person ON person.id_person = director.id_person
        ");   
        $requeteRealisateur->execute();
        
        $requeteGenre = $pdo->query("SELECT id_genre, label_genre
        FROM genre");
        $requeteGenre-> execute();

        if(isset($_POST["updateFilm"])){  

    
            if(isset($_FILES["movie_image"])){ 
                $tmpName = $_FILES["movie_image"]["tmp_name"];
                $name = $_FILES["movie_image"]["name"];
                $size = $_FILES["movie_image"]["size"];
                $error = $_FILES["movie_image"]["error"];
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

            //rajouter background
            if(isset($_FILES["movie_background"])){  // name de l'input dans le formulaire de l'ajout du film
                // voir upload-img_php pour détail du process
                $tmpName = $_FILES["movie_background"]["tmp_name"];
                $name = $_FILES["movie_background"]["name"];
                $size = $_FILES["movie_background"]["size"];
                $error = $_FILES["movie_background"]["error"];
                $tabExtension = explode(".", $name); 
                $extension = strtolower(end($tabExtension)); 
                $extensionsAutorisees = ['jpg', 'jpeg', 'png', 'WebP' ];
                $tailleMax = 5242880; // 5 Mo (en octets)
            
                if ($error != 0) {
                    echo 'Une erreur s\'est produite lors du téléchargement de l\'image.';
                } elseif (!in_array($extension, $extensionsAutorisees)) {
                    echo 'Mauvais format d\'image. Formats autorisés : JPG, JPEG, PNG, WebP.';
                } elseif ($size > $tailleMax) {
                    echo 'L\'image est trop grande. La taille maximale autorisée est de 5 Mo.';
                } else {
                    // L'image est valide, on procède au traitement
                    $uniqueName = uniqid('', true);
                    $FileNameUnique = $uniqueName. '.' .$extension;
                    move_uploaded_file($tmpName, './public/Images/upload/'.$FileNameUnique);
                    $movieBackgroundChemin = './public/Images/upload/'.$FileNameUnique;
                }

                } else {
                    /* Si pas de fichier car NULL autorisé dans la BDD pour les images */
                    $movieBackgroundChemin = NULL;
                }





            $movie_title = filter_input(INPUT_POST, "movie_title", FILTER_SANITIZE_SPECIAL_CHARS);
            $movie_duration = filter_input(INPUT_POST, "movie_duration", FILTER_SANITIZE_SPECIAL_CHARS);
            $movie_release_date = filter_input(INPUT_POST, "movie_release_date", FILTER_SANITIZE_SPECIAL_CHARS);
            $movie_synopsys  = filter_input(INPUT_POST, "movie_synopsys", FILTER_SANITIZE_SPECIAL_CHARS);
            $movie_rating = filter_input(INPUT_POST, "movie_rating", FILTER_SANITIZE_NUMBER_INT);
            $director = filter_input(INPUT_POST, "director", FILTER_SANITIZE_NUMBER_INT);
            $movie_country = filter_input(INPUT_POST, "movie_country", FILTER_SANITIZE_SPECIAL_CHARS);

            if($movie_title  && $movie_duration  && $movie_release_date  && strlen($movie_release_date) === 4 && $movie_rating && $director  && $movie_country &&  $movie_synopsys ) {
                // var_dump("ok"); die;
                //Update Film
                $reqUpdateFilm = $pdo->prepare("UPDATE movie SET movie_title = :movie_title, movie_release_date = :movie_release_date, movie_duration = :movie_duration, movie_synopsys = :movie_synopsys, movie_rating = :movie_rating, movie_country = :movie_country, movie_image = :movieImageChemin, id_director = :director, movie_background = :movieBackgroundChemin WHERE id_movie= :id");
                $reqUpdateFilm->execute([
                    "movie_title" => $movie_title,
                    "movie_release_date" => $movie_release_date,
                    "movie_duration" => $movie_duration,
                    "movie_synopsys" => $movie_synopsys,
                    "movie_rating" => $movie_rating,
                    "director" => $director,
                    "movieImageChemin" => $movieImageChemin,
                    "movie_country" => $movie_country,
                    "movieBackgroundChemin" => $movieBackgroundChemin,
                    "id" => $id
                ]);

                // Supprimer les genres précédents
                $requeteSuprGenres = $pdo->prepare("DELETE FROM categorise WHERE id_movie = :id");
                $requeteSuprGenres->execute(["id" => $id]);
                

                //Update genre
                $NewSelectedGenres = $_POST["genre"];
                // var_dump($_POST);die;
                foreach ($NewSelectedGenres as $genre) {

                    $requeteUpdateGenre = $pdo->prepare("INSERT INTO categorise (id_movie, id_genre) VALUES (:id_movie, :id_genre)");
                    $requeteUpdateGenre->execute(["id_movie" => $id, "id_genre" => $genre]);
                }
            }
            header("Location: index.php?action=listFilms");
        }
        require("view/movie/updateFilm.php");
       
    }

   
    // ^ Calculer moyenne des notes données par les utilisateurs

    // public function ratingAverage($id) {
    //     var_dump($id); die;
        
    //     $pdo = Connect::seConnecter();
        
    //     $requete = $pdo->prepare("SELECT movie.id_movie, movie.movie_title, AVG(rating.note) AS noteMoyenne
    //     FROM movie
    //     INNER JOIN rating ON rating.id_movie = movie.id_movie
    //     WHERE movie.id_movie = :id");

    //     $requete->execute(["id" => $id]);
        
    //     $notes = $requeteNoteMoyenne->fetch();
    //     var_dump($notes); die;

    //     require("view/movie/detailFilm.php");
    // }

    

    // ^ ajout de note par les utilisateurs
     
    public function addRating () {

        $userId = $_SESSION['user']['id_user'];
        // var_dump($_SESSION['user']);die;
    
        $filmId = $_GET['id'];
        // var_dump($_GET['id']);die;

        if(isset($_POST["user_rating"])) {
            // vérifier si user est connecté

    
            $user_rating = filter_input(INPUT_POST, "user_rating", FILTER_SANITIZE_NUMBER_INT);

                if($user_rating !== false) {
                    $pdo = Connect::seConnecter();

                    //vérifier si une note a déjà été rentrée par cet user pour ce film
                    $requete = $pdo->prepare("SELECT * FROM rating WHERE id_movie = :id_movie AND id_user = :id_user");
                    $requete->execute ([
                        "id_movie" => $filmId,
                        "id_user" => $userId
                    ]);


                    $existingRating = $requete->fetch();
                    

                    if($existingRating) {
                        //si une note existe, la mettre à jour
                        $requeteUpdate= $pdo->prepare("UPDATE rating SET note = :note WHERE id_rating = :id_rating" );
                        $requeteUpdate->execute([
                            "id_rating" => $existingRating['id_rating'],
                            "note" => $user_rating
                        ]);
                    } else {
                        //sinon, insérez une nouvelle note
                        $requeteAjout = $pdo->prepare("INSERT INTO rating (id_movie, id_user, note)
                        VALUES (:id_movie, :id_user, :note)");
                        $requeteAjout->execute([
                         "id_movie" => $filmId,
                        "id_user" => $userId,
                        "note" => $user_rating
                        ]);
                    }

                } else {
                    // Note invalide
                }
            } else {
                // ID du film manquant dans l'URL
            }
            header("Location: index.php?action=listFilms");
    }
     

       // ^ Ajouter review

       public function ajouterReview() {

        $userId = $_SESSION['user']['id_user'];
        $filmId = $_GET['id'];


        if(isset($_POST["submitReview"])) {

            $review = filter_input(INPUT_POST, "review", FILTER_SANITIZE_SPECIAL_CHARS);


            if($review !== false ) {
                $pdo = Connect::seConnecter();

                $dateReview = date("Y-m-d H:i:s");


                // Vérifiez si une review existe
                $requeteExisteReview = $pdo->prepare("SELECT review FROM rating WHERE id_user = :userId AND id_movie = :filmId");
                $requeteExisteReview->execute([
                    "userId" => $userId,
                    "filmId" => $filmId,
                ]);

                $resultatExisteReview = $requeteExisteReview->fetch();

                if ($resultatExisteReview) {
                    // Si une review existe déjà, mettez à jour la review existante
                    $requeteMettreAJourReview = $pdo->prepare("UPDATE rating SET review = :review, date_review = :dateReview WHERE id_user = :userId AND id_movie = :filmId");
                    $requeteMettreAJourReview->execute([
                        "review" => $review,
                        "dateReview" => $dateReview,
                        "userId" => $userId,
                        "filmId" => $filmId,
                    ]);
                } else {
                    // Si aucune review n'existe, ajoutez une nouvelle review
                    $requeteAjouterReview = $pdo->prepare("INSERT INTO rating (review, id_movie, id_user, date_review) VALUES (:review, :id_movie, :id_user, :dateReview)");
                    $requeteAjouterReview->execute([
                        "review" => $review,
                        "id_movie" => $filmId,
                        "id_user" => $userId,
                        "dateReview" => $dateReview,
                    ]);
              }
            }
            header("Location: index.php?action=listFilms");
        }
    }


    // // ^ Lister les review
    // public function listReview() {

    //     $userId = $_SESSION['user']['id_user'];
    //     $filmId = $_GET['id'];
    //     var_dump($filmId); die;
        
    //     $pdo = Connect::seConnecter();
        
    //     $requeteReview = $pdo->prepare("SELECT rating.review, rating.date_review, user.pseudo
    //     FROM rating
    //     INNER JOIN user ON user.id_user = rating.id_user
    //     INNER JOIN movie ON movie.id_movie = rating.id_movie
    //     WHERE movie.id_movie = :filmId
    //     ");
    //     $requeteReview->execute(["filmId" => $filmId]);
    //     $reviews = $requeteReview->fetchAll();
    //     var_dump($reviews); die; 
        
    //     require "view/movie/detailFilm.php";
        
    // }

  
}

?>
