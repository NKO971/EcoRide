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

    // Récupérer les données de l'utilisateur depuis le localStorage
    const userJson = localStorage.getItem('user');

    if (!userJson) {
        window.location.href = '../HTML/connexion.html';
        return;
    }

    // Vérifier le rôle de l'utilisateur
    const user = JSON.parse(userJson);
    if (user.role !== 'user') {
        window.location.href = '../HTML/connexion.html';
        return;
    }

    // Afficher les données de l'utilisateur dans la console
    console.log('Données de l\'utilisateur :', user);

    // Afficher le pseudo de l'utilisateur dans le menu
    const nomEmployeElement = document.getElementById('menu-pseudo');
    if (nomEmployeElement) {
        nomEmployeElement.textContent = user.pseudo;
    }

    // Peupler l'input caché organisateur_id avec l'ID de l'utilisateur connecté
    const organisateurIdInput = document.getElementById('organisateur_id');
    if (organisateurIdInput) {
        organisateurIdInput.value = user.utilisateur_id || '';
    }

    // --- LOGIQUE D'AFFICHAGE EN FONCTION DES ROLES ---

    function affichageEnFonctionDesRoles(valeurRole) {
        switch (valeurRole) {
            case 'chauffeur':
            case 'les_deux':
                blocChauffeur.style.display = 'flex';
                break;
            case 'passager':
                blocChauffeur.style.display = 'none';
                break;
        }
    }

    // Initialisation de l'affichage selon le rôle sélectionné au chargement
    const roleSelectionne = document.querySelector('input[name="role_preference"]:checked');
    if (roleSelectionne) {
        affichageEnFonctionDesRoles(roleSelectionne.value);
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

    // Saisie du prix en temps réel
    inputPrix.addEventListener('input', () => {
        const prixSaisi = parseFloat(inputPrix.value) || 0;
        calculCommission(prixSaisi);
    });

    // Écouteur de clic sur le bouton Publier (Validation finale)
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

        // Affichage du payload en console (ANTICIPATION BACK-END)
        console.log("✅ PUBLICATION TRAJET VALIDÉE - Prêt à envoyer à l'API");
        console.log("📤 Payload à envoyer :", {
            utilisateur_id: user.utilisateur_id,
            prix_personne: prixFinal,
            organisateur_id: organisateurIdInput.value,
            timestamp: new Date().toISOString()
        });
    });

    // --- LOGIQUE D'AJOUT DE FORMULAIRE VÉHICULE ---

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

    // --- LOGIQUE DE GESTION DES ONGLETS (À VENIR / HISTORIQUE) ---

    function updateTabStyles(activeTab, inactiveTab) {
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
    if (tabAvenir) {
        tabAvenir.addEventListener('click', () => {
            updateTabStyles(tabAvenir, tabHistorique);
        });
    }

    // Écouteur sur l'onglet "Historique"
    if (tabHistorique) {
        tabHistorique.addEventListener('click', () => {
            updateTabStyles(tabHistorique, tabAvenir);
        });
    }

    // --- LOGIQUE D'ANNULATION DE TRAJET ---

    window.annulerTrajet = function (bouton, role) {
        if (!confirm("Confirmer l'annulation ?")) return;

        const trajet = bouton.closest('.list-group-item');
        if (!trajet) {
            console.error("❌ Élément trajet introuvable");
            return;
        }

        const covoiturageId = trajet.getAttribute('data-covoiturage-id');
        const reservationId = trajet.getAttribute('data-reservation-id');

        // ANTICIPATION BACK-END : Log structuré pour l'API
        const payloadAnnulation = {
            action: 'annuler_trajet',
            covoiturage_id: covoiturageId,
            reservation_id: reservationId,
            utilisateur_id: user.utilisateur_id,
            role: role,
            timestamp: new Date().toISOString()
        };

        console.log("🔴 ANNULATION TRAJET - Prêt à envoyer :", payloadAnnulation);

        // Animation de disparition
        trajet.style.transition = "all 0.5s ease";
        trajet.style.transform = "translateX(100px)";
        trajet.style.opacity = "0";

        setTimeout(() => {
            trajet.remove();

            // Vérifier si la liste est vide
            const liste = document.getElementById('liste-avenir');
            if (liste && liste.querySelectorAll('.list-group-item').length === 0) {
                liste.innerHTML = `
                    <div class="text-center p-5">
                        <i class="bi bi-calendar-x d-block mb-3 h1 text-muted opacity-50"></i>
                        <p class="text-muted fw-bold">Vous n'avez plus aucun trajet à venir.</p>
                    </div>`;
            }
        }, 500);
    };

    // --- LOGIQUE DE GESTION DU WORKFLOW DE TRAJET ---

    window.gererWorkflow = function (bouton) {
        const etatActuel = bouton.getAttribute('data-etat');
        const trajet = bouton.closest('.list-group-item');

        if (!trajet) {
            console.error("❌ Trajet introuvable pour le workflow");
            return;
        }

        const covoiturageId = trajet.getAttribute('data-covoiturage-id');

        switch (etatActuel) {
            case 'initial':
                // Désactiver le bouton d'annulation
                const zoneActions = bouton.closest('.zone-actions-');
                const boutonAnnuler = zoneActions ? zoneActions.querySelector('.btn-annuler-chauffeur') : null;
                if (boutonAnnuler) {
                    boutonAnnuler.style.display = 'none';
                }

                // Mettre à jour le bouton
                bouton.textContent = "Arrivée à destination";
                bouton.setAttribute('data-etat', 'en-cours');
                bouton.classList.remove("btn-primary");
                bouton.classList.add("btn-warning");

                // ANTICIPATION BACK-END
                const payloadDemarrage = {
                    action: 'demarrer_trajet',
                    covoiturage_id: covoiturageId,
                    utilisateur_id: user.utilisateur_id,
                    statut: 'en-cours',
                    timestamp: new Date().toISOString()
                };

                console.log("🟡 DÉMARRAGE TRAJET - Prêt à envoyer :", payloadDemarrage);
                break;

            case 'en-cours':
                // Mettre à jour le bouton
                bouton.textContent = "Trajet terminé - En attente de validation";
                bouton.setAttribute('data-etat', 'termine');
                bouton.disabled = true;
                bouton.classList.remove("btn-warning");
                bouton.classList.add("btn-success");

                // Activer le bouton de validation passager
                const boutonValidationPassager = trajet.querySelector('.btn-valider-trajet');
                if (boutonValidationPassager) {
                    boutonValidationPassager.disabled = false;
                }

                // ANTICIPATION BACK-END
                const payloadTerminaison = {
                    action: 'terminer_trajet',
                    covoiturage_id: covoiturageId,
                    utilisateur_id: user.utilisateur_id,
                    statut: 'termine',
                    timestamp: new Date().toISOString()
                };

                console.log("🟢 TERMINAISON TRAJET - Prêt à envoyer :", payloadTerminaison);
                break;

            default:
                console.warn("⚠️ État inconnu :", etatActuel);
        }
    };

    // --- LOGIQUE DE VALIDATION DE TRAJET PAR LE PASSAGER ---

    window.validerTrajet = function (bouton) {
        if (!confirm("Confirmer la validation du trajet ?")) return;

        const trajet = bouton.closest('.list-group-item');
        if (!trajet) {
            console.error("❌ Trajet introuvable pour validation");
            return;
        }

        const covoiturageId = trajet.getAttribute('data-covoiturage-id');

        // Mise à jour du bouton
        bouton.textContent = "Trajet validé";
        bouton.disabled = true;
        bouton.classList.remove("btn-success");
        bouton.classList.add("btn-warning");

        // Stocker l'ID du trajet pour la modal
        window.covoiturageIdEnCoursDeValidation = covoiturageId;

        // Peupler les champs cachés de la modale
        const covoiturageIdAvis = document.getElementById('covoiturage-id-avis');
        const utilisateurIdAvis = document.getElementById('utilisateur-id-avis');

        if (covoiturageIdAvis) covoiturageIdAvis.value = covoiturageId;
        if (utilisateurIdAvis) utilisateurIdAvis.value = user.utilisateur_id;

        // Affichage de la modale
        const modalElement = document.getElementById('modalAvis');
        if (modalElement) {
            const instanceModale = new bootstrap.Modal(modalElement);
            instanceModale.show();
            console.log(`📋 VALIDATION TRAJET - Modale ouverte pour trajet ID: ${covoiturageId}`);
        } else {
            console.error("❌ Modal introuvable");
        }
    };

    // --- LOGIQUE DE GESTION DE L'AVIS PASSAGER ---

    window.envoyerAvis = function() {
        const noteElement = document.getElementById('note');
        const commentaireElement = document.getElementById('commentaire');
        const covoiturageIdAvis = document.getElementById('covoiturage-id-avis');
        const utilisateurIdAvis = document.getElementById('utilisateur-id-avis');
        const statutElement = document.querySelector('input[name="statut"]');

        // Vérification des champs
        if (!noteElement || !commentaireElement) {
            console.error("❌ Éléments du formulaire d'avis introuvables");
            return;
        }

        const note = noteElement.value;
        const commentaire = commentaireElement.value;
        const covoiturageId = covoiturageIdAvis ? covoiturageIdAvis.value : '';
        const utilisateurId = utilisateurIdAvis ? utilisateurIdAvis.value : '';
        const statut = statutElement ? statutElement.value : 'en attente';

        if (!note || !commentaire) {
            alert("Veuillez remplir tous les champs obligatoires.");
            return;
        }

        // ANTICIPATION BACK-END : Payload structuré
        const payloadAvis = {
            action: 'envoyer_avis',
            avis: {
                covoiturage_id: covoiturageId,
                utilisateur_id: utilisateurId,
                note: parseInt(note),
                commentaire: commentaire,
                statut: statut,
                date_creation: new Date().toISOString()
            }
        };

        console.log("⭐ AVIS PASSAGER - Prêt à envoyer :", payloadAvis);

        // Fermeture de la modale
        const modalElement = document.getElementById('modalAvis');
        if (modalElement) {
            const instanceModale = bootstrap.Modal.getInstance(modalElement);
            if (instanceModale) instanceModale.hide();
        }

        // Réinitialisation du formulaire
        const formAvis = document.getElementById('formAvis');
        if (formAvis) formAvis.reset();

        alert("Merci ! Votre avis a été enregistré et sera modéré par nos équipes.");
    };

    window.signalerProbleme = function() {
        const covoiturageIdAvis = document.getElementById('covoiturage-id-avis');
        const covoiturageId = covoiturageIdAvis ? covoiturageIdAvis.value : '';

        // ANTICIPATION BACK-END
        const payloadSignalement = {
            action: 'signaler_probleme',
            covoiturage_id: covoiturageId,
            utilisateur_id: user.utilisateur_id,
            timestamp: new Date().toISOString()
        };

        console.log("🚨 SIGNALEMENT - Prêt à envoyer :", payloadSignalement);
        alert("Votre signalement a été transmis à notre équipe de support.");
    };
});