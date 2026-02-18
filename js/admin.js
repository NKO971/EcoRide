// Attendre que le DOM soit complètement chargé
document.addEventListener('DOMContentLoaded', () => {
// Cible des élément du DOM pour les statistiques
const totalCredits = document.getElementById('total-credits');
// Cible du canvas pour le graphique
const graphiqueRecettes = document.getElementById('chart-credits').getContext('2d');
// Cible du canvas pour le graphique des trajets
const graphiqueTrajets = document.getElementById('chart-trajets').getContext('2d');
// Cible du champ de recherche pour les utilisateurs
const champRecherche = document.getElementById('search-user');
// Cible du formulaire de création d'utilisateur
const formCreationEmploye = document.getElementById('form-creation-employe');
const inputNom = document.getElementById('emp-nom');
const inputEmail = document.getElementById('emp-email');
const inputPassword = document.getElementById('emp-password');


    // On simule ce que la DB nous enverrait plus tar
let listeUtilisateurs = [
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

// Fonction pour afficher les utilisateurs dans le tableau
function afficherUtilisateurs(listeAAfficher = listeUtilisateurs) {
    const tbody = document.getElementById('liste-utilisateurs');
    tbody.innerHTML = ''; // Vider le tableau avant de le remplir
    
    listeAAfficher.forEach(element => {
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
            <button class="btn btn-outline-danger btn-sm ms-2 btn-delete" data-id="${element.id}">Supprimer</button>
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
    const boutonSupprimer = tr.querySelector('.btn-delete');
    boutonSupprimer.addEventListener('click', () => {
        const idASupprimer = parseInt(boutonSupprimer.getAttribute('data-id'));
        // Supprimer l'utilisateur de la liste en filtrant la liste pour exclure l'utilisateur avec l'ID spécifié
        const indexASupprimer = listeUtilisateurs.findIndex(user => user.id === idASupprimer);
        if (indexASupprimer !== -1) {
            const confirmation = confirm(`Êtes-vous sûr de vouloir supprimer l'utilisateur ${listeUtilisateurs[indexASupprimer].pseudo} ?`); // Afficher une alerte de confirmation avant de supprimer l'utilisateur
            if (confirmation) {
                listeUtilisateurs = listeUtilisateurs.filter(user => user.id !== idASupprimer); // Supprimer l'utilisateur de la liste
                afficherUtilisateurs(); // Mettre à jour l'affichage des utilisateurs après la suppression
            }
        }
    });
});
}
// Travaille sur le champ de recherche pour filtrer les utilisateurs en temps réel
// Ecoute de l'événement de saisie dans le champ de recherche
champRecherche.addEventListener('input', () => {
    const rechercheUtilisateur = champRecherche.value.toLowerCase(); // Récupérer la valeur saisie et la convertir en minuscules pour une recherche insensible à la casse
    const utilisateursFiltres = listeUtilisateurs.filter(user => user.pseudo.toLowerCase().includes(rechercheUtilisateur)); // Filtrer la liste des utilisateurs en fonction de la recherche

    afficherUtilisateurs(utilisateursFiltres); // Appel de la fonction en lui passant la liste filtrée pour mettre à jour l'affichage des utilisateurs dans le tableau
});


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

// Ecoute de l'événement de soumission du formulaire de création d'employé
formCreationEmploye.addEventListener('submit', (event) => {
    event.preventDefault(); // Empêcher le comportement par défaut du formulaire (rechargement de la page)

    // fabrication de l'objet employé à partir des valeurs saisies dans le formulaire
    const nouvelEmploye = {
        id: listeUtilisateurs.length + 1, // Générer un ID unique (simplement en prenant la longueur actuelle de la liste + 1)
        pseudo: inputNom.value,
        role: "employe",
        statut: "actif"
    };

    listeUtilisateurs.push(nouvelEmploye);
    afficherUtilisateurs();// Mise à jour de l'affichage des utilisateurs après l'ajout du nouvel employé
    formCreationEmploye.reset(); // Réinitialiser le formulaire après la soumission
    console.log("Création d'un nouvel employé :");
});

// Appel des fonctions
afficherUtilisateurs();
calculerTotalRecettes();
// Appel de la fonction de création de graphique pour les recettes
creerGraphique(graphiqueRecettes, donneesRecettes, "Revenus en crédits", "rgb(75, 192, 192)");
// Appel de la fonction de création de graphique pour les trajets
creerGraphique(graphiqueTrajets, donneesTrajets, "Nombre de trajets", "rgb(255, 99, 132)");
});