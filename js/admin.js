// Attendre que le DOM soit complètement chargé
document.addEventListener('DOMContentLoaded', () => {
    // ===== CIBLES DU DOM =====
    
    // Statistiques
    const totalCredits = document.getElementById('total-credits');
    const graphiqueRecettes = document.getElementById('chart-credits').getContext('2d');
    const graphiqueTrajets = document.getElementById('chart-trajets').getContext('2d');
    
    // Gestion des utilisateurs
    const champRecherche = document.getElementById('search-user');
    const listeUtilisateursContainer = document.getElementById('liste-utilisateurs');
    
    // Formulaire création employé
    const formCreationEmploye = document.getElementById('form-creation-employe');
    const inputNomComplet = document.getElementById('emp-nom');
    const inputEmail = document.getElementById('emp-email');
    const inputPassword = document.getElementById('emp-password');
    
    // Header admin
    const nomAdminElement = document.getElementById('nom-admin');
    const btnLogoutAdmin = document.getElementById('btn-logout-admin');

    // ===== AUTHENTIFICATION & AUTORISATION =====

    // Récupérer les données de l'utilisateur depuis le localStorage
    const userJson = localStorage.getItem('user');

    if (!userJson) {
        console.error("❌ Utilisateur non authentifié - Redirection...");
        window.location.href = '/HTML/connexion.html';
        return;
    }

    // Vérifier le rôle de l'utilisateur
    const user = JSON.parse(userJson);
    if (user.role !== 'admin') {
        console.error("❌ Accès refusé - Rôle insuffisant (attendu: admin, reçu: " + user.role + ")");
        window.location.href = '/HTML/connexion.html';
        return;
    }

    console.log("✅ Authentification admin réussie :", user);

    // Afficher le nom de l'admin dans la navbar
    if (nomAdminElement) {
        nomAdminElement.textContent = `Bienvenue, ${user.pseudo}`;
    }

    // ===== DONNÉES SIMULÉES (Mock Data) =====

    // Simulation: Liste des utilisateurs (Table utilisateur + role)
    let listeUtilisateurs = [
        { id: 1, pseudo: "EcoAdmin", role: "admin", statut: "actif" },
        { id: 2, pseudo: "Christelle", role: "employe", statut: "actif" },
        { id: 3, pseudo: "EmployeDuMois", role: "employe", statut: "suspendu" }
    ];

    // Simulation: Données des recettes (Table statistiques - mots-clés: revenus, crédits)
    const donneesRecettes = [
        { date: "10/02", total: 150 },
        { date: "11/02", total: 230 },
        { date: "12/02", total: 180 },
        { date: "13/02", total: 450 }, // Grosse journée !
        { date: "14/02", total: 310 }
    ];

    // Simulation: Données des trajets (Table statistiques - mots-clés: fréquentation, trajets)
    const donneesTrajets = [
        { date: "10/02", total: 20 },
        { date: "11/02", total: 35 },
        { date: "12/02", total: 28 },
        { date: "13/02", total: 50 }, // Grosse journée !
        { date: "14/02", total: 40 }
    ];

    // ===== UTILITAIRES STATISTIQUES =====

    /**
     * Calcule le total des recettes
     * Utilise reduce() pour additionner tous les totaux
     */
    function calculerTotalRecettes() {
        const total = donneesRecettes.reduce(
            (accumulateur, element) => accumulateur + element.total, 
            0
        );
        totalCredits.textContent = total;
        console.log(`💰 Total recettes calculé : ${total} crédits`);
    }

    /**
     * Crée un graphique Chart.js générique
     * @param {CanvasRenderingContext2D} ctx - Contexte du canvas
     * @param {Array} donneesSource - Tableau de données { date, [clé]: valeur }
     * @param {string} labelLegende - Libellé pour la légende
     * @param {string} couleur - Couleur du graphique (RGB)
     * @param {string} cleValeur - Clé de la propriété à afficher (défaut: "total")
     */
    function creerGraphique(ctx, donneesSource, labelLegende, couleur, cleValeur = 'total') {
        // Extraction des labels et des valeurs à partir des données source
        const labels = donneesSource.map(item => item.date);
        const valeurs = donneesSource.map(item => item[cleValeur]); // Utilise la clé dynamiquement

        return new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: labelLegende,
                    data: valeurs,
                    borderColor: couleur,
                    backgroundColor: couleur.replace('rgb', 'rgba').replace(')', ', 0.1)'),
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // ===== GESTION DES UTILISATEURS =====

    /**
     * Affiche les utilisateurs dans le tableau (Table utilisateur & role)
     * @param {Array} listeAAfficher - Liste des utilisateurs à afficher
     */
    function afficherUtilisateurs(listeAAfficher = listeUtilisateurs) {
        listeUtilisateursContainer.innerHTML = ''; // Vider avant de remplir

        listeAAfficher.forEach(utilisateur => {
            // Créer la ligne du tableau
            const tr = document.createElement('tr');
            tr.id = `user-${utilisateur.id}`; // ID dynamique pour se conformer au MCD
            tr.setAttribute('data-utilisateur-id', utilisateur.id);

            // Déterminer le badge de statut
            const classeStatut = utilisateur.statut === 'actif' ? 'bg-success' : 'bg-danger';
            const textStatut = utilisateur.statut.charAt(0).toUpperCase() + utilisateur.statut.slice(1);

            // Déterminer le bouton d'action (Suspendre/Activer)
            const boutonStatut = utilisateur.statut === 'actif' 
                ? `<button class="btn btn-sm btn-warning btn-modifier-statut" data-utilisateur-id="${utilisateur.id}">Suspendre</button>`
                : `<button class="btn btn-sm btn-success btn-modifier-statut" data-utilisateur-id="${utilisateur.id}">Activer</button>`;

            // Remplir la ligne avec les éléments MCD
            tr.innerHTML = `
                <td>
                    <span class="pseudo-utilisateur" data-pseudo="${utilisateur.pseudo}">${utilisateur.pseudo}</span>
                </td>
                <td>
                    <span class="role-utilisateur badge bg-light text-dark border" data-role="${utilisateur.role}">
                        ${utilisateur.role}
                    </span>
                </td>
                <td>
                    <span class="statut-utilisateur badge ${classeStatut}" data-statut="${utilisateur.statut}">
                        ${textStatut}
                    </span>
                </td>
                <td class="text-end">
                    ${boutonStatut}
                    <button class="btn btn-sm btn-danger btn-supprimer-utilisateur ms-2" data-utilisateur-id="${utilisateur.id}">
                        Supprimer
                    </button>
                </td>
            `;

            listeUtilisateursContainer.appendChild(tr);

            // Attachers les écouteurs aux boutons
            const btnModifier = tr.querySelector('.btn-modifier-statut');
            const btnSupprimer = tr.querySelector('.btn-supprimer-utilisateur');

            btnModifier.addEventListener('click', () => {
                const idUtilisateur = parseInt(btnModifier.getAttribute('data-utilisateur-id'));
                modifierStatut(idUtilisateur);
            });

            btnSupprimer.addEventListener('click', () => {
                const idUtilisateur = parseInt(btnSupprimer.getAttribute('data-utilisateur-id'));
                supprimerUtilisateur(idUtilisateur);
            });
        });

        console.log(`📋 ${listeAAfficher.length} utilisateur(s) affichés`);
    }

    /**
     * Filtre et affiche les utilisateurs en temps réel
     */
    champRecherche.addEventListener('input', () => {
        const rechercheUtilisateur = champRecherche.value.toLowerCase();
        const utilisateursFiltres = listeUtilisateurs.filter(user => 
            user.pseudo.toLowerCase().includes(rechercheUtilisateur)
        );

        afficherUtilisateurs(utilisateursFiltres);
        console.log(`🔍 Recherche : "${rechercheUtilisateur}" - ${utilisateursFiltres.length} résultat(s)`);
    });

    /**
     * Modifie le statut d'un utilisateur (actif <-> suspendu)
     */
    function modifierStatut(idUtilisateur) {
        const utilisateur = listeUtilisateurs.find(user => user.id === idUtilisateur);

        if (utilisateur) {
            utilisateur.statut = utilisateur.statut === 'actif' ? 'suspendu' : 'actif';
            afficherUtilisateurs();
            console.log(`✏️ Statut modifié pour ${utilisateur.pseudo} : ${utilisateur.statut}`);
        } else {
            console.error(`❌ Utilisateur ID ${idUtilisateur} introuvable`);
        }
    }

    /**
     * Supprime un utilisateur après confirmation
     */
    function supprimerUtilisateur(idUtilisateur) {
        const utilisateur = listeUtilisateurs.find(user => user.id === idUtilisateur);

        if (!utilisateur) {
            console.error(`❌ Utilisateur ID ${idUtilisateur} introuvable`);
            return;
        }

        const confirmation = confirm(
            `⚠️ Êtes-vous sûr de vouloir supprimer l'utilisateur "${utilisateur.pseudo}" ?`
        );

        if (confirmation) {
            listeUtilisateurs = listeUtilisateurs.filter(user => user.id !== idUtilisateur);
            afficherUtilisateurs();
            console.log(`🗑️ Utilisateur ${utilisateur.pseudo} supprimé`);
        } else {
            console.log("🔓 Suppression annulée");
        }
    }

    // ===== GESTION DU FORMULAIRE DE CRÉATION D'EMPLOYÉ =====

    /**
     * Crée un nouvel employé (Table utilisateur avec role: "employe")
     */
    formCreationEmploye.addEventListener('submit', (event) => {
        event.preventDefault(); // Empêcher rechargement page

        // Récupérer les valeurs via les attributs name (alignés MCD)
        const nomComplet = inputNomComplet.value.trim();
        const email = inputEmail.value.trim();
        const password = inputPassword.value.trim();

        // Validation basique
        if (!nomComplet || !email || !password) {
            console.warn("⚠️ Tous les champs sont requis");
            alert("Veuillez remplir tous les champs");
            return;
        }

        // Créer l'objet employé conforme au MCD
        const nouvelEmploye = {
            id: Math.max(...listeUtilisateurs.map(u => u.id), 0) + 1, // ID unique
            pseudo: nomComplet, // Utilise nom_complet comme pseudo
            role: "employe", // Role fixé à "employe" (champ caché du formulaire)
            statut: "actif",
            email: email, // Champ email (optionnel mais stocké)
            password: password // Champ password (EN PRODUCTION: hasher avec bcrypt!)
        };

        listeUtilisateurs.push(nouvelEmploye);
        afficherUtilisateurs();
        formCreationEmploye.reset();

        console.log("✅ Nouvel employé créé :", {
            id: nouvelEmploye.id,
            pseudo: nouvelEmploye.pseudo,
            email: nouvelEmploye.email,
            role: nouvelEmploye.role,
            statut: nouvelEmploye.statut
        });

        alert(`✅ Employé "${nomComplet}" créé avec succès !`);
    });

    // ===== GESTION DES BOUTONS SPÉCIAUX =====

    /**
     * Bouton déconnexion
     */
    if (btnLogoutAdmin) {
        btnLogoutAdmin.addEventListener('click', (event) => {
            event.preventDefault();
            localStorage.removeItem('user');
            console.log("🔓 Déconnexion admin effectuée");
            window.location.href = '/HTML/connexion.html';
        });
    }

    // ===== INITIALISATION DE LA PAGE =====

    console.log("🚀 Page admin.js initialisée");
    
    afficherUtilisateurs();
    calculerTotalRecettes();
    
    // Créer les graphiques avec gestion générique des clés
    creerGraphique(
        graphiqueRecettes, 
        donneesRecettes, 
        "Revenus en crédits", 
        "rgb(75, 192, 192)",
        'total' // Clé de valeur pour les recettes
    );
    
    creerGraphique(
        graphiqueTrajets, 
        donneesTrajets, 
        "Nombre de trajets", 
        "rgb(255, 99, 132)",
        'total' // Clé de valeur pour les trajets
    );

});