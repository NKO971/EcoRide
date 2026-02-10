// Attendre que le DOM soit complètement chargé
document.addEventListener('DOMContentLoaded', () => {

    // --- SÉLECTION DES ÉLÉMENTS DU DOM ---

    // Sélection des bouton radio pour le choix du rôle
    const radioRoles = document.querySelectorAll('input[name="role_utilisateur"]');
    const blocChauffeur = document.querySelector('.conteneur-chauffeur-flex');

    // Sélection des éléments pour le calcul de la commission
    const inputPrix = document.getElementById('prix_personne');
    const texteCommission = document.querySelector('.commission');
    const publierBtn = document.querySelector('.publier-btn');

    // Sélection du bouton pour ajouter un véhicule
    const btnAjouterVehicule = document.querySelector('.btn-outline-primary');
    const sectionVehicule = document.getElementById('section_vehicule');
    let vehiculeCount = 1; // Compteur de véhicules

    // Sélection des éléments de l'historique des trajets pour les changement en fonction du clique sur les boutons à venir ou historique
    const tabAvenir = document.getElementById('tab-avenir');
    const tabHistorique = document.getElementById('tab-historique');


    // Affichage en fonction des roles Chauffeur/Passager bouttons radio
    function affichageEnFonctionDesRoles(valeurRole) {
        switch (valeurRole) {
            case 'chauffeur':
            case 'les_deux': // on groupe les cas qui font la même chose !
                blocChauffeur.style.display = 'flex';
                break;
            case 'passager':
                blocChauffeur.style.display = 'none';
                break;
        }
    }

    // --- LOGIQUE D'AFFICHAGE EN FONCTION DES ROLES ---

    // Initialisation de l'affichage selon le rôle sélectionné au chargement
    const roleSelectionne = document.querySelector('input[name="role_utilisateur"]:checked');
    if (roleSelectionne) {
        affichageEnFonctionDesRoles(roleSelectionne.value);
    }

    if (radioRoles.length > 0 && blocChauffeur) {
        radioRoles.forEach(radio => {
            radio.addEventListener('change', () => {
                affichageEnFonctionDesRoles(radio.value);
            });
        });
    }

    // --- LOGIQUE DE CALCUL DE LA COMMISSION ---

    // Ecouteur de saisie (Calcul en temps réel)
    const frais = 2;
    function calculCommission(valeurNumerique) {
        if (valeurNumerique > frais) {
            const gainsutilisateur = valeurNumerique - frais;
            texteCommission.textContent = `Après une commission de ${frais} crédits, vous gagnez ${gainsutilisateur.toFixed(2)} crédits par passager.`;
            texteCommission.style.color = "var(--color-primary)";
            inputPrix.style.border = "1px solid var(--color-light)";
            return true;
        } else if (valeurNumerique > 0 && valeurNumerique <= frais) {
            texteCommission.textContent = `Le prix doit être supérieur à ${frais} crédits pour couvrir les frais de commission.`;
            texteCommission.style.color = "red";
        } else {
            texteCommission.textContent = "EcoRide prélèvera 2 crédits de commission par passager.";
            texteCommission.style.color = "var(--color-dark)";
        }
        return false;
    }
    // Saisie du prix
    inputPrix.addEventListener('input', () => {
        const prixSaisi = parseInt(inputPrix.value) || 0;
        calculCommission(prixSaisi);
    });
    // Ecouteur de clic (Validation finale)
    publierBtn.addEventListener('click', (event) => {
        const prixFinal = parseInt(inputPrix.value) || 0;
        if (calculCommission(prixFinal) === false) {
            event.preventDefault(); // Bloque l'envoi
            alert("Action impossible : veuillez choisir un prix supérieur aux frais de commission (2 crédits).");
            inputPrix.style.border = "2px solid red";
        }
    });

    // --- LOGIQUE D'AJOUT DE FORMULAIRE VÉHICULE ---

    // Ajout d'un nouveau formulaire pour ajouter un véhicule 
    btnAjouterVehicule.addEventListener('click', () => {
        // Le bloc à cloner
        const formOriginal = document.querySelector('.infos-vehicule');

        // Le clone
        const nouveauFormVehicule = formOriginal.cloneNode(true);

        vehiculeCount++;

        // Changer le titre (Legend)
        const legend = nouveauFormVehicule.querySelector('legend');
        if (legend) legend.textContent = `Mon Véhicule ${vehiculeCount}`;

        // Nettoyer les champs du clone
        const inputs = nouveauFormVehicule.querySelectorAll('input, select');
        inputs.forEach(input => {
            input.value = ""; // Vide le champ
            input.removeAttribute('id'); // Supprime l'ID dupliqué
            input.style.border = "";
        });

        const labels = nouveauFormVehicule.querySelectorAll('label');
        labels.forEach(label => {
            label.removeAttribute('for'); // Supprime l'attribut 'for' dupliqué
        });

        // Insérer le clone avant le bouton
        formOriginal.parentNode.insertBefore(nouveauFormVehicule, btnAjouterVehicule);

        // Focus sur le premier champ du nouveau formulaire 
        const premierInput = nouveauFormVehicule.querySelector('input');
        if (premierInput) premierInput.focus();
    });

    //--- LOGIQUE DE GESTION DES TRAJETS À VENIR ET HISTORIQUE ---

    // Sélection des éléments de la liste à venir et de l'historique et changement de style.
    function updateTabStyles(activeTab, inactiveTab) {
        // On s'assure que Bootstrap ne met pas de background bleu
        activeTab.style.backgroundColor = "transparent";
        inactiveTab.style.backgroundColor = "transparent";
        // Styles pour l'onglet actif
        activeTab.classList.add('text-primary');
        activeTab.classList.remove('text-muted', 'opacity-50');
        // Styles pour l'onglet inactif
        inactiveTab.classList.add('text-muted', 'opacity-50');
        inactiveTab.classList.remove('text-primary');
    }

    // Ecoute du clic sur "À venir"
    tabAvenir.addEventListener('click', () => {
        updateTabStyles(tabAvenir, tabHistorique);
    });
    // Ecoute du clic sur "Historique"
    tabHistorique.addEventListener('click', () => {
        updateTabStyles(tabHistorique, tabAvenir);
    });

    //--- LOGIQUE D'ANNULATION DE TRAJET ---

    // Annulation d'un trajet
    window.annulerTrajet = function (bouton, role) {
        if (!confirm("Confirmer l'annulation ?")) return; // Si l'utilisateur confirme, on sort de la fonction pour laisser le processus d'annulation se faire normalement

        switch (role) {
            case 'chauffeur':
                // ANTICIPATION BACK-END : Cette partie sera remplacée par un appel API (fetch)
                // Le serveur devra supprimer le trajet et déclencher l'envoi de mails automatique aux passagers concernés.
                console.log("LOGIQUE CHAUFFEUR : Suppression trajet + Alerte mail passagers.");
                break;

            case 'passager':
                // ANTICIPATION BACK-END : Le serveur devra recréditer le passager par un appel API (fetch)?
                // et incrémenter le nombre de places disponibles sur le trajet concerné 
                console.log("LOGIQUE PASSAGER : Libération place + Remboursement.");
                break;

            default:
                console.warn("Rôle inconnu, annulation visuelle uniquement.");
        }
        // Suppression visuelle du trajet
        const trajet = bouton.closest('.list-group-item');
        if (!trajet) return; // Si on ne trouve pas le trajet, on arrête

        // Ajout d'une classe pour l'animation de disparition
        trajet.style.transition = "all 0.5s ease";
        trajet.style.transform = "translateX(100px)";
        trajet.style.opacity = "0";

        // On attend la fin de l'animation pour supprimer
        setTimeout(() => {
            trajet.remove();

            // On vérifie si c'est vide pour mettre la phrase
            const liste = document.getElementById('liste-avenir');
            if (liste && liste.querySelectorAll('.list-group-item').length === 0) {
                liste.innerHTML = `
                        <div class="text-center p-5">
                            <p class="text-muted fw-bold">Vous n'avez plus aucun trajet à venir.</p>
                        </div>`;
            }
        }, 500);
    }
});

//--- LOGIQUE DE GESTION DU WORKFLOW DE TRAJET ---

// Fonction pour gérer le workflow du trajet (Démarrer, Terminer)
window.gererWorkflow = function (bouton) {
    const etatActuel = bouton.getAttribute('data-etat');

    switch (etatActuel) {
        case 'initial':
            // Sélection du bouton d'annulation dans la même zone d'action que le bouton workflow
            const zoneActions = bouton.closest('.zone-actions-');
            const boutonAnnuler = zoneActions ? zoneActions.querySelector('.btn-annuler-chauffeur') : null;
            if (boutonAnnuler) {
                boutonAnnuler.remove(); // Supprime le bouton d'annulation
            };
            bouton.textContent = "Arriveée à destination";
            // ANTICIPATION BACK-END : Appel API pour changer l'état du trajet à "en-cours"
            bouton.setAttribute('data-etat', 'en-cours');

            // On désactive le bouton de supression du trajet pour éviter les annulations une fois le trajet démarré
            const boutonSupprimer = document.querySelector('.btn-annuler-passager');
            if (boutonSupprimer) {
                boutonSupprimer.remove(); // Supprime le bouton de suppression pour les passagers
            }

            bouton.classList.remove("btn-primary"); // Retrait du style d'annulation
            bouton.classList.add("btn-warning"); // Changement de style pour indiquer que c'est en cours
            console.log("LOGIQUE CHAUFFEUR : Trajet démarré, état changé en 'en-cours'.");
            break;
        case 'en-cours':
            bouton.textContent = "Trajet terminé - En attente de validation";
            
            // On affiche le bouton de validation pour le passager après que le chauffeur ait terminé le trajet
            const boutonPassager = document.querySelector('.btn-valider-trajet');
            if (boutonPassager) {
                boutonPassager.disabled = false; // On lève le verrouillage du bouton de validation pour le passager
            }

            // ANTICIPATION BACK-END : Appel API pour changer l'état du trajet à "terminé"
            bouton.setAttribute('data-etat', 'termine');
            // On désactive le bouton pour éviter les clics multiples
            bouton.disabled = true;

            bouton.classList.remove("btn-warning");
            bouton.classList.add("btn-success"); // Changement de style pour indiquer que c'est terminé
            console.log("LOGIQUE CHAUFFEUR : Trajet en cours, état changé en 'terminé'.");
            break;
    }
}

//--- LOGIQUE DE VALIDATION DE TRAJET PAR LE PASSAGER ---

// Fonction pour que le passager puisse valider le trajet une fois terminé
window.validerTrajet = function (bouton) {
    if (!confirm("Confirmer la validation du trajet ?")) return; // Si l'utilisateur confirme, on sort de la fonction pour laisser le processus de validation se faire normalement
    bouton.textContent = "Trajet validé";
    bouton.disabled = true; // On désactive le bouton pour éviter les clics multiples

    bouton.classList.remove("btn-success");
    bouton.classList.add("btn-warning"); // Changement de style pour indiquer que c'est en cours de validation

    //On garde le bouton en mémoire pour la suite du processus de validation
    window.boutonEnCoursDeValidation = bouton;

    // Affichage de la modale pour laisser un avis au chauffeur
    const modalElement = document.getElementById('modalAvis');
    const instanceModale = new bootstrap.Modal(modalElement);
    instanceModale.show();

    // ANTICIPATION BACK-END : Appel API pour valider le trajet, créditer le chauffeurs et déclencher l'envoi de mails automatique au chauffeur.
    console.log("LOGIQUE PASSAGER : Validation du trajet, crédit du passager, alerte mail chauffeur.");
}

//--- LOGIQUE DE GESTION DE L'AVIS PASSAGER ---

// Fonction pour gérer la validation de l'avis du passager
// --- LOGIQUE DE VALIDATION FINALE (DANS LA MODALE) ---

window.envoyerAvis = function() {
    // On récupère les éléments
    const note = document.getElementById('noteChauffeur').value;
    const commentaire = document.getElementById('commentaireAvis').value;
    const modalElement = document.getElementById('modalAvis');

    // ANTICIPATION BACK-END : Envoi des données vers l'API
    console.log("DONNÉES ENVOYÉES : Note " + note + "/5, Avis : " + commentaire);
    // Ici on imagine l'appel fetch('/api/valider-trajet', { method: 'POST', body: ... })

    // On utilise la variable globale qu'on a créée dans validerTrajet
    if (window.boutonEnCoursDeValidation) {
        window.boutonEnCoursDeValidation.textContent = "Trajet validé";
        window.boutonEnCoursDeValidation.classList.remove("btn-warning");
        window.boutonEnCoursDeValidation.classList.add("btn-secondary");
        window.boutonEnCoursDeValidation.disabled = true; // Sécurité supplémentaire
    }

    // FERMETURE DE LA MODALE
    const instanceModale = bootstrap.Modal.getInstance(modalElement);
    instanceModale.hide();

    // FEEDBACK UTILISATEUR
    alert("Merci ! Votre trajet est validé et les crédits ont été transférés au chauffeur.");
}