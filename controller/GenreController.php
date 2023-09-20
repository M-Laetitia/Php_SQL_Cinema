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
            SELECT genre.label_genre, movie.movie_title, movie.id_movie, genre.id_genre
            FROM genre
            INNER JOIN categorise ON categorise.id_genre = genre.id_genre
            INNER JOIN movie ON categorise.id_movie = movie.id_movie
            WHERE genre.id_genre = :id
            ");

            $requeteDetailGenre->execute(["id" => $id]);
            require "view/genre/detailGenre.php";     

    }

    // ^ Aller à la page d'ajout d'un genre

        public function getAjouterGenre(){
            $pdo = Connect::seConnecter(); 
            $requeteGetAjouterGenre = $pdo->query("SELECT movie.movie_title
            FROM movie
            INNER JOIN categorise ON categorise.id_movie = movie.id_movie
            INNER JOIN genre ON genre.id_genre = categorise.id_genre
            ");
            $requeteGetAjouterGenre->execute();
            require "view/Genre/ajouterGenre.php";
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
        if (isset($id) && is_numeric($id)) {

            $requeteSupprimerCategorise = $pdo->prepare("DELETE FROM categorise WHERE id_genre = :id");
            $requeteSupprimerCategorise->execute(["id" => $id]);
            
            $requeteSupprimerGenre = $pdo->prepare("DELETE FROM genre WHERE id_genre = :id");
            $requeteSupprimerGenre->execute(["id" => $id]);
        }

        //Ne pas inclure detailGenre avant la redirection. le code de "detailGenre.php" est toujours exécuté après la redirection, ce qui peut provoquer des erreurs car certaines variables ne sont pas définies
        
        // require "view/genre/detailGenre.php";
        header("Location: index.php?action=listGenres");

     }

      // ^ update genre

      
      public function updateGenre($id) {
        $pdo = Connect::seConnecter();

        // récupérer les données du genre à mettre à jour si besoin d'afficher les informations actuelles du genre dans le formulaire de mise à jour, pour que l'utilisateur puisse voir les données existantes avant de les modifier.
        $requeteGenre = $pdo->prepare("SELECT id_genre, label_genre FROM genre WHERE id_genre = :id"); 
        $requeteGenre->execute(["id"=>$id]);



            if(isset($_POST['updateGenre'])) {
                // Récupérez les données du formulaire
                $label_genre = filter_input(INPUT_POST, "label_genre", FILTER_SANITIZE_SPECIAL_CHARS);

                
                // vérifier si la variable $label_genre n'est pas évaluée comme étant false ou nulle. L'utilisation de if($label_genre) sans vérification supplémentaire pourrait poser des problèmes:  si le champ de saisie du nom de genre dans le formulaire est laissé vide, $label_genre serait une chaîne vide (""). Une chaîne vide est évaluée comme true dans un contexte booléen, ce qui signifie que la condition if($label_genre) serait vraie même si le champ est vide.

                 if($label_genre !== false) {
                    $pdo = Connect::seConnecter(); 
                     // Préparez la requête de mise à jour
                     $requeteUpdateGenre = $pdo->prepare("UPDATE genre SET label_genre = :label_genre WHERE id_genre = :id");

                     // Exécutez la mise à jour en liant les paramètres
                     $requeteUpdateGenre->execute([
                        "label_genre" => $label_genre,
                        "id" => $id
                    ]);

                    header("Location: index.php?action=listGenres");
            }
        }

        require "view/genre/updateGenre.php" ;

        }



     
}





?>


