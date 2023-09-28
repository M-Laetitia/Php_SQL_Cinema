
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



// Menu burger

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



document.getElementById('toggle-btn')
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

    