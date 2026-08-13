<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ResidentHistory extends Model
{
    use HasFactory, LogsActivity;

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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['jenis_perubahan', 'tanggal_perubahan'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'Riwayat ditambahkan: ' . $this->jenis_label . ' — ' . ($this->resident?->full_name ?? '-'),
                'updated' => 'Riwayat diubah: ' . $this->jenis_label,
                'deleted' => 'Riwayat dihapus: ' . $this->jenis_label,
                default   => "Riwayat {$eventName}",
            });
    }

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
