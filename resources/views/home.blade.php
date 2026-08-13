<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Portal Kependudukan</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box}
:root{
  --bg:#080d1a;
  --surface:#0f1629;
  --surface2:#151e35;
  --border:#1e2d4a;
  --text:#f1f5f9;
  --muted:#64748b;
  --blue:#3b82f6;
  --blue2:#1d4ed8;
  --green:#22c55e;
  --rose:#f43f5e;
  --amber:#f59e0b;
  --purple:#a78bfa;
  --cyan:#06b6d4;
}
body{font-family:'Plus Jakarta Sans',system-ui,sans-serif;background:var(--bg);color:var(--text);min-height:100vh}

/* HERO */
.hero{
  position:relative;padding:80px 24px 64px;text-align:center;overflow:hidden;
  background:linear-gradient(180deg,#0b1328 0%,var(--bg) 100%);
}
.hero::before{
  content:'';position:absolute;inset:0;
  background:
    radial-gradient(ellipse 70% 50% at 50% -10%,rgba(59,130,246,0.18),transparent),
    radial-gradient(ellipse 40% 30% at 20% 80%,rgba(167,139,250,0.06),transparent),
    radial-gradient(ellipse 40% 30% at 80% 80%,rgba(6,182,212,0.06),transparent);
  pointer-events:none;
}
.hero-badge{
  display:inline-flex;align-items:center;gap:8px;
  background:rgba(59,130,246,0.08);border:1px solid rgba(59,130,246,0.25);
  color:#93c5fd;padding:6px 16px;border-radius:100px;
  font-size:.7rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;margin-bottom:24px;
}
.dot{width:6px;height:6px;border-radius:50%;background:#3b82f6;animation:blink 2s infinite}
@keyframes blink{0%,100%{opacity:1}50%{opacity:.3}}
.hero h1{
  font-size:clamp(2rem,6vw,3.5rem);font-weight:800;line-height:1.1;
  letter-spacing:-1.5px;margin-bottom:14px;
  background:linear-gradient(135deg,#f1f5f9 0%,#93c5fd 60%,#a78bfa 100%);
  -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
}
.hero-sub{color:var(--muted);font-size:.95rem;margin-bottom:32px;max-width:480px;margin-left:auto;margin-right:auto;line-height:1.6}
.hero-actions{display:flex;gap:12px;justify-content:center;flex-wrap:wrap;margin-bottom:48px}
.btn-primary{
  display:inline-flex;align-items:center;gap:8px;
  padding:12px 28px;background:linear-gradient(135deg,var(--blue2),var(--blue));
  color:white;border-radius:12px;text-decoration:none;font-size:.88rem;font-weight:700;
  box-shadow:0 0 24px rgba(59,130,246,0.3);transition:all .2s;
}
.btn-primary:hover{transform:translateY(-2px);box-shadow:0 0 32px rgba(59,130,246,0.5)}
.btn-ghost{
  display:inline-flex;align-items:center;gap:8px;padding:12px 28px;
  background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.1);
  color:#94a3b8;border-radius:12px;text-decoration:none;font-size:.88rem;font-weight:600;
  transition:all .2s;
}
.btn-ghost:hover{background:rgba(255,255,255,0.07);color:var(--text)}

/* CONTAINER */
.container{max-width:1100px;margin:0 auto;padding:0 16px 48px}

/* STAT CARDS */
.stats-grid{
  display:grid;grid-template-columns:repeat(auto-fit,minmax(175px,1fr));
  gap:12px;margin-bottom:32px;
}
.stat-card{
  background:var(--surface);border:1px solid var(--border);
  border-radius:16px;padding:22px 18px;position:relative;overflow:hidden;
  transition:transform .25s,border-color .25s,box-shadow .25s;cursor:default;
}
.stat-card:hover{transform:translateY(-4px);border-color:rgba(59,130,246,0.35);box-shadow:0 8px 32px rgba(0,0,0,0.3)}
.stat-card::before{
  content:'';position:absolute;top:0;left:0;right:0;height:1px;
  background:linear-gradient(90deg,transparent,var(--accent,rgba(59,130,246,0.6)),transparent);
}
.stat-card::after{
  content:'';position:absolute;top:0;right:0;width:80px;height:80px;
  background:radial-gradient(circle at top right,var(--accent-glow,rgba(59,130,246,0.08)),transparent 70%);
}
.stat-card.green{--accent:rgba(34,197,94,0.6);--accent-glow:rgba(34,197,94,0.1)}
.stat-card.rose{--accent:rgba(244,63,94,0.6);--accent-glow:rgba(244,63,94,0.1)}
.stat-card.amber{--accent:rgba(245,158,11,0.6);--accent-glow:rgba(245,158,11,0.1)}
.stat-card.purple{--accent:rgba(167,139,250,0.6);--accent-glow:rgba(167,139,250,0.1)}
.stat-card.cyan{--accent:rgba(6,182,212,0.6);--accent-glow:rgba(6,182,212,0.1)}
.stat-icon{font-size:1.5rem;margin-bottom:12px;display:block}
.stat-num{font-size:2rem;font-weight:800;line-height:1;margin-bottom:6px;color:var(--text)}
.stat-label{font-size:.7rem;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:.8px}

/* SECTION */
.section{margin-bottom:20px}
.section-label{
  display:flex;align-items:center;gap:10px;
  font-size:.7rem;font-weight:700;color:var(--muted);
  text-transform:uppercase;letter-spacing:1.5px;margin-bottom:12px;
}
.section-label::before{content:'';width:3px;height:12px;border-radius:2px;background:linear-gradient(var(--blue),var(--purple))}

/* CARD */
.card{background:var(--surface);border:1px solid var(--border);border-radius:16px;padding:22px}
.card-title{font-size:.88rem;font-weight:700;color:var(--text);margin-bottom:18px;display:flex;align-items:center;gap:8px}
.card-title::before{content:'';width:3px;height:14px;border-radius:2px;background:var(--accent-bar,var(--blue))}
.card.green-bar{--accent-bar:var(--green)}
.card.amber-bar{--accent-bar:var(--amber)}

/* USIA */
.usia-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:10px}
.usia-item{
  background:var(--surface2);border:1px solid var(--border);
  border-radius:12px;padding:16px 8px;text-align:center;transition:all .2s;
}
.usia-item:hover{border-color:var(--blue);transform:translateY(-2px)}
.usia-num{font-size:1.6rem;font-weight:800;color:var(--blue);line-height:1}
.usia-label{font-size:.62rem;color:var(--muted);margin-top:6px;font-weight:600;line-height:1.5;text-transform:uppercase;letter-spacing:.5px}

/* CHARTS GRID */
.charts-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:16px;margin-bottom:20px}

/* BAR */
.bar-item{margin-bottom:14px}
.bar-item:last-child{margin-bottom:0}
.bar-meta{display:flex;justify-content:space-between;align-items:center;margin-bottom:6px}
.bar-name{font-size:.78rem;color:#cbd5e1;font-weight:500}
.bar-val{font-size:.72rem;color:var(--muted);font-weight:700;background:var(--surface2);padding:2px 8px;border-radius:6px}
.bar-track{background:var(--surface2);border-radius:6px;height:6px;overflow:hidden}
.bar-fill{height:100%;border-radius:6px;transition:width 1.2s cubic-bezier(.4,0,.2,1)}
.fill-blue{background:linear-gradient(90deg,#1d4ed8,#60a5fa)}
.fill-green{background:linear-gradient(90deg,#15803d,#4ade80)}
.fill-amber{background:linear-gradient(90deg,#b45309,#fcd34d)}
.fill-purple{background:linear-gradient(90deg,#6d28d9,#c4b5fd)}

/* TABLE */
.table-wrap{overflow-x:auto}
table{width:100%;border-collapse:collapse;font-size:.82rem}
thead tr{border-bottom:1px solid var(--border)}
th{
  text-align:left;padding:10px 14px;
  color:var(--muted);font-weight:700;font-size:.68rem;
  text-transform:uppercase;letter-spacing:1px;background:transparent;
}
td{padding:12px 14px;border-bottom:1px solid rgba(30,45,74,0.5);color:#cbd5e1;vertical-align:middle}
tr:last-child td{border-bottom:none}
tr:hover td{background:rgba(59,130,246,0.04)}
.badge{display:inline-flex;align-items:center;padding:3px 10px;border-radius:8px;font-size:.68rem;font-weight:700;letter-spacing:.5px}
.badge-L{background:rgba(59,130,246,0.12);color:#93c5fd;border:1px solid rgba(59,130,246,0.2)}
.badge-P{background:rgba(244,63,94,0.12);color:#fda4af;border:1px solid rgba(244,63,94,0.2)}
.name-cell{font-weight:600;color:var(--text)}

/* DIVIDER */
.divider{height:1px;background:linear-gradient(90deg,transparent,var(--border),transparent);margin:8px 0 20px}

/* FOOTER */
.footer{
  background:var(--surface);border-top:1px solid var(--border);
  text-align:center;padding:24px;font-size:.78rem;color:var(--muted);
}
.footer a{color:#60a5fa;text-decoration:none;font-weight:600}
.footer a:hover{color:var(--blue)}

@media(max-width:640px){
  .usia-grid{grid-template-columns:repeat(3,1fr)}
  .stats-grid{grid-template-columns:repeat(2,1fr)}
  .hero{padding:56px 16px 48px}
  .hero h1{letter-spacing:-1px}
}
</style>
</head>
<body>

<div class="hero">
  <div class="hero-badge"><span class="dot"></span> Portal Publik</div>
  <h1>Data Kependudukan</h1>
  <p class="hero-sub">Statistik penduduk yang transparan, akurat, dan diperbarui secara berkala untuk masyarakat.</p>
  <div class="hero-actions">
    <a href="/admin" class="btn-primary">Masuk Admin Panel</a>
    <a href="#statistik" class="btn-ghost">Lihat Data</a>
  </div>
</div>

<div class="container" id="statistik">

  {{-- STAT CARDS --}}
  <div class="stats-grid">
    <div class="stat-card">
      <span class="stat-icon">👥</span>
      <div class="stat-num">{{ number_format($stats['total_penduduk']) }}</div>
      <div class="stat-label">Total Penduduk</div>
    </div>
    <div class="stat-card green">
      <span class="stat-icon">🧑</span>
      <div class="stat-num">{{ number_format($stats['total_laki']) }}</div>
      <div class="stat-label">Laki-laki</div>
    </div>
    <div class="stat-card rose">
      <span class="stat-icon">👩</span>
      <div class="stat-num">{{ number_format($stats['total_perempuan']) }}</div>
      <div class="stat-label">Perempuan</div>
    </div>
    <div class="stat-card amber">
      <span class="stat-icon">🏠</span>
      <div class="stat-num">{{ number_format($stats['total_kk']) }}</div>
      <div class="stat-label">Kepala Keluarga</div>
    </div>
    <div class="stat-card purple">
      <span class="stat-icon">💍</span>
      <div class="stat-num">{{ number_format($stats['total_nikah']) }}</div>
      <div class="stat-label">Data Pernikahan</div>
    </div>
    <div class="stat-card cyan">
      <span class="stat-icon">🏘️</span>
      <div class="stat-num">{{ number_format($stats['total_rw']) }}</div>
      <div class="stat-label">Total RW</div>
    </div>
  </div>

  {{-- KELOMPOK USIA --}}
  <div class="section">
    <div class="section-label">Kelompok Usia</div>
    <div class="card">
      <div class="usia-grid">
        <div class="usia-item">
          <div class="usia-num">{{ $usia['balita'] }}</div>
          <div class="usia-label">Balita<br>0–4 thn</div>
        </div>
        <div class="usia-item">
          <div class="usia-num">{{ $usia['anak'] }}</div>
          <div class="usia-label">Anak<br>5–14 thn</div>
        </div>
        <div class="usia-item">
          <div class="usia-num">{{ $usia['remaja'] }}</div>
          <div class="usia-label">Remaja<br>15–24 thn</div>
        </div>
        <div class="usia-item">
          <div class="usia-num">{{ $usia['dewasa'] }}</div>
          <div class="usia-label">Dewasa<br>25–59 thn</div>
        </div>
        <div class="usia-item">
          <div class="usia-num">{{ $usia['lansia'] }}</div>
          <div class="usia-label">Lansia<br>60+ thn</div>
        </div>
      </div>
    </div>
  </div>

  {{-- CHARTS: AGAMA + PENDIDIKAN --}}
  <div class="section">
    <div class="section-label">Distribusi Data</div>
    <div class="charts-grid">
      <div class="card">
        <div class="card-title">Agama</div>
        @php $maxAgama = $agama->max('total') ?: 1; @endphp
        @foreach($agama as $item)
        <div class="bar-item">
          <div class="bar-meta">
            <span class="bar-name">{{ $item->religion ?: 'Tidak Diisi' }}</span>
            <span class="bar-val">{{ $item->total }}</span>
          </div>
          <div class="bar-track">
            <div class="bar-fill fill-blue" style="width:{{ ($item->total/$maxAgama)*100 }}%"></div>
          </div>
        </div>
        @endforeach
      </div>

      <div class="card green-bar">
        <div class="card-title">Pendidikan</div>
        @php $maxPendidikan = $pendidikan->max('total') ?: 1; @endphp
        @foreach($pendidikan as $item)
        <div class="bar-item">
          <div class="bar-meta">
            <span class="bar-name">{{ $item->education ?: 'Tidak Diisi' }}</span>
            <span class="bar-val">{{ $item->total }}</span>
          </div>
          <div class="bar-track">
            <div class="bar-fill fill-green" style="width:{{ ($item->total/$maxPendidikan)*100 }}%"></div>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    {{-- PEKERJAAN --}}
    <div class="card amber-bar">
      <div class="card-title">Pekerjaan (Top 8)</div>
      @php $maxPekerjaan = $pekerjaan->max('total') ?: 1; @endphp
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:0 32px">
        @foreach($pekerjaan as $item)
        <div class="bar-item">
          <div class="bar-meta">
            <span class="bar-name">{{ $item->occupation ?: 'Tidak Diisi' }}</span>
            <span class="bar-val">{{ $item->total }}</span>
          </div>
          <div class="bar-track">
            <div class="bar-fill fill-amber" style="width:{{ ($item->total/$maxPekerjaan)*100 }}%"></div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  {{-- STATUS PERKAWINAN --}}
  <div class="section">
    <div class="section-label">Status Perkawinan</div>
    <div class="card">
      @php $maxKawin = $status_kawin->max('total') ?: 1; @endphp
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:0 32px">
        @foreach($status_kawin as $item)
        <div class="bar-item">
          <div class="bar-meta">
            <span class="bar-name">{{ $item->marital_status ?: 'Tidak Diisi' }}</span>
            <span class="bar-val">{{ $item->total }}</span>
          </div>
          <div class="bar-track">
            <div class="bar-fill fill-purple" style="width:{{ ($item->total/$maxKawin)*100 }}%"></div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  {{-- TABEL PENDUDUK TERBARU --}}
  <div class="section">
    <div class="section-label">Penduduk Terbaru</div>
    <div class="card">
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Gender</th>
              <th>Tgl Lahir</th>
              <th>Agama</th>
              <th>Pekerjaan</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @forelse($penduduk_terbaru as $i => $p)
            <tr>
              <td style="color:var(--muted);font-size:.75rem">{{ $i+1 }}</td>
              <td class="name-cell">{{ $p->full_name }}</td>
              <td>
                <span class="badge {{ $p->gender==='Laki-laki'?'badge-L':'badge-P' }}">
                  {{ $p->gender==='Laki-laki'?'L':'P' }}
                </span>
              </td>
              <td style="color:var(--muted)">{{ $p->birth_date?$p->birth_date->format('d M Y'):'-' }}</td>
              <td>{{ $p->religion??'-' }}</td>
              <td>{{ $p->occupation??'-' }}</td>
              <td style="color:var(--muted);font-size:.75rem">{{ $p->marital_status??'-' }}</td>
            </tr>
            @empty
            <tr>
              <td colspan="7" style="text-align:center;color:var(--muted);padding:40px;font-size:.88rem">
                Belum ada data penduduk
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>

<div class="footer">
  Data diperbarui secara berkala &bull; Sistem Informasi Kependudukan &bull;
  <a href="/admin">Login Admin</a>
</div>

</body>
</html>
