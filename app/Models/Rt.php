<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rt extends Model
{
    use HasFactory;

    protected $table = 'rts';

    protected $fillable = [
        'rw_id',
        'number',
        'chairman_resident_id',
    ];

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