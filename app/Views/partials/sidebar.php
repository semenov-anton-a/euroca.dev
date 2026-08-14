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

      // use Config\Services;

      // $menuService = Services::menuService();

      // $userPermissions = Services::permissionService()->getCurrentPermissions();

      // $menu = $menuService->getMenu($userPermissions);

      ?>

      <ul
        class="nav sidebar-menu flex-column"
        data-lte-toggle="treeview"
        role="navigation"
        aria-label="Main navigation"
        data-accordion="false"
        id="navigation">

        <?php 
          // $this->include('partials/sidebar_menu_items', ['items' => $menu]) 
        ?>

      </ul>
    </nav>
  </div>
  <!--end::Sidebar Wrapper-->
</aside>