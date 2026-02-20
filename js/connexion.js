document.addEventListener('DOMContentLoaded', () => {
    const listeUtilisateurs = [
    { email: "admin@ecoride.fr", password: "123", role: "admin", pseudo: "SuperAdmin" },
    { email: "employe@ecoride.fr", password: "456", role: "employe", pseudo: "Jean_Modo" },
    { email: "client@mail.com", password: "789", role: "utilisateur", pseudo: "EcoRider31" }
];
    
    // CIBLE LES ELEMENTS DU DOM
    const form = document.getElementById('connexion-form');
    const emailInput = document.getElementById('emailInput');
    const passwordInput = document.getElementById('passwordInput');

    // AJOUT D'UN ECOUTEUR D'EVENEMENT SUR LE FORMULAIRE
    form.addEventListener('submit', async (event) => {
        event.preventDefault(); // EMPÊCHE LE RELOAD DE LA PAGE

        const email = emailInput.value;
        const password = passwordInput.value;
    
       // VERIFICATION DES INFORMATIONS DE CONNEXION
        const utilisateur = listeUtilisateurs.find(user => user.email === email && user.password === password);
        
        if (utilisateur) {
            localStorage.setItem('utilisateur', JSON.stringify(utilisateur));


        switch (utilisateur?.role) {
            case 'admin':
                alert(`Bienvenue ${utilisateur.pseudo} ! Vous êtes connecté en tant qu'administrateur.`);
                window.location.href = "/HTML/admin.html";
                break;
            case 'employe':
                alert(`Bienvenue ${utilisateur.pseudo} ! Vous êtes connecté en tant qu'employé.`);
                window.location.href = "/HTML/employe.html";
                break;
            default:
                alert(`Bienvenue ${utilisateur.pseudo} ! Vous êtes connecté en tant qu'utilisateur.`);
                window.location.href = "/HTML/utilisateur.html";
        }
    } else {
        alert("Identifiants incorrects.");
    }
    });

});