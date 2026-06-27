<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<h2><?= esc($title) ?></h2>
<?php foreach ($artikel as $row): ?>
    <article class="entry">
        <h3><a href="<?= base_url('/artikel/' . $row['slug']) ?>"><?= esc($row['judul']) ?></a></h3>
        <p class="meta"><?= esc($row['nama_kategori'] ?? 'Tanpa kategori') ?> - <?= esc($row['created_at'] ?? '') ?></p>
        <p><?= esc(substr(strip_tags($row['isi']), 0, 160)) ?>...</p>
    </article>
<?php endforeach; ?>
<?= $this->endSection() ?>
