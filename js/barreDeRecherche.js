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
                // On récupère les valeurs depuis localStorage avec les clés mappées au MCD
                lieuDepartInput.value = localStorage.getItem('lieu_depart') || '';
                lieuArriveeInput.value = localStorage.getItem('lieu_arrivee') || '';
                dateDepartInput.value = localStorage.getItem('date_depart') || '';

                // IMPORTANT : On réinitialise l'indicateur pour éviter qu'il ne reste bloqué
                localStorage.setItem('recherche_effectuee', 'false');

                console.log("✅ Barre de recherche initialisée avec les données sauvegardées");
            } else {
                // Pas de recherche, on vide explicitement
                lieuDepartInput.value = '';
                lieuArriveeInput.value = '';
                dateDepartInput.value = '';
                console.log("🔄 Barre de recherche vidée (pas de recherche précédente)");
            }
        }
    }

    // Écouteur pour cacher le message d'erreur dès la saisie
    if (lieuDepartInput) {
        lieuDepartInput.addEventListener('input', () => {
            messageErreur.classList.add('d-none');
        });
    }

    if (lieuArriveeInput) {
        lieuArriveeInput.addEventListener('input', () => {
            messageErreur.classList.add('d-none');
        });
    }

    if (dateDepartInput) {
        dateDepartInput.addEventListener('input', () => {
            messageErreur.classList.add('d-none');
        });
    }

    // Logique d'écriture - Soumission du formulaire
    if (barreRecherche) {
        barreRecherche.addEventListener('submit', (event) => {
            event.preventDefault(); // Empêche le rechargement de la page

            // Vérification que tous les champs sont remplis
            if (lieuDepartInput.value.trim() === '' || 
                lieuArriveeInput.value.trim() === '' || 
                dateDepartInput.value.trim() === '') {
                
                messageErreur.classList.remove('d-none');
                console.log("⚠️ Validation échouée : un ou plusieurs champs sont vides");
            } else {
                // Tous les champs sont remplis
                messageErreur.classList.add('d-none');

                // Sauvegarde des données dans localStorage avec clés mappées au MCD
                localStorage.setItem('lieu_depart', lieuDepartInput.value.trim());
                localStorage.setItem('lieu_arrivee', lieuArriveeInput.value.trim());
                localStorage.setItem('date_depart', dateDepartInput.value.trim());

                // Indique que la recherche a été effectuée
                localStorage.setItem('recherche_effectuee', 'true');

                console.log("💾 Données de recherche sauvegardées :", {
                    lieu_depart: lieuDepartInput.value.trim(),
                    lieu_arrivee: lieuArriveeInput.value.trim(),
                    date_depart: dateDepartInput.value.trim()
                });

                // Redirection vers la page de résultats
                console.log("➡️ Redirection vers /HTML/resultat.html");
                window.location.href = '/HTML/resultat.html';
            }
        });
    }

    // Appel de la fonction d'initialisation
    initializeSearchBar();

});