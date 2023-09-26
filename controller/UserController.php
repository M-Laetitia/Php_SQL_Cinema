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
                    if($pass1 == $pass2) {
                        // ajouter la date d'inscription
                        $dateInscription = date("Y-m-d H:i:s");  // date et  heure actuelles au format AAAA-MM-JJ HH:MM:SS

                        $pattern =  '/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/';
                        if (preg_match($pattern,$pass1)) {
                            echo "password is strong enoug";

                            $insertUser = $pdo->prepare("INSERT INTO user (pseudo, password, email, register_date ) 
                            VALUES (:pseudo, :password, :email, :dateInscription)");
                            $insertUser->execute ([
                                "pseudo" => $pseudo,
                                "password" => password_hash($pass1, PASSWORD_DEFAULT),
                                "email" => $email,
                                "dateInscription" => $dateInscription
                                
                            ]);
                            header ("Location: index.php?action=landingPage"); exit;

                            
                        } else {
                            echo "password is not strong enough";
                        }

           
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
        

        if(isset($_POST["submit"]))  {
        $pdo = Connect::seConnecter();

            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            

            if($email && $password ) {
                $requete = $pdo->prepare("SELECT * FROM user WHERE email = :email ");
                $requete->execute(["email" => $email]);
                $user = $requete->fetch();

                // var_dump($user);die;

                if($user) {
                    $hash = $user["password"];
                    if (password_verify($password, $hash)) {
                        $_SESSION["user"] = $user;
                        //var_dump($_SESSION["user"]);die;

                        // rediriger vers page d'accueil
                        echo "<p> Connexion réussie </p>";
                        header("Location: index.php?action=landingPage");   exit;
                    } else {
                        // Identifiants invalides
                        
                        echo " <p> Invalid email or password </p>";
                    }
                } else {
                    
                    echo " <p> Invalid email or password </p>";
                }
            }
        }
        require("view/user/login.php");
    }


    // ^ Log out

    public function logout() {
        unset($_SESSION["user"]);
        // session_unset();
        echo "You had been disconnected";
        header("Location: index.php?action=landingPage"); exit;
    }





    // ^ Profile
    public function profile() {

        if($_SESSION["user"]) {
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
             $requete = $pdo->prepare("DELETE FROM user WHERE user = :user ");
            $requete->execute(["user" => $user]);
            var_dump(($_SESSION["user"]));die;
            // Destroys all data registered to a session
            session_destroy();
            echo "Account deleted";
            header ("Location: index.php?action=landingPage"); exit;
        } else {
            echo "pas d'user connecté";
            header ("Location: index.php?action=landingPage"); exit;
        }

    }

    
     
}
?>


