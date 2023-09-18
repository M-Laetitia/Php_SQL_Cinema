<?php

namespace Controller;
use Model\Connect;

class DirectorController {

    
    // ^ Lister les réalisateurs
    

    public function listRealisateurs() {
        $pdo = Connect::seConnecter();
            $requete = $pdo->query("
            SELECT person.person_first_name, person.person_last_name, person.person_birthday
            FROM person
            INNER JOIN actor ON person.id_person = actor.id_person
            WHERE person.id_person = actor.id_person
            ");

            require "view/director/listRealisateurs.php";
                    
    }


 
}

?>