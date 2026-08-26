<?php
$permissions = [
    'cargo' => ['view' => 'View', 'create' => 'Create', 'edit' => 'Edit', 'delete' => 'Delete'],
    'customers' => ['view' => 'View', 'create' => 'Create', 'edit' => 'Edit', 'delete' => 'Delete'],
    'warehouse' => ['view' => 'View', 'create' => 'Create', 'edit' => 'Edit', 'delete' => 'Delete'],
    'warehouse1' => ['view' => 'View', 'create' => 'Create', 'edit' => 'Edit', 'delete' => 'Delete'],
    'warehouse2' => ['view' => 'View', 'create' => 'Create', 'edit' => 'Edit', 'delete' => 'Delete'],
    'warehouse3' => ['view' => 'View', 'create' => 'Create', 'edit' => 'Edit', 'delete' => 'Delete'],
];

$rolePermissions = ['cargo.view', 'cargo.create', 'customers.view'];
?>
<style>
    .card.htmx-loading {
    position: relative;
}

.card.htmx-loading::after {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.35);
    z-index: 10;
}

.card.htmx-loading::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 2rem;
    height: 2rem;
    margin: -1rem 0 0 -1rem;
    border: 0.25rem solid rgba(255, 255, 255, 0.4);
    border-top-color: #fff;
    border-radius: 50%;
    animation: card-loading-spin 0.7s linear infinite;
    z-index: 11;
}

@keyframes card-loading-spin {
    to {
        transform: rotate(360deg);
    }
}
</style>
<div class="tab-pane fade active show" id="role-<?= esc($role['id']) ?>" role="tabpanel">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Permissions & Details</h3>
        </div>
        <div class="card-body">
            <form class="row g-3" method="post" 
                hx-post="<?= route_to('admin_settings.update_role', esc($role['id']) ) ?>" hx-target="#role-message" hx-swap="innerHTML">
                
                <div class="col-md-6">
                    <label class="form-label">Role name for ID: <?= $role['id'] ?></label>
                    <input type="text" name="name" class="form-control" 
                            value="<?= esc($role['name']) ?>" minlength="3" maxlength="50" required pattern="<?= esc($formRules['roleName']) ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Description</label>
                    <input type="text" name="description" class="form-control" 
                            value="<?= esc($role['description']) ?>" minlength="10" maxlength="255" required pattern="<?= esc($formRules['description']) ?>">
                </div>
                
                <div class="col-12">
                    <label class="form-label">Permissions</label>
                    <div class="row g-3">
                        <?php foreach ($permissions as $module => $items): ?>
                        <div class="col-md-2 col-xl-3">
                            <div class="card card-outline card-primary mb-0">
                                <div class="card-header py-2">
                                    <h3 class="card-title text-capitalize"><?= esc($module) ?></h3>
                                    <div class="card-tools">
                                        <div class="form-check">
                                            <input class="form-check-input permission-select-all" type="checkbox" id="all-<?= esc($module) ?>" data-module="<?= esc($module) ?>">
                                            <label class="form-check-label small" for="all-<?= esc($module) ?>">All</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body py-2">
                                    <?php foreach ($items as $action => $label): ?>
                                        <?php $permission = "{$module}.{$action}"; ?>
                                        <div class="form-check">
                                            <input class="form-check-input permission-checkbox" type="checkbox" name="permissions[]" value="<?= esc($permission) ?>" id="permission-<?= esc($permission) ?>" data-module="<?= esc($module) ?>" <?= in_array($permission, $rolePermissions, true) ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="permission-<?= esc($permission) ?>"><?= esc($label) ?></label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div id="role-message" class="col-12"></div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
document.addEventListener('change', function (event) {
    if (event.target.classList.contains('permission-select-all')) {
        const module = event.target.dataset.module;
        const permissionCheckboxes = document.querySelectorAll(`.permission-checkbox[data-module="${module}"]`);

        permissionCheckboxes.forEach(checkbox => checkbox.checked = event.target.checked);
        return;
    }

    if (event.target.classList.contains('permission-checkbox')) {
        const module = event.target.dataset.module;
        const permissionCheckboxes = document.querySelectorAll(`.permission-checkbox[data-module="${module}"]`);
        const selectAll = document.querySelector(`.permission-select-all[data-module="${module}"]`);

        selectAll.checked = [...permissionCheckboxes].every(checkbox => checkbox.checked);
    }
});
const RolePermissionUpdate = {
    init: function () {
        document.body.addEventListener('htmx:beforeRequest', function (event) {
            const form = event.detail.elt;

            if (!form.matches('form[hx-post]')) return;

            const card = form.closest('.card');
            const button = form.querySelector('button[type="submit"]');

            if (card) card.classList.add('htmx-loading');

            if (button) {
                button.disabled = true;
                button.dataset.originalHtml = button.innerHTML;
                button.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Saving...';
            }
        });

        document.body.addEventListener('htmx:afterRequest', function (event) {
            const form = event.detail.elt;

            if (!form.matches('form[hx-post]')) return;

            const card = form.closest('.card');
            const button = form.querySelector('button[type="submit"]');

            if (card) card.classList.remove('htmx-loading');

            if (button) {
                button.disabled = false;
                button.innerHTML = button.dataset.originalHtml ?? button.innerHTML;
                delete button.dataset.originalHtml;
            }
        });
    }
};

RolePermissionUpdate.init();
</script>