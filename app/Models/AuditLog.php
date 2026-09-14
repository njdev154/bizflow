<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditLog extends Model
{
    const UPDATED_AT = null;

    protected $fillable = ['organization_id', 'user_id', 'action', 'auditable_type', 'auditable_id', 'meta'];

    protected function casts(): array
    {
        return ['meta' => 'array'];
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Point d'entrée unique pour journaliser une action sensible.
     * $model est la ressource concernée (le client, le paiement...), optionnel.
     */
    public static function record(string $action, ?Model $model = null, array $meta = []): void
    {
        $user = auth()->user();

        static::create([
            'organization_id' => $user?->currentOrganization()?->id,
            'user_id' => $user?->id,
            'action' => $action,
            'auditable_type' => $model ? get_class($model) : null,
            'auditable_id' => $model?->id,
            'meta' => $meta,
        ]);
    }
}
