<?php

declare(strict_types=1);

namespace App\Services\View;

/**
 * Menu service.
 *
 * Temporary menu storage.
 * Later this structure can be moved to database.
 */
class MenuService
{
    /**
     * Menu structure.
     *
     * Fields:
     * - title      Menu title
     * - icon       AdminLTE/icon identifier
     * - url        URL for clickable menu item
     * - permission Required permission
     * - children   Nested menu items
     * - order      Display order
     */
    protected array $menuItems = [

        [
            'title'      => 'Dashboard',
            'icon'       => 'fa-regular fa-house',
            'url'        => '/dashboard',
            'permission' => 'dashboard.view',
            'order'      => 10,
        ],

        [
            'title'      => 'Cargo',
            //'icon'       => 'fa-thin fa-boxes-stacked',
            'icon'       => 'fa-solid fa-cubes',
            'permission' => 'cargo.view',
            'order'      => 20,

            'children' => [

                [
                    'title'      => 'All Cargo',
                    'icon'       => 'list',
                    'url'        => '/cargo',
                    'permission' => 'cargo.view',
                    'order'      => 10,
                ],

                [
                    'title'      => 'Create Cargo',
                    'icon'       => 'plus',
                    'url'        => '/cargo/create',
                    'permission' => 'cargo.create',
                    'order'      => 20,
                ],

                [
                    'title'      => 'In Transit',
                    'icon'       => 'truck',
                    'url'        => '/cargo/in-transit',
                    'permission' => 'cargo.view',
                    'order'      => 30,
                ],

                [
                    'title'      => 'Archive',
                    'icon'       => 'archive',
                    'url'        => '/cargo/archive',
                    'permission' => 'cargo.view',
                    'order'      => 40,
                ],

            ],
        ],

        [
            'title'      => 'Customers',
            'icon'       => 'users',
            'permission' => 'customer.view',
            'order'      => 30,

            'children' => [

                [
                    'title'      => 'All Customers',
                    'icon'       => 'list',
                    'url'        => '/customers',
                    'permission' => 'customer.view',
                    'order'      => 10,
                ],

                [
                    'title'      => 'Create Customer',
                    'icon'       => 'plus',
                    'url'        => '/customers/create',
                    'permission' => 'customer.create',
                    'order'      => 20,
                ],

            ],
        ],

        [
            'title'      => 'Warehouse',
            'icon'       => 'warehouse',
            'permission' => 'warehouse.view',
            'order'      => 40,

            'children' => [

                [
                    'title'      => 'Warehouses',
                    'icon'       => 'building',
                    'url'        => '/warehouse',
                    'permission' => 'warehouse.view',
                    'order'      => 10,
                ],

                [
                    'title'      => 'Cargo Storage',
                    'icon'       => 'box',
                    'url'        => '/warehouse/cargo',
                    'permission' => 'warehouse.view',
                    'order'      => 20,
                ],

            ],
        ],

        [
            'title'      => 'Documents',
            'icon'       => 'file-document',
            'permission' => 'documents.view',
            'order'      => 50,

            'children' => [

                [
                    'title'      => 'All Documents',
                    'icon'       => 'files',
                    'url'        => '/documents',
                    'permission' => 'documents.view',
                    'order'      => 10,
                ],

                [
                    'title'      => 'Create Document',
                    'icon'       => 'plus',
                    'url'        => '/documents/create',
                    'permission' => 'documents.create',
                    'order'      => 20,
                ],

            ],
        ],

        [
            'title'      => 'Accounting',
            'icon'       => 'calculator',
            'permission' => 'accounting.view',
            'order'      => 60,

            'children' => [

                [
                    'title'      => 'Overview',
                    'icon'       => 'dashboard',
                    'url'        => '/accounting',
                    'permission' => 'accounting.view',
                    'order'      => 10,
                ],

                [
                    'title'      => 'Transactions',
                    'icon'       => 'transactions',
                    'url'        => '/accounting/transactions',
                    'permission' => 'accounting.transactions.view',
                    'order'      => 20,
                ],

                [
                    'title'      => 'Invoices',
                    'icon'       => 'invoice',
                    'url'        => '/accounting/invoices',
                    'permission' => 'accounting.invoice.view',
                    'order'      => 30,
                ],

                [
                    'title'      => 'Expenses',
                    'icon'       => 'expense',
                    'url'        => '/accounting/expenses',
                    'permission' => 'accounting.expense.view',
                    'order'      => 40,
                ],

                [
                    'title'      => 'VAT',
                    'icon'       => 'calculator',
                    'url'        => '/accounting/vat',
                    'permission' => 'accounting.vat.view',
                    'order'      => 50,
                ],

                [
                    'title'      => 'Reports',
                    'icon'       => 'report',
                    'url'        => '/accounting/reports',
                    'permission' => 'accounting.report.view',
                    'order'      => 60,
                ],

            ],
        ],

        [
            'title'      => 'Employees',
            'icon'       => 'user-group',
            'permission' => 'employees.view',
            'order'      => 70,

            'children' => [

                [
                    'title'      => 'All Employees',
                    'icon'       => 'users',
                    'url'        => '/employees',
                    'permission' => 'employees.view',
                    'order'      => 10,
                ],

                [
                    'title'      => 'Create Employee',
                    'icon'       => 'plus',
                    'url'        => '/employees/create',
                    'permission' => 'employees.create',
                    'order'      => 20,
                ],

            ],
        ],

        [
            'title'      => 'Admin Settings',
            'icon'       => 'gear',
            'permission' => 'settings.view',
            'order'      => 80,

            'children' => [

                [
                    'title'      => 'General',
                    'icon'       => 'settings',
                    'url'        => '/admin_settings',
                    'permission' => 'settings.view',
                    'order'      => 10,
                ],

                [
                    'title'      => 'Users',
                    'icon'       => 'users',
                    'url'        => '/admin_settings/users',
                    'permission' => 'users.view',
                    'order'      => 20,
                ],

                [
                    'title'      => 'Roles & Permissions',
                    'icon'       => 'shield',
                    'url'        => '/admin_settings/roles',
                    'permission' => 'roles.view',
                    'order'      => 30,
                ],
                
                [
                    'title'      => 'Tests',
                    'icon'       => 'shield',
                    'url'        => '/test',
                    'permission' => 'tests',
                    'order'      => 40,
                ],
                [
                    'title'      => 'AdminLTE',
                    'icon'       => 'shield',
                    'url'        => '/adminlte',
                    'permission' => 'tests',
                    'order'      => 50,
                ],

            ],
        ],

    ];


    /**
     * Get menu items filtered by user permissions.
     *
     * Parent item is displayed when:
     * - user has parent's permission;
     * - or at least one child is available.
     */
    public function getMenu(array $userPermissions = []): array
    {
        $menu = $this->filterItems(
            $this->menuItems,
            $userPermissions
        );

        return $this->sortItems($menu);
    }


    /**
     * Get all menu items without permission filtering.
     */
    public function getAllMenu(): array
    {
        return $this->sortItems($this->menuItems);
    }


    /**
     * Recursively filter menu items.
     */
    protected function filterItems( array $items, array $userPermissions ): array 
    {
        // dd($userPermissions,"userPermissions");

        $filtered = [];

        foreach ($items as $item) 
        {
            $children = [];

            if ( ! empty($item['children']) ) 
            {
                $children = $this->filterItems( $item['children'], $userPermissions );
            }

            
            $hasPermission = 
                empty( $item['permission'] ) || in_array(
                    $item['permission'],
                    $userPermissions,
                    true
                );

            
                
            /*
             * Item can be displayed when:
             *
             * 1. User has permission for this item.
             * 2. OR item has children available to user.
             */
            if ($hasPermission || !empty($children)) {

                if (!empty($children)) {
                    $item['children'] = $children;
                } else {
                    unset($item['children']);
                }

                $filtered[] = $item;
            }
        }

        // dd($filtered);

        return $filtered;
    }


    /**
     * Sort menu items by order.
     */
    protected function sortItems(array $items): array
    {
        usort(
            $items,
            static fn(array $a, array $b): int =>
                ($a['order'] ?? 9999)
                <=>
                ($b['order'] ?? 9999)
        );

        foreach ($items as &$item) {

            if (!empty($item['children'])) {
                $item['children'] = $this->sortItems(
                    $item['children']
                );
            }
        }

        unset($item);

        return $items;
    }
}
