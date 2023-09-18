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
        SELECT director.id_director, movie.id_director, movie_title, movie_release_date, CONCAT(person.person_first_name, ' ' ,person.person_last_name) AS realComplete
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
        SELECT movie.movie_title, person.person_first_name, person.person_last_name, movie.movie_duration, movie.movie_rating, movie.movie_release_date, movie.movie_rating, movie.id_movie
        FROM movie
        INNER JOIN director ON director.id_director = movie.id_director
        INNER JOIN person ON person.id_person = director.id_person
        WHERE id_movie = :id"
        );

        $requetedetailFilm->execute (["id" => $id]);
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
        