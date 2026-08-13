<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Marriage extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'marriages';

    protected $fillable = [
        'husband_resident_id',
        'wife_resident_id',
        'marriage_certificate_number',
        'marriage_date',
        'kua_name',
        'divorce_certificate_number',
        'divorce_date',
    ];

    protected $casts = [
        'marriage_date' => 'date',
        'divorce_date' => 'date',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['marriage_certificate_number', 'marriage_date'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'Pernikahan dicatat: ' . ($this->husband?->full_name ?? '-') . ' & ' . ($this->wife?->full_name ?? '-'),
                'updated' => 'Pernikahan diubah: ' . ($this->husband?->full_name ?? '-') . ' & ' . ($this->wife?->full_name ?? '-'),
                'deleted' => 'Pernikahan dihapus: ' . ($this->husband?->full_name ?? '-') . ' & ' . ($this->wife?->full_name ?? '-'),
                default   => "Pernikahan {$eventName}",
            });
    }

    public function husband(): BelongsTo
    {
        return $this->belongsTo(Resident::class, 'husband_resident_id');
    }

    public function wife(): BelongsTo
    {
        return $this->belongsTo(Resident::class, 'wife_resident_id');
    }
}
