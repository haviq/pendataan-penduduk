<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/auth.php';
requireLogin();

$pageTitle  = 'Dashboard';
$activeMenu = 'dashboard';

// ---- Statistik kartu ----
$totalRW       = $pdo->query("SELECT COUNT(*) FROM data_rw")->fetchColumn();
$totalRT       = $pdo->query("SELECT COUNT(*) FROM data_rt")->fetchColumn();
$totalKK       = $pdo->query("SELECT COUNT(*) FROM data_kk")->fetchColumn();
$totalWarga    = $pdo->query("SELECT COUNT(*) FROM data_penduduk")->fetchColumn();

// ---- Grafik: pertambahan warga per bulan ----
// Ambil daftar semua tahun yang ada datanya, untuk dropdown pilihan.
$tahunList = $pdo->query("
    SELECT DISTINCT YEAR(created_at) AS tahun FROM data_penduduk ORDER BY tahun DESC
")->fetchAll(PDO::FETCH_COLUMN);

if (empty($tahunList)) {
    $tahunList = [date('Y')];
}

// Tahun yang dipilih: dari dropdown (?tahun=2026), atau default ke yang terbaru.
$tahunChart = $_GET['tahun'] ?? $tahunList[0];
if (!in_array($tahunChart, $tahunList)) {
    $tahunChart = $tahunList[0];
}

$stmt = $pdo->prepare("
    SELECT MONTH(created_at) AS bulan, COUNT(*) AS jumlah
    FROM data_penduduk
    WHERE YEAR(created_at) = ?
    GROUP BY MONTH(created_at)
");
$stmt->execute([$tahunChart]);
$rowsPerBulan = $stmt->fetchAll();

$wargaPerBulan = array_fill(1, 12, 0);
foreach ($rowsPerBulan as $r) {
    $wargaPerBulan[(int)$r['bulan']] = (int)$r['jumlah'];
}

// ---- Grafik: usia (dewasa >= 17 tahun, anak-anak < 17 tahun) ----
$dewasa = $pdo->query("
    SELECT COUNT(*) FROM data_penduduk
    WHERE TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 17
")->fetchColumn();

$anak = $pdo->query("
    SELECT COUNT(*) FROM data_penduduk
    WHERE TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) < 17
")->fetchColumn();

// ---- Grafik: gender ----
$laki = $pdo->query("SELECT COUNT(*) FROM data_penduduk WHERE jenis_kelamin = 'Laki-laki'")->fetchColumn();
$perempuan = $pdo->query("SELECT COUNT(*) FROM data_penduduk WHERE jenis_kelamin = 'Perempuan'")->fetchColumn();

require_once __DIR__ . '/includes/header.php';
?>

<div class="stat-grid">
  <div class="stat-card">
    <div class="stat-icon green">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
    </div>
    <div class="stat-text">
      <div class="label">Data RW</div>
      <div class="value"><?= $totalRW ?></div>
    </div>
  </div>
  <div class="stat-card">
    <div class="stat-icon purple">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
    </div>
    <div class="stat-text">
      <div class="label">Data RT</div>
      <div class="value"><?= $totalRT ?></div>
    </div>
  </div>
  <div class="stat-card">
    <div class="stat-icon cyan">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
    </div>
    <div class="stat-text">
      <div class="label">Data KK</div>
      <div class="value"><?= $totalKK ?></div>
    </div>
  </div>
  <div class="stat-card">
    <div class="stat-icon green">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
    </div>
    <div class="stat-text">
      <div class="label">Total Warga</div>
      <div class="value"><?= $totalWarga ?></div>
    </div>
  </div>
</div>

<div class="content-grid">
  <div class="card">
    <div class="toolbar" style="margin-bottom:0;">
      <div class="card-title" style="margin-bottom:0;">Pertambahan warga setiap bulan</div>
      <form method="GET" style="display:flex; align-items:center; gap:8px;">
        <select name="tahun" onchange="this.form.submit()" style="padding:7px 10px; border-radius:8px; border:1px solid var(--border); font-size:13px;">
          <?php foreach ($tahunList as $t): ?>
            <option value="<?= $t ?>" <?= ($t == $tahunChart) ? 'selected' : '' ?>>Tahun <?= $t ?></option>
          <?php endforeach; ?>
        </select>
      </form>
    </div>
    <div class="legend-row" style="margin-top:14px;"><span class="legend-dot"></span> Warga</div>
    <div class="chart-box"><canvas id="chartWarga"></canvas></div>
  </div>

  <div class="side-col">
    <div class="card">
      <div class="card-title">Usia</div>
      <div class="chart-box small"><canvas id="chartUsia"></canvas></div>
    </div>
    <div class="card">
      <div class="card-title">Gender</div>
      <div class="chart-box small"><canvas id="chartGender"></canvas></div>
    </div>
  </div>
</div>

<script>
const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','December'];
const wargaData = <?= json_encode(array_values($wargaPerBulan)) ?>;

new Chart(document.getElementById('chartWarga'), {
  type:'line',
  data:{
    labels: months,
    datasets:[{
      data: wargaData,
      borderColor:'#4f7cff',
      backgroundColor: (ctx) => {
        const g = ctx.chart.ctx.createLinearGradient(0,0,0,220);
        g.addColorStop(0,'rgba(120,130,150,0.28)');
        g.addColorStop(1,'rgba(120,130,150,0.02)');
        return g;
      },
      fill:true, tension:0.45, pointRadius:0, borderWidth:2
    }]
  },
  options:{
    responsive:true,
    maintainAspectRatio:false,
    plugins:{ legend:{ display:false } },
    scales:{
      y:{ beginAtZero:true, ticks:{ color:'#9aa1b5', font:{size:11} }, grid:{ color:'#f0f2f8' } },
      x:{ ticks:{ color:'#9aa1b5', font:{size:9}, autoSkip:true, maxRotation:0 }, grid:{ display:false } }
    }
  }
});

new Chart(document.getElementById('chartUsia'), {
  type:'bar',
  data:{
    labels:['Dewasa','Anak-anak'],
    datasets:[{
      data:[<?= $dewasa ?>, <?= $anak ?>],
      backgroundColor:['#3fc6d4','#f28b8b'],
      borderRadius:6, maxBarThickness:60
    }]
  },
  options:{
    responsive:true,
    maintainAspectRatio:false,
    plugins:{ legend:{ display:false } },
    scales:{
      y:{ beginAtZero:true, ticks:{ stepSize:1, color:'#9aa1b5', font:{size:10} }, grid:{ color:'#f0f2f8' } },
      x:{ ticks:{ color:'#9aa1b5', font:{size:10} }, grid:{ display:false } }
    }
  }
});

new Chart(document.getElementById('chartGender'), {
  type:'doughnut',
  data:{
    labels:['Laki-laki','Perempuan'],
    datasets:[{
      data:[<?= $laki ?>, <?= $perempuan ?>],
      backgroundColor:['#3fa9f5','#f26d8d'],
      borderWidth:0
    }]
  },
  options:{
    responsive:true, maintainAspectRatio:false, cutout:'68%',
    plugins:{ legend:{ display:true, position:'top', align:'end', labels:{ boxWidth:10, boxHeight:10, font:{size:11}, color:'#9aa1b5' } } }
  }
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
