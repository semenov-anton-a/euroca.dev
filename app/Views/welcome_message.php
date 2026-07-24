<!DOCTYPE html>
<html lang="<?= session('locale', 'en') ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EuroCargo ERP - Dashboard</title>
    <link rel="stylesheet" href="<?= base_url('css/app.css') ?>">
</head>
<body>
    <?= $this->renderSection('navbar') ?>
    
    <div class="main-container">
        <?= $this->renderSection('sidebar') ?>
        
        <main class="content">
            <div class="page-header">
                <h1>Dashboard</h1>
            </div>
            
            <div class="dashboard-grid">
                <div class="card">
                    <div class="card-header">
                        <h3>Total Cargo</h3>
                        <span class="card-icon">🚚</span>
                    </div>
                    <div class="card-content">
                        <span class="card-value">0</span>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h3>Active Shipments</h3>
                        <span class="card-icon">📦</span>
                    </div>
                    <div class="card-content">
                        <span class="card-value">0</span>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h3>Revenue</h3>
                        <span class="card-icon">💰</span>
                    </div>
                    <div class="card-content">
                        <span class="card-value">₽ 0</span>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <?= $this->renderSection('footer') ?>
    
    <script src="<?= base_url('js/app.js') ?>"></script>
</body>
</html>