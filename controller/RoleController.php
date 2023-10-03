<?php
namespace Controller;
use Model\Connect;
class RoleController {

    // ^ Lister les rôles
    public function listRoles() {
        $pdo = Connect::seConnecter();
        $requeteListRole = $pdo->query("SELECT role.id_role, role.name_role, CONCAT(person.person_first_name, ' '  ,person.person_last_name) AS actorComplete, movie.movie_title, movie.id_movie, actor.id_actor, role.id_role
        FROM play
        INNER JOIN role ON role.id_role = play.id_role
        INNER JOIN actor ON actor.id_actor = play.id_actor
        INNER JOIN person ON person.id_person = actor.id_person
        INNER JOIN movie ON movie.id_movie = play.id_movie
        ORDER by role.name_role ASC
        ");
        require "view/role/listRoles.php";          
    }

    // ^ Afficher détails rôle
    public function detailRole($id) {
        $pdo = Connect::seConnecter();
        $requeteDetailRole = $pdo->prepare("SELECT role.id_role, role.name_role, movie.movie_title, CONCAT(person.person_first_name, ' ', person.person_last_name) AS actorComplete, movie.id_movie, person.person_image, actor.id_actor
        FROM role
        INNER JOIN play ON play.id_role = role.id_role
        INNER JOIN movie ON movie.id_movie = play.id_movie
        INNER JOIN actor ON actor.id_actor = play.id_actor
        INNER JOIN person ON person.id_person = actor.id_person
        WHERE role.id_role = :id
        "
        );
        $requeteDetailRole->execute (["id" => $id]);
        // var_dump($requeteDetailRole); die;
        require "view/role/detailRole.php";
    }

    // ^ Aller à la page d'ajout d'un rôle
    public function getAjouterRole(){
        $pdo = Connect::seConnecter(); 
        $requeteGetAjouterRole = $pdo->query("
        SELECT role.name_role
        FROM role
        ");
        $requeteGetAjouterRole->execute();
        require "view/role/ajouterRole.php";
    }

    // ^ Ajouter Role

    public function ajouterRole() {
        if(isset($_POST["submitRole"])) {
            $name_role = filter_input(INPUT_POST, "name_role", FILTER_SANITIZE_SPECIAL_CHARS);

            if($name_role) {
                $pdo = Connect::seConnecter();

                $requeteAjouterRole = $pdo->prepare("INSERT INTO role(name_role)
                VALUES (:name_role)
                ");

                $requeteAjouterRole->execute ([
                    "name_role" => $name_role
                ]);
            }
            header("Location: index.php?action=listRoles");
        }
        require "view/role/ajouterRole.php";
       
    }

    // ^ Supprimer un role
    public function supprimerRole($id) {
        $pdo = Connect::seConnecter();
        if (isset($id) && is_numeric($id)) {
            
            $requeteSupprimerPlay = $pdo->prepare("DELETE FROM play WHERE id_role = :id");
            $requeteSupprimerPlay->execute(["id" => $id]);

            $requeteSupprimerRole = $pdo->prepare("DELETE FROM role WHERE id_role = :id");
            $requeteSupprimerRole->execute(["id" => $id]);

        }
        header("Location: index.php?action=listRoles");
    }

    // ^ Update role
    public function updateRole($id) {
        $pdo = Connect::seConnecter();
        // récupérer les données du genre à mettre à jour si besoin d'afficher les informations actuelles du genre dans le formulaire de mise à jour, pour que l'utilisateur puisse voir les données existantes avant de les modifier.
        $requeteRole = $pdo->prepare("SELECT id_role, name_role FROM role WHERE id_role = :id"); 
        $requeteRole->execute(["id"=>$id]);


        if(isset($_POST['updateRole'])) {
            // Récupérez les données du formulaire
            $name_role = filter_input(INPUT_POST, "name_role", FILTER_SANITIZE_SPECIAL_CHARS);

                if($name_role !== false) {
                $pdo = Connect::seConnecter(); 
                    // Préparez la requête de mise à jour
                    $requeteUpdateRole = $pdo->prepare("UPDATE role SET name_role = :name_role WHERE id_role = :id");

                    // Exécutez la mise à jour en liant les paramètres
                    $requeteUpdateRole->execute([
                    "name_role" => $name_role,
                    "id" => $id
                ]);
                header("Location: index.php?action=listRoles");
            }
        }
        require "view/role/updateRole.php" ;
    }
}
