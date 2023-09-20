<!-- // variable qu'on récupère quand notre formulaire est envoyé
// var_dump($_POST);
// var_dump($_FILES);
//pour récupérer les paramètres qu'on passe dans l'url
// $_GET
// $_GET https:://monsite.fr?parametre=test
// $_GET['paramatre']
// >on obtient test -->


<?php
    var_dump($_POST);
    var_dump($_FILES);


    if(isset($_FILES['file'])) {
        //récupérer données de l'image
        $tmpName = $_FILES['file']['tmp_name'];
        $name = $_FILES['file']['name'];
        $size = $_FILES['file']['size'];
        $error = $_FILES['file']['error'];
        $type = $_FILES['file']['type'];

        //verif si c'est bien une image qui a été upload en checkant l'extension avec la fonction explode, découper une chaîne de caractère en fonction d'un délimitaire
        //image.jpg > découper la chaîne de caractère à chaque point
        // on obtient un tableau avec ['salon', 'jpg']
        $tabExtension = explode('.', $name);

        // var_dump($tabExtension);
        // end permet d'obtenir le dernier élèment du tableau et pour permettre la comparaison, le mettre en minuscule. Dans ce cas on récupère que le jpg.
        $extension = strtolower(end($tabExtension));

        // var_dump($extension);

        //tableau  des extensions que l'on veut autoriser
        $extensionsAutorisees = ['jpg', 'jpeg', 'png', 'WebP' ]
        $tailleMax = 400000; 

        //ajouter notre condition, premier paramètre de ce que l'on veut rechercher dans le tableau (ici l'extension) et en second paramètre le tabeau des extensions autorisées
        // aller plus loin dans la vérif et vérifier la taille du fichier
        //dernière vérif, voir s'il n'y a  pas d'erreur sur le fichier
        if(in_array($extension,$extensionsAutorisees)) && $size <= $tailleMax $$ $error == 0  {

            //changer le nom de notre image par un nom unique avec la function unidid, premier paramètre si on veut rajouter un préfixe, deuxième paramètre : booléan, si on veut générer un nom encore plus long pour plus de sécurité
            $uniqueName = uniqid('', true);

            // var_dump($uniqueName);

            // le concaténer avec l'extension
            $fileName = $uniqueName. '.' .$extension;
            
            var_dump($fileName);

            //en premier paramètre le chemin du fichier où il se trouve acutellement donc tmpName et en second là où on veut l'uploader + le $name
            // move_uploaded_file($tmpName, './upload/'.$name);
            // ajouter le fichier avec l'unique name dans le dossier
            move_uploaded_file($tmpName, './upload/'.$fileName);

            //comment enregistrer les infos en base de données pour pouvoir  afficher les images par la suite
            // autant de (?) qu'il y a d'élèments dans le tableau qu'on lui passe dans l'execute
            $req = $db->prepare('INSERT INTO file(name) VALUES (?)');
            $req->execute([$fileName]);

            echo 'Image enregistrée'

        } else {
            echo 'Mauvaise extension ou taille trop importante ou erreur'
        }

 
    }
    
    ?>

    <!-- Dans le html après le formulaire -->


    <form enctype="multipart/form-data" action="index.php?action=ajouterFilm" method="post">

            <!-- label est associé a un input ce qu'on met dans le for va correspondre au name du chemin input que l'on veut associé -->
            <label for="movie_image">image :</label>
            <input type="file"  name="movie_image" >
            <button type="submit"> Send</button>
    </form>

    <h2>Mes images</h2>

    <?php
        $req = $db->query('SELECT name from file');
        while($data = $req->fetch()) {
            var_dump($data);

            echo '<img src="./upload/'.$data['name'].'" width="200px">br>';
        }
    ?>



if(isset($_FILES["movie_image"])){  // name de l'input dans le formulaire de l'ajout du film

// voir upload-img_php pour détail du process
$tmpName = $_FILES["movie_image"]["tmp_name"];
$name = $_FILES["movie_image"]["name"];
$size = $_FILES["movie_image"]["size"];
$error = $_FILES["movie_image"]["error"];

$tabExtension = explode(".", $name); 
$extension = strtolower(end($tabExtension)); 
$extensionsAutorisees = ['jpg', 'jpeg', 'png', 'WebP' ]
$tailleMax = 5242880; // 5 Mo (en octets)
}

if(in_array($extension,$extensionsAutorisees)) && $size <= $tailleMax $$ $error == 0  {

$uniqueName = uniqid('', true);
$FileNameUnique = $uniqueName. '.' .$extension;
// var_dump($FileNameUnique);
move_uploaded_file($tmpName, './public/Images/upload'.$FileNameUnique);
$movieImageChemin = './public/Images/upload'.$FileNameUnique;

echo 'Image enregistrée'

} else {
/* Si pas de fichier car NULL autorisé dans la BDD pour les images */
$movieImageChemin = NULL;
}