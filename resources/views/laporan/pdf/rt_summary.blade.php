<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Ringkasan Per RT</title>
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Times New Roman',Times,serif;font-size:11pt;color:#000;background:#fff;padding:2cm 2.5cm}
.kop{display:flex;align-items:center;gap:12px;border-bottom:3px double #000;padding-bottom:10px;margin-bottom:10px}
.kop-logo{width:55px;height:55px;border:2px solid #000;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0}
.kop-text{text-align:center;flex:1}
.kop-text h1{font-size:13pt;font-weight:bold;text-transform:uppercase}
.kop-text h2{font-size:11pt;font-weight:bold}
.title{text-align:center;font-size:13pt;font-weight:bold;text-transform:uppercase;text-decoration:underline;margin:16px 0 4px}
.subtitle{text-align:center;font-size:10pt;color:#555;margin-bottom:16px}
table{width:100%;border-collapse:collapse;font-size:10.5pt;margin-top:12px}
th{background:#1e3a5f;color:#fff;padding:7px 10px;text-align:left}
th.right{text-align:right}
td{padding:6px 10px;border:1px solid #ddd}
td.right{text-align:right}
tr:nth-child(even) td{background:#f9fafb}
tfoot td{font-weight:bold;background:#e5e7eb;border-top:2px solid #999}
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
  </div>
</div>

<div class="title">Laporan Ringkasan Per RT</div>
<div class="subtitle">Padukuhan Gondang · Dicetak: {{ $tanggal }}</div>

<table>
  <thead>
    <tr>
      <th>RT</th>
      <th>RW</th>
      <th class="right">Total KK</th>
      <th class="right">Total Warga</th>
      <th class="right">Laki-laki</th>
      <th class="right">Perempuan</th>
    </tr>
  </thead>
  <tbody>
    @foreach($perRt as $rt)
    <tr>
      <td>RT {{ $rt->number }}</td>
      <td>RW {{ $rt->rw?->number ?? '-' }}</td>
      <td class="right">{{ number_format($rt->total_kk) }}</td>
      <td class="right">{{ number_format($rt->total_warga) }}</td>
      <td class="right">{{ number_format($rt->total_laki) }}</td>
      <td class="right">{{ number_format($rt->total_perempuan) }}</td>
    </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <td colspan="2">TOTAL</td>
      <td class="right">{{ number_format($perRt->sum('total_kk')) }}</td>
      <td class="right">{{ number_format($perRt->sum('total_warga')) }}</td>
      <td class="right">{{ number_format($perRt->sum('total_laki')) }}</td>
      <td class="right">{{ number_format($perRt->sum('total_perempuan')) }}</td>
    </tr>
  </tfoot>
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
