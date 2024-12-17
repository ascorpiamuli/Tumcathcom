<!-- app/Views/dashboard.php -->
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
    <?php if ($fullName): ?>
        <h2>Karibu, <?= esc($fullName) ?></h2>
    <?php else: ?>
        <p>Null</p>
    <?php endif; ?>
    <p>This is where you can manage your membership details.</p>
<?= $this->endSection() ?>
