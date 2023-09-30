
// displaying different content on the detail actor page.

document.addEventListener('DOMContentLoaded', function() {
    const filmographyButton = document.getElementById('filmo');
    const roleButton = document.getElementById('role');

    const listRoleDiv = document.querySelector('.list-role');
    const listFilmoDiv = document.querySelector('.list-filmo');

    filmographyButton.addEventListener('click', function() {
        // Affichez la filmographie et masquez le rôle
        listRoleDiv.style.display = 'none';
        listFilmoDiv.style.display = 'block';

        // Activez le bouton "filmographie" et désactivez le bouton "rôle"
        filmographyButton.classList.add('active');
        roleButton.classList.remove('active');
    });

    roleButton.addEventListener('click', function() {
        // Affichez le rôle et masquez la filmographie
        listRoleDiv.style.display = 'block';
        listFilmoDiv.style.display = 'none';

        roleButton.classList.add('active');
        filmographyButton.classList.remove('active');
    });
});



// &&Menu burger

const menuBurger = document.querySelector('.menu-burger');
console.log(menuBurger);
const nav = document.querySelector('.primary-navigation');

menuBurger.addEventListener('click', () => {
    console.log("click");
    menuBurger.classList.toggle("active");
    nav.classList.toggle('active');
});



//& dark/light mode
//& enable the switch between dark and light mode

// const toggleBtn = document.getElementById("light-mode-toggle")
// const darkScheme = window.matchMedia("(prefers-color-scheme: dark)")
// const lightScheme = window.matchMedia("(prefers-color-scheme: light)")

// operator ternaire
// let result = condition ? value1 : value 2
let root = document.documentElement, theme = window.getComputedStyle(root)
.getPropertyValue('--light') === ' ' ? 'dark' : 'light';



document.getElementById('checkbox')
  .addEventListener('click', toggleTheme);

function toggleTheme() {
  root.classList.remove(theme);
  theme = (theme === 'dark') ? 'light' : 'dark';
  root.classList.add(theme);
    if (theme === 'dark') {
        localStorage.setItem('theme', 'dark' )
    } else {
        localStorage.setItem('theme', 'light')
    }
  
}

// https://stackoverflow.com/questions/70845195/define-dark-mode-for-both-a-class-and-a-media-query-without-repeat-css-custom-p


//& storing  a user's preference

// Select the button
const toggleBtn = document.getElementById("toggle-btn")

// Select the theme preference from localStorage
const currentTheme = localStorage.getItem("theme")
console.log(currentTheme);

// function keepTheme () {
//     const theme = localStorage.getItem('theme')
//         console.log(theme)
// }


    if (currentTheme == "dark") {
        root.classList.remove(theme);
        root.classList.add("dark");
    } else {
        root.classList.remove(theme);
        root.classList.add("light");
    }

    

//& scroll to top Button

// Fonction pour faire défiler vers le haut

const scrollToTopButton = document.getElementById('scrollToTopButton');  

function scrollToTop() {
    window.scrollTo({
      top: 0,
      behavior: 'smooth' // Option pour un défilement fluide
    });
  }

  scrollToTopButton.addEventListener('click', scrollToTop);
  
  // Afficher ou masquer le bouton en fonction de la position de défilement - ici réglé à 50px.
  window.onscroll = function() {
    //document.body.scrollTop = fait référence à la position de défilement verticale de la partie <body> de la page.
    // document.documentElement.scrollTop =  fait référence à la position de défilement verticale de l'élément <html> de la page.
    // La différence entre document.body.scrollTop et document.documentElement.scrollTop réside dans la manière dont les navigateurs gèrent la position de défilement verticale sur différentes versions et configurations.

    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
      document.getElementById('scrollToTopButton').classList.add('show');
    } else {
      document.getElementById('scrollToTopButton').classList.remove('show');
    }
  };
  

  //& pop up pour rajouter note à un film 

//   const ratingBtn = document.getElementById('add-rating-button')
//   const popUpDiv= document.querySelector('.popUpRating');

//   ratingBtn.addEventListener('click', (e) => {
//     e.preventDefault();// Pour éviter que le lien ou le bouton ne provoque une action par défaut.
//     popUpDiv.style.display = 'block';
//   })

//   const submitForm = document.getElementById('submitForm')

//   submitForm.addEventListener('click', (e) => {
//     e.preventDefault();

//     popUpDiv.style.display = 'none';
//   })

//   const closePopUp = document.getElementById('closePopUp')

//   closePopUp.addEventListener("mouseover", (e) => {
//     e.preventDefault();
//     closePopUp.style.cursor = "pointer";
// });

//   closePopUp.addEventListener('click', (e) => {
//     e.preventDefault();
//     popUpDiv.style.display = 'none';
//   }) 


// & add image background dynamically to certain pages.

//récupérer url actuelle
// const url= window.location.href;
// // console.log(url);

// // vérifiez si l'url contient "action=detailFilm"

// if (url.includes("action=detailFilm")) {
//   const main = document.querySelector('main');
//   // console.log(body);
//   main.classList.add('custom-background');
//   // document.main.style.backgroundImage = 'url(' + backgroundPath + ')';
//   main.style.backgroundImage = `url('${backgroundPath}')`;

//   console.log('Chemin de l\'image de fond :', backgroundPath);

// }

 