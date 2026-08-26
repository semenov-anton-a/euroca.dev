<?= $this->extend('layouts/main') ?>


<?= $this->section('headerContentModule') ?>

<?= view('partials/headerContent', [
    'title' => $title,

    'breadcrumb' => [
        [
            'label' => 'Settings',
            'url'   => route_to('settings'),
        ],
        [
            'label' => 'Roles & Permissions',
            'url'   => route_to('settings.roles'),
        ],
    ],
]) ?>

<?= $this->endSection() ?>


<?= $this->section('content') ?>

<div class=row>
    <!-- <div class="col-md-2">
        <div class="card-body">
            <div class="card">
                <div class="list-group list-group-flush nav nav-pills flex-column" id="settings-nav" role="tablist" aria-label="Navigation 18">
                  <a href="#account" class="list-group-item list-group-item-action active" data-bs-toggle="pill" role="tab" aria-selected="true">
                    <i class="bi bi-person me-2" aria-hidden="true"></i>Account
                  </a>
                  <a href="#notifications" class="list-group-item list-group-item-action" data-bs-toggle="pill" role="tab" aria-selected="false" tabindex="-1">
                    <i class="bi bi-bell me-2" aria-hidden="true"></i>Notifications
                  </a>
                  <a href="#security" class="list-group-item list-group-item-action" data-bs-toggle="pill" role="tab" aria-selected="false" tabindex="-1">
                    <i class="bi bi-shield-lock me-2" aria-hidden="true"></i>Security
                  </a>
                  <a href="#billing" class="list-group-item list-group-item-action" data-bs-toggle="pill" role="tab" aria-selected="false" tabindex="-1">
                    <i class="bi bi-credit-card me-2" aria-hidden="true"></i>Billing
                  </a>
                  <a href="#danger" class="list-group-item list-group-item-action text-danger" data-bs-toggle="pill" role="tab" aria-selected="false" tabindex="-1">
                    <i class="bi bi-exclamation-triangle me-2" aria-hidden="true"></i>
                    Danger zone
                  </a>
                </div>
              </div>
        </div>
    </div> -->

    <div class="col-4">
        <div class="card-body">
            <div class="card">
                <!-- Card Header -->
                <div class="card-header border-0">
                    <h3 class="card-title">
                        <?= lang('Roles.titleRoles') ?>
                    </h3>

                    <div class="card-tools">
                        <a href="#" class="btn btn-primary btn-sm">New Role</a>
                        <!-- <a href="#" class="btn btn-tool btn-sm">
                            <i class="bi bi-download"></i>
                        </a>
                        <a href="#" class="btn btn-tool btn-sm">
                            <i class="bi bi-list"></i>
                        </a> -->
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body table-responsive p-0">
                    
                    <table class="table table-striped align-middle" role="table" data-accordion >

                        <thead>
                            <tr>
                                <th scope="col">
                                    <?= lang('Roles.role_name') ?>
                                </th>
                                <th scope="col">
                                    <?= lang('Roles.role_description') ?>
                                </th>                           
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($roles as $role): ?>
                                <?php $targetId = 'role-' . $role->id; ?>
                                <!-- Основная строка -->
                                <tr class="accordion-row" data-accordion-row data-accordion-target="<?= esc($targetId) ?>">
                                    <td>
                                        <i class="bi bi-chevron-right accordion-icon me-2" data-accordion-icon></i>
                                        <?= esc($role->name) ?>
                                    </td>
                                    <td>
                                        <?= esc( $role->description ?? '') ?>
                                    </td>
                                </tr>

                                <!-- Содержимое accordion -->
                                <tr id="<?= esc($targetId) ?>" class="accordion-details">
                                    <td colspan="4">
                                        <div class="accordion-content" data-accordion-content>
                                            <div class="p-3">
                                                <strong>
                                                    Permissions
                                                </strong>
                                                <div class="mt-2">
                                                    Permission 1<br>
                                                    Permission 2<br>
                                                    Permission 3
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>