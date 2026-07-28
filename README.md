# Pendataan Penduduk (PHP + MySQL)

Website admin dashboard untuk mengelola data RW, RT, Kartu Keluarga, dan Penduduk.

## Struktur Folder

```
pendataan-penduduk/
├── assets/css/style.css      # Semua styling
├── config/database.php       # Koneksi database (PDO)
├── includes/
│   ├── auth.php               # Session & requireLogin()
│   ├── header.php             # Sidebar + header (dipakai semua halaman)
│   └── footer.php
├── pages/
│   ├── rw.php                 # CRUD Data RW
│   ├── rt.php                 # CRUD Data RT
│   ├── kk.php                 # CRUD Data Kartu Keluarga
│   ├── penduduk.php           # CRUD Data Penduduk (+pencarian)
│   └── profile.php            # Edit profil admin
├── index.php                  # Dashboard (statistik + grafik)
├── login.php
├── logout.php
└── database.sql               # Skema database + data contoh
```

## Cara Menjalankan (XAMPP / Laragon / LAMP)

1. **Install PHP & MySQL**, misalnya lewat XAMPP (Windows/Mac) atau Laragon (Windows).
2. Salin folder `pendataan-penduduk` ke folder web server:
   - XAMPP: `C:\xampp\htdocs\pendataan-penduduk`
   - Laragon: `C:\laragon\www\pendataan-penduduk`
   - Linux/Mac (Apache): `/var/www/html/pendataan-penduduk`
3. **Buat database**:
   - Buka phpMyAdmin (`http://localhost/phpmyadmin`)
   - Klik "Import", pilih file `database.sql`, lalu jalankan.
   - Atau lewat terminal:
     ```
     mysql -u root -p < database.sql
     ```
4. **Sesuaikan koneksi database** (jika perlu) di `config/database.php`:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'pendataan_penduduk');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   ```
5. **Jalankan** dengan membuka browser ke:
   ```
   http://localhost/pendataan-penduduk/login.php
   ```
6. **Login** dengan akun demo:
   - Username: `admin`
   - Password: `admin123`

## Fitur

- **Login/Logout** dengan session PHP dan password ter-enkripsi (bcrypt).
- **Dashboard**: kartu statistik (Data RW, Data RT, Data KK, Total Warga) dan 3 grafik
  (pertambahan warga per bulan, distribusi usia, distribusi gender) — semua data diambil
  langsung dari database secara real-time.
- **CRUD Data RW / RT / KK / Penduduk**: tambah, ubah, hapus, lihat daftar.
- **Relasi data**: RT terhubung ke RW, KK terhubung ke RT, Penduduk terhubung ke KK.
- **Pencarian** pada halaman Data Penduduk (berdasarkan nama/NIK).
- **Edit Profile** admin (ubah nama, email, password).

## Catatan Keamanan

- Semua query database menggunakan **prepared statements** (PDO) untuk mencegah SQL Injection.
- Semua output ke HTML menggunakan `htmlspecialchars()` untuk mencegah XSS.
- Password disimpan dengan `password_hash()` (bcrypt), bukan plain text.
- Untuk produksi: ganti password default, aktifkan HTTPS, dan batasi akses folder `config/`.
