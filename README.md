# Arcade Universe

Application web de gestion de jeux vidéo développée en PHP 8 dans le cadre du projet B2 — Ynov Campus Toulouse.

## Fonctionnalités

- Catalogue de jeux avec recherche full-text, filtres par genre, tri et pagination
- Système d'authentification complet — inscription, connexion, déconnexion
- Hachage sécurisé des mots de passe avec bcrypt
- Profil utilisateur avec collection personnelle de jeux et temps de jeu
- Système de succès débloqués automatiquement selon les actions
- Panel administrateur — gestion des jeux (CRUD) et des utilisateurs
- Import automatique de 200 jeux via l'API RAWG
- Gestion des rôles — utilisateur standard et administrateur

## Stack technique

- PHP 8 — PDO, sessions, bcrypt, filter_var
- SQLite — base de données fichier, sans serveur
- HTML / CSS vanilla — dark theme responsive
- JavaScript vanilla — slideshow, popup succès

## Architecture

Le projet suit un pattern MVC simplifié :
```
PHP_Project/
├── config/                  # Connexion base de données (PDO)
├── includes/                # Auth, fonctions utilitaires
├── public/                  # Contrôleurs — points d'entrée HTTP
│   └── admin/               # Contrôleurs du panel admin
├── templates/
│   ├── layout/              # Header et footer communs
│   └── pages/               # Templates HTML par page
│       └── admin/           # Templates du panel admin
├── assets/
│   └── js/                  # Scripts JavaScript
├── .env                     # Variables d'environnement (non versionné)
├── .env.example             # Modèle de configuration
├── schema.sql               # Structure de la base de données
└── import_rawg_games.php    # Script CLI d'import RAWG
```

## Installation

**1. Cloner le dépôt**
```bash
git clone https://github.com/Spartansng/PHP_Project.git
cd PHP_Project
```

**2. Configurer les variables d'environnement**
```bash
cp .env.example .env
```
Ouvrir `.env` et renseigner la clé API RAWG :
```
RAWG_API_KEY=votre_clé_api_ici
```

**3. Créer la base de données**
```bash
sqlite3 database.sqlite < schema.sql
```

**4. Importer les jeux**
```bash
php import_rawg_games.php
```

**5. Lancer le serveur**
```bash
php -S localhost:8000 -t public/
```

**6. Accéder à l'application**

Ouvrir [http://localhost:8000](http://localhost:8000) dans le navigateur.

## Compte administrateur

Après l'installation, créer un compte via l'interface d'inscription puis modifier manuellement le rôle en BDD :
```bash
sqlite3 database.sqlite "UPDATE users SET role = 'admin' WHERE email = 'votre@email.com';"
```

## Sécurité

- Mots de passe hachés avec bcrypt — `password_hash()` / `password_verify()`
- Requêtes préparées PDO sur toutes les interactions BDD — protection contre les injections SQL
- Échappement systématique des sorties HTML avec `htmlspecialchars()` — protection contre le XSS
- Validation des données côté serveur — format email, plage de note
- Suppressions via POST uniquement — protection contre les suppressions accidentelles
- Clé API stockée dans `.env` — jamais versionnée sur Git
- Contrôle d'accès par rôles — `require_login()` et `require_admin()`

## Auteurs

- [Spartansng](https://github.com/Spartansng) — Lorenzo Sinigaglia
- [thomaspeyr31](https://github.com/thomaspeyr31) — Thomas Peyrusaubes