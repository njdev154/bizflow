<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function edit(Request $request): View
    {
        $organization = $request->user()->currentOrganization();

        abort_unless($organization, 403, "Aucune entreprise associée à ce compte.");

        return view('settings.edit', ['organization' => $organization]);
    }

    public function update(Request $request): RedirectResponse
    {
        $organization = $request->user()->currentOrganization();

        abort_unless($organization, 403, "Aucune entreprise associée à ce compte.");

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sector' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'currency' => ['required', 'string', 'max:10'],
            'timezone' => ['required', 'string', 'max:64'],
            'logo' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('logo')) {
            if ($organization->logo_path) {
                Storage::disk('public')->delete($organization->logo_path);
            }
            $validated['logo_path'] = $request->file('logo')->store('logos', 'public');
        }

        unset($validated['logo']);

        $organization->update($validated);

        return redirect()->route('settings.edit')->with('status', 'Paramètres mis à jour avec succès.');
    }
    public function auditLog(Request $request): View
{
    $organization = $request->user()->currentOrganization();

    abort_if(!$organization || $request->user()->roleIn($organization) !== 'owner', 403);

    $logs = $organization->auditLogs()->with('user')->latest()->paginate(20);

    return view('settings.audit-log', ['logs' => $logs]);
}
}
