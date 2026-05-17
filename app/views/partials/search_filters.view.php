<h2>Trier par</h2>

<div class="conteneurFiltre">
    <input type="checkbox" id="plus-rapide" name="plus-rapide" <?php echo isset($_GET['plus-rapide']) ? 'checked' : ''; ?>>
    <label for="plus-rapide"> Le plus rapide.</label>
</div>
<div class="conteneurFiltre">
    <input type="checkbox" id="plus-ecologique" name="plus-ecologique" <?php echo isset($_GET['plus-ecologique']) ? 'checked' : ''; ?>>
    <label for="plus-ecologique">Le plus écologique.</label>
</div>

<div class="conteneurFiltre">
    <label for="prix-max">Prix max :</label>
    <input class="prixDuree" type="number" id="prix-max" name="prix-max" value="<?php echo isset($_GET['prix-max']) ? htmlspecialchars($_GET['prix-max']) : ''; ?>">
</div>
<div class="conteneurFiltre">
    <label for="duree-max">Durée max (h) :</label>
    <input class="prixDuree" type="number" id="duree-max" name="duree-max" value="<?php echo isset($_GET['duree-max']) ? htmlspecialchars($_GET['duree-max']) : ''; ?>">
</div>

<div class="separation-2"></div>

<h2>Horaires</h2>
<div class="conteneurFiltre">
    <input type="checkbox" id="avant-6h" name="avant-6h" <?php echo isset($_GET['avant-6h']) ? 'checked' : ''; ?>>
    <label for="avant-6h">Avant 6 h 00</label>
</div>
<div class="conteneurFiltre">
    <input type="checkbox" id="entre-6h-12" name="entre-6h-12" <?php echo isset($_GET['entre-6h-12']) ? 'checked' : ''; ?>>
    <label for="entre-6h-12">6 h 00 - 12 h 00</label>
</div>
<div class="conteneurFiltre">
    <input type="checkbox" id="entre-12h-18h" name="entre-12h-18h" <?php echo isset($_GET['entre-12h-18h']) ? 'checked' : ''; ?>>
    <label for="entre-12h-18h">12 h 00 - 18 h 00</label>
</div>
<div class="conteneurFiltre">
    <input type="checkbox" id="apres-18h" name="apres-18h" <?php echo isset($_GET['apres-18h']) ? 'checked' : ''; ?>>
    <label for="apres-18h">Après 18 h 00</label>
</div>

<div class="separation-2"></div>

<h2>Sécurité</h2>
<div class="conteneurFiltre">
    <input type="checkbox" id="profile-verifie" name="profile-verifie" <?php echo isset($_GET['profile-verifie']) ? 'checked' : ''; ?>>
    <label for="profile-verifie">Profil vérifié</label>
</div>
<div class="conteneurFiltre">
    <input type="checkbox" id="note-superieur-a-3" name="note-superieur-a-3" <?php echo isset($_GET['note-superieur-a-3']) ? 'checked' : ''; ?>>
    <label for="note-superieur-a-3">Note > 3 étoiles</label>
</div>