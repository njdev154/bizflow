<section>
    <header>
        <h2 class="text-lg font-semibold text-ink">
            Informations du profil
        </h2>

        <p class="mt-1 text-sm text-muted">
            Modifiez votre photo, votre nom et votre adresse email.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-4" enctype="multipart/form-data" data-guard-unsaved>
        @csrf
        @method('patch')

        <div class="flex items-center gap-4">
            <div class="w-16 h-16 rounded-full overflow-hidden shrink-0 bg-accent-light text-warning flex items-center justify-center font-bold text-lg">
                @if ($user->avatarUrl())
                    <img src="{{ $user->avatarUrl() }}" alt="Photo de profil" class="w-full h-full object-cover">
                @else
                    {{ $user->initials() }}
                @endif
            </div>
            <div>
                <x-input-label for="avatar" value="Photo de profil" />
                <input type="file" id="avatar" name="avatar" accept="image/*"
                       class="text-sm text-muted file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-accent-light file:text-warning file:text-sm file:font-semibold">
                <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
            </div>
        </div>

        <div>
            <x-input-label for="name" value="Nom" />
            <x-text-input id="name" name="name" type="text" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-ink">
                        Votre adresse email n'est pas vérifiée.

                        <button form="send-verification" class="underline text-sm text-muted hover:text-ink focus:outline-none">
                            Cliquez ici pour renvoyer l'email de vérification.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-success">
                            Un nouveau lien de vérification a été envoyé à votre adresse email.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="w-auto px-6">Enregistrer</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-muted">Enregistré.</p>
            @endif
        </div>
    </form>
</section>
