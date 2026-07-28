<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth.php';
requireLogin();

$pageTitle  = 'Data Penduduk';
$activeMenu = 'penduduk';
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $nik = trim($_POST['nik'] ?? '');
    $nama_lengkap = trim($_POST['nama_lengkap'] ?? '');
    $kk_id = $_POST['kk_id'] ?? '';
    $jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
    $tempat_lahir = trim($_POST['tempat_lahir'] ?? '');
    $tanggal_lahir = $_POST['tanggal_lahir'] ?? '';
    $pekerjaan = trim($_POST['pekerjaan'] ?? '');
    $status_perkawinan = $_POST['status_perkawinan'] ?? 'Belum Kawin';

    if ($nik === '' || $nama_lengkap === '' || $kk_id === '' || $tanggal_lahir === '') {
        $error = 'NIK, Nama, Kartu Keluarga, dan Tanggal Lahir wajib diisi.';
    } else {
        try {
            if ($id) {
                $stmt = $pdo->prepare("UPDATE data_penduduk SET nik=?, nama_lengkap=?, kk_id=?, jenis_kelamin=?, tempat_lahir=?, tanggal_lahir=?, pekerjaan=?, status_perkawinan=? WHERE id=?");
                $stmt->execute([$nik, $nama_lengkap, $kk_id, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $pekerjaan, $status_perkawinan, $id]);
                $message = 'Data penduduk berhasil diperbarui.';
            } else {
                $stmt = $pdo->prepare("INSERT INTO data_penduduk (nik, nama_lengkap, kk_id, jenis_kelamin, tempat_lahir, tanggal_lahir, pekerjaan, status_perkawinan) VALUES (?,?,?,?,?,?,?,?)");
                $stmt->execute([$nik, $nama_lengkap, $kk_id, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $pekerjaan, $status_perkawinan]);
                $message = 'Data penduduk berhasil ditambahkan.';
            }
        } catch (PDOException $e) {
            $error = str_contains($e->getMessage(), 'Duplicate') ? 'NIK sudah terdaftar.' : 'Terjadi kesalahan menyimpan data.';
        }
    }
}

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM data_penduduk WHERE id=?");
    $stmt->execute([$_GET['delete']]);
    header('Location: penduduk.php?msg=deleted');
    exit;
}
if (isset($_GET['msg']) && $_GET['msg'] === 'deleted') {
    $message = 'Data penduduk berhasil dihapus.';
}

$editData = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM data_penduduk WHERE id=?");
    $stmt->execute([$_GET['edit']]);
    $editData = $stmt->fetch();
}

$kkOptions = $pdo->query("SELECT id, no_kk, kepala_keluarga FROM data_kk ORDER BY kepala_keluarga")->fetchAll();
$rwOptions = $pdo->query("SELECT id, nomor_rw FROM data_rw ORDER BY nomor_rw")->fetchAll();
$rtOptions = $pdo->query("
    SELECT rt.id, rt.nomor_rt, rt.rw_id, rw.nomor_rw
    FROM data_rt rt JOIN data_rw rw ON rw.id = rt.rw_id
    ORDER BY rw.nomor_rw, rt.nomor_rt
")->fetchAll();

// ---- Filter: pencarian, RW, RT ----
$search = trim($_GET['q'] ?? '');
$filterRW = $_GET['rw'] ?? '';
$filterRT = $_GET['rt'] ?? '';

$where = [];
$params = [];

if ($search !== '') {
    $where[] = "(p.nama_lengkap LIKE ? OR p.nik LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}
if ($filterRT !== '') {
    $where[] = "rt.id = ?";
    $params[] = $filterRT;
} elseif ($filterRW !== '') {
    $where[] = "rw.id = ?";
    $params[] = $filterRW;
}

$whereSql = $where ? ('WHERE ' . implode(' AND ', $where)) : '';

$stmt = $pdo->prepare("
    SELECT p.*, kk.no_kk, rt.nomor_rt, rw.nomor_rw
    FROM data_penduduk p
    JOIN data_kk kk ON kk.id = p.kk_id
    JOIN data_rt rt ON rt.id = kk.rt_id
    JOIN data_rw rw ON rw.id = rt.rw_id
    $whereSql
    ORDER BY rw.nomor_rw, rt.nomor_rt, p.created_at DESC
");
$stmt->execute($params);
$list = $stmt->fetchAll();

require_once __DIR__ . '/../includes/header.php';
?>

<?php if ($message): ?><div class="alert success"><?= htmlspecialchars($message) ?></div><?php endif; ?>
<?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?>

<div class="toolbar">
  <div></div>
  <button type="button" class="btn" onclick="openModal()">+ Tambah Data Penduduk</button>
</div>


<div class="modal-overlay" id="modalPenduduk">
  <div class="modal-box">
    <div class="modal-header">
      <div class="card-title"><?= $editData ? 'Edit Data Penduduk' : 'Tambah Data Penduduk' ?></div>
      <button type="button" class="modal-close" onclick="closeModal()">&times;</button>
    </div>
    <form method="POST" class="form-wrap">
      <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">
      <div class="form-group">
        <label>NIK</label>
        <input type="text" name="nik" value="<?= htmlspecialchars($editData['nik'] ?? '') ?>" placeholder="16 digit NIK" required>
      </div>
      <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" value="<?= htmlspecialchars($editData['nama_lengkap'] ?? '') ?>" required>
      </div>
      <div class="form-group">
        <label>Kartu Keluarga</label>
        <select name="kk_id" required>
          <option value="">Pilih KK</option>
          <?php foreach ($kkOptions as $kk): ?>
            <option value="<?= $kk['id'] ?>" <?= (isset($editData['kk_id']) && $editData['kk_id'] == $kk['id']) ? 'selected' : '' ?>>
              <?= htmlspecialchars($kk['no_kk']) ?> — <?= htmlspecialchars($kk['kepala_keluarga']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" required>
          <option value="Laki-laki" <?= (($editData['jenis_kelamin'] ?? '') === 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
          <option value="Perempuan" <?= (($editData['jenis_kelamin'] ?? '') === 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
        </select>
      </div>
      <div class="form-group">
        <label>Tempat Lahir</label>
        <input type="text" name="tempat_lahir" value="<?= htmlspecialchars($editData['tempat_lahir'] ?? '') ?>">
      </div>
      <div class="form-group">
        <label>Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" value="<?= htmlspecialchars($editData['tanggal_lahir'] ?? '') ?>" required>
      </div>
      <div class="form-group">
        <label>Pekerjaan</label>
        <input type="text" name="pekerjaan" value="<?= htmlspecialchars($editData['pekerjaan'] ?? '') ?>">
      </div>
      <div class="form-group">
        <label>Status Perkawinan</label>
        <select name="status_perkawinan">
          <?php foreach (['Belum Kawin','Kawin','Cerai Hidup','Cerai Mati'] as $status): ?>
            <option value="<?= $status ?>" <?= (($editData['status_perkawinan'] ?? '') === $status) ? 'selected' : '' ?>><?= $status ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-actions">
        <button type="submit" class="btn"><?= $editData ? 'Simpan Perubahan' : 'Tambah Penduduk' ?></button>
        <button type="button" class="btn secondary" onclick="closeModal()">Batal</button>
      </div>
    </form>
  </div>
</div>

<div class="card">
  <div class="toolbar" style="flex-wrap:wrap;">
    <div class="card-title" style="margin-bottom:0;">Daftar Penduduk</div>
    <form method="GET" style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
      <select name="rw" onchange="this.form.rt.value=''; this.form.submit()" style="padding:8px 10px; border-radius:8px; border:1px solid var(--border); font-size:13px;">
        <option value="">Semua RW</option>
        <?php foreach ($rwOptions as $rw): ?>
          <option value="<?= $rw['id'] ?>" <?= ($filterRW == $rw['id']) ? 'selected' : '' ?>>RW <?= htmlspecialchars($rw['nomor_rw']) ?></option>
        <?php endforeach; ?>
      </select>
      <select name="rt" onchange="this.form.submit()" style="padding:8px 10px; border-radius:8px; border:1px solid var(--border); font-size:13px;">
        <option value="">Semua RT</option>
        <?php foreach ($rtOptions as $rt): ?>
          <?php if ($filterRW !== '' && $rt['rw_id'] != $filterRW) continue; ?>
          <option value="<?= $rt['id'] ?>" <?= ($filterRT == $rt['id']) ? 'selected' : '' ?>>
            RT <?= htmlspecialchars($rt['nomor_rt']) ?> / RW <?= htmlspecialchars($rt['nomor_rw']) ?>
          </option>
        <?php endforeach; ?>
      </select>
      <input type="text" name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Cari nama / NIK..." style="padding:8px 12px; border-radius:8px; border:1px solid var(--border); font-size:13px;">
      <button type="submit" class="btn secondary small">Cari</button>
      <?php if ($search !== '' || $filterRW !== '' || $filterRT !== ''): ?>
        <a href="penduduk.php" class="btn secondary small">Reset</a>
      <?php endif; ?>
    </form>
  </div>
  <div class="table-wrap">
  <table style="min-width:820px;">
    <thead>
      <tr><th>NIK</th><th>Nama</th><th>No. KK</th><th>RT/RW</th><th>Gender</th><th>Tgl Lahir</th><th>Pekerjaan</th><th>Status</th><th>Aksi</th></tr>
    </thead>
    <tbody>
      <?php if (empty($list)): ?>
        <tr><td colspan="9" style="text-align:center; color:var(--text-muted);">Tidak ada data penduduk untuk filter ini.</td></tr>
      <?php endif; ?>
      <?php foreach ($list as $row): ?>
      <tr>
        <td><?= htmlspecialchars($row['nik']) ?></td>
        <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
        <td><?= htmlspecialchars($row['no_kk']) ?></td>
        <td><span class="badge blue">RT <?= htmlspecialchars($row['nomor_rt']) ?>/RW <?= htmlspecialchars($row['nomor_rw']) ?></span></td>
        <td><span class="badge <?= $row['jenis_kelamin'] === 'Laki-laki' ? 'blue' : 'pink' ?>"><?= htmlspecialchars($row['jenis_kelamin']) ?></span></td>
        <td><?= htmlspecialchars(date('d/m/Y', strtotime($row['tanggal_lahir']))) ?></td>
        <td><?= htmlspecialchars($row['pekerjaan']) ?></td>
        <td><?= htmlspecialchars($row['status_perkawinan']) ?></td>
        <td class="actions">
          <a href="penduduk.php?edit=<?= $row['id'] ?>" class="btn secondary small">Edit</a>
          <a href="penduduk.php?delete=<?= $row['id'] ?>" class="btn danger small" onclick="return confirm('Hapus data penduduk ini?')">Hapus</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
  <div class="scroll-hint">&larr; Geser tabel untuk melihat kolom lainnya &rarr;</div>
</div>

<script>
function openModal(){ document.getElementById('modalPenduduk').classList.add('active'); }
function closeModal(){
  document.getElementById('modalPenduduk').classList.remove('active');
  if (window.location.search.includes('edit=')) { window.location.href = 'penduduk.php'; }
}
<?php if ($editData || $error): ?>
  document.getElementById('modalPenduduk').classList.add('active');
<?php endif; ?>
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
