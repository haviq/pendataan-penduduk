<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\Surat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratController extends Controller
{
    public function index()
    {
        $residents = Resident::where('status', 'Aktif')
            ->orderBy('full_name')
            ->get(['id', 'full_name', 'nik']);

        $riwayat = Surat::with('resident')
            ->latest()
            ->limit(20)
            ->get();

        return view('surat.index', compact('residents', 'riwayat'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'jenis_surat' => 'required|in:domisili,sktm,pengantar_ktp',
            'nomor_surat' => 'nullable|string|max:100',
            'keperluan'   => 'nullable|string',
        ]);

        $resident = Resident::with('household.rt.rw')->findOrFail($request->resident_id);

        // Log surat
        Surat::create([
            'resident_id'    => $resident->id,
            'jenis_surat'    => $request->jenis_surat,
            'nomor_surat'    => $request->nomor_surat,
            'keperluan'      => $request->keperluan,
            'dicetak_oleh'   => Auth::user()?->name ?? 'Admin',
        ]);

        $data = [
            'resident'    => $resident,
            'nomor_surat' => $request->nomor_surat ?? '-',
            'keperluan'   => $request->keperluan ?? '-',
            'tanggal'     => now()->translatedFormat('d F Y'),
        ];

        $view = 'surat.' . $request->jenis_surat;
        $pdf  = Pdf::loadView($view, $data)->setPaper('a4', 'portrait');

        $filename = $request->jenis_surat . '_' . str_replace(' ', '_', $resident->full_name) . '.pdf';
        return $pdf->download($filename);
    }
}
