<?php
namespace Controller;
use Model\Connect;
error_reporting(E_ALL);

class SearchController {

    public function search() {
        $pdo = Connect::seConnecter();
        
        // vérifier si le paramètre query est présent dans la requête post (= passé dans l'url) et s'il n'est pas vide
        if(isset($_POST['submit-search']) && !empty($_POST['submit-search'])) {
            $search = $_POST ['search'];
            var_dump($search);die;

            // Utilisez une requête SQL pour rechercher DB  en utilisant  LIKE et des opérateurs de correspondance partielle.
            $requeteSearch = $pdo->prepare(
                "SELECT * FROM movie WHERE movie.movie_title LIKE '%$search %'
                UNION
                SELECT * FROM person WHERE CONCAT(person.person_first_name, ' ', person.person_last_name) LIKE '%$search %'
                UNION
                SELECT * FROM genre WHERE genre.label_genre LIKE '%$search %'
                UNION
                SELECT * FROM role WHERE role.name_role LIKE '%$search %'
                ");

            

            // utilisation de % :  opérateurs de correspondance partielle  pour rechercher des chaînes de caractères qui correspondent partiellement à un motif spécifié.
            $requeteSearch->execute(['search' => "%$search%"]);
            // $results = $requeteSearch->fetchAll();
            // var_dump($results); die;  
            // var_dump($requeteSearch);
        }
       
        require "view/search/search.php";
    }
}

