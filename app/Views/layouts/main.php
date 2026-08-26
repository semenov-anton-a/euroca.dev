<?php
  $htmlLinks = [
    'css' => [
      '/assets/modules/adminlte/css/adminlte.min.css',  
    ],
    'js' => [
      '/assets/modules/adminlte/js/adminlte.min.js'
    ]
  ];
?>
<?php
$die = 0;


if($die == 1) {
echo __FILE__ ;
die;
}

?>
<!doctype html>
<html lang="<?= session('locale') ?>">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AdminLTE v4 | Dashboard</title>

    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    
    <meta name="csrf-token" content="<?= csrf_hash() ?>">
    <!--end::Accessibility Meta Tags-->

    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="<?= $htmlLinks['css'][0] ?>" as="style" />
    <!--end::Accessibility Features-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css" integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      
    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
      media="print"
      onload="this.media = 'all'"
    />
    <!--end::Fonts-->

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->

    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->

    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="<?= $htmlLinks['css'][0] ?>" />
    <!--end::Required Plugin(AdminLTE)-->

    <!-- apexcharts -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
      integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
      crossorigin="anonymous"
    />

    <!-- jsvectormap -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
      integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4="
      crossorigin="anonymous"
    />
<<<<<<< HEAD
=======

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/js/all.min.js" integrity="sha512-2+f4MxT8KwN4tUzw6/hv9kxKiix603S9kmBcix+0y0dBhd6zdaPOV1Thf1DM886pFZG+cAtmshBi8UBpo6m3JA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

>>>>>>> Module/Admin_Settings
    <!-- HTMX -->
     <script src="https://cdn.jsdelivr.net/npm/htmx.org@2.0.10/dist/htmx.min.js" 
          integrity="sha384-H5SrcfygHmAuTDZphMHqBJLc3FhssKjG7w/CeCpFReSfwBWDTKpkzPP8c+cLsK+V"
          crossorigin="anonymous"></script>
<<<<<<< HEAD
=======
      
      <link rel="stylesheet" href="<?= \App\Helpers\AssetHelper::asset('css/common.css') ?>" >
      <script src="<?= \App\Helpers\AssetHelper::asset('js/common.js') ?>"></script>
      

>>>>>>> Module/Admin_Settings
  </head>
  <!--end::Head-->

  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      
      <!--begin::Header-->
      <?= $this->include('partials/navbar') ?>
      <!--end::Header-->

      <!--begin::Sidebar-->
      <?= $this->include('partials/sidebar') ?>
      <!--end::Sidebar-->
      
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <?php 
<<<<<<< HEAD
          echo $this->include('partials/headerContent') 
=======
          // echo $this->include('partials/headerContent') 
          echo $this->renderSection('headerContentModule');
>>>>>>> Module/Admin_Settings
        ?>
        <!--end::App Content Header-->
        
        <!--begin::App Content-->
<<<<<<< HEAD
        <div class="app-content-header">
=======
        <div class="app-content-header p-1 m-1">
>>>>>>> Module/Admin_Settings
          <!--begin::Container-->
          <div class="container-fluid">
            
            <!--begin::Row-->
<<<<<<< HEAD
            <?php 
            //echo $this->include('partials/dashboardComponents/cards') 
=======
            <?php             
            // echo $this->include('partials/dashboardComponents/cards') 
>>>>>>> Module/Admin_Settings
            ?>
            <!--end::Row-->
            
            <!--begin::Row-->
            <?= $this->renderSection('content') ?>
            <!-- /.row (main row) -->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
      <!--begin::Footer-->
      <footer class="app-footer">
        <!--begin::To the end-->
        <div class="float-end d-none d-sm-inline">Anything you want</div>
        <!--end::To the end-->
        <!--begin::Copyright-->
        <strong>
          Copyright &copy; 2014-2026&nbsp;
          <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
        </strong>
        All rights reserved.
        <!--end::Copyright-->
      </footer>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="<?= $htmlLinks['js'][0] ?>"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
   
   <script type="text/javascript">
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);

        // Disable OverlayScrollbars on mobile devices to prevent touch interference
        const isMobile = window.innerWidth <= 992;

        if (
          sidebarWrapper &&
          OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined &&
          !isMobile
        ) {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    
    <!--end::OverlayScrollbars Configure--><!--begin::Color Mode Toggle (#6010)-->
    <script>
      (() => {
        'use strict';

        const STORAGE_KEY = 'lte-theme';

        const getStoredTheme = () => localStorage.getItem(STORAGE_KEY);
        const setStoredTheme = (theme) => localStorage.setItem(STORAGE_KEY, theme);

        const prefersDark = () => globalThis.matchMedia('(prefers-color-scheme: dark)').matches;

        const getPreferredTheme = () => {
          const stored = getStoredTheme();
          if (stored) return stored;
          return prefersDark() ? 'dark' : 'light';
        };

        const setTheme = (theme) => {
          const resolved = theme === 'auto' ? (prefersDark() ? 'dark' : 'light') : theme;
          document.documentElement.setAttribute('data-bs-theme', resolved);
        };

        setTheme(getPreferredTheme());

        const showActiveTheme = (theme) => {
          // Highlight the active dropdown option
          document.querySelectorAll('[data-bs-theme-value]').forEach((el) => {
            el.classList.remove('active');
            el.setAttribute('aria-pressed', 'false');
            const check = el.querySelector('.bi-check-lg');
            if (check) check.classList.add('d-none');
          });
          const active = document.querySelector(`[data-bs-theme-value="${theme}"]`);
          if (active) {
            active.classList.add('active');
            active.setAttribute('aria-pressed', 'true');
            const check = active.querySelector('.bi-check-lg');
            if (check) check.classList.remove('d-none');
          }
          // Sync the topbar trigger icon
          document.querySelectorAll('[data-lte-theme-icon]').forEach((icon) => {
            icon.classList.toggle('d-none', icon.dataset.lteThemeIcon !== theme);
          });
        };

        globalThis.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
          const stored = getStoredTheme();
          if (!stored || stored === 'auto') setTheme(getPreferredTheme());
        });

        document.addEventListener('DOMContentLoaded', () => {
          showActiveTheme(getPreferredTheme());
          document.querySelectorAll('[data-bs-theme-value]').forEach((toggle) => {
            toggle.addEventListener('click', () => {
              const theme = toggle.getAttribute('data-bs-theme-value');
              setStoredTheme(theme);
              setTheme(theme);
              showActiveTheme(theme);
            });
          });
        });
      })();
    </script>
    <!--end::Color Mode Toggle-->

    <!-- OPTIONAL SCRIPTS -->

    <!-- sortablejs -->
    <script
      src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
      crossorigin="anonymous"
    ></script>

    <!-- sortablejs -->
    <script>
<<<<<<< HEAD
      new Sortable(document.querySelector('.connectedSortable'), {
        group: 'shared',
        handle: '.card-header',
      });

      const cardHeaders = document.querySelectorAll('.connectedSortable .card-header');
      cardHeaders.forEach((cardHeader) => {
        cardHeader.style.cursor = 'move';
      });
    </script>    
  
=======
      // new Sortable(document.querySelector('.connectedSortable'), {
      //   group: 'shared',
      //   handle: '.card-header',
      // });

      // const cardHeaders = document.querySelectorAll('.connectedSortable .card-header');
      // cardHeaders.forEach((cardHeader) => {
      //   cardHeader.style.cursor = 'move';
      // });
    </script>    

    <div id="toast-container" class="toast-container position-fixed top-0 end-0 p-3"></div>

    <script type="text/javascript">
      Toast.init();
      document.body.addEventListener('toast', event => {
        Toast.show( event.detail.type, event.detail.message, event.detail.title );
      });
      
    </script>
</div>
   <script type="text/javascript">
      const HtmxCsrf = {
          init: function () {
              document.body.addEventListener('htmx:configRequest', this.send);
              document.body.addEventListener('htmx:afterRequest', this.update);
          },
          send: function (event) {
              const meta = document.querySelector('meta[name="csrf-token"]');
              if (meta) { event.detail.headers['X-CSRF-TOKEN'] = meta.content; }
          },
          update: function (event) {
              const token = event.detail.xhr.getResponseHeader('X-CSRF-TOKEN');
              if (token) { document.querySelector('meta[name="csrf-token"]').content = token; }
          }
      };

      HtmxCsrf.init();
   </script>
>>>>>>> Module/Admin_Settings
  </body>
  <!--end::Body-->
</html>
