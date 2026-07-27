<!DOCTYPE html>
<html lang="<?= session('locale', 'en') ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EuroCargo ERP <?= isset($title) ? '– ' . $title : '' ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/app.css') ?>">
</head>
<body>
    <?= $this->renderSection('navbar') ?>
    
    <div class="main-container">
        <?= $this->renderSection('sidebar') ?>
        
        <main class="content">
            <?= $this->renderSection('content') ?>
        </main>
    </div>
    
    <?= $this->renderSection('footer') ?>
    
    <script src="<?= base_url('js/app.js') ?>"></script>
</body>
</html>