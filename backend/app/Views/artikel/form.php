<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<h2><?= esc($title) ?></h2>
<form method="post" enctype="multipart/form-data" class="form-panel">
    <label>Judul</label><input type="text" name="judul" value="<?= esc($artikel['judul'] ?? '') ?>" required>
    <label>Kategori</label><select name="id_kategori" required><?php foreach ($kategori as $item): ?><option value="<?= $item['id_kategori'] ?>" <?= (($artikel['id_kategori'] ?? '') == $item['id_kategori']) ? 'selected' : '' ?>><?= esc($item['nama_kategori']) ?></option><?php endforeach; ?></select>
    <label>Isi</label><textarea name="isi" rows="8" required><?= esc($artikel['isi'] ?? '') ?></textarea>
    <label>Status</label><select name="status"><option value="1" <?= (($artikel['status'] ?? 1) == 1) ? 'selected' : '' ?>>Publik</option><option value="0" <?= (($artikel['status'] ?? 1) == 0) ? 'selected' : '' ?>>Draft</option></select>
    <label>Gambar</label><input type="file" name="gambar" accept="image/*">
    <button type="submit">Simpan</button>
</form>
<?= $this->endSection() ?>
