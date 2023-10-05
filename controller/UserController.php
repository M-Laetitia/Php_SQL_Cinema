<?php
namespace Controller;
use Model\Connect;
session_start();

class UserController {

    // ^ Register
    public function register() {
        $pdo = Connect::seConnecter();
        if(isset($_POST["submit"])) {
            $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_SPECIAL_CHARS);
            $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_SPECIAL_CHARS);

            if($pseudo && $email && $pass1 && $pass2) {

                $requete = $pdo->prepare("SELECT * FROM user WHERE email = :email OR pseudo = :pseudo");
                $requete->execute(["email" => $email, "pseudo" => $pseudo]);
                $user = $requete->fetch();
                // si user existe redirection vers register
                if($user) {
                    $_SESSION["message"] = "This username or email already exists.";
                } else {
                    //insertion de l'utilisateur en BDD
                    if($pass1 == $pass2) {
                        // ajouter la date d'inscription
                        $dateInscription = date("Y-m-d H:i:s");  // date et  heure actuelles au format AAAA-MM-JJ HH:MM:SS
                        //regEX
                        $pattern =  '/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/';
                        if (preg_match($pattern,$pass1)) {
                            echo "password is strong enough";
                            $insertUser = $pdo->prepare("INSERT INTO user (pseudo, password, email, register_date ) 
                            VALUES (:pseudo, :password, :email, :dateInscription)");
                            $insertUser->execute ([
                                "pseudo" => $pseudo,
                                "password" => password_hash($pass1, PASSWORD_DEFAULT),
                                "email" => $email,
                                "dateInscription" => $dateInscription]);
                            $_SESSION["message"] = "Account successfully created! <br>Thank you for joining us!";
                            echo "<script>setTimeout(\"location.href = 'index.php?action=login';\",1500);</script>";
                            // header ("Location: index.php?action=landingPage"); exit;
                        } else {
                            $_SESSION["message"] = "The password is not strong enough. It must contain at least one capital letter, one number, one special character and be between 8 and 20 characters long.";
                        }
                    } else {
                        $_SESSION["message"] = "The passwords are different";
                    }
                }
            } else {
                $_SESSION["message"] = "A problem has occurred. Please fill in all fields correctly.";
            }
        }
        require("view/user/register.php");
    }
 

    // ^ Login
    public function login() {
        
        if(isset($_POST["submit"]))  {
        $pdo = Connect::seConnecter();

            
            $loggin = filter_input(INPUT_POST, "loggin", FILTER_SANITIZE_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($loggin && $password ) {
                $requete = $pdo->prepare("SELECT * FROM user  WHERE email = :loggin OR pseudo = :loggin");
                $requete->execute(["loggin" => $loggin]);
                $user = $requete->fetch();

                if($user) {
                    $hash = $user["password"];
                    if (password_verify($password, $hash)) {
                        $_SESSION["user"] = $user;

                        $_SESSION["message"] = "You have successfully logged in. <i class='fa-solid fa-check'></i>";
                        echo "<script>setTimeout(\"location.href = 'index.php?action=landingPage';\",1500);</script>";
 
                    } else {
                        // Identifiants invalides
                       $_SESSION["message"] = "Invalid email or password.";
                    }
                } else {
                   $_SESSION["message"] = "Invalid email or password.";
                }
            }
        }
        require("view/user/login.php");
    }

    // ^ Log out
    public function logout() {
        // session_unset();
        
        // $_SESSION["message"] = "You had been disconnected. See you soon !";
        unset($_SESSION["user"]);
        // echo "<script>setTimeout(\"location.href = 'index.php?action=landingPage';\",1500);</script>";
        
        // exit ; 
        header("Location: index.php?action=landingPage"); exit;
    }

    // ^ Profile
    public function profile() {
        if($_SESSION["user"]) {
            $pdo = Connect::seConnecter();
            $user = $_SESSION['user']['id_user'];
            // afficher liste films notés
            $requete = $pdo->prepare("SELECT rating.note, movie.movie_title, movie.id_movie
            FROM rating 
            INNER JOIN movie ON movie.id_movie = rating.id_movie
            WHERE rating.id_user = :id AND rating.note IS NOT NULL
            ORDER BY movie.movie_title ");
            $requete->execute(["id" => $user]);

            // afficher liste reviews postées
            $requeteReviews = $pdo->prepare("SELECT rating.reviewComplete, movie.movie_title, DATE_FORMAT(rating.date_review, '%d-%m-%Y %H:%i') AS formatted_date , movie.id_movie, rating.id_rating
            FROM rating
            INNER JOIN movie ON movie.id_movie = rating.id_movie
            WHERE rating.id_user = :id AND rating.reviewComplete IS NOT NULL
            ORDER BY movie.movie_title");
            $requeteReviews->execute(["id" => $user]);
            require("view/user/profile.php"); 
        } 
        else {
            // echo "pas d'user connecté";
            header ("Location: index.php?action=landingPage"); exit;
        }
    }

    // ^ Supprimer compte user
    public function deleteAccount() {
        $pdo = Connect::seConnecter();
        // supprimer user de la table user
        if($_SESSION["user"]) {
            $user= $_SESSION["user"]["id_user"]; // obtenir l'identifisant de l'user connecté
            $requete = $pdo->prepare("DELETE FROM user WHERE id_user = :id_user ");
            $requete->execute(["id_user" => $user]);
            // var_dump(($_SESSION["user"]));die;
            // Destroys all data registered to a session
            session_destroy();

            $_SESSION["message"] = "This account has been deleted!";
            echo "<script>setTimeout(\"location.href = 'index.php?action=landingPage';\",1500);</script>";
            // header ("Location: index.php?action=landingPage"); exit;
        } else {
            echo "pas d'user connecté";
            $_SESSION["message"] = " There is no user currently connected!";
            // header ("Location: index.php?action=landingPage"); exit;
        }
    }

    // ^ enregistrer le thème
    public function themePreference() {
        // récupérer l'id de l'user connecté à partir de la session
        $id_user = $_SESSION['user']['id_user'];
        // vérif si le formulaire a été soumis
        if(ISSET($_POST['theme'])) {
            // Créer un tableau associatif ?
            $newTheme = array('theme' => $_POST['theme']); 
            // convertir le tableau associatif en JSON
            $jsonTheme = json_encode($newTheme); 

            $pdo = Connect::seConnecter();
            $requete = $pdo->prepare('UPDATE user SET preference = :preference WHERE id_user = :id_user');
            $requete-> execute(array(':preference' => $jsonTheme, ':id_user' => $id_user));

            require("view/user/profile.php"); 
          }
          header("Location: index.php?action=profile"); exit(); 
    }

    // ^ récupérer le thème
    public function getTheme () {
        $id_user = $_SESSION['user']['id_user'];
            $pdo = Connect::seConnecter();

            $requete = $pdo->prepare(" SELECT user.preference
            FROM user
            WHERE id_user = :id_user");
            $requete->execute(["id_user" => $user]);
           
            if ($row = $requete->fetch(PDO::FETCH_ASSOC)) {
                $themePreference = $row['preference'];
                return $themePreference;
            } else {
                // Par défaut, retournez le thème "light" si aucune préférence n'est définie
                return "light";
        }
    }

    // // ^ Edit review user 
    // public function editerReviewUser ($id) {
    //     $pdo = Connect::seConnecter();

    //     $requeteReview = $pdo->prepare ("SELECT DATE_FORMAT(rating.date_review, '%d-%m-%Y %H:%i') AS formatted_date, rating.review, user.pseudo, movie.movie_title, rating.id_rating
    //     FROM rating 
    //     INNER JOIN movie ON movie.id_movie=rating.id_movie
    //     INNER JOIN user ON user.id_user=rating.id_user
    //     WHERE id_rating = :id");
    //     $requeteReview->execute(["id"=>$id]);

    //     $pattern = '/^.{200,800}$/';
    //     if(isset($_POST['editReview']) && (preg_match($pattern,$review)))  {
    //         $review = filter_input(INPUT_POST, "review", FILTER_SANITIZE_SPECIAL_CHARS);
            
    //         if(strlen($review) < 200 || strlen($review) > 800) {
    //             $_SESSION["message"] = "A problem has occurred, the authorized number of characters must be between 200 and 800.";
    //         } else {
    //             $requeteEditer = $pdo->prepare("UPDATE rating SET review = :review WHERE id_rating = :id");
    //             $requeteEditer->execute([
    //                 "review" => $review,
    //                 "id" => $id]);
    
    //             $_SESSION["message"] = "Review successfully edited! <i class='fa-solid fa-check'></i>";
    //             echo "<script>setTimeout(\"location.href = ' index.php?action=listFilms';\",1500);</script>";
    //         }
    //     }
    //     require "view/user/profile.php";
    // }



    // ^ Edit review modo

    public function editerReview ($id) {
        $pdo = Connect::seConnecter();

        $requeteReview = $pdo->prepare ("SELECT DATE_FORMAT(rating.date_review,'%d-%m-%Y %H:%i') AS formatted_date, rating.reviewComplete, user.pseudo, movie.movie_title, rating.id_rating
        FROM rating 
        INNER JOIN movie ON movie.id_movie=rating.id_movie
        INNER JOIN user ON user.id_user=rating.id_user
        WHERE id_rating = :id");
        $requeteReview->execute(["id"=>$id]);
  
        if(isset($_POST['editReview'])) {
            // var_dump("ok"); die;
            $review_title = filter_input(INPUT_POST, "review_title", FILTER_SANITIZE_SPECIAL_CHARS);
            $review_text = filter_input(INPUT_POST, "review_text", FILTER_SANITIZE_SPECIAL_CHARS);
            

            if(($review_title !== false && $review_text !== false) && (isset($_SESSION["user"]) && isset($_SESSION["user"]["role"]) && $_SESSION["user"]["role"] === 'moderateur')) {

                $reviewComplete = [
                    "title" => $review_title,
                    "text" => $review_text
                ];
                $json_review = json_encode($reviewComplete);

                $requeteEditer = $pdo->prepare("UPDATE rating SET reviewComplete = :reviewComplete WHERE id_rating = :id
                ");

                $requeteEditer->execute([
                    "reviewComplete" => $json_review,
                    "id" => $id
                ]);

                

               $_SESSION["message"] = "Review successfully edited! <i class='fa-solid fa-check'></i>";
                header("Location: index.php?action=listFilms");
            }

        }
        require "view/user/editerReview.php" ;
    }

      // ^ Edit review user

      public function editerReviewUser($id) {
        $pdo = Connect::seConnecter();
      

        $requeteReviewUser = $pdo->prepare ("SELECT DATE_FORMAT(rating.date_review,'%d-%m-%Y %H:%i') AS formatted_date, rating.reviewComplete, user.pseudo, movie.movie_title, rating.id_rating
        FROM rating 
        INNER JOIN movie ON movie.id_movie=rating.id_movie
        INNER JOIN user ON user.id_user=rating.id_user
        WHERE id_rating = :id");
        $requeteReviewUser->execute(["id"=>$id]);


        if(isset($_POST['editReviewUser'])) {
            // var_dump("ok"); die;
            $review_title = filter_input(INPUT_POST, "review_title", FILTER_SANITIZE_SPECIAL_CHARS);
            $review_text = filter_input(INPUT_POST, "review_text", FILTER_SANITIZE_SPECIAL_CHARS);
            

            if(($review_title !== false && $review_text !== false) && (isset($_SESSION["user"]) )) {

                $reviewComplete = [
                    "title" => $review_title,
                    "text" => $review_text
                ];
                $json_review = json_encode($reviewComplete);

                $requeteEditer = $pdo->prepare("UPDATE rating SET reviewComplete = :reviewComplete WHERE id_rating = :id
                ");

                $requeteEditer->execute([
                    "reviewComplete" => $json_review,
                    "id" => $id
                ]);

               $_SESSION["message"] = "Review successfully edited! <i class='fa-solid fa-check'></i>";
                header("Location: index.php?action=profile");
            }

        }
        require "view/user/editerReviewUser.php" ;
    }


    // ^ Supprimer une review par modo 
       public function supprimerReview($id) {
        $pdo = Connect::seConnecter();

        if (isset($id) && is_numeric($id) && (isset($_SESSION["user"]) && isset($_SESSION["user"]["role"]) && $_SESSION["user"]["role"] === 'moderateur') ) {

            $requete = $pdo->prepare("DELETE FROM review_likes WHERE id_rating = :id");
            $requete->execute(["id" => $id]);
            $requete = $pdo->prepare("DELETE FROM rating WHERE id_rating = :id");
            $requete->execute(["id" => $id]);
        }

        $_SESSION["message"] = "This review has been deleted!";
        echo "<script>setTimeout(\"location.href = 'index.php?action=listFilms';\",1500);</script>";
        // header("Location: index.php?action=listFilms");
    }


    // ^ Liker une review
    public function addLike($id)  {
        $pdo = Connect::seConnecter();
        $id_user = $_SESSION['user']['id_user'];

        
        if (isset($_POST['submitLike'])) {
            // Vérifier si l'utilisateur a déjà "liké" ou "disliké" cette review
            $requeteCheckLike = $pdo->prepare("SELECT * FROM review_likes WHERE id_rating = :id AND id_user = :id_user");
            $requeteCheckLike->execute([
                "id" => $id,
                "id_user" => $id_user
            ]);
    
            $existingLike = $requeteCheckLike->fetch();
    
            if ($existingLike) {
                // L'utilisateur a déjà "liké" ou "disliké" cette review
                if ($existingLike['is_like'] == 1) {
                    // Si c'était un "like", on supprime
                    $requeteRemoveLike = $pdo->prepare("DELETE FROM review_likes WHERE id_rating = :id AND id_user = :id_user");
                    $requeteRemoveLike->execute([
                        "id" => $id,
                        "id_user" => $id_user
                    ]);
                } else {
                    // Si c'était un "dislike",on met à jour pour faire un "like"
                    $likeValue = 1;
                    $requeteUpdateLike = $pdo->prepare("UPDATE review_likes SET is_like = :likeValue WHERE id_rating = :id AND id_user = :id_user");
                    $requeteUpdateLike->execute([
                        "id" => $id,
                        "id_user" => $id_user,
                        "likeValue" => $likeValue
                    ]);
                }
            } else {
                // L'utilisateur n'a pas encore "liké" cette review, on ajoute un like
                $likeValue = 1;
                $requeteAddLike = $pdo->prepare("INSERT INTO review_likes (id_rating, id_user, is_like)
                VALUES (:id, :id_user, :likeValue)");
    
                $requeteAddLike->execute([
                    "id" => $id,
                    "id_user" => $id_user,
                    "likeValue" => $likeValue
                ]);
            }
        }
    
        // Redirection vers la page où se trouvent les reviews
        header("Location: index.php?action=listFilms");
        exit;
    }


      // ^ disliker une review
      public function addDislike($id)  {
        $pdo = Connect::seConnecter();
        $id_user = $_SESSION['user']['id_user'];

        
    if (isset($_POST['submitDislike'])) {
        // Vérifier si l'utilisateur a déjà "liké" ou "disliké" cette review
        $requeteCheckLike = $pdo->prepare("SELECT * FROM review_likes WHERE id_rating = :id AND id_user = :id_user");
        $requeteCheckLike->execute([
            "id" => $id,
            "id_user" => $id_user
        ]);

        $existingLike = $requeteCheckLike->fetch();

        if ($existingLike) {
   
            if ($existingLike['is_like'] == 1) {
  
                $requeteRemoveLike = $pdo->prepare("DELETE FROM review_likes WHERE id_rating = :id AND id_user = :id_user");
                $requeteRemoveLike->execute([
                    "id" => $id,
                    "id_user" => $id_user
                ]);
            } else {
      
                $likeValue = 1;
                $requeteUpdateLike = $pdo->prepare("UPDATE review_likes SET is_like = :likeValue WHERE id_rating = :id AND id_user = :id_user");
                $requeteUpdateLike->execute([
                    "id" => $id,
                    "id_user" => $id_user,
                    "likeValue" => $likeValue
                ]);
            }
        } else {

            $likeValue = 0;
            $requeteAddLike = $pdo->prepare("INSERT INTO review_likes (id_rating, id_user, is_like)
            VALUES (:id, :id_user, :likeValue)");

            $requeteAddLike->execute([
                "id" => $id,
                "id_user" => $id_user,
                "likeValue" => $likeValue
            ]);
        }
    }

    // Redirection vers la page où se trouvent les reviews
    header("Location: index.php?action=listFilms");
    exit;
}



}
?>