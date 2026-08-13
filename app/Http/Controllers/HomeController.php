<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\Household;
use App\Models\Marriage;
use App\Models\Rw;
use App\Models\Rt;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $totalAktif     = Resident::where('status', 'Aktif')->count();
        $totalLaki      = Resident::where('status', 'Aktif')->where('gender', 'Laki-laki')->count();
        $totalPerempuan = Resident::where('status', 'Aktif')->where('gender', 'Perempuan')->count();

        $stats = [
            'total_penduduk'    => $totalAktif,
            'total_laki'        => $totalLaki,
            'total_perempuan'   => $totalPerempuan,
            'total_kk'          => Household::count(),
            'total_nikah'       => Marriage::count(),
            'total_rw'          => Rw::count(),
            'total_rt'          => Rt::count(),
            'rasio_laki'        => $totalAktif > 0 ? round($totalLaki / $totalAktif * 100, 1) : 0,
            'rasio_perempuan'   => $totalAktif > 0 ? round($totalPerempuan / $totalAktif * 100, 1) : 0,
            'pemilih_potensial' => Resident::where('status', 'Aktif')
                ->whereRaw("strftime('%Y', 'now') - strftime('%Y', birth_date) >= 17")
                ->count(),
        ];

        $agama = Resident::where('status', 'Aktif')
            ->select('religion', DB::raw('count(*) as total'))
            ->groupBy('religion')
            ->orderByDesc('total')
            ->get();

        $pendidikan = Resident::where('status', 'Aktif')
            ->select('education', DB::raw('count(*) as total'))
            ->groupBy('education')
            ->orderByDesc('total')
            ->get();

        $pekerjaan = Resident::where('status', 'Aktif')
            ->select('occupation', DB::raw('count(*) as total'))
            ->groupBy('occupation')
            ->orderByDesc('total')
            ->limit(8)
            ->get();

        $gender = [
            'laki'      => $totalLaki,
            'perempuan' => $totalPerempuan,
        ];

        $usia = [
            'balita' => Resident::where('status', 'Aktif')
                ->whereRaw("(strftime('%Y', 'now') - strftime('%Y', birth_date)) BETWEEN 0 AND 4")->count(),
            'anak'   => Resident::where('status', 'Aktif')
                ->whereRaw("(strftime('%Y', 'now') - strftime('%Y', birth_date)) BETWEEN 5 AND 14")->count(),
            'remaja' => Resident::where('status', 'Aktif')
                ->whereRaw("(strftime('%Y', 'now') - strftime('%Y', birth_date)) BETWEEN 15 AND 24")->count(),
            'dewasa' => Resident::where('status', 'Aktif')
                ->whereRaw("(strftime('%Y', 'now') - strftime('%Y', birth_date)) BETWEEN 25 AND 59")->count(),
            'lansia' => Resident::where('status', 'Aktif')
                ->whereRaw("(strftime('%Y', 'now') - strftime('%Y', birth_date)) >= 60")->count(),
        ];

        $status_kawin = Resident::where('status', 'Aktif')
            ->select('marital_status', DB::raw('count(*) as total'))
            ->groupBy('marital_status')
            ->orderByDesc('total')
            ->get();

        $penduduk_terbaru = Resident::where('status', 'Aktif')
            ->latest()
            ->limit(10)
            ->get(['full_name', 'gender', 'birth_date', 'religion', 'occupation', 'marital_status']);

        // Stats per RT
        $per_rt = Rt::with('rw')
            ->withCount([
                'households as total_kk',
                'households as total_warga' => function ($q) {
                    $q->join('residents', 'residents.household_id', '=', 'households.id')
                      ->where('residents.status', 'Aktif');
                },
            ])
            ->get()
            ->map(fn($rt) => [
                'label'       => 'RT ' . $rt->number . ' / RW ' . ($rt->rw->number ?? '-'),
                'total_kk'    => $rt->total_kk,
                'total_warga' => $rt->total_warga,
            ])
            ->sortByDesc('total_warga')
            ->values();

        return view('home', compact(
            'stats', 'agama', 'pendidikan', 'pekerjaan',
            'usia', 'gender', 'status_kawin', 'penduduk_terbaru', 'per_rt'
        ));
    }
}
