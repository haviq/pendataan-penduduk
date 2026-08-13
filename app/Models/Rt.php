<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Rt extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'rts';

    protected $fillable = [
        'rw_id',
        'number',
        'chairman_resident_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['number'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'RT ditambahkan: RT ' . $this->number,
                'updated' => 'RT diubah: RT ' . $this->number,
                'deleted' => 'RT dihapus: RT ' . $this->number,
                default   => "RT {$eventName}: RT " . $this->number,
            });
    }

    public function rw(): BelongsTo
    {
        return $this->belongsTo(Rw::class);
    }

    public function households(): HasMany
    {
        return $this->hasMany(Household::class);
    }

    public function chairman(): BelongsTo
    {
        return $this->belongsTo(Resident::class, 'chairman_resident_id');
    }
}
