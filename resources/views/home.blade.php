<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Portal Kependudukan</title>
<link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;600;700&family=Fira+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<style>
:root {
  --bg: #020b18;
  --bg2: #040f1e;
  --surface: #071428;
  --surface2: #0a1a30;
  --border: #0d2240;
  --border2: #1a3a5c;
  --text: #e8f4fd;
  --muted: #4d7a9e;
  --muted2: #3a6080;
  --blue: #1E40AF;
  --blue-light: #3b82f6;
  --blue-bright: #60a5fa;
  --green: #16A34A;
  --green-light: #22c55e;
  --amber: #d97706;
  --amber-light: #f59e0b;
  --rose: #be123c;
  --rose-light: #f43f5e;
  --cyan: #0e7490;
  --cyan-light: #06b6d4;
  --purple: #6d28d9;
  --purple-light: #a78bfa;
  --glow-blue: rgba(59,130,246,0.12);
  --glow-green: rgba(34,197,94,0.1);
}

* { margin: 0; padding: 0; box-sizing: border-box; }

body {
  font-family: 'Fira Sans', system-ui, sans-serif;
  background: var(--bg);
  color: var(--text);
  min-height: 100vh;
  overflow-x: hidden;
}

/* SCANLINES OVERLAY */
body::before {
  content: '';
  position: fixed;
  inset: 0;
  background: repeating-linear-gradient(
    0deg,
    transparent,
    transparent 2px,
    rgba(0,0,0,0.03) 2px,
    rgba(0,0,0,0.03) 4px
  );
  pointer-events: none;
  z-index: 0;
}

/* GRID BG */
body::after {
  content: '';
  position: fixed;
  inset: 0;
  background-image:
    linear-gradient(rgba(30,64,175,0.04) 1px, transparent 1px),
    linear-gradient(90deg, rgba(30,64,175,0.04) 1px, transparent 1px);
  background-size: 48px 48px;
  pointer-events: none;
  z-index: 0;
}

/* NAV */
.nav {
  position: fixed;
  top: 0; left: 0; right: 0;
  z-index: 100;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 14px 24px;
  background: rgba(2,11,24,0.85);
  backdrop-filter: blur(12px);
  border-bottom: 1px solid var(--border);
}
.nav-brand {
  display: flex;
  align-items: center;
  gap: 10px;
  font-family: 'Fira Code', monospace;
  font-size: .78rem;
  font-weight: 600;
  color: var(--blue-bright);
  text-decoration: none;
  letter-spacing: 1px;
}
.nav-brand-icon {
  width: 28px; height: 28px;
  border: 1px solid var(--blue-light);
  border-radius: 6px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(59,130,246,0.08);
}
.nav-brand-icon svg { width: 14px; height: 14px; }
.nav-status {
  display: flex;
  align-items: center;
  gap: 6px;
  font-family: 'Fira Code', monospace;
  font-size: .68rem;
  color: var(--muted);
}
.status-dot {
  width: 6px; height: 6px;
  border-radius: 50%;
  background: var(--green-light);
  box-shadow: 0 0 8px var(--green-light);
  animation: blink 2s infinite;
}
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:.4} }
.nav-admin {
  font-family: 'Fira Code', monospace;
  font-size: .72rem;
  color: var(--blue-bright);
  text-decoration: none;
  border: 1px solid rgba(59,130,246,0.3);
  padding: 6px 14px;
  border-radius: 6px;
  background: rgba(59,130,246,0.06);
  transition: all .2s;
  cursor: pointer;
}
.nav-admin:hover {
  background: rgba(59,130,246,0.12);
  border-color: var(--blue-light);
  box-shadow: 0 0 12px rgba(59,130,246,0.15);
}

/* HERO */
.hero {
  position: relative;
  padding: 120px 24px 80px;
  text-align: center;
  z-index: 1;
  overflow: hidden;
}
.hero-glow {
  position: absolute;
  top: -40px; left: 50%;
  transform: translateX(-50%);
  width: 600px; height: 400px;
  background: radial-gradient(ellipse, rgba(30,64,175,0.15) 0%, transparent 70%);
  pointer-events: none;
}
.hero-label {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-family: 'Fira Code', monospace;
  font-size: .65rem;
  font-weight: 500;
  color: var(--blue-bright);
  letter-spacing: 3px;
  text-transform: uppercase;
  margin-bottom: 20px;
  padding: 5px 14px;
  border: 1px solid rgba(59,130,246,0.2);
  border-radius: 4px;
  background: rgba(59,130,246,0.05);
}
.hero h1 {
  font-family: 'Fira Code', monospace;
  font-size: clamp(1.6rem, 5vw, 2.8rem);
  font-weight: 700;
  line-height: 1.15;
  letter-spacing: -0.5px;
  margin-bottom: 16px;
  color: var(--text);
}
.hero h1 span {
  background: linear-gradient(135deg, var(--blue-bright), var(--cyan-light));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
.hero-sub {
  color: var(--muted);
  font-size: .9rem;
  line-height: 1.7;
  max-width: 480px;
  margin: 0 auto 32px;
}
.hero-actions {
  display: flex;
  gap: 12px;
  justify-content: center;
  flex-wrap: wrap;
}
.btn-primary {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 11px 24px;
  background: var(--blue);
  color: white;
  border: 1px solid rgba(59,130,246,0.5);
  border-radius: 6px;
  text-decoration: none;
  font-family: 'Fira Code', monospace;
  font-size: .78rem;
  font-weight: 600;
  letter-spacing: .5px;
  box-shadow: 0 0 20px rgba(30,64,175,0.3), inset 0 1px 0 rgba(255,255,255,0.08);
  transition: all .2s;
  cursor: pointer;
}
.btn-primary:hover {
  background: var(--blue-light);
  box-shadow: 0 0 28px rgba(59,130,246,0.4);
  transform: translateY(-1px);
}
.btn-ghost {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 11px 24px;
  background: transparent;
  color: var(--muted);
  border: 1px solid var(--border2);
  border-radius: 6px;
  text-decoration: none;
  font-family: 'Fira Code', monospace;
  font-size: .78rem;
  font-weight: 500;
  transition: all .2s;
  cursor: pointer;
}
.btn-ghost:hover {
  color: var(--text);
  border-color: var(--muted2);
}

/* CONTAINER */
.container {
  max-width: 1100px;
  margin: 0 auto;
  padding: 0 16px 64px;
  position: relative;
  z-index: 1;
}

/* SECTION LABEL */
.section-label {
  display: flex;
  align-items: center;
  gap: 10px;
  font-family: 'Fira Code', monospace;
  font-size: .65rem;
  font-weight: 600;
  color: var(--muted);
  text-transform: uppercase;
  letter-spacing: 2px;
  margin-bottom: 14px;
}
.section-label::before {
  content: '//';
  color: var(--blue-light);
  font-size: .7rem;
}
.section-label::after {
  content: '';
  flex: 1;
  height: 1px;
  background: linear-gradient(90deg, var(--border2), transparent);
}

/* STAT CARDS */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(165px, 1fr));
  gap: 10px;
  margin-bottom: 28px;
}
.stat-card {
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: 8px;
  padding: 18px 16px;
  position: relative;
  overflow: hidden;
  transition: border-color .25s, transform .25s;
  cursor: default;
}
.stat-card:hover {
  border-color: var(--border2);
  transform: translateY(-2px);
}
.stat-card::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 1px;
  background: linear-gradient(90deg, transparent, var(--accent-line, rgba(59,130,246,0.5)), transparent);
}
.stat-card::after {
  content: '';
  position: absolute;
  top: 0; right: 0;
  width: 60px; height: 60px;
  background: radial-gradient(circle at top right, var(--accent-glow, rgba(59,130,246,0.06)), transparent 70%);
}
.stat-card.green {
  --accent-line: rgba(34,197,94,0.5);
  --accent-glow: rgba(34,197,94,0.06);
}
.stat-card.rose {
  --accent-line: rgba(244,63,94,0.5);
  --accent-glow: rgba(244,63,94,0.06);
}
.stat-card.amber {
  --accent-line: rgba(245,158,11,0.5);
  --accent-glow: rgba(245,158,11,0.06);
}
.stat-card.purple {
  --accent-line: rgba(167,139,250,0.5);
  --accent-glow: rgba(167,139,250,0.06);
}
.stat-card.cyan {
  --accent-line: rgba(6,182,212,0.5);
  --accent-glow: rgba(6,182,212,0.06);
}
.stat-tag {
  font-family: 'Fira Code', monospace;
  font-size: .58rem;
  color: var(--muted2);
  letter-spacing: 1.5px;
  text-transform: uppercase;
  margin-bottom: 10px;
}
.stat-num {
  font-family: 'Fira Code', monospace;
  font-size: 2rem;
  font-weight: 700;
  line-height: 1;
  margin-bottom: 6px;
  color: var(--text);
  letter-spacing: -1px;
}
.stat-label {
  font-size: .72rem;
  color: var(--muted);
  font-weight: 400;
}

/* CARD */
.card {
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: 8px;
  padding: 20px;
  margin-bottom: 12px;
}
.card-header {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 18px;
}
.card-title {
  font-family: 'Fira Code', monospace;
  font-size: .78rem;
  font-weight: 600;
  color: var(--text);
  letter-spacing: .3px;
}
.card-count {
  font-family: 'Fira Code', monospace;
  font-size: .65rem;
  color: var(--muted);
  margin-left: auto;
  background: var(--surface2);
  padding: 2px 8px;
  border-radius: 4px;
  border: 1px solid var(--border);
}

/* USIA */
.usia-grid {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 8px;
}
.usia-item {
  background: var(--surface2);
  border: 1px solid var(--border);
  border-radius: 6px;
  padding: 14px 8px;
  text-align: center;
  transition: border-color .2s, background .2s;
  cursor: default;
}
.usia-item:hover {
  border-color: var(--border2);
  background: rgba(30,64,175,0.06);
}
.usia-num {
  font-family: 'Fira Code', monospace;
  font-size: 1.5rem;
  font-weight: 700;
  color: var(--blue-bright);
  line-height: 1;
  margin-bottom: 8px;
}
.usia-label {
  font-family: 'Fira Code', monospace;
  font-size: .58rem;
  color: var(--muted);
  text-transform: uppercase;
  letter-spacing: 1px;
  line-height: 1.5;
}

/* CHARTS */
.charts-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 12px;
  margin-bottom: 12px;
}
.bar-item { margin-bottom: 12px; }
.bar-item:last-child { margin-bottom: 0; }
.bar-meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 6px;
}
.bar-name {
  font-size: .78rem;
  color: #94b8d4;
  font-weight: 400;
}
.bar-val {
  font-family: 'Fira Code', monospace;
  font-size: .68rem;
  color: var(--muted);
  background: var(--surface2);
  padding: 1px 7px;
  border-radius: 3px;
  border: 1px solid var(--border);
}
.bar-track {
  background: var(--surface2);
  border-radius: 2px;
  height: 4px;
  overflow: hidden;
  border: 1px solid var(--border);
}
.bar-fill {
  height: 100%;
  border-radius: 2px;
  position: relative;
}
.bar-fill::after {
  content: '';
  position: absolute;
  right: 0; top: 0; bottom: 0;
  width: 3px;
  background: inherit;
  filter: brightness(1.8);
  border-radius: 0 2px 2px 0;
}
.fill-blue { background: linear-gradient(90deg, #1e3a8a, #3b82f6); }
.fill-green { background: linear-gradient(90deg, #14532d, #22c55e); }
.fill-amber { background: linear-gradient(90deg, #78350f, #f59e0b); }
.fill-purple { background: linear-gradient(90deg, #3b0764, #a78bfa); }
.fill-cyan { background: linear-gradient(90deg, #164e63, #06b6d4); }

/* TABLE */
.table-wrap { overflow-x: auto; }
table { width: 100%; border-collapse: collapse; font-size: .8rem; }
thead tr { border-bottom: 1px solid var(--border2); }
th {
  text-align: left;
  padding: 9px 12px;
  font-family: 'Fira Code', monospace;
  font-size: .62rem;
  font-weight: 600;
  color: var(--muted);
  text-transform: uppercase;
  letter-spacing: 1.5px;
}
td {
  padding: 11px 12px;
  border-bottom: 1px solid rgba(13,34,64,0.8);
  color: #94b8d4;
  font-size: .78rem;
  vertical-align: middle;
}
tr:last-child td { border-bottom: none; }
tr:hover td { background: rgba(30,64,175,0.04); }
.td-name {
  font-weight: 500;
  color: var(--text) !important;
}
.td-num {
  font-family: 'Fira Code', monospace;
  color: var(--muted) !important;
  font-size: .68rem !important;
}
.badge {
  display: inline-flex;
  align-items: center;
  padding: 2px 8px;
  border-radius: 4px;
  font-family: 'Fira Code', monospace;
  font-size: .62rem;
  font-weight: 600;
  letter-spacing: .5px;
}
.badge-L {
  background: rgba(30,64,175,0.15);
  color: var(--blue-bright);
  border: 1px solid rgba(30,64,175,0.25);
}
.badge-P {
  background: rgba(190,18,60,0.15);
  color: #fb7185;
  border: 1px solid rgba(190,18,60,0.25);
}

/* FOOTER */
.footer {
  position: relative;
  z-index: 1;
  border-top: 1px solid var(--border);
  padding: 20px 24px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 8px;
}
.footer-text {
  font-family: 'Fira Code', monospace;
  font-size: .65rem;
  color: var(--muted2);
  letter-spacing: .5px;
}
.footer-link {
  color: var(--blue-bright);
  text-decoration: none;
  font-family: 'Fira Code', monospace;
  font-size: .65rem;
}
.footer-link:hover { text-decoration: underline; }

@media (max-width: 640px) {
  .usia-grid { grid-template-columns: repeat(3, 1fr); }
  .stats-grid { grid-template-columns: repeat(2, 1fr); }
  .nav { padding: 12px 16px; }
  .hero { padding: 100px 16px 60px; }
  .footer { flex-direction: column; text-align: center; }
}
</style>
</head>
<body>

<!-- NAV -->
<nav class="nav">
  <a href="/" class="nav-brand">
    <div class="nav-brand-icon">
      <svg viewBox="0 0 16 16" fill="none" stroke="#60a5fa" stroke-width="1.5">
        <rect x="2" y="2" width="5" height="5" rx="1"/>
        <rect x="9" y="2" width="5" height="5" rx="1"/>
        <rect x="2" y="9" width="5" height="5" rx="1"/>
        <rect x="9" y="9" width="5" height="5" rx="1"/>
      </svg>
    </div>
    SIS.KEPENDUDUKAN
  </a>
  <div class="nav-status">
    <span class="status-dot"></span>
    SYSTEM_ONLINE
  </div>
  <a href="/admin" class="nav-admin">ADMIN_PANEL</a>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="hero-glow"></div>
  <div class="hero-label">
    <span class="status-dot"></span>
    DATA REALTIME
  </div>
  <h1>Portal <span>Kependudukan</span></h1>
  <p class="hero-sub">Sistem informasi kependudukan yang transparan — statistik penduduk, distribusi demografi, dan data KK tersaji secara publik.</p>
  <div class="hero-actions">
    <a href="/admin" class="btn-primary">Masuk Admin Panel</a>
    <a href="#data" class="btn-ghost">Lihat Data</a>
  </div>
</section>

<div class="container" id="data">

  <!-- STAT CARDS -->
  <div class="section-label">RINGKASAN DATA</div>
  <div class="stats-grid" id="stats-grid">
    <div class="stat-card">
      <div class="stat-tag">TOTAL</div>
      <div class="stat-num">{{ number_format($stats['total_penduduk']) }}</div>
      <div class="stat-label">Total Penduduk</div>
    </div>
    <div class="stat-card green">
      <div class="stat-tag">GENDER/L</div>
      <div class="stat-num">{{ number_format($stats['total_laki']) }}</div>
      <div class="stat-label">Laki-laki</div>
    </div>
    <div class="stat-card rose">
      <div class="stat-tag">GENDER/P</div>
      <div class="stat-num">{{ number_format($stats['total_perempuan']) }}</div>
      <div class="stat-label">Perempuan</div>
    </div>
    <div class="stat-card amber">
      <div class="stat-tag">KK</div>
      <div class="stat-num">{{ number_format($stats['total_kk']) }}</div>
      <div class="stat-label">Kepala Keluarga</div>
    </div>
    <div class="stat-card purple">
      <div class="stat-tag">NIKAH</div>
      <div class="stat-num">{{ number_format($stats['total_nikah']) }}</div>
      <div class="stat-label">Data Pernikahan</div>
    </div>
    <div class="stat-card cyan">
      <div class="stat-tag">WILAYAH</div>
      <div class="stat-num">{{ number_format($stats['total_rw']) }}</div>
      <div class="stat-label">Total RW</div>
    </div>
  </div>

  <!-- KELOMPOK USIA -->
  <div class="section-label">DISTRIBUSI USIA</div>
  <div class="card" id="usia-card">
    <div class="usia-grid">
      <div class="usia-item">
        <div class="usia-num">{{ $usia['balita'] }}</div>
        <div class="usia-label">BALITA<br>0–4</div>
      </div>
      <div class="usia-item">
        <div class="usia-num">{{ $usia['anak'] }}</div>
        <div class="usia-label">ANAK<br>5–14</div>
      </div>
      <div class="usia-item">
        <div class="usia-num">{{ $usia['remaja'] }}</div>
        <div class="usia-label">REMAJA<br>15–24</div>
      </div>
      <div class="usia-item">
        <div class="usia-num">{{ $usia['dewasa'] }}</div>
        <div class="usia-label">DEWASA<br>25–59</div>
      </div>
      <div class="usia-item">
        <div class="usia-num">{{ $usia['lansia'] }}</div>
        <div class="usia-label">LANSIA<br>60+</div>
      </div>
    </div>
  </div>

  <!-- AGAMA + PENDIDIKAN -->
  <div class="section-label">DISTRIBUSI DEMOGRAFI</div>
  <div class="charts-grid">
    <div class="card">
      <div class="card-header">
        <div class="card-title">AGAMA</div>
        <div class="card-count">{{ $agama->count() }} KATEGORI</div>
      </div>
      @php $maxAgama = $agama->max('total') ?: 1; @endphp
      @foreach($agama as $item)
      <div class="bar-item">
        <div class="bar-meta">
          <span class="bar-name">{{ strtoupper($item->religion ?: 'N/A') }}</span>
          <span class="bar-val">{{ $item->total }}</span>
        </div>
        <div class="bar-track">
          <div class="bar-fill fill-blue" style="width:{{ ($item->total/$maxAgama)*100 }}%"></div>
        </div>
      </div>
      @endforeach
    </div>

    <div class="card">
      <div class="card-header">
        <div class="card-title">PENDIDIKAN</div>
        <div class="card-count">{{ $pendidikan->count() }} KATEGORI</div>
      </div>
      @php $maxPendidikan = $pendidikan->max('total') ?: 1; @endphp
      @foreach($pendidikan as $item)
      <div class="bar-item">
        <div class="bar-meta">
          <span class="bar-name">{{ strtoupper($item->education ?: 'N/A') }}</span>
          <span class="bar-val">{{ $item->total }}</span>
        </div>
        <div class="bar-track">
          <div class="bar-fill fill-green" style="width:{{ ($item->total/$maxPendidikan)*100 }}%"></div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  <!-- PEKERJAAN + STATUS KAWIN -->
  <div class="charts-grid">
    <div class="card">
      <div class="card-header">
        <div class="card-title">PEKERJAAN</div>
        <div class="card-count">TOP 8</div>
      </div>
      @php $maxPekerjaan = $pekerjaan->max('total') ?: 1; @endphp
      @foreach($pekerjaan as $item)
      <div class="bar-item">
        <div class="bar-meta">
          <span class="bar-name">{{ strtoupper($item->occupation ?: 'N/A') }}</span>
          <span class="bar-val">{{ $item->total }}</span>
        </div>
        <div class="bar-track">
          <div class="bar-fill fill-amber" style="width:{{ ($item->total/$maxPekerjaan)*100 }}%"></div>
        </div>
      </div>
      @endforeach
    </div>

    <div class="card">
      <div class="card-header">
        <div class="card-title">STATUS KAWIN</div>
        <div class="card-count">{{ $status_kawin->count() }} STATUS</div>
      </div>
      @php $maxKawin = $status_kawin->max('total') ?: 1; @endphp
      @foreach($status_kawin as $item)
      <div class="bar-item">
        <div class="bar-meta">
          <span class="bar-name">{{ strtoupper($item->marital_status ?: 'N/A') }}</span>
          <span class="bar-val">{{ $item->total }}</span>
        </div>
        <div class="bar-track">
          <div class="bar-fill fill-purple" style="width:{{ ($item->total/$maxKawin)*100 }}%"></div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  <!-- TABEL -->
  <div class="section-label">PENDUDUK TERBARU</div>
  <div class="card" id="table-card">
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>NAMA</th>
            <th>GDR</th>
            <th>TGL LAHIR</th>
            <th>AGAMA</th>
            <th>PEKERJAAN</th>
            <th>STATUS</th>
          </tr>
        </thead>
        <tbody>
          @forelse($penduduk_terbaru as $i => $p)
          <tr>
            <td class="td-num">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</td>
            <td class="td-name">{{ $p->full_name }}</td>
            <td>
              <span class="badge {{ $p->gender==='Laki-laki'?'badge-L':'badge-P' }}">
                {{ $p->gender==='Laki-laki'?'L':'P' }}
              </span>
            </td>
            <td class="td-num">{{ $p->birth_date?$p->birth_date->format('d/m/Y'):'-' }}</td>
            <td>{{ $p->religion??'-' }}</td>
            <td>{{ $p->occupation??'-' }}</td>
            <td class="td-num">{{ $p->marital_status??'-' }}</td>
          </tr>
          @empty
          <tr>
            <td colspan="7" style="text-align:center;color:var(--muted);padding:40px;font-family:'Fira Code',monospace;font-size:.72rem;letter-spacing:1px">
              NO_DATA_FOUND
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>

<!-- FOOTER -->
<footer class="footer">
  <span class="footer-text">SIS.KEPENDUDUKAN v1.0 — DATA PUBLIK</span>
  <a href="/admin" class="footer-link">LOGIN_ADMIN</a>
</footer>

<script>
document.addEventListener('DOMContentLoaded', () => {
  // Stagger stat cards
  gsap.from('#stats-grid .stat-card', {
    opacity: 0,
    y: 20,
    scale: 0.96,
    duration: 0.4,
    stagger: { each: 0.06, from: 'start' },
    ease: 'back.out(1.4)',
    delay: 0.2
  });

  // Usia items
  gsap.from('#usia-card .usia-item', {
    opacity: 0,
    y: 14,
    duration: 0.35,
    stagger: 0.05,
    ease: 'power2.out',
    delay: 0.5
  });

  // Table rows
  gsap.from('#table-card tbody tr', {
    opacity: 0,
    x: -8,
    duration: 0.3,
    stagger: 0.04,
    ease: 'power1.out',
    delay: 0.7
  });

  // Bar fills animate width from 0
  document.querySelectorAll('.bar-fill').forEach(bar => {
    const target = bar.style.width;
    bar.style.width = '0%';
    setTimeout(() => {
      bar.style.transition = 'width 1s cubic-bezier(0.4,0,0.2,1)';
      bar.style.width = target;
    }, 800);
  });
});
</script>

</body>
</html>
