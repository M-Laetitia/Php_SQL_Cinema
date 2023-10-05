<?php ob_start(); ?>


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

    <!-- Google icon -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    
    <link rel="stylesheet" href="public/css/style-home.css">
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="stylesheet" href="./public/css/style-form.css">
    <link rel="stylesheet" href="./public/css/style-listing.css">
    <link rel="stylesheet" href="./public/css/style-detail.css">
    <link rel="stylesheet" href="./public/css/style-results.css">
    <link rel="stylesheet" href="./public/css/style-user.css">
    <link rel="stylesheet" href="./public/css/style-home.css">



    <title>Home</title>


</head>

<body>

<main class="homepage">
    <div class="top">
        <!-- <img src="public/Images/background_home.jpg" alt="vintage Cinematographer’s room"> -->

        <div class="message">
            <h1>Welcome to CineVault</h1>
            <h2>Your Personal Movie Journey</h2>
            <p>Explore the fascinating world of cinema with CineVault, your one-stop destination for all things movies. Whether you're a film enthusiast, a casual viewer, or just looking for a great movie night, CineVault has got you covered.</p>
        </div>

        
        <div class="icon">

            <div class="list-el" id="list-left" style="visibility:hidden">
                <a href="index.php?action=listFilms"><p>Movies</p></a>
                <a href="index.php?action=listActeurs"><p>Actors</p></a>
                <a href="index.php?action=listRealisateurs"><p>Directors</p></a>
            </div>

            <div class="container">
                <p class="text" id="discover">Discover</p>
                <div id="icon-discover"> </div>
            </div>
            
            <div class="container">
                <p class="text" id="contribute">Contribute</p>
                <div id="icon-contribute"></div>
            </div>

            <div class="list-el" id="list-right" style="visibility:hidden">
                <a href="index.php?action=getAjouterFilm"><p>Movies</p></a>
                <a href="index.php?action=getAjouterActeur"><p>Actors</p></a>
                <a href="index.php?action=getAjouterRealisateur"><p>Directors</p></a>
            </div>
            

        </div>
        
    </div>
    <div class="bottom">
        <div class="part">
            <div class="square"></div>
        </div>
        
        <div class="posters">
            <div class="poster">

                <?php
                $directory = 'public/Images/posters/';
                $images = scandir($directory);
                shuffle($images);
                foreach ($images as $image) {
                    if ($image != "." && $image != "..") {
                    echo '<img src="' . $directory . $image . '" alt="Affiche de film">';
                    }
                }
                ?>

            </div>
        </div>
    </div>
    
</main>

<script>

    const iconDiscover = document.getElementById('icon-discover');
    const iconContribute = document.getElementById('icon-contribute');
    const list_left = document.getElementById('list-left');
    const list_right = document.getElementById('list-right');
    const contribute = document.getElementById('contribute')
    const discover = document.getElementById('discover')

    iconDiscover.addEventListener('click', () => {
        list_left.style.visibility = 'visible'; 
        list_right.style.visibility = 'hidden';
        discover.style.color = 'var(--clr-pink)'; 
        contribute.style.color = 'var(--clr-white)';


        iconContribute.classList.remove('active');
        iconDiscover.classList.remove('inactive');
        iconDiscover.classList.add('active');
        
    });

    iconContribute.addEventListener('click', () => {
        list_right.style.visibility = 'visible'; 
        list_left.style.visibility = 'hidden'; 
        contribute.style.color = 'var(--clr-pink)';
        discover.style.color = 'var(--clr-white'; 

        iconDiscover.classList.remove('active');
        iconContribute.classList.remove('inactive');
        iconContribute.classList.add('active');
    });

</script>

</body>

</html>

<?php
$titre = "Home";
// $contenu = ob_get_clean();
// require "view/template.php";
?>

