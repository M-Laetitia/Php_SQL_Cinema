<?php

// On aura toujours un namespace permettant de catégoriser virtuellement (dans un espace
// de nom la classe en question). Ainsi on pourra "use" la classe sans connaître son
// emplacement physique. On a juste besoin de savoir dans quel namespace elle se trouve

// Dans le fichier "Connect.php" on se contente de déclarer la connexion à la base de données

namespace Model;

// La classe est abstraite car on n'instanciera jamais la classe Connect puisqu'on aura
// seulement besoin d'accéder à la méthode "seConnecter"
abstract class Connect { 

    const HOST = "localHost";
    const DB = "cinema_2";
    const USER = "root";
    const PASS = "sakura2410)BC";


// On remarquera au passage le namespace de la classe Connect --> "Model", ainsi que la
// présence d'un "\" devant PDO indiquant au framework que PDO est une classe native et
// non une classe du projet

    public static function seConnecter() {
        try {
            return new \PDO (
                "mysql:host=" .self::HOST.";dbname=" .self::DB.";charset=utf8", self::USER, self::PASS);
            } catch(\PDOException $ex) {
                return $ex->getMessage();
            }
        }
    }


?>
