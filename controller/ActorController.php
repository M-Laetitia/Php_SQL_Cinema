<?php

namespace Controller;
use Model\Connect;

class ActorController {

    
    // ^ Lister les acteurs

    
    public function listActeurs() {
        $pdo = Connect::seConnecter();
            $requete = $pdo->query("
            SELECT actor.id_actor, CONCAT(person.person_first_name, ' ' ,person.person_last_name) AS acteurComplete, DATE_FORMAT(person.person_birthday, '%d' ' ' '%M' ' ' '%Y') AS dateDMY, person.person_sexe, 
            (DATE_FORMAT(CURDATE(), '%Y') - DATE_FORMAT(person.person_birthday, '%Y')) AS ActorAge
            FROM person
            INNER JOIN actor ON person.id_person = actor.id_person
            ");
            $requete->execute();
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

        
        // ^ Liste des films

        $requeteFilms = $pdo->prepare("
        SELECT movie.movie_title , movie.id_movie, actor.id_actor
        FROM movie
        INNER JOIN play ON play.id_movie = movie.id_movie
        INNER JOIN actor ON actor.id_actor = play.id_actor
        INNER JOIN person ON person.id_person = actor.id_person
        WHERE actor.id_actor = :id
        ");
        $requeteFilms->execute(["id" => $id]);


        // ^ Liste des rôles

        $requeteRole = $pdo->prepare("
        SELECT  role.name_role, movie.movie_title, role.id_role, play.id_actor
        FROM play
        INNER JOIN movie ON play.id_movie = movie.id_movie
        INNER JOIN role ON play.id_role = role.id_role
        WHERE play.id_actor = :id
        ORDER BY movie.movie_release_date DESC
        ");
        $requeteRole->execute(["id" => $id]);


        require "view/actor/detailActeur.php";
    }

       // ^ Aller à la page d'ajout d'un acteur 

        public function getAjouterActeur(){
        $pdo = Connect::seConnecter(); 
        $requeteGetAjouterActeur = $pdo->query("
        SELECT person.person_first_name, person.person_last_name
        FROM actor
        INNER JOIN person ON person.id_person = actor.id_person
        ");
        $requeteGetAjouterActeur->execute();
        require "view/actor/ajouterActeur.php";
    }



    // ^ Ajouter un acteur 

    public function ajouterActeur(){
        if(isset($_POST["submitActor"])){

            //filter les données entrées dans les différents input
            $person_first_name = filter_input(INPUT_POST, "person_first_name", FILTER_SANITIZE_SPECIAL_CHARS);
            $person_last_name = filter_input(INPUT_POST, "person_last_name", FILTER_SANITIZE_SPECIAL_CHARS);
            $person_sexe = filter_input(INPUT_POST, "person_sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $person_birthday = filter_input(INPUT_POST, "person_birthday", FILTER_SANITIZE_SPECIAL_CHARS);

            // si filtrées et existantes alors on peut exécuter la requête

            // The INSERT INTO statement is used to insert new records in a table.*
            if($person_first_name && $person_last_name && $person_sexe && $person_birthday){
                $pdo = Connect::seConnecter();
                $requeteAjouterPersonne = $pdo->prepare(" 
                    INSERT INTO person (person_first_name, person_last_name, person_sexe, person_birthday) 
                    VALUES (:person_first_name, :person_last_name, :person_sexe, :person_birthday)
                    ");
                $requeteAjouterPersonne ->execute([
                    "person_first_name" => $person_first_name,
                    "person_last_name" => $person_last_name,
                    "person_sexe" => $person_sexe,
                    "person_birthday" => $person_birthday,
                    
                ]);

                // Ajouter aussi à la table acteur?
                // The INSERT INTO SELECT statement copies data from one table and inserts it into another table.
                // The INSERT INTO SELECT statement requires that the data types in source and target tables match.
                // LAST_INSERT_ID() Function Return the AUTO_INCREMENT id of the last row that has been inserted or updated in a table: SELECT LAST_INSERT_ID();
                $id_acteur = $pdo->lastInsertID();
                
                $requeteAjouterActeur = $pdo->prepare("
                    INSERT INTO actor (id_person)
                    VALUES (:id_actor)
                    ");
                
                 $requeteAjouterActeur->execute([
                    "id_actor" => $id_acteur
                 ]);

                 
                
            }
            
        }
        // require "view/actor/ajouterActeur.php";
        header("Location: index.php?action=listActeurs");
    }

 

    // ^ Supprimer un acteur 

    public function supprimerActeur($id) {
        $pdo = Connect::seConnecter();
        // if(isset($_POST['deleteActor'])) {

        if (isset($id) && is_numeric($id)) {
            
            // d'abord supprimer les clés étrangères
            $requeteSupprimerActeur = $pdo->prepare("DELETE FROM play WHERE id_actor = :id");
            $requeteSupprimerActeur->execute(["id" => $id]);

            $requeteSupprimerActor1 = $pdo->prepare("DELETE FROM actor WHERE id_actor = :id");
            $requeteSupprimerActor1->execute(["id" => $id]);
        }
            
            header("Location: index.php?action=listActeurs");

    }


     // ^ Editer un acteur 

        public function updateActeur($id) {
            $pdo = Connect::seConnecter();
            $requeteUpdateActeur = $pdo->prepare(" SELECT actor.id_actor, CONCAT(person.person_first_name, ' ', person.person_last_name) AS acteurComplete, person.person_sexe, person.person_birthday, person.person_first_name, person.person_last_name
            FROM actor
            INNER JOIN person ON person.id_person = actor.id_person
            WHERE actor.id_actor = :id
            ");
            $requeteUpdateActeur->execute(["id"=>$id]);

            if(isset($_POST["updateActor"])){ 

                    $person_first_name = filter_input(INPUT_POST, "person_first_name", FILTER_SANITIZE_SPECIAL_CHARS);
                    $person_last_name = filter_input(INPUT_POST, "person_last_name", FILTER_SANITIZE_SPECIAL_CHARS);
                    $person_sexe = filter_input(INPUT_POST, "person_sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $person_birthday = filter_input(INPUT_POST, "person_birthday", FILTER_SANITIZE_SPECIAL_CHARS);

                if($person_first_name  && $person_last_name  && $person_sexe  && $person_birthday ){
                    $pdo = Connect::seConnecter();
                    $requeteAjouterPersonne = $pdo->prepare(" UPDATE person
                    INNER JOIN actor ON actor.id_person = person.id_person
                    SET person_first_name = :person_first_name, person_last_name = :person_last_name, person_sexe = :person_sexe, person_birthday = :person_birthday
                    WHERE actor.id_actor = :id
                        ");
                    $requeteAjouterPersonne ->execute([
                        "person_first_name" => $person_first_name,
                        "person_last_name" => $person_last_name,
                        "person_sexe" => $person_sexe,
                        "person_birthday" => $person_birthday,
                        "id" => $id,
                        
                    ]);

                    header("Location: index.php?action=listActeurs");

                }

        }
        require "view/actor/updateActeur.php" ;

    }




}

?>


