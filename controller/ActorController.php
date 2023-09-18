<?php

namespace Controller;
use Model\Connect;

class ActorController {

    
    // ^ Lister les acteurs
    

    public function listActeurs() {
        $pdo = Connect::seConnecter();
            $requete = $pdo->query("
            SELECT person.person_first_name, person.person_last_name, person.person_birthday
            FROM person
            INNER JOIN actor ON person.id_person = actor.id_person
            WHERE person.id_person = actor.id_person
            ");

            require "view/actor/listActeurs.php";
                    
    }


 
}

?>