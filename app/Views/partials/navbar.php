<nav class="navbar">
    <div class="navbar-brand">
        <a href="/dashboard">EuroCargo ERP</a>
    </div>
    <?php if (session('logged_in')): ?>
    <div class="navbar-user">
        <span class="user-name"><?= esc(session('user_name')) ?></span>
        <a href="/logout" class="logout-btn">Logout</a>
    </div>
    <?php endif; ?>
</nav>