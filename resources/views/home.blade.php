<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Portal Kependudukan</title>
<link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@500;600;700&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
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

/* GRID BG */
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
  background: rgba(6,9,15,0.88);
  backdrop-filter: blur(14px);
  border-bottom: 1px solid var(--border);
}
.nav-brand {
  display: flex; align-items: center; gap: 9px;
  text-decoration: none;
}
.nav-logo {
  width: 28px; height: 28px;
  background: var(--surface2);
  border: 1px solid var(--border2);
  border-radius: 6px;
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0;
}
.nav-logo svg { width: 14px; height: 14px; }
.nav-title {
  font-family: 'Fira Code', monospace;
  font-size: .72rem; font-weight: 700;
  color: var(--blue-ll); letter-spacing: 1.5px;
}
.nav-status {
  display: flex; align-items: center; gap: 6px;
  font-family: 'Fira Code', monospace;
  font-size: .62rem; font-weight: 600;
  color: var(--muted); letter-spacing: 1px;
}
.status-dot {
  width: 6px; height: 6px; border-radius: 50%;
  background: var(--green-l);
  box-shadow: 0 0 7px var(--green-l);
  animation: blink 2.4s ease-in-out infinite;
}
@keyframes blink { 0%,100%{opacity:1} 55%{opacity:.25} }
.nav-btn {
  font-family: 'Fira Code', monospace;
  font-size: .68rem; font-weight: 700;
  color: var(--blue-ll); text-decoration: none;
  border: 1px solid rgba(59,130,246,0.28);
  padding: 5px 13px; border-radius: 5px;
  background: rgba(37,99,235,0.07);
  letter-spacing: .5px;
  transition: background .18s, border-color .18s;
}
.nav-btn:hover { background: rgba(37,99,235,0.14); border-color: var(--blue-l); }

/* HERO */
.hero {
  position: relative; z-index: 1;
  padding: 114px 24px 72px; text-align: center;
  overflow: hidden;
}
.hero-glow {
  position: absolute; top: -60px; left: 50%; transform: translateX(-50%);
  width: 560px; height: 360px;
  background: radial-gradient(ellipse, rgba(37,99,235,0.12) 0%, transparent 72%);
  pointer-events: none;
}
.hero-tag {
  display: inline-flex; align-items: center; gap: 7px;
  font-family: 'Fira Code', monospace;
  font-size: .62rem; font-weight: 700;
  color: var(--blue-ll); letter-spacing: 2.5px; text-transform: uppercase;
  border: 1px solid rgba(59,130,246,0.22);
  padding: 5px 14px; border-radius: 4px;
  background: rgba(37,99,235,0.06);
  margin-bottom: 22px;
}
.hero h1 {
  font-family: 'Inter', sans-serif;
  font-size: clamp(1.7rem, 5.5vw, 3.2rem);
  font-weight: 800; line-height: 1.12;
  letter-spacing: -1.5px; margin-bottom: 14px;
  color: var(--text);
}
.hero h1 em {
  font-style: normal;
  background: linear-gradient(135deg, var(--blue-l), var(--cyan-l));
  -webkit-background-clip: text; -webkit-text-fill-color: transparent;
  background-clip: text;
}
.hero-sub {
  color: var(--sub); font-size: .9rem; font-weight: 400;
  line-height: 1.7; max-width: 460px;
  margin: 0 auto 32px;
}
.hero-btns { display: flex; gap: 10px; justify-content: center; flex-wrap: wrap; }
.btn-p {
  display: inline-flex; align-items: center; gap: 7px;
  padding: 11px 22px; background: var(--blue);
  color: #fff; border: 1px solid rgba(59,130,246,0.5);
  border-radius: 7px; text-decoration: none;
  font-size: .82rem; font-weight: 700; letter-spacing: .3px;
  box-shadow: 0 0 18px rgba(37,99,235,0.28);
  transition: all .18s;
}
.btn-p:hover { background: var(--blue-l); box-shadow: 0 0 26px rgba(59,130,246,0.4); transform: translateY(-1px); }
.btn-g {
  display: inline-flex; align-items: center; gap: 7px;
  padding: 11px 22px; background: transparent;
  color: var(--sub); border: 1px solid var(--border2);
  border-radius: 7px; text-decoration: none;
  font-size: .82rem; font-weight: 600;
  transition: all .18s;
}
.btn-g:hover { color: var(--text); border-color: var(--muted); }

/* CONTAINER */
.wrap { max-width: 1100px; margin: 0 auto; padding: 0 16px 64px; position: relative; z-index: 1; }

/* SECTION LABEL */
.slabel {
  display: flex; align-items: center; gap: 10px;
  font-family: 'Fira Code', monospace;
  font-size: .62rem; font-weight: 700;
  color: var(--muted); text-transform: uppercase; letter-spacing: 2px;
  margin-bottom: 12px;
}
.slabel::before { content: '//'; color: var(--blue-l); font-size: .68rem; }
.slabel::after { content: ''; flex: 1; height: 1px; background: linear-gradient(90deg, var(--border2), transparent); }

/* STAT CARDS */
.sg {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(162px, 1fr));
  gap: 10px; margin-bottom: 24px;
}
.sc {
  background: var(--surface); border: 1px solid var(--border);
  border-radius: 10px; padding: 18px 16px;
  position: relative; overflow: hidden;
  transition: border-color .22s, transform .22s;
  cursor: default;
}
.sc:hover { border-color: var(--border2); transform: translateY(-2px); }
.sc::before {
  content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
  background: linear-gradient(90deg, transparent, var(--sc-line, rgba(59,130,246,0.45)), transparent);
}
.sc::after {
  content: ''; position: absolute; top: 0; right: 0;
  width: 56px; height: 56px;
  background: radial-gradient(circle at top right, var(--sc-glow, rgba(59,130,246,0.07)), transparent 70%);
}
.sc.g  { --sc-line: rgba(34,197,94,0.45);  --sc-glow: rgba(34,197,94,0.07); }
.sc.r  { --sc-line: rgba(251,113,133,0.45); --sc-glow: rgba(251,113,133,0.07); }
.sc.a  { --sc-line: rgba(251,191,36,0.45);  --sc-glow: rgba(251,191,36,0.07); }
.sc.p  { --sc-line: rgba(167,139,250,0.45); --sc-glow: rgba(167,139,250,0.07); }
.sc.c  { --sc-line: rgba(34,211,238,0.45);  --sc-glow: rgba(34,211,238,0.07); }
.sc-icon { width: 24px; height: 24px; margin-bottom: 11px; opacity: .7; }
.sc-num {
  font-family: 'Inter', sans-serif;
  font-size: 1.9rem; font-weight: 800;
  line-height: 1; letter-spacing: -1px;
  margin-bottom: 5px; color: var(--text);
}
.sc-lbl { font-size: .7rem; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: .8px; }

/* CARD */
.card {
  background: var(--surface); border: 1px solid var(--border);
  border-radius: 10px; padding: 20px; margin-bottom: 12px;
}
.card-hd {
  display: flex; align-items: center; gap: 8px; margin-bottom: 16px;
}
.card-hd-bar { width: 3px; height: 14px; border-radius: 2px; background: var(--blue-l); flex-shrink: 0; }
.card-hd-bar.g { background: var(--green-l); }
.card-hd-bar.a { background: var(--amber-l); }
.card-hd-bar.p { background: var(--purple-l); }
.card-title { font-size: .82rem; font-weight: 700; color: var(--text); letter-spacing: .2px; }
.card-badge {
  margin-left: auto; font-family: 'Fira Code', monospace;
  font-size: .6rem; font-weight: 600; color: var(--muted);
  background: var(--surface2); border: 1px solid var(--border);
  padding: 2px 8px; border-radius: 4px;
}

/* USIA */
.ug { display: grid; grid-template-columns: repeat(5,1fr); gap: 8px; }
.ui {
  background: var(--surface2); border: 1px solid var(--border);
  border-radius: 8px; padding: 14px 8px; text-align: center;
  transition: border-color .2s;
  cursor: default;
}
.ui:hover { border-color: var(--border2); }
.ui-num { font-family: 'Inter', sans-serif; font-size: 1.45rem; font-weight: 800; color: var(--blue-l); line-height: 1; margin-bottom: 7px; letter-spacing: -0.5px; }
.ui-lbl { font-family: 'Fira Code', monospace; font-size: .56rem; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: 1px; line-height: 1.5; }

/* CHARTS */
.cg { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 12px; margin-bottom: 12px; }

/* BAR */
.bi { margin-bottom: 13px; }
.bi:last-child { margin-bottom: 0; }
.bm { display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px; }
.bn { font-size: .76rem; font-weight: 600; color: var(--sub); }
.bv {
  font-family: 'Fira Code', monospace; font-size: .64rem; font-weight: 700;
  color: var(--muted); background: var(--surface2);
  border: 1px solid var(--border); padding: 1px 7px; border-radius: 4px;
}
.bt { background: var(--surface2); border-radius: 3px; height: 5px; overflow: hidden; }
.bf { height: 100%; border-radius: 3px; position: relative; }
.bf::after {
  content: ''; position: absolute; right: 0; top: 0; bottom: 0;
  width: 2px; background: inherit; filter: brightness(2); border-radius: 0 3px 3px 0;
}
.fb { background: linear-gradient(90deg, #1e3a8a, #3b82f6); }
.fg { background: linear-gradient(90deg, #14532d, #22c55e); }
.fa { background: linear-gradient(90deg, #78350f, #fbbf24); }
.fp { background: linear-gradient(90deg, #3b0764, #a78bfa); }

/* TABLE */
.tw { overflow-x: auto; }
table { width: 100%; border-collapse: collapse; font-size: .79rem; }
thead tr { border-bottom: 1px solid var(--border2); }
th {
  text-align: left; padding: 9px 12px;
  font-family: 'Fira Code', monospace;
  font-size: .6rem; font-weight: 700;
  color: var(--muted); text-transform: uppercase; letter-spacing: 1.5px;
}
td { padding: 11px 12px; border-bottom: 1px solid rgba(26,37,64,0.7); color: var(--sub); vertical-align: middle; }
tr:last-child td { border-bottom: none; }
tr:hover td { background: rgba(37,99,235,0.03); }
.tname { font-weight: 700; color: var(--text) !important; }
.tnum { font-family: 'Fira Code', monospace; color: var(--muted) !important; font-size: .66rem !important; }
.badge {
  display: inline-flex; align-items: center;
  padding: 2px 9px; border-radius: 4px;
  font-family: 'Fira Code', monospace; font-size: .6rem; font-weight: 700; letter-spacing: .5px;
}
.bL { background: rgba(37,99,235,0.12); color: var(--blue-ll); border: 1px solid rgba(37,99,235,0.22); }
.bP { background: rgba(190,18,60,0.12); color: var(--rose-l); border: 1px solid rgba(190,18,60,0.22); }

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
  .ug { grid-template-columns: repeat(3,1fr); }
  .sg { grid-template-columns: repeat(2,1fr); }
  .hero { padding: 96px 16px 56px; }
  .footer { flex-direction: column; text-align: center; }
}
</style>
</head>
<body>

<!-- NAV -->
<nav class="nav">
  <a href="/" class="nav-brand">
    <div class="nav-logo">
      <svg viewBox="0 0 16 16" fill="none" stroke="#60a5fa" stroke-width="1.5">
        <circle cx="4" cy="4" r="2"/><circle cx="12" cy="4" r="2"/>
        <circle cx="4" cy="12" r="2"/><circle cx="12" cy="12" r="2"/>
      </svg>
    </div>
    <span class="nav-title">KEPENDUDUKAN</span>
  </a>
  <div class="nav-status">
    <span class="status-dot"></span>
    LIVE
  </div>
  <a href="/admin" class="nav-btn">ADMIN</a>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="hero-glow"></div>
  <div class="hero-tag">
    <svg width="7" height="7" viewBox="0 0 7 7"><circle cx="3.5" cy="3.5" r="3.5" fill="#22c55e"/></svg>
    DATA PUBLIK
  </div>
  <h1>Portal <em>Kependudukan</em></h1>
  <p class="hero-sub">Statistik penduduk yang transparan — data demografi, distribusi usia, dan rekap kependudukan tersaji secara terbuka.</p>
  <div class="hero-btns">
    <a href="/admin" class="btn-p">
      <svg width="13" height="13" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="5" height="5" rx="1"/><rect x="9" y="2" width="5" height="5" rx="1"/><rect x="2" y="9" width="5" height="5" rx="1"/><rect x="9" y="9" width="5" height="5" rx="1"/></svg>
      Admin Panel
    </a>
    <a href="#data" class="btn-g">
      <svg width="13" height="13" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 3v10M3 8l5 5 5-5"/></svg>
      Lihat Data
    </a>
  </div>
</section>

<div class="wrap" id="data">

  <!-- STAT CARDS -->
  <div class="slabel">RINGKASAN</div>
  <div class="sg" id="sg">

    <div class="sc">
      <svg class="sc-icon" viewBox="0 0 24 24" fill="none" stroke="#60a5fa" stroke-width="1.6">
        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
        <circle cx="9" cy="7" r="4"/>
        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
      </svg>
      <div class="sc-num">{{ number_format($stats['total_penduduk']) }}</div>
      <div class="sc-lbl">Total Penduduk</div>
    </div>

    <div class="sc g">
      <svg class="sc-icon" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="1.6">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
        <circle cx="12" cy="7" r="4"/>
      </svg>
      <div class="sc-num">{{ number_format($stats['total_laki']) }}</div>
      <div class="sc-lbl">Laki-laki</div>
    </div>

    <div class="sc r">
      <svg class="sc-icon" viewBox="0 0 24 24" fill="none" stroke="#fb7185" stroke-width="1.6">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
        <circle cx="12" cy="7" r="4"/>
      </svg>
      <div class="sc-num">{{ number_format($stats['total_perempuan']) }}</div>
      <div class="sc-lbl">Perempuan</div>
    </div>

    <div class="sc a">
      <svg class="sc-icon" viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="1.6">
        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
        <polyline points="9 22 9 12 15 12 15 22"/>
      </svg>
      <div class="sc-num">{{ number_format($stats['total_kk']) }}</div>
      <div class="sc-lbl">Kepala Keluarga</div>
    </div>

    <div class="sc p">
      <svg class="sc-icon" viewBox="0 0 24 24" fill="none" stroke="#a78bfa" stroke-width="1.6">
        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
      </svg>
      <div class="sc-num">{{ number_format($stats['total_nikah']) }}</div>
      <div class="sc-lbl">Data Pernikahan</div>
    </div>

    <div class="sc c">
      <svg class="sc-icon" viewBox="0 0 24 24" fill="none" stroke="#22d3ee" stroke-width="1.6">
        <polygon points="12 2 2 7 12 12 22 7 12 2"/>
        <polyline points="2 17 12 22 22 17"/>
        <polyline points="2 12 12 17 22 12"/>
      </svg>
      <div class="sc-num">{{ number_format($stats['total_rw']) }}</div>
      <div class="sc-lbl">Total RW</div>
    </div>

  </div>

  <!-- KELOMPOK USIA -->
  <div class="slabel">DISTRIBUSI USIA</div>
  <div class="card" id="ug-card">
    <div class="ug">
      <div class="ui"><div class="ui-num">{{ $usia['balita'] }}</div><div class="ui-lbl">Balita<br>0–4</div></div>
      <div class="ui"><div class="ui-num">{{ $usia['anak'] }}</div><div class="ui-lbl">Anak<br>5–14</div></div>
      <div class="ui"><div class="ui-num">{{ $usia['remaja'] }}</div><div class="ui-lbl">Remaja<br>15–24</div></div>
      <div class="ui"><div class="ui-num">{{ $usia['dewasa'] }}</div><div class="ui-lbl">Dewasa<br>25–59</div></div>
      <div class="ui"><div class="ui-num">{{ $usia['lansia'] }}</div><div class="ui-lbl">Lansia<br>60+</div></div>
    </div>
  </div>

  <!-- AGAMA + PENDIDIKAN -->
  <div class="slabel">DEMOGRAFI</div>
  <div class="cg">
    <div class="card">
      <div class="card-hd"><div class="card-hd-bar"></div><div class="card-title">Agama</div><div class="card-badge">{{ $agama->count() }} KAT</div></div>
      @php $mA = $agama->max('total') ?: 1; @endphp
      @foreach($agama as $item)
      <div class="bi">
        <div class="bm"><span class="bn">{{ $item->religion ?: 'N/A' }}</span><span class="bv">{{ $item->total }}</span></div>
        <div class="bt"><div class="bf fb" style="width:{{ ($item->total/$mA)*100 }}%"></div></div>
      </div>
      @endforeach
    </div>

    <div class="card">
      <div class="card-hd"><div class="card-hd-bar g"></div><div class="card-title">Pendidikan</div><div class="card-badge">{{ $pendidikan->count() }} KAT</div></div>
      @php $mP = $pendidikan->max('total') ?: 1; @endphp
      @foreach($pendidikan as $item)
      <div class="bi">
        <div class="bm"><span class="bn">{{ $item->education ?: 'N/A' }}</span><span class="bv">{{ $item->total }}</span></div>
        <div class="bt"><div class="bf fg" style="width:{{ ($item->total/$mP)*100 }}%"></div></div>
      </div>
      @endforeach
    </div>
  </div>

  <!-- PEKERJAAN + STATUS KAWIN -->
  <div class="cg">
    <div class="card">
      <div class="card-hd"><div class="card-hd-bar a"></div><div class="card-title">Pekerjaan</div><div class="card-badge">TOP 8</div></div>
      @php $mJ = $pekerjaan->max('total') ?: 1; @endphp
      @foreach($pekerjaan as $item)
      <div class="bi">
        <div class="bm"><span class="bn">{{ $item->occupation ?: 'N/A' }}</span><span class="bv">{{ $item->total }}</span></div>
        <div class="bt"><div class="bf fa" style="width:{{ ($item->total/$mJ)*100 }}%"></div></div>
      </div>
      @endforeach
    </div>

    <div class="card">
      <div class="card-hd"><div class="card-hd-bar p"></div><div class="card-title">Status Kawin</div><div class="card-badge">{{ $status_kawin->count() }} STATUS</div></div>
      @php $mK = $status_kawin->max('total') ?: 1; @endphp
      @foreach($status_kawin as $item)
      <div class="bi">
        <div class="bm"><span class="bn">{{ $item->marital_status ?: 'N/A' }}</span><span class="bv">{{ $item->total }}</span></div>
        <div class="bt"><div class="bf fp" style="width:{{ ($item->total/$mK)*100 }}%"></div></div>
      </div>
      @endforeach
    </div>
  </div>

  <!-- TABEL -->
  <div class="slabel">PENDUDUK TERBARU</div>
  <div class="card" id="tbl-card">
    <div class="tw">
      <table>
        <thead>
          <tr><th>#</th><th>NAMA</th><th>GDR</th><th>TGL LAHIR</th><th>AGAMA</th><th>PEKERJAAN</th><th>STATUS</th></tr>
        </thead>
        <tbody>
          @forelse($penduduk_terbaru as $i => $p)
          <tr>
            <td class="tnum">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</td>
            <td class="tname">{{ $p->full_name }}</td>
            <td><span class="badge {{ $p->gender==='Laki-laki'?'bL':'bP' }}">{{ $p->gender==='Laki-laki'?'L':'P' }}</span></td>
            <td class="tnum">{{ $p->birth_date?$p->birth_date->format('d/m/Y'):'-' }}</td>
            <td>{{ $p->religion??'-' }}</td>
            <td>{{ $p->occupation??'-' }}</td>
            <td class="tnum">{{ $p->marital_status??'-' }}</td>
          </tr>
          @empty
          <tr><td colspan="7" style="text-align:center;color:var(--muted);padding:36px;font-family:'Fira Code',monospace;font-size:.68rem;letter-spacing:1px">BELUM_ADA_DATA</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>

<!-- FOOTER -->
<footer class="footer">
  <span class="ft">SISTEM INFORMASI KEPENDUDUKAN — DATA PUBLIK</span>
  <a href="/admin" class="fa-link ft">LOGIN_ADMIN</a>
</footer>

<script>
document.addEventListener('DOMContentLoaded', () => {
  gsap.from('#sg .sc', {
    opacity: 0, y: 18, scale: 0.96,
    duration: 0.38,
    stagger: { each: 0.055, from: 'start' },
    ease: 'back.out(1.3)',
    delay: 0.15
  });
  gsap.from('#ug-card .ui', {
    opacity: 0, y: 12,
    duration: 0.3,
    stagger: 0.05,
    ease: 'power2.out',
    delay: 0.45
  });
  gsap.from('#tbl-card tbody tr', {
    opacity: 0, x: -6,
    duration: 0.26,
    stagger: 0.04,
    ease: 'power1.out',
    delay: 0.65
  });

  // Animate bar fills
  document.querySelectorAll('.bf').forEach(bar => {
    const w = bar.style.width;
    bar.style.width = '0%';
    setTimeout(() => {
      bar.style.transition = 'width .9s cubic-bezier(.4,0,.2,1)';
      bar.style.width = w;
    }, 700);
  });
});
</script>
</body>
</html>
