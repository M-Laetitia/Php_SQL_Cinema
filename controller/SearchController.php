<?php
namespace Controller;
use Model\Connect;
error_reporting(E_ALL);
ini_set('display_errors', 1);

class SearchController {

    public function search() {
        $pdo = Connect::seConnecter();
        
        if(isset($_POST['submit-search'])) {
            $search = $_POST['search'];
            // var_dump($search);die;
    
            // Initialisez une variable pour stocker les résultats de la recherche
            $results = [];
    
            // Construisez la requête SQL pour rechercher par nom de film
            $requeteSearch = $pdo->prepare("SELECT * FROM movie WHERE movie.movie_title LIKE :search");
    
            // Si une soumission de recherche valide est détectée, exécutez la requête SQL
            $requeteSearch->execute(['search' => "%$search%"]);
            $results = $requeteSearch->fetchAll();
            // var_dump($results);die;
            
            // Affichez les résultats de la recherche dans la vue
            require ("view/search/search.php");
        }
    
    }
    
    
}

