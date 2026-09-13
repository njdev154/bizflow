<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ink">Employés</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="flex justify-end mb-6">
            <a href="{{ route('employees.create') }}"
               class="inline-flex items-center justify-center h-11 px-5 bg-accent text-primary-dark rounded-xl font-semibold text-sm hover:bg-[#E08C00] transition">
                Ajouter un employé
            </a>
        </div>

        <div class="bg-surface border border-border rounded-xl overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-background text-muted text-xs uppercase">
                    <tr>
                        <th class="text-left px-4 py-3">Nom</th>
                        <th class="text-left px-4 py-3">Email</th>
                        <th class="text-left px-4 py-3">Rôle</th>
                        <th class="text-right px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @foreach ($members as $member)
                        <tr>
                            <td class="px-4 py-3 font-medium text-ink">{{ $member->name }}</td>
                            <td class="px-4 py-3 text-muted">{{ $member->email }}</td>
                            <td class="px-4 py-3">
                                @if ($member->pivot->role === 'owner')
                                    <span class="inline-flex justify-center items-center w-28 text-xs font-semibold px-2.5 py-1.5 rounded-full bg-accent-light text-warning">
                                        Propriétaire
                                    </span>
                                @else
                                    <form method="POST" action="{{ route('employees.role', $member) }}">
                                        @csrf
                                        @method('PATCH')
                                        <select name="role" onchange="this.form.submit()"
                                                class="w-28 text-xs font-semibold text-center px-2.5 py-1.5 rounded-full border-0 bg-[#EEF1F5] text-muted appearance-none cursor-pointer">
                                            <option value="manager" @selected($member->pivot->role === 'manager')>Manager</option>
                                            <option value="employee" @selected($member->pivot->role === 'employee')>Employé</option>
                                        </select>
                                    </form>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right">
                                @if ($member->pivot->role !== 'owner' && $member->id !== auth()->id())
                                    <form method="POST" action="{{ route('employees.destroy', $member) }}"
                                          onsubmit="return confirm('Retirer {{ $member->name }} de l\'entreprise ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-danger font-semibold hover:underline text-sm">Retirer</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
