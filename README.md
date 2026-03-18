# Arcade Universe

Projet PHP B2 — Application web de gestion de jeux vidéo.

## Fonctionnalites

- Catalogue de jeux avec recherche, filtres par genre et tri
- Systeme d'authentification complet (inscription / connexion / deconnexion)
- Profil utilisateur avec collection personnelle de jeux
- Systeme de succes debloques automatiquement
- Panel administrateur : gestion des jeux et des utilisateurs
- Import automatique de jeux via l'API RAWG

## Stack technique

- PHP 8 (PDO, sessions, bcrypt)
- SQLite
- HTML / CSS vanilla (dark theme responsive)
- JavaScript vanilla (slideshow, popup succes)

## Structure du projet
```
Project_PHP/
├── config/             # Connexion base de donnees
├── includes/           # Auth et fonctions utilitaires
├── templates/
│   ├── layout/         # Header et footer communs
│   └── pages/          # Templates HTML par page
├── public/             # Controleurs PHP (points d'entree)
├── assets/
│   ├── css/            # Feuilles de style
│   └── js/             # Scripts JavaScript
└── schema.sql          # Structure de la base de donnees
```

## Installation

1. Cloner le depot
2. Creer la base de donnees :
   sqlite3 database.sqlite < schema.sql
3. Importer les jeux :
   php import_rawg_games.php
4. Lancer le serveur :
   php -S localhost:8000 -t public/

## Auteurs

- [thomaspeyr31](https://github.com/thomaspeyr31)
- [Spartansng](https://github.com/Spartansng)