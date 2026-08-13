<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\Household;
use App\Models\Rt;
use App\Models\Rw;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        $rts = Rt::with('rw')->orderBy('number')->get();
        return view('laporan.index', compact('rts'));
    }

    public function exportPdf(Request $request, string $jenis)
    {
        // Whitelist jenis agar tidak bisa dimanipulasi
        if (!in_array($jenis, ['demografi', 'warga', 'rt_summary'])) {
            abort(404);
        }

        $filterRt     = $request->integer('filter_rt') ?: null;
        $filterStatus = in_array($request->filter_status, ['Aktif', 'Pindah', 'Meninggal', 'semua'])
            ? $request->filter_status
            : 'Aktif';

        $query = Resident::with('household.rt.rw')
            ->when($filterStatus !== 'semua', fn($q) => $q->where('status', $filterStatus))
            ->when($filterRt, fn($q) => $q->whereHas('household', fn($h) => $h->where('rt_id', $filterRt)));

        $data = ['tanggal' => now()->translatedFormat('d F Y'), 'filter_rt' => $filterRt, 'filter_status' => $filterStatus];

        switch ($jenis) {
            case 'demografi':
                $total   = (clone $query)->count();
                $laki    = (clone $query)->where('gender', 'Laki-laki')->count();
                $perempuan = $total - $laki;

                $agama = (clone $query)->select('religion', DB::raw('count(*) as total'))
                    ->groupBy('religion')->orderByDesc('total')->get();
                $pendidikan = (clone $query)->select('education', DB::raw('count(*) as total'))
                    ->groupBy('education')->orderByDesc('total')->get();

                $usia = [
                    'Balita (0-4)'    => (clone $query)->whereRaw("(strftime('%Y','now') - strftime('%Y',birth_date)) BETWEEN 0 AND 4")->count(),
                    'Anak (5-14)'     => (clone $query)->whereRaw("(strftime('%Y','now') - strftime('%Y',birth_date)) BETWEEN 5 AND 14")->count(),
                    'Remaja (15-24)'  => (clone $query)->whereRaw("(strftime('%Y','now') - strftime('%Y',birth_date)) BETWEEN 15 AND 24")->count(),
                    'Dewasa (25-59)'  => (clone $query)->whereRaw("(strftime('%Y','now') - strftime('%Y',birth_date)) BETWEEN 25 AND 59")->count(),
                    'Lansia (60+)'    => (clone $query)->whereRaw("(strftime('%Y','now') - strftime('%Y',birth_date)) >= 60")->count(),
                ];

                $data = array_merge($data, compact('total', 'laki', 'perempuan', 'agama', 'pendidikan', 'usia'));
                $pdf  = Pdf::loadView('laporan.pdf.demografi', $data)->setPaper('a4', 'portrait');
                return $pdf->download('laporan_demografi_' . now()->format('Ymd') . '.pdf');

            case 'warga':
                $residents = $query->with('household.rt.rw')->orderBy('full_name')->get();
                $data = array_merge($data, compact('residents'));
                $pdf  = Pdf::loadView('laporan.pdf.warga', $data)->setPaper('a4', 'landscape');
                return $pdf->download('laporan_warga_' . now()->format('Ymd') . '.pdf');

            case 'rt_summary':
                $perRt = Rt::with('rw')
                    ->withCount(['households as total_kk',
                        'households as total_warga' => fn($q) => $q->join('residents','residents.household_id','=','households.id')
                            ->when($filterStatus !== 'semua', fn($r) => $r->where('residents.status', $filterStatus)),
                        'households as total_laki' => fn($q) => $q->join('residents','residents.household_id','=','households.id')
                            ->where('residents.gender','Laki-laki')
                            ->when($filterStatus !== 'semua', fn($r) => $r->where('residents.status', $filterStatus)),
                        'households as total_perempuan' => fn($q) => $q->join('residents','residents.household_id','=','households.id')
                            ->where('residents.gender','Perempuan')
                            ->when($filterStatus !== 'semua', fn($r) => $r->where('residents.status', $filterStatus)),
                    ])
                    ->orderBy('number')->get();
                $data = array_merge($data, compact('perRt'));
                $pdf  = Pdf::loadView('laporan.pdf.rt_summary', $data)->setPaper('a4', 'portrait');
                return $pdf->download('laporan_rt_' . now()->format('Ymd') . '.pdf');

            default:
                abort(404);
        }
    }

    public function exportCsv(Request $request, string $jenis)
    {
        // Whitelist jenis
        if (!in_array($jenis, ['warga', 'rt_summary'])) {
            abort(404);
        }

        $filterRt     = $request->integer('filter_rt') ?: null;
        $filterStatus = in_array($request->filter_status, ['Aktif', 'Pindah', 'Meninggal', 'semua'])
            ? $request->filter_status
            : 'Aktif';

        $query = Resident::with('household.rt.rw')
            ->when($filterStatus !== 'semua', fn($q) => $q->where('status', $filterStatus))
            ->when($filterRt, fn($q) => $q->whereHas('household', fn($h) => $h->where('rt_id', $filterRt)));

        $filename = 'laporan_' . $jenis . '_' . now()->format('Ymd_His') . '.csv';
        $headers  = ['Content-Type' => 'text/csv', 'Content-Disposition' => "attachment; filename=\"{$filename}\""];

        switch ($jenis) {
            case 'warga':
                $residents = $query->orderBy('full_name')->get();
                $callback = function () use ($residents) {
                    $f = fopen('php://output', 'w');
                    fputcsv($f, ['No', 'Nama', 'NIK', 'Gender', 'TTL', 'Agama', 'Pendidikan', 'Pekerjaan', 'Status Nikah', 'RT', 'RW', 'Alamat', 'Status']);
                    foreach ($residents as $i => $r) {
                        fputcsv($f, [
                            $i + 1, $r->full_name, $r->nik, $r->gender,
                            ($r->birth_place ?? '-') . ', ' . ($r->birth_date?->format('d/m/Y') ?? '-'),
                            $r->religion, $r->education, $r->occupation, $r->marital_status,
                            'RT ' . ($r->household?->rt?->number ?? '-'),
                            'RW ' . ($r->household?->rt?->rw?->number ?? '-'),
                            $r->household?->address ?? '-', $r->status,
                        ]);
                    }
                    fclose($f);
                };
                return response()->stream($callback, 200, $headers);

            case 'rt_summary':
                $perRt = Rt::with('rw')
                    ->withCount(['households as total_kk',
                        'households as total_warga' => fn($q) => $q->join('residents','residents.household_id','=','households.id')
                            ->when($filterStatus !== 'semua', fn($r) => $r->where('residents.status', $filterStatus)),
                    ])->orderBy('number')->get();
                $callback = function () use ($perRt) {
                    $f = fopen('php://output', 'w');
                    fputcsv($f, ['RT', 'RW', 'Total KK', 'Total Warga']);
                    foreach ($perRt as $rt) {
                        fputcsv($f, ['RT ' . $rt->number, 'RW ' . ($rt->rw?->number ?? '-'), $rt->total_kk, $rt->total_warga]);
                    }
                    fclose($f);
                };
                return response()->stream($callback, 200, $headers);

            default:
                abort(404);
        }
    }
}
