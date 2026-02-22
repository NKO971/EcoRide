document.addEventListener('DOMContentLoaded', () => {
    const listeusers = [
    { email: "admin@ecoride.fr", password: "123", role: "admin", pseudo: "SuperAdmin" },
    { email: "employe@ecoride.fr", password: "456", role: "employe", pseudo: "Jean_Modo" },
    { email: "client@mail.com", password: "789", role: "user", pseudo: "EcoRider31" }
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
        const user = listeusers.find(user => user.email === email && user.password === password);
        // Local Storage
        if (user) {
            localStorage.setItem('user', JSON.stringify(user));

        switch (user?.role) {
            case 'admin':
                alert(`Bienvenue ${user.pseudo} ! Vous êtes connecté en tant qu'administrateur.`);
                window.location.href = "/HTML/admin.html";
                break;
            case 'employe':
                alert(`Bienvenue ${user.pseudo} ! Vous êtes connecté en tant qu'employé.`);
                window.location.href = "/HTML/espace-employe.html";
                break;
            default:
                alert(`Bienvenue ${user.pseudo} ! Vous êtes connecté en tant qu'user.`);
                window.location.href = "/HTML/Espace_utilisateur.html";
        }
    } else {
        alert("Identifiants incorrects.");
    }
    });

});