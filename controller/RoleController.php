<?php

namespace Controller;
use Model\Connect;

class RoleController {

    
    // ^ Lister les rôles
    

    public function listRoles() {
        $pdo = Connect::seConnecter();
            $requeteListRole = $pdo->query("
            SELECT role.name_role, CONCAT(person.person_first_name, ' '  ,person.person_last_name) AS actorComplete, movie.movie_title, movie.id_movie, actor.id_actor, role.id_role
            FROM play
            INNER JOIN role ON role.id_role = play.id_role
            INNER JOIN actor ON actor.id_actor = play.id_actor
            INNER JOIN person ON person.id_person = actor.id_person
            INNER JOIN movie ON movie.id_movie = play.id_movie

            ");

            require "view/role/listRoles.php";
                    
    }


        // ^ Afficher détails rôle

        public function detailRole($id) {
            $pdo = Connect::seConnecter();
            $requeteDetailRole = $pdo->prepare("
            SELECT role.name_role, movie.movie_title, CONCAT(person.person_first_name, ' ' ,person.person_last_name) AS actorComplete, movie.id_movie, actor.id_actor
            FROM role
            INNER JOIN play ON play.id_role = role.id_role
            INNER JOIN movie ON movie.id_movie = play.id_movie
            INNER JOIN actor ON actor.id_actor = play.id_actor
            INNER JOIN person ON person.id_person = actor.id_person
            WHERE role.id_role = :id"
            );
    
            $requeteDetailRole->execute (["id" => $id]);
            require "view/role/detailRole.php";
        }

 
}

?>