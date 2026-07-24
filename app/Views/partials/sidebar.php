<aside class="sidebar">
    <div class="sidebar-header">
        <h2>Menu</h2>
    </div>
    <ul class="sidebar-menu">
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