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


// like dislikes


Modèle de données : Vous devrez ajouter une nouvelle table à votre base de données pour stocker les "likes" des critiques. Cette table pourrait ressembler à ceci :

CREATE TABLE review_likes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    review_id INT,
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (review_id) REFERENCES rating(id_rating)
);

Cette table permettra de relier les utilisateurs aux critiques qu'ils ont aimées.

Interface utilisateur : Sur chaque critique affichée sur la page, vous pouvez ajouter un bouton ou une icône "Like" à côté de la critique. Les utilisateurs pourront cliquer sur ce bouton pour indiquer qu'ils aiment la critique.

Traitement côté serveur : Lorsqu'un utilisateur clique sur le bouton "Like", vous devrez envoyer une requête au serveur pour enregistrer le "like". Cela pourrait être géré via une requête AJAX ou un formulaire POST. Vous devrez vérifier si l'utilisateur n'a pas déjà aimé cette critique (pour éviter les "likes" multiples du même utilisateur sur la même critique).

Enregistrement du "like" : Une fois que vous avez vérifié que l'utilisateur peut "liker" la critique, vous devez ajouter une entrée dans la table review_likes pour enregistrer ce "like". Vous pouvez également tenir compte du nombre total de "likes" pour chaque critique en ajoutant une colonne likes_count à la table rating.

Affichage des "likes" : Lorsque vous affichez les critiques, vous pouvez également afficher le nombre de "likes" qu'elles ont reçus à côté de chaque critique.

Gestion des "likes" : Vous devrez également permettre aux utilisateurs de retirer leur "like" s'ils le souhaitent. Cela signifie que vous devrez ajouter la logique pour supprimer l'entrée correspondante dans la table review_likes.

Sécurité : Assurez-vous de gérer correctement les autorisations et de ne permettre aux utilisateurs de "liker" que les critiques qu'ils ont le droit de "liker". Vous devrez également protéger votre application contre les tentatives de tricherie, comme les "likes" multiples d'un même utilisateur.

Affichage des critiques triées par "likes" : Vous pouvez également ajouter une fonctionnalité qui permet aux utilisateurs de trier les critiques par nombre de "likes", de sorte que les critiques les plus appréciées apparaissent en premier.

Notifications : Vous pouvez également envisager d'envoyer des notifications aux utilisateurs lorsqu'ils reçoivent un "like" sur l'une de leurs critiques.


// like and dislike :
CREATE TABLE review_likes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    review_id INT,
    is_like BOOLEAN, -- Un champ pour indiquer si c'est un "like" (TRUE) ou un "dislike" (FALSE)
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (review_id) REFERENCES rating(id_rating)
);

Interface utilisateur : Vous pouvez ajouter deux boutons ou icônes à côté de chaque critique, l'un pour "liker" et l'autre pour "disliker". Les utilisateurs peuvent cliquer sur l'un ou l'autre pour indiquer leur avis.

Traitement côté serveur : Lorsqu'un utilisateur clique sur le bouton "Like" ou "Dislike", vous devrez envoyer une requête au serveur pour enregistrer leur choix. Encore une fois, vous devrez vérifier si l'utilisateur n'a pas déjà effectué la même action (par exemple, s'il a déjà "liké" une critique, il ne peut pas le faire deux fois).

Enregistrement du "like" ou "dislike" : Vous enregistrez ensuite le choix de l'utilisateur dans la table review_likes, en spécifiant si c'est un "like" ou un "dislike". Vous pouvez également mettre à jour la table rating pour enregistrer le nombre de "likes" et de "dislikes" séparément.

Affichage des "likes" et "dislikes" : Lorsque vous affichez les critiques, vous pouvez afficher le nombre de "likes" et de "dislikes" à côté de chaque critique.

Gestion des "likes" et "dislikes" : Vous devez permettre aux utilisateurs de changer d'avis, c'est-à-dire de passer d'un "like" à un "dislike" ou vice versa. Vous devrez également gérer la suppression de leur "like" ou "dislike".

Affichage des critiques triées par "likes" et "dislikes" : Vous pouvez permettre aux utilisateurs de trier les critiques par nombre de "likes" ou de "dislikes", ou par le ratio entre les deux, de sorte que les critiques les plus controversées apparaissent en premier.

Notifications : Vous pouvez envisager d'envoyer des notifications aux utilisateurs lorsqu'ils reçoivent un "like" ou un "dislike" sur l'une de leurs critiques.


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