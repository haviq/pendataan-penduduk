<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Memastikan user sudah login. Jika belum, redirect ke login.php.
 */
function requireLogin() {
    if (empty($_SESSION['user_id'])) {
        header('Location: ' . basePath() . 'login.php');
        exit;
    }
}

/**
 * Menghitung base path relatif supaya link tetap benar
 * baik diakses dari root maupun dari folder /pages/.
 */
function basePath() {
    return strpos($_SERVER['SCRIPT_NAME'], '/pages/') !== false ? '../' : '';
}
