<?php

namespace Controller;
use Model\Connect;

class GenreController {

    
    // ^ Lister les genres
    

    public function listGenres() {
        $pdo = Connect::seConnecter();
            $requete = $pdo->query("
            SELECT genre.label_genre
            FROM genre
            ");

            require "view/genre/listGenres.php";
                    
    }


 
}

?>