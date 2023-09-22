// Obtenez une référence aux éléments "filmographie" et "rôle"
const filmographyButton = document.getElementById('filmo');
console.log("click");
const roleButton = document.getElementById('role');

// Obtenez une référence aux divs "list-role" et "list-filmo"
const listRoleDiv = document.querySelector('.list-role');
const listFilmoDiv = document.querySelector('.list-filmo');

// Gérez le clic sur "filmographie"
filmographyButton.addEventListener('click', function() {
    // Affichez la filmographie et masquez le rôle
    listRoleDiv.style.display = 'none';
    listFilmoDiv.style.display = 'block';

    // Activez le bouton "filmographie" et désactivez le bouton "rôle"
    filmographyButton.classList.add('active');
    roleButton.classList.remove('active');


});

// Gérez le clic sur "rôle"
roleButton.addEventListener('click', function() {
    // Affichez le rôle et masquez la filmographie
    listRoleDiv.style.display = 'block';
    listFilmoDiv.style.display = 'none';

    roleButton.classList.add('active');
    filmographyButton.classList.remove('active');
});