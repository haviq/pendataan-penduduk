<?php

namespace App\Http\Controllers;

use App\Models\Rt;
use App\Models\Resident;
use Illuminate\Support\Facades\DB;

class RtPublicController extends Controller
{
    public function index()
    {
        $rts = Rt::with('rw')
            ->withCount(['households as total_kk',
                'households as total_warga' => fn($q) => $q
                    ->join('residents', 'residents.household_id', '=', 'households.id')
                    ->where('residents.status', 'Aktif'),
            ])
            ->orderBy('number')
            ->get();

        $maxWarga = $rts->max('total_warga') ?: 1;
        return view('rt.index', compact('rts', 'maxWarga'));
    }

    public function show($id)
    {
        $rt = Rt::with('rw')->findOrFail($id);

        $totalWarga    = Resident::whereHas('household', fn($q) => $q->where('rt_id', $id))->where('status', 'Aktif')->count();
        $totalKK       = \App\Models\Household::where('rt_id', $id)->count();
        $totalLaki     = Resident::whereHas('household', fn($q) => $q->where('rt_id', $id))->where('status', 'Aktif')->where('gender', 'Laki-laki')->count();
        $totalPerempuan = $totalWarga - $totalLaki;

        $agama = Resident::whereHas('household', fn($q) => $q->where('rt_id', $id))
            ->where('status', 'Aktif')
            ->select('religion', DB::raw('count(*) as total'))
            ->groupBy('religion')->orderByDesc('total')->get();

        $usia = [
            'Balita'  => Resident::whereHas('household', fn($q) => $q->where('rt_id', $id))->where('status','Aktif')->whereRaw("(strftime('%Y','now') - strftime('%Y',birth_date)) BETWEEN 0 AND 4")->count(),
            'Anak'    => Resident::whereHas('household', fn($q) => $q->where('rt_id', $id))->where('status','Aktif')->whereRaw("(strftime('%Y','now') - strftime('%Y',birth_date)) BETWEEN 5 AND 14")->count(),
            'Remaja'  => Resident::whereHas('household', fn($q) => $q->where('rt_id', $id))->where('status','Aktif')->whereRaw("(strftime('%Y','now') - strftime('%Y',birth_date)) BETWEEN 15 AND 24")->count(),
            'Dewasa'  => Resident::whereHas('household', fn($q) => $q->where('rt_id', $id))->where('status','Aktif')->whereRaw("(strftime('%Y','now') - strftime('%Y',birth_date)) BETWEEN 25 AND 59")->count(),
            'Lansia'  => Resident::whereHas('household', fn($q) => $q->where('rt_id', $id))->where('status','Aktif')->whereRaw("(strftime('%Y','now') - strftime('%Y',birth_date)) >= 60")->count(),
        ];

        $warga = Resident::whereHas('household', fn($q) => $q->where('rt_id', $id))
            ->where('status', 'Aktif')
            ->orderBy('full_name')
            ->get(['full_name', 'gender', 'birth_date', 'religion', 'occupation', 'marital_status']);

        return view('rt.show', compact('rt', 'totalWarga', 'totalKK', 'totalLaki', 'totalPerempuan', 'agama', 'usia', 'warga'));
    }
}
