<aside class="sidebar">
    <div class="sidebar-header">
        <h2>Menu</h2>
    </div>
    <ul class="sidebar-menu">
        <li class="sidebar-item">
            <a href="/dashboard" class="sidebar-link">
                <span class="sidebar-icon">🏠</span>
                <span class="sidebar-text">Dashboard</span>
            </a>
        </li>
        <?php foreach ($menu as $item): ?>
        <li class="sidebar-item">
            <a href="<?= $item['url'] ?>" class="sidebar-link">
                <span class="sidebar-icon"><?= $item['icon'] ?></span>
                <span class="sidebar-text"><?= $item['title'] ?></span>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
</aside>