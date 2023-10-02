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



/// 

{
    "title": "You name a genre, this movie covers it",
    "review": "I can't remember the last time I saw a movie that contained as many genres as 'Parasite'. The movie starts out almost like an 'Ocean's Eleven' heist film and then expands into a comedy, mystery, thriller, drama, romance, crime and even horror film. It really did have everything and it was strikingly good at all of them too."
}


{
    "title": "You name a genre, this movie covers it",
    "text": "I can't remember the last time I saw a movie that contained as many genres as 'Parasite'. The movie starts out almost like an 'Ocean's Eleven' heist film and then expands into a comedy, mystery, thriller, drama, romance, crime and even horror film. It really did have everything and it was strikingly good at all of them too."
}


SELECT rating.review, rating.date_review, user.pseudo
                FROM rating 
                INNER JOIN user ON user.id_user = rating.id_user
                INNER JOIN movie ON movie.id_movie = rating.id_movie
                WHERE movie.id_movie = 51 AND rating.review IS NOT NULL 

                <?php 
                foreach($requeteReview->fetchAll() as $review) { ?>
                <p><?= $review["review"] ?></p>
                        
            <?php  } ?>