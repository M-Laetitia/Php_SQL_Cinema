echo "<div class='review'>";
        echo "<h2>{$review['title']}</h2>";
        echo "<p>{$review['content']}</p>";
        echo "<button class='like' data-review-id='{$review['id']}' data-action='like'>Like ({$review['likes']})</button>";
        echo "<button class='dislike' data-review-id='{$review['id']}' data-action='dislike'>Dislike ({$review['dislikes']})</button>";
        echo "</div>";

------------------------


JS : 
document.addEventListener('DOMContentLoaded', function () {
    const likeButtons = document.querySelectorAll('.like');
    const dislikeButtons = document.querySelectorAll('.dislike');

    likeButtons.forEach(button => {
        button.addEventListener('click', () => handleVote(button));
    });

    dislikeButtons.forEach(button => {
        button.addEventListener('click', () => handleVote(button));
    });

    function handleVote(button) {
        const reviewId = button.getAttribute('data-review-id');
        const action = button.getAttribute('data-action');

        // Envoyer une requête HTTP POST au serveur avec les données
        fetch('vote.php', {
            method: 'POST',
            body: JSON.stringify({ reviewId, action }),
            headers: {
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Mettre à jour le compteur de likes/dislikes
                const review = document.querySelector(`[data-review-id='${reviewId}']`);
                const likeButton = review.querySelector('.like');
                const dislikeButton = review.querySelector('.dislike');

                likeButton.textContent = `Like (${data.likes})`;
                dislikeButton.textContent = `Dislike (${data.dislikes})`;
            }
        })
        .catch(error => {
            console.error('Erreur lors de la requête :', error);
        });
    }
});


PHP : 
<?php
header('Content-Type: application/json');

// Simulez la connexion à la base de données (remplacez par votre propre logique)
$pdo = new PDO('mysql:host=localhost;dbname=ma_base_de_donnees', 'utilisateur', 'mot_de_passe');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'));

    if ($data && isset($data->reviewId, $data->action)) {
        $reviewId = intval($data->reviewId);
        $action = $data->action;

        // Mettez en œuvre votre logique pour gérer les votes ici
        // Vous devrez mettre à jour la base de données avec le vote de l'utilisateur
        // et renvoyer le nombre de likes et dislikes mis à jour en réponse.

        // Exemple simplifié :
        if ($action === 'like') {
            // Mettre à jour le nombre de likes dans la base de données
            // ...

            $likes = 42; // Remplacez par le vrai nombre de likes après la mise à jour
            $dislikes = 12; // Remplacez par le vrai nombre de dislikes après la mise à jour

            echo json_encode(['success' => true, 'likes' => $likes, 'dislikes' => $dislikes]);
        } elseif ($action === 'dislike') {
            // Mettre à jour le nombre de dislikes dans la base de données
            // ...

            $likes = 42; // Remplacez par le vrai nombre de likes après la mise à jour
            $dislikes = 12; // Remplacez par le vrai nombre de dislikes après la mise à jour

            echo json_encode(['success' => true, 'likes' => $likes, 'dislikes' => $dislikes]);
        } else {
            echo json_encode

