<?php

namespace Controller;
use Model\Connect;

class GenreController {

    
    // ^ Lister les genres
    

    public function listGenres() {
        $pdo = Connect::seConnecter();
            $requete = $pdo->query("
            SELECT genre.label_genre, genre.id_genre
            FROM genre
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

     // ^ Ajouter genre

     public function ajouterGenre() {
        if(isset($_POST["submitGenre"])) {
            $label_genre = filter_input(INPUT_POST, "label_genre", FILTER_SANITIZE_SPECIAL_CHARS);


            if($label_genre) {
                $pdo = Connect::seConnecter();

                $requeteAjouterGenre = $pdo->prepare("
                INSERT INTO genre(label_genre)
                VALUES (:label_genre)
                ");
        
                $requeteAjouterGenre->execute([
                    "label_genre" => $label_genre
                ]);
            }
        }
            
        require "view/genre/ajouterGenre.php";
     }


     // ^ Supprimer genre

     public function supprimerGenre($id) {
        $pdo = Connect::seConnecter();
        if(isset($_POST['deleteGenre'])) {
            
            $requeteSupprimerGenre = $pdo->prepare("
            DELETE FROM genre WHERE id_genre = :id
            ");
            $requeteSupprimerGenre->execute(["id" => $id]);
        }

        //Ne pas inclure detailGenre avant la redirection. le code de "detailGenre.php" est toujours exécuté après la redirection, ce qui peut provoquer des erreurs car certaines variables ne sont pas définies
        
        // require "view/genre/detailGenre.php";
        header("Location: index.php?action=listGenres");

     }

}


?>


