<?php
// localhost/molin/Php_SQL_Cinema/index.php?action=listFilms

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

        // ^ USER 
        case "register" : $ctrlUser->register(); break;
        case "login" : $ctrlUser->login(); break;
        case "logout" : $ctrlUser->logout(); break;
        case "profile" : $ctrlUser->profile(); break;
        case "deleteAccount": $ctrlUser->deleteAccount(); break;
        case "themePreference" : $ctrlUser->themePreference(); break;
        case "listeFilmNote" : $ctrlUser->listeFilmNote(); break;
        case "editerReviewUser" : $ctrlUser->editerReviewUser($id); break;
        //ajax
        case "addLike" : $ctrlUser->addLike(); break;
        case "addDislike" : $ctrlUser->addDislike(); break;
        case "checkRegister" : $ctrlUser->checkRegister(); break;
        case "checkLikedReviews" : $ctrlUser->checkLikedReviews(); break;
        
        // ^ MODO
        case "editerReview" : $ctrlUser->editerReview($id); break;
        case "supprimerReview" : $ctrlUser->supprimerReview($id); break;
        
        // ^SEARCH
        case "search" : $ctrlSearch->search(); break;

        // ^MOVIE
        case "listFilms" : $ctrlMovie->listFilms(); break;
        case "detailFilm" : $ctrlMovie->detailFilm($id); break;
        case "ajouterFilm" : $ctrlMovie->ajouterFilm(); break;
        case "supprimerFilm" : $ctrlMovie->supprimerFilm($id); break;
        case "getAjouterFilm" : $ctrlMovie->getAjouterFilm($id); break;
        case "ajouterCasting" : $ctrlMovie->ajouterCasting(); break; 
        case "getAjouterCasting" : $ctrlMovie->getAjouterCasting(); break; 
        case "updateFilm" : $ctrlMovie->updateFilm($id); break;
        case "addRating" : $ctrlMovie->addRating($id); break;
        case "landingPage" : $ctrlMovie->landingPage(); break;
        // case "listReview" : $ctrlMovie->listReview($id); break;
        //ajax
        case "checkMovie" : $ctrlMovie->checkMovie(); break;
        case "getReviewLikesDislikesCount" : $ctrlMovie->getReviewLikesDislikesCount(); break;
        case "afficherCritiquesFilm" : $ctrlMovie->afficherCritiquesFilm($id); break;
        case "ajouterReview" : $ctrlMovie->ajouterReview($id); break;
        case "addRating" : $ctrlMovie->addRating($id); break;
        case "getNumberRating" : $ctrlMovie->getNumberRating($id); break;
        case "getAverageRating" : $ctrlMovie->getAverageRating($id); break;

        // ^ ACTOR
        case "listActeurs" : $ctrlActor->listActeurs(); break;
        case "detailActeur" : $ctrlActor->detailActeur($id); break;
        case "ajouterActeur" : $ctrlActor->ajouterActeur(); break;
        case "supprimerActeur" : $ctrlActor->supprimerActeur($id); break;
        case "getAjouterActeur" : $ctrlActor->getAjouterActeur(); break;
        case "updateActeur" : $ctrlActor->updateActeur($id); break; 
        //ajax
        case "checkActor" : $ctrlActor->checkActor(); break; 

        // ^ DIRECTOR
        case "listRealisateurs" : $ctrlDirector->listRealisateurs(); break;
        case "detailRealisateur" : $ctrlDirector->detailRealisateur($id); break;
        case "ajouterRealisateur" : $ctrlDirector->ajouterRealisateur(); break;
        case "supprimerRealisateur" : $ctrlDirector->supprimerRealisateur($id); break;
        case "getAjouterRealisateur" : $ctrlDirector->getAjouterRealisateur(); break;
        case "updateRealisateur" : $ctrlDirector->updateRealisateur($id); break; 

        // ^ GENRE
        case "listGenres" : $ctrlGenre->listGenres(); break;
        case "detailGenre" : $ctrlGenre->detailGenre($id); break;
        case "ajouterGenre" : $ctrlGenre->ajouterGenre(); break;
        case "supprimerGenre" : $ctrlGenre->supprimerGenre($id); break;
        case "getAjouterGenre" : $ctrlGenre->getAjouterGenre(); break;
        case "updateGenre" : $ctrlGenre->updateGenre(); break;
        //ajax
        case "checkGenre" : $ctrlGenre->checkGenre(); break;

        // ^ ROLE
        case "listRoles" : $ctrlRole->listRoles(); break;
        case "detailRole" : $ctrlRole->detailRole($id); break;
        case "ajouterRole" : $ctrlRole->ajouterRole(); break;
        case "supprimerRole" : $ctrlRole->supprimerRole($id); break;
        case "getAjouterRole" : $ctrlRole->getAjouterRole(); break;
        case "updateRole" : $ctrlRole->updateRole($id); break;
        //ajax
        case "checkRole" : $ctrlRole->checkRole(); break;
    }
}
?>