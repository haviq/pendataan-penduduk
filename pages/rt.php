<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth.php';
requireLogin();

$pageTitle  = 'Data RT';
$activeMenu = 'rt';
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $nomor_rt = trim($_POST['nomor_rt'] ?? '');
    $rw_id = $_POST['rw_id'] ?? '';
    $nama_ketua = trim($_POST['nama_ketua'] ?? '');
    $no_telepon = trim($_POST['no_telepon'] ?? '');

    if ($nomor_rt === '' || $rw_id === '' || $nama_ketua === '') {
        $error = 'Nomor RT, RW induk, dan Nama Ketua wajib diisi.';
    } else {
        if ($id) {
            $stmt = $pdo->prepare("UPDATE data_rt SET nomor_rt=?, rw_id=?, nama_ketua=?, no_telepon=? WHERE id=?");
            $stmt->execute([$nomor_rt, $rw_id, $nama_ketua, $no_telepon, $id]);
            $message = 'Data RT berhasil diperbarui.';
        } else {
            $stmt = $pdo->prepare("INSERT INTO data_rt (nomor_rt, rw_id, nama_ketua, no_telepon) VALUES (?,?,?,?)");
            $stmt->execute([$nomor_rt, $rw_id, $nama_ketua, $no_telepon]);
            $message = 'Data RT berhasil ditambahkan.';
        }
    }
}

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM data_rt WHERE id=?");
    $stmt->execute([$_GET['delete']]);
    header('Location: rt.php?msg=deleted');
    exit;
}
if (isset($_GET['msg']) && $_GET['msg'] === 'deleted') {
    $message = 'Data RT berhasil dihapus.';
}

$editData = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM data_rt WHERE id=?");
    $stmt->execute([$_GET['edit']]);
    $editData = $stmt->fetch();
}

$rwOptions = $pdo->query("SELECT id, nomor_rw FROM data_rw ORDER BY nomor_rw")->fetchAll();

$list = $pdo->query("
    SELECT rt.*, rw.nomor_rw
    FROM data_rt rt
    JOIN data_rw rw ON rw.id = rt.rw_id
    ORDER BY rw.nomor_rw, rt.nomor_rt
")->fetchAll();

require_once __DIR__ . '/../includes/header.php';
?>

<?php if ($message): ?><div class="alert success"><?= htmlspecialchars($message) ?></div><?php endif; ?>
<?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?>

<div class="toolbar">
  <div></div>
  <button type="button" class="btn" onclick="openModal()">+ Tambah Data RT</button>
</div>

<div class="modal-overlay" id="modalRT">
  <div class="modal-box">
    <div class="modal-header">
      <div class="card-title"><?= $editData ? 'Edit Data RT' : 'Tambah Data RT' ?></div>
      <button type="button" class="modal-close" onclick="closeModal()">&times;</button>
    </div>
    <form method="POST" class="form-wrap">
      <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">
      <div class="form-group">
        <label>Nomor RT</label>
        <input type="text" name="nomor_rt" value="<?= htmlspecialchars($editData['nomor_rt'] ?? '') ?>" placeholder="001" required>
      </div>
      <div class="form-group">
        <label>RW Induk</label>
        <select name="rw_id" required>
          <option value="">Pilih RW</option>
          <?php foreach ($rwOptions as $rw): ?>
            <option value="<?= $rw['id'] ?>" <?= (isset($editData['rw_id']) && $editData['rw_id'] == $rw['id']) ? 'selected' : '' ?>>
              RW <?= htmlspecialchars($rw['nomor_rw']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label>Nama Ketua</label>
        <input type="text" name="nama_ketua" value="<?= htmlspecialchars($editData['nama_ketua'] ?? '') ?>" placeholder="Nama lengkap ketua RT" required>
      </div>
      <div class="form-group">
        <label>No. Telepon</label>
        <input type="text" name="no_telepon" value="<?= htmlspecialchars($editData['no_telepon'] ?? '') ?>" placeholder="08xxxxxxxxxx">
      </div>
      <div class="form-actions">
        <button type="submit" class="btn"><?= $editData ? 'Simpan Perubahan' : 'Tambah RT' ?></button>
        <button type="button" class="btn secondary" onclick="closeModal()">Batal</button>
      </div>
    </form>
  </div>
</div>

<div class="card">
  <div class="card-title">Daftar RT</div>
  <div class="table-wrap">
  <table>
    <thead>
      <tr><th>Nomor RT</th><th>RW</th><th>Nama Ketua</th><th>No. Telepon</th><th>Aksi</th></tr>
    </thead>
    <tbody>
      <?php if (empty($list)): ?>
        <tr><td colspan="5" style="text-align:center; color:var(--text-muted);">Belum ada data RT.</td></tr>
      <?php endif; ?>
      <?php foreach ($list as $row): ?>
      <tr>
        <td><span class="badge blue">RT <?= htmlspecialchars($row['nomor_rt']) ?></span></td>
        <td>RW <?= htmlspecialchars($row['nomor_rw']) ?></td>
        <td><?= htmlspecialchars($row['nama_ketua']) ?></td>
        <td><?= htmlspecialchars($row['no_telepon']) ?></td>
        <td class="actions">
          <a href="rt.php?edit=<?= $row['id'] ?>" class="btn secondary small">Edit</a>
          <a href="rt.php?delete=<?= $row['id'] ?>" class="btn danger small" onclick="return confirm('Hapus data RT ini?')">Hapus</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
  <div class="scroll-hint">&larr; Geser tabel untuk melihat kolom lainnya &rarr;</div>
</div>

<script>
function openModal(){ document.getElementById('modalRT').classList.add('active'); }
function closeModal(){
  document.getElementById('modalRT').classList.remove('active');
  if (window.location.search.includes('edit=')) { window.location.href = 'rt.php'; }
}
<?php if ($editData || $error): ?>
  document.getElementById('modalRT').classList.add('active');
<?php endif; ?>
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
