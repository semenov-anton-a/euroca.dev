<?php foreach ($items as $item): ?>
<?php
    $hasChildren = !empty($item['children']);

    $currentPath = trim((string) parse_url(current_url(), PHP_URL_PATH), '/' );

    $url = $item['url'] ?? '#';

    $itemPath = trim((string) parse_url($url, PHP_URL_PATH), '/' );

    // Текущий пункт
    $isActive = $url !== '#' && $currentPath === $itemPath;

    // Проверяем дочерние пункты
    $hasActiveChild = false;

    if ($hasChildren) 
    {
        foreach ($item['children'] as $child) {

            $childUrl = $child['url'] ?? '#';

            if ($childUrl !== '#') 
            {
                $childPath = trim( (string) parse_url($childUrl, PHP_URL_PATH), '/' );

                if ($currentPath === $childPath) { $hasActiveChild = true; break; }
            }
        }
    }

    // Родитель открыт, если активен он сам
    // или один из его children
    $isOpen = $isActive || $hasActiveChild;
    ?>

    <li class="nav-item <?= $isOpen ? 'menu-open' : '' ?>">

        <a
            href="<?= esc($url) ?>"
            class="nav-link <?= $isActive ? 'active' : '' ?>"
        >

            <i class="nav-icon <?= esc($item['icon'] ?? '') ?>"></i>

            <p>
                <?= esc($item['title']) ?>

                <?php if ($hasChildren): ?>
                    <i class="nav-arrow bi bi-chevron-right"></i>
                <?php endif; ?>
            </p>

        </a>

        <?php if ($hasChildren): ?>

            <ul class="nav nav-treeview">

                <?= view('partials/sidebar_menu_items', [
                    'items' => $item['children'],
                ]) ?>

            </ul>

        <?php endif; ?>

    </li>

<?php endforeach; ?>