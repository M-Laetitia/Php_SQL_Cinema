<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="./public/css/style.css">


    <title><?= $titre ?></title>
</head>
<body>

    <header>
        <div class="logo"><img src="./public/Images/logo2.png" alt="logo CineVault"></div>
        <nav>
            <div class="primary-navigation">
                <ul>
                    <li><a href="index.php?action=listFilms"> Movie</a></li>
                    <li><a href="index.php?action=listActeurs"> Actor</a></li>
                    <li><a href="index.php?action=listRealisateurs"> Director</a></li>
                    <li><a href="index.php?action=listGenres"> Genre</a></li>
                    <li><a href="index.php?action=listRoles"> Role</a></li>
                </ul>
            </div>
            <div class="nav-search">
                <p>Search</p>
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </nav>
    </header>



    <!-- <header>
        <nav>
            <ul>
                <li>
                    <select onchange="location = this.value;">
                        <option>--ADD INFOS</option>
                        <option value="index.php?action=getAjouterFilm">ADD MOVIES</option>
                        <option value="index.php?action=getAjouterGenre">ADD GENRES</option>
                        <option value="index.php?action=getAjouterRole">ADD ROLES</option>
                        <option value="index.php?action=getAjouterActeur">ADD ACTORS</option>
                        <option value="index.php?action=getAjouterRealisateur">ADD DIRECTORS</option>
                        <option value="index.php?action=getAjouterCasting">ADD CASTING</option>
                    </select>
                </li>
                
            </ul>
        </nav>
    </header> -->

    <footer>
        <div>
            <p><span id="date"></span></p>
        </div>
    </footer>


    <main>
        <?= $contenu ?> 
    </main>


    
</body>

</html>



