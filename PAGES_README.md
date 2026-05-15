# 📋 Documentation - Tableau des Pages & Leurs Fonctions

## Vue d'ensemble
Ce document décrit toutes les pages du projet **EcoRide**, leur rôle, les controllers/views associés, et les niveaux d'accès requis.

---

## 🔗 Point d'Entrée

| Fichier | Type | Fonction |
|---------|------|----------|
| `public/index.php` | Routeur Principal | Point d'accès unique - gère la navigation via paramètre `?page=` et dispatch vers les controllers appropriés |

---

## 🌐 Pages Publiques (Accessibles sans authentification)

| Contrôleur | Vue | Page | Fonction | URL |
|------------|-----|------|----------|-----|
| `home_controller.php` | `home.view.php` | 🏠 **Accueil** | Affiche la page d'accueil du site avec infos générales et présentation | `?page=home` |
| `auth_controller.php` | `connexion.view.php` | 🔐 **Connexion** | Formulaire de login - vérifie identifiants, crée session utilisateur | `?page=login` |
| `auth_controller.php` | `inscription.view.php` | ✍️ **Inscription** | Formulaire d'enregistrement - création de compte utilisateur avec validation | `?page=register` |
| `legal_controller.php` | `mention.view.php` | ⚖️ **Mentions Légales** | Affiche les conditions d'utilisation et mentions légales du site | `?page=mentions` |
| `contact_controller.php` | `contact.view.php` | 📧 **Contact** | Formulaire de contact - recueille messages et les sauvegarde en base de données | `?page=contact` |
| `covoiturage_controller.php` | `covoiturage.view.php` | 🚗 **Covoiturage** | Affiche la liste complète des trajets en covoiturage disponibles | `?page=covoiturage` |
| `search_controller.php` | `search.view.php` | 🔍 **Résultats Recherche** | Affiche les trajets filtrés selon les critères de recherche de l'utilisateur | `?page=search` |

**Authentification requise :** ❌ Non

---

## 🔒 Pages Protégées - Utilisateur Standard

| Contrôleur | Vue | Page | Fonction | Accès | URL |
|------------|-----|------|----------|-------|-----|
| `profile_controller.php` | `profile.view.php` | 👤 **Mon Profil** | Permet à l'utilisateur de modifier son profil (pseudo, email, informations personnelles) | Session Active + Rôle: Utilisateur (3) | `?page=profile` |

**Authentification requise :** ✅ Oui (Rôle 3)
**Redirection si non autorisé :** Vers page connexion

---

## 💼 Pages Protégées - Employé

| Contrôleur | Vue | Page | Fonction | Accès | URL |
|------------|-----|------|----------|-------|-----|
| `employee_controller.php` | `employee.view.php` | 💼 **Espace Employé** | Dashboard pour les employés - accès aux outils et fonctionnalités spécifiques aux employés | Session Active + Rôle: Employé (2) | `?page=employee` |

**Authentification requise :** ✅ Oui (Rôle 2)
**Redirection si non autorisé :** Vers page connexion

---

## ⚙️ Pages Protégées - Administrateur

| Contrôleur | Vue | Page | Fonction | Accès | URL |
|------------|-----|------|----------|-------|-----|
| `admin_controller.php` | `admin.view.php` | ⚙️ **Panneau Admin** | Dashboard pour les administrateurs - création d'employés, gestion générale du système | Session Active + Rôle: Admin (1) | `?page=admin` |

**Authentification requise :** ✅ Oui (Rôle 1)
**Redirection si non autorisé :** Vers page connexion

---

## 🚪 Actions Spéciales

| Contrôleur | Fonction | Effet |
|------------|----------|-------|
| `logout_controller.php` | Déconnexion | Détruit la session active et redirige l'utilisateur vers la page d'accueil |

---

## 📦 Composants Partagés (Includes)

### Headers
| Fichier | Utilisé par | Fonction |
|---------|------------|----------|
| `header.php` | Toutes pages publiques | En-tête HTML standard - charge CSS/JS dynamiques, affiche navbar, récupère crédits utilisateur |
| `header_admin.php` | Page admin | En-tête pour administrateur - affiche crédits, navbar avec menu admin |
| `header_employe.php` | Page employé | En-tête pour employé - affiche crédits, navbar avec menu employé |

### Autres Includes
| Fichier | Utilisé par | Fonction |
|---------|------------|----------|
| `footer.php` | Toutes pages | Pied de page - liens utiles, contacts, mentions légales, réseaux sociaux |
| `security.php` | Controllers protégés | Vérification de session et rôle - redirige vers login si non autorisé |
| `verif_role.php` | Controllers protégés | Fonction `securiser_page($roleAttendu)` - contrôle d'accès granulaire par rôle |

---

## 💾 Modèles de Données

| Fichier | Classe | Fonction |
|---------|--------|----------|
| `User.php` | `User` | Gère les utilisateurs - register, login, createEmployee, updateProfile, getById |
| `Contact.php` | `Contact` | Gère les messages de contact - create, getAll, getById |
| `db.php` | Connexion PDO | Connexion à la base de données MySQL |

---

## 🗂️ Structure des Fichiers

```
EcoRide/
├── public/
│   └── index.php ........................ Routeur principal
├── app/
│   ├── controllers/ ..................... Controllers (logique métier)
│   │   ├── home_controller.php
│   │   ├── auth_controller.php
│   │   ├── covoiturage_controller.php
│   │   ├── search_controller.php
│   │   ├── profile_controller.php
│   │   ├── admin_controller.php
│   │   ├── employee_controller.php
│   │   ├── contact_controller.php
│   │   ├── legal_controller.php
│   │   └── logout_controller.php
│   ├── views/ ........................... Templates d'affichage
│   │   ├── home.view.php
│   │   ├── connexion.view.php
│   │   ├── inscription.view.php
│   │   ├── covoiturage.view.php
│   │   ├── search.view.php
│   │   ├── profile.view.php
│   │   ├── admin.view.php
│   │   ├── employee.view.php
│   │   ├── contact.view.php
│   │   └── mention.view.php
│   ├── models/ .......................... Classes de données
│   │   ├── User.php
│   │   └── Contact.php
│   └── config/
│       └── db.php ....................... Connexion base de données
├── includes/ ............................ Fichiers partagés
│   ├── header.php
│   ├── header_admin.php
│   ├── header_employe.php
│   ├── footer.php
│   ├── security.php
│   └── verif_role.php
├── css/ ................................. Feuilles de styles
├── js/ .................................. Scripts JavaScript
└── Image/ ............................... Ressources images
```

---

## 🔐 Système de Rôles & Droits d'Accès

### Hiérarchie des Rôles

| Rôle ID | Nom | Pages Accessibles | Permissions |
|---------|-----|------------------|-------------|
| `1` | **Admin** | Accueil, Covoiturage, Profil, Panneau Admin + Toutes pages publiques | Gestion complète du système, création employés |
| `2` | **Employé** | Accueil, Covoiturage, Profil, Espace Employé + Toutes pages publiques | Gestion des services employé |
| `3` | **Utilisateur** | Accueil, Covoiturage, Profil + Toutes pages publiques | Recherche, contact, utilisation du covoiturage |
| `0` | **Visiteur (Non connecté)** | Accueil, Covoiturage, Recherche, Contact, Mentions légales, Connexion, Inscription | Navigation publique uniquement |

### Vérification d'Accès

Les pages protégées utilisent la fonction `verifierAcces($roleAttendu)` de `security.php` :
- Vérifie si l'utilisateur est connecté (`$_SESSION['user_id']`)
- Vérifie si son rôle correspond (`$_SESSION['role_id']`)
- Redirige vers `/EcoRide/public/index.php?page=login` si non autorisé

---

## 📊 Flux de Navigation

```
┌─────────────────────────────────────────────────────────────────┐
│                     Utilisateur accède au site                  │
└──────────────────────────┬──────────────────────────────────────┘
                           ↓
                  public/index.php (Routeur)
                           ↓
            Lit le paramètre ?page= dans l'URL
                           ↓
        ┌─────────────────────────────────────┐
        │   Charge le controller approprié    │
        └────────────┬────────────────────────┘
                     ↓
        ┌─────────────────────────────────────┐
        │ Vérifie authentification/rôle       │
        │ (security.php + verif_role.php)    │
        └─────┬──────────────────────────┬────┘
              ↓ ✅ Autorisé               ↓ ❌ Non autorisé
        Charge le modèle            Redirection vers
        (si nécessaire)             page connexion
              ↓                           ↓
        Charge la vue + header      Fin du script
        + footer (includes)
              ↓
        ✅ Affiche la page à l'utilisateur
```

---

## 🔄 Exemple de Flux Complet : Inscription

```
1. Utilisateur accède : ?page=register
   ↓
2. index.php charge auth_controller.php
   ↓
3. auth_controller.php → registerController()
   ↓
4. Formulaire affiché (views/inscription.view.php)
   ↓
5. Utilisateur soumet le formulaire
   ↓
6. Validation des données dans registerController()
   ↓
7. User::register() en base de données
   ↓
8. Redirection vers connexion ✅
```

---

## 🔄 Exemple de Flux Complet : Accès à l'Admin

```
1. Utilisateur non connecté accède : ?page=admin
   ↓
2. index.php charge admin_controller.php
   ↓
3. security.php vérifie la session
   ↓
4. ❌ $_SESSION['user_id'] n'existe pas
   ↓
5. Redirection : ?page=login
   ↓
---
6. (Après connexion) Utilisateur avec Rôle=1 accède : ?page=admin
   ↓
7. security.php vérifie la session
   ↓
8. ✅ $_SESSION['user_id'] existe ET $_SESSION['role_id'] == 1
   ↓
9. admin_controller.php continue
   ↓
10. Affichage du dashboard admin (views/admin.view.php)
```

---

## 📝 Configuration

### Base de Données
- **Fichier de connexion :** `app/config/db.php`
- **Connexion :** PDO MySQL
- **Tables principales :** `utilisateur`, `contact`

### Styles & Scripts Dynamiques
- Chaque controller peut spécifier des CSS/JS additionnels via `$specificCss` et `$specificJS`
- Chargés dynamiquement dans le header

### Sessions
- Démarrées automatiquement dans les includes
- Détruites via `logout_controller.php`
- Durée par défaut PHP (généralement 24 minutes)

---

## ⚡ Résumé Rapide

- **7 Pages publiques** : Accueil, Connexion, Inscription, Covoiturage, Recherche, Contact, Mentions
- **1 Page utilisateur** : Profil (rôle 3+)
- **1 Page employé** : Dashboard Employé (rôle 2+)
- **1 Page admin** : Dashboard Admin (rôle 1)
- **3 Types de headers** selon le contexte (public, employé, admin)
- **2 Modèles** : User et Contact
- **1 Routeur central** : public/index.php gère tout

---

**Dernière mise à jour :** May 15, 2026  
**Version :** 1.0
