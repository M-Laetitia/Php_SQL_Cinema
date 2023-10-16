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
            // initialisation variable pour stocker les résultats de la recherche
            $results = [];
    
            // requête SQL pour rechercher par nom de film
            $requeteFilms = $pdo->prepare("SELECT movie.* , CONCAT(person.person_first_name, ' ' ,person.person_last_name) AS directorComplete, director.id_director
            FROM movie 
            INNER JOIN director ON director.id_director = movie.id_director
            INNER JOIN person ON person.id_person = director.id_person
            WHERE movie.movie_title LIKE :search");

            // requête SQL pour rechercher par nom d'acteur
            $requeteActeurs =$pdo->prepare("SELECT * 
            FROM actor 
            INNER JOIN person ON actor.id_person = person.id_person WHERE person.person_first_name LIKE :search OR person.person_last_name LIKE :search");
    
            // requête SQL pour rechercher par nom de réalisateur
            $requeteRealisateurs = $pdo->prepare("SELECT * FROM director INNER JOIN person ON director.id_person = person.id_person WHERE person.person_first_name LIKE :search OR person.person_last_name LIKE :search");

            // requête SQL pour rechercher par role
            $requeteRoles = $pdo->prepare("SELECT role.*, CONCAT(person.person_first_name, ' ' , person.person_last_name) AS acteurComplete, movie.movie_title, movie.id_movie, actor.id_actor
            FROM role 
            INNER JOIN play ON play.id_role = role.id_role
            INNER JOIN actor ON actor.id_actor = play.id_actor
            INNER JOIN person ON person.id_person = actor.id_person
            INNER JOIN movie ON play.id_movie = movie.id_movie
            WHERE role.name_role LIKE :search");

            // requête SQL pour rechercher par genre
            $requeteGenres = $pdo->prepare("SELECT genre.id_genre, genre.label_genre, COUNT(categorise.id_movie) AS nb_movies
            FROM genre
            LEFT JOIN categorise ON genre.id_genre = categorise.id_genre
            WHERE genre.label_genre LIKE :search
            GROUP BY genre.id_genre, genre.label_genre ");
    
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
            require ("view/search/search.php");
        }
    }
}