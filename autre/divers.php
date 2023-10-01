<?php

public function addRating () {

$userId = $_SESSION['user']['id_user'];
// var_dump($_SESSION['user']);die;
$filmId = $_GET['id'];
// var_dump($_GET['id']);die;

if(isset($_POST["user_rating"])) {
    // vérifier si user est connecté


    $user_rating = filter_input(INPUT_POST, "user_rating", FILTER_SANITIZE_NUMBER_INT);

        if($user_rating !== false) {
            $pdo = Connect::seConnecter();

            $requete = $pdo->prepare("INSERT INTO rating (id_movie, id_user, note) 
            VALUES (:id_movie, :id_user, :note)
            ");
            $resultat = $requete->execute ([
                "id_movie" => $filmId,
                "id_user" => $userId,
                "note" => $user_rating
            ]);

            if ($resultat) {
                echo "La note a été ajoutée avec succès.";
            } else {
                // Affichez les éventuelles erreurs SQL
                var_dump($pdo->errorInfo());
            }
        } else {
            // Note invalide
        }
    } else {
        // Utilisateur non connecté
    }
}

?>