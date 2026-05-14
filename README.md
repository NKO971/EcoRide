# 🌍 EcoRide - Plateforme de Covoiturage Éco-responsable

**EcoRide** est une application web de covoiturage éco-responsable développée avec **PHP, HTML5, CSS3 et JavaScript**, conçue pour réduire l'impact environnemental des déplacements en encourageant le partage de trajets.

## 📋 Table des Matières
- [À propos](#à-propos)
- [Fonctionnalités](#-fonctionnalités)
- [Stack Technique](#-stack-technique)
- [Installation](#-installation)
- [Structure du Projet](#-structure-du-projet)
- [Pages Développées](#-pages-développées)
- [Guide Utilisateur](#-guide-utilisateur)
- [État d'Avancement](#-état-davancement)
- [Roadmap](#-roadmap)

---

## À propos

EcoRide permet à :
- **👥 Visiteurs** : Chercher et consulter les trajets disponibles
- **🚗 Passagers** : Réserver une place dans un trajet
- **🔑 Chauffeurs** : Proposer des trajets et gérer leurs réservations
- **👔 Employés** : Valider les avis et gérer les litiges
- **👨‍💼 Administrateurs** : Gérer la plateforme et consulter les statistiques

### Objectifs
✅ Réduire les émissions de CO₂  
✅ Créer une communauté de conducteurs et passagers  
✅ Favoriser les trajets partagés sécurisés  
✅ Système de crédits/points de confiance  

---

## 🎯 Fonctionnalités

### ✅ Fonctionnalités Développées
- ✅ **Interface responsive** - Mobile, Tablet, Desktop (Bootstrap 5)
- ✅ **Système de navigation** - Menu sticky avec dropdown
- ✅ **Barre de recherche avancée** - Recherche de trajets (départ, arrivée, date)
- ✅ **Page d'accueil** - Présentation et call-to-action
- ✅ **Formulaire de connexion** - Design intégré
- ✅ **Formulaire d'inscription** - Capture de données utilisateur
- ✅ **Espace utilisateur** - Profil et gestion personnelle
- ✅ **Formulaire de contact** - Page support/contact
- ✅ **Espace employé** - Interface de modération
- ✅ **Espace administrateur** - Tableau de bord
- ✅ **Système de crédits** - Badge dans le menu
- ✅ **Design System CSS** - Variables CSS, cohérence visuelle

### 🔄 Fonctionnalités en Progression
- 🔄 Validation de formulaires JavaScript
- 🔄 Système de filtres avancés
- 🔄 Historique des trajets
- 🔄 Système d'avis et notations

### ⏳ Fonctionnalités À Venir (Backend)
- ⏳ Authentification sécurisée (JWT)
- ⏳ Base de données (Utilisateurs, Trajets, Réservations)
- ⏳ API REST
- ⏳ Gestion des réservations
- ⏳ Système de messaging
- ⏳ Notifications en temps réel

---

## 🛠️ Stack Technique

### Frontend ✅ (Développé)
```
HTML5
├─ Structure sémantique et accessible
├─ Formulaires interactifs
└─ Meta tags responsive

CSS3
├─ Variables CSS (couleurs, espacements, typographie)
├─ Flexbox & Grid
├─ Media Queries (mobile-first)
├─ Animations et transitions
└─ Bootstrap 5 intégré

JavaScript
├─ Validation de formulaires
├─ Gestion des événements
├─ DOM manipulation
├─ jQuery 3.7.1 (utilitaires)
└─ Modules modulaires (contact.js, connexion.js, etc.)

Dépendances
├─ Bootstrap 5.x
├─ jQuery 3.7.1
├─ Google Fonts (Montserrat)
└─ Material Symbols Icons
```

### Backend ⏳ (À implémenter)
**Stack recommandé :**
```
Runtime: PHP 8.0+
├─ Framework: Laravel (recommandé) ou Symfony
├─ Base de données: MySQL/PostgreSQL
├─ Authentification: Sessions PHP + Bcrypt
└─ ORM: Eloquent (Laravel) ou Doctrine
```

**Alternative :**
```
Runtime: Node.js 16+
├─ Framework: Express.js
├─ Base de données: PostgreSQL/MongoDB
├─ Authentification: JWT + Bcryptjs
├─ ORM: Prisma ou Sequelize
└─ Validation: Joi ou Zod
```

---

## 🚀 Installation

### Prérequis
- **XAMPP** (PHP 8.0+, Apache, MySQL)
- **Navigateur moderne** (Chrome, Firefox, Safari, Edge)
- **Git** (optionnel)

### Démarrage Rapide

1. **Cloner/Télécharger le projet**
```bash
# Via Git
git clone <repository-url> EcoRide

# Ou extraire l'archive dans:
C:\XAMPP\htdocs\EcoRide
```

2. **Accéder à l'application**
```
http://localhost/EcoRide
ou
http://localhost/EcoRide/HTML/EcoRide_Accueil.php
```

3. **Naviguer dans l'application**
- Cliquez sur les liens du menu
- Testez les formulaires
- Vérifiez la responsivité (F12 → Mode responsive)

### Configuration (optionnel)
```bash
# Créer un fichier de configuration
cp config/db.php.example config/db.php

# Éditer config/db.php avec vos paramètres
nano config/db.php
```

---

## ⚡ Démarrage Rapide

### 1. Accès à l'application (Frontend)
```
URL locale : http://localhost/EcoRide
ou
Port personnalisé : http://localhost:8080/EcoRide
```

### 2. Navigation principale
```
Accueil → Recherche → Inscription/Connexion → Réservation → Profil
```

### 3. Comptes de test (à créer au backend)
```
Admin:
- Email: admin@ecoride.com
- Mot de passe: Admin123!

Employé:
- Email: employe@ecoride.com
- Mot de passe: Emp123!

Utilisateur:
- Email: user@ecoride.com
- Mot de passe: User123!
```

### 4. Points de contrôle frontend
- [ ] Menu sticky s'affiche correctement
- [ ] Barre de recherche est fonctionnelle
- [ ] Formulaires s'affichent sans erreurs (F12 → Console)
- [ ] Page responsive sur mobile (F12 → 375px)
- [ ] Liens de navigation fonctionnent

---

## ❓ FAQ (Questions Fréquentes)

### Q1: Comment démarrer le projet en local?
**R:** Placez le dossier dans `C:\XAMPP\htdocs\EcoRide` et accédez à `http://localhost/EcoRide`

### Q2: Où sont les bases de données?
**R:** À créer. Consultez la section [Modèle de Base de Données](#🗄️-modèle-de-base-de-données) pour le schéma SQL.

### Q3: Comment modifier les couleurs du design?
**R:** Éditez `css/base.css` et modifiez les variables CSS (section `:root` au début du fichier).

### Q4: Où ajouter des icônes?
**R:** Utilisez les Material Symbols Icons (lien CDN dans `includes/header.php`).

### Q5: Comment valider un formulaire?
**R:** Consultez `js/connexion.js` ou `js/contact.js` pour les exemples de validation JavaScript.

### Q6: Quel navigateur utiliser?
**R:** Chrome, Firefox, Safari ou Edge (versions récentes). IE 11 non supporté.

### Q7: La page n'affiche pas le CSS?
**R:** Vérifiez que les chemins CSS sont corrects : `<link href="/EcoRide/css/base.css">`

### Q8: Comment créer une nouvelle page?
**R:** 
1. Créer le fichier dans `app/views/` (ex: `nouveau.view.php`)
2. Créer le contrôleur dans `app/controllers/` (ex: `nouveau_controller.php`)
3. Ajouter la route dans `public/index.php`
4. Inclure le header et footer

### Q9: Où trouver les images?
**R:** Dossier `Image/` pour les assets généraux, `Photo profile/` pour les photos de profil.

### Q10: Comment améliorer la performance?
**R:** 
- Minifier CSS/JS en production
- Compresser les images
- Implémenter un système de cache
- Utiliser un CDN pour les dépendances

---

## 📁 Structure du Projet

```
EcoRide/
│
├── 📄 README.md                      # Documentation principale (ce fichier)
├── 📄 ANALYSE_PROJET_ECF.md         # Analyse détaillée du projet
├── 📄 index.php                     # Point d'entrée principal
│
├── 📂 public/                        # ✅ Point d'entrée web
│   └── index.php                    # Routeur principal (MVC)
│
├── 📂 app/                           # ✅ Logique applicative
│   ├── 📂 api/                      # ⏳ Endpoints REST (à créer)
│   │   ├── auth.php
│   │   ├── trajets.php
│   │   ├── users.php
│   │   └── reservations.php
│   │
│   ├── 📂 config/                   # ⏳ Configuration
│   │   └── db.php                  # Paramètres base de données
│   │
│   ├── 📂 controllers/              # ✅ Contrôleurs MVC
│   │   ├── home_controller.php      # Page d'accueil
│   │   ├── auth_controller.php      # Authentification
│   │   ├── search_controller.php    # Recherche trajets
│   │   ├── covoiturage_controller.php # Gestion trajets
│   │   ├── profile_controller.php   # Profil utilisateur
│   │   ├── contact_controller.php   # Contact/support
│   │   ├── employee_controller.php  # Espace employé
│   │   ├── admin_controller.php     # Admin dashboard
│   │   └── legal_controller.php     # Mentions légales
│   │
│   ├── 📂 models/                   # ✅ Modèles de données
│   │   ├── User.php                 # Modèle Utilisateur
│   │   ├── Contact.php              # Modèle Contact
│   │   └── (Trajet.php, Reservation.php - à créer)
│   │
│   └── 📂 views/                    # ✅ Vues/Templates
│       ├── home.view.php            # Page d'accueil
│       ├── connexion.view.php       # Connexion
│       ├── inscription.view.php     # Inscription
│       ├── search.view.php          # Résultats recherche
│       ├── covoiturage.view.php     # Détail trajet
│       ├── profile.view.php         # Profil utilisateur
│       ├── contact.view.php         # Contact
│       ├── employee.view.php        # Espace employé
│       ├── admin.view.php           # Admin dashboard
│       ├── mention.view.php         # Mentions légales
│       └── (connexion-inscription.view.php, etc.)
│
├── 📂 css/                           # ✅ Feuilles de style
│   ├── base.css                     # Styles généraux + variables CSS
│   ├── style.css                    # Styles spécifiques
│   ├── connexion-inscription.css    # Formulaires auth
│   ├── contact.css                  # Page contact
│   ├── espace_utilisateur.css       # Profil utilisateur
│   ├── espace-employe.css           # Interface employé
│   ├── resultat.css                 # Résultats recherche
│   ├── mediaquerise_base.css        # Responsive design mobile
│   └── bootstrap.min.css            # Framework Bootstrap 5
│
├── 📂 js/                            # ✅ Scripts JavaScript
│   ├── jquery-3.7.1.min.js          # Bibliothèque jQuery
│   ├── bootstrap.bundle.min.js      # Bootstrap JavaScript
│   ├── barreDeRecherche.js          # Barre de recherche
│   ├── connexion.js                 # Validation connexion
│   ├── contact.js                   # Gestion formulaire contact
│   ├── resultat.js                  # Résultats recherche
│   ├── EspaceUtilisateur.js         # Profil utilisateur
│   ├── espace-employe.js            # Interface employé
│   ├── admin.js                     # Admin dashboard
│   └── evenement.js                 # Gestion événements
│
├── 📂 includes/                      # ✅ Composants réutilisables (PHP)
│   ├── header.php                   # En-tête + navigation
│   ├── header_admin.php             # Header admin
│   ├── header_employe.php           # Header employé
│   ├── footer.php                   # Pied de page
│   ├── verif_role.php               # Middleware vérification rôle
│   └── deconnexion.php              # Gestion déconnexion
│
├── 📂 Image/                         # 📸 Ressources images
│   └── (logos, icônes, etc.)
│
├── 📂 Photo profile/                 # 👤 Photos de profil utilisateurs
├── 📂 Profile/                       # 📁 Données de profil
│
└── 📂 database/                      # 🗄️ Fichiers SQL (à créer)
    ├── schema.sql                   # Schéma de base de données
    ├── seed.sql                     # Données d'exemple
    └── migrations/                  # Historique migrations
```

### Hiérarchie MVC Simplifiée
```
Request (index.php)
    ↓
Router → Controller (app/controllers/)
    ↓
Model (app/models/) ← Database
    ↓
View (app/views/)
    ↓
Response (HTML/JSON)
```

---

## 🔧 Contrôleurs et Modèles

### Contrôleurs Implémentés (✅)
| Contrôleur | Fichier | Rôle | Statut |
|-----------|---------|------|--------|
| **HomeController** | `home_controller.php` | Page d'accueil | ✅ Complet |
| **AuthController** | `auth_controller.php` | Connexion/Inscription | ⚠️ Frontend seul |
| **SearchController** | `search_controller.php` | Recherche trajets | ⚠️ Frontend seul |
| **CovoiturageController** | `covoiturage_controller.php` | Gestion trajets | ⚠️ Frontend seul |
| **ProfileController** | `profile_controller.php` | Profil utilisateur | ⚠️ Frontend seul |
| **ContactController** | `contact_controller.php` | Support/contact | ⚠️ Frontend seul |
| **EmployeeController** | `employee_controller.php` | Espace employé | ⚠️ Frontend seul |
| **AdminController** | `admin_controller.php` | Admin dashboard | ⚠️ Frontend seul |

### Modèles Implémentés (✅)
| Modèle | Fichier | Champs | Statut |
|--------|---------|--------|--------|
| **User** | `User.php` | id, email, mot_passe, role | ⚠️ Basique |
| **Contact** | `Contact.php` | id, nom, email, message | ⚠️ Basique |
| **Trajet** | (À créer) | id, conducteur_id, depart, arrivee, date, places | ❌ Manquant |
| **Reservation** | (À créer) | id, trajet_id, passager_id, statut | ❌ Manquant |
| **Avis** | (À créer) | id, auteur_id, cible_id, note, commentaire | ❌ Manquant |

### Fonctionnalités par Contrôleur

#### 1. AuthController (Authentification)
```php
// Méthodes à implémenter :
register()      → Créer nouvel utilisateur
login()         → Vérifier identifiants
logout()        → Déconnexion
isAuthenticated() → Vérifier session active
getCurrentUser() → Récupérer user connecté
```

#### 2. SearchController (Recherche)
```php
// Méthodes à implémenter :
search($depart, $arrivee, $date) → Trouver trajets
getTrajets()   → Récupérer tous les trajets
getTrajetById($id) → Détail d'un trajet
filter($params) → Filtrer par critères
```

#### 3. CovoiturageController (Trajets)
```php
// Méthodes à implémenter :
create($data)      → Créer trajet
update($id, $data) → Modifier trajet
delete($id)        → Supprimer trajet
join($trajet_id)   → Rejoindre trajet
leave($trajet_id)  → Quitter trajet
```

#### 4. ProfileController (Profil)
```php
// Méthodes à implémenter :
getProfile($user_id) → Récupérer profil
updateProfile($data) → Modifier infos
getTrajetsUser()    → Mes trajets
getReservations()   → Mes réservations
getAvis()          → Mes avis
```

#### 5. EmployeeController (Modération)
```php
// Méthodes à implémenter :
getAvisEnAttente()  → Avis non validés
validateAvis($id)   → Valider avis
rejectAvis($id)    → Rejeter avis
getDisputes()      → Litiges signalés
resolveDispute($id) → Résoudre litige
```

#### 6. AdminController (Administration)
```php
// Méthodes à implémenter :
getDashboard()     → Statistiques globales
getUsers()         → Liste utilisateurs
bannUser($id)      → Bannir utilisateur
getStatistics()    → Rapports
exportData()       → Export données
```

---

## 🗄️ Modèle de Base de Données

### Schéma proposé (à implémenter)

```sql
-- Table Utilisateurs
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    mot_passe VARCHAR(255) NOT NULL,
    role ENUM('user', 'employee', 'admin') DEFAULT 'user',
    photo_profil VARCHAR(255),
    bio TEXT,
    note_moyenne DECIMAL(3,2) DEFAULT 0,
    credits INT DEFAULT 100,
    statut ENUM('actif', 'suspendu', 'banni') DEFAULT 'actif',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table Trajets
CREATE TABLE trajets (
    id INT PRIMARY KEY AUTO_INCREMENT,
    conducteur_id INT NOT NULL,
    depart VARCHAR(100) NOT NULL,
    arrivee VARCHAR(100) NOT NULL,
    date_depart DATETIME NOT NULL,
    places_disponibles INT NOT NULL,
    prix_par_personne DECIMAL(10,2) NOT NULL,
    description TEXT,
    statut ENUM('disponible', 'complet', 'annule') DEFAULT 'disponible',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (conducteur_id) REFERENCES users(id)
);

-- Table Réservations
CREATE TABLE reservations (
    id INT PRIMARY KEY AUTO_INCREMENT,
    trajet_id INT NOT NULL,
    passager_id INT NOT NULL,
    statut ENUM('en_attente', 'confirmee', 'annulee') DEFAULT 'en_attente',
    date_reservation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (trajet_id) REFERENCES trajets(id),
    FOREIGN KEY (passager_id) REFERENCES users(id)
);

-- Table Avis
CREATE TABLE avis (
    id INT PRIMARY KEY AUTO_INCREMENT,
    auteur_id INT NOT NULL,
    cible_id INT NOT NULL,
    note INT CHECK (note BETWEEN 1 AND 5),
    commentaire TEXT,
    statut ENUM('en_attente', 'valide', 'rejete') DEFAULT 'en_attente',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (auteur_id) REFERENCES users(id),
    FOREIGN KEY (cible_id) REFERENCES users(id)
);

-- Table Messages de Contact
CREATE TABLE messages_contact (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    sujet VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    statut ENUM('non_lu', 'lu', 'traite') DEFAULT 'non_lu',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table Signalements
CREATE TABLE signalements (
    id INT PRIMARY KEY AUTO_INCREMENT,
    auteur_id INT NOT NULL,
    cible_id INT NOT NULL,
    raison VARCHAR(200) NOT NULL,
    description TEXT,
    statut ENUM('en_attente', 'en_cours', 'resolu') DEFAULT 'en_attente',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (auteur_id) REFERENCES users(id),
    FOREIGN KEY (cible_id) REFERENCES users(id)
);
```

### Descriptions des Champs

**Utilisateurs (users)**
- `role` : Détermine les permissions (user/employee/admin)
- `credits` : Points de confiance/crédits covoiturage
- `note_moyenne` : Moyenne des avis reçus
- `statut` : Compte actif, suspendu ou banni

**Trajets (trajets)**
- `statut` : Disponible, complet ou annulé
- `places_disponibles` : Nombre de places restantes
- `prix_par_personne` : Tarif pour un passager

**Réservations (reservations)**
- `statut` : En attente de confirmation, confirmée ou annulée
- Relation N-M entre trajets et utilisateurs

**Avis (avis)**
- `statut` : Les avis sont modérés avant publication
- `note` : Entre 1 et 5 étoiles
- Les employés valident les avis

---

## 🌐 Pages Développées

### 1. **Page d'Accueil** - `EcoRide_Accueil.php` ✅
- Navigation sticky avec dropdown "Mon compte"
- Barre de recherche avancée (Départ, Arrivée, Date)
- Sections : Bienvenue, Fonctionnement, Avantages
- Formulaire de contact intégré
- Footer avec liens

### 2. **Connexion** - `connexion.php` ✅
- Formulaire de connexion
- Lien vers inscription
- Design responsive
- Validation côté client

### 3. **Inscription** - `inscription.php` ✅
- Formulaire d'inscription complet
- Champs : Nom, Prénom, Email, Mot de passe, etc.
- Conditions d'utilisation
- Lien vers connexion

### 4. **Résultats de Recherche** - `resultat.php` ✅
- Liste de trajets trouvés
- Filtres avancés
- Information trajet (départ, arrivée, date, prix, places)
- Détails du conducteur

### 5. **Espace Utilisateur** - `Espace_utilisateur.php` ✅
- Profil utilisateur (photo, infos)
- Mes trajets (créés et réservations)
- Historique de trajets
- Gestion des crédits
- Paramètres du compte

### 6. **Formulaire de Contact** - `contact.php` ✅
- Formulaire de support
- Champs : Nom, Email, Message
- Validation JavaScript
- Responsive design

### 7. **Espace Employé** - `espace-employe.php` ⚠️
- Interface de modération
- Validation des avis
- Gestion des litiges
- Tableau d'actions

### 8. **Admin Dashboard** - `admin.php` ⚠️
- Statistiques globales
- Gestion utilisateurs
- Modération contenu
- Rapports et analytiques

---

## 💡 Guide Utilisateur

### Pour un Visiteur
1. Accédez à la page d'accueil
2. Utilisez la barre de recherche pour trouver un trajet
3. Consultez les résultats
4. Créez un compte pour réserver

### Pour un Utilisateur (Passager)
1. Inscrivez-vous via `inscription.php`
2. Connectez-vous
3. Recherchez un trajet via la barre de recherche
4. Consultez les détails et réservez
5. Accédez à votre profil pour voir vos trajets

### Pour un Chauffeur
1. Inscrivez-vous en tant que chauffeur
2. Accédez à l'espace utilisateur
3. Créez un nouveau trajet
4. Gérez les réservations

### Pour un Employé
1. Accédez à `espace-employe.php`
2. Consultez les avis en attente
3. Validez ou rejetez les contenus
4. Gérez les litiges

### Pour un Admin
1. Accédez à `admin.php`
2. Consultez les statistiques
3. Gérez les utilisateurs
4. Modérez le contenu
5. Générez des rapports

---

## 📊 État d'Avancement

### Résumé Global
```
Frontend:      ████████████░░░░░░░░  65%
JavaScript:    ██████░░░░░░░░░░░░░░  30%
Backend:       ░░░░░░░░░░░░░░░░░░░░   0%
Base de données: ░░░░░░░░░░░░░░░░░░░░  0%
─────────────────────────────────────────
TOTAL:         ████░░░░░░░░░░░░░░░░  17%
```

### Détail par Composant

| Composant | État | Complétude | Notes |
|-----------|------|-----------|-------|
| **Pages HTML** | ✅ | 100% | 8 pages créées et responsive |
| **CSS & Design** | ✅ | 95% | Design system cohérent, variables CSS |
| **JavaScript** | ⚠️ | 30% | Modules créés, validation à améliorer |
| **Frontend Global** | ⅔ | 65% | Interface utilisateur complète |
| **Backend/PHP** | ❌ | 0% | À développer |
| **Base de Données** | ❌ | 0% | À créer |
| **API REST** | ❌ | 0% | À développer |
| **Authentification** | ❌ | 0% | À implémenter |
| **Tests** | ❌ | 0% | À faire |
| **Documentation** | ⚠️ | 50% | ANALYSE_PROJET_ECF.md + README |

---

## 🚀 Roadmap (Prochaines Étapes)

### Phase 1 - Backend Fondamental (Semaine 1-2)
```
Priority: CRITIQUE ⚠️

✓ Structurer le projet PHP
  ├─ Créer /api pour endpoints REST
  ├─ Créer /classes pour modèles
  ├─ Créer /controllers pour logique métier
  └─ Créer .env pour configuration

✓ Base de données
  ├─ Créer schéma SQL
  ├─ Tables: users, trajets, reservations, avis
  └─ Migrations

✓ Authentification
  ├─ Endpoint POST /api/auth/register
  ├─ Endpoint POST /api/auth/login
  ├─ Hashage Bcrypt
  └─ Sessions PHP
```

### Phase 2 - API CRUD (Semaine 2-3)
```
✓ API Trajets
  ├─ GET /api/trajets (liste avec filtres)
  ├─ GET /api/trajets/:id (détail)
  ├─ POST /api/trajets (créer)
  ├─ PUT /api/trajets/:id (modifier)
  └─ DELETE /api/trajets/:id (supprimer)

✓ API Utilisateurs
  ├─ GET /api/users/:id (profil)
  ├─ PUT /api/users/:id (mettre à jour)
  └─ GET /api/users/:id/trajets

✓ API Réservations
  ├─ POST /api/trajets/:id/rejoindre
  ├─ GET /api/utilisateur/mes-reservations
  └─ DELETE /api/reservations/:id
```

### Phase 3 - JavaScript Avancé (Semaine 3-4)
```
✓ Validation côté client
  ├─ Formulaire inscription
  ├─ Formulaire connexion
  ├─ Formulaire recherche
  └─ Formulaire trajet

✓ Intégration API
  ├─ Fetch/AJAX depuis formulaires
  ├─ Gestion des réponses
  ├─ Messages d'erreur
  └─ Redirection utilisateur

✓ Gestion d'état
  ├─ localStorage pour session
  ├─ Cookie auth token
  └─ Affichage conditionnel (connecté/déconnecté)
```

### Phase 4 - Fonctionnalités Avancées (Semaine 4+)
```
✓ Système d'avis
  ├─ Créer/lire/modifier avis
  ├─ Notation (1-5 étoiles)
  └─ Affichage sur profil

✓ Système de crédits/points
  ├─ Attribution crédits
  ├─ Déduction réservation
  └─ Historique transactions

✓ Notifications
  ├─ Email confirmation
  ├─ Nouvelle réservation
  └─ Modération avis

✓ Modération & Admin
  ├─ Interface validation avis
  ├─ Dashboard statistiques
  └─ Gestion utilisateurs
```

---

## 🔧 Défis Connus & À Résoudre

### 🔴 Critique
1. **Backend inexistant** - Doit être créé de zéro
2. **Pas de base de données** - Schéma à définir
3. **Pas d'authentification réelle** - Sessions factices

### 🟠 Important
1. **JavaScript incomplet** - Validation partielle
2. **Pas de connexion API** - Formulaires déconnectés
3. **Pas de persistance des données** - Données perdues au refresh

### 🟡 À Améliorer
1. **Code JavaScript à optimiser** - Structure modulaire incomplète
2. **CSS à refactoriser** - Réduction de la redondance
3. **Tests manquants** - Couverture 0%

---

## 📝 Guide de Contribution

### Avant de Commencer
1. Clonez le repository
2. Créez une branche feature : `git checkout -b feature/nom-feature`
3. Consultez ANALYSE_PROJET_ECF.md pour le contexte

### Convention de Code

#### Frontend (HTML/CSS/JS)
```
Classes CSS:     kebab-case  (form-input, btn-primary, navbar-sticky)
IDs JavaScript:  camelCase   (contactForm, userDropdown, searchBtn)
Fichiers CSS:    nom-page.css (connexion-inscription.css)
Fichiers JS:     camelCase.js (contactForm.js, userProfile.js)

Exemple:
<div id="userProfile" class="user-card">
    <button id="editBtn" class="btn btn-primary">Éditer</button>
</div>
```

#### Backend (PHP)
```
Classes PHP:     PascalCase  (User, UserController, TrajetService)
Fichiers PHP:    PascalCase.php (User.php, Trajet.php)
Méthodes:        camelCase   (getUserById, createTrajet, updateProfile)
Constantes:      UPPER_SNAKE_CASE (MAX_PLACES, PRIX_DEFAUT)

Exemple:
class UserController {
    public function getUserById($id) {
        return User::find($id);
    }
}
```

#### Nommage Git
```
Types de commits:
- feat:  Nouvelle fonctionnalité        [feat] add search filters
- fix:   Correction de bug              [fix] contact form validation  
- docs:  Documentation                  [docs] update README
- style: Formatage (CSS, indentation)   [style] format CSS variables
- refac: Refactorisation                [refac] simplify form logic
- test:  Tests                          [test] add unit tests
- chore: Maintenance                    [chore] update dependencies

Format: [type] brève description

Exemple: git commit -m "[feat] add user authentication system"
```

### Tests Avant Commit

#### ✅ Tester Frontend
```
1. Responsive Design (F12)
   ✓ Mobile (375px) - Pas de scroll horizontal
   ✓ Tablet (768px) - Layouts adaptés
   ✓ Desktop (1200px+) - Tous les éléments visibles

2. Formulaires
   ✓ Validation côté client fonctionne
   ✓ Messages d'erreur s'affichent
   ✓ Soumission prévue fonctionne

3. Navigation
   ✓ Tous les liens fonctionnent
   ✓ Menu sticky opérationnel
   ✓ Dropdown "Mon compte" fonctionne

4. Console (F12 → Console)
   ✓ Pas d'erreurs JavaScript
   ✓ Pas d'avertissements critiques
   ✓ Pas de 404 sur ressources
```

#### ✅ Tester Backend (Futur)
```
1. Authentification
   - [ ] Register avec email valide
   - [ ] Login avec bons identifiants
   - [ ] Logout fonctionne
   - [ ] Sessions persistent

2. Recherche
   - [ ] Recherche par départ/arrivée
   - [ ] Filtres appliqués correctement
   - [ ] Pas d'injection SQL

3. Sécurité
   - [ ] Mots de passe hashés
   - [ ] CSRF token validé
   - [ ] Rôles/permissions respectés
```

### Code Review Checklist

Avant de faire une Pull Request, vérifiez:
- [ ] Code indenté correctement (4 espaces ou 2 espaces)
- [ ] Pas de variables non utilisées
- [ ] Pas de code commenté (à supprimer ou documenter)
- [ ] Fonctions commentées avec leur but
- [ ] Pas de secrets (mots de passe, clés API) en dur
- [ ] Tests existants passent
- [ ] Nouvelle fonctionnalité a des tests
- [ ] Documentation mise à jour si nécessaire
- [ ] Commits cohérents et bien nommés

---

## 🧪 Tester l'Application

### Tests Manuels - Utilisateur Normal
```
1. Parcourir la page d'accueil
2. Chercher un trajet (remplir le formulaire de recherche)
3. S'inscrire avec un nouvel email
4. Se connecter
5. Consulter le profil
6. Accéder à l'espace utilisateur
7. Envoyer un message contact
```

### Tests Manuels - Employé
```
1. Se connecter avec rôle employé
2. Accéder à /app/views/employee.view.php
3. Valider/rejeter des avis
4. Voir les signalements
```

### Tests Manuels - Admin
```
1. Se connecter avec rôle admin
2. Accéder à /app/views/admin.view.php
3. Consulter les statistiques
4. Gérer les utilisateurs
5. Voir les rapports
```

### Tests Navigateur
| Navigateur | Version | Status |
|-----------|---------|--------|
| Chrome    | 120+    | ✅ Supporté |
| Firefox   | 118+    | ✅ Supporté |
| Safari    | 17+     | ✅ Supporté |
| Edge      | 120+    | ✅ Supporté |
| IE 11     | -       | ❌ Non supporté |

---

## ⚙️ Configuration et Variables d'Environnement

### Fichier .env (À créer au backend)
```
# Base de données
DB_HOST=localhost
DB_PORT=3306
DB_NAME=ecoride
DB_USER=root
DB_PASSWORD=password

# Serveur
SERVER_PORT=5000
APP_ENV=development
APP_DEBUG=true

# JWT
JWT_SECRET=votre_clé_secrète_très_sécurisée_min_32_caractères
JWT_EXPIRY=7d

# Email
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USER=votre_email@mailtrap.io
MAIL_PASSWORD=votre_mot_de_passe
MAIL_FROM=noreply@ecoride.com

# Paiement (Futur)
STRIPE_KEY=sk_test_...
STRIPE_PUBLIC=pk_test_...

# Session
SESSION_TIMEOUT=3600
SESSION_SECRET=votre_secret_session
```

### Configuration Locale XAMPP
```php
// config/db.php
<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'ecoride');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}
?>
```

---

## 🛠️ Commandes Utiles

### Serveur Local
```bash
# Démarrer XAMPP (Windows)
C:\xampp\xampp-control.exe

# Vérifier PHP depuis terminal
php -v

# Serveur PHP intégré (alternative à XAMPP)
php -S localhost:8000 -t .

# Voir les erreurs PHP
tail -f /Applications/XAMPP/xamppfiles/logs/error_log  # Mac/Linux
```

### Git
```bash
# Initialiser repository
git init

# Cloner un repository
git clone https://github.com/username/ecoride.git

# Créer une branche
git checkout -b feature/ma-feature

# Voir l'historique
git log --oneline --graph --all

# Stash (sauvegarder temporairement)
git stash
git stash pop

# Rebase (réorganiser commits)
git rebase -i HEAD~3
```

### Database (MySQL)
```bash
# Accéder à MySQL
mysql -u root -p

# Créer une base de données
CREATE DATABASE ecoride;

# Importer un fichier SQL
mysql -u root -p ecoride < database/schema.sql

# Exporter la base
mysqldump -u root -p ecoride > backup.sql
```

### JavaScript / Frontend
```bash
# Minifier JavaScript
npm install -g terser
terser js/main.js -o js/main.min.js

# Valider HTML
npm install -g html-validator
html-validator --file index.html

# Serveur HTTP simple
python -m http.server 8000
python3 -m http.server 8000
```

---

##  Ressources & Documentation

### Documentation Interne
- [ANALYSE_PROJET_ECF.md](ANALYSE_PROJET_ECF.md) - Analyse complète
- [README.md](README.md) - Ce fichier

### Technologies Utilisées
- **HTML5** - [MDN Web Docs](https://developer.mozilla.org/fr/docs/Web/HTML)
- **CSS3** - [MDN Web Docs](https://developer.mozilla.org/fr/docs/Web/CSS)
- **JavaScript** - [MDN Web Docs](https://developer.mozilla.org/fr/docs/Web/JavaScript)
- **Bootstrap 5** - [Documentation](https://getbootstrap.com/docs/5.0/)
- **PHP 8** - [Documentation Officielle](https://www.php.net/docs.php)
- **MySQL** - [Documentation](https://dev.mysql.com/doc/)

### Outils Recommandés
```
Développement:
├─ VS Code + Extensions (PHP Intelephense, ES7+)
├─ XAMPP pour le serveur local
├─ Postman pour tester les API
├─ Git & GitHub pour versionning
└─ MySQL Workbench pour la base de données

Design:
├─ Figma pour les maquettes
├─ ColorHunt pour palettes
└─ Material Icons pour icônes
```

---

## 👨‍💻 Équipe et Informations Projet

| Aspect | Détail |
|--------|--------|
| **Développeur** | Luidgi |
| **Formation** | Développeur Web et Web Mobile - Studi |
| **Type** | Évaluation en Cours de Formation (ECF) |
| **Durée estimée** | 70 heures |
| **Statut** | 🔨 En développement (Frontend 65%, Backend 0%) |
| **Repository** | Public GitHub |
| **Licence** | MIT |

### Équipe de Développement

| Rôle | Responsable | Status |
|------|-------------|--------|
| Frontend Lead | Luidgi | 🟢 Actif (65% complété) |
| Backend Lead | [À assigner] | 🟡 À venir |
| Database Admin | [À assigner] | 🟡 À venir |
| QA/Testing | [À assigner] | 🔴 Non commencé |

---

## 📞 Support & Contact

### Informations Projet
- **Nom**: EcoRide - Plateforme de Covoiturage Éco-responsable
- **Type**: Application Web Full-Stack (PHP/MySQL)
- **Objectif**: Réduire l'impact environnemental via le partage de trajets

### Questions sur le Projet
- 📧 Email: [À définir]
- 💬 Discord: [À définir]
- 📋 Issues: Créer une issue GitHub
- 📝 Documentation: Voir [ANALYSE_PROJET_ECF.md](ANALYSE_PROJET_ECF.md)

### Signaler un Bug
```
Titre: [BUG] Brève description
Description:
- Navigateur utilisé: Chrome 120, Firefox 118, etc.
- Étapes pour reproduire: Étape 1, Étape 2, ...
- Résultat attendu vs réel: Ce qui devrait arriver vs ce qui arrive
- Screenshots si pertinent: Joindre image
- Console errors (F12): Copier les erreurs
```

### Proposer une Feature
```
Titre: [FEATURE] Brève description
Description:
- Cas d'usage: Quoi et pourquoi?
- Bénéfice utilisateur: Qu'est-ce que l'utilisateur gagne?
- Effort estimé: Petit / Moyen / Grand
- Priorité: Basse / Moyenne / Haute
- Dépendances: Y a-t-il d'autres features requises?
```

### Contribuer
1. **Fork** le repository
2. **Clonez** votre fork: `git clone <your-fork-url>`
3. **Créez** une branche feature: `git checkout -b feature/ma-feature`
4. **Commitez** vos changements: `git commit -m "[feat] description"`
5. **Pushez**: `git push origin feature/ma-feature`
6. **Créez** une Pull Request

---

## 📄 License & Données Légales

Ce projet est développé dans le cadre d'une **Évaluation en Cours de Formation (ECF)** pour [Formation ECF].

**Licence**: MIT - Libre d'utilisation

### Mentions Légales (À remplir)
- Voir [mentions-legales](app/views/mention.view.php)
- Conditions générales d'utilisation: [À créer]
- Politique de confidentialité: [À créer]
- Charte graphique: [À créer - PDF]
- Manuel d'utilisateur: [À créer - PDF]

---

## 🌱 Impacts Environnementaux

**EcoRide vise à :**
- ♻️ Réduire les émissions CO₂ de 40% par covoiturage
- 🌍 Créer une communauté éco-consciente
- 📊 Tracker l'impact environnemental de chaque trajet
- 🎁 Récompenser les utilisateurs pour actions éco-responsables
- 📱 Accéder facilement via web et futur mobile

### Calcul d'Impact
```
Exemple: Trajet Paris → Lyon (460 km)
- Voiture seule: ~92 kg CO₂
- EcoRide (4 passagers): ~23 kg CO₂/personne
- Économie: ~75% d'émissions réduites
```

---

## 📚 Livrables ECF Requis

Avant de soumettre le projet, s'assurer que:

- [ ] ✅ Dépôt GitHub PUBLIC avec code complet
- [ ] ✅ Application déployée et fonctionnelle (URL)
- [ ] ✅ Gestion de projet documentée (Jira/Notion/Trello/GitHub Projects)
- [ ] ✅ README.md avec instructions d'installation
- [ ] ✅ Bonnes pratiques Git (branches, commits, pull requests)
- [ ] ✅ Fichiers SQL (création schema + données test)
- [ ] ✅ Manuel d'utilisation (PDF)
- [ ] ✅ Charte graphique et Design System (PDF)
- [ ] ✅ Documentation technique (architecture, API, etc.)
- [ ] ✅ Documentation gestion de projet (PDF)
- [ ] ✅ Tests fonctionnels et rapports
- [ ] ✅ Sécurité implémentée (hashage, JWT, validation)

---

## 📊 Statistiques du Projet

### Métriques de Code
```
Frontend:
├─ Pages: 8 fichiers PHP
├─ CSS: 9 fichiers (~2000+ lignes)
├─ JavaScript: 9 fichiers (~1500+ lignes)
└─ HTML: 8 pages responsive

Backend: À créer
├─ Contrôleurs: 8
├─ Modèles: 5
├─ Routes API: 20+
└─ Tests: À implémenter

Database:
├─ Tables: 7 (users, trajets, reservations, avis, etc.)
├─ Indices: À définir
└─ Migrations: À créer
```

### Timeline Estimée
```
Phase 1 (Semaine 1-2): Backend fondamental
├─ Structure PHP
├─ Base de données
└─ Authentification

Phase 2 (Semaine 3-4): API CRUD
├─ Endpoints trajets
├─ Endpoints utilisateurs
└─ Endpoints réservations

Phase 3 (Semaine 5-6): Fonctionnalités avancées
├─ Système d'avis
├─ Crédits/points
├─ Notifications
└─ Modération

Phase 4 (Semaine 7-8): Tests et déploiement
├─ Tests unitaires
├─ Tests d'intégration
├─ Déploiement
└─ Documentation finale
```

---

## 🎓 Notes pour les Évaluateurs

### Points Forts du Projet
✅ Frontend complet et responsive  
✅ Design system cohérent avec variables CSS  
✅ Architecture MVC bien structurée  
✅ Modèles PHP pour gestion de données  
✅ JavaScript modulaire et séparé par fonctionnalité  
✅ Bootstrap 5 pour composants professionnels  
✅ Documentation détaillée et complète  

### Points à Améliorer
⚠️ Backend à développer complètement  
⚠️ Base de données à créer et implémenter  
⚠️ Authentification sécurisée à ajouter  
⚠️ Tests unitaires et d'intégration à écrire  
⚠️ Déploiement en production à finaliser  

### Défis Relever
1. Sécurité: Hashage, JWT, CSRF protection
2. Performance: Cache, optimisation images
3. Scalabilité: Structure pour croissance future
4. Maintenabilité: Code clean et bien documenté

---

## 🤝 Workflow Git et Contribution

### Workflow Git recommandé
```bash
# Créer une branche de feature
git checkout -b feature/US-X-description

# Faire vos modifications
git add .
git commit -m "feat: description de la feature"

# Pusher vers développement
git push origin feature/US-X-description

# Créer une Pull Request vers 'develop'
# Une fois approuvée, merger vers develop
# Après test, merger develop vers main
```

### Branches
- `main` - Production (stable)
- `develop` - Développement (en cours)
- `feature/*` - Nouvelles fonctionnalités
- `bugfix/*` - Corrections de bugs

---

## ✅ Checklist Avant Soumission ECF

- [ ] Backend fonctionnel et testé
- [ ] Toutes les 13 US implémentées
- [ ] Sécurité : validation, hashage, tokens
- [ ] Tests unitaires et d'intégration
- [ ] Documentation complète
- [ ] Code déployé et fonctionnel
- [ ] GitHub public avec bonnes pratiques
- [ ] Fichiers SQL fournis
- [ ] Manuel d'utilisation PDF
- [ ] Charte graphique PDF
- [ ] Tous les livrables remis

---

## 🎓 Ressources Utiles

- [Bootstrap 5 Documentation](https://getbootstrap.com/docs/5.0/)
- [Express.js Guide](https://expressjs.com/)
- [MongoDB Documentation](https://docs.mongodb.com/)
- [JWT Introduction](https://jwt.io/introduction)
- [MDN Web Docs](https://developer.mozilla.org/)
- [PHP Documentation](https://www.php.net/manual/fr/)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [Git Guide](https://git-scm.com/doc)

---

## 📈 Progression du Projet

```
Juin 2026 ├─ Frontend Alpha ........................ 65% ✅
         ├─ Backend Développement ................ 0%  ⏳
         ├─ Database Implémentation ............. 0%  ⏳
         ├─ Tests & QA ........................... 0%  ⏳
         └─ Déploiement .......................... 0%  ⏳
```

**Dernière mise à jour**: 19 janvier 2026  
**Version**: 0.65.0 (Frontend Alpha)  
**Statut**: 🔨 En développement  

---

**© 2026 EcoRide - Tous droits réservés | Développé par Luidgi**

