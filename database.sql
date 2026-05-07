-- =============================================
-- Database Setup untuk Website Portofolio
-- Jalankan file ini di phpMyAdmin atau MySQL CLI
-- =============================================

CREATE DATABASE IF NOT EXISTS portofolio_db CHARACTER SET utf8 COLLATE utf8_general_ci;

USE portofolio_db;

-- Tabel Profil
CREATE TABLE IF NOT EXISTS profil (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    jabatan VARCHAR(100) NOT NULL,
    tentang TEXT NOT NULL,
    email VARCHAR(100) NOT NULL,
    telepon VARCHAR(20),
    lokasi VARCHAR(100),
    github VARCHAR(150),
    linkedin VARCHAR(150),
    foto VARCHAR(200)
);

-- Tabel Keahlian (Skills)
CREATE TABLE IF NOT EXISTS keahlian (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    persentase INT NOT NULL,
    kategori VARCHAR(50) DEFAULT 'teknis'
);

-- Tabel Proyek
CREATE TABLE IF NOT EXISTS proyek (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(150) NOT NULL,
    deskripsi TEXT NOT NULL,
    teknologi VARCHAR(200),
    link_demo VARCHAR(200),
    link_github VARCHAR(200),
    gambar VARCHAR(200),
    urutan INT DEFAULT 0
);

-- Tabel Pesan Kontak
CREATE TABLE IF NOT EXISTS pesan_kontak (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subjek VARCHAR(200) NOT NULL,
    pesan TEXT NOT NULL,
    tanggal DATETIME DEFAULT CURRENT_TIMESTAMP,
    sudah_dibaca TINYINT(1) DEFAULT 0
);

-- =============================================
-- Data Contoh
-- =============================================

INSERT INTO profil (nama, jabatan, tentang, email, telepon, lokasi, github, linkedin) VALUES
('Budi Santoso', 'Web Developer & Designer', 
 'Saya adalah seorang web developer berpengalaman yang bersemangat dalam menciptakan aplikasi web yang indah dan fungsional. Dengan pengalaman lebih dari 3 tahun, saya telah mengerjakan berbagai proyek mulai dari website company profile hingga sistem manajemen yang kompleks.',
 'budi@email.com', '+62 812-3456-7890', 'Jakarta, Indonesia',
 'https://github.com/budisantoso', 'https://linkedin.com/in/budisantoso');

INSERT INTO keahlian (nama, persentase, kategori) VALUES
('PHP', 85, 'backend'),
('MySQL', 80, 'database'),
('HTML & CSS', 90, 'frontend'),
('JavaScript', 75, 'frontend'),
('Laravel', 70, 'framework'),
('Bootstrap', 85, 'framework'),
('Git', 75, 'tools'),
('Linux', 65, 'tools');

INSERT INTO proyek (judul, deskripsi, teknologi, link_demo, link_github, urutan) VALUES
('Sistem Manajemen Toko', 'Aplikasi kasir dan manajemen stok untuk toko retail dengan fitur laporan penjualan, manajemen produk, dan multi-user.', 'PHP, MySQL, Bootstrap, JavaScript', '#', '#', 1),
('Website Company Profile', 'Website profesional untuk perusahaan kontraktor dengan halaman portofolio proyek, berita, dan formulir kontak.', 'PHP, MySQL, HTML, CSS', '#', '#', 2),
('Aplikasi To-Do List', 'Aplikasi manajemen tugas personal dengan fitur kategori, prioritas, deadline, dan notifikasi.', 'PHP, MySQL, JavaScript, Bootstrap', '#', '#', 3),
('Blog Personal', 'Platform blog dengan sistem CMS sederhana, komentar, dan manajemen konten berbasis kategori.', 'PHP, MySQL, HTML, CSS', '#', '#', 4);
