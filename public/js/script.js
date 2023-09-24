
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



