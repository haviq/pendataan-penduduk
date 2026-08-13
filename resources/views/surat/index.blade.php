<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Buat Surat Keterangan — SIDUKUH Gondang</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Inter',system-ui,sans-serif;background:#f9fafb;color:#111827;min-height:100vh;-webkit-font-smoothing:antialiased}
.nav{position:sticky;top:0;z-index:50;background:rgba(255,255,255,.92);backdrop-filter:blur(12px);border-bottom:1px solid #e5e7eb;height:56px;display:flex;align-items:center;padding:0 20px;gap:12px}
.nav-logo{width:32px;height:32px;border-radius:8px;background:#2563eb;display:flex;align-items:center;justify-content:center}
.nav-logo svg{width:16px;height:16px;color:#fff}
.nav-title{font-size:.9rem;font-weight:700;color:#111827;flex:1}
.nav-link{font-size:.8rem;font-weight:600;color:#6b7280;text-decoration:none;padding:5px 12px;border-radius:6px;border:1px solid #e5e7eb;transition:background .15s}
.nav-link:hover{background:#f3f4f6}
.page{max-width:720px;margin:0 auto;padding:28px 20px 64px}
.hero{margin-bottom:24px}
.hero-tag{display:inline-flex;align-items:center;gap:6px;font-size:.72rem;font-weight:600;color:#2563eb;background:#eff6ff;border:1px solid #dbeafe;padding:3px 10px;border-radius:99px;margin-bottom:10px}
.hero h1{font-size:1.6rem;font-weight:800;color:#111827;line-height:1.15;margin-bottom:6px;letter-spacing:-.02em}
.hero p{font-size:.9rem;color:#6b7280;line-height:1.65}
.card{background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:22px;box-shadow:0 1px 2px rgba(0,0,0,.05);margin-bottom:16px}
.card-title{font-size:.82rem;font-weight:700;color:#374151;margin-bottom:16px;text-transform:uppercase;letter-spacing:.05em}
.form-group{margin-bottom:16px}
label{display:block;font-size:.8rem;font-weight:600;color:#374151;margin-bottom:5px}
.form-hint{font-size:.72rem;color:#9ca3af;margin-top:3px}
select,input,textarea{width:100%;font-family:inherit;font-size:.82rem;border:1px solid #e5e7eb;border-radius:8px;padding:9px 12px;background:#fff;color:#111827;outline:none;transition:border-color .15s}
select:focus,input:focus,textarea:focus{border-color:#3b82f6;box-shadow:0 0 0 3px rgba(59,130,246,.1)}
textarea{resize:vertical;min-height:80px}
.btn{display:inline-flex;align-items:center;gap:7px;font-family:inherit;font-size:.85rem;font-weight:600;padding:9px 18px;border-radius:8px;border:none;cursor:pointer;transition:background .15s}
.btn-primary{background:#2563eb;color:#fff}
.btn-primary:hover{background:#1d4ed8}
.btn-secondary{background:#f3f4f6;color:#374151;border:1px solid #e5e7eb}
.btn-secondary:hover{background:#e5e7eb}
.jenis-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;margin-bottom:4px}
@media(max-width:540px){.jenis-grid{grid-template-columns:1fr}}
.jenis-card{border:2px solid #e5e7eb;border-radius:10px;padding:14px 12px;cursor:pointer;transition:border-color .15s,background .15s;background:#fff;text-align:center}
.jenis-card:hover{border-color:#93c5fd;background:#eff6ff}
.jenis-card.selected{border-color:#2563eb;background:#eff6ff}
.jenis-card input[type=radio]{display:none}
.jenis-card-icon{font-size:1.4rem;margin-bottom:6px}
.jenis-card-name{font-size:.8rem;font-weight:700;color:#111827}
.jenis-card-desc{font-size:.68rem;color:#9ca3af;margin-top:2px}
.divider{height:1px;background:#f3f4f6;margin:20px 0}
.riwayat-list{display:flex;flex-direction:column;gap:8px}
.riwayat-item{display:flex;align-items:center;gap:12px;padding:10px 12px;background:#f9fafb;border-radius:8px;border:1px solid #f3f4f6}
.riwayat-icon{width:32px;height:32px;border-radius:7px;background:#eff6ff;color:#2563eb;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.riwayat-icon svg{width:14px;height:14px}
.riwayat-info{flex:1;min-width:0}
.riwayat-name{font-size:.8rem;font-weight:600;color:#111827;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.riwayat-meta{font-size:.7rem;color:#9ca3af}
.badge{display:inline-flex;align-items:center;padding:2px 8px;border-radius:99px;font-size:.65rem;font-weight:600}
.badge-domisili{background:#eff6ff;color:#2563eb}
.badge-sktm{background:#fef3c7;color:#d97706}
.badge-pengantar_ktp{background:#f0fdf4;color:#16a34a}
</style>
</head>
<body>
<nav class="nav">
  <div class="nav-logo">
    <svg fill="none" viewBox="0 0 16 16" stroke="currentColor" stroke-width="1.5"><rect x="2" y="2" width="12" height="12" rx="2"/><path d="M5 8h6M8 5v6"/></svg>
  </div>
  <span class="nav-title">SIDUKUH Gondang</span>
  <a href="/" class="nav-link">← Beranda</a>
</nav>

<main class="page">
  <div class="hero">
    <div class="hero-tag">📄 Layanan Surat</div>
    <h1>Buat Surat Keterangan</h1>
    <p>Generate surat keterangan resmi dalam format PDF. Pilih warga dan jenis surat yang dibutuhkan.</p>
  </div>

  @if(session('error'))
    <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:8px;padding:12px 16px;margin-bottom:16px;font-size:.82rem;color:#dc2626;">
      {{ session('error') }}
    </div>
  @endif

  <form method="POST" action="{{ route('surat.generate') }}">
    @csrf
    <div class="card">
      <div class="card-title">Pilih Jenis Surat</div>
      <div class="jenis-grid">
        <label class="jenis-card {{ old('jenis_surat') === 'domisili' ? 'selected' : '' }}" onclick="selectJenis(this,'domisili')">
          <input type="radio" name="jenis_surat" value="domisili" {{ old('jenis_surat') === 'domisili' ? 'checked' : '' }}>
          <div class="jenis-card-icon">🏠</div>
          <div class="jenis-card-name">Surat Domisili</div>
          <div class="jenis-card-desc">Keterangan tempat tinggal</div>
        </label>
        <label class="jenis-card {{ old('jenis_surat') === 'sktm' ? 'selected' : '' }}" onclick="selectJenis(this,'sktm')">
          <input type="radio" name="jenis_surat" value="sktm" {{ old('jenis_surat') === 'sktm' ? 'checked' : '' }}>
          <div class="jenis-card-icon">📋</div>
          <div class="jenis-card-name">SKTM</div>
          <div class="jenis-card-desc">Surat Tidak Mampu</div>
        </label>
        <label class="jenis-card {{ old('jenis_surat') === 'pengantar_ktp' ? 'selected' : '' }}" onclick="selectJenis(this,'pengantar_ktp')">
          <input type="radio" name="jenis_surat" value="pengantar_ktp" {{ old('jenis_surat') === 'pengantar_ktp' ? 'checked' : '' }}>
          <div class="jenis-card-icon">🪪</div>
          <div class="jenis-card-name">Pengantar KTP</div>
          <div class="jenis-card-desc">Surat pengantar KTP</div>
        </label>
      </div>
      @error('jenis_surat')<p style="font-size:.72rem;color:#dc2626;margin-top:4px;">{{ $message }}</p>@enderror
    </div>

    <div class="card">
      <div class="card-title">Data Surat</div>
      <div class="form-group">
        <label>Pilih Warga <span style="color:#ef4444">*</span></label>
        <select name="resident_id" required>
          <option value="">-- Cari dan pilih warga --</option>
          @foreach($residents as $r)
            <option value="{{ $r->id }}" {{ old('resident_id') == $r->id ? 'selected' : '' }}>
              {{ $r->full_name }} — NIK: {{ $r->nik }}
            </option>
          @endforeach
        </select>
        @error('resident_id')<p style="font-size:.72rem;color:#dc2626;margin-top:4px;">{{ $message }}</p>@enderror
      </div>
      <div class="form-group">
        <label>Nomor Surat</label>
        <input type="text" name="nomor_surat" value="{{ old('nomor_surat') }}" placeholder="Contoh: 001/SK/VIII/2026">
        <p class="form-hint">Kosongkan jika belum ada nomor.</p>
      </div>
      <div class="form-group" style="margin-bottom:0">
        <label>Keperluan</label>
        <textarea name="keperluan" placeholder="Contoh: Untuk persyaratan beasiswa, pendaftaran sekolah, dll.">{{ old('keperluan') }}</textarea>
      </div>
    </div>

    <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">
      <svg width="16" height="16" fill="none" viewBox="0 0 16 16" stroke="currentColor" stroke-width="1.5"><path d="M4 13h8M8 3v7M5 7l3 3 3-3"/></svg>
      Download PDF
    </button>
  </form>

  @if($riwayat->count())
  <div class="divider"></div>
  <div class="card">
    <div class="card-title">Riwayat Surat Terakhir</div>
    <div class="riwayat-list">
      @foreach($riwayat as $s)
      <div class="riwayat-item">
        <div class="riwayat-icon">
          <svg fill="none" viewBox="0 0 14 14" stroke="currentColor" stroke-width="1.5"><rect x="2" y="1" width="10" height="12" rx="1.5"/><path d="M5 5h4M5 8h3"/></svg>
        </div>
        <div class="riwayat-info">
          <div class="riwayat-name">{{ $s->resident?->full_name ?? '-' }}</div>
          <div class="riwayat-meta">{{ $s->created_at->format('d/m/Y H:i') }} · Oleh: {{ $s->dicetak_oleh }}</div>
        </div>
        <span class="badge badge-{{ $s->jenis_surat }}">{{ str_replace('_',' ',strtoupper($s->jenis_surat)) }}</span>
      </div>
      @endforeach
    </div>
  </div>
  @endif
</main>

<script>
function selectJenis(el, val) {
  document.querySelectorAll('.jenis-card').forEach(c => c.classList.remove('selected'));
  el.classList.add('selected');
  el.querySelector('input').checked = true;
}
</script>
</body>
</html>
