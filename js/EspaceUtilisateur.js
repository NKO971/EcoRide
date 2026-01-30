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

    // Affichage des roles Chauffeur/Passager bouttons radio
 if (radioRoles.length > 0 && blocChauffeur) {
        radioRoles.forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.value === 'chauffeur' || radio.value === 'les_deux') {
                    blocChauffeur.style.display = 'flex';
                } else {
                    blocChauffeur.style.display = 'none';
                }
            });
        });
    }

    // Ecouteur de saisie (Calcul en temps réel)
    inputPrix.addEventListener('input', () => {
        const prix = parseInt(inputPrix.value); // parseInt pour obtenir un entier mieux que parseFloat qui donne des décimales
        const frais = 2;

        if (prix > frais) {
            const gainsutilisateur = prix - frais;
            texteCommission.textContent = `Après une commission de ${frais} crédits, vous gagnez ${gainsutilisateur.toFixed(2)} crédits par passager.`;
            texteCommission.style.color = "var(--color-primary)";
        } else if (prix > 0 && prix <= frais) {
            texteCommission.textContent = `Le prix doit être supérieur à ${frais} crédits pour couvrir les frais de commission.`;
            texteCommission.style.color = "red"; 
        } else {
            texteCommission.textContent = "EcoRide prélèvera 2 crédits de commission par passager.";
            texteCommission.style.color = "var(--color-dark)";
        }
    });

    // Ecouteur de clic (Validation finale)
    publierBtn.addEventListener('click', (event) => {
        // Récupérer la valeur AU MOMENT du clic
        const prixAuClic = parseInt(inputPrix.value); 

        if (!prixAuClic || prixAuClic <= 2) {
            event.preventDefault(); // Bloque l'envoi
            alert("Action impossible : veuillez choisir un prix supérieur aux frais de commission (2 crédits).");
            inputPrix.style.border = "2px solid red";
        } else {
            // Le formulaire va s'envoyer normalement si c'est bon
            inputPrix.style.border = "1px solid var(--color-light)";
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

    // Insérer le clone avant le bouton
    formOriginal.parentNode.insertBefore(nouveauFormVehicule, btnAjouterVehicule);
    
    // Focus sur le premier champ du nouveau formulaire 
    const premierInput = nouveauFormVehicule.querySelector('input');
    if (premierInput) premierInput.focus();
});

});