# 🌐 Website Portofolio PHP + MySQL

Website portofolio sederhana namun elegan menggunakan PHP, HTML, CSS, dan MySQL.

---

## 📁 Struktur File

```
portfolio/
├── index.php       ← Halaman utama (semua konten)
├── config.php      ← Konfigurasi database
├── style.css       ← Tampilan & desain
├── database.sql    ← Script pembuatan database & data contoh
└── README.md       ← Panduan ini
```

---

## ⚙️ Cara Instalasi

### 1. Persyaratan
- PHP 7.4 atau lebih baru
- MySQL / MariaDB
- Web server (Apache/Nginx) — atau gunakan XAMPP/Laragon/WAMP

### 2. Setup Database

**Via phpMyAdmin:**
1. Buka phpMyAdmin (biasanya http://localhost/phpmyadmin)
2. Klik **Import**
3. Pilih file `database.sql`
4. Klik **Go**

**Via MySQL CLI:**
```bash
mysql -u root -p < database.sql
```

### 3. Konfigurasi Koneksi

Buka `config.php` dan sesuaikan:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');       // Username MySQL Anda
define('DB_PASS', '');           // Password MySQL Anda
define('DB_NAME', 'portofolio_db');
```

### 4. Jalankan Website

**Menggunakan XAMPP:**
1. Salin folder `portfolio` ke `C:/xampp/htdocs/`
2. Buka browser: http://localhost/portfolio

**Menggunakan PHP Built-in Server:**
```bash
cd portfolio
php -S localhost:8000
```
Lalu buka: http://localhost:8000

---

## ✏️ Cara Kustomisasi

### Ubah Data Profil
Jalankan SQL berikut di phpMyAdmin:
```sql
UPDATE profil SET
  nama = 'Nama Anda',
  jabatan = 'Jabatan Anda',
  tentang = 'Cerita tentang Anda...',
  email = 'email@anda.com',
  telepon = '+62 ...',
  lokasi = 'Kota, Indonesia'
WHERE id = 1;
```

### Tambah Proyek Baru
```sql
INSERT INTO proyek (judul, deskripsi, teknologi, link_demo, link_github, urutan)
VALUES ('Nama Proyek', 'Deskripsi proyek...', 'PHP, MySQL', 'https://...', 'https://...', 5);
```

### Tambah Keahlian
```sql
INSERT INTO keahlian (nama, persentase, kategori)
VALUES ('Vue.js', 70, 'frontend');
```

---

## 📊 Struktur Database

| Tabel          | Fungsi                              |
|----------------|-------------------------------------|
| `profil`       | Data pribadi & kontak               |
| `keahlian`     | Daftar skill & persentase           |
| `proyek`       | Portofolio proyek                   |
| `pesan_kontak` | Pesan yang masuk dari form kontak   |

---

## 🎨 Fitur

- ✅ Dark mode elegan dengan aksen hijau
- ✅ Responsive (mobile-friendly)
- ✅ Animasi skill bar
- ✅ Form kontak menyimpan ke database
- ✅ Data dinamis dari MySQL
- ✅ Navigasi sticky dengan blur effect
- ✅ Smooth scroll antar section

---

Dibuat dengan PHP + MySQL + HTML/CSS murni 🚀
