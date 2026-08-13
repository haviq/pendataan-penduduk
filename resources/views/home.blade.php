<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Portal Kependudukan</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; font-size: 16px; }

:root {
  --white:   #ffffff;
  --gray-50: #f9fafb;
  --gray-100:#f3f4f6;
  --gray-200:#e5e7eb;
  --gray-300:#d1d5db;
  --gray-400:#9ca3af;
  --gray-500:#6b7280;
  --gray-600:#4b5563;
  --gray-700:#374151;
  --gray-800:#1f2937;
  --gray-900:#111827;
  --blue-50:  #eff6ff;
  --blue-100: #dbeafe;
  --blue-500: #3b82f6;
  --blue-600: #2563eb;
  --blue-700: #1d4ed8;
  --green-50: #f0fdf4;
  --green-100:#dcfce7;
  --green-500:#22c55e;
  --green-600:#16a34a;
  --rose-50:  #fff1f2;
  --rose-100: #ffe4e6;
  --rose-500: #f43f5e;
  --rose-600: #e11d48;
  --amber-50: #fffbeb;
  --amber-100:#fef3c7;
  --amber-500:#f59e0b;
  --amber-600:#d97706;
  --purple-50:#faf5ff;
  --purple-100:#f3e8ff;
  --purple-500:#a855f7;
  --purple-600:#9333ea;
  --teal-50:  #f0fdfa;
  --teal-100: #ccfbf1;
  --teal-500: #14b8a6;
  --teal-600: #0d9488;
  --radius-sm:6px;
  --radius:   10px;
  --radius-lg:14px;
  --shadow-sm:0 1px 2px rgba(0,0,0,.05);
  --shadow:   0 1px 3px rgba(0,0,0,.08),0 1px 2px rgba(0,0,0,.06);
  --shadow-md:0 4px 6px rgba(0,0,0,.06),0 2px 4px rgba(0,0,0,.05);
}

body {
  font-family: 'Inter', system-ui, sans-serif;
  background: var(--gray-50);
  color: var(--gray-900);
  min-height: 100vh;
  -webkit-font-smoothing: antialiased;
}

/* ── NAV ── */
.nav {
  position: sticky; top: 0; z-index: 50;
  background: rgba(255,255,255,.92);
  backdrop-filter: blur(12px);
  border-bottom: 1px solid var(--gray-200);
  height: 56px;
  display: flex; align-items: center;
  padding: 0 20px;
  gap: 12px;
}
.nav-logo {
  width: 32px; height: 32px; border-radius: 8px;
  background: var(--blue-600);
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}
.nav-logo svg { width: 16px; height: 16px; color: white; }
.nav-title { font-size: .9rem; font-weight: 700; color: var(--gray-900); flex: 1; }
.nav-badge {
  display: flex; align-items: center; gap: 5px;
  font-size: .72rem; font-weight: 500; color: var(--green-600);
  background: var(--green-50); border: 1px solid var(--green-100);
  padding: 3px 9px; border-radius: 99px;
}
.nav-badge-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--green-500); animation: pulse 2s infinite; }
@keyframes pulse { 0%,100%{opacity:1} 50%{opacity:.4} }
.nav-link {
  font-size: .8rem; font-weight: 600; color: var(--gray-600);
  text-decoration: none; padding: 5px 12px; border-radius: var(--radius-sm);
  border: 1px solid var(--gray-200);
  transition: background .15s, color .15s;
}
.nav-link:hover { background: var(--gray-100); color: var(--gray-900); }

/* ── PAGE ── */
.page { max-width: 1024px; margin: 0 auto; padding: 28px 20px 64px; }

/* ── HERO ── */
.hero { margin-bottom: 28px; }
.hero-eyebrow {
  display: inline-flex; align-items: center; gap: 6px;
  font-size: .72rem; font-weight: 600; color: var(--blue-600);
  background: var(--blue-50); border: 1px solid var(--blue-100);
  padding: 3px 10px; border-radius: 99px; margin-bottom: 10px;
}
.hero h1 { font-size: clamp(1.5rem,4vw,2.2rem); font-weight: 800; color: var(--gray-900); line-height: 1.15; margin-bottom: 6px; }
.hero p { font-size: .9rem; color: var(--gray-500); max-width: 480px; line-height: 1.65; }

/* ── SECTION TITLE ── */
.sec { margin-bottom: 10px; }
.sec-title { font-size: .72rem; font-weight: 600; color: var(--gray-400); text-transform: uppercase; letter-spacing: .06em; }

/* ── CARDS ── */
.card {
  background: var(--white);
  border: 1px solid var(--gray-200);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-sm);
  padding: 18px;
}
.card-header { display: flex; align-items: center; gap: 8px; margin-bottom: 14px; }
.card-icon { width: 30px; height: 30px; border-radius: 7px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.card-icon svg { width: 15px; height: 15px; }
.card-title { font-size: .82rem; font-weight: 600; color: var(--gray-700); }

/* ── STAT GRID ── */
.stat-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 10px;
  margin-bottom: 10px;
}
@media (min-width: 480px) { .stat-grid { grid-template-columns: repeat(3, 1fr); } }
@media (min-width: 768px) { .stat-grid { grid-template-columns: repeat(5, 1fr); } }

.stat-card {
  background: var(--white);
  border: 1px solid var(--gray-200);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-sm);
  padding: 16px;
  transition: box-shadow .2s, transform .2s;
  cursor: default;
}
.stat-card:hover { box-shadow: var(--shadow-md); transform: translateY(-1px); }
.stat-icon { width: 34px; height: 34px; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-bottom: 10px; }
.stat-icon svg { width: 16px; height: 16px; }
.stat-num { font-size: 1.6rem; font-weight: 800; line-height: 1; letter-spacing: -.03em; color: var(--gray-900); margin-bottom: 3px; }
.stat-label { font-size: .75rem; font-weight: 500; color: var(--gray-500); }
.stat-sub { font-size: .7rem; color: var(--gray-400); margin-top: 2px; }

/* color tokens for icons */
.ic-blue   { background: var(--blue-50);   color: var(--blue-600); }
.ic-green  { background: var(--green-50);  color: var(--green-600); }
.ic-rose   { background: var(--rose-50);   color: var(--rose-600); }
.ic-amber  { background: var(--amber-50);  color: var(--amber-600); }
.ic-purple { background: var(--purple-50); color: var(--purple-600); }
.ic-teal   { background: var(--teal-50);   color: var(--teal-600); }

/* ── ROW 2 STAT ── */
.stat-grid-2 {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 10px;
  margin-bottom: 24px;
}
@media (min-width: 600px) { .stat-grid-2 { grid-template-columns: repeat(4, 1fr); } }

/* ── TWO COLUMN LAYOUT ── */
.two-col {
  display: grid;
  grid-template-columns: 1fr;
  gap: 12px;
  margin-bottom: 12px;
}
@media (min-width: 640px) { .two-col { grid-template-columns: 1fr 1fr; } }

.three-col {
  display: grid;
  grid-template-columns: 1fr;
  gap: 12px;
  margin-bottom: 12px;
}
@media (min-width: 640px) { .three-col { grid-template-columns: 1fr 1fr; } }
@media (min-width: 900px) { .three-col { grid-template-columns: 1fr 1fr 1fr; } }

/* ── USIA BARS ── */
.usia-list { display: flex; flex-direction: column; gap: 13px; }
.usia-row { display: grid; grid-template-columns: 56px 1fr 44px 36px; align-items: center; gap: 10px; }
.usia-label { font-size: .75rem; font-weight: 600; color: var(--gray-600); }
.usia-track { background: var(--gray-100); border-radius: 99px; height: 7px; overflow: hidden; }
.usia-fill { height: 100%; border-radius: 99px; }
.usia-val { font-size: .78rem; font-weight: 700; color: var(--gray-800); text-align: right; }
.usia-pct { font-size: .68rem; color: var(--gray-400); text-align: right; }

/* ── BAR LIST ── */
.bar-list { display: flex; flex-direction: column; gap: 11px; }
.bar-row {}
.bar-top { display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 5px; }
.bar-name { font-size: .8rem; font-weight: 500; color: var(--gray-700); }
.bar-meta { font-size: .72rem; color: var(--gray-400); }
.bar-track { background: var(--gray-100); border-radius: 99px; height: 5px; overflow: hidden; }
.bar-fill { height: 100%; border-radius: 99px; }

/* ── DONUT ── */
.donut-wrap { display: flex; align-items: center; gap: 20px; }
.donut-canvas { width: 110px; height: 110px; flex-shrink: 0; position: relative; }
.donut-canvas canvas { display: block; }
.donut-center {
  position: absolute; inset: 0;
  display: flex; flex-direction: column; align-items: center; justify-content: center;
  pointer-events: none;
}
.donut-center-num { font-size: 1.15rem; font-weight: 800; color: var(--gray-900); line-height: 1; }
.donut-center-lbl { font-size: .58rem; font-weight: 500; color: var(--gray-400); margin-top: 2px; letter-spacing: .03em; text-transform: uppercase; }
.legend { flex: 1; display: flex; flex-direction: column; gap: 9px; }
.legend-row { display: flex; align-items: center; gap: 8px; }
.legend-dot { width: 9px; height: 9px; border-radius: 3px; flex-shrink: 0; }
.legend-name { font-size: .8rem; color: var(--gray-600); flex: 1; }
.legend-val { font-size: .8rem; font-weight: 700; color: var(--gray-800); }
.legend-pct { font-size: .72rem; color: var(--gray-400); margin-left: 3px; }
.legend-divider { height: 1px; background: var(--gray-100); margin: 2px 0; }

/* ── RT GRID ── */
.rt-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 10px;
}
@media (min-width: 480px) { .rt-grid { grid-template-columns: repeat(3, 1fr); } }
@media (min-width: 768px) { .rt-grid { grid-template-columns: repeat(4, 1fr); } }

.rt-card {
  background: var(--white);
  border: 1px solid var(--gray-200);
  border-radius: var(--radius);
  padding: 14px;
  transition: box-shadow .2s;
}
.rt-card:hover { box-shadow: var(--shadow-md); }
.rt-label { font-size: .68rem; font-weight: 600; color: var(--blue-600); text-transform: uppercase; letter-spacing: .05em; margin-bottom: 6px; }
.rt-num { font-size: 1.5rem; font-weight: 800; color: var(--gray-900); line-height: 1; letter-spacing: -.03em; }
.rt-unit { font-size: .72rem; font-weight: 500; color: var(--gray-400); }
.rt-kk { font-size: .72rem; color: var(--gray-400); margin-top: 3px; }
.rt-track { background: var(--gray-100); border-radius: 99px; height: 3px; margin-top: 10px; overflow: hidden; }
.rt-fill { height: 100%; border-radius: 99px; background: var(--blue-500); }

/* ── TABLE ── */
.tbl-top { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; margin-bottom: 14px; }
.tbl-title { font-size: .82rem; font-weight: 600; color: var(--gray-700); }
.search-box {
  display: flex; align-items: center; gap: 7px;
  background: var(--gray-50); border: 1px solid var(--gray-200);
  border-radius: var(--radius-sm); padding: 6px 11px;
  transition: border-color .15s;
}
.search-box:focus-within { border-color: var(--blue-500); background: var(--white); }
.search-box svg { width: 13px; height: 13px; color: var(--gray-400); flex-shrink: 0; }
#tbl-search {
  border: none; outline: none; background: transparent;
  font-family: inherit; font-size: .8rem; color: var(--gray-900);
  width: 160px;
}
#tbl-search::placeholder { color: var(--gray-400); }

.tbl-wrap { overflow-x: auto; }
table { width: 100%; border-collapse: collapse; }
thead tr { border-bottom: 1px solid var(--gray-200); }
th {
  text-align: left; padding: 8px 12px;
  font-size: .7rem; font-weight: 600; color: var(--gray-400);
  text-transform: uppercase; letter-spacing: .06em; white-space: nowrap;
}
td { padding: 11px 12px; border-bottom: 1px solid var(--gray-100); font-size: .82rem; color: var(--gray-600); vertical-align: middle; }
tbody tr:last-child td { border-bottom: none; }
tbody tr:hover td { background: var(--gray-50); }
.td-name { font-weight: 600; color: var(--gray-900); }
.td-age { font-weight: 600; color: var(--blue-600); }
.td-muted { color: var(--gray-400); }
.badge {
  display: inline-flex; align-items: center; justify-content: center;
  padding: 2px 8px; border-radius: 99px;
  font-size: .68rem; font-weight: 600; letter-spacing: .02em;
}
.badge-m { background: var(--blue-50); color: var(--blue-600); }
.badge-f { background: var(--rose-50); color: var(--rose-600); }
.no-result { text-align: center; padding: 32px; color: var(--gray-400); font-size: .85rem; }

/* ── PAGER ── */
.pager { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px; margin-top: 14px; padding-top: 14px; border-top: 1px solid var(--gray-100); }
.pager-info { font-size: .75rem; color: var(--gray-400); }
.pager-btns { display: flex; gap: 4px; flex-wrap: wrap; }
.pg-btn {
  height: 28px; min-width: 28px; padding: 0 8px;
  background: var(--white); border: 1px solid var(--gray-200);
  border-radius: 6px; font-family: inherit; font-size: .75rem;
  font-weight: 500; color: var(--gray-600); cursor: pointer;
  transition: all .15s; display: flex; align-items: center; justify-content: center;
}
.pg-btn:hover:not(:disabled) { background: var(--gray-50); border-color: var(--gray-300); color: var(--gray-900); }
.pg-btn.active { background: var(--blue-600); border-color: var(--blue-600); color: white; }
.pg-btn:disabled { opacity: .35; cursor: default; }

/* ── FOOTER ── */
.footer {
  border-top: 1px solid var(--gray-200);
  padding: 18px 20px;
  display: flex; align-items: center; justify-content: space-between;
  flex-wrap: wrap; gap: 8px;
  max-width: 1024px; margin: 0 auto;
}
.footer-text { font-size: .75rem; color: var(--gray-400); }
.footer-link { font-size: .75rem; font-weight: 500; color: var(--blue-600); text-decoration: none; }
.footer-link:hover { text-decoration: underline; }

/* ── DIVIDER LABEL ── */
.divider { display: flex; align-items: center; gap: 10px; margin: 24px 0 12px; }
.divider-label { font-size: .72rem; font-weight: 600; color: var(--gray-400); text-transform: uppercase; letter-spacing: .06em; white-space: nowrap; }
.divider-line { flex: 1; height: 1px; background: var(--gray-200); }

/* ── UTILS ── */
.mb-12 { margin-bottom: 12px; }
.mb-24 { margin-bottom: 24px; }
</style>
</head>
<body>

<!-- NAV -->
<nav class="nav">
  <div class="nav-logo">
    <svg fill="none" viewBox="0 0 16 16" stroke="currentColor" stroke-width="1.5">
      <circle cx="8" cy="5" r="3"/><path d="M2 14c0-3.31 2.69-6 6-6s6 2.69 6 6"/>
    </svg>
  </div>
  <span class="nav-title">Portal Kependudukan</span>
  <div class="nav-badge">
    <span class="nav-badge-dot"></span>
    Live · {{ number_format($stats['total_penduduk']) }} jiwa
  </div>
  <a href="/admin" class="nav-link">Masuk Admin</a>
</nav>

<!-- PAGE -->
<main class="page">

  <!-- HERO -->
  <div class="hero">
    <div class="hero-eyebrow">
      <svg width="10" height="10" viewBox="0 0 10 10" fill="currentColor"><circle cx="5" cy="5" r="5"/></svg>
      Sistem Informasi Kependudukan
    </div>
    <h1>Data Warga<br>Terpusat & Publik</h1>
    <p>Statistik kependudukan real-time — demografi, distribusi usia, persebaran RT/RW, dan rekap warga terbaru.</p>
  </div>

  <!-- STAT ROW 1 -->
  <div class="sec mb-12"><span class="sec-title">Ringkasan</span></div>
  <div class="stat-grid">

    <div class="stat-card">
      <div class="stat-icon ic-blue">
        <svg fill="none" viewBox="0 0 16 16" stroke="currentColor" stroke-width="1.5"><circle cx="8" cy="5" r="3"/><path d="M2 14c0-3.31 2.69-6 6-6s6 2.69 6 6"/></svg>
      </div>
      <div class="stat-num">{{ number_format($stats['total_penduduk']) }}</div>
      <div class="stat-label">Total Penduduk</div>
      <div class="stat-sub">aktif tercatat</div>
    </div>

    <div class="stat-card">
      <div class="stat-icon ic-green">
        <svg fill="none" viewBox="0 0 16 16" stroke="currentColor" stroke-width="1.5"><circle cx="6" cy="5" r="2.5"/><path d="M1 13c0-2.76 2.24-5 5-5"/><circle cx="12" cy="6" r="2.5"/><path d="M8 13c0-2.76 1.79-5 4-5"/></svg>
      </div>
      <div class="stat-num">{{ number_format($stats['total_laki']) }}</div>
      <div class="stat-label">Laki-laki</div>
      <div class="stat-sub">{{ $stats['rasio_laki'] }}% populasi</div>
    </div>

    <div class="stat-card">
      <div class="stat-icon ic-rose">
        <svg fill="none" viewBox="0 0 16 16" stroke="currentColor" stroke-width="1.5"><circle cx="8" cy="5" r="3"/><path d="M4 13c.5-2.5 2-4 4-4s3.5 1.5 4 4"/></svg>
      </div>
      <div class="stat-num">{{ number_format($stats['total_perempuan']) }}</div>
      <div class="stat-label">Perempuan</div>
      <div class="stat-sub">{{ $stats['rasio_perempuan'] }}% populasi</div>
    </div>

    <div class="stat-card">
      <div class="stat-icon ic-amber">
        <svg fill="none" viewBox="0 0 16 16" stroke="currentColor" stroke-width="1.5"><rect x="1" y="5" width="14" height="9" rx="1.5"/><path d="M5 5V4a3 3 0 0 1 6 0v1"/></svg>
      </div>
      <div class="stat-num">{{ number_format($stats['total_kk']) }}</div>
      <div class="stat-label">Kartu Keluarga</div>
      <div class="stat-sub">KK terdaftar</div>
    </div>

    <div class="stat-card">
      <div class="stat-icon ic-teal">
        <svg fill="none" viewBox="0 0 16 16" stroke="currentColor" stroke-width="1.5"><path d="M8 1l2 5h5l-4 3 1.5 5L8 11l-4.5 3L5 9 1 6h5z"/></svg>
      </div>
      <div class="stat-num">{{ number_format($stats['pemilih_potensial']) }}</div>
      <div class="stat-label">Pemilih Potensial</div>
      <div class="stat-sub">usia ≥ 17 tahun</div>
    </div>

  </div>

  <!-- STAT ROW 2 -->
  <div class="stat-grid-2">
    <div class="stat-card">
      <div class="stat-icon ic-purple">
        <svg fill="none" viewBox="0 0 16 16" stroke="currentColor" stroke-width="1.5"><rect x="2" y="1" width="12" height="14" rx="1.5"/><path d="M5 6h6M5 9h4"/></svg>
      </div>
      <div class="stat-num">{{ number_format($stats['total_nikah']) }}</div>
      <div class="stat-label">Pernikahan</div>
    </div>
    <div class="stat-card">
      <div class="stat-icon ic-blue">
        <svg fill="none" viewBox="0 0 16 16" stroke="currentColor" stroke-width="1.5"><path d="M8 1L1 5v10h14V5z"/><path d="M5 15V9h6v6"/></svg>
      </div>
      <div class="stat-num">{{ number_format($stats['total_rt']) }}</div>
      <div class="stat-label">Rukun Tetangga</div>
    </div>
    <div class="stat-card">
      <div class="stat-icon ic-green">
        <svg fill="none" viewBox="0 0 16 16" stroke="currentColor" stroke-width="1.5"><circle cx="8" cy="8" r="6.5"/><path d="M8 4v4l3 2"/></svg>
      </div>
      <div class="stat-num">{{ number_format($stats['total_rw']) }}</div>
      <div class="stat-label">Rukun Warga</div>
    </div>
    <div class="stat-card">
      <div class="stat-icon ic-amber">
        <svg fill="none" viewBox="0 0 16 16" stroke="currentColor" stroke-width="1.5"><path d="M8 2l1.8 4.2L14 7l-3 3 .7 4.2L8 12l-3.7 2.2.7-4.2-3-3 4.2-.8z"/></svg>
      </div>
      @php $avg = $stats['total_rt'] > 0 ? round($stats['total_penduduk']/$stats['total_rt']) : 0; @endphp
      <div class="stat-num">{{ $avg }}</div>
      <div class="stat-label">Rata-rata / RT</div>
    </div>
  </div>

  <!-- USIA + GENDER -->
  <div class="divider"><span class="divider-label">Demografi</span><div class="divider-line"></div></div>
  <div class="two-col mb-12">

    <!-- DISTRIBUSI USIA -->
    <div class="card">
      <div class="card-header">
        <div class="card-icon ic-blue">
          <svg fill="none" viewBox="0 0 15 15" stroke="currentColor" stroke-width="1.5"><rect x="1" y="4" width="13" height="9" rx="1.5"/><path d="M4 4V3a4 4 0 0 1 7 0v1"/></svg>
        </div>
        <span class="card-title">Distribusi Usia</span>
      </div>
      @php
        $totalUsia = array_sum($usia);
        $usiaMap = [
          'balita' => ['Balita','0–4 thn','#3b82f6'],
          'anak'   => ['Anak','5–14 thn','#14b8a6'],
          'remaja' => ['Remaja','15–24 thn','#22c55e'],
          'dewasa' => ['Dewasa','25–59 thn','#a855f7'],
          'lansia' => ['Lansia','≥60 thn','#f59e0b'],
        ];
      @endphp
      <div class="usia-list">
        @foreach($usiaMap as $key => [$lbl, $sub, $color])
          @php $pct = $totalUsia > 0 ? round($usia[$key]/$totalUsia*100,1) : 0; @endphp
          <div class="usia-row">
            <span class="usia-label" title="{{ $sub }}">{{ $lbl }}</span>
            <div class="usia-track">
              <div class="usia-fill" style="width:0%;background:{{ $color }};" data-target="{{ $pct }}"></div>
            </div>
            <span class="usia-val">{{ number_format($usia[$key]) }}</span>
            <span class="usia-pct">{{ $pct }}%</span>
          </div>
        @endforeach
      </div>
    </div>

    <!-- DONUT GENDER -->
    <div class="card">
      <div class="card-header">
        <div class="card-icon ic-rose">
          <svg fill="none" viewBox="0 0 15 15" stroke="currentColor" stroke-width="1.5"><circle cx="7.5" cy="7.5" r="6"/><path d="M7.5 1.5v6l3.5 3.5"/></svg>
        </div>
        <span class="card-title">Rasio Gender</span>
      </div>
      <div class="donut-wrap">
        <div class="donut-canvas">
          <canvas id="genderChart" width="110" height="110"></canvas>
          <div class="donut-center">
            <span class="donut-center-num">{{ number_format($stats['total_penduduk']) }}</span>
            <span class="donut-center-lbl">Total</span>
          </div>
        </div>
        <div class="legend">
          <div class="legend-row">
            <div class="legend-dot" style="background:#3b82f6;"></div>
            <span class="legend-name">Laki-laki</span>
            <span class="legend-val">{{ number_format($gender['laki']) }}</span>
            <span class="legend-pct">{{ $stats['rasio_laki'] }}%</span>
          </div>
          <div class="legend-row">
            <div class="legend-dot" style="background:#f43f5e;"></div>
            <span class="legend-name">Perempuan</span>
            <span class="legend-val">{{ number_format($gender['perempuan']) }}</span>
            <span class="legend-pct">{{ $stats['rasio_perempuan'] }}%</span>
          </div>
          <div class="legend-divider"></div>
          <div class="legend-row">
            <div class="legend-dot" style="background:#14b8a6;"></div>
            <span class="legend-name">Pemilih</span>
            <span class="legend-val">{{ number_format($stats['pemilih_potensial']) }}</span>
            <span class="legend-pct">{{ $stats['total_penduduk'] > 0 ? round($stats['pemilih_potensial']/$stats['total_penduduk']*100,1) : 0 }}%</span>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- AGAMA + PENDIDIKAN + PEKERJAAN -->
  <div class="three-col mb-12">

    <!-- AGAMA -->
    <div class="card">
      <div class="card-header">
        <div class="card-icon ic-purple">
          <svg fill="none" viewBox="0 0 15 15" stroke="currentColor" stroke-width="1.5"><circle cx="7.5" cy="7.5" r="6"/><path d="M7.5 3v4.5l3 3"/></svg>
        </div>
        <span class="card-title">Agama</span>
      </div>
      @php $totalAgama = $agama->sum('total'); @endphp
      <div class="bar-list">
        @php $barColors=['#3b82f6','#14b8a6','#22c55e','#f59e0b','#a855f7','#f43f5e']; @endphp
        @foreach($agama as $i => $a)
          @php $pct = $totalAgama > 0 ? round($a->total/$totalAgama*100,1) : 0; $c=$barColors[$i%count($barColors)]; @endphp
          <div class="bar-row">
            <div class="bar-top">
              <span class="bar-name">{{ $a->religion ?? 'Lainnya' }}</span>
              <span class="bar-meta">{{ number_format($a->total) }} · {{ $pct }}%</span>
            </div>
            <div class="bar-track"><div class="bar-fill" style="width:0%;background:{{ $c }};" data-target="{{ $pct }}%"></div></div>
          </div>
        @endforeach
      </div>
    </div>

    <!-- PENDIDIKAN -->
    <div class="card">
      <div class="card-header">
        <div class="card-icon ic-teal">
          <svg fill="none" viewBox="0 0 15 15" stroke="currentColor" stroke-width="1.5"><path d="M7.5 1L1 4.5l6.5 3.5 6.5-3.5z"/><path d="M1 4.5v5M14 4.5v5"/><path d="M3 6v3.5a5 5 0 0 0 9 0V6"/></svg>
        </div>
        <span class="card-title">Pendidikan</span>
      </div>
      @php $totalPdd = $pendidikan->sum('total'); @endphp
      <div class="bar-list">
        @foreach($pendidikan as $i => $p)
          @php $pct = $totalPdd > 0 ? round($p->total/$totalPdd*100,1) : 0; $c=$barColors[$i%count($barColors)]; @endphp
          <div class="bar-row">
            <div class="bar-top">
              <span class="bar-name">{{ $p->education ?? 'Lainnya' }}</span>
              <span class="bar-meta">{{ number_format($p->total) }} · {{ $pct }}%</span>
            </div>
            <div class="bar-track"><div class="bar-fill" style="width:0%;background:{{ $c }};" data-target="{{ $pct }}%"></div></div>
          </div>
        @endforeach
      </div>
    </div>

    <!-- PEKERJAAN -->
    <div class="card">
      <div class="card-header">
        <div class="card-icon ic-amber">
          <svg fill="none" viewBox="0 0 15 15" stroke="currentColor" stroke-width="1.5"><rect x="1" y="4" width="13" height="9" rx="1.5"/><path d="M5 4V3h5v1"/></svg>
        </div>
        <span class="card-title">Pekerjaan (Top 8)</span>
      </div>
      @php $totalPkj = $pekerjaan->sum('total'); @endphp
      <div class="bar-list">
        @foreach($pekerjaan as $i => $p)
          @php $pct = $totalPkj > 0 ? round($p->total/$totalPkj*100,1) : 0; $c=$barColors[$i%count($barColors)]; @endphp
          <div class="bar-row">
            <div class="bar-top">
              <span class="bar-name">{{ $p->occupation ?? 'Lainnya' }}</span>
              <span class="bar-meta">{{ number_format($p->total) }} · {{ $pct }}%</span>
            </div>
            <div class="bar-track"><div class="bar-fill" style="width:0%;background:{{ $c }};" data-target="{{ $pct }}%"></div></div>
          </div>
        @endforeach
      </div>
    </div>

  </div>

  <!-- STATUS KAWIN -->
  <div class="two-col mb-12">
    <div class="card">
      <div class="card-header">
        <div class="card-icon ic-rose">
          <svg fill="none" viewBox="0 0 15 15" stroke="currentColor" stroke-width="1.5"><path d="M7.5 1l1.8 4 4.2.5-3 3 .7 4.3-3.7-2-3.7 2 .7-4.3-3-3 4.2-.5z"/></svg>
        </div>
        <span class="card-title">Status Pernikahan</span>
      </div>
      @php $totalKawin = $status_kawin->sum('total'); @endphp
      <div class="bar-list">
        @foreach($status_kawin as $i => $s)
          @php $pct = $totalKawin > 0 ? round($s->total/$totalKawin*100,1) : 0; $c=$barColors[$i%count($barColors)]; @endphp
          <div class="bar-row">
            <div class="bar-top">
              <span class="bar-name">{{ $s->marital_status ?? 'Tidak Diketahui' }}</span>
              <span class="bar-meta">{{ number_format($s->total) }} · {{ $pct }}%</span>
            </div>
            <div class="bar-track"><div class="bar-fill" style="width:0%;background:{{ $c }};" data-target="{{ $pct }}%"></div></div>
          </div>
        @endforeach
      </div>
    </div>
    <!-- placeholder right col kalau mau tambah chart lain -->
    <div></div>
  </div>

  <!-- PERSEBARAN RT -->
  <div class="divider"><span class="divider-label">Persebaran RT</span><div class="divider-line"></div></div>
  @php $maxWarga = $per_rt->max('total_warga') ?: 1; @endphp
  <div class="rt-grid mb-24">
    @forelse($per_rt as $rt)
      @php $pct = round($rt['total_warga']/$maxWarga*100); @endphp
      <div class="rt-card">
        <div class="rt-label">{{ $rt['label'] }}</div>
        <div class="rt-num">{{ number_format($rt['total_warga']) }} <span class="rt-unit">jiwa</span></div>
        <div class="rt-kk">{{ number_format($rt['total_kk']) }} KK</div>
        <div class="rt-track"><div class="rt-fill" style="width:{{ $pct }}%;"></div></div>
      </div>
    @empty
      <p style="color:var(--gray-400);font-size:.85rem;">Belum ada data RT.</p>
    @endforelse
  </div>

  <!-- TABEL WARGA -->
  <div class="divider"><span class="divider-label">Warga Terbaru</span><div class="divider-line"></div></div>
  <div class="card">
    <div class="tbl-top">
      <span class="tbl-title">10 Data Terbaru</span>
      <div class="search-box">
        <svg fill="none" viewBox="0 0 14 14" stroke="currentColor" stroke-width="1.5"><circle cx="6" cy="6" r="4"/><path d="M10 10l3 3"/></svg>
        <input type="text" id="tbl-search" placeholder="Cari nama...">
      </div>
    </div>
    <div class="tbl-wrap">
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Gender</th>
            <th>Usia</th>
            <th>Agama</th>
            <th>Pekerjaan</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody id="tbl-body">
          @foreach($penduduk_terbaru as $i => $p)
          <tr>
            <td class="td-muted">{{ str_pad($i+1,2,'0',STR_PAD_LEFT) }}</td>
            <td class="td-name">{{ $p->full_name }}</td>
            <td>
              <span class="badge {{ $p->gender === 'Laki-laki' ? 'badge-m' : 'badge-f' }}">
                {{ $p->gender === 'Laki-laki' ? 'L' : 'P' }}
              </span>
            </td>
            <td class="td-age">{{ $p->birth_date ? $p->birth_date->age : '—' }}th</td>
            <td>{{ $p->religion ?? '—' }}</td>
            <td>{{ $p->occupation ?? '—' }}</td>
            <td class="td-muted">{{ $p->marital_status ?? '—' }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div id="no-result" class="no-result" style="display:none;">Tidak ada data ditemukan.</div>
    </div>
    <div class="pager">
      <span class="pager-info" id="pager-info"></span>
      <div class="pager-btns" id="pager-btns"></div>
    </div>
  </div>

</main>

<!-- FOOTER -->
<footer>
  <div class="footer">
    <span class="footer-text">Sistem Informasi Kependudukan · Data Publik</span>
    <a href="/admin" class="footer-link">Masuk Admin →</a>
  </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', () => {

  // ── PROGRESS BARS ──
  const animateBars = (selector, delay = 400) => {
    document.querySelectorAll(selector).forEach((el, i) => {
      const target = el.dataset.target;
      setTimeout(() => {
        el.style.transition = 'width .8s cubic-bezier(.4,0,.2,1)';
        el.style.width = typeof target === 'string' && target.endsWith('%') ? target : target + '%';
      }, delay + i * 60);
    });
  };
  animateBars('.usia-fill', 300);
  animateBars('.bar-fill', 500);

  // ── DONUT CHART ──
  const ctx = document.getElementById('genderChart').getContext('2d');
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      datasets: [{
        data: [{{ $gender['laki'] }}, {{ $gender['perempuan'] }}],
        backgroundColor: ['#3b82f6', '#f43f5e'],
        hoverBackgroundColor: ['#2563eb', '#e11d48'],
        borderColor: '#ffffff',
        borderWidth: 3,
        hoverOffset: 3,
      }]
    },
    options: {
      cutout: '74%',
      responsive: false,
      plugins: {
        legend: { display: false },
        tooltip: { callbacks: { label: (c) => ` ${c.formattedValue} jiwa` } }
      },
      animation: { duration: 900 }
    }
  });

  // ── TABLE SEARCH + PAGINATION ──
  const PER_PAGE = 5;
  const tbody = document.getElementById('tbl-body');
  const allRows = Array.from(tbody.querySelectorAll('tr'));
  const noResult = document.getElementById('no-result');
  const pagerInfo = document.getElementById('pager-info');
  const pagerBtns = document.getElementById('pager-btns');
  const search = document.getElementById('tbl-search');
  let page = 1, rows = [...allRows];

  function render() {
    const total = rows.length;
    const pages = Math.max(1, Math.ceil(total / PER_PAGE));
    page = Math.min(page, pages);
    const s = (page-1)*PER_PAGE, e = s+PER_PAGE;
    allRows.forEach(r => r.style.display = 'none');
    rows.slice(s, e).forEach(r => r.style.display = '');
    noResult.style.display = total === 0 ? '' : 'none';
    pagerInfo.textContent = total > 0 ? `${s+1}–${Math.min(e,total)} dari ${total}` : '';
    pagerBtns.innerHTML = '';

    const prev = document.createElement('button');
    prev.className = 'pg-btn'; prev.textContent = '←'; prev.disabled = page===1;
    prev.onclick = () => { page--; render(); };
    pagerBtns.appendChild(prev);

    for (let i=1; i<=pages; i++) {
      const b = document.createElement('button');
      b.className = 'pg-btn' + (i===page?' active':'');
      b.textContent = i; b.onclick = () => { page=i; render(); };
      pagerBtns.appendChild(b);
    }

    const next = document.createElement('button');
    next.className = 'pg-btn'; next.textContent = '→'; next.disabled = page===pages;
    next.onclick = () => { page++; render(); };
    pagerBtns.appendChild(next);
  }

  search.addEventListener('input', () => {
    const q = search.value.toLowerCase().trim();
    rows = q ? allRows.filter(r => r.querySelector('.td-name')?.textContent.toLowerCase().includes(q)) : [...allRows];
    page = 1; render();
  });

  render();
});
</script>
</body>
</html>
