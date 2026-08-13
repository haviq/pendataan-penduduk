<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Household extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'households';

    protected $fillable = [
        'rt_id',
        'no_kk',
        'address',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['no_kk', 'address'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'Kartu Keluarga ditambahkan: ' . $this->no_kk,
                'updated' => 'Kartu Keluarga diubah: ' . $this->no_kk,
                'deleted' => 'Kartu Keluarga dihapus: ' . $this->no_kk,
                default   => "Kartu Keluarga {$eventName}: " . $this->no_kk,
            });
    }

    public function rt(): BelongsTo
    {
        return $this->belongsTo(Rt::class);
    }

    public function residents(): HasMany
    {
        return $this->hasMany(Resident::class);
    }

    public function head(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Resident::class)->where('relationship_to_head', 'Kepala Keluarga');
    }
}
