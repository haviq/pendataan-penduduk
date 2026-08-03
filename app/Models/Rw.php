<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rw extends Model
{
    use HasFactory;

    protected $table = 'rws';

    protected $fillable = [
        'number',
        'chairman_resident_id',
    ];

    public function rts(): HasMany
    {
        return $this->hasMany(Rt::class);
    }

    public function chairman(): BelongsTo
    {
        return $this->belongsTo(Resident::class, 'chairman_resident_id');
    }
}