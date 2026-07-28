-- =========================================================
-- Database: pendataan_penduduk
-- Import file ini lewat phpMyAdmin / mysql CLI sebelum
-- menjalankan aplikasi.
-- =========================================================

CREATE DATABASE IF NOT EXISTS pendataan_penduduk
  CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE pendataan_penduduk;

-- ---------------------------------------------------------
-- Tabel users (untuk login admin)
-- ---------------------------------------------------------
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  nama_lengkap VARCHAR(100) NOT NULL,
  email VARCHAR(100),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Password default: admin123 (sudah di-hash dengan password_hash PHP/bcrypt)
INSERT INTO users (username, password, nama_lengkap, email) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'admin@pendataan.local');

-- ---------------------------------------------------------
-- Tabel data_rw
-- ---------------------------------------------------------
CREATE TABLE data_rw (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nomor_rw VARCHAR(10) NOT NULL,
  nama_ketua VARCHAR(100) NOT NULL,
  no_telepon VARCHAR(20),
  alamat_sekretariat VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO data_rw (nomor_rw, nama_ketua, no_telepon, alamat_sekretariat) VALUES
('001', 'Bapak Sutrisno', '081234567890', 'Jl. Melati No. 1'),
('002', 'Bapak Ahmad Fauzi', '081234567891', 'Jl. Mawar No. 5'),
('003', 'Ibu Siti Rahma', '081234567892', 'Jl. Anggrek No. 12');

-- ---------------------------------------------------------
-- Tabel data_rt
-- ---------------------------------------------------------
CREATE TABLE data_rt (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nomor_rt VARCHAR(10) NOT NULL,
  rw_id INT NOT NULL,
  nama_ketua VARCHAR(100) NOT NULL,
  no_telepon VARCHAR(20),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (rw_id) REFERENCES data_rw(id) ON DELETE CASCADE
);

INSERT INTO data_rt (nomor_rt, rw_id, nama_ketua, no_telepon) VALUES
('001', 1, 'Bapak Joko Widodo', '081211110001'),
('002', 1, 'Bapak Slamet Riyadi', '081211110002'),
('001', 2, 'Ibu Endang Sari', '081211110003');

-- ---------------------------------------------------------
-- Tabel data_kk (Kartu Keluarga)
-- ---------------------------------------------------------
CREATE TABLE data_kk (
  id INT AUTO_INCREMENT PRIMARY KEY,
  no_kk VARCHAR(20) NOT NULL UNIQUE,
  kepala_keluarga VARCHAR(100) NOT NULL,
  rt_id INT NOT NULL,
  alamat VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (rt_id) REFERENCES data_rt(id) ON DELETE CASCADE
);

INSERT INTO data_kk (no_kk, kepala_keluarga, rt_id, alamat) VALUES
('3201010101010001', 'Budi Santoso', 1, 'Jl. Melati No. 10'),
('3201010101010002', 'Agus Salim', 2, 'Jl. Melati No. 15');

-- ---------------------------------------------------------
-- Tabel data_penduduk
-- ---------------------------------------------------------
CREATE TABLE data_penduduk (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nik VARCHAR(20) NOT NULL UNIQUE,
  nama_lengkap VARCHAR(100) NOT NULL,
  kk_id INT NOT NULL,
  jenis_kelamin ENUM('Laki-laki','Perempuan') NOT NULL,
  tempat_lahir VARCHAR(100),
  tanggal_lahir DATE NOT NULL,
  pekerjaan VARCHAR(100),
  status_perkawinan ENUM('Belum Kawin','Kawin','Cerai Hidup','Cerai Mati') DEFAULT 'Belum Kawin',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (kk_id) REFERENCES data_kk(id) ON DELETE CASCADE
);

INSERT INTO data_penduduk (nik, nama_lengkap, kk_id, jenis_kelamin, tempat_lahir, tanggal_lahir, pekerjaan, status_perkawinan, created_at) VALUES
('3201010101010001', 'Budi Santoso', 1, 'Laki-laki', 'Yogyakarta', '1985-04-12', 'Wiraswasta', 'Kawin', '2025-11-05 10:00:00'),
('3201010101010002', 'Siti Aminah', 1, 'Perempuan', 'Yogyakarta', '1988-07-20', 'Ibu Rumah Tangga', 'Kawin', '2025-11-06 10:00:00'),
('3201010101010003', 'Andi Pratama', 1, 'Laki-laki', 'Yogyakarta', '2012-01-15', 'Pelajar', 'Belum Kawin', '2025-11-10 10:00:00'),
('3201010101010004', 'Agus Salim', 2, 'Laki-laki', 'Sleman', '1979-09-01', 'PNS', 'Kawin', '2025-11-18 10:00:00'),
('3201010101010005', 'Rina Wijaya', 2, 'Perempuan', 'Sleman', '1982-03-25', 'Guru', 'Kawin', '2025-11-20 10:00:00');
