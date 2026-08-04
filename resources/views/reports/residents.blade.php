<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Data Warga</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 11px;
        }
        h2 {
            text-align: center;
            margin-bottom: 2px;
        }
        p.subtitle {
            text-align: center;
            margin-top: 0;
            margin-bottom: 16px;
            color: #444;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #999;
            padding: 4px 6px;
            text-align: left;
        }
        th {
            background-color: #eee;
        }
        .footer {
            margin-top: 20px;
            font-size: 10px;
            color: #555;
        }
    </style>
</head>
<body>
    <h2>Laporan Data Warga</h2>
    <p class="subtitle">Dicetak pada {{ now()->translatedFormat('d F Y, H:i') }} WIB &mdash; Total {{ $residents->count() }} warga</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama Lengkap</th>
                <th>No. KK</th>
                <th>Jenis Kelamin</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Status Keluarga</th>
                <th>Status Kawin</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($residents as $index => $resident)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $resident->nik }}</td>
                    <td>{{ $resident->full_name }}</td>
                    <td>{{ $resident->household->no_kk ?? '-' }}</td>
                    <td>{{ $resident->gender }}</td>
                    <td>{{ $resident->birth_place ?? '-' }}, {{ $resident->birth_date?->translatedFormat('d F Y') }}</td>
                    <td>{{ $resident->relationship_to_head }}</td>
                    <td>{{ $resident->marital_status }}</td>
                    <td>{{ $resident->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="footer">Laporan ini dihasilkan otomatis oleh sistem SIDUKUH Gondang.</p>
</body>
</html>