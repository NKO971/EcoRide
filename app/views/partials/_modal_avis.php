<div class="modal fade text-dark" id="modalAvis<?php echo $trajet['covoiturage_id']; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Votre avis sur le trajet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="?page=profile&action=soumettre-avis" method="POST">
                <div class="modal-body text-start">
                    <input type="hidden" name="covoiturage_id" value="<?php echo $trajet['covoiturage_id']; ?>">
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">Le trajet s'est-il bien passé ?</label>
                        <select class="form-select" name="deroulement">
                            <option value="OK">Oui, tout s'est bien passé</option>
                            <option value="KO">Non, il y a eu un problème</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label for="rangeNote<?php echo $trajet['covoiturage_id']; ?>" class="form-label fw-bold mb-0">
                                Note globale :
                            </label>
                            <span id="badgeNote<?php echo $trajet['covoiturage_id']; ?>" class="badge bg-primary fs-6">3 / 5</span>
                        </div>
                        
                        <input type="range" class="form-range" min="0" max="5" step="0.5" value="3" 
                               name="note" id="rangeNote<?php echo $trajet['covoiturage_id']; ?>"
                               oninput="document.getElementById('badgeNote<?php echo $trajet['covoiturage_id']; ?>').innerText = this.value + ' / 5'">
                        
                        <div class="d-flex justify-content-between text-muted small px-1">
                            <span>0 (Inacceptable)</span>
                            <span>5 (Excellent)</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Votre commentaire :</label>
                        <textarea class="form-control" name="commentaire" rows="3" placeholder="Partagez votre expérience..." required></textarea>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary btn-sm">Envoyer mon avis</button>
                </div>
            </form>
        </div>
    </div>
</div>