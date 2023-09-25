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
    <link rel="stylesheet" href="./public/css/style-form.css">
    <link rel="stylesheet" href="./public/css/style-listing.css">
    <link rel="stylesheet" href="./public/css/style-detail.css">


    <title><?= $titre ?></title>
</head>

<body id="movie_background">

    <header>
        <a href="index.php?action=landingPage">
            <div class="logo">
                <img src="./public/Images/logo.png" alt="logo CineVault">
            </div>
        </a>
        
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

            <div class="dropdown">
                <div class="dropdown">
                    <span>Contribute <i class="fa-solid fa-angle-down" style="color: #e03058;"></i></span>
                    <div class="dropdown-content">
                        <p><a href="index.php?action=getAjouterFilm">Add Movie</a></p>
                        <p><a href="index.php?action=getAjouterActeur">Add Actor</a></p>
                        <p><a href="index.php?action=getAjouterRealisateur">Add Director</a></p>
                        <p><a href="index.php?action=getAjouterGenre">Add Genre</a></p>
                        <p><a href="index.php?action=getAjouterRole">Add Role</a></p>
                        <p><a href="index.php?action=getAjouterCasting">Add Casting</a></p>
                    </div>
                </div>
            </div>
           
            <div class="menu-burger">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>

            <div class="nav-search">
                <p>Search</p>
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>

            
            <form enctype="multipart/form-data" method="POST" action="index.php?action=search">
                <input type="text" name="search" placeholder="Rechercher...">
                <button type="submit" name="submit-search">Rechercher</button>
            </form>


        </nav>

    </header>


    <div class="userConn">
        <p><a href="index.php?action=register">S'inscrire</a></p>
        <p><a href="index.php?action=login">Se connecter</a></p>
    </div>

    <main>
        
        <?= $contenu ?> 
    </main>


    <!-- <footer>
        <div>
            <p>&copy;<script>document.write(new Date().getFullYear());</script> <span class="text-highlight">Cine</span>Vault</p>
        </div>
    </footer> -->

    <script src="./public/js/script.js"></script>

</body>

</html>
