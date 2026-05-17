document.addEventListener('DOMContentLoaded', () => {
    // MOCK DATA: Si la variable globale "trajetsDepuisBDD" existe (transmise par PHP), on l'utilise, sinon on part d'un tableau vide
    const mockData = window.trajetsDepuisBDD || [];

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

        // On s'assure que les input ne sont pas vides
        if (!departSaisi || !arriveeSaisie || !dateSaisie) {
            // On ne montre l'erreur "champs vides" que si l'utilisateur a tenté de soumettre
            if(event && event.type === 'submit') messageErreur.classList.remove('d-none');
            conteneurTrajets.innerHTML = '';
            nbVoyagesTrouves.textContent = 0;
            return; 
        }

        // Filtrer d'abord uniquement par VILLES
        let trajetsMêmesVilles = mockData.filter(trajet => 
            trajet.depart.toLowerCase().includes(departSaisi) && 
            trajet.arrivee.toLowerCase().includes(arriveeSaisie)
        );

        // Filtrer par DATE sur ces villes
        let trajetsFiltres = trajetsMêmesVilles.filter(trajet => trajet.date === dateSaisie);

        // LOGIQUE DE REPLI (FALLBACK)
        if (trajetsFiltres.length === 0 && trajetsMêmesVilles.length > 0) {
            const dateSaisieTimestamp = new Date(dateSaisie).getTime();
            
            // On trie les trajets des mêmes villes par proximité
            trajetsFiltres = [...trajetsMêmesVilles].sort((a, b) => {
                const diffA = Math.abs(new Date(a.date).getTime() - dateSaisieTimestamp);
                const diffB = Math.abs(new Date(b.date).getTime() - dateSaisieTimestamp);
                return diffA - diffB;
            });
            // On affiche le message de suggestion de trajets proches
            messageErreurDate.classList.remove('d-none');
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
    // Eouteur d'événement pour les filtres de la barre de recherche
   // Écouteur pour la barre de recherche (sécurisé)
    if (barreRecherche) {
        barreRecherche.addEventListener('submit', appliquerFiltres);
    }

    // Écouteur pour les filtres avancés (sécurisé)
    if (formulaireFiltres) {
        formulaireFiltres.addEventListener('input', appliquerFiltres);
    }

    // On lance enfin l'affichage global !
    appliquerFiltres();
});