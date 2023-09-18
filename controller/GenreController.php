<?php

namespace Controller;
use Model\Connect;

class GenreController {

    
    // ^ Lister les genres
    

    public function listGenres() {
        $pdo = Connect::seConnecter();
            $requete = $pdo->query("
            SELECT genre.label_genre, genre.id_genre , COUNT(categorise.id_movie) AS nb_movies
            FROM categorise
            INNER JOIN genre ON genre.id_genre = categorise.id_genre
            GROUP BY categorise.id_genre
            ORDER BY nb_movies DESC
            ");

            require "view/genre/listGenres.php";       
    }

    // ^ Lister les films par genre

    public function detailGenre($id) {
        $pdo = Connect::seConnecter();

            $requeteGenre = $pdo->prepare("
            SELECT genre.label_genre, genre.id_genre
            FROM genre
            WHERE genre.id_genre = :id
            ");
            $requeteGenre->execute(["id" => $id]);

            $requeteDetailGenre = $pdo->prepare("
            SELECT genre.label_genre, movie.movie_title, movie.id_movie
            FROM genre
            INNER JOIN categorise ON categorise.id_genre = genre.id_genre
            INNER JOIN movie ON categorise.id_movie = movie.id_movie
            WHERE genre.id_genre = :id
            ");

            $requeteDetailGenre->execute(["id" => $id]);
            require "view/genre/detailGenre.php";     

    }

 
}



?>

