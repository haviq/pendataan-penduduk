<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth.php';
requireLogin();

$pageTitle  = 'Edit Profile';
$activeMenu = 'profile';
$message = '';
$error = '';

$stmt = $pdo->prepare("SELECT * FROM users WHERE id=?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_lengkap = trim($_POST['nama_lengkap'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password_baru = $_POST['password_baru'] ?? '';

    if ($nama_lengkap === '') {
        $error = 'Nama lengkap wajib diisi.';
    } else {
        if ($password_baru !== '') {
            $hash = password_hash($password_baru, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE users SET nama_lengkap=?, email=?, password=? WHERE id=?");
            $stmt->execute([$nama_lengkap, $email, $hash, $user['id']]);
        } else {
            $stmt = $pdo->prepare("UPDATE users SET nama_lengkap=?, email=? WHERE id=?");
            $stmt->execute([$nama_lengkap, $email, $user['id']]);
        }
        $_SESSION['user_name'] = $nama_lengkap;
        $message = 'Profil berhasil diperbarui.';

        $stmt = $pdo->prepare("SELECT * FROM users WHERE id=?");
        $stmt->execute([$user['id']]);
        $user = $stmt->fetch();
    }
}

require_once __DIR__ . '/../includes/header.php';
?>

<?php if ($message): ?><div class="alert success"><?= htmlspecialchars($message) ?></div><?php endif; ?>
<?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?>

<div class="card">
  <div class="card-title">Edit Profile</div>
  <form method="POST" class="form-wrap">
    <div class="form-group">
      <label>Username</label>
      <input type="text" value="<?= htmlspecialchars($user['username']) ?>" disabled>
    </div>
    <div class="form-group">
      <label>Nama Lengkap</label>
      <input type="text" name="nama_lengkap" value="<?= htmlspecialchars($user['nama_lengkap']) ?>" required>
    </div>
    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>">
    </div>
    <div class="form-group">
      <label>Password Baru (opsional)</label>
      <input type="password" name="password_baru" placeholder="Kosongkan jika tidak ingin mengubah password">
    </div>
    <div class="form-actions">
      <button type="submit" class="btn">Simpan Perubahan</button>
    </div>
  </form>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
