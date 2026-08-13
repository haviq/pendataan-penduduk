<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Import Data — SIDUKUH Gondang</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Inter',system-ui,sans-serif;background:#f9fafb;color:#111827;-webkit-font-smoothing:antialiased}
.nav{position:sticky;top:0;z-index:50;background:rgba(255,255,255,.92);backdrop-filter:blur(12px);border-bottom:1px solid #e5e7eb;height:56px;display:flex;align-items:center;padding:0 20px;gap:12px}
.nav-logo{width:32px;height:32px;border-radius:8px;background:#2563eb;display:flex;align-items:center;justify-content:center}
.nav-logo svg{width:16px;height:16px;color:#fff}
.nav-title{font-size:.9rem;font-weight:700;flex:1}
.nav-link{font-size:.8rem;font-weight:600;color:#6b7280;text-decoration:none;padding:5px 12px;border-radius:6px;border:1px solid #e5e7eb}
.page{max-width:800px;margin:0 auto;padding:28px 20px 64px}
.hero{margin-bottom:24px}
.hero-tag{display:inline-flex;align-items:center;gap:6px;font-size:.72rem;font-weight:600;color:#2563eb;background:#eff6ff;border:1px solid #dbeafe;padding:3px 10px;border-radius:99px;margin-bottom:10px}
.hero h1{font-size:1.6rem;font-weight:800;letter-spacing:-.02em;margin-bottom:6px}
.hero p{font-size:.9rem;color:#6b7280;line-height:1.65}
.card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:20px;margin-bottom:14px;box-shadow:0 1px 2px rgba(0,0,0,.05)}
.card-title{font-size:.82rem;font-weight:700;color:#374151;margin-bottom:14px;text-transform:uppercase;letter-spacing:.05em}
.step-list{display:flex;flex-direction:column;gap:12px}
.step{display:flex;align-items:flex-start;gap:12px}
.step-num{width:24px;height:24px;border-radius:99px;background:#2563eb;color:#fff;font-size:.7rem;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px}
.step-text{font-size:.82rem;color:#374151;line-height:1.6}
.step-text strong{color:#111827}
.cols-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:8px;margin-top:12px}
.col-badge{background:#f3f4f6;border:1px solid #e5e7eb;border-radius:6px;padding:6px 10px;font-size:.72rem;font-family:monospace;color:#374151}
.col-badge.required{background:#eff6ff;border-color:#bfdbfe;color:#2563eb}
.btn-row{display:flex;gap:10px;flex-wrap:wrap;margin-top:14px}
.btn{display:inline-flex;align-items:center;gap:7px;font-family:inherit;font-size:.82rem;font-weight:600;padding:9px 16px;border-radius:8px;border:none;cursor:pointer;text-decoration:none;transition:background .15s}
.btn-primary{background:#2563eb;color:#fff}
.btn-primary:hover{background:#1d4ed8}
.btn-outline{background:#fff;color:#374151;border:1px solid #e5e7eb}
.btn-outline:hover{background:#f9fafb}
.info-box{background:#fffbeb;border:1px solid #fde68a;border-radius:8px;padding:12px 14px;font-size:.8rem;color:#92400e;line-height:1.6;margin-top:12px}
</style>
</head>
<body>
<nav class="nav">
  <div class="nav-logo">
    <svg fill="none" viewBox="0 0 16 16" stroke="currentColor" stroke-width="1.5"><path d="M4 13h8M8 3v7M5 7l3 3 3-3"/></svg>
  </div>
  <span class="nav-title">Panduan Import Data</span>
  <a href="/" class="nav-link">← Beranda</a>
</nav>

<main class="page">
  <div class="hero">
    <div class="hero-tag">📥 Import</div>
    <h1>Import Data Massal</h1>
    <p>Upload data warga atau kartu keluarga dalam jumlah banyak menggunakan template CSV yang sudah disediakan.</p>
  </div>

  <!-- DOWNLOAD TEMPLATE -->
  <div class="card">
    <div class="card-title">1. Download Template CSV</div>
    <p style="font-size:.82rem;color:#6b7280;margin-bottom:14px;line-height:1.6">Download template CSV di bawah, isi data sesuai format yang ada, lalu upload melalui panel admin.</p>
    <div class="btn-row">
      <a href="{{ route('import.template.resident') }}" class="btn btn-primary">
        <svg width="14" height="14" fill="none" viewBox="0 0 14 14" stroke="currentColor" stroke-width="1.5"><path d="M4 11h6M7 2v6M4 5l3 3 3-3"/></svg>
        Template Warga (CSV)
      </a>
      <a href="{{ route('import.template.household') }}" class="btn btn-outline">
        <svg width="14" height="14" fill="none" viewBox="0 0 14 14" stroke="currentColor" stroke-width="1.5"><path d="M4 11h6M7 2v6M4 5l3 3 3-3"/></svg>
        Template KK (CSV)
      </a>
    </div>
  </div>

  <!-- KOLOM WARGA -->
  <div class="card">
    <div class="card-title">Kolom Template Warga</div>
    <p style="font-size:.78rem;color:#6b7280;margin-bottom:10px">Kolom <span style="color:#2563eb;font-weight:600">biru</span> = wajib diisi. Kolom abu-abu = opsional.</p>
    <div class="cols-grid">
      <div class="col-badge required">household_id *</div>
      <div class="col-badge required">nik *</div>
      <div class="col-badge required">full_name *</div>
      <div class="col-badge required">birth_date *</div>
      <div class="col-badge required">gender *</div>
      <div class="col-badge required">marital_status *</div>
      <div class="col-badge required">relationship_to_head *</div>
      <div class="col-badge">birth_place</div>
      <div class="col-badge">blood_type</div>
      <div class="col-badge">religion</div>
      <div class="col-badge">education</div>
      <div class="col-badge">occupation</div>
      <div class="col-badge">father_name</div>
      <div class="col-badge">mother_name</div>
      <div class="col-badge">status</div>
    </div>
    <div class="info-box">
      ⚠️ <strong>Catatan:</strong> gender harus <code>Laki-laki</code> atau <code>Perempuan</code>. marital_status: <code>Belum Kawin / Kawin / Cerai Hidup / Cerai Mati</code>. birth_date format: <code>YYYY-MM-DD</code>.
    </div>
  </div>

  <!-- LANGKAH IMPORT -->
  <div class="card">
    <div class="card-title">2. Cara Import di Admin Panel</div>
    <div class="step-list">
      <div class="step"><div class="step-num">1</div><div class="step-text">Download template CSV dan isi data sesuai format.</div></div>
      <div class="step"><div class="step-num">2</div><div class="step-text">Login ke <strong>Admin Panel</strong> di <a href="/admin" style="color:#2563eb">/admin</a>.</div></div>
      <div class="step"><div class="step-num">3</div><div class="step-text">Buka menu <strong>Warga</strong> atau <strong>Kartu Keluarga</strong> di sidebar.</div></div>
      <div class="step"><div class="step-num">4</div><div class="step-text">Klik tombol <strong>Import</strong> di pojok kanan atas tabel.</div></div>
      <div class="step"><div class="step-num">5</div><div class="step-text">Upload file CSV yang sudah diisi, lalu klik <strong>Import</strong>.</div></div>
      <div class="step"><div class="step-num">6</div><div class="step-text">Sistem akan memvalidasi data dan menampilkan error per baris jika ada yang tidak valid.</div></div>
    </div>
    <div class="btn-row" style="margin-top:16px">
      <a href="/admin" class="btn btn-primary">Buka Admin Panel →</a>
    </div>
  </div>
</main>
</body>
</html>
