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
        require "view/actor/ajouterActeur.php";
    }
}

?>


<!-- *It is possible to write the INSERT INTO statement in two ways:
1. Specify both the column names and the values to be inserted:

INSERT INTO table_name (column1, column2, column3, ...)
VALUES (value1, value2, value3, ...); -->



<!-- https://www.hostinger.com/tutorials/how-to-use-php-to-insert-data-into-mysql-database-->
<!-- https://stackoverflow.com/questions/10680943/pdo-get-the-last-id-inserted -->


<!-- $stmt = $db->prepare("...");
$stmt->execute();
$id = $db->lastInsertId(); -->