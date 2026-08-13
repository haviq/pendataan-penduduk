<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Data Warga</title>
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Arial',sans-serif;font-size:8pt;color:#000;background:#fff;padding:1.5cm 2cm}
.kop{display:flex;align-items:center;gap:10px;border-bottom:2px solid #000;padding-bottom:8px;margin-bottom:8px}
.kop-logo{width:45px;height:45px;border:2px solid #000;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:14px;flex-shrink:0}
.kop-text{text-align:center;flex:1}
.kop-text h1{font-size:11pt;font-weight:bold;text-transform:uppercase}
.kop-text h2{font-size:9pt;font-weight:bold}
.title{text-align:center;font-size:11pt;font-weight:bold;text-decoration:underline;margin:10px 0 4px;text-transform:uppercase}
.subtitle{text-align:center;font-size:8pt;color:#555;margin-bottom:12px}
table{width:100%;border-collapse:collapse;font-size:7.5pt}
th{background:#1e3a5f;color:#fff;padding:4px 5px;text-align:left;font-size:7pt}
td{padding:3px 5px;border-bottom:1px solid #e5e7eb;vertical-align:middle}
tr:nth-child(even) td{background:#f5f5f5}
.footer{margin-top:14px;font-size:7.5pt;color:#555;text-align:right}
</style>
</head>
<body>

<div class="kop">
  <div class="kop-logo">🏛️</div>
  <div class="kop-text">
    <h1>Pemerintah Desa Gondang</h1>
    <h2>Kec. Cangkringan, Kab. Sleman, D.I. Yogyakarta</h2>
  </div>
</div>

<div class="title">Daftar Data Warga</div>
<div class="subtitle">Padukuhan Gondang · Status: {{ ucfirst($filter_status) }} · Dicetak: {{ $tanggal }}</div>

<table>
  <thead>
    <tr>
      <th style="width:20px">No</th>
      <th>Nama Lengkap</th>
      <th>NIK</th>
      <th>L/P</th>
      <th>Tempat, Tgl Lahir</th>
      <th>Agama</th>
      <th>Pekerjaan</th>
      <th>RT/RW</th>
      <th>Alamat KK</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    @foreach($residents as $i => $r)
    <tr>
      <td>{{ $i+1 }}</td>
      <td style="font-weight:600">{{ $r->full_name }}</td>
      <td style="font-family:monospace;font-size:6.5pt">{{ $r->nik }}</td>
      <td>{{ $r->gender === 'Laki-laki' ? 'L' : 'P' }}</td>
      <td>{{ $r->birth_place }}, {{ $r->birth_date?->format('d/m/Y') }}</td>
      <td>{{ $r->religion }}</td>
      <td>{{ $r->occupation ?? '-' }}</td>
      <td>{{ $r->household?->rt?->number ?? '-' }}/{{ $r->household?->rt?->rw?->number ?? '-' }}</td>
      <td style="max-width:120px;overflow:hidden">{{ Str::limit($r->household?->address ?? '-', 30) }}</td>
      <td>{{ $r->status }}</td>
    </tr>
    @endforeach
  </tbody>
</table>

<div class="footer">Total: {{ $residents->count() }} jiwa · Dicetak {{ $tanggal }}</div>

</body>
</html>
