<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Kartu Keluarga — {{ $household->no_kk }}</title>
<style>
*{box-sizing:border-box;margin:0;padding:0}
@page{size:A5 landscape;margin:1.2cm 1.5cm}
body{font-family:'Arial',sans-serif;font-size:9pt;color:#000;background:#fff}
.kop{display:flex;align-items:center;gap:10px;border-bottom:2px solid #000;padding-bottom:8px;margin-bottom:8px}
.kop-logo{width:45px;height:45px;border:2px solid #000;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0}
.kop-text{text-align:center;flex:1}
.kop-text h1{font-size:11pt;font-weight:bold;text-transform:uppercase;letter-spacing:.5px}
.kop-text h2{font-size:9pt;font-weight:bold}
.kop-text p{font-size:8pt}
.kop-qr{flex-shrink:0;text-align:center}
.kop-qr img{width:60px;height:60px}
.kop-qr p{font-size:7pt;color:#555;margin-top:2px}
.title{text-align:center;font-size:11pt;font-weight:bold;text-transform:uppercase;letter-spacing:1px;margin:8px 0 6px;border:2px solid #000;padding:4px}
.info-grid{display:grid;grid-template-columns:1fr 1fr;gap:4px;margin-bottom:8px}
.info-item{display:flex;gap:4px;font-size:8pt}
.info-item .lbl{color:#555;min-width:80px;flex-shrink:0}
.info-item .val{font-weight:bold}
table{width:100%;border-collapse:collapse;font-size:7.5pt;margin-top:6px}
th{background:#1e3a5f;color:#fff;padding:4px 5px;text-align:left;font-size:7pt}
td{padding:3px 5px;border-bottom:1px solid #e5e7eb;vertical-align:middle}
tr:nth-child(even) td{background:#f9fafb}
.footer{margin-top:8px;display:flex;justify-content:space-between;align-items:flex-end;font-size:7.5pt}
.ttd{text-align:center;min-width:120px}
.ttd-space{height:40px}
.ttd-name{font-weight:bold;text-decoration:underline}
</style>
</head>
<body>

<div class="kop">
  <div class="kop-logo">🏛️</div>
  <div class="kop-text">
    <h1>Kartu Keluarga</h1>
    <h2>Padukuhan Gondang, Desa Gondang, Kec. Cangkringan, Kab. Sleman</h2>
    <p>D.I. Yogyakarta</p>
  </div>
  <div class="kop-qr">
    <img src="https://chart.googleapis.com/chart?chs=70x70&cht=qr&chl={{ urlencode($household->no_kk) }}&choe=UTF-8" alt="QR">
    <p>Scan NIK</p>
  </div>
</div>

<div class="title">KARTU KELUARGA</div>

<div class="info-grid">
  <div class="info-item"><span class="lbl">No. KK</span><span class="val">{{ $household->no_kk }}</span></div>
  <div class="info-item"><span class="lbl">Alamat</span><span class="val">{{ $household->address }}</span></div>
  <div class="info-item"><span class="lbl">RT / RW</span><span class="val">RT {{ $household->rt?->number ?? '-' }} / RW {{ $household->rt?->rw?->number ?? '-' }}</span></div>
  <div class="info-item"><span class="lbl">Desa / Kel.</span><span class="val">Gondang</span></div>
  <div class="info-item"><span class="lbl">Kecamatan</span><span class="val">Cangkringan</span></div>
  <div class="info-item"><span class="lbl">Kabupaten</span><span class="val">Sleman, D.I. Yogyakarta</span></div>
</div>

<table>
  <thead>
    <tr>
      <th style="width:22px">No</th>
      <th>Nama Lengkap</th>
      <th>NIK</th>
      <th>Jenis Kelamin</th>
      <th>TTL</th>
      <th>Agama</th>
      <th>Pendidikan</th>
      <th>Pekerjaan</th>
      <th>Hubungan</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    @foreach($household->residents as $i => $r)
    <tr>
      <td>{{ $i+1 }}</td>
      <td style="font-weight:600">{{ $r->full_name }}</td>
      <td style="font-family:monospace;font-size:7pt">{{ $r->nik }}</td>
      <td>{{ $r->gender === 'Laki-laki' ? 'L' : 'P' }}</td>
      <td>{{ $r->birth_place }}, {{ $r->birth_date?->format('d/m/Y') }}</td>
      <td>{{ $r->religion }}</td>
      <td>{{ $r->education }}</td>
      <td>{{ $r->occupation ?? '-' }}</td>
      <td>{{ $r->relationship_to_head }}</td>
      <td>{{ $r->marital_status }}</td>
    </tr>
    @endforeach
  </tbody>
</table>

<div class="footer">
  <div style="font-size:7pt;color:#555">Dicetak: {{ now()->format('d/m/Y H:i') }} · Data resmi Padukuhan Gondang</div>
  <div class="ttd">
    <p>Gondang, {{ now()->format('d F Y') }}</p>
    <p>Kepala Dukuh Gondang</p>
    <div class="ttd-space"></div>
    <p class="ttd-name">___________________</p>
    <p>Kepala Dukuh</p>
  </div>
</div>

</body>
</html>
