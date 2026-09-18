```php
<?= $this->extend('layouts/main') ?>
<?= $this->section('headerContentModule') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-12 col-xl-10">
        <div id="employee-message"></div>
            <form id="employeeForm"
                method="post"
                action="<?= route_to('employees.store') ?>"
                enctype="multipart/form-data"
                hx-post="<?= route_to('employees.store') ?>"
                hx-target="#employee-message"
                hx-swap="innerHTML">
                
            <!-- ===================================================== -->
            <!-- PAGE HEADER -->
            <!-- ===================================================== -->
            <div class="card mb-4">
                <div class="card-header border-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="card-title mb-1">
                                <i class="bi bi-person-plus me-2"></i>
                                New Employee
                            </h3>
                            <div class="clearfix"></div>
                            <div class="text-muted small">Create a new employee and optionally grant system access.</div>
                        </div>
                        <a href="<?= route_to('employees.index') ?>" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-arrow-left me-1"></i>
                            Back
                        </a>
                    </div>
                </div>
            </div>

            <!-- ===================================================== -->
            <!-- PERSONAL INFORMATION -->
            <!-- ===================================================== -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-person me-2"></i>
                        Personal Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <!-- First Name -->
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">
                                First Name <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   class="form-control"
                                   id="first_name"
                                   name="first_name"
                                   value="<?= old('first_name') ?>"
                                   required
                                   autocomplete="given-name"
                                   pattern="<?= $rules['name'] ?? '' ?>">
                        </div>

                        <!-- Last Name -->
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">
                                Last Name <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   class="form-control"
                                   id="last_name"
                                   name="last_name"
                                   value="<?= old('last_name') ?>"
                                   required
                                   autocomplete="family-name"
                                   pattern="<?= $rules['name'] ?? '' ?>">
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email"
                                   class="form-control"
                                   id="email"
                                   name="email"
                                   value="<?= old('email') ?>"
                                   placeholder="email@example.com"
                                   autocomplete="email">
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel"
                                   class="form-control"
                                   id="phone"
                                   name="phone"
                                   value="<?= old('phone') ?>"
                                   placeholder="+358 ..."
                                   autocomplete="tel"
                                   pattern="<?= $rules['phone'] ?? '' ?>">>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===================================================== -->
            <!-- EMPLOYMENT INFORMATION -->
            <!-- ===================================================== -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-briefcase me-2"></i>
                        Employment Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <!-- Position -->
                        <div class="col-md-6">
                            <label for="position" class="form-label">Position</label>
                            <input type="text"
                                   class="form-control"
                                   id="position"
                                   name="position"
                                   value="<?= old('position') ?>"
                                   placeholder="e.g. Accountant"
                                   pattern="<?= $rules['name'] ?? '' ?>">
                        </div>

                        <!-- Birthday Date -->
                        <div class="col-md-6">
                            <label for="birthday" class="form-label">
                                Birthday<span class="text-danger">*</span>
                            </label>
                            <input type="date"
                                   class="form-control"
                                   id="birthday"
                                   name="birthday"
                                   value="<?= old('birthday', date('Y-m-d')) ?>"
                                   required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===================================================== -->
            <!-- SYSTEM ACCESS -->
            <!-- ===================================================== -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-shield-lock me-2"></i>
                        System Access
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Enable Access -->
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input"
                               type="checkbox"
                               role="switch"
                               id="enable_access"
                               name="enable_access"
                               value="1"
                               <?= old('enable_access') ? 'checked' : '' ?>>
                        <label class="form-check-label fw-semibold" for="enable_access">
                            Enable system access
                        </label>
                        <div class="form-text">Allow this employee to log in to the system.</div>
                    </div>

                    <!-- System Access Fields -->
                    <div id="systemAccessFields">
                        <div class="row g-3">
                            <!-- Role -->
                            <div class="col-md-6">
                                <label for="role_id" class="form-label">
                                    Role <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" id="role_id" name="role_id">
                                    <option value="" selected disabled>Select role</option>
                                    <?php foreach ($roles as $role): ?>
                                        <option value="<?= esc($role->id) ?>"
                                            <?= old('role_id') == $role->id ? 'selected' : '' ?>>
                                            <?= esc($role->name) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="form-text">Determines the employee's system permissions.</div>
                            </div>

                            <!-- Username -->
                            <div class="col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text"
                                       class="form-control"
                                       id="username"
                                       name="username"
                                       value="<?= old('username') ?>">
                                <div class="form-text">Generated automatically from first and last name.</div>
                            </div>

                            <!-- Password -->
                            <div class="col-md-8">
                                <label for="password" class="form-label">
                                    Password <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="password"
                                           class="form-control"
                                           id="password"
                                           name="password"
                                           autocomplete="new-password"
                                           placeholder="Enter password">
                                    <button type="button"
                                            class="btn btn-outline-secondary"
                                            id="generatePassword">
                                        <i class="bi bi-shuffle me-1"></i>
                                        Generate
                                    </button>
                                </div>
                            </div>

                            <!-- Show Password -->
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="button"
                                        class="btn btn-outline-secondary w-100"
                                        id="togglePassword">
                                    <i class="bi bi-eye me-1"></i>
                                    Show Password
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===================================================== -->
            <!-- DOCUMENTS -->
            <!-- ===================================================== -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-folder2-open me-2"></i>
                        Documents
                    </h5>
                </div>
                <div class="card-body">
                    <label for="documents" class="form-label">Employee Documents</label>
                    <input type="file"
                           class="form-control"
                           id="documents"
                           name="documents[]"
                           multiple
                           accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                    <div class="form-text">You can select multiple documents. PDF, JPG, PNG, DOC and DOCX.</div>

                    <!-- Selected Documents -->
                    <div id="selectedDocuments" class="list-group mt-3 d-none"></div>
                </div>
            </div>

            <!-- ===================================================== -->
            <!-- ADDITIONAL INFORMATION -->
            <!-- ===================================================== -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-card-text me-2"></i>
                        Additional Information
                    </h5>
                </div>
                <div class="card-body">
                    <label for="note" class="form-label">Notes</label>
                    <textarea class="form-control"
                              id="note"
                              name="note"
                              rows="5"
                              placeholder="Enter any additional information about the employee..."><?= old('note') ?></textarea>
                    <div class="form-text">Internal notes about the employee.</div>
                </div>
            </div>

            <!-- ===================================================== -->
            <!-- ACTIONS -->
            <!-- ===================================================== -->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="<?= route_to('employees.index') ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-x-lg me-1"></i>
                            Cancel
                        </a>
                        <button type="submit"
                            id="submitEmployee"
                            class="btn btn-primary">
                            <span class="submit-text">
                                <i class="bi bi-check-lg me-1"></i>
                                Create Employee
                            </span>
                            <span class="submit-spinner d-none">
                                <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                                Creating...
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<style>
.htmx-indicator {
    display: none;
}
.htmx-request .htmx-indicator,
.htmx-request.htmx-indicator {
    display: inline-block;
}
.htmx-request .submit-text {
    display: none;
}
</style>
<!-- ============================================================= -->
<!-- JAVASCRIPT -->
<!-- ============================================================= -->
<script>
/*
 * =============================================================
 * EMPLOYEE ACCESS
 * =============================================================
 */
const EmployeeAccess = {
    elements: {},
    form: null,
    submitButton: null,

    init() {
        this.form = document.getElementById('employeeForm');
        this.submitButton = document.getElementById('submitEmployee');

        this.elements = {
            enableAccess: document.getElementById('enable_access'),
            accessFields: document.getElementById('systemAccessFields'),
            firstName: document.getElementById('first_name'),
            lastName: document.getElementById('last_name'),
            username: document.getElementById('username'),
            role: document.getElementById('role_id'),
            password: document.getElementById('password'),
            generatePassword: document.getElementById('generatePassword'),
            togglePassword: document.getElementById('togglePassword')
        };

        if (!this.elements.enableAccess) return;

        this.elements.enableAccess.addEventListener('change', () => this.update());
        this.elements.firstName?.addEventListener('input', () => this.generateUsername());
        this.elements.lastName?.addEventListener('input', () => this.generateUsername());
        this.elements.generatePassword?.addEventListener('click', () => this.generatePassword());
        this.elements.togglePassword?.addEventListener('click', () => this.togglePassword());

        this.form?.addEventListener('htmx:beforeRequest', () => {
            if (this.submitButton) {
                this.submitButton.disabled = true;
                this.submitButton.querySelector('.submit-text')?.classList.add('d-none');
                this.submitButton.querySelector('.submit-spinner')?.classList.remove('d-none');
            }
        });

        this.form?.addEventListener('htmx:afterRequest', () => {
            if (this.submitButton) {
                this.submitButton.disabled = false;
                this.submitButton.querySelector('.submit-text')?.classList.remove('d-none');
                this.submitButton.querySelector('.submit-spinner')?.classList.add('d-none');
            }
        });

        this.generateUsername();
        this.update();
    },

    update() {
        const enabled = this.elements.enableAccess.checked;

        this.elements.accessFields?.classList.toggle('d-none', !enabled);

        if (this.elements.role) {
            this.elements.role.disabled = !enabled;
            this.elements.role.required = enabled;
        }

        if (this.elements.username) {
            this.elements.username.disabled = !enabled;
            this.elements.username.required = enabled;
        }

        if (this.elements.password) {
            this.elements.password.disabled = !enabled;
            this.elements.password.required = enabled;
        }

        if (this.elements.generatePassword) {
            this.elements.generatePassword.disabled = !enabled;
        }

        if (this.elements.togglePassword) {
            this.elements.togglePassword.disabled = !enabled;
        }

        if (enabled) {
            this.generateUsername();
            return;
        }

        if (this.elements.password) {
            this.elements.password.value = '';
            this.elements.password.type = 'password';

            const icon = this.elements.togglePassword?.querySelector('i');
            icon?.classList.remove('bi-eye-slash');
            icon?.classList.add('bi-eye');
        }
    },

    generateUsername() {
        if (!this.elements.enableAccess?.checked) return;

        const firstName = this.normalizeName(this.elements.firstName?.value);
        const lastName = this.normalizeName(this.elements.lastName?.value);

        if (!firstName || !lastName) {
            if (this.elements.username) {
                this.elements.username.value = '';
            }
            return;
        }

        this.elements.username.value = `${firstName}.${lastName}`.substring(0, 100);
    },

    normalizeName(value) {
        return value
            .trim()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '_')
            .replace(/^_+|_+$/g, '');
    },

    generatePassword() {
        if (!this.elements.password || this.elements.password.disabled) return;

        const upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        const lower = 'abcdefghijklmnopqrstuvwxyz';
        const numbers = '0123456789';
        const special = '!@#$%^&*';
        const all = upper + lower + numbers + special;
        const values = new Uint32Array(16);

        crypto.getRandomValues(values);

        this.elements.password.value = Array.from(values, value => all[value % all.length]).join('');
        this.elements.password.type = 'text';

        const icon = this.elements.togglePassword?.querySelector('i');
        icon?.classList.remove('bi-eye');
        icon?.classList.add('bi-eye-slash');
    },

    togglePassword() {
        if (!this.elements.password || this.elements.password.disabled) return;
        if (!this.elements.password.value) return;

        const visible = this.elements.password.type === 'text';
        this.elements.password.type = visible ? 'password' : 'text';

        const icon = this.elements.togglePassword?.querySelector('i');
        icon?.classList.toggle('bi-eye', visible);
        icon?.classList.toggle('bi-eye-slash', !visible);
    }
};
/*
 * =============================================================
 * DOCUMENTS
 * =============================================================
 */
const Documents = {
    elements: {},
    selectedFiles: [],

    init() {
        this.elements = {
            input: document.getElementById('documents'),
            list: document.getElementById('selectedDocuments')
        };

        if (!this.elements.input || !this.elements.list) {
            return;
        }

        this.elements.input.addEventListener('change', event => {
            this.addFiles(event.target.files);
        });

        this.updateList();
    },

    /* ---------------------------------------------------------
     * ADD FILES
     * --------------------------------------------------------- */
    addFiles(fileList) {
        if (!fileList?.length) {
            return;
        }

        Array.from(fileList).forEach(file => {
            const exists = this.selectedFiles.some(selectedFile =>
                selectedFile.name === file.name &&
                selectedFile.size === file.size &&
                selectedFile.lastModified === file.lastModified
            );

            if (!exists) {
                this.selectedFiles.push(file);
            }
        });

        this.syncInput();
        this.updateList();
    },

    /* ---------------------------------------------------------
     * REMOVE FILE
     * --------------------------------------------------------- */
    remove(index) {
        if (index < 0 || index >= this.selectedFiles.length) {
            return;
        }

        this.selectedFiles.splice(index, 1);
        this.syncInput();
        this.updateList();
    },

    /* ---------------------------------------------------------
     * SYNC INPUT
     * --------------------------------------------------------- */
    syncInput() {
        const input = this.elements.input;

        if (!input) {
            return;
        }

        const dataTransfer = new DataTransfer();

        this.selectedFiles.forEach(file => {
            dataTransfer.items.add(file);
        });

        input.files = dataTransfer.files;
    },

    /* ---------------------------------------------------------
     * UPDATE VISUAL LIST
     * --------------------------------------------------------- */
    updateList() {
        const list = this.elements.list;

        if (!list) {
            return;
        }

        list.innerHTML = '';

        if (this.selectedFiles.length === 0) {
            list.classList.add('d-none');
            return;
        }

        list.classList.remove('d-none');

        this.selectedFiles.forEach((file, index) => {
            const item = document.createElement('div');
            item.className = 'list-group-item d-flex align-items-center justify-content-between';

            /* Left side */
            const info = document.createElement('div');
            info.className = 'd-flex align-items-center min-width-0';

            /* File icon */
            const icon = document.createElement('i');
            icon.className = 'bi bi-file-earmark-text fs-4 text-muted me-3';

            /* File information */
            const details = document.createElement('div');
            details.className = 'text-truncate';

            /* File name */
            const name = document.createElement('div');
            name.className = 'fw-semibold text-truncate';
            name.textContent = file.name;

            /* File size */
            const size = document.createElement('small');
            size.className = 'text-muted';
            size.textContent = this.formatFileSize(file.size);

            details.appendChild(name);
            details.appendChild(size);
            info.appendChild(icon);
            info.appendChild(details);

            /* Remove button */
            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'btn btn-sm btn-outline-danger ms-3';
            removeButton.title = 'Remove file';
            removeButton.setAttribute('aria-label', `Remove ${file.name}`);
            removeButton.innerHTML = '<i class="bi bi-trash"></i>';
            removeButton.addEventListener('click', () => this.remove(index));

            /* Build row */
            item.appendChild(info);
            item.appendChild(removeButton);
            list.appendChild(item);
        });
    },

    /* ---------------------------------------------------------
     * FILE SIZE
     * --------------------------------------------------------- */
    formatFileSize(bytes) {
        if (bytes < 1024) {
            return `${bytes} B`;
        }

        if (bytes < 1024 * 1024) {
            return `${(bytes / 1024).toFixed(1)} KB`;
        }

        if (bytes < 1024 * 1024 * 1024) {
            return `${(bytes / (1024 * 1024)).toFixed(1)} MB`;
        }

        return `${(bytes / (1024 * 1024 * 1024)).toFixed(1)} GB`;
    },

    /* ---------------------------------------------------------
     * RESET
     * --------------------------------------------------------- */
    reset() {
        this.selectedFiles = [];

        if (this.elements.input) {
            this.elements.input.value = '';
        }

        this.updateList();
    }
};

/*
 * =============================================================
 * EMPLOYEE CREATE
 * =============================================================
 */
const EmployeeCreate = {
    form: null,

    init() {
        this.form = document.getElementById('employeeForm');

        if (!this.form) {
            return;
        }
    },

    reset() {
        if (this.form) {
            this.form.reset();
        }

        EmployeeAccess.reset?.();
        Documents.reset();
    }
};

/*
 * =============================================================
 * INITIALIZATION
 * =============================================================
 */
document.addEventListener('DOMContentLoaded', () => {
    EmployeeAccess.init();
    Documents.init();
    EmployeeCreate.init();
});
</script>

<?= $this->endSection() ?>
