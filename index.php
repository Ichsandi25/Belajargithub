<?php
require_once 'config.php';

// ── Proses Form Kontak ──
$alert = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['kirim_pesan'])) {
    $nama    = mysqli_real_escape_string($conn, trim($_POST['nama']));
    $email   = mysqli_real_escape_string($conn, trim($_POST['email']));
    $subjek  = mysqli_real_escape_string($conn, trim($_POST['subjek']));
    $pesan   = mysqli_real_escape_string($conn, trim($_POST['pesan']));

    if ($nama && $email && $subjek && $pesan) {
        $sql = "INSERT INTO pesan_kontak (nama, email, subjek, pesan) 
                VALUES ('$nama', '$email', '$subjek', '$pesan')";
        if (mysqli_query($conn, $sql)) {
            $alert = '<div class="alert alert-success">✅ Pesan berhasil dikirim! Saya akan segera menghubungi Anda.</div>';
        } else {
            $alert = '<div class="alert alert-error">❌ Gagal mengirim pesan. Coba lagi.</div>';
        }
    } else {
        $alert = '<div class="alert alert-error">⚠️ Semua kolom harus diisi.</div>';
    }
}

// ── Ambil Data dari Database ──
$profil   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM profil LIMIT 1"));
$keahlian = mysqli_query($conn, "SELECT * FROM keahlian ORDER BY persentase DESC");
$proyek   = mysqli_query($conn, "SELECT * FROM proyek ORDER BY urutan ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($profil['nama'] ?? 'Portofolio') ?> — Developer</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- ══ NAVBAR ══ -->
<nav>
    <a href="#hero" class="nav-logo">&lt;<?= htmlspecialchars($profil['nama'] ?? 'Dev') ?>/&gt;</a>
    <ul class="nav-links">
        <li><a href="#tentang">Tentang</a></li>
        <li><a href="#keahlian">Keahlian</a></li>
        <li><a href="#proyek">Proyek</a></li>
        <li><a href="#kontak">Kontak</a></li>
    </ul>
</nav>

<!-- ══ HERO ══ -->
<section id="hero">
    <div>
        <div class="hero-tag">👋 Available for Work</div>
        <h1>
            Halo, Saya
            <span class="highlight"><?= htmlspecialchars($profil['nama'] ?? 'Nama Anda') ?></span>
        </h1>
        <p class="hero-sub"><?= htmlspecialchars($profil['jabatan'] ?? 'Web Developer') ?> yang bersemangat membangun pengalaman digital yang luar biasa.</p>
        <div class="hero-btns">
            <a href="#proyek" class="btn btn-primary">🚀 Lihat Proyek</a>
            <a href="#kontak" class="btn btn-outline">💬 Hubungi Saya</a>
        </div>
    </div>
</section>

<!-- ══ TENTANG ══ -->
<section id="tentang">
    <div class="container">
        <div class="about-grid">
            <div class="about-text">
                <div class="section-label">// Tentang Saya</div>
                <h2 class="section-title">Siapa Saya?</h2>
                <p><?= nl2br(htmlspecialchars($profil['tentang'] ?? '')) ?></p>

                <div class="about-stats">
                    <div class="stat-box">
                        <div class="number">3+</div>
                        <div class="label">Tahun Pengalaman</div>
                    </div>
                    <div class="stat-box">
                        <div class="number">20+</div>
                        <div class="label">Proyek Selesai</div>
                    </div>
                    <div class="stat-box">
                        <div class="number">15+</div>
                        <div class="label">Klien Puas</div>
                    </div>
                    <div class="stat-box">
                        <div class="number">5+</div>
                        <div class="label">Teknologi</div>
                    </div>
                </div>
            </div>

            <div class="info-list">
                <?php if (!empty($profil['email'])): ?>
                <div class="info-item">
                    <span class="info-icon">📧</span>
                    <div>
                        <div class="key">Email</div>
                        <div class="val"><?= htmlspecialchars($profil['email']) ?></div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if (!empty($profil['telepon'])): ?>
                <div class="info-item">
                    <span class="info-icon">📱</span>
                    <div>
                        <div class="key">Telepon</div>
                        <div class="val"><?= htmlspecialchars($profil['telepon']) ?></div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if (!empty($profil['lokasi'])): ?>
                <div class="info-item">
                    <span class="info-icon">📍</span>
                    <div>
                        <div class="key">Lokasi</div>
                        <div class="val"><?= htmlspecialchars($profil['lokasi']) ?></div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if (!empty($profil['github'])): ?>
                <div class="info-item">
                    <span class="info-icon">🐙</span>
                    <div>
                        <div class="key">GitHub</div>
                        <div class="val"><?= htmlspecialchars($profil['github']) ?></div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- ══ KEAHLIAN ══ -->
<section id="keahlian">
    <div class="container">
        <div class="section-label">// Kemampuan Teknis</div>
        <h2 class="section-title">Keahlian Saya</h2>

        <div class="skills-grid">
            <?php while ($skill = mysqli_fetch_assoc($keahlian)): ?>
            <div class="skill-card">
                <div class="skill-header">
                    <span class="skill-name"><?= htmlspecialchars($skill['nama']) ?></span>
                    <span class="skill-pct"><?= $skill['persentase'] ?>%</span>
                </div>
                <div class="skill-bar">
                    <div class="skill-fill" data-width="<?= $skill['persentase'] ?>"></div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<!-- ══ PROYEK ══ -->
<section id="proyek">
    <div class="container">
        <div class="section-label">// Karya Terbaru</div>
        <h2 class="section-title">Proyek Saya</h2>

        <div class="projects-grid">
            <?php 
            $emojis = ['💻','🌐','📱','🛒','📊','🎨','🔧','🚀'];
            $i = 0;
            while ($item = mysqli_fetch_assoc($proyek)):
                $emoji = $emojis[$i % count($emojis)]; $i++;
            ?>
            <div class="project-card">
                <div class="project-thumb"><?= $emoji ?></div>
                <div class="project-body">
                    <div class="project-title"><?= htmlspecialchars($item['judul']) ?></div>
                    <div class="project-desc"><?= htmlspecialchars($item['deskripsi']) ?></div>

                    <?php if (!empty($item['teknologi'])): ?>
                    <div class="project-tech">
                        <?php foreach (explode(',', $item['teknologi']) as $tech): ?>
                        <span class="tech-tag"><?= htmlspecialchars(trim($tech)) ?></span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <div class="project-links">
                        <?php if (!empty($item['link_demo']) && $item['link_demo'] !== '#'): ?>
                        <a href="<?= htmlspecialchars($item['link_demo']) ?>" target="_blank">🔗 Demo</a>
                        <?php endif; ?>
                        <?php if (!empty($item['link_github']) && $item['link_github'] !== '#'): ?>
                        <a href="<?= htmlspecialchars($item['link_github']) ?>" target="_blank">🐙 GitHub</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<!-- ══ KONTAK ══ -->
<section id="kontak">
    <div class="container">
        <div class="section-label">// Hubungi Saya</div>
        <h2 class="section-title">Mari Bekerja Sama</h2>

        <div class="contact-grid">
            <div class="contact-info">
                <div>
                    <h3>Punya Proyek? 🚀</h3>
                    <p>Saya terbuka untuk proyek freelance, kolaborasi, atau diskusi seputar teknologi. Jangan ragu menghubungi saya!</p>
                </div>

                <?php if (!empty($profil['email'])): ?>
                <a href="mailto:<?= htmlspecialchars($profil['email']) ?>" class="contact-link">
                    <span class="icon">📧</span>
                    <div>
                        <div style="font-size:0.75rem;color:var(--text-muted);margin-bottom:2px;">Email</div>
                        <div style="font-weight:600;"><?= htmlspecialchars($profil['email']) ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <?php if (!empty($profil['telepon'])): ?>
                <a href="tel:<?= htmlspecialchars($profil['telepon']) ?>" class="contact-link">
                    <span class="icon">📱</span>
                    <div>
                        <div style="font-size:0.75rem;color:var(--text-muted);margin-bottom:2px;">Telepon</div>
                        <div style="font-weight:600;"><?= htmlspecialchars($profil['telepon']) ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <?php if (!empty($profil['github'])): ?>
                <a href="<?= htmlspecialchars($profil['github']) ?>" target="_blank" class="contact-link">
                    <span class="icon">🐙</span>
                    <div>
                        <div style="font-size:0.75rem;color:var(--text-muted);margin-bottom:2px;">GitHub</div>
                        <div style="font-weight:600;">Lihat Repository Saya</div>
                    </div>
                </a>
                <?php endif; ?>
            </div>

            <!-- Form Kontak -->
            <div class="contact-form">
                <h3 style="margin-bottom:1.5rem;font-size:1.1rem;">Kirim Pesan 💬</h3>
                <?= $alert ?>
                <form method="POST" action="#kontak">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" placeholder="Masukkan nama Anda" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="email@contoh.com" required>
                    </div>
                    <div class="form-group">
                        <label>Subjek</label>
                        <input type="text" name="subjek" placeholder="Tentang apa pesan ini?" required>
                    </div>
                    <div class="form-group">
                        <label>Pesan</label>
                        <textarea name="pesan" placeholder="Tulis pesan Anda di sini..." required></textarea>
                    </div>
                    <button type="submit" name="kirim_pesan" class="btn btn-primary" style="width:100%;justify-content:center;">
                        🚀 Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- ══ FOOTER ══ -->
<footer>
    <p>Dibuat dengan ❤️ oleh <span><?= htmlspecialchars($profil['nama'] ?? 'Developer') ?></span> &nbsp;·&nbsp; PHP + MySQL + HTML</p>
    <p style="margin-top:6px;font-size:0.8rem;">&copy; <?= date('Y') ?> All rights reserved.</p>
</footer>

<script>
// Animasi skill bar saat terlihat
const fills = document.querySelectorAll('.skill-fill');
const observer = new IntersectionObserver(entries => {
    entries.forEach(e => {
        if (e.isIntersecting) {
            e.target.style.width = e.target.dataset.width + '%';
        }
    });
}, { threshold: 0.3 });
fills.forEach(f => observer.observe(f));
</script>
</body>
</html>
