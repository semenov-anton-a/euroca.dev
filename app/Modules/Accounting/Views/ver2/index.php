<?= $this->extend('layouts/main') ?>

<?= $this->section('headerContentModule') ?>
    <?php 
    // view('partials/headerContent', [
    //     'title'=> $title,
    //     'breadcrumb' => []
    // ]) 
    ?>  
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="card-body">
        <h1>
            Hello Accounting version 2
        </h1>
        <p>
            
        </p>
    </div>
</div>
<?= $this->endSection() ?>