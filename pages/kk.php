<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth.php';
requireLogin();

$pageTitle  = 'Data Kartu Keluarga';
$activeMenu = 'kk';
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $no_kk = trim($_POST['no_kk'] ?? '');
    $kepala_keluarga = trim($_POST['kepala_keluarga'] ?? '');
    $rt_id = $_POST['rt_id'] ?? '';
    $alamat = trim($_POST['alamat'] ?? '');

    if ($no_kk === '' || $kepala_keluarga === '' || $rt_id === '') {
        $error = 'Nomor KK, Kepala Keluarga, dan RT wajib diisi.';
    } else {
        try {
            if ($id) {
                $stmt = $pdo->prepare("UPDATE data_kk SET no_kk=?, kepala_keluarga=?, rt_id=?, alamat=? WHERE id=?");
                $stmt->execute([$no_kk, $kepala_keluarga, $rt_id, $alamat, $id]);
                $message = 'Data KK berhasil diperbarui.';
            } else {
                $stmt = $pdo->prepare("INSERT INTO data_kk (no_kk, kepala_keluarga, rt_id, alamat) VALUES (?,?,?,?)");
                $stmt->execute([$no_kk, $kepala_keluarga, $rt_id, $alamat]);
                $message = 'Data KK berhasil ditambahkan.';
            }
        } catch (PDOException $e) {
            $error = str_contains($e->getMessage(), 'Duplicate') ? 'Nomor KK sudah terdaftar.' : 'Terjadi kesalahan menyimpan data.';
        }
    }
}

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM data_kk WHERE id=?");
    $stmt->execute([$_GET['delete']]);
    header('Location: kk.php?msg=deleted');
    exit;
}
if (isset($_GET['msg']) && $_GET['msg'] === 'deleted') {
    $message = 'Data KK berhasil dihapus.';
}

$editData = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM data_kk WHERE id=?");
    $stmt->execute([$_GET['edit']]);
    $editData = $stmt->fetch();
}

$rtOptions = $pdo->query("
    SELECT rt.id, rt.nomor_rt, rw.nomor_rw
    FROM data_rt rt JOIN data_rw rw ON rw.id = rt.rw_id
    ORDER BY rw.nomor_rw, rt.nomor_rt
")->fetchAll();

$list = $pdo->query("
    SELECT kk.*, rt.nomor_rt, rw.nomor_rw,
           (SELECT COUNT(*) FROM data_penduduk p WHERE p.kk_id = kk.id) AS jumlah_anggota
    FROM data_kk kk
    JOIN data_rt rt ON rt.id = kk.rt_id
    JOIN data_rw rw ON rw.id = rt.rw_id
    ORDER BY kk.created_at DESC
")->fetchAll();

require_once __DIR__ . '/../includes/header.php';
?>

<?php if ($message): ?><div class="alert success"><?= htmlspecialchars($message) ?></div><?php endif; ?>
<?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?>

<div class="toolbar">
  <div></div>
  <button type="button" class="btn" onclick="openModal()">+ Tambah Kartu Keluarga</button>
</div>

<div class="modal-overlay" id="modalKK">
  <div class="modal-box">
    <div class="modal-header">
      <div class="card-title"><?= $editData ? 'Edit Kartu Keluarga' : 'Tambah Kartu Keluarga' ?></div>
      <button type="button" class="modal-close" onclick="closeModal()">&times;</button>
    </div>
    <form method="POST" class="form-wrap">
      <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">
      <div class="form-group">
        <label>Nomor KK</label>
        <input type="text" name="no_kk" value="<?= htmlspecialchars($editData['no_kk'] ?? '') ?>" placeholder="16 digit nomor KK" required>
      </div>
      <div class="form-group">
        <label>Kepala Keluarga</label>
        <input type="text" name="kepala_keluarga" value="<?= htmlspecialchars($editData['kepala_keluarga'] ?? '') ?>" placeholder="Nama kepala keluarga" required>
      </div>
      <div class="form-group">
        <label>RT</label>
        <select name="rt_id" required>
          <option value="">Pilih RT</option>
          <?php foreach ($rtOptions as $rt): ?>
            <option value="<?= $rt['id'] ?>" <?= (isset($editData['rt_id']) && $editData['rt_id'] == $rt['id']) ? 'selected' : '' ?>>
              RT <?= htmlspecialchars($rt['nomor_rt']) ?> / RW <?= htmlspecialchars($rt['nomor_rw']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label>Alamat</label>
        <input type="text" name="alamat" value="<?= htmlspecialchars($editData['alamat'] ?? '') ?>" placeholder="Jl. ...">
      </div>
      <div class="form-actions">
        <button type="submit" class="btn"><?= $editData ? 'Simpan Perubahan' : 'Tambah KK' ?></button>
        <button type="button" class="btn secondary" onclick="closeModal()">Batal</button>
      </div>
    </form>
  </div>
</div>

<div class="card">
  <div class="card-title">Daftar Kartu Keluarga</div>
  <div class="table-wrap">
  <table>
    <thead>
      <tr><th>No. KK</th><th>Kepala Keluarga</th><th>RT/RW</th><th>Alamat</th><th>Anggota</th><th>Aksi</th></tr>
    </thead>
    <tbody>
      <?php if (empty($list)): ?>
        <tr><td colspan="6" style="text-align:center; color:var(--text-muted);">Belum ada data KK.</td></tr>
      <?php endif; ?>
      <?php foreach ($list as $row): ?>
      <tr>
        <td><?= htmlspecialchars($row['no_kk']) ?></td>
        <td><?= htmlspecialchars($row['kepala_keluarga']) ?></td>
        <td><span class="badge blue">RT <?= htmlspecialchars($row['nomor_rt']) ?>/RW <?= htmlspecialchars($row['nomor_rw']) ?></span></td>
        <td><?= htmlspecialchars($row['alamat']) ?></td>
        <td><?= (int)$row['jumlah_anggota'] ?> orang</td>
        <td class="actions">
          <a href="kk.php?edit=<?= $row['id'] ?>" class="btn secondary small">Edit</a>
          <a href="kk.php?delete=<?= $row['id'] ?>" class="btn danger small" onclick="return confirm('Hapus KK ini beserta seluruh data anggotanya?')">Hapus</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
  <div class="scroll-hint">&larr; Geser tabel untuk melihat kolom lainnya &rarr;</div>
</div>

<script>
function openModal(){ document.getElementById('modalKK').classList.add('active'); }
function closeModal(){
  document.getElementById('modalKK').classList.remove('active');
  if (window.location.search.includes('edit=')) { window.location.href = 'kk.php'; }
}
<?php if ($editData || $error): ?>
  document.getElementById('modalKK').classList.add('active');
<?php endif; ?>
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
