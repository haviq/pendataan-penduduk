<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth.php';
requireLogin();

$pageTitle  = 'Data RW';
$activeMenu = 'rw';
$message = '';
$error = '';

// ---- Simpan (tambah / update) ----
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $nomor_rw = trim($_POST['nomor_rw'] ?? '');
    $nama_ketua = trim($_POST['nama_ketua'] ?? '');
    $no_telepon = trim($_POST['no_telepon'] ?? '');
    $alamat_sekretariat = trim($_POST['alamat_sekretariat'] ?? '');

    if ($nomor_rw === '' || $nama_ketua === '') {
        $error = 'Nomor RW dan Nama Ketua wajib diisi.';
    } else {
        if ($id) {
            $stmt = $pdo->prepare("UPDATE data_rw SET nomor_rw=?, nama_ketua=?, no_telepon=?, alamat_sekretariat=? WHERE id=?");
            $stmt->execute([$nomor_rw, $nama_ketua, $no_telepon, $alamat_sekretariat, $id]);
            $message = 'Data RW berhasil diperbarui.';
        } else {
            $stmt = $pdo->prepare("INSERT INTO data_rw (nomor_rw, nama_ketua, no_telepon, alamat_sekretariat) VALUES (?,?,?,?)");
            $stmt->execute([$nomor_rw, $nama_ketua, $no_telepon, $alamat_sekretariat]);
            $message = 'Data RW berhasil ditambahkan.';
        }
    }
}

// ---- Hapus ----
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM data_rw WHERE id=?");
    $stmt->execute([$_GET['delete']]);
    header('Location: rw.php?msg=deleted');
    exit;
}
if (isset($_GET['msg']) && $_GET['msg'] === 'deleted') {
    $message = 'Data RW berhasil dihapus.';
}

// ---- Data untuk form edit ----
$editData = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM data_rw WHERE id=?");
    $stmt->execute([$_GET['edit']]);
    $editData = $stmt->fetch();
}

// ---- Daftar data ----
$list = $pdo->query("SELECT * FROM data_rw ORDER BY nomor_rw ASC")->fetchAll();

require_once __DIR__ . '/../includes/header.php';
?>

<?php if ($message): ?><div class="alert success"><?= htmlspecialchars($message) ?></div><?php endif; ?>
<?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?>

<div class="toolbar">
  <div></div>
  <button type="button" class="btn" onclick="openModal()">+ Tambah Data RW</button>
</div>

<div class="modal-overlay" id="modalRW">
  <div class="modal-box">
    <div class="modal-header">
      <div class="card-title" id="modalTitleRW"><?= $editData ? 'Edit Data RW' : 'Tambah Data RW' ?></div>
      <button type="button" class="modal-close" onclick="closeModal()">&times;</button>
    </div>
    <form method="POST" class="form-wrap">
      <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">
      <div class="form-group">
        <label>Nomor RW</label>
        <input type="text" name="nomor_rw" value="<?= htmlspecialchars($editData['nomor_rw'] ?? '') ?>" placeholder="001" required>
      </div>
      <div class="form-group">
        <label>Nama Ketua</label>
        <input type="text" name="nama_ketua" value="<?= htmlspecialchars($editData['nama_ketua'] ?? '') ?>" placeholder="Nama lengkap ketua RW" required>
      </div>
      <div class="form-group">
        <label>No. Telepon</label>
        <input type="text" name="no_telepon" value="<?= htmlspecialchars($editData['no_telepon'] ?? '') ?>" placeholder="08xxxxxxxxxx">
      </div>
      <div class="form-group">
        <label>Alamat Sekretariat</label>
        <input type="text" name="alamat_sekretariat" value="<?= htmlspecialchars($editData['alamat_sekretariat'] ?? '') ?>" placeholder="Jl. ...">
      </div>
      <div class="form-actions">
        <button type="submit" class="btn"><?= $editData ? 'Simpan Perubahan' : 'Tambah RW' ?></button>
        <button type="button" class="btn secondary" onclick="closeModal()">Batal</button>
      </div>
    </form>
  </div>
</div>

<div class="card">
  <div class="card-title">Daftar RW</div>
  <div class="table-wrap">
  <table>
    <thead>
      <tr><th>Nomor RW</th><th>Nama Ketua</th><th>No. Telepon</th><th>Alamat Sekretariat</th><th>Aksi</th></tr>
    </thead>
    <tbody>
      <?php if (empty($list)): ?>
        <tr><td colspan="5" style="text-align:center; color:var(--text-muted);">Belum ada data RW.</td></tr>
      <?php endif; ?>
      <?php foreach ($list as $row): ?>
      <tr>
        <td><span class="badge blue">RW <?= htmlspecialchars($row['nomor_rw']) ?></span></td>
        <td><?= htmlspecialchars($row['nama_ketua']) ?></td>
        <td><?= htmlspecialchars($row['no_telepon']) ?></td>
        <td><?= htmlspecialchars($row['alamat_sekretariat']) ?></td>
        <td class="actions">
          <a href="rw.php?edit=<?= $row['id'] ?>" class="btn secondary small">Edit</a>
          <a href="rw.php?delete=<?= $row['id'] ?>" class="btn danger small" onclick="return confirm('Hapus data RW ini?')">Hapus</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
  <div class="scroll-hint">&larr; Geser tabel untuk melihat kolom lainnya &rarr;</div>
</div>

<script>
function openModal(){ document.getElementById('modalRW').classList.add('active'); }
function closeModal(){
  document.getElementById('modalRW').classList.remove('active');
  if (window.location.search.includes('edit=')) { window.location.href = 'rw.php'; }
}
<?php if ($editData || $error): ?>
  document.getElementById('modalRW').classList.add('active');
<?php endif; ?>
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
