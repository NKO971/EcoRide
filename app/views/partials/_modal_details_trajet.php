<?php
// Sécurité : s'assurer que la variable $trajet existe avant d'afficher
if (isset($trajet)): 
    // On récupère l'ID de manière sécurisée selon ce que renvoie la BDD (id ou trajet_id)
    $trajetId = (int)($trajet['id'] ?? $trajet['trajet_id'] ?? 0);
?>
<div class="modal fade" id="modalDetailsTrajet-<?php echo $trajetId; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header border-0">
                <h5 class="modal-title bold">Détails du voyage</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="recap-trajet-modal mb-4 p-3 text-center">
                    <span class="v-depart bold"><?php echo htmlspecialchars($trajet['depart'] ?? $trajet['lieu_depart'] ?? 'Non renseigné'); ?></span>
                    <span class="material-symbols-outlined icone-fleche">arrow_forward</span>
                    <span class="v-arrivee bold"><?php echo htmlspecialchars($trajet['arrivee'] ?? $trajet['lieu_arrivee'] ?? 'Non renseigné'); ?></span>
                    <div class="info-horaire-details">
                        Départ à <span><?php 
                            $hDepart = $trajet['heureDepart'] ?? $trajet['heure_depart'] ?? '';
                            echo is_numeric($hDepart) ? sprintf("%02dh%02d", floor($hDepart/60), $hDepart%60) : htmlspecialchars($hDepart); 
                        ?></span> 
                        - Arrivée prévue à <span><?php 
                            $hArrivee = $trajet['heureArrivee'] ?? $trajet['heure_arrivee'] ?? '';
                            echo is_numeric($hArrivee) ? sprintf("%02dh%02d", floor($hArrivee/60), $hArrivee%60) : htmlspecialchars($hArrivee); 
                        ?></span>
                        le <span><?php echo htmlspecialchars($trajet['date'] ?? $trajet['date_depart'] ?? '--/--/----'); ?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 border-end">
                        <div class="info-conducteur d-flex align-items-center gap-3 mb-3">
                            <img src="<?php echo !empty($trajet['photo']) ? htmlspecialchars($trajet['photo']) : '/EcoRide/Photo profile/default.png'; ?>"
                                alt="<?php echo htmlspecialchars($trajet['conducteur'] ?? 'Chauffeur'); ?>" class="photoDeProfil-details">
                            <div class="conducteur-meta">
                                <h4 class="pseudo-modal m-0"><?php echo htmlspecialchars($trajet['conducteur'] ?? $trajet['pseudo_chauffeur'] ?? 'Anonyme'); ?></h4>
                                <div class="note-container">
                                    <span class="material-symbols-outlined">star</span>
                                    <span class="note-chiffre"><?php echo htmlspecialchars($trajet['note'] ?? $trajet['note_chauffeur'] ?? 'N/A'); ?>/5</span>
                                </div>
                            </div>
                        </div>
                        
                        <button class="btn btn-outline-primary btn-sm mb-3" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseAvis-<?php echo $trajetId; ?>" aria-expanded="false">
                            Voir les commentaires
                        </button>

                        <div class="collapse" id="collapseAvis-<?php echo $trajetId; ?>">
                            <div class="card card-body bg-light border-0 mb-3 p-2" style="font-size: 0.85rem;">
                                <div class="text-muted">Aucun commentaire pour ce chauffeur.</div>
                            </div>
                        </div>

                        <div class="preferences-zone">
                            <p class="titre-pref">Préférences :</p>
                            <p class="texte-pref">
                                <span class="badge bg-light text-dark mb-1">
                                    <?php echo (!empty($trajet['accepte_fumeurs']) || !empty($trajet['fumeur'])) ? '🚬 Fumeurs acceptés' : '🚭 Non fumeur'; ?>
                                </span>
                                <span class="badge bg-light text-dark mb-1">
                                    <?php echo (!empty($trajet['accepte_animaux']) || !empty($trajet['animaux'])) ? '🐾 Animaux acceptés' : '🚫 Pas d\'animaux'; ?>
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6 ps-md-4">
                        <h6 class="bold mb-3">Véhicule</h6>
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="material-symbols-outlined">
                                <?php echo (($trajet['energie'] ?? '') === 'Électrique' || !empty($trajet['ecologique'])) ? 'electric_car' : 'directions_car'; ?>
                            </span>
                            <span class="nom-vehicule"><?php echo htmlspecialchars(($trajet['marque'] ?? '') . ' ' . ($trajet['modele'] ?? 'Véhicule')); ?></span>
                        </div>
                        <div class="badge-energie"><?php echo !empty($trajet['ecologique']) ? 'Électrique' : htmlspecialchars($trajet['energie'] ?? 'Thermique'); ?></div>
                        <hr class="separation-modal">
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="places-restantes">
                                Places restantes : <strong><?php echo (int)($trajet['passagers'] ?? $trajet['nb_place'] ?? 0); ?></strong>
                            </div>
                            <div class="prix-credits">
                                <span><?php echo htmlspecialchars($trajet['prix'] ?? $trajet['prix_personne'] ?? '0'); ?></span> Crédits
                            </div>
                        </div>
                        <p class="prix-place">Prix pour une place !</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer border-0">
                <form method="POST" action="?page=reserver_trajet">
                    <input type="hidden" name="covoiturage_id" value="<?php echo $trajetId; ?>">
                    <button type="submit" class="btn-reservation-eco">
                        Participer au trajet
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>