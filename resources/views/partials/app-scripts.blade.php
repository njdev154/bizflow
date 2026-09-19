<script>
    // ---------------------------------------------------------------
    // 1) Avertit avant de quitter un formulaire modifié mais non soumis.
    //    S'applique uniquement aux formulaires marqués data-guard-unsaved.
    // ---------------------------------------------------------------
    document.querySelectorAll('form[data-guard-unsaved]').forEach(function (form) {
        let dirty = false;
        form.addEventListener('input', function () { dirty = true; });
        form.addEventListener('change', function () { dirty = true; });
        form.addEventListener('submit', function () { dirty = false; });

        window.addEventListener('beforeunload', function (e) {
            if (dirty) {
                e.preventDefault();
                e.returnValue = '';
            }
        });
    });

    // ---------------------------------------------------------------
    // 2) Empêche le double-clic sur n'importe quel formulaire de
    //    l'application : au moment de l'envoi, le bouton est désactivé
    //    et affiche un indicateur de chargement, jusqu'à la réponse
    //    du serveur (ou l'affichage d'une erreur de validation).
    // ---------------------------------------------------------------
    document.addEventListener('submit', function (e) {
        const form = e.target;
        if (!(form instanceof HTMLFormElement)) return;

        const button = form.querySelector('button[type="submit"]');
        if (!button || button.disabled) return;

        if (!button.dataset.originalHtml) {
            button.dataset.originalHtml = button.innerHTML;
        }

        button.disabled = true;
        button.classList.add('opacity-70', 'cursor-not-allowed');
        button.innerHTML = `
            <span class="inline-flex items-center gap-2">
                <svg class="animate-spin h-4 w-4" viewBox="0 0 24 24" fill="none">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
                Veuillez patienter...
            </span>
        `;
    });
</script>
