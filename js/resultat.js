document.addEventListener('DOMContentLoaded', () => {
    // MOCK DATA: des données pour les filtres
    const mockData = [
        { id: 1, conducteur: "Jean Dupont", note: 4.5, verifie: true, depart: "Paris", arrivee: "Toulouse", heureDepart: 630, date: "2026-05-24", prix: 5, passagers: 2, ecologique: true },
        { id: 2, conducteur: "Marie Curie", note: 3, verifie: false, depart: "Lyon", arrivee: "Marseille", heureDepart: 840, date: "2026-05-25", prix: 10, passagers: 1, ecologique: false }
    ];

    // Constantes pour les éléments du DOM
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
                    <div class="heure_depart">${trajet.heureDepart}</div>
                    <div class="FlechesH">
                        <span class="material-symbols-outlined">line_end_arrow_notch</span>
                    </div>
                    <div class="heure_arrivee">${trajet.heureArrivee || '--h--'}</div>
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

    // APPEL DE LA FONCTION
    afficherTrajets(mockData);

    // TRAVAILLE SUR LES FILTRES

}); // FIN DU DOMContentLoaded (Il manquait cette fermeture !)