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


// En fonction de l'action détectée dans l'URL via la propriété "action" on interagit avec
// la bonne méthode du controller

$id=(isset($_GET["id"])) ? $_GET["id"] : null;
// $type = (isset($_GET["type])) ? $_GET["type"] : null;

if(isset($_GET["action"])) {
    switch ($_GET["action"]) {

        // MOVIE
        case "listFilms" : $ctrlMovie->listFilms(); break;
        case "detailFilm" : $ctrlMovie->detailFilm($id); break;
        case "ajouterFilm" : $ctrlMovie->ajouterFilm(); break;
        case "supprimerFilm" : $ctrlMovie->supprimerFilm($id); break;
        case "getAjouterFilm" : $ctrlMovie->getAjouterFilm($id); break;
        case "ajouterCasting" : $ctrlMovie->ajouterCasting(); break; 
        case "getAjouterCasting" : $ctrlMovie->getAjouterCasting(); break; 
        

        //modifier film
  

        // ACTOR
        case "listActeurs" : $ctrlActor->listActeurs(); break;
        case "detailActeur" : $ctrlActor->detailActeur($id); break;
        case "ajouterActeur" : $ctrlActor->ajouterActeur(); break;
        case "supprimerActeur" : $ctrlActor->supprimerActeur($id); break;
        case "getAjouterActeur" : $ctrlActor->getAjouterActeur(); break;

        //modifier acteur


        // DIRECTOR
        case "listRealisateurs" : $ctrlDirector->listRealisateurs(); break;
        case "detailRealisateur" : $ctrlDirector->detailRealisateur($id); break;
        case "ajouterRealisateur" : $ctrlDirector->ajouterRealisateur(); break;
        case "supprimerRealisateur" : $ctrlDirector->supprimerRealisateur($id); break;
        case "getAjouterRealisateur" : $ctrlDirector->getAjouterRealisateur(); break;

        //modifier réalisateur
     

        // GENRE
        case "listGenres" : $ctrlGenre->listGenres(); break;
        case "detailGenre" : $ctrlGenre->detailGenre($id); break;
        case "ajouterGenre" : $ctrlGenre->ajouterGenre(); break;
        case "supprimerGenre" : $ctrlGenre->supprimerGenre($id); break;
        case "getAjouterGenre" : $ctrlGenre->getAjouterGenre(); break;

        //modifier genre


        // ROLE
        case "listRoles" : $ctrlRole->listRoles(); break;
        case "detailRole" : $ctrlRole->detailRole($id); break;
        case "ajouterRole" : $ctrlRole->ajouterRole(); break;
        case "supprimerRole" : $ctrlRole->supprimerRole($id); break;
        case "getAjouterRole" : $ctrlRole->getAjouterRole(); break;


        //modifier role
        
        
    }
    
}

?>


<!-- 
Piste dans "index.php" pour afficher le détail d'un film par exemple, c'est encore une fois
l'URL qui fera passer un "id" en paramètre -->