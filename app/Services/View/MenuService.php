<?php

declare(strict_types=1);

namespace App\Services;

/**
 * Menu service for generating navigation menus.
 * Returns menu structure with permissions filtering.
 */
class MenuService
{
    /**
     * Available menu items.
     */
    protected array $menuItems = [
        [
            'title' => 'Dashboard',
            'icon' => 'home',
            'url' => '/dashboard',
            'permission' => 'dashboard.view',
        ],
        [
            'title' => 'Cargo',
            'icon' => 'truck',
            'url' => '/cargo',
            'permission' => 'cargo.view',
        ],
        [
            'title' => 'Customers',
            'icon' => 'users',
            'url' => '/customers',
            'permission' => 'customer.view',
        ],
        [
            'title' => 'Warehouse',
            'icon' => 'warehouse',
            'url' => '/warehouse',
            'permission' => 'warehouse.view',
        ],
        [
            'title' => 'Documents',
            'icon' => 'file-document',
            'url' => '/documents',
            'permission' => 'documents.view',
        ],
        [
            'title' => 'Accounting',
            'icon' => 'calculator',
            'url' => '/accounting',
            'permission' => 'accounting.view',
        ],
        [
            'title' => 'Employees',
            'icon' => 'user-group',
            'url' => '/employees',
            'permission' => 'employees.view',
        ],
        [
            'title' => 'Settings',
            'icon' => 'gear',
            'url' => '/settings',
            'permission' => 'settings.view',
        ],
    ];

    /**
     * Get menu items filtered by user permissions.
     */
    public function getMenu(array $userPermissions = []): array
    {
        $filteredMenu = [];

        foreach ($this->menuItems as $item) {
            if (empty($userPermissions) || in_array($item['permission'], $userPermissions, true)) {
                $filteredMenu[] = $item;
            }
        }

        return $filteredMenu;
    }

    /**
     * Get all menu items without permission filtering.
     */
    public function getAllMenu(): array
    {
        return $this->menuItems;
    }
}