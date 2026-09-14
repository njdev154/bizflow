<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Membership;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    public function index(Request $request): View
    {
        $organization = $request->user()->currentOrganization();
        $this->authorizeOwner($request, $organization);

        $members = $organization->users()->orderByRaw("field(memberships.role, 'owner', 'manager', 'employee')")->get();

        return view('employees.index', ['members' => $members]);
    }

    public function create(Request $request): View
    {
        $organization = $request->user()->currentOrganization();
        $this->authorizeOwner($request, $organization);

        return view('employees.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $organization = $request->user()->currentOrganization();
        $this->authorizeOwner($request, $organization);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'in:manager,employee'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Membership::create([
            'user_id' => $user->id,
            'organization_id' => $organization->id,
            'role' => $validated['role'],
        ]);

        return redirect()->route('employees.index')->with('status', 'Employé ajouté avec succès.');
    }

    public function updateRole(Request $request, User $member): RedirectResponse
    {
        $organization = $request->user()->currentOrganization();
        $this->authorizeOwner($request, $organization);

        $membership = Membership::where('organization_id', $organization->id)->where('user_id', $member->id)->firstOrFail();

        abort_if($membership->role === 'owner', 403, "Impossible de modifier le rôle du propriétaire.");

        $validated = $request->validate([
            'role' => ['required', 'in:manager,employee'],
        ]);

        $membership->update(['role' => $validated['role']]);

        AuditLog::record('employee.role_updated', $member, ['new_role' => $validated['role']]);

        return back()->with('status', 'Rôle mis à jour.');
    }

    public function destroy(Request $request, User $member): RedirectResponse
    {
        $organization = $request->user()->currentOrganization();
        $this->authorizeOwner($request, $organization);

        $membership = Membership::where('organization_id', $organization->id)->where('user_id', $member->id)->firstOrFail();

        abort_if($membership->role === 'owner', 403, "Impossible de retirer le propriétaire.");
        abort_if($member->id === $request->user()->id, 403, "Vous ne pouvez pas vous retirer vous-même.");

        AuditLog::record('employee.removed', $member, ['name' => $member->name]);

        $membership->delete();

        return back()->with('status', 'Employé retiré de l\'entreprise.');
    }

    protected function authorizeOwner(Request $request, $organization): void
    {
        abort_if(!$organization || $request->user()->roleIn($organization) !== 'owner', 403,
            "Seul le propriétaire peut gérer les employés.");
    }
}
