<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResidentHistory extends Model
{
    use HasFactory;

    protected $table = 'resident_histories';

    protected $fillable = [
        'resident_id',
        'jenis_perubahan',
        'keterangan',
        'asal_alamat',
        'tujuan_alamat',
        'tanggal_perubahan',
        'dicatat_oleh',
    ];

    protected $casts = [
        'tanggal_perubahan' => 'date',
    ];

    public function resident(): BelongsTo
    {
        return $this->belongsTo(Resident::class);
    }

    public function getJenisLabelAttribute(): string
    {
        return match($this->jenis_perubahan) {
            'pindah_masuk'    => 'Pindah Masuk',
            'pindah_keluar'   => 'Pindah Keluar',
            'meninggal'       => 'Meninggal',
            'aktif_kembali'   => 'Aktif Kembali',
            'perubahan_data'  => 'Perubahan Data',
            default           => $this->jenis_perubahan,
        };
    }
}
