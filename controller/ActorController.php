<?php

namespace Controller;
use Model\Connect;

class ActorController {

    
        // ^ Lister les acteurs

    
    public function listActeurs() {
        $pdo = Connect::seConnecter();
            $requete = $pdo->query("
            SELECT id_actor, CONCAT(person.person_first_name, ' ',person.person_last_name) AS acteurComplete, person.person_birthday
            FROM person
            INNER JOIN actor ON person.id_person = actor.id_person
            ");

            require "view/actor/listActeurs.php";
                    
    }

        // ^ Afficher détails acteur

    public function detailActeur($id) {
        $pdo = Connect::seConnecter();


        $requetedetailActeur = $pdo->prepare("
        SELECT actor.id_actor, CONCAT(person.person_first_name, ' ' ,person.person_last_name) AS acteurComplete, DATE_FORMAT(person.person_birthday, '%d' ' ' '%M' ' ' '%Y') AS dateDMY, person.person_sexe,  (DATE_FORMAT(CURDATE(), '%Y') - DATE_FORMAT(person.person_birthday, '%Y')) AS ActorAge
        FROM person
        INNER JOIN actor ON person.id_person = actor.id_person
        WHERE id_actor = :id"
        );
        $requetedetailActeur->execute(["id" => $id]);

        


        // ^ Liste des rôles

        $requeteRole = $pdo->prepare("
        SELECT  role.name_role, movie.movie_title, role.id_role
        FROM play
        INNER JOIN movie ON play.id_movie = movie.id_movie
        INNER JOIN role ON play.id_role = role.id_role
        WHERE play.id_actor = :id
        ORDER BY movie.movie_release_date DESC
        ");
        $requeteRole->execute(["id" => $id]);


        require "view/actor/detailActeur.php";
    }


    







 
}

?>
