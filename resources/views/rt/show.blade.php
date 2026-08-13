<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>RT {{ $rt->number }} / RW {{ $rt->rw?->number ?? '-' }} — SIDUKUH Gondang</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Inter',system-ui,sans-serif;background:#f9fafb;color:#111827;-webkit-font-smoothing:antialiased}
.nav{position:sticky;top:0;z-index:50;background:rgba(255,255,255,.92);backdrop-filter:blur(12px);border-bottom:1px solid #e5e7eb;height:56px;display:flex;align-items:center;padding:0 20px;gap:12px}
.nav-logo{width:32px;height:32px;border-radius:8px;background:#2563eb;display:flex;align-items:center;justify-content:center}
.nav-logo svg{width:16px;height:16px;color:#fff}
.nav-title{font-size:.9rem;font-weight:700;flex:1}
.nav-link{font-size:.8rem;font-weight:600;color:#6b7280;text-decoration:none;padding:5px 12px;border-radius:6px;border:1px solid #e5e7eb}
.page{max-width:960px;margin:0 auto;padding:28px 20px 64px}
.hero{margin-bottom:24px}
.hero-tag{display:inline-flex;align-items:center;gap:6px;font-size:.72rem;font-weight:600;color:#2563eb;background:#eff6ff;border:1px solid #dbeafe;padding:3px 10px;border-radius:99px;margin-bottom:10px}
.hero h1{font-size:1.6rem;font-weight:800;letter-spacing:-.02em;margin-bottom:6px}
.hero p{font-size:.9rem;color:#6b7280}
.stat-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:10px;margin-bottom:20px}
@media(min-width:500px){.stat-grid{grid-template-columns:repeat(4,1fr)}}
.stat-card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:16px;box-shadow:0 1px 2px rgba(0,0,0,.05)}
.stat-icon{width:30px;height:30px;border-radius:7px;display:flex;align-items:center;justify-content:center;margin-bottom:8px}
.stat-icon svg{width:14px;height:14px}
.stat-num{font-size:1.5rem;font-weight:800;color:#111827;line-height:1;letter-spacing:-.02em}
.stat-label{font-size:.72rem;font-weight:500;color:#6b7280;margin-top:3px}
.ic-blue{background:#eff6ff;color:#2563eb}
.ic-green{background:#f0fdf4;color:#16a34a}
.ic-rose{background:#fff1f2;color:#e11d48}
.ic-teal{background:#f0fdfa;color:#0d9488}
.two-col{display:grid;grid-template-columns:1fr;gap:12px;margin-bottom:12px}
@media(min-width:600px){.two-col{grid-template-columns:1fr 1fr}}
.card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:18px;box-shadow:0 1px 2px rgba(0,0,0,.05)}
.card-title{font-size:.75rem;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:.05em;margin-bottom:14px}
.usia-list{display:flex;flex-direction:column;gap:10px}
.usia-row{display:grid;grid-template-columns:54px 1fr 40px 34px;align-items:center;gap:8px}
.usia-label{font-size:.72rem;font-weight:600;color:#4b5563}
.usia-track{background:#f3f4f6;border-radius:99px;height:6px;overflow:hidden}
.usia-fill{height:100%;border-radius:99px}
.usia-val{font-size:.72rem;font-weight:700;color:#111827;text-align:right}
.usia-pct{font-size:.65rem;color:#9ca3af;text-align:right}
.bar-list{display:flex;flex-direction:column;gap:10px}
.bar-top{display:flex;justify-content:space-between;margin-bottom:4px}
.bar-name{font-size:.78rem;font-weight:500;color:#374151}
.bar-meta{font-size:.7rem;color:#9ca3af}
.bar-track{background:#f3f4f6;border-radius:99px;height:5px;overflow:hidden}
.bar-fill{height:100%;border-radius:99px}
.donut-wrap{display:flex;align-items:center;gap:16px}
.donut-canvas{width:100px;height:100px;flex-shrink:0;position:relative}
.donut-center{position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;pointer-events:none}
.donut-center-num{font-size:1rem;font-weight:800;color:#111827;line-height:1}
.donut-center-lbl{font-size:.52rem;color:#9ca3af;text-transform:uppercase;margin-top:2px}
.legend{flex:1;display:flex;flex-direction:column;gap:8px}
.legend-row{display:flex;align-items:center;gap:8px}
.legend-dot{width:8px;height:8px;border-radius:2px;flex-shrink:0}
.legend-name{font-size:.78rem;color:#6b7280;flex:1}
.legend-val{font-size:.78rem;font-weight:700;color:#111827}
.legend-pct{font-size:.68rem;color:#9ca3af;margin-left:3px}
table{width:100%;border-collapse:collapse}
thead tr{border-bottom:1px solid #e5e7eb}
th{text-align:left;padding:8px 10px;font-size:.65rem;font-weight:600;color:#9ca3af;text-transform:uppercase;letter-spacing:.06em}
td{padding:10px 10px;border-bottom:1px solid #f3f4f6;font-size:.8rem;color:#374151}
tbody tr:last-child td{border-bottom:none}
tbody tr:hover td{background:#f9fafb}
.td-name{font-weight:600;color:#111827}
.badge-m{background:#eff6ff;color:#2563eb;padding:2px 7px;border-radius:99px;font-size:.65rem;font-weight:600}
.badge-f{background:#fff1f2;color:#e11d48;padding:2px 7px;border-radius:99px;font-size:.65rem;font-weight:600}
</style>
</head>
<body>
<nav class="nav">
  <div class="nav-logo">
    <svg fill="none" viewBox="0 0 16 16" stroke="currentColor" stroke-width="1.5"><path d="M8 1L1 5v10h14V5z"/><path d="M5 15V9h6v6"/></svg>
  </div>
  <span class="nav-title">RT {{ $rt->number }} / RW {{ $rt->rw?->number ?? '-' }}</span>
  <a href="{{ route('rt.index') }}" class="nav-link">← Semua RT</a>
</nav>

<main class="page">
  <div class="hero">
    <div class="hero-tag">🏠 Detail RT</div>
    <h1>RT {{ $rt->number }} / RW {{ $rt->rw?->number ?? '-' }}</h1>
    <p>Data demografi dan warga aktif di wilayah ini.</p>
  </div>

  <div class="stat-grid">
    <div class="stat-card"><div class="stat-icon ic-blue"><svg fill="none" viewBox="0 0 14 14" stroke="currentColor" stroke-width="1.5"><circle cx="7" cy="4" r="2.5"/><path d="M2 13c0-2.76 2.24-5 5-5s5 2.24 5 5"/></svg></div><div class="stat-num">{{ number_format($totalWarga) }}</div><div class="stat-label">Total Warga</div></div>
    <div class="stat-card"><div class="stat-icon ic-teal"><svg fill="none" viewBox="0 0 14 14" stroke="currentColor" stroke-width="1.5"><rect x="1" y="2" width="12" height="9" rx="1.5"/><path d="M4 11v2M10 11v2"/></svg></div><div class="stat-num">{{ number_format($totalKK) }}</div><div class="stat-label">Kartu Keluarga</div></div>
    <div class="stat-card"><div class="stat-icon ic-green"><svg fill="none" viewBox="0 0 14 14" stroke="currentColor" stroke-width="1.5"><circle cx="5" cy="4" r="2"/><path d="M1 12c0-2.2 2-4 4-4"/></svg></div><div class="stat-num">{{ number_format($totalLaki) }}</div><div class="stat-label">Laki-laki</div></div>
    <div class="stat-card"><div class="stat-icon ic-rose"><svg fill="none" viewBox="0 0 14 14" stroke="currentColor" stroke-width="1.5"><circle cx="7" cy="4" r="2.5"/><path d="M3.5 12c.5-2 1.8-3 3.5-3s3 1 3.5 3"/></svg></div><div class="stat-num">{{ number_format($totalPerempuan) }}</div><div class="stat-label">Perempuan</div></div>
  </div>

  <div class="two-col">
    <!-- USIA -->
    <div class="card">
      <div class="card-title">Distribusi Usia</div>
      @php
        $totalUsia = array_sum($usia);
        $usiaColors = ['#3b82f6','#14b8a6','#22c55e','#a855f7','#f59e0b'];
        $i = 0;
      @endphp
      <div class="usia-list">
        @foreach($usia as $lbl => $jml)
          @php $pct = $totalUsia > 0 ? round($jml/$totalUsia*100,1) : 0; @endphp
          <div class="usia-row">
            <span class="usia-label">{{ $lbl }}</span>
            <div class="usia-track"><div class="usia-fill" style="width:0%;background:{{ $usiaColors[$i] }};" data-target="{{ $pct }}"></div></div>
            <span class="usia-val">{{ number_format($jml) }}</span>
            <span class="usia-pct">{{ $pct }}%</span>
          </div>
          @php $i++ @endphp
        @endforeach
      </div>
    </div>

    <!-- GENDER DONUT -->
    <div class="card">
      <div class="card-title">Rasio Gender</div>
      <div class="donut-wrap">
        <div class="donut-canvas">
          <canvas id="genderChart" width="100" height="100"></canvas>
          <div class="donut-center">
            <span class="donut-center-num">{{ number_format($totalWarga) }}</span>
            <span class="donut-center-lbl">Total</span>
          </div>
        </div>
        <div class="legend">
          <div class="legend-row">
            <div class="legend-dot" style="background:#3b82f6"></div>
            <span class="legend-name">Laki-laki</span>
            <span class="legend-val">{{ number_format($totalLaki) }}</span>
            <span class="legend-pct">{{ $totalWarga > 0 ? round($totalLaki/$totalWarga*100,1) : 0 }}%</span>
          </div>
          <div class="legend-row">
            <div class="legend-dot" style="background:#f43f5e"></div>
            <span class="legend-name">Perempuan</span>
            <span class="legend-val">{{ number_format($totalPerempuan) }}</span>
            <span class="legend-pct">{{ $totalWarga > 0 ? round($totalPerempuan/$totalWarga*100,1) : 0 }}%</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- AGAMA -->
  <div class="card" style="margin-bottom:12px">
    <div class="card-title">Distribusi Agama</div>
    @php $totalAgama = $agama->sum('total'); $barColors=['#3b82f6','#14b8a6','#22c55e','#f59e0b','#a855f7','#f43f5e']; @endphp
    <div class="bar-list">
      @foreach($agama as $idx => $a)
        @php $pct = $totalAgama > 0 ? round($a->total/$totalAgama*100,1) : 0; @endphp
        <div>
          <div class="bar-top"><span class="bar-name">{{ $a->religion ?? 'Lainnya' }}</span><span class="bar-meta">{{ number_format($a->total) }} · {{ $pct }}%</span></div>
          <div class="bar-track"><div class="bar-fill" style="width:0%;background:{{ $barColors[$idx%count($barColors)] }};" data-target="{{ $pct }}%"></div></div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- TABEL WARGA -->
  <div class="card">
    <div class="card-title">Daftar Warga ({{ $warga->count() }} jiwa)</div>
    <table>
      <thead><tr><th>#</th><th>Nama</th><th>Gender</th><th>Usia</th><th>Agama</th><th>Pekerjaan</th></tr></thead>
      <tbody>
        @foreach($warga as $i => $w)
        <tr>
          <td style="color:#9ca3af;font-size:.72rem">{{ str_pad($i+1,2,'0',STR_PAD_LEFT) }}</td>
          <td class="td-name">{{ $w->full_name }}</td>
          <td><span class="{{ $w->gender === 'Laki-laki' ? 'badge-m' : 'badge-f' }}">{{ $w->gender === 'Laki-laki' ? 'L' : 'P' }}</span></td>
          <td style="color:#2563eb;font-weight:600">{{ $w->birth_date ? $w->birth_date->age : '—' }}th</td>
          <td>{{ $w->religion ?? '—' }}</td>
          <td>{{ $w->occupation ?? '—' }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</main>

<script>
document.addEventListener('DOMContentLoaded',()=>{
  document.querySelectorAll('.usia-fill,.bar-fill').forEach(el=>{
    const t=el.dataset.target;
    setTimeout(()=>{el.style.transition='width .8s cubic-bezier(.4,0,.2,1)';el.style.width=t+(t.endsWith('%')?'':'%');},400);
  });
  new Chart(document.getElementById('genderChart'),{
    type:'doughnut',
    data:{datasets:[{data:[{{$totalLaki}},{{$totalPerempuan}}],backgroundColor:['#3b82f6','#f43f5e'],borderColor:'#fff',borderWidth:3,hoverOffset:3}]},
    options:{cutout:'72%',responsive:false,plugins:{legend:{display:false}},animation:{duration:900}}
  });
});
</script>
</body>
</html>
