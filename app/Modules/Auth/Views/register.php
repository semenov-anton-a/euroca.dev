<!DOCTYPE html>
<html lang="<?= session('locale', 'en') ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EuroCargo ERP - Register</title>
    <link rel="stylesheet" href="<?= base_url('css/auth.css') ?>">
</head>
<body>
    <div class="auth-page">
        <div class="auth-card">
            <h1 class="auth-title">Register</h1>
            <p class="auth-subtitle">Create your account</p>
            
            <form action="<?= base_url('register') ?>" method="POST" id="register-form">
                <?= csrf_field() ?>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                
                <button type="submit" class="btn btn-primary btn-block">
                    Register
                </button>
            </form>
            
            <div class="auth-footer">
                <a href="/login">Already have an account? Login</a>
            </div>
        </div>
    </div>
</body>
</html>