<?php

// On remarquera ici l'utilisation du "use" pour accéder à la classe Connect située dans le
// namespace "Model"
namespace Controller;
use Model\Connect;

class CinemaController {

    
    // ^ Lister les acteurs
    

    public function listActeurs() {
        $pdo = Connect::seConnecter();
            $requete = $pdo->query("
            SELECT person.person_first_name, person.person_last_name
            FROM person
            INNER JOIN actor ON person.id_person = actor.id_person
            WHERE person.id_person = actor.id_person
            ");

            require "view/listActeurs.php";
                    
    }


    // ^ Lister les films

     public function listFilms() {

        // On se connecte
        $pdo = Connect::seConnecter();
        // On exécute la requête de notre choix
        $requete = $pdo->query("
        SELECT movie_title, movie_release_date
        FROM movie
        ");

        // On relie par un "require" la vue qui nous intéresse (située dans le dossier "view")
        require "view/listFilms.php";
    }


     /**
      * Afficher détail film
      */

    //   public function detailFilm(){}


    // ^ Afficher détails acteur

    public function detailActeur($id) {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
        SELECT * 
        FROM actor
        WHERE id_actor = :id"
        );

        $requete->execute (["id" -> $id]);
        require "view/detailActeur.php";
    }

    // ^Afficher détails réalisateur

    public function detailRealisateur($id) {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
        SELECT *
        FROM director
        WHERE id_director = :id"
        );

        $requete->execute(["id" -> $id]);
        require "view/detailRealisateur.php";
    }
 
}

?>