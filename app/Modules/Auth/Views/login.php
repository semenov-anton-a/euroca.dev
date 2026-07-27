<!DOCTYPE html>
<html lang="<?= session('locale', 'en') ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EuroCargo ERP - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/auth.css') ?>">
</head>
<body>
    <div class="auth-page">
        <div class="auth-card">
            <h1 class="auth-title"><?= lang('Auth.login_title') ?></h1>
            <p class="auth-subtitle"><?= lang('Auth.login_subtitle') ?></p>
            
            <form action="<?= base_url('authenticate') ?>" method="POST" id="login-form">
                <?= csrf_field() ?>
                
                <div class="form-group">
                    <label for="email"><?= lang('Auth.email') ?></label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="your@email.com" required>
                </div>
                
                <div class="form-group">
                    <label for="password"><?= lang('Auth.password') ?></label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                
                <div class="form-group remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember"><?= lang('Auth.remember_me') ?></label>
                </div>
                
                <button type="submit" class="btn btn-primary btn-block">
                    <?= lang('Auth.login_button') ?>
                </button>
            </form>
            
            <div class="auth-footer">
                <a href="/register"><?= lang('Auth.no_account') ?> <?= lang('Auth.register') ?></a>
            </div>
        </div>
    </div>
</body>
</html>