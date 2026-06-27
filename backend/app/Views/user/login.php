<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<h2>Login Admin</h2>
<?php if (!empty($error)): ?><p class="alert"><?= esc($error) ?></p><?php endif; ?>
<form method="post" class="form-panel"><label>Email</label><input type="email" name="email" required><label>Password</label><input type="password" name="password" required><button type="submit">Login</button></form>
<?= $this->endSection() ?>
