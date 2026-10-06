# BizFlow

BizFlow est une application Laravel de gestion pour les entreprises de services (salons, instituts, cabinets, PME de prestations). Elle centralise les clients, les services, les rendez-vous, les paiements et les données de performance dans un tableau de bord simple et rapide.

## Description

Le projet a été pensé pour aider une petite structure à mieux gérer son activité sans multiplier les outils :

- gérer les clients et leur historique,
- planifier les rendez-vous et éviter les conflits,
- suivre les services et leurs tarifs,
- enregistrer les paiements,
- visualiser les revenus et le rythme d’activité.

Le produit est construit autour d’une logique multi-entreprise avec une organisation par utilisateur, permettant de gérer plusieurs structures via une seule interface.

## Stack technique

- PHP 8.3+
- Laravel 13
- Blade + Tailwind CSS
- Vite
- SQLite par défaut pour le développement local
- PHPUnit pour les tests
- Laravel Breeze / authentication native
- Laravel Socialite pour l’authentification Google

## Fonctionnalités principales

- onboarding d’une entreprise,
- tableau de bord KPI,
- gestion des clients,
- gestion des services,
- création et suivi des rendez-vous,
- vérification de conflits de créneau,
- enregistrement des paiements,
- journal d’audit de l’activité,
- gestion des rôles et des membres de l’organisation,
- espace profil et paramètres.

## Installation

```bash
cp .env.example .env
php artisan key:generate
php artisan migrate --force
npm install
npm run build
php artisan serve
```

Ensuite, ouvrez l’application dans le navigateur sur :

```text
http://localhost:8002
```

## Lancer le projet

```bash
php artisan serve
```

Pour les assets front :

```bash
npm run dev
```

## Tests

```bash
php artisan test
```

## Roadmap / améliorations futures

- ajout d’un planning hebdomadaire plus visuel,
- gestion des factures et PDF,
- rappels automatiques par email/SMS,
- gestion avancée des permissions par rôle,
- intégration de paiements plus variés,
- génération de rapports exportables,
- version mobile plus poussée pour la prise en charge sur site.

## Structure du projet

- `app/` : contrôleurs, modèles, logique applicative,
- `database/migrations/` : schéma de données,
- `resources/views/` : interfaces Blade,
- `resources/css/` : styles Tailwind et overrides,
- `routes/web.php` : routes de l’application,
- `tests/` : tests Laravel.

## Licence

Ce projet est distribué sous licence MIT. Voir le fichier [LICENSE](./LICENSE).
