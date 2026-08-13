<?php

namespace App\Http\Controllers;

class ImportTemplateController extends Controller
{
    public function downloadResidentTemplate()
    {
        $filename = 'template_import_warga.csv';
        $headers  = ['Content-Type' => 'text/csv', 'Content-Disposition' => "attachment; filename=\"{$filename}\""];

        $callback = function () {
            $f = fopen('php://output', 'w');
            // Header kolom
            fputcsv($f, [
                'household_id', 'nik', 'full_name', 'birth_place', 'birth_date',
                'gender', 'blood_type', 'religion', 'education', 'occupation',
                'marital_status', 'relationship_to_head', 'father_name', 'mother_name',
                'birth_cert_number', 'status',
            ]);
            // Baris contoh 1
            fputcsv($f, [
                '1', '3401234567890001', 'Budi Santoso', 'Sleman', '1990-05-15',
                'Laki-laki', 'O', 'Islam', 'SMA', 'Petani',
                'Belum Kawin', 'Kepala Keluarga', 'Slamet', 'Suminah',
                '', 'Aktif',
            ]);
            // Baris contoh 2
            fputcsv($f, [
                '1', '3401234567890002', 'Siti Rahayu', 'Yogyakarta', '1993-08-20',
                'Perempuan', 'A', 'Islam', 'S1', 'Guru',
                'Kawin', 'Istri', 'Slamet', 'Suminah',
                '', 'Aktif',
            ]);
            fclose($f);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function downloadHouseholdTemplate()
    {
        $filename = 'template_import_kk.csv';
        $headers  = ['Content-Type' => 'text/csv', 'Content-Disposition' => "attachment; filename=\"{$filename}\""];

        $callback = function () {
            $f = fopen('php://output', 'w');
            fputcsv($f, ['rt_id', 'no_kk', 'address']);
            fputcsv($f, ['1', '3401011234560001', 'Dusun Gondang RT 01, Desa Gondang']);
            fputcsv($f, ['2', '3401011234560002', 'Dusun Gondang RT 02, Desa Gondang']);
            fclose($f);
        };

        return response()->stream($callback, 200, $headers);
    }
}
