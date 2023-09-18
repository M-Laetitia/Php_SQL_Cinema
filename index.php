<?php
// localhost/molin/Php_SQL_Cinema/index.php?action=listFilms
//localhost/molin/Php_SQL_Cinema/index.php?action=listActeurs


// On "use" le controller Cinema
use Controller\MovieController;
use Controller\ActorController;
use Controller\DirectorController;
use Controller\GenreController; 


// On autocharge les classes du projet
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

// On instancie le controller Cinema
$ctrlMovie = new MovieController();
$ctrlActor = new ActorController();
$ctrlDirector = new DirectorController();
$ctrlGenre = new GenreController();

// En fonction de l'action détectée dans l'URL via la propriété "action" on interagit avec
// la bonne méthode du controller

$id=(isset($_GET["id"])) ? $_GET["id"] : null;
// $type = (isset($_GET["type])) ? $_GET["type"] : null;

if(isset($_GET["action"])) {
    switch ($_GET["action"]) {

        // MOVIE
        case "listFilms" : $ctrlMovie->listFilms(); break;
        // case "detailFilm" : $ctrlMovie->detailFilm($id); break;

        // ACTOR
        case "listActeurs" : $ctrlActor->listActeurs(); break;

        // DIRECTOR
        case "listRealisateurs" : $ctrlDirector->listRealisateurs(); break;

        // GENRE
        case "listGenres" : $ctrlGenre->listGenres(); break;
        
    }
    
}

?>


<!-- 
Piste dans "index.php" pour afficher le détail d'un film par exemple, c'est encore une fois
l'URL qui fera passer un "id" en paramètre -->