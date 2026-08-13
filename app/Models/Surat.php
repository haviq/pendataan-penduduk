<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Surat extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'surats';

    protected $fillable = [
        'resident_id',
        'jenis_surat',
        'nomor_surat',
        'keperluan',
        'dicetak_oleh',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['jenis_surat', 'nomor_surat'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'Surat dicetak: ' . strtoupper(str_replace('_', ' ', $this->jenis_surat)),
                'updated' => 'Surat diubah: ' . strtoupper(str_replace('_', ' ', $this->jenis_surat)),
                'deleted' => 'Surat dihapus: ' . strtoupper(str_replace('_', ' ', $this->jenis_surat)),
                default   => "Surat {$eventName}",
            });
    }

    public function resident(): BelongsTo
    {
        return $this->belongsTo(Resident::class);
    }
}
