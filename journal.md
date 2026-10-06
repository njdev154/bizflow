# Journal de projet

- 2026-10-06 — Agent: Copilot. Vérification du projet, installation des dépendances, mise en route de l’environnement Laravel, validation du besoin portfolio. Correction d’un bug de migration sur `audit_logs` et préparation de la refonte de la landing page.
- 2026-10-06 — Agent: Copilot. Mise à jour du README, amélioration de l’UI, ajout d’une landing page plus professionnelle et création d’un aperçu visuel pour la présentation du projet.
- 2026-10-06 — Agent: Copilot. Désactivation de la dépendance au manifeste Vite pendant les tests Laravel, afin que les tests de vues n’exigent pas une compilation front préalable. Suite PHPUnit complète vérifiée : 33 tests, 79 assertions, tout passe.
- 2026-10-06 — Agent: Copilot. Suppression de `concurrently`, qui n’est utilisé par aucun script du projet et amenait une dépendance vulnérable `shell-quote`. Migration Tailwind CSS 4 via le plugin Vite officiel, palette et sources migrées en CSS, anciens fichiers Tailwind 3/PostCSS retirés. PHPUnit repasse : 33 tests, 79 assertions. `npm install`, `npm audit` et `npm run build` restent à exécuter pour régénérer/valider le lockfile et le build.
- 2026-10-06 — Agent: Copilot. Confirmation utilisateur : `npm install` terminé, `npm audit` affiche 0 vulnérabilité et `npm run build` réussit avec Tailwind CSS 4. Confirmation utilisateur de `php artisan test` : 33 tests réussis, 79 assertions, durée 5,70 s.

Prochaine étape : vérifier visuellement la landing page et les écrans responsives; ajouter de vraies captures d’écran du produit au portfolio.
