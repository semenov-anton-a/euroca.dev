<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <!--begin::Brand Link-->
    <a href="./index.html" class="brand-link">
      <!--begin::Brand Image-->
      <!-- <img
        src="./assets/img/AdminLTELogo.png"
        alt="AdminLTE Logo"
        class="brand-image opacity-75 shadow"
      /> -->
      <!--end::Brand Image-->
      <!--begin::Brand Text-->
      <span class="brand-text fw-light">EuroCargo Finland Oy</span>
      <!--end::Brand Text-->
    </a>
    <!--end::Brand Link-->
  </div>
  <!--end::Sidebar Brand-->
  <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper">
    <nav class="mt-2">
      
      <!-- Docs CTA -->
      <div class="px-3 pb-2">
        <!-- <a
          href="./docs/introduction.html"
          class="btn btn-sm btn-outline-light w-100 d-flex align-items-center justify-content-center gap-2">
          <i class="bi bi-book" aria-hidden="true"></i>
          View documentation
        </a> -->
      </div>

      <?php

<<<<<<< HEAD
      // use Config\Services;

      // $menuService = Services::menuService();

      // $userPermissions = Services::permissionService()->getCurrentPermissions();

      // $menu = $menuService->getMenu($userPermissions);
=======
      use App\Services\View\MenuService;

      $menuService = new MenuService();

      $allMenu = $menuService->getAllMenu();

      $fakePermissions = [];
        
        foreach ($allMenu as $menu) 
        {
            $fakePermissions[] = $menu['permission'];
            if( !empty($menu["children"]) )
            {
                for( $i = 0; $i < count($menu["children"]); $i++ )
                {
                    $fakePermissions[] = $menu["children"][$i]['permission'];
                }
            }
        }

        $items = $menuService->getMenu($fakePermissions);
>>>>>>> Module/Admin_Settings

      ?>

      <ul
        class="nav sidebar-menu flex-column"
        data-lte-toggle="treeview"
        role="navigation"
        aria-label="Main navigation"
        data-accordion="false"
        id="navigation">

<<<<<<< HEAD
        <?php 
          // $this->include('partials/sidebar_menu_items', ['items' => $menu]) 
        ?>
=======
        <?= view('partials/sidebar_menu_items', [ 'items' => $items ] ) ?>

>>>>>>> Module/Admin_Settings

      </ul>
    </nav>
  </div>
  <!--end::Sidebar Wrapper-->
</aside>