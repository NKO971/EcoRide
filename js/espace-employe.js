// Attendre que le DOM soit complètement chargé
document.addEventListener('DOMContentLoaded', () => {
    // Récupérer les données de l'utilisateur depuis le localStorage
    const userJson = localStorage.getItem('user');

    if (!userJson) {
        window.location.href = '../HTML/connexion.html'; // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
        return;
    }
    // Vérifier le rôle de l'utilisateur
    const user = JSON.parse(userJson); // Récupérer les données de l'utilisateur depuis le localStorage
    if (user.role !== 'employe') {
        window.location.href = '../HTML/connexion.html';
        return;
    }
    // Afficher les données de l'utilisateur dans la console
    console.log('Données de l\'utilisateur :', user);

    // Afficher le nom de l'employé dans la section de profil
    const nomEmployeElement = document.getElementById('nom-employe');
    if (nomEmployeElement) {
        nomEmployeElement.textContent = `Bienvenue, ${user.pseudo}`;
    }

    //const avisEnAttente = user.avis.filter(avis => avis.status === 'en attente'); En attente de la mise en place de la DB pour récupérer les avis réels de l'utilisateur connecté !!!

    // Fausse DB d'avis pour tester les fonctions de validation et de refus
    const avisSimules = [
        { id: 101, pseudo: 'Alice22', commentaire: 'Super trajet !', note: 5, status: 'en attente' },
        { id: 102, pseudo: 'Bob_Ecolo', commentaire: 'Un peu en retard.', note: 3, status: 'en attente' },
        { id: 103, pseudo: 'Charlie99', commentaire: 'Parfait, merci.', note: 5, status: 'en attente' }
    ];

    // Récupérer la section du tableau où les avis seront affichés
    const tBody = document.getElementById('avis-table-body');

    if (tBody) {
        // Vider le contenu actuel du tableau
        tBody.innerHTML = '';
        // Parcourir les avis et les ajouter au tableau
        avisSimules.forEach(avis => {
            const row = document.createElement('tr');
            // Sécurité mettre l'id avant de remplir
            row.id = `avis-${avis.id}`;

            // Remplir la ligne avec les données de l'avis
            row.innerHTML = ` 
        <td>${avis.id}</td> 
        <td>${avis.pseudo}</td> 
        <td>${avis.commentaire}</td> 
        <td><span class="text-warning">${avis.note} / 5</span></td> <td class="text-end">
            <button class="btn btn-primary btn-sm" onclick="validerAvis(${avis.id})">Valider</button><button class="btn btn-danger btn-sm" onclick="refuserAvis(${avis.id})">Refuser</button>
        </td>`;
            // Ajouter la ligne au tableau
            tBody.appendChild(row);
        })
    }

    // .... GESTION DES LITIGES ....  En attente de la mise en place de la DB pour récupérer les litiges réels de l'utilisateur connecté !!!

    // Récupérer la section tableau des litiges
    const tBodyLitiges = document.getElementById('litiges-table-body');

    if (tBodyLitiges) {
        tBodyLitiges.innerHTML = '';
        // Parcouri les litiges et les ajouter au tableau
        litigesSimules.forEach(litige => {
            const row = document.createElement('tr');
            row.id = `litige-${litige.id}`;
            row.innerHTML = `
                <td>${litige.id}</td>
                <td>${litige.pseudo}</td>
                <td>${litige.concerne}</td>
                <td>${litige.description}</td>
                <td>${litige.status}</td>
                <td class="text-end">
                   <button class="btn btn-outline-secondary btn-sm" onclick="voirDescription(${litige.id})">
                      Lire
                   </button>
                   <button class="btn btn-success btn-sm" onclick="resoudreLitige(${litige.id})">
                      Terminer
                   </button>
                </td>
            `;
            tBodyLitiges.appendChild(row);
        });
    }


})

// AVIS FONCTION GLOBALE POUR VALIDER OU REFUSER UN AVIS EN FONCTION DE L'ID DE L'AVIS CLIQUÉ

// Fonction pour valider un avis en Globale
function validerAvis(id) {
    // On demande confirmation
    const confirmation = confirm(`Êtes-vous sûr de vouloir valider l'avis n°${id} ?`);

    // On regroupe toutes les actions dans un seul bloc logique
    if (confirmation) {
        // Ciblage de la ligne
        const ligne = document.getElementById(`avis-${id}`);

        if (ligne) {
            ligne.remove(); // Action visuelle immédiate
            console.log(`L'avis n°${id} a été validé.`);
            alert(`Succès : L'avis n°${id} a été publié sur le site.`);
        }
    }
}


// Fonction Globale pour refuser un avis calqué sur valider un avis
function refuserAvis(id) {
    const confirmation = confirm(`Êtes-vous sûr de vouloir refuser l'avis n°${id} ?`);

    if (confirmation) {
        const ligne = document.getElementById(`avis-${id}`);

        if (ligne) {
            ligne.remove();
            console.log(`L'avis n°${id} a été supprimé.`);
            alert(`L'avis n°${id} a été définitivement supprimé.`);
        }
    }
}


// TABLEAU ET FONCTIONS GLOBALES POUR LA GESTION DES LITIGES

// Tableau pour les teste de la gestion de litige
    const litigesSimules = [
        { id: 201, pseudo: 'David_98 (Passager)', concerne: 'Marc92 (Chauffeur)', description: 'Le conducteur était en retard et a annulé le trajet.', status: 'en cours' },
        { id: 202, pseudo: 'Ludivine25 (Passagère)', concerne: 'Julie_V (Chauffeur)', description: 'Le véhicule n\'était pas propre.', status: 'en cours' },
        { id: 203, pseudo: 'Marie_03 (Passagère)', concerne: 'Jean_07 (Chauffeur)', description: 'Le conducteur a pris un autre itinéraire sans prévenir.', status: 'en cours' },
    ];



// Fonction pour voir la description complète d'un litige
function voirDescription(id) {
    // Chercher le litige
    const litigeTrouve = litigesSimules.find(litige => litige.id === id);
    // Vérifier si on trouve quelque chose
    if (litigeTrouve) {
        alert(`Description du litige n°${id} :\n${litigeTrouve.description}`);
    } else {
        alert(`Impossible de trouver le détail du litige n°${id}.`);
    }
}

// Fonction pour valider le litige résolue
function resoudreLitige(id) {
    const confirmation = confirm(`Êtes-vous sûr de vouloir marquer le litige n°${id} comme résolu ?`);

    if (confirmation) {
        const litigeIndex = litigesSimules.findIndex(litige => litige.id === id);

        if (litigeIndex !== -1) {
            litigesSimules[litigeIndex].status = 'résolu'; // Mise à jour du statut dans la "DB"
            const ligne = document.getElementById(`litige-${id}`);
            if (ligne) {
                ligne.querySelector('td:nth-child(5)').textContent = 'résolu';
                console.log(`Le litige n°${id} a été marqué comme résolu.`);
                alert(`Succès : Le litige n°${id} a été marqué comme résolu.`);
                
                ligne.querySelector('.btn-success').style.display = 'none';
            }
        }
    }
}
