<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title><?= $titre ?></title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php?action=listFilms"> Movie</a></li>
                <li><a href="index.php?action=listActeurs"> Actor</a></li>
                <li><a href="index.php?action=listRealisateurs"> Director</a></li>
                <li><a href="index.php?action=listGenres"> Genre</a></li>
                <li><a href="index.php?action=listRoles"> Role</a></li>
                <li>
                    <select onchange="location = this.value;">
                        <option>--ADD INFOS</option>
                        <option value="index.php?action=getAjouterFilm">ADD MOVIES</option>
                        <option value="index.php?action=getAjouterGenre">ADD GENRES</option>
                        <option value="index.php?action=getAjouterRole">ADD ROLES</option>
                        <option value="index.php?action=getAjouterActeur">ADD ACTORS</option>
                        <option value="index.php?action=getAjouterRealisateur">ADD DIRECTORS</option>
                        <option value="index.php?action=getAddCasting">ADD CASTING</option>
                    </select>
                </li>
                
            </ul>
        </nav>
    </header>
    <main>
        <h1>PDO Cinema</h1>
        <h2> <?= $titre_secondaire ?></h2>
        <?= $contenu ?>
    </main>
    
</body>
</html>



