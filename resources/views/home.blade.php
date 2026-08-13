<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Kependudukan</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box}
:root{
  --bg:#0a0f1e;
  --surface:#111827;
  --surface2:#1a2235;
  --border:#1e2d45;
  --text:#f1f5f9;
  --muted:#64748b;
  --blue:#3b82f6;
  --blue2:#1d4ed8;
  --green:#22c55e;
  --rose:#f43f5e;
  --amber:#f59e0b;
  --purple:#a78bfa;
}
body{font-family:'Plus Jakarta Sans',system-ui,sans-serif;background:var(--bg);color:var(--text);min-height:100vh}

/* HERO */
.hero{
  position:relative;
  padding:72px 24px 56px;
  text-align:center;
  overflow:hidden;
  background:linear-gradient(180deg,#0d1635 0%,var(--bg) 100%);
}
.hero::before{
  content:'';
  position:absolute;inset:0;
  background:radial-gradient(ellipse 80% 60% at 50% 0%,rgba(59,130,246,0.15),transparent);
  pointer-events:none;
}
.hero-badge{
  display:inline-flex;align-items:center;gap:6px;
  background:rgba(59,130,246,0.1);
  border:1px solid rgba(59,130,246,0.3);
  color:var(--blue);
  padding:5px 14px;border-radius:20px;
  font-size:.72rem;font-weight:600;letter-spacing:1.5px;text-transform:uppercase;
  margin-bottom:20px;
}
.hero-badge::before{content:'';width:6px;height:6px;border-radius:50%;background:var(--blue);animation:pulse 2s infinite}
@keyframes pulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.5;transform:scale(.8)}}
.hero h1{
  font-size:clamp(1.8rem,5vw,3rem);
  font-weight:800;
  line-height:1.15;
  letter-spacing:-1px;
  margin-bottom:12px;
  background:linear-gradient(135deg,#f1f5f9 30%,#93c5fd);
  -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
}
.hero p{color:var(--muted);font-size:.95rem;margin-bottom:28px;max-width:400px;margin-left:auto;margin-right:auto}
.hero-actions{display:flex;gap:10px;justify-content:center;flex-wrap:wrap}
.btn-primary{
  display:inline-block;padding:11px 24px;
  background:linear-gradient(135deg,var(--blue2),var(--blue));
  color:white;border-radius:10px;text-decoration:none;
  font-size:.85rem;font-weight:700;
  box-shadow:0 4px 20px rgba(59,130,246,0.3);
  transition:transform .2s,box-shadow .2s;
}
.btn-primary:hover{transform:translateY(-2px);box-shadow:0 6px 28px rgba(59,130,246,0.4)}
.btn-ghost{
  display:inline-block;padding:11px 24px;
  background:rgba(255,255,255,0.05);
  border:1px solid rgba(255,255,255,0.1);
  color:var(--text);border-radius:10px;text-decoration:none;
  font-size:.85rem;font-weight:600;
}

/* CONTAINER */
.container{max-width:1100px;margin:0 auto;padding:0 16px}

/* STAT CARDS */
.stats-grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(170px,1fr));
  gap:12px;
  padding:32px 0 28px;
}
.stat-card{
  background:var(--surface);
  border:1px solid var(--border);
  border-radius:14px;
  padding:20px;
  position:relative;overflow:hidden;
  transition:transform .2s,border-color .2s;
}
.stat-card:hover{transform:translateY(-3px);border-color:rgba(59,130,246,0.4)}
.stat-card::after{
  content:'';
  position:absolute;top:0;left:0;right:0;height:2px;
  background:linear-gradient(90deg,var(--accent,var(--blue)),transparent);
}
.stat-card.green{--accent:var(--green)}
.stat-card.rose{--accent:var(--rose)}
.stat-card.amber{--accent:var(--amber)}
.stat-card.purple{--accent:var(--purple)}
.stat-icon{font-size:1.5rem;margin-bottom:10px}
.stat-num{font-size:1.9rem;font-weight:800;line-height:1;margin-bottom:4px;color:var(--text)}
.stat-label{font-size:.75rem;color:var(--muted);font-weight:500;text-transform:uppercase;letter-spacing:.5px}

/* SECTION */
.section{margin-bottom:24px}
.section-header{display:flex;align-items:center;gap:8px;
  font-size:.8rem;font-weight:700;color:var(--muted);
  text-transform:uppercase;letter-spacing:1px;
  margin-bottom:14px;
}
.section-header::before{content:'';width:3px;height:14px;border-radius:2px;background:var(--blue)}

/* CARDS */
.card{
  background:var(--surface);
  border:1px solid var(--border);
  border-radius:14px;
  padding:20px;
}
.card-title{font-size:.9rem;font-weight:700;color:var(--text);margin-bottom:16px}

/* KELOMPOK USIA */
.usia-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:8px}
.usia-item{
  background:var(--surface2);
  border:1px solid var(--border);
  border-radius:10px;
  padding:14px 8px;
  text-align:center;
  transition:border-color .2s;
}
.usia-item:hover{border-color:var(--blue)}
.usia-num{font-size:1.5rem;font-weight:800;color:var(--blue)}
.usia-label{font-size:.65rem;color:var(--muted);margin-top:5px;font-weight:500;line-height:1.4}

/* CHARTS GRID */
.charts-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:16px;margin-bottom:20px}

/* BAR */
.bar-item{margin-bottom:12px}
.bar-label{display:flex;justify-content:space-between;font-size:.78rem;margin-bottom:5px}
.bar-label span:first-child{color:#cbd5e1}
.bar-label span:last-child{color:var(--muted);font-weight:600;font-size:.72rem}
.bar-track{background:var(--surface2);border-radius:4px;height:6px;overflow:hidden}
.bar-fill{height:100%;border-radius:4px;transition:width 1s ease}
.bar-blue{background:linear-gradient(90deg,var(--blue2),var(--blue))}
.bar-green{background:linear-gradient(90deg,#16a34a,var(--green))}
.bar-amber{background:linear-gradient(90deg,#d97706,var(--amber))}
.bar-purple{background:linear-gradient(90deg,#7c3aed,var(--purple))}

/* TABLE */
.table-wrap{overflow-x:auto}
table{width:100%;border-collapse:collapse;font-size:.82rem}
th{
  text-align:left;padding:10px 14px;
  background:var(--surface2);
  color:var(--muted);font-weight:600;font-size:.72rem;
  text-transform:uppercase;letter-spacing:.5px;
  border-bottom:1px solid var(--border);
}
th:first-child{border-radius:8px 0 0 0}
th:last-child{border-radius:0 8px 0 0}
td{padding:11px 14px;border-bottom:1px solid rgba(30,45,69,0.6);color:#cbd5e1}
tr:last-child td{border-bottom:none}
tr:hover td{background:var(--surface2)}
.badge{display:inline-block;padding:2px 9px;border-radius:8px;font-size:.7rem;font-weight:700}
.badge-L{background:rgba(59,130,246,0.15);color:var(--blue)}
.badge-P{background:rgba(244,63,94,0.15);color:var(--rose)}

/* FOOTER */
.footer{
  background:var(--surface);
  border-top:1px solid var(--border);
  text-align:center;padding:20px;
  font-size:.78rem;color:var(--muted);
  margin-top:40px;
}
.footer a{color:var(--blue);text-decoration:none}

@media(max-width:640px){
  .usia-grid{grid-template-columns:repeat(3,1fr)}
  .stats-grid{grid-template-columns:repeat(2,1fr)}
  .hero{padding:48px 16px 40px}
}
</style>
</head>
<body>

<div class="hero">
  <div class="hero-badge">Portal Publik</div>
  <h1>Data Kependudukan</h1>
  <p>Statistik penduduk yang transparan dan diperbarui secara berkala</p>
  <div class="hero-actions">
    <a href="/admin" class="btn-primary">Masuk Admin Panel</a>
    <a href="#statistik" class="btn-ghost">Lihat Data</a>
  </div>
</div>

<div class="container" id="statistik">

  <div class="stats-grid">
    <div class="stat-card">
      <div class="stat-icon">👥</div>
      <div class="stat-num">{{ number_format($stats['total_penduduk']) }}</div>
      <div class="stat-label">Total Penduduk</div>
    </div>
    <div class="stat-card green">
      <div class="stat-icon">🧑</div>
      <div class="stat-num">{{ number_format($stats['total_laki']) }}</div>
      <div class="stat-label">Laki-laki</div>
    </div>
    <div class="stat-card rose">
      <div class="stat-icon">👩</div>
      <div class="stat-num">{{ number_format($stats['total_perempuan']) }}</div>
      <div class="stat-label">Perempuan</div>
    </div>
    <div class="stat-card amber">
      <div class="stat-icon">🏠</div><div class="stat-num">{{ number_format($stats['total_kk']) }}</div>
      <div class="stat-label">Kepala Keluarga</div>
    </div>
    <div class="stat-card purple">
      <div class="stat-icon">💍</div>
      <div class="stat-num">{{ number_format($stats['total_nikah']) }}</div>
      <div class="stat-label">Data Pernikahan</div>
    </div>
  </div>

  <div class="section">
    <div class="section-header">Kelompok Usia</div>
    <div class="card">
      <div class="usia-grid">
        <div class="usia-item"><div class="usia-num">{{ $usia['balita'] }}</div><div class="usia-label">Balita<br>0–4 thn</div></div>
        <div class="usia-item"><div class="usia-num">{{ $usia['anak'] }}</div><div class="usia-label">Anak<br>5–14 thn</div></div>
        <div class="usia-item"><div class="usia-num">{{ $usia['remaja'] }}</div><div class="usia-label">Remaja<br>15–24 thn</div></div>
        <div class="usia-item"><div class="usia-num">{{ $usia['dewasa'] }}</div><div class="usia-label">Dewasa<br>25–59 thn</div></div>
        <div class="usia-item"><div class="usia-num">{{ $usia['lansia'] }}</div><div class="usia-label">Lansia<br>60+ thn</div></div>
      </div>
    </div>
  </div>

  <div class="section">
    <div class="section-header">Distribusi Data</div>
    <div class="charts-grid">
      <div class="card">
        <div class="card-title">Agama</div>
        @php $maxAgama = $agama->max('total') ?: 1; @endphp
        @foreach($agama as $item)
        <div class="bar-item">
          <div class="bar-label"><span>{{ $item->religion ?: 'Tidak Diisi' }}</span><span>{{ $item->total }}</span></div>
          <div class="bar-track"><div class="bar-fill bar-blue" style="width:{{ ($item->total/$maxAgama)*100 }}%"></div></div>
        </div>
        @endforeach
      </div>
      <div class="card">
        <div class="card-title">Pendidikan</div>
        @php $maxPendidikan = $pendidikan->max('total') ?: 1; @endphp
        @foreach($pendidikan as $item)
        <div class="bar-item">
          <div class="bar-label"><span>{{ $item->education ?: 'Tidak Diisi' }}</span><span>{{ $item->total }}</span></div>
          <div class="bar-track"><div class="bar-fill bar-green" style="width:{{ ($item->total/$maxPendidikan)*100 }}%"></div></div>
        </div>
        @endforeach
      </div>
    </div>

    <div class="card">
      <div class="card-title">Pekerjaan (Top 8)</div>
      @php $maxPekerjaan = $pekerjaan->max('total') ?: 1; @endphp
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:0 28px">
        @foreach($pekerjaan as $item)
        <div class="bar-item">
          <div class="bar-label"><span>{{ $item->occupation ?: 'Tidak Diisi' }}</span><span>{{ $item->total }}</span></div>
          <div class="bar-track"><div class="bar-fill bar-amber" style="width:{{ ($item->total/$maxPekerjaan)*100 }}%"></div></div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  <div class="section">
    <div class="section-header">Penduduk Terbaru</div>
    <div class="card">
      <div class="table-wrap">
        <table>
          <thead>
            <tr><th>#</th><th>Nama</th><th>Gender</th><th>Tgl Lahir</th><th>Agama</th><th>Pekerjaan</th></tr>
          </thead>
          <tbody>
            @forelse($penduduk_terbaru as $i => $p)
            <tr>
              <td style="color:var(--muted)">{{ $i+1 }}</td>
              <td style="font-weight:600;color:var(--text)">{{ $p->full_name }}</td>
              <td><span class="badge {{ $p->gender==='Laki-laki'?'badge-L':'badge-P' }}">{{ $p->gender==='Laki-laki'?'L':'P' }}</span></td>
              <td>{{ $p->birth_date?$p->birth_date->format('d M Y'):'-' }}</td>
              <td>{{ $p->religion??'-' }}</td>
              <td>{{ $p->occupation??'-' }}</td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;color:var(--muted);padding:32px">Belum ada data penduduk</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<div class="footer">
  Data diperbarui secara berkala &bull; <a href="/admin">Login Admin</a>
</div>

</body>
</html>
