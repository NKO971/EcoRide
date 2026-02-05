// Attendre que le DOM soit complètement chargé
document.addEventListener('DOMContentLoaded', () => {
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

    // Sélection des éléments de l'historique des trajets
    

    // Affichage en fonction des roles Chauffeur/Passager bouttons radio
    function affichageEnFonctionDesRoles(valeurRole) {
        if (valeurRole === 'les_deux' || valeurRole === 'chauffeur') {
            blocChauffeur.style.display = 'flex';
        } else {
            blocChauffeur.style.display = 'none';
        }
    } // Penser a modifier la fonction avec switch case pour que le code soit plus propre et plus lisible

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

    // Gestion de l'affichage de l'historique des trajets et des trajets à venir
    function switchVue(cible) {
        // Définition du suffixe -b
        let suffixe = (role === 'chauffeur') ? '-b' : '';
          // Sélection des boutons à venir et de passé
    const btnAVenir = document.getElementById('btn-avenir' + suffixe);
    const btnHistorique = document.getElementById('btn-passe' + suffixe);
    const btnAVenirB = document.getElementById('btn-avenir-b' + suffixe);
    const btnPasseB = document.getElementById('btn-passe-b' + suffixe);

    // Sélection des éléments de la listeà venir et de l'historique
    
    }

});