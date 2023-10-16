// ^ displaying different contents on actor page (filmographie + role)
document.addEventListener("DOMContentLoaded", function () {
  const filmographyButton = document.getElementById("filmo");
  const roleButton = document.getElementById("role");

  const listRoleDiv = document.querySelector(".list-role");
  const listFilmoDiv = document.querySelector(".list-filmo");

  if (filmographyButton) {
    filmographyButton.addEventListener("click", function () {
      // Afficher la filmographie et masquer le rôle
      listRoleDiv.style.display = "none";
      listFilmoDiv.style.display = "block";

      // Activer le bouton "filmographie" et désactiver le bouton "rôle"
      filmographyButton.classList.add("active");
      roleButton.classList.remove("active");
    });

    roleButton.addEventListener("click", function () {
      // Afficher le rôle et masquer la filmographie
      listRoleDiv.style.display = "block";
      listFilmoDiv.style.display = "none";

      roleButton.classList.add("active");
      filmographyButton.classList.remove("active");
    });
  }
});

// ^ Menu burger
const menuBurger = document.querySelector(".menu-burger");
const nav = document.querySelector(".primary-navigation");

menuBurger.addEventListener("click", () => {
  menuBurger.classList.toggle("active");
  nav.classList.toggle("active");
});


//^ dark/light mode
//^ enable the switch between dark and light mode
// operator ternaire
// let result = condition ? value1 : value 2
//  commence par récupérer l'élément racine (la balise HTML) et la valeur actuelle du thème en utilisant les variables CSS personnalisées (variables CSS).
// La valeur du thème actuel est stockée dans la variable theme. Si la valeur de la variable CSS personnalisée --light est vide (ce qui signifie que le thème actuel est sombre), la variable theme est définie sur 'dark', sinon elle est définie sur 'light'. Cette étape détermine le thème actuel de la page lorsqu'elle est chargée.
let root = document.documentElement,
  theme =
    window.getComputedStyle(root).getPropertyValue("--light") === " "
      ? "dark"
      : "light";

document.getElementById("checkbox").addEventListener("click", toggleTheme);

function toggleTheme() {
  root.classList.remove(theme);
  theme = theme === "dark" ? "light" : "dark";
  root.classList.add(theme);
  if (theme === "dark") {
    localStorage.setItem("theme", "dark");
  } else {
    localStorage.setItem("theme", "light");
  }
}

// ^ displaying the theme selected by the user
let userTheme = "<?php echo getTheme(); ?>";
// Initialisez le thème de l'utilisateur lorsqu'il se connecte
if (userTheme === "dark") {
  // Appliquer le thème sombre
  root.classList.remove("light");
  root.classList.add("dark");
} else {
  // Thème par défaut (light)
  root.classList.remove("dark");
  root.classList.add("light");
}
// https://stackoverflow.com/questions/70845195/define-dark-mode-for-both-a-class-and-a-media-query-without-repeat-css-custom-p


//^ storing the user's theme preference
const toggleBtn = document.getElementById("toggle-btn");
// Select the theme preference from localStorage
const currentTheme = localStorage.getItem("theme");
if (currentTheme == "dark") {
  root.classList.remove(theme);
  root.classList.add("dark");
} else {
  root.classList.remove(theme);
  root.classList.add("light");
}

//^ scroll to top Button
const scrollToTopButton = document.getElementById("scrollToTopButton");

function scrollToTop() {
  window.scrollTo({
    top: 0,
    behavior: "smooth", // Option pour un défilement fluide
  });
}

scrollToTopButton.addEventListener("click", scrollToTop);
// Afficher ou masquer le bouton en fonction de la position de défilement - ici réglé à 50px.
window.onscroll = function () {
  //document.body.scrollTop = fait référence à la position de défilement verticale de la partie <body> de la page.
  // document.documentElement.scrollTop =  fait référence à la position de défilement verticale de l'élément <html> de la page.
  // La différence entre document.body.scrollTop et document.documentElement.scrollTop réside dans la manière dont les navigateurs gèrent la position de défilement verticale sur différentes versions et configurations.
  if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
    document.getElementById("scrollToTopButton").classList.add("show");
  } else {
    document.getElementById("scrollToTopButton").classList.remove("show");
  }
};