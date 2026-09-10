<?= $this->extend('layouts/main') ?>

<?= $this->section('headerContentModule') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card">

            <!-- Card Header -->
            <div class="card-header border-0">
                <h3 class="card-title">
                    <i class="bi bi-people me-2"></i>Employees
                </h3>

                <div class="card-tools">
                    <button type="button"
                        class="btn btn-primary btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#employeeModal">
                        <i class="bi bi-person-plus me-1"></i>
                        New Employee
                    </button>
                </div>

            </div>

            <!-- Card Body -->
            <div class="card-body table-responsive p-0">

                <table class="table table-hover align-middle mb-0" data-accordion>

                    <thead>
                        <tr>
                            <th style="width: 40px;"></th>
                            <th>Employee</th>
                            <th>Position</th>
                            <th>Department</th>
                            <th>Birthday</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <!-- Employee #1 -->
                        <tr class="accordion-row"
                            data-accordion-row
                            data-accordion-target="employee-1">

                            <td>
                                <i class="bi bi-chevron-right accordion-icon"
                                    data-accordion-icon></i>
                            </td>

                            <td>
                                <div class="d-flex align-items-center">

                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                        style="width:40px;height:40px;">
                                        <strong>AS</strong>
                                    </div>

                                    <div>
                                        <div class="fw-semibold">
                                            Anton Semenov
                                        </div>
                                        <small class="text-muted">
                                            anton@example.com
                                        </small>
                                    </div>

                                </div>
                            </td>

                            <td>Manager</td>

                            <td>
                                <span class="text-muted">
                                    Logistics
                                </span>
                            </td>

                            <td>20.02.2025</td>

                            <td>
                                <span class="badge text-bg-success">
                                    Active
                                </span>
                            </td>

                            <td class="text-end">
                                <div class="btn-group btn-group-sm">

                                    <button type="button"
                                        class="btn btn-outline-primary"
                                        title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <button type="button"
                                        class="btn btn-outline-danger"
                                        title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                </div>
                            </td>

                        </tr>

                        <!-- Employee #1 Details -->
                        <tr id="employee-1" class="accordion-details">
                            <td colspan="7">

                                <div class="accordion-content"
                                    data-accordion-content>

                                    <div class="p-3">

                                        <div class="row g-3">

                                            <div class="col-md-4">
                                                <small class="text-muted d-block">
                                                    Full Name
                                                </small>
                                                <strong>
                                                    Anton Semenov
                                                </strong>
                                            </div>

                                            <div class="col-md-4">
                                                <small class="text-muted d-block">
                                                    Email
                                                </small>
                                                <strong>
                                                    anton@example.com
                                                </strong>
                                            </div>

                                            <div class="col-md-4">
                                                <small class="text-muted d-block">
                                                    Phone
                                                </small>
                                                <strong>
                                                    +358 40 123 4567
                                                </strong>
                                            </div>

                                            <div class="col-md-4">
                                                <small class="text-muted d-block">
                                                    Position
                                                </small>
                                                <strong>
                                                    Manager
                                                </strong>
                                            </div>

                                            <div class="col-md-4">
                                                <small class="text-muted d-block">
                                                    Department
                                                </small>
                                                <strong>
                                                    Logistics
                                                </strong>
                                            </div>

                                            <div class="col-md-4">
                                                <small class="text-muted d-block">
                                                    Birthday
                                                </small>
                                                <strong>
                                                    20.02.2025
                                                </strong>
                                            </div>

                                        </div>

                                        <div class="mt-4">
                                            <small class="text-muted d-block mb-1">
                                                Additional Information
                                            </small>

                                            <div>
                                                Has access to warehouse keys
                                                and company vehicle.
                                            </div>
                                        </div>
                                        <!-- Documents -->
                                        <div class="mt-4">
                                            <div class="d-flex align-items-center justify-content-between mb-2"> <small class="text-muted"> Documents </small> <span class="badge text-bg-secondary"> 3 files </span> </div>
                                            <div class="list-group list-group-flush border rounded"> <!-- Passport -->
                                                <div class="list-group-item d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center"> <i class="bi bi-file-earmark-person fs-4 text-muted me-3"></i>
                                                        <div>
                                                            <div class="fw-semibold"> Passport </div> <small class="text-muted"> passport.pdf · 2.4 MB </small>
                                                        </div>
                                                    </div> <a href="<?= route_to('employees.document.view', 1) ?>" target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary"> <i class="bi bi-eye me-1"></i> View </a>
                                                </div> <!-- Employment Contract -->
                                                <div class="list-group-item d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center"> <i class="bi bi-file-earmark-text fs-4 text-muted me-3"></i>
                                                        <div>
                                                            <div class="fw-semibold"> Employment Contract </div> <small class="text-muted"> employment-contract.pdf · 1.8 MB </small>
                                                        </div>
                                                    </div> <a href="<?= route_to('employees.document.view', 2) ?>" target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary"> <i class="bi bi-eye me-1"></i> View </a>
                                                </div> <!-- Certificate -->
                                                <div class="list-group-item d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center"> <i class="bi bi-file-earmark-check fs-4 text-muted me-3"></i>
                                                        <div>
                                                            <div class="fw-semibold"> Certificate </div> <small class="text-muted"> certificate.pdf · 950 KB </small>
                                                        </div>
                                                    </div> <a href="<?= route_to('employees.document.view', 3) ?>" target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary"> <i class="bi bi-eye me-1"></i> View </a>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="d-flex justify-content-end gap-2">

                                            <button type="button"
                                                class="btn btn-sm btn-primary">
                                                <i class="bi bi-pencil me-1"></i>
                                                Edit Employee
                                            </button>

                                            <button type="button"
                                                class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash me-1"></i>
                                                Delete
                                            </button>

                                        </div>

                                    </div>

                                </div>



                            </td>
                        </tr>


                    </tbody>

                </table>

            </div>

            <!-- Card Footer -->
            <div class="card-footer clearfix">

                <div class="float-start text-muted small">
                    Showing 1–2 of 2 employees
                </div>

                <ul class="pagination pagination-sm m-0 float-end">

                    <li class="page-item disabled">
                        <a class="page-link" href="#">&laquo;</a>
                    </li>

                    <li class="page-item active">
                        <a class="page-link" href="#">1</a>
                    </li>

                    <li class="page-item disabled">
                        <a class="page-link" href="#">&raquo;</a>
                    </li>

                </ul>

            </div>

        </div>
    </div>
</div>

<!-- ========================================================= -->
<!-- NEW EMPLOYEE MODAL -->
<!-- ========================================================= -->

<div class="modal fade"
    id="employeeModal"
    tabindex="-1"
    aria-labelledby="employeeModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="employeeModalLabel">
                    <i class="bi bi-person-plus me-2"></i>
                    New Employee
                </h5>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">

                <div id="employee-message"></div>

                <form id="employeeForm"
                    method="post"
                    enctype="multipart/form-data"
                    hx-post="<?= route_to('employees.store') ?>"
                    hx-target="#employee-message"
                    hx-swap="innerHTML"
                    hx-indicator="#employee-spinner">
                    
                    <!-- ================================================= -->
                    <!-- PERSONAL INFORMATION -->
                    <!-- ================================================= -->

                    <h6 class="text-muted border-bottom pb-2 mb-3">
                        Personal Information
                    </h6>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="first_name" class="form-label">
                                First Name
                            </label>

                            <input type="text"
                                class="form-control"
                                id="first_name"
                                name="first_name"
                                maxlength="100"
                                autocomplete="given-name"
                                required>
                        </div>

                        <div class="col-md-6">
                            <label for="last_name" class="form-label">
                                Last Name
                            </label>

                            <input type="text"
                                class="form-control"
                                id="last_name"
                                name="last_name"
                                maxlength="100"
                                autocomplete="family-name"
                                required>
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">
                                Email
                            </label>

                            <input type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                maxlength="191"
                                autocomplete="email"
                                placeholder="email@example.com">

                            <div class="form-text">
                                Optional.
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="phone" class="form-label">
                                Phone
                            </label>

                            <input type="tel"
                                class="form-control"
                                id="phone"
                                name="phone"
                                maxlength="50"
                                autocomplete="tel"
                                placeholder="+358 ...">
                        </div>

                    </div>


                    <!-- ================================================= -->
                    <!-- EMPLOYMENT INFORMATION -->
                    <!-- ================================================= -->

                    <h6 class="text-muted border-bottom pb-2 mt-4 mb-3">
                        Employment Information
                    </h6>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="position" class="form-label">
                                Position
                            </label>

                            <input type="text"
                                class="form-control"
                                id="position"
                                name="position"
                                maxlength="100"
                                placeholder="e.g. Accountant">
                        </div>

                        <div class="col-md-6">
                            <label for="birthday" class="form-label">
                                Birthday
                            </label>

                            <input type="date"
                                class="form-control"
                                id="birthday"
                                name="birthday" required>
                        </div>

                    </div>


                    <!-- ================================================= -->
                    <!-- SYSTEM ACCESS -->
                    <!-- ================================================= -->

                    <h6 class="text-muted border-bottom pb-2 mt-4 mb-3">
                        System Access
                    </h6>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="role_id" class="form-label">
                                Role 
                                <pre><?= print_r($roles[0]) ?></pre>
                            </label>
                            
                            <select class="form-select"
                                id="role_id"
                                name="role_id"
                                required>

                                <?php foreach ($roles as $role): ?>
                                    <option value="<?= esc($role->id) ?>"
                                        data-system-access="<?= (int) $role->system_access ?>"
                                        <?= (int) $role->system_access === 0 ? 'selected' : '' ?>>
                                        <?= esc($role->name) ?>
                                    </option>
                                <?php endforeach; ?>

                            </select>

                            <div class="form-text" id="roleHelp">
                                Select a role to determine system access.
                            </div>
                        </div>


                        <div class="col-md-6">
                            <label for="username" class="form-label">
                                Username
                            </label>

                            <input type="text"
                                class="form-control"
                                id="username"
                                name="username"
                                maxlength="100"
                                autocomplete="off"                                
                                required>

                            <div class="form-text">
                                Generated automatically from first and last name.
                            </div>
                        </div>

                        <div class="col-md-8">

                            <label for="password" class="form-label">
                                Password
                            </label>

                            <div class="input-group">
                                <input type="password"
                                    class="form-control"
                                    id="password"
                                    name="password"
                                    autocomplete="new-password"
                                    placeholder="Generate password">

                                <button type="button"
                                    class="btn btn-outline-secondary"
                                    id="generatePassword">

                                    <i class="bi bi-shuffle me-1"></i>
                                    Generate
                                </button>
                            </div>
                        </div>

                        <div class="col-md-4 d-flex align-items-end">
                            <button type="button"
                                class="btn btn-outline-secondary w-100"
                                id="togglePassword">

                                <i class="bi bi-eye me-1"></i>
                                Show Password
                            </button>
                        </div>
                    </div>



                    <!-- ================================================= -->
                    <!-- DOCUMENTS -->
                    <!-- ================================================= -->

                    <h6 class="text-muted border-bottom pb-2 mt-4 mb-3">
                        Documents
                    </h6>

                    <div class="mb-3">

                        <label for="documents" class="form-label">
                            Employee Documents
                        </label>

                        <input type="file"
                            class="form-control"
                            id="documents"
                            name="documents[]"
                            multiple
                            accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">

                        <div class="form-text">
                            PDF, JPG, PNG, DOC and DOCX.
                        </div>

                    </div>

                    <div id="selectedDocuments"
                        class="list-group mb-3 d-none">
                    </div>


                    <!-- ================================================= -->
                    <!-- ADDITIONAL INFORMATION -->
                    <!-- ================================================= -->

                    <h6 class="text-muted border-bottom pb-2 mt-4 mb-3">
                        Additional Information
                    </h6>

                    <div class="mb-2">

                        <textarea class="form-control"
                            id="note"
                            name="note"
                            rows="4"
                            maxlength="5000"
                            placeholder="Enter any additional information about the employee..."></textarea>

                        <div class="form-text">
                            Additional notes about the employee.
                        </div>

                    </div>

                </form>
            </div>


            <!-- ========================================================= -->
            <!-- FOOTER -->
            <!-- ========================================================= -->

            <div class="modal-footer">

                <button type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    Cancel
                </button>

                <div id="employee-spinner"
                    class="htmx-indicator text-center py-2">
                    <div class="spinner-border spinner-border-sm me-2"></div>
                    Creating employee...
                </div>

                <button type="submit"
                    form="employeeForm"
                    class="btn btn-primary"
                    id="createEmployeeButton">
                    <i class="bi bi-check-lg me-1"></i>
                    Create Employee
                </button>

            </div>

        </div>
    </div>
</div>


<script>
    const EmployeeAccess = {

        init: function() {
            this.firstName = document.getElementById('first_name');
            this.lastName = document.getElementById('last_name');
            this.username = document.getElementById('username');

            this.role = document.getElementById('role_id');

            this.password = document.getElementById('password');
            this.generateButton = document.getElementById('generatePassword');
            this.toggleButton = document.getElementById('togglePassword');

            if (!this.role || !this.username) {
                return;
            }

            this.firstName?.addEventListener('input', () => {
                this.generateUsername();
            });

            this.lastName?.addEventListener('input', () => {
                this.generateUsername();
            });

            this.role.addEventListener('change', () => {
                this.update();
            });

            this.generateButton?.addEventListener('click', () => {
                this.generatePassword();
            });

            this.toggleButton?.addEventListener('click', () => {
                this.togglePassword();
            });

            this.generateUsername();
            this.update();
        },


        reset: function() {
            if (this.firstName) {
                this.firstName.value = '';
            }

            if (this.lastName) {
                this.lastName.value = '';
            }

            if (this.username) {
                this.username.value = '';
            }

            if (this.password) {
                this.password.value = '';
                this.password.type = 'password';
            }

            if (this.role) {
                const noAccessOption = Array.from(this.role.options)
                    .find(option => option.dataset.systemAccess === '0');

                if (noAccessOption) {
                    this.role.value = noAccessOption.value;
                } else {
                    this.role.selectedIndex = 0;
                }
            }

            this.update();
        },


        update: function() {
            const option = this.role?.options[this.role.selectedIndex];
            const enabled = option?.dataset.systemAccess === '1';

            if (this.password) {
                this.password.disabled = !enabled;
                this.password.required = enabled;

                if (!enabled) {
                    this.password.value = '';
                    this.password.type = 'password';
                }
            }

            if (this.generateButton) {
                this.generateButton.disabled = !enabled;
            }

            if (this.toggleButton) {
                this.toggleButton.disabled = !enabled;
            }

            if (this.toggleButton && !enabled) {
                this.toggleButton.innerHTML =
                    '<i class="bi bi-eye me-1"></i> Show Password';
            }

            if (enabled && this.password && !this.password.value) {
                this.generatePassword();
            }
        },


        generateUsername: function() 
        {
            const firstName = this.firstName?.value.trim() || '';
            const lastName = this.lastName?.value.trim() || '';

            if (!firstName || !lastName) {
                this.username.value = '';
                return;
            }

            let username = `${firstName}.${lastName}`;

            username = username 
                .toLowerCase() 
                .normalize('NFD') 
                .replace(/[\u0300-\u036f]/g, '') 
                .replace(/[^a-z0-9.-]/g, '') 
                .replace(/\.{2,}/g, '.') 
                .replace(/^-+|-+$/g, '') 
                .replace(/^\.+|\.+$/g, '');

            this.username.value = username.substring(0, 50);
        },


        generatePassword: function() {
            const option = this.role?.options[this.role.selectedIndex];

            if (option?.dataset.systemAccess !== '1' || !this.password) {
                return;
            }

            const chars =
                'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz23456789!@#$%';

            const array = new Uint32Array(8);
            crypto.getRandomValues(array);

            let password = '';

            for (let i = 0; i < array.length; i++) {
                password += chars[array[i] % chars.length];
            }

            this.password.value = password;
            this.password.type = 'text';

            if (this.toggleButton) {
                this.toggleButton.innerHTML =
                    '<i class="bi bi-eye-slash me-1"></i> Hide Password';
            }
        },


        togglePassword: function() {
            if (!this.password || !this.toggleButton) {
                return;
            }

            const option = this.role?.options[this.role.selectedIndex];

            if (option?.dataset.systemAccess !== '1') {
                return;
            }

            if (this.password.type === 'password') {

                this.password.type = 'text';

                this.toggleButton.innerHTML =
                    '<i class="bi bi-eye-slash me-1"></i> Hide Password';

            } else {

                this.password.type = 'password';

                this.toggleButton.innerHTML =
                    '<i class="bi bi-eye me-1"></i> Show Password';
            }
        }

    };


    const Documents = {

        selectedFiles: [],


        init: function() {
            this.input = document.getElementById('documents');
            this.list = document.getElementById('selectedDocuments');

            if (!this.input || !this.list) {
                return;
            }

            this.input.addEventListener('change', event => {
                this.addFiles(event.target.files);
            });

            this.updateList();
        },


        reset: function() {
            this.selectedFiles = [];

            if (this.input) {
                this.input.value = '';
            }

            this.updateList();
        },


        addFiles: function(files) {
            if (!files?.length) {
                return;
            }

            this.selectedFiles = [
                ...this.selectedFiles,
                ...Array.from(files)
            ];

            this.syncInput();
            this.updateList();
        },


        remove: function(index) {
            if (index < 0 || index >= this.selectedFiles.length) {
                return;
            }

            this.selectedFiles.splice(index, 1);

            this.syncInput();
            this.updateList();
        },


        syncInput: function() {
            if (!this.input || typeof DataTransfer === 'undefined') {
                return;
            }

            const dataTransfer = new DataTransfer();

            this.selectedFiles.forEach(file => {
                dataTransfer.items.add(file);
            });

            this.input.files = dataTransfer.files;
        },


        updateList: function() {
            if (!this.list) {
                return;
            }

            this.list.innerHTML = '';

            if (!this.selectedFiles.length) {
                this.list.classList.add('d-none');
                return;
            }

            this.list.classList.remove('d-none');

            this.selectedFiles.forEach((file, index) => {

                const row = document.createElement('div');

                row.className =
                    'list-group-item d-flex align-items-center justify-content-between';

                row.innerHTML = `
                <div class="d-flex align-items-center">
                    <i class="bi bi-file-earmark-text fs-4 me-3 text-muted"></i>

                    <div>
                        <div class="fw-semibold">
                            ${this.escapeHtml(file.name)}
                        </div>

                        <small class="text-muted">
                            ${this.formatFileSize(file.size)}
                        </small>
                    </div>
                </div>

                <button type="button"
                        class="btn btn-sm btn-outline-danger"
                        data-index="${index}"
                        title="Remove">
                    <i class="bi bi-x-lg"></i>
                </button>
            `;

                row.querySelector('button')?.addEventListener('click', () => {
                    this.remove(index);
                });

                this.list.appendChild(row);
            });
        },


        formatFileSize: function(bytes) {
            if (bytes < 1024) {
                return `${bytes} B`;
            }

            if (bytes < 1024 * 1024) {
                return `${(bytes / 1024).toFixed(1)} KB`;
            }

            return `${(bytes / (1024 * 1024)).toFixed(1)} MB`;
        },


        escapeHtml: function(value) {
            const div = document.createElement('div');

            div.textContent = value;

            return div.innerHTML;
        }

    };


    document.addEventListener('DOMContentLoaded', function() {

        EmployeeAccess.init();
        Documents.init();

        const modal = document.getElementById('employeeModal');

        modal?.addEventListener('hidden.bs.modal', function() {
            document.getElementById('employeeForm')?.reset();
            document.getElementById('employee-message').innerHTML = '';

            EmployeeAccess.reset();
            Documents.reset();
        });

    });
</script>

<?= $this->endSection() ?>