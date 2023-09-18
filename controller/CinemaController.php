<?php

// On remarquera ici l'utilisation du "use" pour accéder à la classe Connect située dans le
// namespace "Model"
namespace Controller;
use Model\Connect;

class CinemaController {
    /**
     * Lister les films
     */

     public function ListFilms() {

        // On se connecte
        $pdo = Connect::seConnecter();
        // On exécute la requête de notre choix
        $requete = $pdo->query("
        SELECT movie_title, movie_release_date
        FROM movie
        ");

        // On relie par un "require" la vue qui nous intéresse (située dans le dossier "view")
        require "view/ListFilms.php";
     }
}

?>