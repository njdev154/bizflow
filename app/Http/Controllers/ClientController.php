<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function index(Request $request): View
    {
        $organization = $request->user()->currentOrganization();
        $search = trim((string) $request->query('q', ''));

        $clients = $organization
            ? $organization->clients()
                ->whereNull('archived_at')
                ->when($search !== '', function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('full_name', 'like', "%{$search}%")
                          ->orWhere('phone', 'like', "%{$search}%");
                    });
                })
                ->orderBy('full_name')
                ->paginate(10)
                ->withQueryString()
            : Client::whereRaw('1 = 0')->paginate(10); // aucune entreprise => liste vide, jamais d'erreur

        return view('clients.index', [
            'clients' => $clients,
            'search' => $search,
        ]);
    }

    public function create(): View
    {
        return view('clients.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $organization = $request->user()->currentOrganization();

        abort_unless($organization, 403, "Aucune entreprise associée à ce compte.");

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $organization->clients()->create($validated);

        return redirect()->route('clients.index')->with('status', 'Client ajouté avec succès.');
    }
}
