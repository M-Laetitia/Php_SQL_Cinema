<?php
// localhost/molin/Php_SQL_Cinema/index.php?action=listFilms
//localhost/molin/Php_SQL_Cinema/index.php?action=listActeurs
//localhost/Laetitia/Nouveau%20dossier/Php_SQL_Cinema/index.php?action=detailActeur&id=1
//localhost/Laetitia/Nouveau%20dossier/Php_SQL_Cinema/index.php?action=detailRole&id=2

// On "use" le controller Cinema
use Controller\MovieController;
use Controller\ActorController;
use Controller\DirectorController;
use Controller\GenreController; 
use Controller\RoleController; 
use Controller\SearchController;
use Controller\UserController;


// On autocharge les classes du projet
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

// On instancie le controller Cinema
$ctrlMovie = new MovieController();
$ctrlActor = new ActorController();
$ctrlDirector = new DirectorController();
$ctrlGenre = new GenreController();
$ctrlRole = new RoleController();
$ctrlSearch = new SearchController();
$ctrlUser = new UserController();

// En fonction de l'action détectée dans l'URL via la propriété "action" on interagit avec
// la bonne méthode du controller

$id=(isset($_GET["id"])) ? $_GET["id"] : null;
// $type = (isset($_GET["type])) ? $_GET["type"] : null;

if(isset($_GET["action"])) {
    switch ($_GET["action"]) {

        // USER 


        // page pour être redirigé vers inscription ou connexion

        case "register" : $ctrlUser->register(); break;
        case "login" : $ctrlUser->login(); break;

        case "logout" : $ctrlUser->logout(); break;
        case "profile" : $ctrlUser->profile(); break;
        case "deleteAccount": $ctrlUser->deleteAccount(); break;


        // SEARCH
        case "search" : $ctrlSearch->search(); break;

        // MOVIE
        case "listFilms" : $ctrlMovie->listFilms(); break;
        case "detailFilm" : $ctrlMovie->detailFilm($id); break;
        case "ajouterFilm" : $ctrlMovie->ajouterFilm(); break;
        case "supprimerFilm" : $ctrlMovie->supprimerFilm($id); break;
        case "getAjouterFilm" : $ctrlMovie->getAjouterFilm($id); break;
        case "ajouterCasting" : $ctrlMovie->ajouterCasting(); break; 
        case "getAjouterCasting" : $ctrlMovie->getAjouterCasting(); break; 
        case "updateFilm" : $ctrlMovie->updateFilm($id); break;

        case "landingPage" : $ctrlMovie->landingPage(); break;
        // case "searching" : $ctrlMovie->searching(); break;
        
 
        // ACTOR
        case "listActeurs" : $ctrlActor->listActeurs(); break;
        case "detailActeur" : $ctrlActor->detailActeur($id); break;
        case "ajouterActeur" : $ctrlActor->ajouterActeur(); break;
        case "supprimerActeur" : $ctrlActor->supprimerActeur($id); break;
        case "getAjouterActeur" : $ctrlActor->getAjouterActeur(); break;
        case "updateActeur" : $ctrlActor->updateActeur($id); break; 

        // DIRECTOR
        case "listRealisateurs" : $ctrlDirector->listRealisateurs(); break;
        case "detailRealisateur" : $ctrlDirector->detailRealisateur($id); break;
        case "ajouterRealisateur" : $ctrlDirector->ajouterRealisateur(); break;
        case "supprimerRealisateur" : $ctrlDirector->supprimerRealisateur($id); break;
        case "getAjouterRealisateur" : $ctrlDirector->getAjouterRealisateur(); break;
        case "updateRealisateur" : $ctrlDirector->updateRealisateur($id); break; 

        // GENRE
        case "listGenres" : $ctrlGenre->listGenres(); break;
        case "detailGenre" : $ctrlGenre->detailGenre($id); break;
        case "ajouterGenre" : $ctrlGenre->ajouterGenre(); break;
        case "supprimerGenre" : $ctrlGenre->supprimerGenre($id); break;
        case "getAjouterGenre" : $ctrlGenre->getAjouterGenre(); break;
        case "updateGenre" : $ctrlGenre->updateGenre($id); break;

        // ROLE
        case "listRoles" : $ctrlRole->listRoles(); break;
        case "detailRole" : $ctrlRole->detailRole($id); break;
        case "ajouterRole" : $ctrlRole->ajouterRole(); break;
        case "supprimerRole" : $ctrlRole->supprimerRole($id); break;
        case "getAjouterRole" : $ctrlRole->getAjouterRole(); break;
        case "updateRole" : $ctrlRole->updateRole($id); break;
    }
}
?>