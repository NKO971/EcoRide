document.addEventListener('DOMContentLoaded', () => {
    const barreRecherche = document.querySelector('.barreRecherche');
    const lieuDepartInput = document.getElementById('lieu_depart');
    const lieuArriveeInput = document.getElementById('lieu_arrivee');
    const dateDepartInput = document.getElementById('date_depart');
    const messageErreur = document.getElementById('message-erreur');

    // Logique de lecture
  function initializeSearchBar() {
    if (window.location.pathname.endsWith('/HTML/resultat.html')) {
        const estUneRecherche = localStorage.getItem('recherche_effectuee') === 'true';

        if (estUneRecherche) {
            // On récupère les valeurs
            lieuDepartInput.value = localStorage.getItem('lieu_depart') || '';
            lieuArriveeInput.value = localStorage.getItem('lieu_arrivee') || '';
            dateDepartInput.value = localStorage.getItem('date_depart') || '';

            // IMPORTANT : On réinitialise l'indicateur pour éviter qu'il ne reste bloqué
            localStorage.setItem('recherche_effectuee', 'false');
        } else {
            // Pas de recherche, on vide explicitement
            lieuDepartInput.value = '';
            lieuArriveeInput.value = '';
            dateDepartInput.value = '';
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
        if (lieuDepartInput.value.trim() === '' || lieuArriveeInput.value.trim() === '' || dateDepartInput.value.trim() === '') {
            messageErreur.classList.remove('d-none')
        } else {
            messageErreur.classList.add('d-none');
            localStorage.setItem('lieu_depart', lieuDepartInput.value);
            localStorage.setItem('lieu_arrivee', lieuArriveeInput.value);
            localStorage.setItem('date_depart', dateDepartInput.value);

        // Indique que la recherche a été effectuée
            localStorage.setItem('recherche_effectuee', 'true');

            // Redirection vers la page de résultats
            window.location.href = '/HTML/resultat.html';
        }
    });
    }

    // Appel de la fonction d'initialisation
    initializeSearchBar();

});