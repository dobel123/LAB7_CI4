<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<article class="entry">
    <h2><?= esc($artikel['judul']) ?></h2>
    <p class="meta">Kategori: <?= esc($artikel['nama_kategori'] ?? 'Tanpa kategori') ?></p>
    <?php if (!empty($artikel['gambar'])): ?>
        <img class="article-image" src="<?= base_url('/gambar/' . $artikel['gambar']) ?>" alt="<?= esc($artikel['judul']) ?>">
    <?php endif; ?>
    <p><?= nl2br(esc($artikel['isi'])) ?></p>
</article>
<?= $this->endSection() ?>
