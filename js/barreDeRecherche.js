document.addEventListener('DOMContentLoaded', () => {
    const barreRecherche = document.querySelector('.barreRecherche');
    const lieuDepartInput = document.getElementById('lieu_depart');
    const lieuArriveeInput = document.getElementById('lieu_arrivee');
    const dateDepartInput = document.getElementById('date_depart');
    const messageErreur = document.getElementById('message-erreur');

    // Logique de lecture
    function initializeSearchBar() {
        // Récupération des données stockées
        const stockDepart = localStorage.getItem('lieu_depart');
        const stockArrivee = localStorage.getItem('lieu_arrivee');
        const stockDate = localStorage.getItem('date_depart');

        if (window.location.pathname.endsWith('/HTML/resultat.html')) {
            if (stockDepart) {
                lieuDepartInput.value = stockDepart;
            }
            if (stockArrivee) {
                lieuArriveeInput.value = stockArrivee;
            }
            if (stockDate) {
                dateDepartInput.value = stockDate;
            }
        }
    }

    // Ces écouteurs surveillent la saisie en direct
    if (lieuDepartInput) {
        lieuDepartInput.addEventListener('input', () => {
            messageErreur.classList.add('d-none'); // Cache l'erreur dès qu'on tape
        });
    }

    // Logique d'écriture
    if (barreRecherche) {
        barreRecherche.addEventListener('submit', (event) => {
            event.preventDefault(); // Empêche le rechargement de la page
        if (lieuDepartInput.value.trim() === '' || lieuArriveeInput.value.trim() === '') {
            messageErreur.classList.remove('d-none')
        } else {
            messageErreur.classList.add('d-none');
            localStorage.setItem('lieu_depart', lieuDepartInput.value);
            localStorage.setItem('lieu_arrivee', lieuArriveeInput.value);
            localStorage.setItem('date_depart', dateDepartInput.value);

            // Redirection vers la page de résultats
            window.location.href = '/HTML/resultat.html';
        }
    });
    }

    // Appel de la fonction d'initialisation
    initializeSearchBar();

});