<?php foreach ($items as $item): ?>

    <?php
    $hasChildren = !empty($item['children']);
    $url = $item['url'] ?? '#';

    $isActive = $url !== '#'
        && trim(parse_url(current_url(), PHP_URL_PATH), '/')
            === trim($url, '/');
    ?>

    <li class="nav-item <?= $isActive ? 'menu-open' : '' ?>">
        <a href="<?= esc($url) ?>" class="nav-link <?= $isActive ? 'active' : '' ?>" >
            <i class="nav-icon <?= esc($item['icon']) ?>"></i>

            <p>
                <?= esc($item['title']) ?>

                <?php if ($hasChildren): ?>
                    <i class="nav-arrow bi bi-chevron-right"></i>
                <?php endif; ?>
            </p>
        </a>
        <?php if ($hasChildren): ?>
            <ul class="nav nav-treeview">
                <?= view('partials/sidebar_menu_items', [ 'items' => $item['children'], ]) ?>
            </ul>
        <?php endif; ?>

    </li>
    

<?php endforeach; ?>