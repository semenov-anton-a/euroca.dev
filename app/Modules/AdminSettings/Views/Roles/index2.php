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

	<div class="container-fluid m-0 p-0">
		<div class="row g-3">

			<!-- Left rail -->
			<div class="col-md-2 m-0 p-1">
				<div class="card">
					<div class="card-body">
						<div class="list-group list-group-flush nav nav-pills flex-column" id="settings-nav" role="tablist" aria-label="Navigation 18">
							<?php foreach ($roles as $role): ?> <?php $targetId = 'role-' . $role->id; ?>							
							<a href="#<?= esc($targetId) ?>" data-role-id="<?= esc($role->id) ?>"
                                 class="list-group-item list-group-item-action" data-bs-toggle="pill" role="tab" aria-selected="true">
								<i class="bi bi-person me-2" aria-hidden="true"></i><?= esc($role->name) ?>
							</a>
							<?php endforeach ?>
						</div>
					</div>
					 <div class="card-footer text-center">
      			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#roleModal">New Role</button>
    			 </div>
				</div>
			</div>

			<!-- Tab content -->
			<div class="col-md-10 m-0 p-1">
                <!-- <div class="text-center d-flex justify-content-center align-items-center h-100 d-none" id="roleDetalies-preloader">
                    <i class="fa fa-spinner fa-spin fa-5" aria-hidden="true"></i>
                </div> -->
                <div class="spinner-border text-primary m-3 p-3 d-none" id="roleDetalies-preloader" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
				<div class="tab-content" id="role-detalies">
					<!-- Account -->
                    
                    

					<!-- <div class="tab-pane fade" id="<?= esc($targetId) ?>" role="tabpanel">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Account</h3>
							</div>
							<div class="card-body">
								<form class="row g-3">
									<div class="col-md-6">
										<label class="form-label" for="settings-name"> Full name </label>
										<input type="text" class="form-control" id="settings-name" value="Jane Doe">
									</div>
									<div class="col-md-6">
										<label class="form-label" for="settings-email"> Email </label>
										<input type="email" class="form-control" id="settings-email" value="jane@example.com">
									</div>
									<div class="col-md-6">
										<label class="form-label" for="settings-tz"> Time zone </label>
										<select class="form-select" id="settings-tz">
											<option>UTC</option>
											<option selected="">America/Los_Angeles</option>
											<option>Europe/London</option>
											<option>Asia/Tokyo</option>
										</select>
									</div>
									<div class="col-md-6">
										<label class="form-label" for="settings-lang"> Language </label>
										<select class="form-select" id="settings-lang">
											<option selected="">English</option>
											<option>Español</option>
											<option>Français</option>
											<option>Deutsch</option>
										</select>
									</div>
									<div class="col-12">
										<button type="submit" class="btn btn-primary">Save changes</button>
									</div>
								</form>
							</div>
						</div>
					</div> -->
				</div>
			</div>
		</div>
	</div>

</div>

<div class="modal fade" id="roleModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="roleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="roleModalLabel">
                    New Role
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form
                hx-post="<?= route_to('admin_settings.create_role') ?>"
                hx-target="#role-message"
                hx-swap="innerHTML"
                id="create-role-form"
            >
                <div class="modal-body">
                    <div id="role-message"></div>
                    <div class="mb-3">
                        <label for="role-name" class="col-form-label">
                            Role name:
                        </label>
                        <input type="text" name="name" id="name" class="form-control" required 
													pattern="<?= esc($formRules['roleName']) ?>"
												>
                    </div>

                    <div class="mb-3">
                        <label for="role-description" class="col-form-label">
                            Description:
                        </label>

                        <textarea name="description" id="description" class="form-control"
													required minlength="10" maxlength="50"></textarea>
                    </div>
                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary" id="create-role-button">
                        <span class="button-text">
                            Create
                        </span>
                        <i class="fas fa-spinner fa-spin d-none button-spinner"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">

const RoleModal = {

    init: function () {
        this.modal = document.getElementById('roleModal');
        this.form = document.getElementById('create-role-form');
        this.button = document.getElementById('create-role-button');
        this.newRoleButton = document.getElementById('new-role-button');
        
        this.bindEvents();
    },
    bindEvents: function () {
        this.form.addEventListener('submit', () => {
            this.loading(true);
        });

        document.body.addEventListener('roleCreated', (event) => {
            this.roleCreated(event);
        });

        this.modal.addEventListener('hidden.bs.modal', () => {
            this.newRoleButton?.focus();
        });
    },

    loading: function (state) {

        const text = this.button.querySelector('.button-text');
        const spinner = this.button.querySelector('.button-spinner');
        const closeButton = this.modal.querySelector('.btn-close');
        const secondaryButton = this.modal.querySelector('.btn-secondary');

        this.button.disabled = state;
        closeButton.disabled = state;
        secondaryButton.disabled = state;

        text.classList.toggle('d-none', state);
        spinner.classList.toggle('d-none', !state);

        this.form
            .querySelectorAll('input, textarea, select')
            .forEach(element => {
                element.disabled = state;
            });
    },

    roleCreated: function (event) {

        this.clearForm();
        this.closeModal();
        this.appendToMenu(event.detail);
    },

    clearForm: function () {
        this.form.reset();
    },

    closeModal: function () {

        document.activeElement?.blur();

        const modal = bootstrap.Modal.getInstance(this.modal);

        modal?.hide();
    },

    appendToMenu: function (role) {

        const menu = document.getElementById('settings-nav');

        const item = document.createElement('a');

        // item.href = '#role-' + role.id;
        // item.className = 'list-group-item list-group-item-action active';
        // item.dataset.bsToggle = 'pill';
        // item.setAttribute('role', 'tab');
        // item.setAttribute('aria-selected', 'false');
        
        item.href = '#role-' + role.id;
        item.className = 'list-group-item list-group-item-action';
        item.dataset.bsToggle = 'pill';
        item.dataset.roleId = role.id;
        item.setAttribute('role', 'tab');
        item.setAttribute('aria-selected', 'false');

        item.innerHTML = `
            <i class="bi bi-person me-2" aria-hidden="true"></i>
            ${role.name}
        `;
        
        menu.appendChild(item);
        
        const tab = new bootstrap.Tab(item);
        tab.show();

        // RoleDetalies.loading( role.id );

    },
};

const RoleDetalies = {
    init : function(){
        this.tabContent = document.getElementById('role-detalies');
        this.detalisCardPreloader = document.getElementById('roleDetalies-preloader');
        return this;
    },
    loading : function(id)
    {
        this.showPreloader();

        htmx.ajax('GET', `/admin_settings/role/${id}`, {
                target: '#role-detalies',
                swap: 'innerHTML'
        })
        .then(() => { this.hidePreloader(); })
        .catch(() => { this.hidePreloader(); });

        return this;
    },
    showPreloader : function(){
          this.detalisCardPreloader.classList.remove('d-none');                              
    },
    hidePreloader : function(){
        this.detalisCardPreloader.classList.add('d-none');
    }
};

const RoleNavigation = {

    init: function () 
    {
        this.menu = document.getElementById('settings-nav');

        this.menu.addEventListener('shown.bs.tab', event => {
            const id = event.target.dataset.roleId;
            RoleDetalies.tabContent.querySelector('.tab-pane.active.show')?.classList.remove('active', 'show');
            RoleDetalies.loading(id);
        });
    }
};

document.addEventListener('DOMContentLoaded', function () { RoleModal.init() });
RoleDetalies.init();
RoleNavigation.init();

document.body.addEventListener('toast', function ( data ) {
    console.log( data.detail.msg );
});



</script>

<?= $this->endSection() ?>