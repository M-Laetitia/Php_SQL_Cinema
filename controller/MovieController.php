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
        SELECT director.id_director, movie.id_director, movie_title, movie_release_date, CONCAT(person.person_first_name, ' ' ,person.person_last_name) AS realComplete, movie.id_movie
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
        SELECT movie.movie_title, CONCAT(person.person_first_name, ' ', person.person_last_name) AS realisateurComplete, DATE_FORMAT(movie.movie_duration, '%H:%i') AS formatted_duration, 
        movie.movie_rating, movie.movie_release_date, movie.movie_rating, movie.id_movie, director.id_director, GROUP_CONCAT(genre.label_genre) AS genres
        FROM movie
        INNER JOIN director ON director.id_director = movie.id_director
        INNER JOIN person ON person.id_person = director.id_person
        INNER JOIN categorise ON categorise.id_movie = movie.id_movie
        INNER JOIN genre ON genre.id_genre = categorise.id_genre

        WHERE movie.id_movie = :id
        GROUP BY movie.id_movie"
        
        );
        $requetedetailFilm->execute (["id" => $id]);


        $requeteCastingFilm = $pdo->prepare("
        SELECT CONCAT(person.person_first_name, ' ',  person.person_last_name) AS actorComplete, actor.id_actor
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


 
}

?>

<!-- SELECT movie.movie_title, CONCAT(person.person_first_name, ' ' ,person.person_last_name), 
		  movie.movie_duration, movie.movie_rating, movie.movie_release_date, movie.movie_rating, genre.label_genre
        FROM movie
        INNER JOIN director ON director.id_director = movie.id_director
        INNER JOIN person ON person.id_person = director.id_person
        
        INNER JOIN categorise ON categorise.id_movie = movie.id_movie
        INNER JOIN genre ON genre.id_genre = categorise.id_genre -->
        