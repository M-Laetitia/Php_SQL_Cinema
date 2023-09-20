<?php

namespace Controller;
use Model\Connect;

class DirectorController {

    
    // ^ Lister les réalisateurs

        public function listRealisateurs() {
            $pdo = Connect::seConnecter();
                $requete = $pdo->query("
                SELECT director.id_director, CONCAT(person.person_first_name, ' ' ,person.person_last_name) AS realComplete, person.person_birthday
                FROM person
                INNER JOIN director ON person.id_person = director.id_person
                ");

                require "view/director/listRealisateurs.php";
                        
    }

    

    // ^ Afficher détails réalisateur

        public function detailRealisateur($id) {
            $pdo = Connect::seConnecter();
            $requetedetailRealisateur = $pdo->prepare("
            SELECT director.id_director, CONCAT(person.person_first_name, ' ' ,person.person_last_name) AS realComplete, DATE_FORMAT(person.person_birthday, '%d' ' ' '%M' ' ' '%Y') AS dateDMY, person.person_sexe,  (DATE_FORMAT(CURDATE(), '%Y') - DATE_FORMAT(person.person_birthday, '%Y')) AS ActorAge , person.person_sexe
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

     // ^ Aller à la page d'ajout d'un acteur 

       public function getAjouterRealisateur(){
        $pdo = Connect::seConnecter(); 
        $requeteGetAjouterRealisateur = $pdo->query("
        SELECT person.person_first_name, person.person_last_name
        FROM director
        INNER JOIN person ON person.id_person = director.id_person
        ");
        $requeteGetAjouterRealisateur->execute();
        require "view/director/ajouterRealisateur.php";
    }


    // ^ Ajouter Réalisateur 

    public function ajouterRealisateur(){
        if(isset($_POST["submitRealisateur"])){

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
                $id_realisateur = $pdo->lastInsertID();
                $requeteAjouterRealisateur = $pdo->prepare("
                    INSERT INTO director (id_person)
                    VALUES (:id_director)
                    ");   
                $requeteAjouterRealisateur ->execute([
                    "id_director" => $id_realisateur
                ]);
   
            }
        }
        require "view/director/ajouterRealisateur.php";
    }

  



      // ^ Supprimer un réalisateur 

      public function supprimerRealisateur($id) {
        $pdo = Connect::seConnecter();

        if (isset($id) && is_numeric($id)) {
            
            $requeteSupprimerMovie = $pdo->prepare("DELETE FROM movie WHERE id_director = :id");
            $requeteSupprimerMovie->execute(["id"=>$id]);

            $requeteSupprimerActor = $pdo->prepare("DELETE FROM director WHERE id_director = :id");
            $requeteSupprimerActor->execute(["id" => $id]);
        }
            
            header("Location: index.php?action=listRealisateurs");

    }


         // ^ Editer un réalisateur

         public function updateRealisateur($id) {
            $pdo = Connect::seConnecter();
            $requeteUpdateRealisateur = $pdo->prepare(" SELECT director.id_director, CONCAT(person.person_first_name, ' ', person.person_last_name) AS directorComplete, person.person_sexe, person.person_birthday, person.person_first_name, person.person_last_name
            FROM director
            INNER JOIN person ON person.id_person = director.id_person
            WHERE director.id_director = :id
            ");
            $requeteUpdateRealisateur->execute(["id"=>$id]);

            if(isset($_POST["updateDirector"])){ 

                    $person_first_name = filter_input(INPUT_POST, "person_first_name", FILTER_SANITIZE_SPECIAL_CHARS);
                    $person_last_name = filter_input(INPUT_POST, "person_last_name", FILTER_SANITIZE_SPECIAL_CHARS);
                    $person_sexe = filter_input(INPUT_POST, "person_sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $person_birthday = filter_input(INPUT_POST, "person_birthday", FILTER_SANITIZE_SPECIAL_CHARS);

                if($person_first_name !== false  && $person_last_name !== false  && $person_sexe !== false  && $person_birthday !== false ){
                    $pdo = Connect::seConnecter();
                    $requeteAjouterPersonne = $pdo->prepare(" UPDATE person
                    INNER JOIN director ON director.id_person = person.id_person
                    SET person_first_name = :person_first_name, person_last_name = :person_last_name, person_sexe = :person_sexe, person_birthday = :person_birthday
                    WHERE director.id_director = :id
                        ");
                    $requeteAjouterPersonne ->execute([
                        "person_first_name" => $person_first_name,
                        "person_last_name" => $person_last_name,
                        "person_sexe" => $person_sexe,
                        "person_birthday" => $person_birthday,
                        "id" => $id,
                        
                    ]);

                    header("Location: index.php?action=listRealisateurs");

                }

        }
        require "view/director/updateRealisateur.php" ;

    }


 
}

?>
