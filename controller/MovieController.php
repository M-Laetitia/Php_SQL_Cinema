<?php

// On remarquera ici l'utilisation du "use" pour accéder à la classe Connect située dans le
// namespace "Model"
namespace Controller;
use Model\Connect;

class MovieController {



    // ^ Lister les films

     public function listFilms() {

        // On se connecte
        $pdo = Connect::seConnecter();
        // On exécute la requête de notre choix
        $requete = $pdo->query("
        SELECT movie.id_movie,  director.id_director, movie.id_director, movie_title, movie_release_date, CONCAT(person.person_first_name, ' ' ,person.person_last_name) AS realComplete, movie.id_movie
        FROM movie
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
        movie.movie_rating, movie.movie_release_date, movie.movie_rating, director.id_director, genre.label_genre AS genres
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
        if(isset($_POST["submitFilm"])) {
            $movie_title = filter_input(INPUT_POST, "movie_title", FILTER_SANITIZE_SPECIAL_CHARS);
            $movie_duration = filter_input(INPUT_POST, "movie_duration", FILTER_SANITIZE_SPECIAL_CHARS);
            $movie_release_date = filter_input(INPUT_POST, "movie_release_date", FILTER_SANITIZE_SPECIAL_CHARS);
            $movie_synopsys  = filter_input(INPUT_POST, "movie_synopsys", FILTER_SANITIZE_SPECIAL_CHARS);
            $movie_image  = filter_input(INPUT_POST, "movie_image", FILTER_SANITIZE_SPECIAL_CHARS, FILTER_SANITIZE_URL);
            $movie_rating = filter_input(INPUT_POST, "movie_rating", FILTER_SANITIZE_NUMBER_INT);


            //? gérer les paramètres non obligatoires?
            if($movie_title && $movie_duration && $movie_release_date) {
                $pdo = Connect::seConnecter();
                $requeteAjouterFilm = $pdo->prepare("
                    INSERT INTO movie (movie_title, movie_duration, movie_release_date, movie_synopsys, movie_image, movie_rating)
                    VALUES (movie_title, movie_duration, movie_release_date, movie_synopsys, movie_image, movie_rating)
                ");

                $requeteAjouterFilm ->execute([
                    "movie_title"=> $movie_title, 
                    "movie_duration"=> $movie_duration, 
                    "movie_release_date"=> $movie_release_date, 
                    "movie_synopsys"=> $movie_synopsys, 
                    "movie_image"=> $movie_image,
                    "movie_rating"=> $movie_rating,  

                ]);

            }

        }
        require "view/movie/ajouterFilm.php";
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
    
}





?>

