<?php

namespace Controller;
use Model\Connect;

class DirectorController {

    
    // ^ Lister les réalisateurs
    

    public function listRealisateurs() {
        $pdo = Connect::seConnecter();
            $requete = $pdo->query("
            SELECT id_director, CONCAT(person.person_first_name, ' ' ,person.person_last_name) AS realComplete, person.person_birthday
            FROM person
            INNER JOIN director ON person.id_person = director.id_person
            ");

            require "view/director/listRealisateurs.php";
                    
    }

    

        // ^ Afficher détails réalisateur

        public function detailRealisateur($id) {
            $pdo = Connect::seConnecter();
            $requetedetailRealisateur = $pdo->prepare("
            SELECT CONCAT(person.person_first_name, ' ' ,person.person_last_name) AS realComplete, DATE_FORMAT(person.person_birthday, '%d' ' ' '%M' ' ' '%Y') AS dateDMY, person.person_sexe,  (DATE_FORMAT(CURDATE(), '%Y') - DATE_FORMAT(person.person_birthday, '%Y')) AS ActorAge , person.person_sexe
            FROM person
            INNER JOIN director ON person.id_person = director.id_person
            WHERE id_director = :id"
            );
    
            $requetedetailRealisateur->execute (["id" => $id]);

             // ^ Liste des films 

            $requeteFilms = $pdo->prepare("
            SELECT movie.movie_title, movie.movie_release_date, director.id_director, movie.id_movie
            FROM movie
            INNER JOIN director ON movie.id_director = director.id_director
            INNER JOIN person ON person.id_person = director.id_director
            WHERE director.id_director = :id
            ");
            $requeteFilms->execute(["id" => $id]);



            require "view/director/detailRealisateur.php";
        }

 
}

?>