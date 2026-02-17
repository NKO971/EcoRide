// Attendre que le DOM soit complètement chargé
document.addEventListener('DOMContentLoaded', () => {
// Cible des élément du DOM pour les statistiques
const totalCredits = document.getElementById('total-credits');
// Cible du canvas pour le graphique
const graphiqueRecettes = document.getElementById('chart-credits').getContext('2d');
// Cible du canvas pour le graphique des trajets
const graphiqueTrajets = document.getElementById('chart-trajets').getContext('2d');

    // On simule ce que la DB nous enverrait plus tar
const listeUtilisateurs = [
    { id: 1, pseudo: "EcoAdmin", role: "admin", statut: "actif" },
    { id: 2, pseudo: "Christelle", role: "employe", statut: "actif" },
    { id: 3, pseudo: "EmployeDuMois", role: "employe", statut: "suspendu" }
];

// On simule un tableau de recettes pour les statistiques
const donneesRecettes = [
    { date: "10/02", total: 150 },
    { date: "11/02", total: 230 },
    { date: "12/02", total: 180 },
    { date: "13/02", total: 450 }, // Grosse journée !
    { date: "14/02", total: 310 }
];

// On simule le tableau pour les statistiques des trajets
const donneesTrajets = [
    { date: "10/02", total: 20 },
    { date: "11/02", total: 35 },
    { date: "12/02", total: 28 },
    { date: "13/02", total: 50 }, // Grosse journée !
    { date: "14/02", total: 40 }
]

// Fonction pour afficher les utilisateurs dans le tableau
function afficherUtilisateurs() {
    const tbody = document.getElementById('liste-utilisateurs');
    tbody.innerHTML = ''; // Vider le tableau avant de le remplir
    
    listeUtilisateurs.forEach(element => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
        <td>${element.pseudo}</td>
        <td><span class="badge bg-light text-dark border">${element.role}</span></td>
        <td>
            <span class="badge ${element.statut === 'actif' ? 'bg-success' : 'bg-danger'}">
                ${element.statut}
            </span>
        </td>
        <td class="text-end"> 
            ${element.statut === 'actif' ?
                `<button class="btn btn-outline-warning btn-sm btn-statut" data-id="${element.id}">Suspendre</button>` :
                `<button class="btn btn-outline-success btn-sm btn-statut" data-id="${element.id}">Activer</button>`
            }
            <button class="btn btn-outline-danger btn-sm ms-2">Supprimer</button>
        </td>
    `;
    tbody.appendChild(tr);
    const boutonCree = tr.querySelector('.btn-statut');
    boutonCree.addEventListener('click', () => {
        // Récupérer l'ID de l'utilisateur à partir de l'attribut data-id
        const idAmodifier = parseInt(boutonCree.getAttribute('data-id'));
        // Passer l'attribut a la fonction de modification de statut
        modifierStatut(idAmodifier);
    });
})
}
afficherUtilisateurs();

// Fonction pour modifier le statut d'un utilisateur
function modifierStatut(id) {
    // Trouver l'utilisateur dans la liste à partir de son ID
    const utilisateur = listeUtilisateurs.find(user => user.id === id);

// Inverser le statut de l'utilisateur
    if (utilisateur) {
        utilisateur.statut = utilisateur.statut === 'actif' ? 'suspendu' : 'actif';
        // Mettre à jour l'affichage des utilisateurs après la modification
        afficherUtilisateurs();
    };
}

// Fonction pour calculer le total des recettes
function calculerTotalRecettes() {
    // Parcourir le tableau de données des recettes et additionner les totaux
    const total = donneesRecettes.reduce((accumulateur, element) => accumulateur + element.total, 0); // Je transfore tableau en une seule valeur (le total) en additionnant les totaux de chaque élément du tableau avec  l'outil de précision reduce()
    totalCredits.textContent = total;
    
}

// GRAPHIQUE DES REVENUS
// Fonction pour tous les graphiques du site
function creerGraphique(ctx, donneesSource, labelLegende, couleur) {
    
    // Extraction des labels et des valeurs à partir des données source
    const labels = donneesSource.map(item => item.date);
    const valeurs = donneesSource.map(item => item.total);

    // On retourne l'objet Chart créé avec les données et les options de configuration
    return new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: labelLegende,
                data: valeurs,
                borderColor: couleur,
                tension: 0.1
            }]
        }
    });
}

// Appel des fonctions
afficherUtilisateurs();
calculerTotalRecettes();
// Appel de la fonction de création de graphique pour les recettes
creerGraphique(graphiqueRecettes, donneesRecettes, "Revenus en crédits", "rgb(75, 192, 192)");
// Appel de la fonction de création de graphique pour les trajets
creerGraphique(graphiqueTrajets, donneesTrajets, "Nombre de trajets", "rgb(255, 99, 132)");
});