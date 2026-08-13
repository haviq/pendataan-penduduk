<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cetak Kartu Keluarga — SIDUKUH Gondang</title>
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
.card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:20px;box-shadow:0 1px 2px rgba(0,0,0,.05);margin-bottom:16px}
.card-top{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;margin-bottom:14px}
.card-title{font-size:.82rem;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:.05em}
.search-box{display:flex;align-items:center;gap:7px;background:#f9fafb;border:1px solid #e5e7eb;border-radius:8px;padding:7px 12px;transition:border-color .15s}
.search-box:focus-within{border-color:#3b82f6;background:#fff}
.search-box svg{width:13px;height:13px;color:#9ca3af;flex-shrink:0}
.search-box input{border:none;outline:none;background:transparent;font-family:inherit;font-size:.8rem;color:#111827;width:180px}
.search-box input::placeholder{color:#9ca3af}
.bulk-bar{display:flex;align-items:center;gap:10px;padding:10px 14px;background:#eff6ff;border:1px solid #dbeafe;border-radius:8px;margin-bottom:14px}
.bulk-bar span{font-size:.8rem;font-weight:600;color:#2563eb;flex:1}
.btn{display:inline-flex;align-items:center;gap:7px;font-family:inherit;font-size:.82rem;font-weight:600;padding:8px 16px;border-radius:8px;border:none;cursor:pointer;transition:background .15s;text-decoration:none}
.btn-primary{background:#2563eb;color:#fff}
.btn-primary:hover{background:#1d4ed8}
.btn-sm{padding:5px 10px;font-size:.75rem}
.btn-outline{background:#fff;color:#374151;border:1px solid #e5e7eb}
.btn-outline:hover{background:#f9fafb}
table{width:100%;border-collapse:collapse}
thead tr{border-bottom:1px solid #e5e7eb}
th{text-align:left;padding:9px 12px;font-size:.68rem;font-weight:600;color:#9ca3af;text-transform:uppercase;letter-spacing:.06em}
td{padding:11px 12px;border-bottom:1px solid #f3f4f6;font-size:.82rem;color:#374151;vertical-align:middle}
tbody tr:last-child td{border-bottom:none}
tbody tr:hover td{background:#f9fafb}
.td-kk{font-family:'SF Mono',monospace;font-size:.75rem;color:#6b7280}
.td-name{font-weight:600;color:#111827}
.td-rt{font-size:.75rem;color:#2563eb;font-weight:500}
.badge-kk{display:inline-flex;align-items:center;padding:2px 8px;border-radius:99px;font-size:.68rem;font-weight:600;background:#f3f4f6;color:#374151}
</style>
</head>
<body>
<nav class="nav">
  <div class="nav-logo">
    <svg fill="none" viewBox="0 0 16 16" stroke="currentColor" stroke-width="1.5"><rect x="1" y="2" width="14" height="10" rx="2"/><path d="M5 15h6M8 12v3"/></svg>
  </div>
  <span class="nav-title">Cetak Kartu Keluarga</span>
  <a href="/" class="nav-link">← Beranda</a>
</nav>

<main class="page">
  <div class="hero">
    <div class="hero-tag">🏠 Kartu Keluarga</div>
    <h1>Cetak Kartu Keluarga</h1>
    <p>Pilih satu atau beberapa KK untuk dicetak dalam format PDF A5.</p>
  </div>

  <div class="card">
    <div class="card-top">
      <span class="card-title">Daftar Kartu Keluarga</span>
      <form method="GET" action="{{ route('kartu_kk.index') }}">
        <div class="search-box">
          <svg fill="none" viewBox="0 0 14 14" stroke="currentColor" stroke-width="1.5"><circle cx="6" cy="6" r="4"/><path d="M10 10l3 3"/></svg>
          <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari no KK, alamat, kepala...">
        </div>
      </form>
    </div>

    <form method="POST" action="{{ route('kartu_kk.bulk') }}" id="bulk-form">
      @csrf
      <div class="bulk-bar" id="bulk-bar" style="display:none">
        <span id="bulk-count">0 KK dipilih</span>
        <button type="submit" class="btn btn-primary btn-sm">
          <svg width="13" height="13" fill="none" viewBox="0 0 14 14" stroke="currentColor" stroke-width="1.5"><path d="M4 11h6M7 2v6M4 5l3 3 3-3"/></svg>
          Cetak Bulk PDF
        </button>
        <button type="button" class="btn btn-outline btn-sm" onclick="clearSelection()">Batal</button>
      </div>

      <table>
        <thead>
          <tr>
            <th style="width:36px"><input type="checkbox" id="chk-all" onchange="toggleAll(this)"></th>
            <th>No KK</th>
            <th>Kepala Keluarga</th>
            <th>Alamat</th>
            <th>RT/RW</th>
            <th>Anggota</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($households as $hh)
          <tr>
            <td><input type="checkbox" name="ids[]" value="{{ $hh->id }}" class="chk-item" onchange="updateBulk()"></td>
            <td class="td-kk">{{ $hh->no_kk }}</td>
            <td class="td-name">{{ $hh->head?->full_name ?? '—' }}</td>
            <td style="max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $hh->address }}</td>
            <td class="td-rt">RT {{ $hh->rt?->number ?? '-' }}/RW {{ $hh->rt?->rw?->number ?? '-' }}</td>
            <td><span class="badge-kk">{{ $hh->residents_count }} jiwa</span></td>
            <td>
              <a href="{{ route('kartu_kk.cetak', $hh->id) }}" class="btn btn-outline btn-sm" target="_blank">
                <svg width="12" height="12" fill="none" viewBox="0 0 14 14" stroke="currentColor" stroke-width="1.5"><path d="M4 11h6M7 2v6M4 5l3 3 3-3"/></svg>
                Cetak
              </a>
            </td>
          </tr>
          @empty
          <tr><td colspan="7" style="text-align:center;padding:32px;color:#9ca3af;font-size:.85rem;">Tidak ada data KK.</td></tr>
          @endforelse
        </tbody>
      </table>
    </form>

    <div style="margin-top:14px;display:flex;align-items:center;justify-content:space-between;padding-top:12px;border-top:1px solid #f3f4f6;">
      <span style="font-size:.75rem;color:#9ca3af;">{{ $households->total() }} total KK</span>
      {{ $households->links() }}
    </div>
  </div>
</main>

<script>
function toggleAll(master) {
  document.querySelectorAll('.chk-item').forEach(c => c.checked = master.checked);
  updateBulk();
}
function updateBulk() {
  const checked = document.querySelectorAll('.chk-item:checked').length;
  const bar = document.getElementById('bulk-bar');
  const count = document.getElementById('bulk-count');
  bar.style.display = checked > 0 ? 'flex' : 'none';
  count.textContent = checked + ' KK dipilih';
}
function clearSelection() {
  document.querySelectorAll('.chk-item').forEach(c => c.checked = false);
  document.getElementById('chk-all').checked = false;
  updateBulk();
}
</script>
</body>
</html>
