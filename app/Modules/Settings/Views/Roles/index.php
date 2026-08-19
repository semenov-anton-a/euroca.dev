<?= $this->extend('layouts/main') ?>

<?= $this->section('headerContentModule') ?>
    <?= 
    view('partials/headerContent', [
        'title'=> $title,
        'breadcrumb' => [
            ['label' => 'Settings', 'url' => route_to('settings')],
            ['label' => 'Roles & Permissions', 'url' => route_to('settings.roles')],
        ]
    ]) ?>  
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="card-body">
        <h1>
            
        </h1>
        <p>
            
        </p>
    </div>
</div>
<?= $this->endSection() ?>