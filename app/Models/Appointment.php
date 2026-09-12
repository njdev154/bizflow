<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Appointment extends Model
{
    protected $fillable = [
        'organization_id', 'client_id', 'service_id',
        'scheduled_at', 'duration_minutes', 'status', 'notes',
    ];

    protected function casts(): array
    {
        return [
            'scheduled_at' => 'datetime',
        ];
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
    public function payment(): HasOne
{
    return $this->hasOne(Payment::class);
}
public function statusLabel(): string
{
    return match ($this->status) {
        'planifie' => 'Planifié',
        'confirme' => 'Confirmé',
        'en_attente' => 'En attente',
        'termine' => 'Terminé',
        'annule' => 'Annulé',
        'absent' => 'Absent',
        default => $this->status,
    };
}

public function statusBadgeClass(): string
{
    return match ($this->status) {
        'confirme' => 'bg-[#E8F7EE] text-success',
        'en_attente' => 'bg-accent-light text-warning',
        'annule', 'absent' => 'bg-[#FDECEC] text-danger',
        default => 'bg-[#EEF1F5] text-muted',
    };
}
}
