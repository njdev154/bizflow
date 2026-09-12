<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    protected $fillable = [
        'organization_id', 'full_name', 'phone', 'email', 'notes', 'archived_at',
    ];

    protected function casts(): array
    {
        return [
            'archived_at' => 'datetime',
        ];
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
    public function appointments(): HasMany
{
    return $this->hasMany(Appointment::class);
}
public function payments(): HasMany
{
    return $this->hasMany(Payment::class);
}
}