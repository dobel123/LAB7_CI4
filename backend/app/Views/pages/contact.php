<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<h2><?= esc($title) ?></h2>
<p><?= esc($content) ?></p>
<?= $this->endSection() ?>
