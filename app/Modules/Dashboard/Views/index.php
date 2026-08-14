<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row">
    <h1>
        <?= esc($title) ?>
    </h1>
    <p>
        Welcome to Dashboard 2
    </p>
</div>
<?= $this->endSection() ?>