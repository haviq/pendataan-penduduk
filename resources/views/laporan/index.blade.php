<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Laporan — SIDUKUH Gondang</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Inter',system-ui,sans-serif;background:#f9fafb;color:#111827;min-height:100vh;-webkit-font-smoothing:antialiased}
.nav{position:sticky;top:0;z-index:50;background:rgba(255,255,255,.92);backdrop-filter:blur(12px);border-bottom:1px solid #e5e7eb;height:56px;display:flex;align-items:center;padding:0 20px;gap:12px}
.nav-logo{width:32px;height:32px;border-radius:8px;background:#2563eb;display:flex;align-items:center;justify-content:center}
.nav-logo svg{width:16px;height:16px;color:#fff}
.nav-title{font-size:.9rem;font-weight:700;flex:1}
.nav-link{font-size:.8rem;font-weight:600;color:#6b7280;text-decoration:none;padding:5px 12px;border-radius:6px;border:1px solid #e5e7eb}
.page{max-width:900px;margin:0 auto;padding:28px 20px 64px}
.hero{margin-bottom:24px}
.hero-tag{display:inline-flex;align-items:center;gap:6px;font-size:.72rem;font-weight:600;color:#2563eb;background:#eff6ff;border:1px solid #dbeafe;padding:3px 10px;border-radius:99px;margin-bottom:10px}
.hero h1{font-size:1.6rem;font-weight:800;letter-spacing:-.02em;margin-bottom:6px}
.hero p{font-size:.9rem;color:#6b7280;line-height:1.65}
.filter-card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:18px;margin-bottom:20px;display:flex;flex-wrap:wrap;gap:12px;align-items:flex-end}
.filter-group{display:flex;flex-direction:column;gap:4px}
.filter-group label{font-size:.75rem;font-weight:600;color:#374151}
select{font-family:inherit;font-size:.82rem;border:1px solid #e5e7eb;border-radius:8px;padding:7px 10px;background:#fff;color:#111827;outline:none}
select:focus{border-color:#3b82f6}
.reports-grid{display:grid;grid-template-columns:1fr;gap:12px}
@media(min-width:600px){.reports-grid{grid-template-columns:repeat(3,1fr)}}
.report-card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:20px;display:flex;flex-direction:column;gap:12px}
.report-icon{width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.2rem}
.report-title{font-size:.9rem;font-weight:700;color:#111827}
.report-desc{font-size:.78rem;color:#6b7280;line-height:1.55;flex:1}
.report-actions{display:flex;gap:8px;flex-wrap:wrap}
.btn{display:inline-flex;align-items:center;gap:5px;font-family:inherit;font-size:.75rem;font-weight:600;padding:7px 12px;border-radius:7px;border:none;cursor:pointer;text-decoration:none;transition:background .15s}
.btn-pdf{background:#fee2e2;color:#dc2626}
.btn-pdf:hover{background:#fecaca}
.btn-csv{background:#dcfce7;color:#16a34a}
.btn-csv:hover{background:#bbf7d0}
</style>
</head>
<body>
<nav class="nav">
  <div class="nav-logo">
    <svg fill="none" viewBox="0 0 16 16" stroke="currentColor" stroke-width="1.5"><rect x="2" y="2" width="12" height="12" rx="2"/><path d="M5 8h6M5 11h4M5 5h6"/></svg>
  </div>
  <span class="nav-title">Laporan Kependudukan</span>
  <a href="/" class="nav-link">← Beranda</a>
</nav>

<main class="page">
  <div class="hero">
    <div class="hero-tag">📊 Laporan</div>
    <h1>Export Laporan</h1>
    <p>Generate laporan kependudukan dalam format PDF atau CSV. Gunakan filter di bawah untuk mempersempit data.</p>
  </div>

  <div class="filter-card">
    <div class="filter-group">
      <label>Filter RT</label>
      <select id="filter-rt">
        <option value="">Semua RT</option>
        @foreach($rts as $rt)
          <option value="{{ $rt->id }}">RT {{ $rt->number }} / RW {{ $rt->rw?->number ?? '-' }}</option>
        @endforeach
      </select>
    </div>
    <div class="filter-group">
      <label>Filter Status</label>
      <select id="filter-status">
        <option value="Aktif">Aktif saja</option>
        <option value="semua">Semua status</option>
      </select>
    </div>
  </div>

  <div class="reports-grid">
    <div class="report-card">
      <div class="report-icon" style="background:#fef3c7">📊</div>
      <div class="report-title">Laporan Demografi</div>
      <div class="report-desc">Statistik lengkap: total penduduk, gender, distribusi usia, agama, dan tingkat pendidikan.</div>
      <div class="report-actions">
        <a id="btn-demografi-pdf" href="#" class="btn btn-pdf" target="_blank">📄 PDF</a>
      </div>
    </div>

    <div class="report-card">
      <div class="report-icon" style="background:#dbeafe">👥</div>
      <div class="report-title">Daftar Warga</div>
      <div class="report-desc">Daftar lengkap warga dengan NIK, TTL, alamat, RT/RW, dan status kependudukan.</div>
      <div class="report-actions">
        <a id="btn-warga-pdf" href="#" class="btn btn-pdf" target="_blank">📄 PDF</a>
        <a id="btn-warga-csv" href="#" class="btn btn-csv" target="_blank">📥 CSV</a>
      </div>
    </div>

    <div class="report-card">
      <div class="report-icon" style="background:#dcfce7">🏘️</div>
      <div class="report-title">Ringkasan RT</div>
      <div class="report-desc">Rekapitulasi jumlah warga dan KK per RT/RW beserta breakdown gender.</div>
      <div class="report-actions">
        <a id="btn-rt-pdf" href="#" class="btn btn-pdf" target="_blank">📄 PDF</a>
        <a id="btn-rt-csv" href="#" class="btn btn-csv" target="_blank">📥 CSV</a>
      </div>
    </div>
  </div>
</main>

<script>
function buildQuery(){
  const rt = document.getElementById('filter-rt').value;
  const status = document.getElementById('filter-status').value;
  const p = new URLSearchParams();
  if(rt) p.set('filter_rt', rt);
  p.set('filter_status', status);
  return p.toString() ? '?' + p.toString() : '';
}
function updateLinks(){
  const q = buildQuery();
  document.getElementById('btn-demografi-pdf').href = '/laporan/pdf/demografi' + q;
  document.getElementById('btn-warga-pdf').href = '/laporan/pdf/warga' + q;
  document.getElementById('btn-warga-csv').href = '/laporan/csv/warga' + q;
  document.getElementById('btn-rt-pdf').href = '/laporan/pdf/rt_summary' + q;
  document.getElementById('btn-rt-csv').href = '/laporan/csv/rt_summary' + q;
}
document.getElementById('filter-rt').addEventListener('change', updateLinks);
document.getElementById('filter-status').addEventListener('change', updateLinks);
updateLinks();
</script>
</body>
</html>
