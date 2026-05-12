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

## 📁 Structure du Projet

```
EcoRide/
│
├── 📄 README.md                      # Documentation principale
├── 📄 ANALYSE_PROJET_ECF.md         # Analyse détaillée du projet
│
├── 📂 HTML/                          # ✅ Pages PHP/HTML
│   ├── EcoRide_Accueil.php          # Page d'accueil
│   ├── connexion.php                # Connexion utilisateur
│   ├── inscription.php              # Inscription nouvelle compte
│   ├── contact.php                  # Formulaire de contact
│   ├── resultat.php                 # Résultats de recherche
│   ├── Espace_utilisateur.php       # Profil utilisateur
│   ├── espace-employe.php           # Interface employé
│   └── admin.php                    # Tableau de bord admin
│
├── 📂 CSS/                           # ✅ Feuilles de style
│   ├── base.css                     # Styles généraux + variables CSS
│   ├── style.css                    # Styles spécifiques pages
│   ├── connexion-inscription.css    # Formulaires
│   ├── contact.css                  # Page contact
│   ├── espace_utilisateur.css       # Profil utilisateur
│   ├── espace-employe.css           # Interface employé
│   ├── resultat.css                 # Résultats recherche
│   ├── mediaquerise_base.css        # Responsive design
│   └── bootstrap.min.css            # Framework Bootstrap 5
│
├── 📂 js/                            # ✅ Scripts JavaScript
│   ├── barreDeRecherche.js          # Logique barre de recherche
│   ├── connexion.js                 # Validation connexion
│   ├── contact.js                   # Gestion formulaire contact
│   ├── resultat.js                  # Dynamique résultats
│   ├── EspaceUtilisateur.js         # Gestion profil utilisateur
│   ├── espace-employe.js            # Interface employé
│   ├── admin.js                     # Admin dashboard
│   ├── evenement.js                 # Gestion événements
│   ├── jquery-3.7.1.min.js          # Bibliothèque jQuery
│   └── bootstrap.bundle.min.js      # Bootstrap JavaScript
│
├── 📂 includes/                      # ✅ Composants réutilisables
│   ├── header.php                   # En-tête + navigation
│   └── footer.php                   # Pied de page
│
├── 📂 config/                        # ⏳ Configuration
│   └── db.php                       # Paramètres base de données
│
├── 📂 Image/                         # 📸 Ressources images
├── 📂 Photo profile/                 # 👤 Photos de profil
├── 📂 Profile/                       # 👤 Données de profil
│
└── 📂 classes/                       # ⏳ Classes PHP (à créer)
    ├── User.php
    ├── Trajet.php
    ├── Reservation.php
    └── Avis.php
```

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
```
Frontend:
- Classes CSS: kebab-case (form-input, btn-primary)
- IDs JS: camelCase (contactForm, userDropdown)
- Fichiers CSS: nom-page.css

Backend (PHP):
- Classes: PascalCase (User, TrajetController)
- Fichiers: PascalCase.php (User.php, Trajet.php)
- Méthodes: camelCase (getUserById)

JavaScript:
- Classes: PascalCase (ContactForm, TrajetService)
- Fichiers: camelCase ou kebab-case

Commits: 
format: [type] description
Ex: [feat] add search filters | [fix] contact form JS | [docs] update README
```

### Tests Avant Commit
```bash
# 1. Vérifier responsive design (F12)
   ✓ Mobile (375px)
   ✓ Tablet (768px)
   ✓ Desktop (1200px)

# 2. Valider HTML
   ✓ Structure sémantique
   ✓ Pas d'erreurs console

# 3. Tester formulaires
   ✓ Validation côté client
   ✓ Messages d'erreur

# 4. Vérifier CSS
   ✓ Cohérence design system
   ✓ Pas de redondances
```

---

## 📚 Ressources & Documentation

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

## 👨‍💻 Équipe de Développement

| Rôle | Responsable | Status |
|------|-------------|--------|
| Frontend Lead | [À assigner] | 🟢 Actif |
| Backend Lead | [À assigner] | 🟡 À venir |
| Database Admin | [À assigner] | 🟡 À venir |
| QA/Testing | [À assigner] | 🔴 Non commencé |

---

## 📞 Support & Contact

### Questions sur le Projet
- 📧 Email: [À définir]
- 💬 Discord: [À définir]
- 📋 Issues: Créer une issue GitHub

### Signaler un Bug
```
Titre: [BUG] Brève description
Description:
- Navigateur utilisé
- Étapes pour reproduire
- Résultat attendu vs réel
- Screenshots si pertinent
```

### Proposer une Feature
```
Titre: [FEATURE] Brève description
Description:
- Cas d'usage
- Bénéfice utilisateur
- Effort estimé
- Priorité
```

---

## 📄 License

Ce projet est développé dans le cadre d'une **Évaluation en Cours de Formation (ECF)** pour [Formation ECF].

---

## 🌱 Impacts Environnementaux

**EcoRide vise à :**
- ♻️ Réduire les émissions CO₂ de 40% par covoiturage
- 🌍 Créer une communauté éco-consciente
- 📊 Tracker l'impact environnemental
- 🎁 Récompenser les utilisateurs éco-responsables

---

**Dernière mise à jour**: Mai 2026  
**Version**: 0.65.0 (Frontend Alpha)  
**Statut**: 🔨 En développement
├── README.md                        📝 (ce fichier)
├── .gitignore                       📝 (à créer)
├── ANALYSE_PROJET_ECF.md            ✅
└── .git/                            ✅ (repository initialisé)
```

---

## 🚀 Installation et Déploiement Local

### Prérequis
- Node.js >= 14
- NPM ou Yarn
- MongoDB ou PostgreSQL (selon choix)
- Git

### Frontend (Actuel)

Le frontend est en **fichiers statiques HTML/CSS/JS**. Pas d'installation nécessaire.

```bash
# Option 1 : Avec un serveur local simple
cd c:\Users\Luidgi\Desktop\EcoRide
python -m http.server 8000

# Puis accédez à: http://localhost:8000/HTML/EcoRide_Accueil.html
```

### Backend (À faire)

```bash
# Créer la structure
mkdir backend
cd backend

# Initialiser Node.js
npm init -y

# Installer les dépendances
npm install express mongoose bcryptjs jsonwebtoken dotenv cors express-validator nodemailer

# Créer fichier .env
touch .env

# Contenu du .env:
DB_HOST=mongodb://localhost:27017/ecoride
DB_USER=root
DB_PASS=password
JWT_SECRET=votre_secret_key_tres_securise
MAIL_HOST=smtp.mailtrap.io
MAIL_USER=votre_mail
MAIL_PASS=votre_password

# Démarrer le serveur
npm start
```

### Base de Données (À créer)

```bash
# Créer le fichier SQL de création
# Voir: database/schema.sql (à créer)

# Exécuter avec PostgreSQL
psql -U postgres -f database/schema.sql

# Ou avec MySQL
mysql -u root -p < database/schema.sql
```

---

## 📋 Tâches à Effectuer (Priorité)

### 🔴 URGENT - Semaine 1-2

- [ ] **Corriger le JavaScript**
  - [ ] Fixer contact.js (erreur document.getElementById)
  - [ ] Implémenter validation de formulaires
  - [ ] Ajouter gestion des événements

- [ ] **Initialiser le Backend**
  - [ ] Créer dossier `/backend`
  - [ ] Setup Node.js + Express
  - [ ] Configurer les bases de données
  - [ ] Créer la structure serveur

- [ ] **Implémenter l'Authentification**
  - [ ] Modèle User
  - [ ] Routes register/login/logout
  - [ ] JWT tokens
  - [ ] Middleware d'authentification
  - [ ] Hashage bcryptjs

### 🟠 IMPORTANT - Semaine 3

- [ ] **Créer les API endpoints**
  - [ ] GET `/api/trajets?depart=&arrivee=&date=` (recherche)
  - [ ] POST `/api/trajets` (créer trajet)
  - [ ] GET `/api/trajets/:id` (détail)
  - [ ] POST `/api/trajets/:id/rejoindre` (participer)
  - [ ] PUT `/api/users/:id` (profil utilisateur)

- [ ] **Implémenter la logique métier**
  - [ ] Système de crédits
  - [ ] Gestion des places
  - [ ] Validation des trajets
  - [ ] Calcul des prix

### 🟡 SECONDAIRE - Semaine 4-5

- [ ] **Fonctionnalités avancées**
  - [ ] Système d'avis/notes
  - [ ] Historique des trajets
  - [ ] Gestion des litiges
  - [ ] Notifications par email

- [ ] **Espace Employé & Admin**
  - [ ] Pages dédiées
  - [ ] Tableaux de bord
  - [ ] Graphiques (Chart.js)
  - [ ] Gestion des suspensions

### 📚 DOCUMENTATION - Semaine 5-6

- [ ] Créer README.md complet
- [ ] Créer manuel d'utilisation (PDF)
- [ ] Créer charte graphique (PDF)
- [ ] Créer documentation technique (PDF)
- [ ] Créer fichiers SQL
- [ ] Déployer l'application

---

## 🎨 Design System (CSS)

### Palette de couleurs
```css
--color-primary: #3498DB;     /* Bleu */
--color-success: #91ECB8;     /* Vert menthe (écologie) */
--color-dark: #2C3E50;        /* Gris foncé */
--color-light: #ECF0F1;       /* Gris clair */
--color-warning: #F39C12;     /* Orange */
--color-danger: #E74C3C;      /* Rouge */
```

### Typographie
```css
Font-family: Montserrat, sans-serif
Font-sizes: Variables CSS dans base.css
```

### Composants principaux
- Navbar sticky avec logo
- Barre de recherche multi-champs
- Cartes de trajets
- Formulaires validés
- Dropdown "Mon compte"
- Footer avec mentions légales

---

## 🔐 Sécurité (À implémenter)

- [ ] Hashage des mots de passe (bcryptjs)
- [ ] JWT tokens sécurisés
- [ ] Protection CSRF
- [ ] Protection XSS
- [ ] Sanitisation des inputs
- [ ] Validation côté serveur
- [ ] HTTPS en production
- [ ] CORS configuré
- [ ] Rate limiting
- [ ] Rôles et permissions (user/employee/admin)

---

## 📞 Contact & Support

**Nom :** Luidgi  
**Projet :** EcoRide - ECF Développeur Web  
**Formation :** Développeur Web et Web Mobile (Studi)  
**Durée estimée :** 70 heures  

### Livrables requis par l'ECF
1. ✅ Dépôt GitHub PUBLIC avec code
2. ✅ Application déployée (URL fonctionnelle)
3. ✅ Gestion de projet (Jira/Notion/Trello)
4. ✅ README.md avec instructions
5. ✅ Bonnes pratiques Git (branches, commits)
6. ✅ Fichiers SQL (création + données)
7. ✅ Manuel d'utilisation (PDF)
8. ✅ Charte graphique (PDF)
9. ✅ Documentation technique (PDF)
10. ✅ Documentation gestion de projet (PDF)

---

## 📝 Licence

MIT - Libre d'utilisation

---

## 🤝 Contribution

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

## 📚 Ressources utiles

- [Bootstrap 5 Documentation](https://getbootstrap.com/docs/5.0/)
- [Express.js Guide](https://expressjs.com/)
- [MongoDB Documentation](https://docs.mongodb.com/)
- [JWT Introduction](https://jwt.io/introduction)
- [MDN Web Docs](https://developer.mozilla.org/)

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

**Dernière mise à jour :** 19 janvier 2026  
**Statut :** En cours de développement 🚀

