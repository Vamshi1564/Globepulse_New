<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AuditLog extends Model
{
    protected $table        = 'audit_logs';
    public    $incrementing = false;
    protected $keyType      = 'string';
    public    $timestamps   = false;

    const CREATED_AT = 'created_at';

    protected $fillable = [
        'id', 'actor_id', 'actor_type', 'action',
        'entity_type', 'entity_id', 'old_value',
        'new_value', 'ip_address',
    ];

    protected $casts = [
        'old_value'  => 'array',
        'new_value'  => 'array',
        'created_at' => 'datetime',
    ];

    // ── Static helper — call from anywhere to log an action ─
    // Usage: AuditLog::record('SELLER_REGISTERED', 'sellers', $seller->id, null, ['email' => $seller->email]);
    public static function record(
        string  $action,
        string  $entityType,
        ?string $entityId   = null,
        ?array  $oldValue   = null,
        ?array  $newValue   = null,
        ?string $actorId    = null,
        string  $actorType  = 'system'
    ): void {
        static::create([
            'id'          => (string) Str::uuid(),
            'actor_id'    => $actorId,
            'actor_type'  => $actorType,
            'action'      => $action,
            'entity_type' => $entityType,
            'entity_id'   => $entityId,
            'old_value'   => $oldValue,
            'new_value'   => $newValue,
            'ip_address'  => request()->ip(),
        ]);
    }
}
?>