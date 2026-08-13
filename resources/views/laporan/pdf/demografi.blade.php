<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Kependudukan — SIDUKUH Gondang</title>
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Times New Roman',Times,serif;font-size:11pt;color:#000;background:#fff;padding:2cm 2.5cm}
.kop{display:flex;align-items:center;gap:12px;border-bottom:3px double #000;padding-bottom:10px;margin-bottom:10px}
.kop-logo{width:55px;height:55px;border:2px solid #000;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0}
.kop-text{text-align:center;flex:1}
.kop-text h1{font-size:13pt;font-weight:bold;text-transform:uppercase}
.kop-text h2{font-size:11pt;font-weight:bold}
.kop-text p{font-size:9pt}
.title{text-align:center;font-size:13pt;font-weight:bold;text-transform:uppercase;text-decoration:underline;margin:16px 0 4px}
.subtitle{text-align:center;font-size:10pt;color:#555;margin-bottom:16px}
.meta{font-size:9.5pt;margin-bottom:14px;color:#333}
table{width:100%;border-collapse:collapse;margin:12px 0;font-size:10pt}
th{background:#1e3a5f;color:#fff;padding:6px 8px;text-align:left}
td{padding:5px 8px;border:1px solid #ddd;vertical-align:top}
tr:nth-child(even) td{background:#f9fafb}
.section{font-size:11pt;font-weight:bold;margin:16px 0 6px;padding-bottom:4px;border-bottom:1px solid #999}
.stat-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;margin:10px 0}
.stat-box{border:1px solid #ddd;border-radius:4px;padding:10px;text-align:center}
.stat-num{font-size:16pt;font-weight:bold;color:#1e3a5f}
.stat-lbl{font-size:8.5pt;color:#555;margin-top:3px}
.footer{margin-top:30px;display:flex;justify-content:flex-end}
.ttd{text-align:center;min-width:180px}
.ttd-space{height:60px}
.ttd-name{font-weight:bold;text-decoration:underline}
</style>
</head>
<body>

<div class="kop">
  <div class="kop-logo">🏛️</div>
  <div class="kop-text">
    <h1>Pemerintah Desa Gondang</h1>
    <h2>Kecamatan Cangkringan, Kabupaten Sleman</h2>
    <p>Gondang, Cangkringan, Sleman, D.I. Yogyakarta</p>
  </div>
</div>

<div class="title">Laporan Demografi Kependudukan</div>
<div class="subtitle">Padukuhan Gondang · Dicetak: {{ $tanggal }}</div>

<div class="section">Ringkasan Umum</div>
<div class="stat-grid">
  <div class="stat-box"><div class="stat-num">{{ number_format($total) }}</div><div class="stat-lbl">Total Penduduk</div></div>
  <div class="stat-box"><div class="stat-num">{{ number_format($laki) }}</div><div class="stat-lbl">Laki-laki</div></div>
  <div class="stat-box"><div class="stat-num">{{ number_format($perempuan) }}</div><div class="stat-lbl">Perempuan</div></div>
</div>

<div class="section">Distribusi Usia</div>
<table>
  <thead><tr><th>Kelompok Usia</th><th>Jumlah</th><th>Persentase</th></tr></thead>
  <tbody>
    @foreach($usia as $label => $jumlah)
    <tr>
      <td>{{ $label }}</td>
      <td>{{ number_format($jumlah) }}</td>
      <td>{{ $total > 0 ? round($jumlah/$total*100,1) : 0 }}%</td>
    </tr>
    @endforeach
  </tbody>
</table>

<div class="section">Distribusi Agama</div>
<table>
  <thead><tr><th>Agama</th><th>Jumlah</th><th>Persentase</th></tr></thead>
  <tbody>
    @foreach($agama as $a)
    <tr>
      <td>{{ $a->religion ?? 'Lainnya' }}</td>
      <td>{{ number_format($a->total) }}</td>
      <td>{{ $total > 0 ? round($a->total/$total*100,1) : 0 }}%</td>
    </tr>
    @endforeach
  </tbody>
</table>

<div class="section">Tingkat Pendidikan</div>
<table>
  <thead><tr><th>Pendidikan</th><th>Jumlah</th><th>Persentase</th></tr></thead>
  <tbody>
    @foreach($pendidikan as $p)
    <tr>
      <td>{{ $p->education ?? 'Tidak Diketahui' }}</td>
      <td>{{ number_format($p->total) }}</td>
      <td>{{ $total > 0 ? round($p->total/$total*100,1) : 0 }}%</td>
    </tr>
    @endforeach
  </tbody>
</table>

<div class="footer">
  <div class="ttd">
    <p>Gondang, {{ $tanggal }}</p>
    <p>Kepala Dukuh Gondang</p>
    <div class="ttd-space"></div>
    <p class="ttd-name">___________________</p>
    <p>Kepala Dukuh</p>
  </div>
</div>

</body>
</html>
