<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Rw extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'rws';

    protected $fillable = [
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
                'created' => 'RW ditambahkan: RW ' . $this->number,
                'updated' => 'RW diubah: RW ' . $this->number,
                'deleted' => 'RW dihapus: RW ' . $this->number,
                default   => "RW {$eventName}: RW " . $this->number,
            });
    }

    public function rts(): HasMany
    {
        return $this->hasMany(Rt::class);
    }

    public function chairman(): BelongsTo
    {
        return $this->belongsTo(Resident::class, 'chairman_resident_id');
    }
}
