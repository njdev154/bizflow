<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\Organization;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class OnboardingController extends Controller
{
    public function create(Request $request): View|RedirectResponse
    {
        if ($request->user()->currentOrganization()) {
            return redirect()->route('dashboard');
        }

        return view('onboarding.company');
    }

    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->currentOrganization()) {
            return redirect()->route('dashboard');
        }

        $validated = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'sector' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
        ]);

        DB::transaction(function () use ($request, $validated) {
            $organization = Organization::create([
                'name' => $validated['company_name'],
                'slug' => $this->uniqueSlug($validated['company_name']),
                'sector' => $validated['sector'],
                'phone' => $validated['phone'],
                'email' => $request->user()->email,
            ]);

            Membership::create([
                'user_id' => $request->user()->id,
                'organization_id' => $organization->id,
                'role' => 'owner',
            ]);
        });

        return redirect()->route('dashboard')->with('status', 'Votre entreprise a été créée avec succès.');
    }

    protected function uniqueSlug(string $name): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $i = 2;

        while (Organization::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }
}
