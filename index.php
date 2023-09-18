<?php
// localhost/molin/Php_SQL_Cinema/index.php?action=listFilms
// On "use" le controller Cinema
use Controller\CinemaController;


// On autocharge les classes du projet
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

// On instancie le controller Cinema
$ctrlCinema = new CinemaController();

// En fonction de l'action détectée dans l'URL via la propriété "action" on interagit avec
// la bonne méthode du controller

$id=(isset($_GET["id"])) ? $_GET["id"] : null;
// $type = (isset($_GET["type])) ? $_GET["type"] : null;

if(isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case "listFilms" : $ctrlCinema->listFilms(); break;
        case "detailFilm" : $ctrlCinema->detailFilm($id); break;
    }
    
}

?>


<!-- 
Piste dans "index.php" pour afficher le détail d'un film par exemple, c'est encore une fois
l'URL qui fera passer un "id" en paramètre -->