<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Household extends Model
{
    use HasFactory;

    protected $table = 'households';

    protected $fillable = [
        'rt_id',
        'no_kk',
        'address',
    ];

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