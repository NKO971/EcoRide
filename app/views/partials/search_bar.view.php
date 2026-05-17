<div class="col-12 col-md-8 col-lg-2 mx-auto">
    <label for="lieu_depart" class="visually-hidden">Ville de départ</label>
    <input type="text" 
        placeholder="Départ" 
        id="lieu_depart" 
        name="lieu_depart"
        value="<?php echo isset($_GET['lieu_depart']) ? htmlspecialchars($_GET['lieu_depart']) : ''; ?>" 
        class="form-control"
        aria-label="Ville de départ">
</div>

<div class="col-12 col-md-8 col-lg-2 mx-auto">
    <label for="lieu_arrivee" class="visually-hidden">Ville d'arrivée</label>
    <input type="text" 
        placeholder="Arrivée" 
        id="lieu_arrivee" 
        name="lieu_arrivee"
        value="<?php echo isset($_GET['lieu_arrivee']) ? htmlspecialchars($_GET['lieu_arrivee']) : ''; ?>" 
        class="form-control"
        aria-label="Ville d'arrivée">
</div>

<div class="col-12 col-md-8 col-lg-2 mx-auto">
    <label for="date_depart" class="visually-hidden">Date du trajet</label>
    <input type="date" 
        id="date_depart" 
        name="date_depart" 
        value="<?php echo isset($_GET['date_depart']) ? htmlspecialchars($_GET['date_depart']) : ''; ?>"
        class="date form-control"
        aria-label="Date du trajet">
</div>