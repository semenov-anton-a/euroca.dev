<!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body" id="navigation" tabindex="-1">
        <!--begin::Container-->
        <div class="container-fluid">
          
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav" role="navigation" aria-label="Navigation 1">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>

            <li class="nav-item d-none d-md-block">
              <a href="./test" class="nav-link">
                <i class="bi bi-grid-1x2 me-1" aria-hidden="true"></i>
                Tests
              </a>
            </li>
            <!-- <li class="nav-item d-none d-md-block">
              <a href="./docs/introduction.html" class="nav-link">
                <i class="bi bi-book me-1" aria-hidden="true"></i>
                Documentation
              </a>
            </li> -->
          </ul>
          <!--end::Start Navbar Links-->

          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto" role="navigation" aria-label="Navigation 2">
            <!--begin::Navbar Search-->
            <!-- <li class="nav-item">
              <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="bi bi-search"></i>
              </a>
            </li> -->
            <!--end::Navbar Search-->


            <!--begin::Color Mode Toggle (#6010)-->
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" id="bd-theme" aria-label="Toggle color scheme" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-sun-fill" data-lte-theme-icon="light"></i>
                <i class="bi bi-moon-fill d-none" data-lte-theme-icon="dark"></i>
                <i class="bi bi-circle-half d-none" data-lte-theme-icon="auto"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme" style="--bs-dropdown-min-width: 8rem">
                <li>
                  <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="light" aria-pressed="true">
                    <i class="bi bi-sun-fill me-2"></i>
                    Light
                    <i class="bi bi-check-lg ms-auto"></i>
                  </button>
                </li>
                <li>
                  <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                    <i class="bi bi-moon-fill me-2"></i>
                    Dark
                    <i class="bi bi-check-lg ms-auto d-none"></i>
                  </button>
                </li>
                <li>
                  <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto" aria-pressed="false">
                    <i class="bi bi-circle-half me-2"></i>
                    Auto
                    <i class="bi bi-check-lg ms-auto d-none"></i>
                  </button>
                </li>
              </ul>
            </li>
            <!--end::Color Mode Toggle-->
              <?php if (session('logged_in')) : $userName = esc(session('user_name'));  ?>
              <!--begin::User Menu Dropdown-->
              <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                  <!-- <img src="./assets/img/user2-160x160.jpg" class="user-image rounded-circle shadow" alt="User Image"> -->
                  <span class="d-none d-md-inline"><?= $userName ?></span>
                </a>
                
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                  <!--begin::User Image-->
                  <li class="text-bg-primary text-center">
                    <!-- <img src="./assets/img/user2-160x160.jpg" class="rounded-circle shadow" alt="User Image"> -->
                    <p>
                      
                      <small>
                        <!-- TEXT exmple role -->
                      </small>
                    </p>
                  </li>
                  <!--end::User Image-->
                  <!--begin::Menu Body-->
                  <li class="user-body">
                    <!--begin::Row-->
                    <div class="row">
                      <div class="col-4 text-center">
                        <a href="#">Followers</a>
                      </div>
                      <div class="col-4 text-center">
                        <a href="#">Sales</a>
                      </div>
                      <div class="col-4 text-center">
                        <a href="#">Friends</a>
                      </div>
                    </div>
                    <!--end::Row-->
                  </li>
                  <!--end::Menu Body-->
                  <!--begin::Menu Footer-->
                  <li class="user-footer">
                    <a href="/profile" class="btn btn-outline-secondary">Profile</a>
                    <a href="/logout" class="btn btn-outline-danger float-end">Sign out</a>
                  </li>
                  <!--end::Menu Footer-->
                </ul>
              </li>
            <?php endif; ?>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->