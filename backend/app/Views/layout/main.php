<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Lab 7 Web') ?></title>
    <link rel="stylesheet" href="<?= base_url('/style.css') ?>">
</head>
<body>
    <div id="container">
        <header><h1>Lab 7 Web</h1></header>
        <nav>
            <a href="<?= base_url('/') ?>">Home</a>
            <a href="<?= base_url('/artikel') ?>">Artikel</a>
            <a href="<?= base_url('/about') ?>">About</a>
            <a href="<?= base_url('/contact') ?>">Kontak</a>
            <a href="<?= base_url('/admin/artikel') ?>">Admin</a>
        </nav>
        <section id="wrapper">
            <main id="main"><?= $this->renderSection('content') ?></main>
            <aside id="sidebar">
                <?= view_cell('App\Cells\ArtikelTerkini::render') ?>
                <div class="widget-box">
                    <h3 class="title">Kategori</h3>
                    <a href="<?= base_url('/kategori/pemrograman') ?>">Pemrograman</a>
                    <a href="<?= base_url('/kategori/web') ?>">Web</a>
                    <a href="<?= base_url('/kategori/database') ?>">Database</a>
                </div>
            </aside>
        </section>
        <footer><p>&copy; 2026 - Universitas Pelita Bangsa</p></footer>
    </div>
</body>
</html>
