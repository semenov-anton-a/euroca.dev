<!DOCTYPE html>
<html lang="<?= session('locale', 'en') ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Cargo</title>
    <link rel="stylesheet" href="<?= base_url('css/app.css') ?>">
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1>Edit Cargo</h1>
            <a href="/cargo" class="btn btn-secondary">Back to List</a>
        </div>

        <div class="auth-card">
            <form action="/cargo/<?= $cargo->id ?>" method="POST" id="edit-cargo-form">
                <?= csrf_field() ?>
                
                <div class="form-group">
                    <label for="number">Cargo Number</label>
                    <input type="text" id="number" name="number" class="form-control" value="<?= esc($cargo->number) ?>" required>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="sender_name">Sender</label>
                        <input type="text" id="sender_name" name="sender_name" class="form-control" value="<?= esc($cargo->sender_name) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient_name">Recipient</label>
                        <input type="text" id="recipient_name" name="recipient_name" class="form-control" value="<?= esc($cargo->recipient_name) ?>" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="weight">Weight (kg)</label>
                        <input type="number" id="weight" name="weight" class="form-control" step="0.01" value="<?= esc($cargo->weight) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="cost">Cost (₽)</label>
                        <input type="number" id="cost" name="cost" class="form-control" step="0.01" value="<?= esc($cargo->cost) ?>" required>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
            </form>
        </div>
    </div>
</body>
</html>