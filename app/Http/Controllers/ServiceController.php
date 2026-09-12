<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(Request $request): View
    {
        $organization = $request->user()->currentOrganization();

        $services = $organization
            ? $organization->services()->orderBy('name')->paginate(10)
            : Service::whereRaw('1 = 0')->paginate(10);

        return view('services.index', ['services' => $services]);
    }

    public function create(): View
    {
        return view('services.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $organization = $request->user()->currentOrganization();

        abort_unless($organization, 403, "Aucune entreprise associée à ce compte.");

        $validated = $this->validated($request);
        $validated['is_active'] = $request->boolean('is_active');

        $organization->services()->create($validated);

        return redirect()->route('services.index')->with('status', 'Service ajouté avec succès.');
    }

    public function edit(Request $request, Service $service): View
    {
        $this->authorizeServiceBelongsToUser($request, $service);

        return view('services.edit', ['service' => $service]);
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $this->authorizeServiceBelongsToUser($request, $service);

        $validated = $this->validated($request);
        $validated['is_active'] = $request->boolean('is_active');

        $service->update($validated);

        return redirect()->route('services.index')->with('status', 'Service modifié avec succès.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'duration_minutes' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'numeric', 'min:0'],
            'category' => ['nullable', 'string', 'max:255'],
        ]);
    }

    protected function authorizeServiceBelongsToUser(Request $request, Service $service): void
    {
        $organization = $request->user()->currentOrganization();

        abort_if(!$organization || $service->organization_id !== $organization->id, 403);
    }
}
