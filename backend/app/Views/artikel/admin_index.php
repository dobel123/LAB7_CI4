<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<div class="toolbar"><h2><?= esc($title) ?></h2><a class="btn" href="<?= base_url('/admin/artikel/add') ?>">Tambah</a></div>
<form class="search" method="get">
    <input type="search" name="q" value="<?= esc($q ?? '') ?>" placeholder="Cari artikel">
    <select name="sort"><option value="created_at" <?= ($sort ?? '') === 'created_at' ? 'selected' : '' ?>>Tanggal</option><option value="judul" <?= ($sort ?? '') === 'judul' ? 'selected' : '' ?>>Judul</option></select>
    <button type="submit">Cari</button>
</form>
<table><thead><tr><th>Judul</th><th>Kategori</th><th>Status</th><th>Aksi</th></tr></thead><tbody>
<?php foreach ($artikel as $row): ?>
<tr><td><?= esc($row['judul']) ?></td><td><?= esc($row['nama_kategori'] ?? '-') ?></td><td><?= $row['status'] ? 'Publik' : 'Draft' ?></td><td><a href="<?= base_url('/admin/artikel/edit/' . $row['id']) ?>">Ubah</a> <a href="<?= base_url('/admin/artikel/delete/' . $row['id']) ?>" onclick="return confirm('Hapus artikel?')">Hapus</a></td></tr>
<?php endforeach; ?>
</tbody></table>
<?= $pager->links('artikel') ?>
<?= $this->endSection() ?>
