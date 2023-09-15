<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP- SQL - Gaulois</title>
</head>
<body>

<style>
    td, th {
    border: 1px solid black;
    padding: 15px;
}

table {
    border-collapse: collapse;
    margin: auto;
}

</style>

<h1>PHP - SQL  - Cinema</h1>
    
<?php

    try {
        $mysqldb = new PDO('mysql:host=localhost;dbname=cinema_2;charset=utf8',
        'root'
        );
    }
    catch (Exception $e)
    {
        // en cas d'erreur, on affiche un message et on arrête tout
        die('Erreur :' . $e->getMessage());
    }

    // ^ Récupérer information d'un film

    //DATE_FORMAT(movie.movie_duration, '%H:%i') AS formatted_duration
    
    $sqlQuery = 'SELECT movie.movie_title, movie.movie_release_date, DATE_FORMAT(movie.movie_duration, "%H:%i") AS formatted_duration, person.person_first_name , person.person_last_name
                FROM movie
                INNER JOIN director ON movie.id_director = director.id_director
                INNER JOIN person ON person.id_person = director.id_person
                WHERE movie.id_movie = 13';

    $infoMovieStatement = $mysqldb->prepare($sqlQuery);
    $infoMovieStatement->execute();

    $infoMovie = $infoMovieStatement->fetch();
    // var_dump($infoMovie);

    
    //The gmdate() function formats a GMT/UTC date and time, and returns the formatted date string.
    //  La fonction strtotime en PHP est utilisée pour analyser une chaîne de date/heure et la convertir en un timestamp UNIX (un nombre entier représentant le nombre de secondes écoulées depuis le 1er janvier 1970 à 00:00:00 UTC).
    // La fonction gmdate en PHP est utilisée pour formater un timestamp en une chaîne de caractères dans un format spécifique. Ici utilisation de gmdate pour formater le timestamp obtenu à partir de strtotime au format "H:i".

    // $duration = $infoMovie['movie_duration'];
     // $formattedDuration = gmdate("H:i", strtotime($duration));

    echo "<p> Title: " . $infoMovie['movie_title']  . "</p>" ;
    echo "<p>Date de sortie : " . $infoMovie['movie_release_date'] . "</p>";
    echo "<p>Duration : " .  $infoMovie['formatted_duration'] . "</p>";
    echo "<p>Director: " . $infoMovie['person_first_name'] . " " . $infoMovie['person_last_name'] . "</p>";

    echo "<hr>";


    // ^ Liste des films dont la durée excède 2h15 classés par durée ( du + long au + court )

    $sqlQuery = 'SELECT movie.movie_title, TIME_TO_SEC(movie.movie_duration)/60 as formatted_duration, DATE_FORMAT(movie.movie_duration, "%H:%i") AS duration
            FROM movie
            HAVING formatted_duration > 135';
            

    $infoTimeStatement = $mysqldb->prepare($sqlQuery);
    $infoTimeStatement->execute();

    $infoTime = $infoTimeStatement->fetchAll();

    foreach($infoTime as $movie) {
        echo  "<p>Movie : " . $movie['movie_title'] . " -Duration : " . $movie['duration'] . "</p>";
    }

    echo "<hr>";

    

    // ^ Liste des films d’un réalisateur (en précisant l’année de sortie)
    $sqlQuery = 'SELECT movie.movie_title, movie.movie_release_date
                FROM movie
                INNER JOIN director ON director.id_director = movie.id_director
                INNER JOIN person ON person.id_person = director.id_person
                WHERE person.person_first_name = "Christopher" AND person.person_last_name = "Nolan"
                ORDER BY movie.movie_release_date DESC';

    $directorStatement = $mysqldb->prepare($sqlQuery);
    $directorStatement->execute();

    $directorMovie = $directorStatement->fetchAll();

    foreach($directorMovie as $directorMovie ) {
        echo "<p>  Movie : " . $directorMovie['movie_title'] . " - Release Date : " . $directorMovie['movie_release_date'] . "<p>" ; 
    }

    echo "<hr>";

    // ^ Nombre de films par genre (classés dans l’ordre décroissant)

    $sqlQuery = 'SELECT genre.label_genre, COUNT(categorise.id_movie) AS nb_movies
                FROM categorise
                INNER JOIN genre ON genre.id_genre = categorise.id_genre
                GROUP BY genre.label_genre
                ORDER BY nb_movies DESC ';

        $genreStatement = $mysqldb->prepare($sqlQuery);
        $genreStatement->execute();

        $genreMovie = $genreStatement->fetchAll();

        foreach($genreMovie as $genreMovie ) {
            echo "<p>  Genre : " . $genreMovie['label_genre'] . " : " . $genreMovie['nb_movies'] . " movie/s<p>" ; 
        }

        echo "<hr>";
    
         // ^ Nombre de films par réalisateur (classés dans l’ordre décroissant)
         $sqlQuery = 'SELECT person.person_first_name, person.person_last_name,  COUNT(movie.id_director) AS nb_movies
                    FROM movie
                    INNER JOIN director ON director.id_director = movie.id_director
                    INNER JOIN person ON person.id_person = director.id_person
                    GROUP BY director.id_director
                    ORDER BY nb_movies DESC ';

        $directorStatement = $mysqldb->prepare($sqlQuery);
        $directorStatement->execute();

        $directorMovie = $directorStatement->fetchAll();

        foreach($directorMovie as $directorMovie ) {
            echo "<p>  Director : " . $directorMovie['person_first_name'] . " " . $directorMovie['person_last_name']  .  " : " . $directorMovie['nb_movies'] . " movie/s<p>" ; 
        }

        echo "<hr>";

        // ^ Casting d’un film en particulier (id_film) : nom, prénom des acteurs + sexe
        $sqlQuery = 'SELECT person.person_first_name, person.person_last_name, person.person_sexe, movie.movie_title, role.name_role
                    FROM play
                    INNER JOIN actor ON play.id_actor = actor.id_actor
                    INNER JOIN person ON actor.id_person = person.id_person
                    INNER JOIN movie ON movie.id_movie = play.id_movie
                    INNER JOIN role ON role.id_role = play.id_role
                    WHERE movie.id_movie = 13';

        $castingStatement = $mysqldb->prepare($sqlQuery);
        $castingStatement->execute();

        $castingMovie = $castingStatement->fetchAll();

        echo "  Movie: " . $castingMovie[0]['movie_title'] . " : <br> ";

        foreach($castingMovie as $castingMovie) {
            echo "<p>" . $castingMovie['person_first_name']  . " " .  $castingMovie['person_last_name'] . "(" . $castingMovie['person_sexe'] . ") as " . $castingMovie['name_role'] . "</p>" ; 
        }
     

        echo "<hr>";
        // ^ Films tournés par un acteur en particulier (id_acteur) avec leur rôle et l’année de sortie (du film le plus récent au plus ancien)


        $sqlQuery = 'SELECT person.person_first_name, person.person_last_name, role.name_role, movie.movie_release_date, movie.movie_title
                    FROM play
                    INNER JOIN movie ON play.id_movie = movie.id_movie
                    INNER JOIN actor ON play.id_actor = actor.id_actor
                    INNER JOIN person ON person.id_person = actor.id_person
                    INNER JOIN role ON play.id_role = role.id_role
                    WHERE play.id_actor = 1
                    ORDER BY movie.movie_release_date DESC';

        $roleStatement = $mysqldb->prepare($sqlQuery);
        $roleStatement->execute();

        $roleActor = $roleStatement->fetchAll();

        echo "  Actor: " . $roleActor[0]['person_first_name'] . " " . $roleActor[0]['person_last_name'] . "<br> ";

        foreach($roleActor as $roleActor) {
            echo "<p> Role : " .  $roleActor['name_role'] . " - " . $roleActor['movie_title'] . " (" . $roleActor['movie_release_date'] .  ") </p>" ; 
        }



        echo "<hr>";
        // ^ . Liste des personnes qui sont à la fois acteurs et réalisateurs

        $sqlQuery = 'SELECT DISTINCT person.person_first_name , person.person_last_name
                    FROM person
                    INNER JOIN actor ON person.id_person = actor.id_person
                    INNER JOIN director ON person.id_person = director.id_person';

        $actorDirectorStatement = $mysqldb->prepare($sqlQuery);
        $actorDirectorStatement->execute();

        $actorDirector = $actorDirectorStatement->fetchAll();

        echo " Person/s who is/are a director and an actor : ";

        foreach($actorDirector as $actorDirector) {
        echo "<p>" .  $actorDirector['person_first_name'] . " - " . $actorDirector['person_last_name'] ; 
        }

        echo "<hr>";
        // ^ Liste des films qui ont moins de 5 ans (classés du plus récent au plus ancien)

        $sqlQuery = 'SELECT DISTINCT movie.movie_title, movie.movie_release_date
                    FROM movie
                    WHERE movie.movie_release_date >=  DATE_SUB(CURDATE(), INTERVAL 5 YEAR)
                    ORDER BY movie.movie_release_date DESC';

        // SELECT CURRENT_DATE(); SELECT CURDATE();  Return the current DATE:

        // The DATE_SUB() function subtracts a time/date interval from a date and then returns the date.
        // SELECT DATE_SUB("2017-06-15", INTERVAL 10 DAY); : Subtract 10 days from a date and return the date:


        $timeMovieStatement = $mysqldb->prepare($sqlQuery);
        $timeMovieStatement->execute();

        $timeMovie = $timeMovieStatement->fetchAll();

        echo " List of movies less than 5 years old : ";

        foreach($timeMovie as $timeMovie) {
        echo "<p>" .  $timeMovie['movie_title'] . " - " . $timeMovie['movie_release_date'] ; 
        }

        echo "<hr>";
        // ^ Nombre d’hommes et de femmes parmi les acteurs

        $sqlQuery = 'SELECT person.person_sexe, COUNT(*) as actorGenderNb
                    FROM person
                    INNER JOIN actor ON person.id_person = actor.id_person
                    WHERE NOT actor.id_actor IS NULL
                    GROUP BY person.person_sexe';


        
        $actorGenderStatement = $mysqldb->prepare($sqlQuery);
        $actorGenderStatement->execute();

        $actorGender = $actorGenderStatement->fetchAll();

        echo " Number of actor/s and actress/es classed by their gender" ;
        foreach($actorGender as $actorGender) {
        echo "<p>" .  $actorGender['person_sexe'] . " : " . $actorGender['actorGenderNb'] ; 
        }
        


        echo "<hr>";
        // ^ Liste des acteurs ayant plus de 50 ans (âge révolu et non révolu)
        $sqlQuery = 'SELECT person.person_first_name, person.person_last_name, DATE_FORMAT(person.person_birthday, "%Y") AS dateBirthday , (DATE_FORMAT(CURDATE(), "%Y") - DATE_FORMAT(person.person_birthday, "%Y")) AS ActorAge
                    FROM person
                    HAVING (DATE_FORMAT(CURDATE(), "%Y") - dateBirthday) > 50';



        $actorAgeStatement = $mysqldb->prepare($sqlQuery);
        $actorAgeStatement->execute();

        $actorAge = $actorAgeStatement->fetchAll();

        echo " Actors age > 50 years old" ;
        foreach($actorAge as $actorAge) {
        echo "<p>" .  $actorAge['person_first_name'] . "  " . $actorAge['person_last_name'] . " - " . $actorAge['ActorAge'] . " years old"; 
        }

        
        echo "<hr>";
        // ^ l. Acteurs ayant joué dans 3 films ou plus


        $sqlQuery = 'SELECT person.person_first_name, person.person_last_name, COUNT(play.id_movie) AS movieCount
                    FROM person
                    INNER JOIN actor ON actor.id_person = person.id_person
                    INNER JOIN play ON actor.id_actor = play.id_actor
                    GROUP BY person.id_person
                    HAVING movieCount >= 3';


        
        $movieCountStatement = $mysqldb->prepare($sqlQuery);
        $movieCountStatement->execute();

        $movieCount = $movieCountStatement->fetchAll();

        echo "Actor who played in 3 movies or more";

        foreach($movieCount as $movieCount) {
        echo "<p>" .  $movieCount['person_first_name'] . "  " . $movieCount['person_last_name'] ; 
        }
        
        

?>



</body>
</html>