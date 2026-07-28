<?php
/**
 * Dipakai di setiap halaman setelah requireLogin().
 * Variabel yang bisa di-set sebelum include:
 *   $pageTitle  -> judul halaman (default "Dashboard")
 *   $activeMenu -> salah satu dari: dashboard, rw, rt, kk, penduduk, profile
 */
$pageTitle  = $pageTitle  ?? 'Dashboard';
$activeMenu = $activeMenu ?? 'dashboard';
$base = basePath();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($pageTitle) ?> - Pendataan Penduduk</title>
<link rel="stylesheet" href="<?= $base ?>assets/css/style.css">
<script src="<?= $base ?>assets/js/chart.umd.js"></script>
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<aside class="sidebar" id="sidebar">
  <div class="brand">
    <h1>Pendataan<br>Penduduk</h1>
  </div>

  <div class="nav-label">Dashboard</div>
  <a href="<?= $base ?>index.php" class="nav-item <?= $activeMenu === 'dashboard' ? 'active' : '' ?>">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
    Dashboard
  </a>

  <div class="nav-label">Menu</div>
  <a href="<?= $base ?>pages/rw.php" class="nav-item <?= $activeMenu === 'rw' ? 'active' : '' ?>">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
    Data RW
  </a>
  <a href="<?= $base ?>pages/rt.php" class="nav-item <?= $activeMenu === 'rt' ? 'active' : '' ?>">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
    Data RT
  </a>
  <a href="<?= $base ?>pages/kk.php" class="nav-item <?= $activeMenu === 'kk' ? 'active' : '' ?>">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
    Data Kartu Keluarga
  </a>
  <a href="<?= $base ?>pages/penduduk.php" class="nav-item <?= $activeMenu === 'penduduk' ? 'active' : '' ?>">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
    Data Penduduk
  </a>
</aside>

<main class="main">
  <div class="page-header">
    <div class="page-title-wrap">
      <button type="button" class="hamburger-btn" onclick="openSidebar()" aria-label="Buka menu">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
      </button>
      <div class="page-title"><?= htmlspecialchars($pageTitle) ?></div>
    </div>
    <div class="user-menu-wrap">
      <button type="button" class="user-chip" onclick="toggleUserMenu(event)">
        <div class="avatar"><?= strtoupper(substr($_SESSION['user_name'] ?? 'A', 0, 1)) ?></div>
        <?= htmlspecialchars($_SESSION['user_name'] ?? 'Admin') ?>
      </button>
      <div class="user-dropdown" id="userDropdown">
        <a href="<?= $base ?>pages/profile.php">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/></svg>
          Edit Profile
        </a>
        <hr>
        <a href="<?= $base ?>logout.php" class="danger">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
          Logout
        </a>
      </div>
    </div>
  </div>

  <script>
    function toggleUserMenu(e){
      e.stopPropagation();
      document.getElementById('userDropdown').classList.toggle('open');
    }
    document.addEventListener('click', function(e){
      const dropdown = document.getElementById('userDropdown');
      if (dropdown && !dropdown.contains(e.target)) {
        dropdown.classList.remove('open');
      }
    });
  </script>

  <script>
    function openSidebar(){
      document.getElementById('sidebar').classList.add('open');
      document.getElementById('sidebarOverlay').classList.add('active');
    }
    function closeSidebar(){
      document.getElementById('sidebar').classList.remove('open');
      document.getElementById('sidebarOverlay').classList.remove('active');
    }
  </script>
