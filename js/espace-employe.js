// Attendre que le DOM soit complètement chargé
document.addEventListener('DOMContentLoaded', () => {
    // Récupérer les données de l'utilisateur depuis le localStorage
    const userJson = localStorage.getItem('user');

    if (!userJson) {
        window.location.href = '../HTML/connexion.html';
        return;
    }
    // Vérifier le rôle de l'utilisateur
    const user = JSON.parse(userJson);
    if (user.role_id !== 2) {
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

    // Fausse DB d'avis pour tester les fonctions de validation et de refus
    const avisSimules = [
        { avis_id: 101, utilisateur_id: 1, pseudo: 'Alice22', covoiturage_id: 501, commentaire: 'Super trajet !', note: 5, statut: 'en attente' },
        { avis_id: 102, utilisateur_id: 2, pseudo: 'Bob_Ecolo', covoiturage_id: 502, commentaire: 'Un peu en retard.', note: 3, statut: 'en attente' },
        { avis_id: 103, utilisateur_id: 3, pseudo: 'Charlie99', covoiturage_id: 503, commentaire: 'Parfait, merci.', note: 5, statut: 'en attente' }
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
            row.id = `avis-${avis.avis_id}`;
            row.setAttribute('data-avis-id', avis.avis_id);
            row.setAttribute('data-covoiturage-id', avis.covoiturage_id);
            row.setAttribute('data-utilisateur-id', avis.utilisateur_id);

            // Remplir la ligne avec les données de l'avis
            row.innerHTML = ` 
        <td data-covoiturage-id="${avis.covoiturage_id}">#CV-${avis.covoiturage_id}</td> 
        <td data-utilisateur-pseudo="${avis.pseudo}">${avis.pseudo}</td> 
        <td data-commentaire="${avis.commentaire}">${avis.commentaire}</td> 
        <td data-note="${avis.note}"><span class="text-warning">${avis.note} / 5</span></td> 
        <td class="text-end">
            <button class="btn btn-primary btn-sm" onclick="validerAvis(${avis.avis_id})">Valider</button>
            <button class="btn btn-danger btn-sm" onclick="refuserAvis(${avis.avis_id})">Refuser</button>
        </td>`;
            // Ajouter la ligne au tableau
            tBody.appendChild(row);
        })
    }

    // .... GESTION DES LITIGES ....

    // Tableau pour les testes de la gestion de litige
    const litigesSimules = [
        { litige_id: 201, utilisateur_id: 4, pseudo: 'David_98', covoiturage_id: 601, organisateur_id: 5, concerne: 'Marc92', description: 'Le conducteur était en retard et a annulé le trajet.', statut: 'en cours' },
        { litige_id: 202, utilisateur_id: 6, pseudo: 'Ludivine25', covoiturage_id: 602, organisateur_id: 7, concerne: 'Julie_V', description: 'Le véhicule n\'était pas propre.', statut: 'en cours' },
        { litige_id: 203, utilisateur_id: 8, pseudo: 'Marie_03', covoiturage_id: 603, organisateur_id: 9, concerne: 'Jean_07', description: 'Le conducteur a pris un autre itinéraire sans prévenir.', statut: 'en cours' },
    ];

    // Récupérer la section tableau des litiges
    const tBodyLitiges = document.getElementById('litiges-table-body');

    if (tBodyLitiges) {
        tBodyLitiges.innerHTML = '';
        // Parcouri les litiges et les ajouter au tableau
        litigesSimules.forEach(litige => {
            const row = document.createElement('tr');
            row.id = `litige-${litige.litige_id}`;
            row.setAttribute('data-covoiturage-id', litige.covoiturage_id);
            row.setAttribute('data-utilisateur-id', litige.utilisateur_id);
            row.setAttribute('data-organisateur-id', litige.organisateur_id);
            
            row.innerHTML = `
                <td data-covoiturage-id="${litige.covoiturage_id}">#CV-${litige.covoiturage_id}</td>
                <td data-utilisateur-pseudo="${litige.pseudo}" data-utilisateur-id="${litige.utilisateur_id}">${litige.pseudo}</td>
                <td data-organisateur-pseudo="${litige.concerne}" data-organisateur-id="${litige.organisateur_id}">${litige.concerne}</td>
                <td data-description="${litige.description}">${litige.description}</td>
                <td data-statut="${litige.statut}">${litige.statut}</td>
                <td class="text-end">
                   <button class="btn btn-outline-secondary btn-sm" onclick="voirDescription(${litige.litige_id})">
                      Lire
                   </button>
                   <button class="btn btn-success btn-sm" onclick="resoudreLitige(${litige.litige_id})">
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
function validerAvis(avis_id) {
    // On demande confirmation
    const confirmation = confirm(`Êtes-vous sûr de vouloir valider l'avis n°${avis_id} ?`);

    // On regroupe toutes les actions dans un seul bloc logique
    if (confirmation) {
        // Ciblage de la ligne
        const ligne = document.getElementById(`avis-${avis_id}`);

        if (ligne) {
            ligne.remove(); // Action visuelle immédiate
            console.log(`L'avis n°${avis_id} a été validé.`);
            alert(`Succès : L'avis n°${avis_id} a été publié sur le site.`);
        }
    }
}

// Fonction Globale pour refuser un avis calqué sur valider un avis
function refuserAvis(avis_id) {
    const confirmation = confirm(`Êtes-vous sûr de vouloir refuser l'avis n°${avis_id} ?`);

    if (confirmation) {
        const ligne = document.getElementById(`avis-${avis_id}`);

        if (ligne) {
            ligne.remove();
            console.log(`L'avis n°${avis_id} a été supprimé.`);
            alert(`L'avis n°${avis_id} a été définitivement supprimé.`);
        }
    }
}

// Fonction pour voir la description complète d'un litige
function voirDescription(litige_id) {
    // Chercher le litige
    const litigeTrouve = document.querySelector(`#litige-${litige_id}`);
    // Vérifier si on trouve quelque chose
    if (litigeTrouve) {
        const description = litigeTrouve.querySelector('td[data-description]').getAttribute('data-description');
        alert(`Description du litige n°${litige_id} :\n${description}`);
    } else {
        alert(`Impossible de trouver le détail du litige n°${litige_id}.`);
    }
}

// Fonction pour valider le litige résolue
function resoudreLitige(litige_id) {
    const confirmation = confirm(`Êtes-vous sûr de vouloir marquer le litige n°${litige_id} comme résolu ?`);

    if (confirmation) {
        const ligne = document.getElementById(`litige-${litige_id}`);

        if (ligne) {
            ligne.querySelector('td[data-statut]').textContent = 'résolu';
            ligne.querySelector('td[data-statut]').setAttribute('data-statut', 'résolu');
            console.log(`Le litige n°${litige_id} a été marqué comme résolu.`);
            alert(`Succès : Le litige n°${litige_id} a été marqué comme résolu.`);
            
            ligne.querySelector('.btn-success').style.display = 'none';
        }
    }
}
