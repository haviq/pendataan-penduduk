<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resident extends Model
{
    use HasFactory;

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

    public function household(): BelongsTo
    {
        return $this->belongsTo(Household::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}