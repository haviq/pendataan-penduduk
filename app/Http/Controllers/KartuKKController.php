<?php

namespace App\Http\Controllers;

use App\Models\Household;
use App\Models\Resident;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class KartuKKController extends Controller
{
    public function index(Request $request)
    {
        $query = Household::with(['rt.rw', 'head', 'residents'])
            ->withCount('residents');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('no_kk', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhereHas('head', fn($r) => $r->where('full_name', 'like', "%{$search}%"));
            });
        }

        $households = $query->paginate(20)->withQueryString();
        return view('kartu_kk.index', compact('households'));
    }

    public function cetak($id)
    {
        $household = Household::with(['rt.rw', 'residents' => fn($q) => $q->orderBy('relationship_to_head')])
            ->findOrFail($id);

        $pdf = Pdf::loadView('kartu_kk.cetak', compact('household'))
            ->setPaper('a5', 'landscape');

        // Sanitize filename — no_kk hanya boleh alfanumerik & dash
        $filename = 'KK_' . preg_replace('/[^a-zA-Z0-9_\-]/', '', $household->no_kk) . '.pdf';
        return $pdf->download($filename);
    }

    public function cetakBulk(Request $request)
    {
        $request->validate([
            'ids'   => 'required|array|min:1|max:50', // max 50 KK sekaligus
            'ids.*' => 'integer|exists:households,id',
        ]);

        $households = Household::with(['rt.rw', 'residents' => fn($q) => $q->orderBy('relationship_to_head')])
            ->whereIn('id', $request->ids)
            ->get();

        $pdf = Pdf::loadView('kartu_kk.cetak_bulk', compact('households'))
            ->setPaper('a5', 'landscape');

        return $pdf->download('KK_bulk_' . now()->format('Ymd_His') . '.pdf');
    }
}
