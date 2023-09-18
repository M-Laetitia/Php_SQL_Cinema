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
        SELECT actor.id_actor, person.person_first_name, person.person_last_name, person.person_birthday, person.person_sexe
        FROM person
        INNER JOIN actor ON person.id_person = actor.id_person
        WHERE id_actor = :id"
        );
        $requetedetailActeur->execute(["id" => $id]);

        $requeteFilms = $pdo->prepare("
        SELECT movie.movie_title, movie.movie_release_date, actor.id_actor
        FROM movie
        INNER JOIN play ON play.id_movie = movie.id_movie
        INNER JOIN actor ON actor.id_actor = play.id_actor
        INNER JOIN person ON person.id_person = actor.id_person
        WHERE actor.id_actor = :id
        ");
        $requeteFilms->execute(["id" => $id]);


        require "view/actor/detailActeur.php";
    }

 
}

?>