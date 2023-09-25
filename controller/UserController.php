<?php
namespace Controller;
use Model\Connect;
error_reporting(E_ALL);

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

                $requete = $pdo->prepare("SELECT * 
                FROM user
                WHERE  email = :email 
                ");

                $requete->execute(["email"=> $email]);
                $user = $requete->fetch();
                // si user existe redirection vers register
                if($user) {
                    echo "Il existe déjà un compte avec cette adresse mail";
                    // header("Location: register.php"); exit;
                } else {
                    // var_dump("utilisateur inexistant");die;
                    //insertion de l'utilisateur en BDD
                    if($pass1 == $pass2  && strlen($pass1) >= 5) {
                        // ajouter la date d'inscription
                        $dateInscription = date("Y-m-d H:i:s");  // date et  heure actuelles au format AAAA-MM-JJ HH:MM:SS
                        //mettre en place une regX
                        $insertUser = $pdo->prepare("INSERT INTO user (pseudo, password, email, register_date ) 
                        VALUES (:pseudo, :password, :email, :dateInscription)");
                        $insertUser->execute ([
                            "pseudo" => $pseudo,
                            "password" => password_hash($pass1, PASSWORD_DEFAULT),
                            "email" => $email,
                            "dateInscription" => $dateInscription
                            
                        ]);
                        // header ("Location: login.php"); exit;
                    } else {
                        echo "les mots de passe ne sont pas identiques ou trop courts";
                    }
                }

            } else {
                echo "Un problème est survenu, des champs n'ont pas été remplis correctement";
            }


        }
        require("view/user/register.php");
        // par défaut j'affiche le formulaire d'inscription
        // header ("Location: register.php"); exit;
        
    }

    // ^ Login
    public function login() {
        $pdo = Connect::seConnecter();

        if(isset($_POST["submit"]))  {


            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Avant la requête SQL
            // echo "Email: " . $email . "<br>";
            // echo "Password: " . $password . "<br>";

            if($email && $password ) {
                $requete = $pdo->prepare("SELECT * FROM user WHERE email = :email ");
                $requete->execute(["email" => $email]);
                $user = $requete->fetch();

                // var_dump($user);die;

                if($user) {
                    $hash = $user["password"];
                    if (password_verify($password, $hash)) {
                        $_SESSION["user"] = $user;
                        

                        // rediriger vers page d'accueil
                        echo "Connexion réussie";
                        // header("Location: index.php?action=landingPage");   exit;
                    } else {
                        // Identifiants invalides
                        echo "Invalid email or password";
                    }
                }
            }
        }
        require("view/user/login.php");
    }


    // // ^ Log out

    // public function logout() {
    //     unset($_SESSION["user"]);
    //     echo "Vous avez bien été déconnecté";
    //     header("Location: index.php?action=landingPage"); exit;
    // }


    // // ^ Allez sur le profil
    // public function viewProfile() {
    //     require("view/User/userProfile.php");
    // }

    // // ^ Supprimer l'user de la table User

    
}
?>


