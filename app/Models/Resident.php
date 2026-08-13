<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Resident extends Model
{
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['nik', 'full_name', 'gender', 'birth_date', 'status'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created'  => 'Warga ditambahkan: ' . $this->full_name,
                'updated'  => 'Warga diubah: ' . $this->full_name,
                'deleted'  => 'Warga dihapus: ' . $this->full_name,
                default    => "Warga {$eventName}: " . $this->full_name,
            });
    }

    protected $table = 'residents';

    protected $fillable = [
        'household_id',
        'user_id',
        'nik',
        'full_name',
        'birth_place',
        'birth_date',
        'gender',
        'blood_type',
        'religion',
        'education',
        'occupation',
        'marital_status',
        'relationship_to_head',
        'father_name',
        'mother_name',
        'birth_cert_number',
        'status',
        'status_date',
        'status_note',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'status_date' => 'date',
    ];

    protected function age(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->birth_date?->age,
        );
    }

    protected function ageInDays(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->birth_date ? (int) $this->birth_date->diffInDays(now()) : null,
        );
    }

    protected function ageBreakdown(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (! $this->birth_date) {
                    return null;
                }

                $diff = $this->birth_date->diff(now());

                if ($diff->y > 0) {
                    return "{$diff->y} tahun {$diff->m} bulan";
                }

                return "{$diff->m} bulan {$diff->d} hari";
            },
        );
    }

    public function household(): BelongsTo
    {
        return $this->belongsTo(Household::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}