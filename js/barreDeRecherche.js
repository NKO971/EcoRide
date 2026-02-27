document.addEventListener('DOMContentLoaded', () => {
    const barreRecherche = document.querySelector('.barreRecherche');
    const lieuDepartInput = document.getElementById('lieu_depart');
    const lieuArriveeInput = document.getElementById('lieu_arrivee');
    const dateDepartInput = document.getElementById('date_depart');

    // Logique de lecture
    const stockDepart = localStorage.getItem('lieu_depart');
    const stockArrivee = localStorage.getItem('lieu_arrivee');
    const stockDate = localStorage.getItem('date_depart');

    if (window.location.pathname.endsWith('resultat.html')) {
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
    // Logique d'écriture
    if (barreRecherche) {
        barreRecherche.addEventListener('submit', (event) => {
            event.preventDefault(); // Empêche le rechargement de la page
            localStorage.setItem('lieu_depart', lieuDepartInput.value);
            localStorage.setItem('lieu_arrivee', lieuArriveeInput.value);
            localStorage.setItem('date_depart', dateDepartInput.value);
            
            // Redirection vers la page de résultats
            window.location.href = 'resultat.html';
        });
    }

});