<!DOCTYPE html>
<html lang="<?= session('locale', 'en') ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargo - <?= esc($cargo->number) ?></title>
    <link rel="stylesheet" href="<?= base_url('css/app.css') ?>">
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1>Cargo #<?= esc($cargo->number) ?></h1>
            <a href="/cargo" class="btn btn-secondary">Back to List</a>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="info-row">
                    <span class="info-label">Status:</span>
                    <span class="badge badge-<?= $cargo->status ?>"><?= $cargo->status ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Sender:</span>
                    <span><?= esc($cargo->sender_name) ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Recipient:</span>
                    <span><?= esc($cargo->recipient_name) ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Weight:</span>
                    <span><?= esc($cargo->formatted_weight) ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Cost:</span>
                    <span><?= esc($cargo->formatted_cost) ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Pickup Date:</span>
                    <span><?= esc($cargo->pickup_date) ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Delivery Date:</span>
                    <span><?= esc($cargo->delivery_date) ?></span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>