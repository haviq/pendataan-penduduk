<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\Household;
use App\Models\Marriage;
use App\Models\Rw;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'total_penduduk'  => Resident::where('status', 'active')->count(),
            'total_laki'      => Resident::where('status', 'active')->where('gender', 'Laki-laki')->count(),
            'total_perempuan' => Resident::where('status', 'active')->where('gender', 'Perempuan')->count(),
            'total_kk'        => Household::count(),
            'total_nikah'     => Marriage::count(),
            'total_rw'        => Rw::count(),
        ];

        $agama = Resident::where('status', 'active')
            ->select('religion', DB::raw('count(*) as total'))
            ->groupBy('religion')
            ->orderByDesc('total')
            ->get();

        $pendidikan = Resident::where('status', 'active')
            ->select('education', DB::raw('count(*) as total'))
            ->groupBy('education')
            ->orderByDesc('total')
            ->get();

        $pekerjaan = Resident::where('status', 'active')
            ->select('occupation', DB::raw('count(*) as total'))
            ->groupBy('occupation')
            ->orderByDesc('total')
            ->limit(8)
            ->get();

        $gender = [
            'laki'      => $stats['total_laki'],
            'perempuan' => $stats['total_perempuan'],
        ];

        $usia = [
            'balita'  => Resident::where('status', 'active')->whereRaw("strftime('%Y', 'now') - strftime('%Y', birth_date) BETWEEN 0 AND 4")->count(),
            'anak'    => Resident::where('status', 'active')->whereRaw("strftime('%Y', 'now') - strftime('%Y', birth_date) BETWEEN 5 AND 14")->count(),
            'remaja'  => Resident::where('status', 'active')->whereRaw("strftime('%Y', 'now') - strftime('%Y', birth_date) BETWEEN 15 AND 24")->count(),
            'dewasa'  => Resident::where('status', 'active')->whereRaw("strftime('%Y', 'now') - strftime('%Y', birth_date) BETWEEN 25 AND 59")->count(),
            'lansia'  => Resident::where('status', 'active')->whereRaw("strftime('%Y', 'now') - strftime('%Y', birth_date) >= 60")->count(),
        ];

        $status_kawin = Resident::where('status', 'active')
            ->select('marital_status', DB::raw('count(*) as total'))
            ->groupBy('marital_status')
            ->orderByDesc('total')
            ->get();

        $penduduk_terbaru = Resident::where('status', 'active')
            ->latest()
            ->limit(10)
            ->get(['full_name', 'gender', 'birth_date', 'religion', 'occupation', 'marital_status']);

        return view('home', compact(
            'stats', 'agama', 'pendidikan', 'pekerjaan',
            'usia', 'gender', 'status_kawin', 'penduduk_terbaru'
        ));
    }
}
