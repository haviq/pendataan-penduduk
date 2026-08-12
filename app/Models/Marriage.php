<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Marriage extends Model
{
    use HasFactory;

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

    public function husband(): BelongsTo
    {
        return $this->belongsTo(Resident::class, 'husband_resident_id');
    }

    public function wife(): BelongsTo
    {
        return $this->belongsTo(Resident::class, 'wife_resident_id');
    }
}