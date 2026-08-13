<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Portal Kependudukan</title>
<link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@500;600;700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<style>
:root {
  --bg:       #06090f;
  --surface:  #0c1220;
  --surface2: #101828;
  --border:   #1a2540;
  --border2:  #243354;
  --text:     #e6edf8;
  --sub:      #8ba3c4;
  --muted:    #4d6a8f;
  --blue:     #2563eb;
  --blue-l:   #3b82f6;
  --blue-ll:  #93c5fd;
  --green:    #16a34a;
  --green-l:  #22c55e;
  --rose:     #be123c;
  --rose-l:   #fb7185;
  --amber:    #b45309;
  --amber-l:  #fbbf24;
  --purple:   #6d28d9;
  --purple-l: #a78bfa;
  --cyan:     #0e7490;
  --cyan-l:   #22d3ee;
  --teal:     #0d9488;
  --teal-l:   #2dd4bf;
}
* { margin: 0; padding: 0; box-sizing: border-box; }
html { scroll-behavior: smooth; }
body {
  font-family: 'Inter', system-ui, sans-serif;
  background: var(--bg);
  color: var(--text);
  min-height: 100vh;
  overflow-x: hidden;
}
body::after {
  content: '';
  position: fixed; inset: 0;
  background-image:
    linear-gradient(rgba(37,99,235,0.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(37,99,235,0.03) 1px, transparent 1px);
  background-size: 52px 52px;
  pointer-events: none;
  z-index: 0;
}

/* NAV */
.nav {
  position: fixed; top: 0; left: 0; right: 0; z-index: 100;
  display: flex; align-items: center; justify-content: space-between;
  padding: 0 24px; height: 52px;
  background: rgba(6,9,15,0.92);
  backdrop-filter: blur(16px);
  border-bottom: 1px solid var(--border);
}
.nav-brand { display: flex; align-items: center; gap: 9px; text-decoration: none; }
.nav-logo {
  width: 28px; height: 28px;
  background: var(--surface2); border: 1px solid var(--border2);
  border-radius: 6px; display: flex; align-items: center; justify-content: center;
}
.nav-logo svg { width: 14px; height: 14px; }
.nav-title {
  font-family: 'Fira Code', monospace;
  font-size: .72rem; font-weight: 700;
  color: var(--blue-ll); letter-spacing: 1.5px;
}
.nav-status { display: flex; align-items: center; gap: 6px; font-family: 'Fira Code', monospace; font-size: .62rem; font-weight: 600; color: var(--muted); letter-spacing: 1px; }
.status-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--green-l); box-shadow: 0 0 7px var(--green-l); animation: blink 2.4s ease-in-out infinite; }
@keyframes blink { 0%,100%{opacity:1} 55%{opacity:.25} }
.nav-btn {
  font-family: 'Fira Code', monospace; font-size: .68rem; font-weight: 700;
  color: var(--blue-ll); text-decoration: none;
  border: 1px solid rgba(59,130,246,0.28);
  padding: 5px 13px; border-radius: 5px;
  background: rgba(37,99,235,0.07);
  transition: background .18s, border-color .18s;
}
.nav-btn:hover { background: rgba(37,99,235,0.16); border-color: rgba(59,130,246,0.55); }

/* HERO */
.hero {
  position: relative; z-index: 1;
  padding: 108px 24px 52px;
  max-width: 960px; margin: 0 auto;
}
.hero-tag {
  display: inline-flex; align-items: center; gap: 6px;
  font-family: 'Fira Code', monospace; font-size: .62rem; font-weight: 700;
  color: var(--blue-ll); letter-spacing: 1.5px;
  border: 1px solid rgba(59,130,246,0.25);
  background: rgba(37,99,235,0.08);
  padding: 4px 11px; border-radius: 4px; margin-bottom: 16px;
}
.hero-tag-dot { width: 5px; height: 5px; border-radius: 50%; background: var(--blue-ll); }
.hero-title {
  font-size: clamp(1.75rem, 5vw, 2.8rem);
  font-weight: 800; line-height: 1.1;
  letter-spacing: -1px; margin-bottom: 12px;
  color: var(--text);
}
.hero-title span { color: var(--blue-l); }
.hero-sub {
  font-size: .9rem; color: var(--sub);
  max-width: 500px; line-height: 1.65;
}

/* MAIN WRAP */
.wrap { position: relative; z-index: 1; max-width: 960px; margin: 0 auto; padding: 0 24px 64px; }

/* SECTION LABEL */
.sec-label {
  font-family: 'Fira Code', monospace;
  font-size: .6rem; font-weight: 700;
  color: var(--muted); letter-spacing: 2px;
  text-transform: uppercase;
  display: flex; align-items: center; gap: 8px;
  margin-bottom: 12px;
}
.sec-label::after { content: ''; flex: 1; height: 1px; background: var(--border); }

/* CARD */
.card {
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: 10px;
  padding: 20px;
}
.card-title {
  font-family: 'Fira Code', monospace;
  font-size: .65rem; font-weight: 700;
  color: var(--muted); letter-spacing: 1.5px;
  text-transform: uppercase; margin-bottom: 16px;
  display: flex; align-items: center; gap: 7px;
}
.card-title svg { width: 12px; height: 12px; }

/* STAT GRID */
.sg { display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px; margin-bottom: 12px; }
.sc {
  background: var(--surface2); border: 1px solid var(--border);
  border-radius: 8px; padding: 16px 12px;
  display: flex; flex-direction: column; gap: 6px;
  transition: border-color .2s, transform .2s;
  cursor: default;
}
.sc:hover { border-color: var(--border2); transform: translateY(-1px); }
.sc-icon { width: 28px; height: 28px; border-radius: 6px; display: flex; align-items: center; justify-content: center; margin-bottom: 4px; }
.sc-icon svg { width: 14px; height: 14px; }
.sc-num { font-family: 'Inter', sans-serif; font-size: 1.55rem; font-weight: 800; line-height: 1; letter-spacing: -1px; }
.sc-lbl { font-family: 'Fira Code', monospace; font-size: .56rem; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: 1px; }
.sc-sub { font-family: 'Fira Code', monospace; font-size: .6rem; color: var(--muted); }

.ic-blue  { background: rgba(37,99,235,0.12); color: var(--blue-l); }
.ic-green { background: rgba(22,163,74,0.12); color: var(--green-l); }
.ic-rose  { background: rgba(190,18,60,0.12); color: var(--rose-l); }
.ic-amber { background: rgba(180,83,9,0.12); color: var(--amber-l); }
.ic-purple{ background: rgba(109,40,217,0.12); color: var(--purple-l); }
.ic-cyan  { background: rgba(14,116,144,0.12); color: var(--cyan-l); }
.ic-teal  { background: rgba(13,148,136,0.12); color: var(--teal-l); }

.cn-blue   { color: var(--blue-l); }
.cn-green  { color: var(--green-l); }
.cn-rose   { color: var(--rose-l); }
.cn-amber  { color: var(--amber-l); }
.cn-purple { color: var(--purple-l); }
.cn-cyan   { color: var(--cyan-l); }
.cn-teal   { color: var(--teal-l); }

/* USIA — progress bar style */
.usia-grid { display: flex; flex-direction: column; gap: 11px; }
.usia-row { display: flex; align-items: center; gap: 10px; }
.usia-lbl { font-family: 'Fira Code', monospace; font-size: .64rem; font-weight: 700; color: var(--sub); width: 54px; flex-shrink: 0; text-transform: uppercase; letter-spacing: .5px; }
.usia-bar-wrap { flex: 1; background: var(--surface2); border-radius: 4px; height: 8px; overflow: hidden; }
.usia-bar { height: 100%; border-radius: 4px; position: relative; }
.usia-bar::after { content: ''; position: absolute; right: 0; top: 0; bottom: 0; width: 2px; background: inherit; filter: brightness(2.5); border-radius: 0 4px 4px 0; }
.usia-num { font-family: 'Fira Code', monospace; font-size: .64rem; font-weight: 700; color: var(--text); width: 38px; text-align: right; flex-shrink: 0; }
.usia-pct { font-family: 'Fira Code', monospace; font-size: .58rem; color: var(--muted); width: 34px; text-align: right; flex-shrink: 0; }

/* CHARTS GRID */
.cg { display: grid; grid-template-columns: repeat(auto-fit, minmax(290px, 1fr)); gap: 12px; margin-bottom: 12px; }

/* BAR CHART */
.bi { margin-bottom: 11px; }
.bi:last-child { margin-bottom: 0; }
.bm { display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px; }
.bn { font-size: .76rem; font-weight: 600; color: var(--sub); }
.bv {
  font-family: 'Fira Code', monospace; font-size: .62rem; font-weight: 700;
  color: var(--muted); background: var(--surface2);
  border: 1px solid var(--border); padding: 1px 7px; border-radius: 4px;
}
.bt { background: var(--surface2); border-radius: 3px; height: 5px; overflow: hidden; }
.bf { height: 100%; border-radius: 3px; position: relative; }
.bf::after { content: ''; position: absolute; right: 0; top: 0; bottom: 0; width: 2px; background: inherit; filter: brightness(2); border-radius: 0 3px 3px 0; }
.fb { background: linear-gradient(90deg, #1e3a8a, #3b82f6); }
.fg { background: linear-gradient(90deg, #14532d, #22c55e); }
.fa { background: linear-gradient(90deg, #78350f, #fbbf24); }
.fp { background: linear-gradient(90deg, #3b0764, #a78bfa); }
.fc { background: linear-gradient(90deg, #164e63, #22d3ee); }
.ft2{ background: linear-gradient(90deg, #134e4a, #2dd4bf); }

/* DONUT */
.donut-wrap { display: flex; align-items: center; gap: 20px; }
.donut-canvas-wrap { width: 120px; height: 120px; flex-shrink: 0; position: relative; }
.donut-center {
  position: absolute; inset: 0; display: flex; flex-direction: column;
  align-items: center; justify-content: center; pointer-events: none;
}
.donut-center-num { font-size: 1.1rem; font-weight: 800; color: var(--text); line-height: 1; }
.donut-center-lbl { font-family: 'Fira Code', monospace; font-size: .48rem; color: var(--muted); letter-spacing: 1px; text-transform: uppercase; margin-top: 2px; }
.donut-legend { flex: 1; }
.dl-row { display: flex; align-items: center; gap: 8px; margin-bottom: 9px; }
.dl-row:last-child { margin-bottom: 0; }
.dl-dot { width: 8px; height: 8px; border-radius: 2px; flex-shrink: 0; }
.dl-name { font-size: .8rem; font-weight: 600; color: var(--sub); flex: 1; }
.dl-val { font-family: 'Fira Code', monospace; font-size: .68rem; font-weight: 700; color: var(--text); }
.dl-pct { font-family: 'Fira Code', monospace; font-size: .62rem; color: var(--muted); margin-left: 4px; }

/* RT TABLE */
.rt-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 10px; }
.rt-card {
  background: var(--surface2); border: 1px solid var(--border);
  border-radius: 8px; padding: 14px;
  display: flex; flex-direction: column; gap: 4px;
  transition: border-color .2s;
}
.rt-card:hover { border-color: var(--border2); }
.rt-card-label { font-family: 'Fira Code', monospace; font-size: .62rem; font-weight: 700; color: var(--blue-ll); letter-spacing: 1px; text-transform: uppercase; }
.rt-nums { display: flex; align-items: baseline; gap: 4px; margin-top: 4px; }
.rt-big { font-size: 1.6rem; font-weight: 800; color: var(--text); line-height: 1; letter-spacing: -1px; }
.rt-unit { font-family: 'Fira Code', monospace; font-size: .6rem; color: var(--muted); }
.rt-kk { font-family: 'Fira Code', monospace; font-size: .62rem; color: var(--muted); }
.rt-bar-wrap { background: var(--border); border-radius: 3px; height: 3px; margin-top: 8px; overflow: hidden; }
.rt-bar { height: 100%; border-radius: 3px; background: linear-gradient(90deg, #1e3a8a, #3b82f6); }

/* TABLE */
.tbl-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px; flex-wrap: wrap; gap: 10px; }
.search-wrap { position: relative; }
.search-wrap svg { position: absolute; left: 10px; top: 50%; transform: translateY(-50%); width: 12px; height: 12px; color: var(--muted); pointer-events: none; }
#tbl-search {
  font-family: 'Fira Code', monospace; font-size: .68rem; font-weight: 600;
  background: var(--surface2); border: 1px solid var(--border);
  color: var(--text); padding: 6px 10px 6px 30px;
  border-radius: 6px; width: 200px; outline: none;
  transition: border-color .18s;
}
#tbl-search:focus { border-color: var(--border2); }
#tbl-search::placeholder { color: var(--muted); }

.tw { overflow-x: auto; }
table { width: 100%; border-collapse: collapse; font-size: .79rem; }
thead tr { border-bottom: 1px solid var(--border2); }
th {
  text-align: left; padding: 9px 12px;
  font-family: 'Fira Code', monospace;
  font-size: .58rem; font-weight: 700;
  color: var(--muted); text-transform: uppercase; letter-spacing: 1.5px;
}
td { padding: 10px 12px; border-bottom: 1px solid rgba(26,37,64,0.6); color: var(--sub); vertical-align: middle; }
tr:last-child td { border-bottom: none; }
tr:hover td { background: rgba(37,99,235,0.04); }
.tname { font-weight: 700; color: var(--text) !important; }
.tage { font-family: 'Fira Code', monospace; font-size: .68rem; color: var(--blue-ll) !important; }
.tnum { font-family: 'Fira Code', monospace; color: var(--muted) !important; font-size: .66rem !important; }
.badge {
  display: inline-flex; align-items: center;
  padding: 2px 8px; border-radius: 4px;
  font-family: 'Fira Code', monospace; font-size: .58rem; font-weight: 700; letter-spacing: .5px;
}
.bL { background: rgba(37,99,235,0.12); color: var(--blue-ll); border: 1px solid rgba(37,99,235,0.22); }
.bP { background: rgba(190,18,60,0.12); color: var(--rose-l); border: 1px solid rgba(190,18,60,0.22); }
.no-result { text-align: center; padding: 24px; color: var(--muted); font-family: 'Fira Code', monospace; font-size: .7rem; }

/* PAGINATION */
.pager { display: flex; align-items: center; justify-content: space-between; margin-top: 14px; flex-wrap: wrap; gap: 8px; }
.pager-info { font-family: 'Fira Code', monospace; font-size: .6rem; color: var(--muted); }
.pager-btns { display: flex; gap: 4px; }
.pg-btn {
  font-family: 'Fira Code', monospace; font-size: .62rem; font-weight: 700;
  color: var(--sub); background: var(--surface2); border: 1px solid var(--border);
  padding: 4px 10px; border-radius: 4px; cursor: pointer;
  transition: background .15s, border-color .15s, color .15s;
}
.pg-btn:hover:not(:disabled) { background: var(--surface); border-color: var(--border2); color: var(--text); }
.pg-btn:disabled { opacity: .35; cursor: default; }
.pg-btn.active { background: rgba(37,99,235,0.15); border-color: rgba(59,130,246,0.35); color: var(--blue-ll); }

/* FOOTER */
.footer {
  position: relative; z-index: 1;
  border-top: 1px solid var(--border);
  padding: 18px 24px;
  display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px;
}
.ft { font-family: 'Fira Code', monospace; font-size: .62rem; font-weight: 600; color: var(--muted); letter-spacing: .5px; }
.fa-link { color: var(--blue-ll); text-decoration: none; }
.fa-link:hover { text-decoration: underline; }

@media (max-width: 640px) {
  .sg { grid-template-columns: repeat(3,1fr); }
  .hero { padding: 90px 16px 40px; }
  .wrap { padding: 0 16px 48px; }
  .footer { flex-direction: column; align-items: flex-start; }
}
</style>
</head>
<body>

<!-- NAV -->
<nav class="nav">
  <a href="/" class="nav-brand">
    <div class="nav-logo">
      <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5">
        <rect x="1" y="1" width="12" height="12" rx="2"/>
        <path d="M4 7h6M7 4v6"/>
      </svg>
    </div>
    <span class="nav-title">PENDUDUK.SYS</span>
  </a>
  <div class="nav-status">
    <span class="status-dot"></span>
    <span>LIVE — {{ number_format($stats['total_penduduk']) }} JIWA</span>
  </div>
  <a href="/admin" class="nav-btn">LOGIN_ADMIN</a>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="hero-tag"><span class="hero-tag-dot"></span>SISTEM INFORMASI KEPENDUDUKAN</div>
  <h1 class="hero-title">Portal Data<br><span>Warga Publik</span></h1>
  <p class="hero-sub">Data kependudukan real-time. Statistik demografi, distribusi usia, persebaran RT/RW, dan laporan warga terbaru.</p>
</section>

<div class="wrap">

  <!-- ===== STATS UTAMA ===== -->
  <div class="sec-label">RINGKASAN DATA</div>
  <div id="sg" class="sg" style="margin-bottom:12px;">

    <div class="sc">
      <div class="sc-icon ic-blue">
        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="7" cy="4" r="2.5"/><path d="M2 12c0-2.76 2.24-5 5-5s5 2.24 5 5"/></svg>
      </div>
      <div class="sc-num cn-blue">{{ number_format($stats['total_penduduk']) }}</div>
      <div class="sc-lbl">Total Penduduk</div>
      <div class="sc-sub">aktif tercatat</div>
    </div>

    <div class="sc">
      <div class="sc-icon ic-green">
        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="5.5" cy="4" r="2"/><path d="M1 12c0-2.2 2-4 4.5-4"/><circle cx="10" cy="5" r="2"/><path d="M7 12c0-2.2 1.8-4 4-4"/></svg>
      </div>
      <div class="sc-num cn-green">{{ number_format($stats['total_laki']) }}</div>
      <div class="sc-lbl">Laki-laki</div>
      <div class="sc-sub">{{ $stats['rasio_laki'] }}% populasi</div>
    </div>

    <div class="sc">
      <div class="sc-icon ic-rose">
        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="7" cy="4" r="2.5"/><path d="M3.5 12c.5-2 1.8-3 3.5-3s3 1 3.5 3"/></svg>
      </div>
      <div class="sc-num cn-rose">{{ number_format($stats['total_perempuan']) }}</div>
      <div class="sc-lbl">Perempuan</div>
      <div class="sc-sub">{{ $stats['rasio_perempuan'] }}% populasi</div>
    </div>

    <div class="sc">
      <div class="sc-icon ic-amber">
        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="1" y="4" width="12" height="8" rx="1.5"/><path d="M4 4V3a3 3 0 0 1 6 0v1"/></svg>
      </div>
      <div class="sc-num cn-amber">{{ number_format($stats['total_kk']) }}</div>
      <div class="sc-lbl">Total KK</div>
      <div class="sc-sub">kartu keluarga</div>
    </div>

    <div class="sc">
      <div class="sc-icon ic-teal">
        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M7 1l1.5 4h4l-3.3 2.4 1.3 4L7 9l-3.5 2.4 1.3-4L1.5 5h4z"/></svg>
      </div>
      <div class="sc-num cn-teal">{{ number_format($stats['pemilih_potensial']) }}</div>
      <div class="sc-lbl">Pemilih Potensial</div>
      <div class="sc-sub">usia ≥ 17 tahun</div>
    </div>

  </div>

  <!-- Row 2: KK, Nikah, RT, RW -->
  <div class="sg" style="grid-template-columns:repeat(4,1fr);margin-bottom:24px;">
    <div class="sc">
      <div class="sc-icon ic-cyan">
        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="1" width="10" height="12" rx="1.5"/><path d="M5 5h4M5 8h4"/></svg>
      </div>
      <div class="sc-num cn-cyan">{{ number_format($stats['total_nikah']) }}</div>
      <div class="sc-lbl">Pernikahan</div>
      <div class="sc-sub">data tercatat</div>
    </div>
    <div class="sc">
      <div class="sc-icon ic-purple">
        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M7 1L2 4v8h10V4z"/><path d="M5 12V8h4v4"/></svg>
      </div>
      <div class="sc-num cn-purple">{{ number_format($stats['total_rt']) }}</div>
      <div class="sc-lbl">Total RT</div>
      <div class="sc-sub">rukun tetangga</div>
    </div>
    <div class="sc">
      <div class="sc-icon ic-blue">
        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="7" cy="7" r="5.5"/><path d="M7 4v3l2 2"/></svg>
      </div>
      <div class="sc-num cn-blue">{{ number_format($stats['total_rw']) }}</div>
      <div class="sc-lbl">Total RW</div>
      <div class="sc-sub">rukun warga</div>
    </div>
    <div class="sc" style="border: 1px solid rgba(59,130,246,0.25); background: rgba(37,99,235,0.06);">
      <div class="sc-icon ic-green">
        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M7 1l1.5 4h4l-3.3 2.4 1.3 4L7 9l-3.5 2.4 1.3-4L1.5 5h4z"/></svg>
      </div>
      @php $avg = $stats['total_rt'] > 0 ? round($stats['total_penduduk']/$stats['total_rt']) : 0; @endphp
      <div class="sc-num cn-green">{{ $avg }}</div>
      <div class="sc-lbl">Rata-rata / RT</div>
      <div class="sc-sub">jiwa per RT</div>
    </div>
  </div>

  <!-- ===== DISTRIBUSI USIA ===== -->
  <div class="sec-label">DISTRIBUSI USIA</div>
  <div class="card" style="margin-bottom:12px;" id="usia-card">
    <div class="card-title">
      <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="1" y="3" width="10" height="7" rx="1"/><path d="M4 3V2M8 3V2"/></svg>
      KELOMPOK USIA PENDUDUK
    </div>
    @php
      $totalUsia = array_sum($usia);
      $usiaConfig = [
        'balita' => ['label'=>'BALITA','sub'=>'0–4 thn','color'=>'linear-gradient(90deg,#3b0764,#a78bfa)','hex'=>'#a78bfa'],
        'anak'   => ['label'=>'ANAK','sub'=>'5–14 thn','color'=>'linear-gradient(90deg,#164e63,#22d3ee)','hex'=>'#22d3ee'],
        'remaja' => ['label'=>'REMAJA','sub'=>'15–24 thn','color'=>'linear-gradient(90deg,#14532d,#22c55e)','hex'=>'#22c55e'],
        'dewasa' => ['label'=>'DEWASA','sub'=>'25–59 thn','color'=>'linear-gradient(90deg,#1e3a8a,#3b82f6)','hex'=>'#3b82f6'],
        'lansia' => ['label'=>'LANSIA','sub'=>'≥60 thn','color'=>'linear-gradient(90deg,#78350f,#fbbf24)','hex'=>'#fbbf24'],
      ];
    @endphp
    <div class="usia-grid">
      @foreach($usiaConfig as $key => $cfg)
        @php $pct = $totalUsia > 0 ? round($usia[$key]/$totalUsia*100,1) : 0; @endphp
        <div class="usia-row">
          <span class="usia-lbl">{{ $cfg['label'] }}</span>
          <div class="usia-bar-wrap">
            <div class="usia-bar" style="width:{{ $pct }}%;background:{{ $cfg['color'] }};" data-target="{{ $pct }}"></div>
          </div>
          <span class="usia-num">{{ number_format($usia[$key]) }}</span>
          <span class="usia-pct">{{ $pct }}%</span>
        </div>
      @endforeach
    </div>
  </div>

  <!-- ===== CHARTS ROW 1: Gender + Status Kawin ===== -->
  <div class="sec-label">DEMOGRAFI</div>
  <div class="cg">

    <!-- DONUT GENDER -->
    <div class="card">
      <div class="card-title">
        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="6" cy="6" r="5"/><path d="M6 1v5l3 3"/></svg>
        RASIO GENDER
      </div>
      <div class="donut-wrap">
        <div class="donut-canvas-wrap">
          <canvas id="genderChart" width="120" height="120"></canvas>
          <div class="donut-center">
            <span class="donut-center-num">{{ number_format($stats['total_penduduk']) }}</span>
            <span class="donut-center-lbl">TOTAL</span>
          </div>
        </div>
        <div class="donut-legend">
          <div class="dl-row">
            <div class="dl-dot" style="background:#3b82f6;"></div>
            <span class="dl-name">Laki-laki</span>
            <span class="dl-val">{{ number_format($gender['laki']) }}</span>
            <span class="dl-pct">{{ $stats['rasio_laki'] }}%</span>
          </div>
          <div class="dl-row">
            <div class="dl-dot" style="background:#fb7185;"></div>
            <span class="dl-name">Perempuan</span>
            <span class="dl-val">{{ number_format($gender['perempuan']) }}</span>
            <span class="dl-pct">{{ $stats['rasio_perempuan'] }}%</span>
          </div>
          <div class="dl-row" style="margin-top:8px;padding-top:8px;border-top:1px solid var(--border);">
            <div class="dl-dot" style="background:#2dd4bf;"></div>
            <span class="dl-name">Pemilih</span>
            <span class="dl-val">{{ number_format($stats['pemilih_potensial']) }}</span>
            <span class="dl-pct">{{ $stats['total_penduduk'] > 0 ? round($stats['pemilih_potensial']/$stats['total_penduduk']*100,1) : 0 }}%</span>
          </div>
        </div>
      </div>
    </div>

    <!-- STATUS KAWIN -->
    <div class="card">
      <div class="card-title">
        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 1l1.2 3.6h3.8L8 6.9l1.2 3.6L6 8.2 2.8 10.5 4 6.9 1 4.6h3.8z"/></svg>
        STATUS PERNIKAHAN
      </div>
      @php $totalKawin = $status_kawin->sum('total'); @endphp
      @foreach($status_kawin as $i => $s)
        @php
          $pct = $totalKawin > 0 ? round($s->total/$totalKawin*100,1) : 0;
          $colors = ['fb','fg','fa','fp','fc'];
          $col = $colors[$i % count($colors)];
        @endphp
        <div class="bi">
          <div class="bm">
            <span class="bn">{{ $s->marital_status ?? 'Tidak Diketahui' }}</span>
            <span class="bv">{{ number_format($s->total) }} · {{ $pct }}%</span>
          </div>
          <div class="bt"><div class="bf {{ $col }}" style="width:0%" data-target="{{ $pct }}%"></div></div>
        </div>
      @endforeach
    </div>

    <!-- AGAMA -->
    <div class="card">
      <div class="card-title">
        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="6" cy="6" r="5"/><path d="M6 3v6M3 6h6"/></svg>
        AGAMA
      </div>
      @php $totalAgama = $agama->sum('total'); @endphp
      @foreach($agama as $i => $a)
        @php
          $pct = $totalAgama > 0 ? round($a->total/$totalAgama*100,1) : 0;
          $colors = ['fb','fc','fg','fa','fp','ft2'];
          $col = $colors[$i % count($colors)];
        @endphp
        <div class="bi">
          <div class="bm">
            <span class="bn">{{ $a->religion ?? 'Lainnya' }}</span>
            <span class="bv">{{ number_format($a->total) }} · {{ $pct }}%</span>
          </div>
          <div class="bt"><div class="bf {{ $col }}" style="width:0%" data-target="{{ $pct }}%"></div></div>
        </div>
      @endforeach
    </div>

  </div>

  <!-- ===== CHARTS ROW 2: Pendidikan + Pekerjaan ===== -->
  <div class="cg">

    <div class="card">
      <div class="card-title">
        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 1L1 4l5 3 5-3z"/><path d="M1 4v4M11 4v4"/><path d="M3 5.5v2.7a4 4 0 0 0 6 0V5.5"/></svg>
        TINGKAT PENDIDIKAN
      </div>
      @php $totalPdd = $pendidikan->sum('total'); @endphp
      @foreach($pendidikan as $i => $p)
        @php
          $pct = $totalPdd > 0 ? round($p->total/$totalPdd*100,1) : 0;
          $colors = ['fb','fc','fg','fa','fp','ft2'];
          $col = $colors[$i % count($colors)];
        @endphp
        <div class="bi">
          <div class="bm">
            <span class="bn">{{ $p->education ?? 'Tidak Diketahui' }}</span>
            <span class="bv">{{ number_format($p->total) }} · {{ $pct }}%</span>
          </div>
          <div class="bt"><div class="bf {{ $col }}" style="width:0%" data-target="{{ $pct }}%"></div></div>
        </div>
      @endforeach
    </div>

    <div class="card">
      <div class="card-title">
        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="1" y="3" width="10" height="7" rx="1"/><path d="M4 3V2h4v1"/></svg>
        PEKERJAAN (TOP 8)
      </div>
      @php $totalPkj = $pekerjaan->sum('total'); @endphp
      @foreach($pekerjaan as $i => $p)
        @php
          $pct = $totalPkj > 0 ? round($p->total/$totalPkj*100,1) : 0;
          $colors = ['fb','fc','fg','fa','fp','ft2','fb','fc'];
          $col = $colors[$i % count($colors)];
        @endphp
        <div class="bi">
          <div class="bm">
            <span class="bn">{{ $p->occupation ?? 'Lainnya' }}</span>
            <span class="bv">{{ number_format($p->total) }} · {{ $pct }}%</span>
          </div>
          <div class="bt"><div class="bf {{ $col }}" style="width:0%" data-target="{{ $pct }}%"></div></div>
        </div>
      @endforeach
    </div>

  </div>

  <!-- ===== PERSEBARAN PER RT ===== -->
  <div class="sec-label" style="margin-top:12px;">PERSEBARAN PER RT</div>
  <div class="card" style="margin-bottom:12px;" id="rt-card">
    <div class="card-title">
      <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 1L1 4v7h10V4z"/><path d="M4 11V7h4v4"/></svg>
      JUMLAH WARGA PER RUKUN TETANGGA
    </div>
    @php $maxWarga = $per_rt->max('total_warga') ?: 1; @endphp
    <div class="rt-grid">
      @forelse($per_rt as $rt)
        @php $pct = round($rt['total_warga'] / $maxWarga * 100); @endphp
        <div class="rt-card">
          <div class="rt-card-label">{{ $rt['label'] }}</div>
          <div class="rt-nums">
            <span class="rt-big">{{ number_format($rt['total_warga']) }}</span>
            <span class="rt-unit">jiwa</span>
          </div>
          <div class="rt-kk">{{ number_format($rt['total_kk']) }} KK</div>
          <div class="rt-bar-wrap">
            <div class="rt-bar" style="width:{{ $pct }}%"></div>
          </div>
        </div>
      @empty
        <div style="color:var(--muted);font-family:'Fira Code',monospace;font-size:.7rem;">Belum ada data RT</div>
      @endforelse
    </div>
  </div>

  <!-- ===== TABEL PENDUDUK TERBARU ===== -->
  <div class="sec-label" style="margin-top:12px;">PENDUDUK TERBARU</div>
  <div class="card" id="tbl-card">
    <div class="tbl-head">
      <div class="card-title" style="margin-bottom:0;">
        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="1" y="1" width="10" height="10" rx="1.5"/><path d="M3 4h6M3 7h4"/></svg>
        10 DATA TERBARU
      </div>
      <div class="search-wrap">
        <svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="5" cy="5" r="3.5"/><path d="M8 8l2.5 2.5"/></svg>
        <input type="text" id="tbl-search" placeholder="Cari nama...">
      </div>
    </div>
    <div class="tw">
      <table id="tbl-main">
        <thead>
          <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Gender</th>
            <th>Usia</th>
            <th>Agama</th>
            <th>Pekerjaan</th>
            <th>Status Nikah</th>
          </tr>
        </thead>
        <tbody id="tbl-body">
          @foreach($penduduk_terbaru as $i => $p)
          <tr>
            <td class="tnum">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</td>
            <td class="tname">{{ $p->full_name }}</td>
            <td>
              <span class="badge {{ $p->gender === 'Laki-laki' ? 'bL' : 'bP' }}">
                {{ $p->gender === 'Laki-laki' ? 'L' : 'P' }}
              </span>
            </td>
            <td class="tage">{{ $p->birth_date ? $p->birth_date->age : '—' }} thn</td>
            <td>{{ $p->religion ?? '—' }}</td>
            <td>{{ $p->occupation ?? '—' }}</td>
            <td class="tnum">{{ $p->marital_status ?? '—' }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div id="no-result" class="no-result" style="display:none;">Tidak ada hasil ditemukan</div>
    </div>
    <div class="pager">
      <span class="pager-info" id="pager-info"></span>
      <div class="pager-btns" id="pager-btns"></div>
    </div>
  </div>

</div><!-- /wrap -->

<!-- FOOTER -->
<footer class="footer">
  <span class="ft">SISTEM INFORMASI KEPENDUDUKAN — DATA PUBLIK</span>
  <a href="/admin" class="fa-link ft">LOGIN_ADMIN</a>
</footer>

<script>
document.addEventListener('DOMContentLoaded', () => {

  // ── GSAP ENTRANCE ──
  gsap.from('#sg .sc', { opacity:0, y:18, scale:.96, duration:.38, stagger:{each:.055,from:'start'}, ease:'back.out(1.3)', delay:.15 });
  gsap.from('#usia-card .usia-row', { opacity:0, x:-10, duration:.3, stagger:.06, ease:'power2.out', delay:.4 });
  gsap.from('#rt-card .rt-card', { opacity:0, y:10, scale:.97, duration:.3, stagger:.05, ease:'back.out(1.2)', delay:.5 });
  gsap.from('#tbl-card tbody tr', { opacity:0, x:-6, duration:.26, stagger:.04, ease:'power1.out', delay:.65 });

  // ── USIA PROGRESS BARS ──
  document.querySelectorAll('.usia-bar').forEach(bar => {
    const target = bar.dataset.target;
    bar.style.width = '0%';
    setTimeout(() => {
      bar.style.transition = 'width 1s cubic-bezier(.4,0,.2,1)';
      bar.style.width = target + '%';
    }, 500);
  });

  // ── REGULAR PROGRESS BARS ──
  document.querySelectorAll('.bf').forEach(bar => {
    const w = bar.dataset.target || bar.style.width;
    bar.style.width = '0%';
    setTimeout(() => {
      bar.style.transition = 'width .9s cubic-bezier(.4,0,.2,1)';
      bar.style.width = w;
    }, 700);
  });

  // ── CHART.JS DONUT GENDER ──
  const ctx = document.getElementById('genderChart').getContext('2d');
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      datasets: [{
        data: [{{ $gender['laki'] }}, {{ $gender['perempuan'] }}],
        backgroundColor: ['#2563eb','#be123c'],
        hoverBackgroundColor: ['#3b82f6','#fb7185'],
        borderColor: '#0c1220',
        borderWidth: 3,
        hoverOffset: 4,
      }]
    },
    options: {
      cutout: '72%',
      responsive: false,
      plugins: { legend: { display: false }, tooltip: {
        callbacks: {
          label: (ctx) => ` ${ctx.formattedValue} jiwa`
        }
      }},
      animation: { animateRotate: true, duration: 900 }
    }
  });

  // ── TABLE SEARCH + PAGINATION ──
  const ROWS_PER_PAGE = 5;
  const tbody = document.getElementById('tbl-body');
  const allRows = Array.from(tbody.querySelectorAll('tr'));
  const noResult = document.getElementById('no-result');
  const pagerInfo = document.getElementById('pager-info');
  const pagerBtns = document.getElementById('pager-btns');
  const searchInput = document.getElementById('tbl-search');

  let currentPage = 1;
  let filteredRows = [...allRows];

  function renderTable() {
    const total = filteredRows.length;
    const pages = Math.max(1, Math.ceil(total / ROWS_PER_PAGE));
    currentPage = Math.min(currentPage, pages);
    const start = (currentPage - 1) * ROWS_PER_PAGE;
    const end = start + ROWS_PER_PAGE;

    allRows.forEach(r => r.style.display = 'none');
    filteredRows.slice(start, end).forEach(r => r.style.display = '');

    noResult.style.display = total === 0 ? 'block' : 'none';

    // pager info
    if (total > 0) {
      pagerInfo.textContent = `SHOWING ${start+1}–${Math.min(end,total)} OF ${total}`;
    } else {
      pagerInfo.textContent = '';
    }

    // pager buttons
    pagerBtns.innerHTML = '';
    const prevBtn = document.createElement('button');
    prevBtn.className = 'pg-btn';
    prevBtn.textContent = '← PREV';
    prevBtn.disabled = currentPage === 1;
    prevBtn.onclick = () => { currentPage--; renderTable(); };
    pagerBtns.appendChild(prevBtn);

    for (let i = 1; i <= pages; i++) {
      const btn = document.createElement('button');
      btn.className = 'pg-btn' + (i === currentPage ? ' active' : '');
      btn.textContent = i;
      btn.onclick = () => { currentPage = i; renderTable(); };
      pagerBtns.appendChild(btn);
    }

    const nextBtn = document.createElement('button');
    nextBtn.className = 'pg-btn';
    nextBtn.textContent = 'NEXT →';
    nextBtn.disabled = currentPage === pages;
    nextBtn.onclick = () => { currentPage++; renderTable(); };
    pagerBtns.appendChild(nextBtn);
  }

  searchInput.addEventListener('input', () => {
    const q = searchInput.value.toLowerCase().trim();
    filteredRows = q
      ? allRows.filter(r => r.querySelector('.tname')?.textContent.toLowerCase().includes(q))
      : [...allRows];
    currentPage = 1;
    renderTable();
  });

  renderTable();

});
</script>
</body>
</html>
