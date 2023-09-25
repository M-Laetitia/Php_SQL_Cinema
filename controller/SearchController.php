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
    
            // initialisation variable pour stocker les résultats de la recherche
            $results = [];
    
            // requête SQL pour rechercher par nom de film
            $requeteFilms = $pdo->prepare("SELECT * FROM movie WHERE movie.movie_title LIKE :search");

            // requête SQL pour rechercher par nom d'acteur
            $requeteActeurs =$pdo->prepare("SELECT * FROM actor INNER JOIN person ON actor.id_person = person.id_person WHERE person.person_first_name LIKE :search OR person.person_last_name LIKE :search");
    
            // requête SQL pour rechercher par nom de réalisateur
            $requeteRealisateurs = $pdo->prepare("SELECT * FROM director INNER JOIN person ON director.id_person = person.id_person WHERE person.person_first_name LIKE :search OR person.person_last_name LIKE :search");


            // requête SQL pour rechercher par role
            $requeteRoles = $pdo->prepare("SELECT * FROM role WHERE role.name_role LIKE :search");

            // requête SQL pour rechercher par genre
            $requeteGenres = $pdo->prepare("SELECT * FROM genre WHERE genre.label_genre LIKE :search");
    
            // Exécutez toutes les requêtes SQL
            $requeteFilms->execute(['search' => "%$search%"]);
            $requeteActeurs->execute(['search' => "%$search%"]);
            $requeteRealisateurs->execute(['search' => "%$search%"]);
            $requeteGenres->execute(['search' => "%$search%"]);
            $requeteRoles->execute(['search' => "%$search%"]);
    
            // Récupérez les résultats de chaque requête
            $resultsFilms = $requeteFilms->fetchAll();
            $resultsActeurs = $requeteActeurs->fetchAll();
            $resultsRealisateurs = $requeteRealisateurs->fetchAll();
            $resultsGenres = $requeteGenres->fetchAll();
            $resultRoles = $requeteRoles->fetchAll();
    
            // Stockez les résultats dans un tableau associatif pour les afficher dans la vue
            $results = [
                'films' => $resultsFilms,
                'acteurs' => $resultsActeurs,
                'realisateurs' => $resultsRealisateurs,
                'roles' => $resultRoles,
                'genres' => $resultsGenres,
            ];
    
            // var_dump($results);die;
    
   
            require ("view/search/search.php");
        }
    }
   
}

