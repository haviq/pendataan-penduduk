<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Persebaran RT — SIDUKUH Gondang</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Inter',system-ui,sans-serif;background:#f9fafb;color:#111827;min-height:100vh;-webkit-font-smoothing:antialiased}
.nav{position:sticky;top:0;z-index:50;background:rgba(255,255,255,.92);backdrop-filter:blur(12px);border-bottom:1px solid #e5e7eb;height:56px;display:flex;align-items:center;padding:0 20px;gap:12px}
.nav-logo{width:32px;height:32px;border-radius:8px;background:#2563eb;display:flex;align-items:center;justify-content:center}
.nav-logo svg{width:16px;height:16px;color:#fff}
.nav-title{font-size:.9rem;font-weight:700;flex:1}
.nav-link{font-size:.8rem;font-weight:600;color:#6b7280;text-decoration:none;padding:5px 12px;border-radius:6px;border:1px solid #e5e7eb}
.nav-link:hover{background:#f3f4f6}
.page{max-width:1024px;margin:0 auto;padding:28px 20px 64px}
.hero{margin-bottom:24px}
.hero-tag{display:inline-flex;align-items:center;gap:6px;font-size:.72rem;font-weight:600;color:#2563eb;background:#eff6ff;border:1px solid #dbeafe;padding:3px 10px;border-radius:99px;margin-bottom:10px}
.hero h1{font-size:1.6rem;font-weight:800;letter-spacing:-.02em;margin-bottom:6px}
.hero p{font-size:.9rem;color:#6b7280;line-height:1.65}
.divider{display:flex;align-items:center;gap:10px;margin:0 0 12px}
.divider-label{font-size:.72rem;font-weight:600;color:#9ca3af;text-transform:uppercase;letter-spacing:.06em;white-space:nowrap}
.divider-line{flex:1;height:1px;background:#e5e7eb}
.rt-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:12px}
@media(min-width:480px){.rt-grid{grid-template-columns:repeat(3,1fr)}}
@media(min-width:768px){.rt-grid{grid-template-columns:repeat(4,1fr)}}
.rt-card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:18px;text-decoration:none;color:inherit;display:block;transition:box-shadow .2s,transform .2s,border-color .2s}
.rt-card:hover{box-shadow:0 4px 12px rgba(0,0,0,.08);transform:translateY(-1px);border-color:#bfdbfe}
.rt-label{font-size:.68rem;font-weight:700;color:#2563eb;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px}
.rt-num{font-size:1.8rem;font-weight:800;color:#111827;line-height:1;letter-spacing:-.03em}
.rt-unit{font-size:.75rem;font-weight:500;color:#9ca3af}
.rt-kk{font-size:.75rem;color:#6b7280;margin-top:4px}
.rt-track{background:#f3f4f6;border-radius:99px;height:3px;margin-top:12px;overflow:hidden}
.rt-fill{height:100%;border-radius:99px;background:#3b82f6}
.rt-arrow{font-size:.72rem;color:#9ca3af;margin-top:8px;display:flex;align-items:center;gap:3px}
</style>
</head>
<body>
<nav class="nav">
  <div class="nav-logo">
    <svg fill="none" viewBox="0 0 16 16" stroke="currentColor" stroke-width="1.5"><path d="M8 1L1 5v10h14V5z"/><path d="M5 15V9h6v6"/></svg>
  </div>
  <span class="nav-title">Persebaran RT — SIDUKUH Gondang</span>
  <a href="/" class="nav-link">← Beranda</a>
</nav>

<main class="page">
  <div class="hero">
    <div class="hero-tag">🏘️ Data RT</div>
    <h1>Persebaran Warga per RT</h1>
    <p>Klik pada kartu RT untuk melihat detail statistik demografi, distribusi usia, dan daftar warga.</p>
  </div>

  <div class="divider"><span class="divider-label">{{ $rts->count() }} Rukun Tetangga</span><div class="divider-line"></div></div>

  <div class="rt-grid">
    @forelse($rts as $rt)
      @php $pct = $maxWarga > 0 ? round($rt->total_warga/$maxWarga*100) : 0; @endphp
      <a href="{{ route('rt.show', $rt->id) }}" class="rt-card">
        <div class="rt-label">RT {{ $rt->number }} / RW {{ $rt->rw?->number ?? '-' }}</div>
        <div class="rt-num">{{ number_format($rt->total_warga) }}<span class="rt-unit"> jiwa</span></div>
        <div class="rt-kk">{{ number_format($rt->total_kk) }} Kartu Keluarga</div>
        <div class="rt-track"><div class="rt-fill" style="width:{{ $pct }}%"></div></div>
        <div class="rt-arrow">Lihat detail →</div>
      </a>
    @empty
      <p style="color:#9ca3af;font-size:.85rem;grid-column:1/-1">Belum ada data RT.</p>
    @endforelse
  </div>
</main>
</body>
</html>
