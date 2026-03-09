document.addEventListener('DOMContentLoaded', () => {
    // MOCK DATA: des données pour les filtres
    const mockData = [
        { id: 1, conducteur: "Jean Dupont", photo: "/Photo profile/freepik__the-style-is-candid-image-photography-with-natural__82878.png", note: 4.5, verifie: true, depart: "Paris", arrivee: "Toulouse", heureDepart: 630, heureArrivee: 967, date: "2026-05-24", prix: 5, passagers: 2, ecologique: true },
        { id: 2, conducteur: "Marie Curie", photo: "/Photo profile/freepik__the-style-is-candid-image-photography-with-natural__82877.png", note: 3, verifie: false, depart: "Paris", arrivee: "Toulouse", heureDepart: 840, heureArrivee: 990, date: "2026-05-27", prix: 10, passagers: 1, ecologique: false },
        { id: 3, conducteur: "Pierre Martin", photo: "/Photo profile/freepik__the-style-is-candid-image-photography-with-natural__82879.png", note: 4.8, verifie: true, depart: "Bordeaux", arrivee: "Nantes", heureDepart: 240, heureArrivee: 400, date: "2026-05-26", prix: 7, passagers: 3, ecologique: true },
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
    // Cble ID
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
        const heures = Math.floor(minutes / 60);// On calcule les heures
        const minutesRestantes = minutes % 60; // On calcule les minutes restantes
        const minutesFormatees = minutesRestantes.toString().padStart(2, '0'); // On formate les minutes pour qu'elles aient toujours 2 chiffres
        return `${heures}h${minutesFormatees}`;
    }

    // Fonction pour afficher les trajets
    function afficherTrajets(trajets) {
        conteneurTrajets.innerHTML = ''; 

        if (trajets.length === 0) {
            conteneurTrajets.innerHTML = '<p class="text-center">Aucun trajet trouvé.</p>';
            return;
        }

        trajets.forEach(trajet => {
            const card = `
            <div class="covoiturage">
                <div class="destinationHoraire">
                    <div class="trajet">
                        <span class="depart">${trajet.depart}</span>
                        <span class="arrivee">${trajet.arrivee}</span>
                    </div>
                    <div class="heure_depart">${formatHeure(trajet.heureDepart)}</div>
                    <div class="FlechesH"><span class="material-symbols-outlined">line_end_arrow_notch</span></div>
                    <div class="heure_arrivee">${trajet.heureArrivee ? formatHeure(trajet.heureArrivee) : '--h--'}</div>
                    <div class="FlechesH"><span class="material-symbols-outlined">line_end_arrow_notch</span></div>
                    <div class="date_arrivee">${trajet.date}</div>
                </div>
                <div class="ligneDeSeparation"><hr /></div>
                <div class="info-conducteur">
                    <div class="photo-pseudo col-12 col-md-auto d-flex flex-column flex-md-row align-items-center gap-2">
                        <img src="${trajet.photo || '/Photo profile/default.png'}" alt="${trajet.conducteur}" class="photoDeProfil">
                        <span class="pseudo">${trajet.conducteur}</span>
                        ${trajet.verifie ? '<span class="material-symbols-outlined text-success" title="Profil vérifié">verified</span>' : ''}
                    </div>
                    <div class="note">
                        <span class="material-symbols-outlined">star</span>
                        <span class="note-chauffeur">${trajet.note}</span>
                    </div>
                    <div class="icon-energie">
                        <span class="material-symbols-outlined">${trajet.ecologique ? 'electric_car' : 'directions_car'}</span>
                        <small>${trajet.ecologique ? 'Écologique' : 'Thermique'}</small>
                    </div>
                    <div class="icon-credit">
                        <span class="material-symbols-outlined">payments</span>
                        <span><span class="js-credits">${trajet.prix}</span> Crédits</span>
                    </div>
                    <div class="icon-passager">
                        <span class="material-symbols-outlined">person</span>
                        <span><span class="js-places">${trajet.passagers}</span> places</span>
                    </div>
                    <div class="action-btn col-12 col-md-auto">
                        <button class="btn-details btn-sm btn-outline-primary w-100 w-md-auto"
                                data-trajet-id="${trajet.id}"
                                data-bs-toggle="modal" data-bs-target="#modalDetailsTrajet">Détails</button>
                    </div>
                </div>
            </div>`;
            conteneurTrajets.innerHTML += card;
        });
    }

    // TRAVAILLE SUR LES FILTRES AVEC .filter
    function appliquerFiltres(event) {
        if (event && event.type === 'submit') event.preventDefault();
        
        console.log("Moteur de recherche : Je lance le filtrage...");
        
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
        }

        if (plusEcologique.checked) {
            trajetsFiltres = trajetsFiltres.filter(trajet => trajet.ecologique === true);
        }

        if (prixMax.value) {
            trajetsFiltres = trajetsFiltres.filter(trajet => trajet.prix <= prixMaxValue);
        }

        if (dureeMax.value) {
            const minutesMaxSaisies = dureeSaisie * 60;
            trajetsFiltres = trajetsFiltres.filter(trajet => (trajet.heureArrivee - trajet.heureDepart) <= minutesMaxSaisies);
        }

        if (notePlus3.checked) {
            trajetsFiltres = trajetsFiltres.filter(trajet => trajet.note > 3);
        }

        if (unFiltreHoraireActif) {
            trajetsFiltres = trajetsFiltres.filter(trajet => {
                return (avant6H.checked && trajet.heureDepart < 360) ||
                    (entre6H12H.checked && trajet.heureDepart >= 360 && trajet.heureDepart < 720) ||
                    (entre12H18H.checked && trajet.heureDepart >= 720 && trajet.heureDepart < 1080) ||
                    (apres18H.checked && trajet.heureDepart >= 1080);
            });
        }
        // FILTRE PROFILE VERIFIE
        if (profilVerifie.checked) {
            trajetsFiltres = trajetsFiltres.filter(trajet => trajet.verifie === true);
        }

        // COMPTAGE  DES VOYAGES TROUVES
        nbVoyagesTrouves.textContent = trajetsFiltres.length;
        afficherTrajets(trajetsFiltres);
    }

    // Mise a jour du modal avec les détails du trajet sélectionné

    // Fonction pour afficher les détails du trajet dans le modal
    function afficherDetailsTrajet(trajet) {
        document.getElementById('modalDetailsTrajet').setAttribute('data-trajet-id', trajet.id);
       // Cible par ID
        const photoChauffeur = document.getElementById('photo-chauffeur');
        const nombrePlaces = document.getElementById ('modal-nb-place');
        const prixPersonne = document.getElementById('modal-prix-personne');
        const iconVehicule = document.getElementById('icon-vehicule');

       // Cible par classe
         const villeDepart = document.querySelector('.v-depart');
         const villeArrivee = document.querySelector('.v-arrivee');
         const horraireTrajet = document.querySelector('.info-horaire-details');
         const pseudoChauffeur = document.querySelector('.pseudo-modal');
         const note = document.querySelector('.note-chiffre');
         const vehicule = document.querySelector('.nom-vehicule');
         const badgeEnergie = document.querySelector('.badge-energie');
         const reservationBtn = document.querySelector('.btn-reservation-eco');
         // Mise à jour des éléments du modal avec les données du trajet
        photoChauffeur.src = trajet.photo || '/Photo profile/default.png';
        pseudoChauffeur.textContent = `${trajet.conducteur}`;
        note.textContent = trajet.note;
        villeDepart.textContent = trajet.depart;
        villeArrivee.textContent = trajet.arrivee;

        const heureA = trajet.heureArrivee ? formatHeure(trajet.heureArrivee) : '--h--';
        horraireTrajet.textContent = `Départ à ${formatHeure(trajet.heureDepart)} - Arrivée prévue à ${heureA}`;

        nombrePlaces.textContent = `${trajet.passagers}`;
        prixPersonne.textContent = `${trajet.prix}`;
        vehicule.textContent = `Véhicule : ${trajet.ecologique ? 'Écologique' : 'Thermique'}`;

        // Gestion visuelle de l'énergie 
        badgeEnergie.textContent = trajet.ecologique ? 'Électrique' : 'Thermique';
        badgeEnergie.className = trajet.ecologique ? 'badge-energie badge-electrique' : 'badge-energie badge-thermique';

        // Mise à jour du bouton de réservation
         const boutonReservation = document.querySelector('.btn-reservation-eco');
                boutonReservation.setAttribute('data-trajet-id', trajet.id);

     const avisDuTrajet = baseDeDonneesAvis[trajet.id] || [];
    const conteneurAvis = document.querySelector('#collapseAvis .card-body');

    // Construction du HTML à partir des vraies données
    if (avisDuTrajet.length > 0) {
        conteneurAvis.innerHTML = avisDuTrajet.map(avis => `
            <div class="mb-2 border-bottom pb-1">
                <strong>${avis.auteur} :</strong> "${avis.texte}"
            </div>
        `).join('');
    } else {
        conteneurAvis.innerHTML = "<p>Aucun avis pour le moment.</p>";
    }
    }

    // Travaille sur les détaisl des trajets (modal)
    conteneurTrajets.addEventListener('click', event => {
        if (event.target.classList.contains('btn-details')) {
            const trajetId = parseInt(event.target.getAttribute('data-trajet-id'));
            const trajet = mockData.find(t => t.id === trajetId);
            
            if (trajet) {
            afficherDetailsTrajet(trajet);      
        }
        
        }
    });

    // Eouteur d'événement pour les filtres de la barre de recherche
    barreRecherche.addEventListener('submit', appliquerFiltres);
    // Eouteur d'événement pour les filtres avancés
    formulaireFiltres.addEventListener('input', appliquerFiltres);

    appliquerFiltres();
});