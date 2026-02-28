document.addEventListener('DOMContentLoaded', () => {
    // MOCK DATA: des données pour les filtres
    const mockData = [
        { id: 1, conducteur: "Jean Dupont", photo: "/Photo profile/freepik__the-style-is-candid-image-photography-with-natural__82878.png", note: 4.5, verifie: true, depart: "Paris", arrivee: "Toulouse", heureDepart: 630, heureArrivee: 967, date: "2026-05-24", prix: 5, passagers: 2, ecologique: true },
        { id: 2, conducteur: "Marie Curie", photo: "/Photo profile/freepik__the-style-is-candid-image-photography-with-natural__82877.png", note: 3, verifie: false, depart: "Lyon", arrivee: "Marseille", heureDepart: 840, heureArrivee: 990, date: "2026-05-25", prix: 10, passagers: 1, ecologique: false },
        { id: 3, conducteur: "Alice Martin", photo: "/Photo profile/freepik__the-style-is-candid-image-photography-with-natural__82879.png", note: 4.8, verifie: true, depart: "Bordeaux", arrivee: "Nantes", heureDepart: 240, heureArrivee: 400, date: "2026-05-26", prix: 7, passagers: 3, ecologique: true },
    ];

    // Constantes pour les éléments du DOM
    const formulaireFiltres = document.querySelector('.filtre');
    // Cble ID
    const conteneurTrajets = document.getElementById('liste-trajet');
    const inputDepart = document.getElementById('lieu_depart');
    const inputArrivee = document.getElementById('lieu_arrivee');
    const inputDate = document.getElementById('date_depart');
    const nbVoyagesTrouves = document.getElementById('nb-voyages-trouve');
    const listeFiltre = document.getElementById('zoneFiltres');
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
        conteneurTrajets.innerHTML = ''; // On vide le conteneur avant d'ajouter

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
                    <div class="FlechesH">
                        <span class="material-symbols-outlined">line_end_arrow_notch</span>
                    </div>
                    <div class="heure_arrivee">${trajet.heureArrivee ? formatHeure(trajet.heureArrivee) : '--h--'}</div>
                    <div class="FlechesH">
                        <span class="material-symbols-outlined">line_end_arrow_notch</span>
                    </div>
                    <div class="date_arrivee">${trajet.date}</div>
                </div>
                <div class="ligneDeSeparation">
                    <hr />
                </div>
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
                        <span class="material-symbols-outlined">
                            ${trajet.ecologique ? 'electric_car' : 'directions_car'}
                        </span>
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
    } // FIN DE LA FONCTION afficherTrajets

    // Initialisation du nombre de voyages trouvés
    nbVoyagesTrouves.textContent = mockData.length; // A adapter selon les résultats réels post DB 

    // TRAVAILLE SUR LES FILTRES AVEC .filter
    function appliquerFiltres() {
        console.log("Moteur de recherche : Je lance le filtrage...");
        let trajetsFiltres = [...mockData];
        // On vérifie si une des case est cochée pour le filtre horaire
        const unFiltreHoraireActif = avant6H.checked || entre6H12H.checked || entre12H18H.checked || apres18H.checked;

        // PREPARATION DES VALEURS 
        const prixMaxValue = parseFloat(prixMax.value);
        const dureeSaisie = parseFloat(dureeMax.value); // On récupère l'heure ici une seule fois

        // FILTRE RAPIDITE
        if (plusRapide.checked) {
            trajetsFiltres.sort((a, b) => { 
                return (a.heureArrivee - a.heureDepart) - (b.heureArrivee - b.heureDepart);
            });
        }

        // FILTRE ECOLOGIQUE 
        if (plusEcologique.checked) {
            trajetsFiltres = trajetsFiltres.filter(trajet => trajet.ecologique === true);
        }

        // FILTRE PRIX 
        if (prixMax.value) {
            trajetsFiltres = trajetsFiltres.filter(trajet => trajet.prix <= prixMaxValue);
        }

        // FILTRE DUREE  
        if (dureeMax.value) { // On vérifie si la case n'est pas vide
            const minutesMaxSaisies = dureeSaisie * 60;// On convertie en minutes.
            trajetsFiltres = trajetsFiltres.filter(trajet => {
                const dureeReelle = trajet.heureArrivee - trajet.heureDepart;
                return dureeReelle <= minutesMaxSaisies;
            });
        }

        // FILTRE NOTE 
        if (notePlus3.checked) {
            trajetsFiltres = trajetsFiltres.filter(trajet => trajet.note > 3);
        }

        //FILTRE TRANCHE HORAIRE
        trajetsFiltres = trajetsFiltres.filter(trajet => {
            if (!unFiltreHoraireActif) return true;

            return (avant6H.checked && trajet.heureDepart < 360) ||
                (entre6H12H.checked && trajet.heureDepart >= 360 && trajet.heureDepart < 720) ||
                (entre12H18H.checked && trajet.heureDepart >= 720 && trajet.heureDepart < 1080) ||
                (apres18H.checked && trajet.heureDepart >= 1080);
        });

        // FILTRE PROFIL VERIFIE
        if (profilVerifie.checked) {
            trajetsFiltres = trajetsFiltres.filter(trajet => trajet.verifie === true);
        }

        // COMPTAGE DES VOYAGES TROUVES
        nbVoyagesTrouves.textContent = trajetsFiltres.length;

        afficherTrajets(trajetsFiltres);
    }

    formulaireFiltres.addEventListener('input', appliquerFiltres);
    
    // Affichage des trajets recherhés avec filtre 
    appliquerFiltres(); 
    


}); // FIN DU DOMContentLoaded