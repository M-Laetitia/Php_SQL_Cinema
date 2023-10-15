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



            // star rating
    const stars = document.querySelectorAll('.star');
    const userRatingInput = document.getElementById('user_rating_hidden'); // Champ input hidden

    stars.forEach(star => {
    star.addEventListener('mouseover', () => {
        const rating = star.getAttribute('data-rating');
        highlightStars(rating);
    });

    star.addEventListener('mouseleave', () => {
        highlightStars(currentRating);
    });

    star.addEventListener('click', () => {
        const rating = star.getAttribute('data-rating');
        currentRating = rating;
        userRatingInput.value = rating; // Mettre à jour la valeur du champ input hidden
        alert(`Vous avez noté le film avec ${rating} étoile(s).`);
    });
    });

    function highlightStars(rating) {
    currentRating = rating; // Mettre à jour la note actuelle
    stars.forEach(star => {
        if (star.getAttribute('data-rating') <= rating) {
            star.classList.add('active');
        } else {
            star.classList.remove('active');
        }
    });
}



// gestion admin/ modo


if ($_SESSION['user']['role'] === 'modo' || $_SESSION['user']['role'] === 'admin') {
    // Afficher le bouton de suppression
}




if ($_SESSION['user']['role'] === 'modo' || $_SESSION['user']['role'] === 'admin') {
    // Autoriser la suppression du message
} else {
    // Afficher un message d'erreur ou rediriger vers une autre page
}




// 
<form action="index.php?action=ajouterReview&id=<?php echo $filmId; ?>" method="POST">
    <label for="title">Titre de la review :</label>
    <input type="text" id="title" name="title" required>
    
    <label for="text">Texte de la review (minimum 50 caractères, maximum 500 caractères) :</label>
    <textarea id="text" name="text" rows="4" minlength="50" maxlength="500" required></textarea>
    
    <input type="submit" value="Soumettre la review">
</form>


// JSON

// Récupérez les données du formulaire
$title = $_POST["title"];
$text = $_POST["text"];

// Créez un tableau associatif pour la review
$reviewData = [
    "title" => $title,
    "text" => $text
];

// Convertissez le tableau en JSON
$reviewJson = json_encode($reviewData);

// Insérez les données JSON dans la base de données
$pdo = Connect::seConnecter();
$user = $_SESSION['user']['id_user'];
$filmId = $_GET["id"]; // Obtenez l'ID du film à partir de l'URL

$requete = $pdo->prepare("INSERT INTO user (id_user, id_film, note, date_publication, review)
                          VALUES (:id_user, :id_film, :note, NOW(), :review)");
$requete->execute([
    "id_user" => $user,
    "id_film" => $filmId,
    "note" => $rating,
    "review" => $reviewJson
]);


// Récupérez les données de review de la base de données
// ...

// Décodez le JSON
$reviewData = json_decode($row["review"], true); // Le deuxième argument true signifie que vous obtiendrez un tableau associatif

// Utilisez les données de review
$title = $reviewData["title"];
$text = $reviewData["text"];


<form action="index.php?action=ajouterReview&id=<?php echo $filmId; ?>" method="POST">
    <label for="title">Titre de la review :</label>
    <input type="text" id="title" name="title" required>
    
    <label for="text">Texte de la review :</label>
    <textarea id="text" name="text" rows="4" required></textarea>
    
    <input type="submit" value="Soumettre la review">
</form>


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Assurez-vous que le formulaire a été soumis en POST

    // Récupérez les données du formulaire
    $title = $_POST["title"];
    $text = $_POST["text"];

    // Enregistrez ces données dans la base de données comme mentionné précédemment
    // ...

    // Redirigez l'utilisateur vers la page de détail du film ou affichez un message de confirmation
    // ...
}

// Récupérer la préférence de l'user concernant le thème
                    // $id_user = $user["id_user"];
                    // $requete = $pdo->prepare('SELECT preference FROM user WHERE id_user = :id_user');
                    // $requete->execute(array(":id_user" => $user_id));
                    // $user_preference = $requete->fetch();

                    // if ($user_preference) {
                    //     $_SESSION["user_theme"] = json_decode($user_preference, true)['theme'];
                    //     var_dump($_SESSION["user_theme"]); die;
                    // } else {
                    //     // Par défaut, utiliser un thème (ici, "light") si l'user n'a pas de préférence enregistrée
                    //     $_SESSION["user_theme"] = "light";
                    // }

                        // rediriger vers page d'accueil





<div class="number">

<?php 
if (isset($review['nb_likes'])) {
    echo $review['nb_likes'];
} else {
    echo 0;
}
?>
</div>

<!-- expression conditionnelle ternaire - version "abrégée" -->
<div class="number"><?= $review['nb_dislikes'] ?? 0 ?></div>
                