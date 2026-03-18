document.addEventListener('DOMContentLoaded', () => {
    // MOCK DATA: des données pour les filtres
    const mockData = [
        { 
            id: 1, 
            chauffeur_id: 456,
            conducteur: "Jean Dupont", 
            photo: "/Photo profile/freepik__the-style-is-candid-image-photography-with-natural__82878.png", 
            note: 4.5, 
            verifie: true, 
            depart: "Paris", 
            arrivee: "Toulouse", 
            heureDepart: 630, 
            heureArrivee: 967, 
            date: "2026-05-24", 
            prix_centimes: 500,  // 5€ en centimes
            passagers: 2, 
            ecologique: true,
            marque_vehicule: "Tesla",
            modele_vehicule: "Model 3",
            couleur_vehicule: "Blanc",
            preferences: "Non fumeur, pas d'animaux. Je discute volontiers !"
        },
        { 
            id: 2, 
            chauffeur_id: 789,
            conducteur: "Marie Curie", 
            photo: "/Photo profile/freepik__the-style-is-candid-image-photography-with-natural__82877.png", 
            note: 3, 
            verifie: false, 
            depart: "Paris", 
            arrivee: "Toulouse", 
            heureDepart: 840, 
            heureArrivee: 990, 
            date: "2026-05-27", 
            prix_centimes: 1000,  // 10€ en centimes
            passagers: 1, 
            ecologique: false,
            marque_vehicule: "Renault",
            modele_vehicule: "Clio",
            couleur_vehicule: "Noir",
            preferences: "Musique de voyage autorisée"
        },
        { 
            id: 3, 
            chauffeur_id: 321,
            conducteur: "Pierre Martin", 
            photo: "/Photo profile/freepik__the-style-is-candid-image-photography-with-natural__82879.png", 
            note: 4.8, 
            verifie: true, 
            depart: "Bordeaux", 
            arrivee: "Nantes", 
            heureDepart: 240, 
            heureArrivee: 400, 
            date: "2026-05-26", 
            prix_centimes: 700,  // 7€ en centimes
            passagers: 3, 
            ecologique: true,
            marque_vehicule: "Peugeot",
            modele_vehicule: "3008",
            couleur_vehicule: "Gris",
            preferences: "Pas de détours"
        },
    ];

    // La simulation de la base de données pour les avis
    const baseDeDonneesAvis = {
        1: [ // Avis pour le trajet ID 1
            { auteur: "Marie_L", texte: "Superbe voyage avec Jean !" },
            { auteur: "Lucas_P", texte: "Très ponctuel et voiture propre." }
        ],
        2: [ // Avis pour le trajet ID 2
            { auteur: "Sophie_D", texte: "Un peu de retard, mais conduite sécurisante." }
        ],
        3: [ // Avis pour le trajet ID 3
            { auteur: "Marc_T", texte: "Parfait, rien à dire !" },
            { auteur: "Julie_B", texte: "Très sympathique, je recommande." }
        ]
    };

    // Constantes pour les éléments du DOM
    const formulaireFiltres = document.querySelector('.filtre');
    const conteneurTrajets = document.getElementById('liste-trajet');
    const barreRecherche = document.querySelector('.barreRecherche');
    const messageErreur = document.getElementById('message-erreur');
    const inputDepart = document.getElementById('lieu_depart');
    const inputArrivee = document.getElementById('lieu_arrivee');
    const inputDate = document.getElementById('date_depart');
    const nbVoyagesTrouves = document.getElementById('nb-voyages-trouve');
    const messageErreurDate = document.getElementById('alerte-trajet-proche');
    const plusRapide = document.getElementById('plus-rapide');
    const plusEcologique = document.getElementById('plus-ecologique');
    const prixMax = document.getElementById('prix-max');
    const dureeMax = document.getElementById('duree-max');
    const avant6H = document.getElementById('avant-6h');
    const entre6H12H = document.getElementById('entre-6h-12');
    const entre12H18H = document.getElementById('entre-12h-18h');
    const apres18H = document.getElementById('apres-18h');
    const profilVerifie = document.getElementById('profile-verifie');
    const notePlus3 = document.getElementById('note-superieur-a-3');

    // Formatge des heures pour l'affichage
    function formatHeure(minutes) {
        const heures = Math.floor(minutes / 60);
        const minutesRestantes = minutes % 60;
        const minutesFormatees = minutesRestantes.toString().padStart(2, '0');
        return `${heures}h${minutesFormatees}`;
    }

    // Fonction pour convertir les centimes en euros affichables
    function centimesEnEuros(centimes) {
        return (centimes / 100).toFixed(2);
    }

    // Fonction pour formatter le nom du véhicule
    function formatNomVehicule(trajet) {
        return `${trajet.marque_vehicule} ${trajet.modele_vehicule} (${trajet.couleur_vehicule})`;
    }

    // --- AFFICHAGE DES TRAJETS ---

    function afficherTrajets(trajets) {
        conteneurTrajets.innerHTML = '';

        if (trajets.length === 0) {
            conteneurTrajets.innerHTML = '<p class="text-center">Aucun trajet trouvé.</p>';
            return;
        }

        trajets.forEach(trajet => {
            // Conversion prix centimes en euros
            const prixAffiche = (trajet.prix_centimes / 100).toFixed(2);
            const iconeVehicule = trajet.ecologique ? 'electric_car' : 'directions_car';
            const typeEnergie = trajet.ecologique ? 'Écologique' : 'Thermique';

            const card = `
            <div class="covoiturage" 
                data-trajet-id="${trajet.id}" 
                data-chauffeur-id="${trajet.chauffeur_id}" 
                data-prix-centimes="${trajet.prix_centimes}"
                data-est-ecologique="${trajet.ecologique}"
                data-nb-places="${trajet.passagers}"
                data-note="${trajet.note}">
                <div class="destinationHoraire">
                    <div class="trajet">
                        <span class="depart" data-lieu-depart="${trajet.depart}">${trajet.depart}</span>
                        <span class="arrivee" data-lieu-arrivee="${trajet.arrivee}">${trajet.arrivee}</span>
                    </div>
                    <div class="heure_depart" data-heure-depart="${formatHeure(trajet.heureDepart)}">${formatHeure(trajet.heureDepart)}</div>
                    <div class="FlechesH"><span class="material-symbols-outlined">line_end_arrow_notch</span></div>
                    <div class="heure_arrivee" data-heure-arrivee="${formatHeure(trajet.heureArrivee)}">${formatHeure(trajet.heureArrivee)}</div>
                    <div class="FlechesH"><span class="material-symbols-outlined">line_end_arrow_notch</span></div>
                    <div class="date_arrivee" data-date-arrivee="${trajet.date}">${trajet.date}</div>
                </div>
                <div class="ligneDeSeparation"><hr /></div>
                <div class="info-conducteur">
                    <div class="photo-pseudo col-12 col-md-auto d-flex flex-column flex-md-row align-items-center gap-2">
                        <img src="${trajet.photo || '/Photo profile/default.png'}" 
                            alt="${trajet.conducteur}" 
                            class="photoDeProfil" 
                            data-photo-chauffeur>
                        <span class="pseudo" data-pseudo-chauffeur>${trajet.conducteur}</span>
                        ${trajet.verifie ? '<span class="material-symbols-outlined text-success" title="Profil vérifié">verified</span>' : ''}
                    </div>
                    <div class="note">
                        <span class="material-symbols-outlined">star</span>
                        <span class="note-chauffeur" data-note-chauffeur>${trajet.note}</span>
                    </div>
                    <div class="icon-energie" data-icon-energie>
                        <span class="material-symbols-outlined">${iconeVehicule}</span>
                        <small>${typeEnergie}</small>
                    </div>
                    <div class="icon-credit">
                        <span class="material-symbols-outlined">payments</span>
                        <span><span class="js-credits" data-prix-affiche>${prixAffiche}</span> Crédits</span>
                    </div>
                    <div class="icon-passager">
                        <span class="material-symbols-outlined">person</span>
                        <span><span class="js-places" data-places-affichee>${trajet.passagers}</span> places</span>
                    </div>
                    <div class="action-btn col-12 col-md-auto">
                        <button class="btn-details btn-sm btn-outline-primary w-100 w-md-auto"
                                data-covoiturage-id="${trajet.id}"
                                data-bs-toggle="modal" 
                                data-bs-target="#modalDetailsTrajet">Détails</button>
                    </div>
                </div>
            </div>`;

            conteneurTrajets.innerHTML += card;
        });
    }

    // --- FILTRAGE DES TRAJETS ---

    function appliquerFiltres(event) {
        if (event && event.type === 'submit') event.preventDefault();

        console.log("🔍 Moteur de recherche : Lancement du filtrage...");

        // Initialisation : on cache les messages avant de traiter
        messageErreurDate.classList.add('d-none');
        messageErreur.classList.add('d-none');

        const departSaisi = inputDepart.value.trim().toLowerCase();
        const arriveeSaisie = inputArrivee.value.trim().toLowerCase();
        const dateSaisie = inputDate.value;

        // Filtrer d'abord uniquement par VILLES
        let trajetsFiltres = mockData.filter(trajet => {
            const matchDepart = departSaisi === "" || trajet.depart.toLowerCase().includes(departSaisi);
            const matchArrivee = arriveeSaisie === "" || trajet.arrivee.toLowerCase().includes(arriveeSaisie);
            return matchDepart && matchArrivee;
        });

        // Filtrer par DATE uniquement si elle est saisie
        if (dateSaisie !== "") {
            let trajetsParDate = trajetsFiltres.filter(trajet => trajet.date === dateSaisie);

            // Si aucune correspondance exacte, on applique la logique de proximité
            if (trajetsParDate.length === 0 && trajetsFiltres.length > 0) {
                const dateSaisieTimestamp = new Date(dateSaisie).getTime();

                trajetsFiltres.sort((a, b) => {
                    const diffA = Math.abs(new Date(a.date).getTime() - dateSaisieTimestamp);
                    const diffB = Math.abs(new Date(b.date).getTime() - dateSaisieTimestamp);
                    return diffA - diffB;
                });
                messageErreurDate.classList.remove('d-none'); // On affiche l'alerte
                console.log("⚠️ Aucun trajet exact : affichage des plus proches");
            } else {
                trajetsFiltres = trajetsParDate;
            }
        }

        // --- FILTRES AVANCÉS ---
        const unFiltreHoraireActif = avant6H.checked || entre6H12H.checked || entre12H18H.checked || apres18H.checked;
        const prixMaxValue = parseFloat(prixMax.value);
        const dureeSaisie = parseFloat(dureeMax.value);

        if (plusRapide.checked) {
            trajetsFiltres.sort((a, b) => (a.heureArrivee - a.heureDepart) - (b.heureArrivee - b.heureDepart));
            console.log("⚡ Tri : Le plus rapide");
        }

        if (plusEcologique.checked) {
            trajetsFiltres = trajetsFiltres.filter(trajet => trajet.ecologique === true);
            console.log("🌱 Filtre : Plus écologique");
        }

        if (prixMax.value) {
            // Comparaison: prix_centimes / 100 <= prixMaxValue
            trajetsFiltres = trajetsFiltres.filter(trajet => {
                const prixEnEuros = trajet.prix_centimes / 100;
                return prixEnEuros <= prixMaxValue;
            });
            console.log(`💰 Filtre : Prix max ${prixMaxValue}€`);
        }

        if (dureeMax.value) {
            const minutesMaxSaisies = dureeSaisie * 60;
            trajetsFiltres = trajetsFiltres.filter(trajet => (trajet.heureArrivee - trajet.heureDepart) <= minutesMaxSaisies);
            console.log(`⏱️ Filtre : Durée max ${dureeSaisie}h`);
        }

        if (notePlus3.checked) {
            trajetsFiltres = trajetsFiltres.filter(trajet => trajet.note > 3);
            console.log("⭐ Filtre : Note > 3");
        }

        if (unFiltreHoraireActif) {
            trajetsFiltres = trajetsFiltres.filter(trajet => {
                return (avant6H.checked && trajet.heureDepart < 360) ||
                    (entre6H12H.checked && trajet.heureDepart >= 360 && trajet.heureDepart < 720) ||
                    (entre12H18H.checked && trajet.heureDepart >= 720 && trajet.heureDepart < 1080) ||
                    (apres18H.checked && trajet.heureDepart >= 1080);
            });
            console.log("🕐 Filtre horaire appliqué");
        }

        if (profilVerifie.checked) {
            trajetsFiltres = trajetsFiltres.filter(trajet => trajet.verifie === true);
            console.log("✅ Filtre : Profil vérifié");
        }

        // COMPTAGE DES VOYAGES TROUVES
        nbVoyagesTrouves.textContent = trajetsFiltres.length;
        console.log(`📊 Résultat : ${trajetsFiltres.length} trajet(s) trouvé(s)`);

        afficherTrajets(trajetsFiltres);
    }

    // --- AFFICHAGE DES DÉTAILS DANS LA MODALE ---

    function afficherDetailsTrajet(trajet) {
        console.log(`📋 Ouverture modal pour trajet ID: ${trajet.id}`);

        // Récupération des éléments par ID (ancres HTML)
        const modalVilleDepart = document.getElementById('modal-ville-depart');
        const modalVilleArrivee = document.getElementById('modal-ville-arrivee');
        const modalHeureDepart = document.getElementById('modal-heure-depart');
        const modalHeureArrivee = document.getElementById('modal-heure-arrivee');
        const modalPhotoChauffeur = document.getElementById('modal-photo-chauffeur');
        const modalPseudoChauffeur = document.getElementById('modal-pseudo-chauffeur');
        const modalNoteChauffeur = document.getElementById('modal-note-chauffeur');
        const modalNomVehicule = document.getElementById('modal-nom-vehicule');
        const modalTypeEnergie = document.getElementById('modal-type-energie');
        const modalNbPlace = document.getElementById('modal-nb-place');
        const modalPrixFinal = document.getElementById('modal-prix-final');
        const modalAvisList = document.getElementById('modal-avis-list');
        const modalPreferences = document.getElementById('modal-preferences');
        const modalIconVehicule = document.getElementById('modal-icon-vehicule');
        const btnParticiper = document.getElementById('btn-participer-trajet');
        const modalMontantFinal = document.getElementById('modal-montant-final');

        // Vérification de l'existence des éléments
        if (!modalVilleDepart || !modalVilleArrivee) {
            console.error("❌ Éléments modaux introuvables");
            return;
        }

        // Mise à jour des informations du trajet
        modalVilleDepart.textContent = trajet.depart;
        modalVilleArrivee.textContent = trajet.arrivee;
        modalHeureDepart.textContent = formatHeure(trajet.heureDepart);
        modalHeureArrivee.textContent = formatHeure(trajet.heureArrivee);
        modalPhotoChauffeur.src = trajet.photo || '/Photo profile/default.png';
        modalPhotoChauffeur.alt = trajet.conducteur;
        modalPseudoChauffeur.textContent = trajet.conducteur;
        modalNoteChauffeur.textContent = `${trajet.note}/5`;
        
        // Véhicule
        modalNomVehicule.textContent = formatNomVehicule(trajet);
        modalTypeEnergie.textContent = trajet.ecologique ? 'Électrique' : 'Thermique';
        modalTypeEnergie.className = trajet.ecologique ? 'badge-energie badge-electrique' : 'badge-energie badge-thermique';
        
        // Icône énergie
        if (modalIconVehicule) {
            modalIconVehicule.textContent = trajet.ecologique ? 'electric_car' : 'directions_car';
        }

        // Places et prix
        modalNbPlace.textContent = trajet.passagers;
        const prixEnEuros = (trajet.prix_centimes / 100).toFixed(2);
        modalPrixFinal.textContent = prixEnEuros;
        modalMontantFinal.textContent = prixEnEuros;

        // Préférences
        if (modalPreferences) {
            modalPreferences.textContent = `"${trajet.preferences}"`;
        }

        // Avis du trajet
        const avisDuTrajet = baseDeDonneesAvis[trajet.id] || [];
        if (modalAvisList) {
            if (avisDuTrajet.length > 0) {
                modalAvisList.innerHTML = avisDuTrajet.map(avis => `
                    <div class="mb-2 border-bottom pb-1">
                        <strong class="avis-passager">${avis.auteur} :</strong> "${avis.texte}"
                    </div>
                `).join('');
            } else {
                modalAvisList.innerHTML = "<p class='text-muted'>Aucun avis pour le moment.</p>";
            }
        }

        // Mise à jour du bouton de participation
        if (btnParticiper) {
            btnParticiper.setAttribute('data-covoiturage-id', trajet.id);
            btnParticiper.setAttribute('data-prix-centimes', trajet.prix_centimes);
            console.log(`✅ Modal remplie pour trajet ${trajet.id}`);
        }
    }

    // --- GESTION DES CLICS SUR LES BOUTONS "DÉTAILS" ---

    conteneurTrajets.addEventListener('click', event => {
        if (event.target.classList.contains('btn-details')) {
            const trajetId = parseInt(event.target.getAttribute('data-covoiturage-id'));
            const trajet = mockData.find(t => t.id === trajetId);

            if (trajet) {
                afficherDetailsTrajet(trajet);
            } else {
                console.error(`❌ Trajet ID ${trajetId} introuvable`);
            }
        }
    });

    // --- GESTION DU BOUTON "CONFIRMER ET PAYER" ---

    const btnConfirmerPaiement = document.getElementById('btn-confirmer-paiement');
    if (btnConfirmerPaiement) {
        btnConfirmerPaiement.addEventListener('click', () => {
            const btnParticiper = document.getElementById('btn-participer-trajet');
            const trajetId = btnParticiper?.getAttribute('data-covoiturage-id');
            const prixCentimes = btnParticiper?.getAttribute('data-prix-centimes');

            const payloadReservation = {
                action: 'reserver_trajet',
                covoiturage_id: trajetId,
                utilisateur_id: JSON.parse(localStorage.getItem('user') || '{}').utilisateur_id,
                prix_centimes: parseInt(prixCentimes),
                prix_euros: (parseInt(prixCentimes) / 100).toFixed(2),
                timestamp: new Date().toISOString()
            };

            console.log("💳 RÉSERVATION - Payload prêt à envoyer :", payloadReservation);
            alert(`✅ Réservation confirmée pour ${(parseInt(prixCentimes) / 100).toFixed(2)}€`);
        });
    }

    // --- ÉCOUTEURS D'ÉVÉNEMENTS ---

    barreRecherche.addEventListener('submit', appliquerFiltres);
    formulaireFiltres.addEventListener('input', appliquerFiltres);

    // Initialisation
    console.log("🚀 Page resultat.js chargée");
    appliquerFiltres();
});