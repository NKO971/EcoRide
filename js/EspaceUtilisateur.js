// Attendre que le DOM soit complètement chargé
document.addEventListener('DOMContentLoaded', () => {

    // --- SÉLECTION DES ÉLÉMENTS DU DOM ---

    // Sélection des bouton radio pour le choix du rôle
    const radioRoles = document.querySelectorAll('input[name="role_preference"]');
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
    const tabAvenir = document.getElementById('tab-avenir');
    const tabHistorique = document.getElementById('tab-historique');

    // NOTE: L'authentification et les données utilisateur sont gérées par le serveur PHP
    // Les formulaires envoient directement les données au serveur via l'attribut action
    
    // --- SÉLECTION PROFIL ---
    const btnActionProfil = document.getElementById('btn-action-profil');
    const formProfil = document.getElementById('form-profil');


    // --- LOGIQUE D'AFFICHAGE EN FONCTION DES ROLES ---

    function affichageEnFonctionDesRoles(valeurRole) {
        if (!blocChauffeur) return; // Sécurité
        
        if (valeurRole === 'chauffeur' || valeurRole === 'les_deux') {
            blocChauffeur.style.display = 'flex';
        } else {
            blocChauffeur.style.display = 'none';
        }
    }

    // Initialisation de l'affichage selon le rôle sélectionné au chargement
    const roleSelectionne = document.querySelector('input[name="role_preference"]:checked');
    if (roleSelectionne) {
        affichageEnFonctionDesRoles(roleSelectionne.value);
    } else {
        // Si rien n'est coché par défaut, on cache par sécurité
        if (blocChauffeur) blocChauffeur.style.display = 'none';
    }

    // Ajout des écouteurs de changement sur les radios
    if (radioRoles.length > 0 && blocChauffeur) {
        radioRoles.forEach(radio => {
            radio.addEventListener('change', () => {
                affichageEnFonctionDesRoles(radio.value);
            });
        });
    }

    // --- LOGIQUE DE CALCUL DE LA COMMISSION ---

    const frais = 2;

    function calculCommission(valeurNumerique) {
        // Sécurité : vérifier que les éléments existent
        if (!texteCommission || !inputPrix) return false;

        if (valeurNumerique > frais) {
            const gainsUtilisateur = valeurNumerique - frais;
            texteCommission.textContent = `Après une commission de ${frais} crédits, vous gagnez ${gainsUtilisateur.toFixed(2)} crédits par passager.`;
            texteCommission.style.color = "var(--color-primary)";
            inputPrix.style.border = "1px solid var(--color-light)";
            return true;
        } else if (valeurNumerique > 0 && valeurNumerique <= frais) {
            texteCommission.textContent = `Le prix doit être supérieur à ${frais} crédits pour couvrir les frais de commission.`;
            texteCommission.style.color = "red";
            inputPrix.style.border = "2px solid red";
            return false;
        } else {
            texteCommission.textContent = "EcoRide prélèvera 2 crédits de commission par passager.";
            texteCommission.style.color = "var(--color-dark)";
            inputPrix.style.border = "1px solid var(--color-light)";
            return false;
        }
    }

    // Saisie du prix en temps réel (sécurité : vérifier existence)
    if (inputPrix && texteCommission) {
        inputPrix.addEventListener('input', () => {
            const prixSaisi = parseFloat(inputPrix.value) || 0;
            calculCommission(prixSaisi);
        });
    }

    // Écouteur de clic sur le bouton Publier (Validation côté client uniquement)
    if (publierBtn && inputPrix) {
        publierBtn.addEventListener('click', (event) => {
            const prixFinal = parseFloat(inputPrix.value) || 0;

            // Vérification du prix
            if (calculCommission(prixFinal) === false) {
                event.preventDefault();
                alert("Action impossible : veuillez choisir un prix supérieur aux frais de commission (2 crédits).");
                inputPrix.style.border = "2px solid red";
                return;
            }

            // Vérification : au moins un véhicule renseigné
            const formulairesVehicules = document.querySelectorAll('.infos-vehicule');
            let vehiculeValide = false;

            formulairesVehicules.forEach(formulaire => {
                const inputImmatriculation = formulaire.querySelector('input[name="immatriculation"]');
                if (inputImmatriculation && inputImmatriculation.value.trim() !== '') {
                    vehiculeValide = true;
                }
            });

            if (!vehiculeValide) {
                event.preventDefault();
                alert("Veuillez enregistrer au moins un véhicule avant de publier un trajet.");
                return;
            }

            // Le formulaire est envoyé au serveur via l'attribut action
            console.log("✅ Formulaire validé - Envoi au serveur");
        });
    }

    // --- LOGIQUE D'AJOUT DE FORMULAIRE VÉHICULE ---

    if (btnAjouterVehicule) {
        btnAjouterVehicule.addEventListener('click', () => {
            const formOriginal = document.querySelector('.infos-vehicule');

            if (!formOriginal) {
                console.warn("⚠️ Formulaire original introuvable");
                return;
            }

            // Clone du formulaire
            const nouveauFormVehicule = formOriginal.cloneNode(true);
            vehiculeCount++;

            // Changer le titre (Legend)
            const legend = nouveauFormVehicule.querySelector('legend');
            if (legend) legend.textContent = `Mon Véhicule ${vehiculeCount}`;

            // Nettoyer et renommer les IDs pour éviter les doublons
            const inputs = nouveauFormVehicule.querySelectorAll('input, select');
            inputs.forEach(input => {
                const originalId = input.getAttribute('id');
                const name = input.getAttribute('name');

                // Vider le champ
                input.value = "";
                input.style.border = "";

                // Générer un nouvel ID unique (ex: immatriculation_2, marque_id_2)
                if (originalId) {
                    const newId = `${originalId}_${vehiculeCount}`;
                    input.setAttribute('id', newId);
                }
            });

            // Mettre à jour les labels pour pointer vers les nouveaux IDs
            const labels = nouveauFormVehicule.querySelectorAll('label');
            labels.forEach(label => {
                const forAttribute = label.getAttribute('for');
                if (forAttribute) {
                    const newForAttribute = `${forAttribute}_${vehiculeCount}`;
                    label.setAttribute('for', newForAttribute);
                }
            });

            // Insérer le clone avant le bouton
            formOriginal.parentNode.insertBefore(nouveauFormVehicule, btnAjouterVehicule);

            // Focus sur le premier input du nouveau formulaire
            const premierInput = nouveauFormVehicule.querySelector('input');
            if (premierInput) {
                premierInput.focus();
                console.log(`✅ Véhicule ${vehiculeCount} ajouté avec succès`);
            }
        });
    }

    // --- LOGIQUE DE GESTION DES ONGLETS (À VENIR / HISTORIQUE) ---

    function updateTabStyles(activeTab, inactiveTab) {
        if (!activeTab || !inactiveTab) return; // Sécurité

        activeTab.style.backgroundColor = "transparent";
        inactiveTab.style.backgroundColor = "transparent";

        // Styles pour l'onglet actif
        activeTab.classList.add('text-primary');
        activeTab.classList.remove('text-muted', 'opacity-50');

        // Styles pour l'onglet inactif
        inactiveTab.classList.add('text-muted', 'opacity-50');
        inactiveTab.classList.remove('text-primary');
    }

    // Écouteur sur l'onglet "À venir"
    if (tabAvenir && tabHistorique) {
        tabAvenir.addEventListener('click', () => {
            updateTabStyles(tabAvenir, tabHistorique);
        });
    }

    // Écouteur sur l'onglet "Historique"
    if (tabHistorique && tabAvenir) {
        tabHistorique.addEventListener('click', () => {
            updateTabStyles(tabHistorique, tabAvenir);
        });
    }

    // --- LOGIQUE DE GESTION DU MODE ÉDITION DU PROFIL (DÉPLACÉE ET SÉCURISÉE ICI) ---

    if (btnActionProfil && formProfil) {
        btnActionProfil.addEventListener('click', function(event) {
            const inputs = formProfil.querySelectorAll('input:not([type="hidden"]), select, textarea');
            
            // Sécurité essentielle : on vérifie qu'on a bien trouvé des inputs avant de lire l'index 0
            if (inputs.length > 0) {
                const isReadOnly = inputs[0].hasAttribute('disabled');

                if (isReadOnly) {
                    // Empêche la soumission PHP au tout premier clic de déblocage
                    event.preventDefault(); 
                    
                    // PASSER EN MODE ÉDITION
                    inputs.forEach(input => input.removeAttribute('disabled'));
                    
                    // Mettre à jour le bouton
                    this.textContent = 'Enregistrer mon profil';
                    this.setAttribute('type', 'submit');
                }
            }
        });
    }

    // NOTE: Gestion des trajets (annulation, workflow, validation, avis, signalements)
    // confiée au backend PHP - Les formulaires POSTent directement au serveur
});