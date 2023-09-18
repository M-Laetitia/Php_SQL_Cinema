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
            SELECT CONCAT(person.person_first_name, ' ' ,person.person_last_name) AS realComplete, person.person_birthday, person.person_sexe
            FROM person
            INNER JOIN director ON person.id_person = director.id_person
            WHERE id_director = :id"
            );
    
            $requetedetailRealisateur->execute (["id" => $id]);
            require "view/director/detailRealisateur.php";
        }

 
}

?>