<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Surat Keterangan Domisili</title>
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Times New Roman',Times,serif;font-size:12pt;color:#000;background:#fff;padding:2cm 2.5cm}
.kop{display:flex;align-items:center;gap:15px;border-bottom:3px double #000;padding-bottom:12px;margin-bottom:12px}
.kop-logo{width:60px;height:60px;border:2px solid #000;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0}
.kop-text{text-align:center;flex:1}
.kop-text h1{font-size:14pt;font-weight:bold;text-transform:uppercase;letter-spacing:1px}
.kop-text h2{font-size:12pt;font-weight:bold;text-transform:uppercase}
.kop-text p{font-size:10pt}
.title{text-align:center;margin:20px 0 6px;font-size:14pt;font-weight:bold;text-transform:uppercase;text-decoration:underline}
.subtitle{text-align:center;font-size:11pt;margin-bottom:20px}
.nomor{text-align:center;font-size:11pt;margin-bottom:24px}
.body-text{margin-bottom:14px;line-height:1.8;text-align:justify}
table.data{width:100%;border-collapse:collapse;margin:16px 0}
table.data td{padding:4px 8px;vertical-align:top;font-size:11pt}
table.data td:first-child{width:40%}
table.data td:nth-child(2){width:4%;text-align:center}
.ttd{margin-top:40px;float:right;text-align:center;width:220px}
.ttd-title{font-size:11pt;margin-bottom:4px}
.ttd-space{height:70px}
.ttd-name{font-size:11pt;font-weight:bold;text-decoration:underline}
.ttd-jabatan{font-size:10pt}
.clear{clear:both}
</style>
</head>
<body>

<div class="kop">
  <div class="kop-logo">🏛️</div>
  <div class="kop-text">
    <h1>Pemerintah Desa Gondang</h1>
    <h2>Kecamatan Cangkringan, Kabupaten Sleman</h2>
    <p>Alamat: Gondang, Cangkringan, Sleman, D.I. Yogyakarta</p>
  </div>
</div>

<div class="title">Surat Keterangan Domisili</div>
<div class="nomor">Nomor: {{ $nomor_surat }}</div>

<p class="body-text">Yang bertanda tangan di bawah ini, Kepala Dukuh Gondang, Desa Gondang, Kecamatan Cangkringan, Kabupaten Sleman, Daerah Istimewa Yogyakarta, dengan ini menerangkan bahwa:</p>

<table class="data">
  <tr><td>Nama Lengkap</td><td>:</td><td><strong>{{ $resident->full_name }}</strong></td></tr>
  <tr><td>NIK</td><td>:</td><td>{{ $resident->nik }}</td></tr>
  <tr><td>Tempat, Tanggal Lahir</td><td>:</td><td>{{ $resident->birth_place }}, {{ $resident->birth_date?->format('d F Y') }}</td></tr>
  <tr><td>Jenis Kelamin</td><td>:</td><td>{{ $resident->gender }}</td></tr>
  <tr><td>Agama</td><td>:</td><td>{{ $resident->religion }}</td></tr>
  <tr><td>Pekerjaan</td><td>:</td><td>{{ $resident->occupation ?? '-' }}</td></tr>
  <tr><td>Alamat</td><td>:</td><td>{{ $resident->household?->address ?? '-' }}, RT {{ $resident->household?->rt?->number ?? '-' }}/RW {{ $resident->household?->rt?->rw?->number ?? '-' }}</td></tr>
  <tr><td>No. KK</td><td>:</td><td>{{ $resident->household?->no_kk ?? '-' }}</td></tr>
</table>

<p class="body-text">Adalah benar warga yang berdomisili di wilayah Padukuhan Gondang, Desa Gondang, Kecamatan Cangkringan, Kabupaten Sleman.</p>

<p class="body-text">Surat keterangan ini dibuat untuk keperluan: <strong>{{ $keperluan }}</strong></p>

<p class="body-text">Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>

<div class="ttd">
  <p class="ttd-title">Gondang, {{ $tanggal }}</p>
  <p class="ttd-title">Kepala Dukuh Gondang</p>
  <div class="ttd-space"></div>
  <p class="ttd-name">___________________</p>
  <p class="ttd-jabatan">Kepala Dukuh</p>
</div>
<div class="clear"></div>

</body>
</html>
