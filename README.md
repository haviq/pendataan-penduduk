# SIDUKUH Gondang — Sistem Informasi Kependudukan

> Portal data warga real-time berbasis web untuk pencatatan, analisis, dan pengelolaan data kependudukan tingkat desa/padukuhan.

![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=flat-square&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![Filament](https://img.shields.io/badge/Filament-v5-FDB900?style=flat-square&logo=filament&logoColor=black)
![SQLite](https://img.shields.io/badge/SQLite-003B57?style=flat-square&logo=sqlite&logoColor=white)
![License](https://img.shields.io/badge/license-MIT-22c55e?style=flat-square)

---

## Tampilan

| Halaman Publik | Admin Panel |
|---|---|
| Portal data kependudukan clean & responsif | Dashboard Filament v5 dengan Inter font |
| Chart.js donut gender, distribusi usia | CRUD warga, KK, RT/RW |
| Persebaran per RT, tabel warga terbaru | Dark / Light mode |

---

## Fitur Utama

**Portal Publik (`/`)**
- Statistik ringkasan — total penduduk, KK, RT/RW, pemilih potensial
- Rasio gender dengan donut chart interaktif (Chart.js)
- Distribusi usia (Balita, Anak, Remaja, Dewasa, Lansia) dengan progress bar animasi
- Breakdown demografi — agama, pendidikan, pekerjaan, status pernikahan
- Persebaran warga per RT dengan mini bar indicator
- Tabel 10 penduduk terbaru dengan search real-time & pagination
- Fully responsive — mobile & desktop

**Admin Panel (`/admin`)**
- Autentikasi aman dengan Filament v5
- CRUD lengkap: Penduduk, Kartu Keluarga, RT, RW, Pernikahan
- Role & permission management via Filament Shield
- Dark/Light mode toggle
- Widget statistik di dashboard

---

## Tech Stack

| Layer | Teknologi |
|---|---|
| Backend | Laravel 12 (PHP 8.2) |
| Admin Panel | Filament v5 + Filament Shield |
| Database | SQLite |
| Frontend | Blade + Vanilla JS + Chart.js 4 |
| Font | Inter (Google Fonts) |
| Animasi | GSAP 3 |
| Deploy | Render.com / VPS |

---

## Struktur Proyek

```
pendataan-penduduk/
├── app/
│   ├── Filament/
│   │   ├── Resources/          # CRUD Resources (Resident, Household, RT, RW, dst)
│   │   ├── Pages/              # Custom pages
│   │   └── Widgets/            # Dashboard widgets
│   ├── Http/Controllers/
│   │   └── HomeController.php  # Portal publik — stats, demografi, RT breakdown
│   └── Models/
│       ├── Resident.php        # Model penduduk (usia, relasi KK)
│       ├── Household.php       # Kartu Keluarga
│       ├── Rt.php / Rw.php     # Rukun Tetangga / Warga
│       └── Marriage.php        # Data pernikahan
├── resources/views/
│   └── home.blade.php          # Portal publik (Chart.js, GSAP, responsive grid)
├── app/Providers/Filament/
│   └── AdminPanelProvider.php  # Theme admin — Inter font, blue primary, dark mode
├── database/
│   ├── migrations/             # Skema tabel
│   └── seeders/                # Data awal
├── routes/web.php
└── render.yaml                 # Deploy config Render.com
```

---

## Instalasi Lokal

### Prasyarat
- PHP 8.2+
- Composer
- Node.js 18+ & npm

### Langkah

```bash
# 1. Clone repo
git clone https://github.com/haviq/pendataan-penduduk.git
cd pendataan-penduduk

# 2. Install dependencies
composer install
npm install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Jalankan migrasi & seeder
php artisan migrate --seed

# 5. Build assets
npm run build

# 6. Jalankan server
php artisan serve
```

Buka browser ke `http://localhost:8000` — portal publik langsung aktif.
Admin panel: `http://localhost:8000/admin`

---

## Instalasi di Termux (Android)

```bash
# Install PHP & Composer
pkg install php composer nodejs

# Clone dan setup
git clone https://github.com/haviq/pendataan-penduduk.git
cd pendataan-penduduk
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

---

## Deploy ke Render.com

Proyek ini sudah dilengkapi `render.yaml` untuk deploy otomatis.

1. Fork/push repo ke GitHub
2. Connect repo di [render.com](https://render.com)
3. Render otomatis detect `render.yaml` dan deploy

---

## Keamanan

- Query database menggunakan **Eloquent ORM** (aman dari SQL Injection by default)
- Autentikasi admin via **Filament Auth** (session + bcrypt)
- Role & permission via **Filament Shield**
- CSRF protection aktif (Laravel default)
- Output di-escape otomatis via Blade templating

---

## Lisensi

MIT License — bebas digunakan untuk keperluan edukasi, KKN, dan pemerintahan desa.

---

<p align="center">
  Built with ❤️ for village digital governance
</p>
