<x-app-layout>
    <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
        <div class="mb-8 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-warning">Espace entreprise</p>
                <h1 class="mt-2 text-2xl font-bold tracking-tight text-ink sm:text-3xl">Paramètres</h1>
                <p class="mt-2 max-w-2xl text-sm leading-6 text-muted">
                    Mets à jour les informations utilisées dans ton espace BizFlow.
                </p>
            </div>
            <a href="{{ route('settings.audit-log') }}"
               class="inline-flex min-h-10 items-center gap-2 self-start rounded-lg border border-border bg-surface px-4 py-2 text-sm font-semibold text-ink transition hover:border-accent hover:text-warning sm:self-auto">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l2.5 1.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Journal d’activité
            </a>
        </div>

        <div class="grid items-start gap-6 lg:grid-cols-[minmax(0,1fr)_18rem]">
            <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data"
                  data-guard-unsaved class="overflow-hidden rounded-2xl border border-border bg-surface">
                @csrf
                @method('PUT')

                <section class="border-b border-border p-5 sm:p-7">
                    <div class="mb-6">
                        <h2 class="text-lg font-bold text-ink">Identité de l’entreprise</h2>
                        <p class="mt-1 text-sm text-muted">Le nom et le secteur que tu as renseignés à la création.</p>
                    </div>

                    <div class="grid gap-6 sm:grid-cols-[minmax(0,1fr)_12rem]">
                        <div class="space-y-5">
                            <div>
                                <x-input-label for="name" value="Nom de l'entreprise" />
                                <x-text-input id="name" name="name" :value="old('name', $organization->name)" required autocomplete="organization" />
                                <x-input-error :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="sector" value="Secteur d'activité" />
                                <select id="sector" name="sector" required
                                        class="h-11 w-full rounded-xl border border-border bg-white px-4 text-sm text-ink focus:border-accent focus:outline-none focus:ring-2 focus:ring-accent/30">
                                    @foreach (['Salon de coiffure', 'Barbers', 'Institut de beauté', 'Photographes', 'Réparateurs', 'Autres services'] as $option)
                                        <option value="{{ $option }}" @selected(old('sector', $organization->sector) === $option)>{{ $option }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('sector')" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="logo" value="Logo" />
                            <div class="flex h-28 items-center justify-center overflow-hidden rounded-xl border border-dashed border-border bg-background p-3">
                                @if ($organization->logo_path)
                                    <img src="{{ Storage::url($organization->logo_path) }}" alt="Logo de {{ $organization->name }}" class="h-full w-full object-contain">
                                @else
                                    <span class="text-sm text-muted">Aucun logo ajouté</span>
                                @endif
                            </div>
                            <input type="file" id="logo" name="logo" accept="image/*"
                                   class="mt-3 block w-full text-xs text-muted file:mr-2 file:rounded-lg file:border-0 file:bg-accent-light file:px-3 file:py-2 file:text-xs file:font-semibold file:text-warning hover:file:bg-amber-100">
                            <p class="mt-2 text-xs leading-5 text-muted">Image carrée recommandée. 2 Mo maximum.</p>
                            <x-input-error :messages="$errors->get('logo')" />
                        </div>
                    </div>
                </section>

                <section class="border-b border-border p-5 sm:p-7">
                    <div class="mb-6">
                        <h2 class="text-lg font-bold text-ink">Coordonnées</h2>
                        <p class="mt-1 text-sm text-muted">Les informations pour joindre ton entreprise.</p>
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <x-input-label for="phone" value="Téléphone" />
                            <x-text-input id="phone" name="phone" type="tel" :value="old('phone', $organization->phone)" autocomplete="tel" />
                            <x-input-error :messages="$errors->get('phone')" />
                        </div>
                        <div>
                            <x-input-label for="email" value="E-mail de contact" />
                            <x-text-input id="email" type="email" name="email" :value="old('email', $organization->email)" autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')" />
                        </div>
                    </div>
                </section>

                <section class="p-5 sm:p-7">
                    <div class="mb-6">
                        <h2 class="text-lg font-bold text-ink">Région et devise</h2>
                        <p class="mt-1 text-sm text-muted">Choisis les paramètres utilisés pour les dates et montants.</p>
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <x-input-label for="currency" value="Devise" />
                            <select id="currency" name="currency" required
                                    class="h-11 w-full rounded-xl border border-border bg-white px-4 text-sm text-ink focus:border-accent focus:outline-none focus:ring-2 focus:ring-accent/30">
                                @foreach (['FCFA' => 'Franc CFA (FCFA)', 'EUR' => 'Euro (€)', 'USD' => 'Dollar US ($)'] as $value => $label)
                                    <option value="{{ $value }}" @selected(old('currency', $organization->currency) === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('currency')" />
                        </div>
                        <div>
                            <x-input-label for="timezone" value="Fuseau horaire" />
                            <select id="timezone" name="timezone" required
                                    class="h-11 w-full rounded-xl border border-border bg-white px-4 text-sm text-ink focus:border-accent focus:outline-none focus:ring-2 focus:ring-accent/30">
                                @foreach (['Africa/Abidjan' => 'Abidjan (GMT)', 'Africa/Dakar' => 'Dakar (GMT)', 'Europe/Paris' => 'Paris (GMT+1/+2)'] as $value => $label)
                                    <option value="{{ $value }}" @selected(old('timezone', $organization->timezone) === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('timezone')" />
                        </div>
                    </div>
                </section>

                <div class="flex flex-col-reverse gap-3 border-t border-border bg-background/70 px-5 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-7">
                    <p class="text-xs text-muted">Les modifications s’appliquent à cette entreprise.</p>
                    <x-primary-button class="w-full sm:w-auto sm:px-6">Enregistrer les modifications</x-primary-button>
                </div>
            </form>

            <aside class="space-y-4 lg:sticky lg:top-6">
                <div class="overflow-hidden rounded-2xl bg-primary text-white">
                    <div class="border-b border-white/10 px-5 py-4">
                        <p class="text-xs font-semibold uppercase tracking-[0.15em] text-white/60">Aperçu</p>
                    </div>
                    <div class="p-5">
                        <div class="flex h-14 w-14 items-center justify-center overflow-hidden rounded-xl border border-white/15 bg-white/10">
                            @if ($organization->logo_path)
                                <img src="{{ Storage::url($organization->logo_path) }}" alt="" class="h-full w-full object-contain">
                            @else
                                <span class="text-xl font-bold text-accent">{{ mb_substr($organization->name, 0, 1) }}</span>
                            @endif
                        </div>
                        <h2 class="mt-4 break-words text-lg font-bold">{{ $organization->name }}</h2>
                        <p class="mt-1 text-sm text-white/65">{{ $organization->sector ?: 'Secteur non renseigné' }}</p>

                        <dl class="mt-6 space-y-4 border-t border-white/10 pt-5 text-sm">
                            <div>
                                <dt class="text-xs text-white/55">Téléphone</dt>
                                <dd class="mt-1 break-words">{{ $organization->phone ?: 'Non renseigné' }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs text-white/55">E-mail</dt>
                                <dd class="mt-1 break-words">{{ $organization->email ?: 'Non renseigné' }}</dd>
                            </div>
                            <div class="flex justify-between gap-3">
                                <div>
                                    <dt class="text-xs text-white/55">Devise</dt>
                                    <dd class="mt-1">{{ $organization->currency }}</dd>
                                </div>
                                <div class="text-right">
                                    <dt class="text-xs text-white/55">Fuseau</dt>
                                    <dd class="mt-1">{{ $organization->timezone }}</dd>
                                </div>
                            </div>
                        </dl>
                    </div>
                </div>

                <a href="{{ route('settings.audit-log') }}"
                   class="flex items-start gap-3 rounded-2xl border border-border bg-surface p-4 transition hover:border-accent">
                    <span class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-accent-light text-warning">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l2.5 1.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </span>
                    <span>
                        <span class="block text-sm font-semibold text-ink">Journal d’activité</span>
                        <span class="mt-1 block text-xs leading-5 text-muted">Consulte les dernières actions réalisées dans ton entreprise.</span>
                    </span>
                    <span class="ml-auto text-muted" aria-hidden="true">→</span>
                </a>
            </aside>
        </div>
    </div>
</x-app-layout>
