# 🌍 EcoRide - Plateforme de Covoiturage Éco-responsable

## 📌 À propos du projet

**EcoRide** est une application web de covoiturage éco-responsable conçue pour réduire l'impact environnemental des déplacements en encourageant le partage de trajets.

La plateforme permet à :
- **Visiteurs** : Chercher et consulter les trajets disponibles
- **Passagers** : Réserver une place dans un trajet
- **Chauffeurs** : Proposer des trajets et gérer leurs réservations
- **Employés** : Valider les avis et gérer les litiges
- **Administrateurs** : Gérer la plateforme et consulter les statistiques

---

## 📊 État d'Avancement du Projet (ECF)

### Vue d'ensemble
```
Progrès global : 35% (Frontend majorité, Backend absent)

Frontend:
  ████████░░░░░░░░░░  40% (2/10 US complètes)

Backend:
  ░░░░░░░░░░░░░░░░░░  0% (0/10 US) ⚠️ CRITIQUE

Livrables:
  ░░░░░░░░░░░░░░░░░░  0% (0/10)

Sécurité:
  ░░░░░░░░░░░░░░░░░░  0%
```

### Progression par User Story (13 US)

| # | User Story | État | Frontend | Backend | Priorité |
|---|-----------|------|----------|---------|----------|
| 1 | Page d'accueil | ✅ 80% | ✅ | ⚠️ | P1 |
| 2 | Menu de l'application | ✅ 100% | ✅ | ✅ | P1 |
| 3 | Vue des covoiturages | ⚠️ 20% | ⚠️ | ❌ | P1 |
| 4 | Filtres des covoiturages | ❌ 0% | ❌ | ❌ | P1 |
| 5 | Vue détaillée d'un covoiturage | ❌ 0% | ❌ | ❌ | P1 |
| 6 | Participer à un covoiturage | ❌ 0% | ❌ | ❌ | P1 |
| 7 | Création de compte | ⚠️ 40% | ⚠️ | ❌ | P1 |
| 8 | Espace Utilisateur | ⚠️ 50% | ⚠️ | ❌ | P1 |
| 9 | Saisir un voyage | ❌ 0% | ❌ | ❌ | P1 |
| 10 | Historique des covoiturages | ❌ 0% | ❌ | ❌ | P2 |
| 11 | Démarrer et arrêter un covoiturage | ❌ 0% | ❌ | ❌ | P2 |
| 12 | Espace employé | ❌ 0% | ❌ | ❌ | P2 |
| 13 | Espace administrateur | ❌ 0% | ❌ | ❌ | P2 |

---

## 🛠️ Stack Technique (Proposée)

### Frontend (Actuellement implémenté)
- **HTML5** - Structure sémantique
- **CSS3** - Variables CSS, Flexbox, Grid, Media Queries
- **Bootstrap 5** - Framework CSS responsive
- **JavaScript** - Pour la dynamique (à compléter)
- **jQuery 3.7.1** - Utilitaires DOM

### Backend (À implémenter)
```
Option recommandée (Node.js):
- Node.js + Express.js
- MongoDB (NoSQL) + PostgreSQL (SQL)
- JWT pour l'authentification
- Bcryptjs pour le hashage des mots de passe
- Nodemailer pour les notifications
```

### Base de Données (À créer)
```
Modèles principaux:
- User (utilisateurs, chauffeurs, passagers)
- Trajet (trajets proposés)
- Reservation (participations)
- Avis (notes et commentaires)
- Vehicule (informations véhicules)
```

### Déploiement (À configurer)
- **Frontend :** Vercel, Netlify, ou GitHub Pages
- **Backend :** Fly.io, Heroku, Azure, ou Railway
- **Base de données :** MongoDB Atlas, Railway, ou Clever Cloud

---

## 📁 Structure du Projet

```
EcoRide/
├── HTML/
│   ├── EcoRide_Accueil.html      ✅ Complète
│   ├── Connexion.html             ⚠️ À finir
│   ├── inscription.html            ⚠️ À finir
│   ├── resultat.html               ⚠️ À dynamiser
│   ├── Espace_utilisateur.html     ⚠️ À dynamiser
│   ├── contact.html                ⚠️ À finir
│   └── [Pages à créer]
│       ├── detail-trajet.html      ❌
│       ├── espace-employe.html     ❌
│       └── espace-admin.html       ❌
│
├── css/
│   ├── base.css                    ✅ (variables, header, footer)
│   ├── style.css                   ✅ (pages générales)
│   ├── connexion-inscription.css   ✅ (formulaires auth)
│   ├── espace_utilisateur.css      ✅ (profil)
│   ├── resultat.css                ✅ (recherche)
│   ├── contact.css                 ✅ (formulaire)
│   ├── mediaquerise_base.css       ✅ (responsive)
│   └── bootstrap.min.css           ✅ (framework)
│
├── js/
│   ├── contact.js                  ❌ CASSÉ (à corriger)
│   ├── evenement.js                ❌ VIDE
│   ├── bootstrap.bundle.min.js     ✅
│   └── jquery-3.7.1.min.js         ✅
│
├── Image/                           ✅ (logos, images)
├── Photo profile/                   ✅ (photos utilisateurs)
├── Profile/                         (dossier à définir)
│
├── backend/                         ❌ À créer
│   ├── src/
│   │   ├── config/
│   │   ├── models/
│   │   ├── routes/
│   │   ├── controllers/
│   │   ├── middleware/
│   │   └── server.js
│   ├── package.json
│   ├── .env
│   └── .gitignore
│
├── docs/                            📄 Documentation ECF
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

