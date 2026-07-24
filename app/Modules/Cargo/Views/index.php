<!DOCTYPE html>
<html lang="<?= session('locale', 'en') ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargo</title>
    <link rel="stylesheet" href="<?= base_url('css/app.css') ?>">
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1>Cargo</h1>
            <button 
                type="button" 
                class="btn btn-primary"
                hx-get="/cargo/create"
                hx-target="#modal-container"
                hx-swap="innerHTML"
            >
                Add Cargo
            </button>
        </div>

        <div id="cargo-list" class="cargo-list">
            <?= view('Cargo::parts/list', ['cargos' => $cargos ?? []]) ?>
        </div>

        <div id="modal-container"></div>
    </div>

    <script src="<?= base_url('js/app.js') ?>"></script>
</body>
</html>