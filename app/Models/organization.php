<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    protected $fillable = [
        'name', 'slug', 'sector', 'phone', 'email', 'currency', 'timezone', 'logo_path',
    ];

    public function memberships(): HasMany
    {
        return $this->hasMany(Membership::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'memberships')
            ->withPivot('role')
            ->withTimestamps();

    }
    public function clients(): HasMany
{
    return $this->hasMany(Client::class);
}
public function services(): HasMany
{
    return $this->hasMany(Service::class);
}
public function appointments(): HasMany
{
    return $this->hasMany(Appointment::class);
}
public function payments(): HasMany
{
    return $this->hasMany(Payment::class);
}
public function auditLogs(): HasMany
{
    return $this->hasMany(AuditLog::class);
}
}
