<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Employee</h3>
        </div>

        <div class="card-body">
            <div id="employee-message"></div>

            <form id="employeeForm"
                  method="post"
                  action="<?= route_to('employees.update', $employee->id) ?>"
                  enctype="multipart/form-data"
                  hx-post="<?= route_to('employees.update', $employee->id) ?>"
                  hx-target="#employee-message"
                  hx-swap="innerHTML">

                <?= csrf_field() ?>

                <div class="row g-3">
                    <div class="col-12">
                        <h5 class="mb-3">Personal Information</h5>
                    </div>

                    <div class="col-md-6">
                        <label for="first_name" class="form-label">
                            First Name
                        </label>
                        <input type="text"
                               class="form-control"
                               id="first_name"
                               name="first_name"
                               value="<?= esc(old('first_name', $employee->first_name)) ?>"
                               maxlength="100"
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
                               value="<?= esc(old('last_name', $employee->last_name)) ?>"
                               maxlength="100"
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
                               value="<?= esc(old('email', $employee->email)) ?>"
                               maxlength="255">
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label">
                            Phone
                        </label>
                        <input type="text"
                               class="form-control"
                               id="phone"
                               name="phone"
                               value="<?= esc(old('phone', $employee->phone)) ?>">
                    </div>

                    <div class="col-12 mt-4">
                        <h5 class="mb-3">Employment Information</h5>
                    </div>

                    <div class="col-md-6">
                        <label for="position" class="form-label">
                            Position
                        </label>
                        <input type="text"
                               class="form-control"
                               id="position"
                               name="position"
                               value="<?= esc(old('position', $employee->position)) ?>"
                               maxlength="150">
                    </div>

                    <div class="col-md-6">
                        <label for="birthday" class="form-label">
                            Birthday
                        </label>
                        <input type="date"
                               class="form-control"
                               id="birthday"
                               name="birthday"
                               value="<?= esc(old('birthday', $employee->birthday)) ?>"
                               required>
                    </div>

                    <div class="col-md-6">
                        <label for="status" class="form-label">
                            Status
                        </label>
                        <select class="form-select"
                                id="status"
                                name="status">
                            <option value="active"
                                <?= old('status', $employee->status) === 'active' ? 'selected' : '' ?>>
                                Active
                            </option>
                            <option value="inactive"
                                <?= old('status', $employee->status) === 'inactive' ? 'selected' : '' ?>>
                                Inactive
                            </option>
                            <option value="terminated"
                                <?= old('status', $employee->status) === 'terminated' ? 'selected' : '' ?>>
                                Terminated
                            </option>
                        </select>
                    </div>

                    <div class="col-12 mt-4">
                        <h5 class="mb-3">System Access</h5>
                    </div>

                    <?php
                    $hasUser = $user !== null;
                    $accessEnabled = old('enable_access', $hasUser ? '1' : '0');
                    ?>

                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input"
                                   type="checkbox"
                                   role="switch"
                                   id="enable_access"
                                   name="enable_access"
                                   value="1"
                                   <?= $accessEnabled ? 'checked' : '' ?>>
                            <label class="form-check-label" for="enable_access">
                                Enable system access
                            </label>
                        </div>
                    </div>

                    <div id="access-fields" class="row g-3 <?= $accessEnabled ? '' : 'd-none' ?>">
                        <div class="col-md-6">
                            <label for="role_id" class="form-label">
                                Role
                            </label>

                            <select class="form-select"
                                    id="role_id"
                                    name="role_id">
                                <?php foreach ($roles as $role): ?>
                                    <option value="<?= esc($role->id) ?>"
                                        <?= (string) old('role_id', $user?->role_id) === (string) $role->id ? 'selected' : '' ?>>
                                        <?= esc($role->name) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="username" class="form-label">
                                Username
                            </label>

                            <input type="text"
                                   class="form-control"
                                   id="username"
                                   name="username"
                                   value="<?= esc(old('username', $user?->username)) ?>"
                                   maxlength="100">
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label">
                                Password
                            </label>

                            <div class="input-group">
                                <input type="password"
                                       class="form-control"
                                       id="password"
                                       name="password"
                                       autocomplete="new-password"
                                       placeholder="Leave empty to keep current password">

                                <button type="button"
                                        class="btn btn-outline-secondary"
                                        id="generatePassword">
                                    Generate
                                </button>

                                <button type="button"
                                        class="btn btn-outline-secondary"
                                        id="showPassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <h5 class="mb-3">Documents</h5>
                    </div>

                    <?php if (!empty($documents)): ?>
                        <div class="col-12">
                            <label class="form-label">
                                Existing Documents
                            </label>

                            <div class="list-group mb-3">
                                <?php foreach ($documents as $document): ?>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="fw-semibold">
                                                <?= esc($document->title) ?>
                                            </div>

                                            <small class="text-muted">
                                                <?= esc($document->mime_type ?? 'Unknown') ?>

                                                <?php if ($document->file_size !== null): ?>
                                                    · <?= number_format($document->file_size / 1024, 1) ?> KB
                                                <?php endif; ?>
                                            </small>
                                        </div>

                                        <a href="<?= route_to('employees.document', $document->file_name) ?>"
                                           class="btn btn-sm btn-outline-primary"
                                           target="_blank">
                                            <i class="bi bi-box-arrow-up-right"></i>
                                            Open
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="col-12">
                        <label for="documents" class="form-label">
                            Add Documents
                        </label>

                        <input type="file"
                               class="form-control"
                               id="documents"
                               name="documents[]"
                               multiple
                               accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">

                        <div class="form-text">
                            Maximum file size: 10 MB.
                            Allowed formats: PDF, JPG, JPEG, PNG, DOC, DOCX.
                        </div>

                        <div id="selectedDocuments" class="list-group mt-3"></div>
                    </div>

                    <div class="col-12 mt-4">
                        <label for="note" class="form-label">
                            Additional Information
                        </label>

                        <textarea class="form-control"
                                  id="note"
                                  name="note"
                                  rows="4"
                                  maxlength="5000"><?= esc(old('note', $employee->note)) ?></textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="<?= route_to('employees.index') ?>"
                       class="btn btn-secondary">
                        Cancel
                    </a>

                    <button type="submit"
                            class="btn btn-primary"
                            id="submitEmployee">
                        <span class="spinner-border spinner-border-sm d-none"
                              id="submitSpinner"
                              role="status"></span>
                        <span id="submitText">Update Employee</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const EmployeeAccess = {
    init() {
        this.checkbox = document.getElementById('enable_access');
        this.fields = document.getElementById('access-fields');
        this.firstName = document.getElementById('first_name');
        this.lastName = document.getElementById('last_name');
        this.username = document.getElementById('username');
        this.password = document.getElementById('password');
        this.showPassword = document.getElementById('showPassword');
        this.generatePassword = document.getElementById('generatePassword');

        this.checkbox?.addEventListener('change', () => this.toggle());
        this.generatePassword?.addEventListener('click', () => this.generate());
        this.showPassword?.addEventListener('click', () => this.togglePassword());

        this.toggle();
    },

    toggle() {
        if (!this.fields || !this.checkbox) return;

        this.fields.classList.toggle('d-none', !this.checkbox.checked);

        if (this.checkbox.checked && !this.username.value.trim()) {
            this.generateUsername();
        }
    },

    generateUsername() {
        if (!this.username || !this.firstName || !this.lastName) return;

        const firstName = this.normalize(this.firstName.value);
        const lastName = this.normalize(this.lastName.value);

        if (!firstName || !lastName) return;

        this.username.value = `${firstName}_${lastName}`;
    },

    normalize(value) {
        return value
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '_')
            .replace(/^_+|_+$/g, '');
    },

    generate() {
        if (!this.password) return;

        const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz23456789!@#$%';
        const values = new Uint32Array(16);
        crypto.getRandomValues(values);

        let password = '';

        values.forEach(value => {
            password += chars[value % chars.length];
        });

        this.password.value = password;
        this.password.type = 'text';
    },

    togglePassword() {
        if (!this.password || !this.showPassword) return;

        const icon = this.showPassword.querySelector('i');
        const visible = this.password.type === 'text';

        this.password.type = visible ? 'password' : 'text';

        icon?.classList.toggle('bi-eye', visible);
        icon?.classList.toggle('bi-eye-slash', !visible);
    }
};

const Documents = {
    selectedFiles: [],

    init() {
        this.input = document.getElementById('documents');
        this.list = document.getElementById('selectedDocuments');

        this.input?.addEventListener('change', (event) => {
            this.add(event.target.files);
        });
    },

    add(files) {
        Array.from(files).forEach(file => {
            const exists = this.selectedFiles.some(
                selected => selected.name === file.name &&
                    selected.size === file.size &&
                    selected.lastModified === file.lastModified
            );

            if (!exists) {
                this.selectedFiles.push(file);
            }
        });

        this.sync();
        this.updateList();
    },

    remove(index) {
        this.selectedFiles.splice(index, 1);
        this.sync();
        this.updateList();
    },

    sync() {
        if (!this.input) return;

        const dataTransfer = new DataTransfer();

        this.selectedFiles.forEach(file => {
            dataTransfer.items.add(file);
        });

        this.input.files = dataTransfer.files;
    },

    updateList() {
        if (!this.list) return;

        this.list.innerHTML = '';

        this.selectedFiles.forEach((file, index) => {
            const item = document.createElement('div');

            item.className = 'list-group-item d-flex justify-content-between align-items-center';

            item.innerHTML = `
                <div>
                    <div class="fw-semibold">${this.escape(file.name)}</div>
                    <small class="text-muted">${this.formatFileSize(file.size)}</small>
                </div>
                <button type="button"
                        class="btn btn-sm btn-outline-danger"
                        data-document-remove="${index}">
                    <i class="bi bi-trash"></i>
                </button>
            `;

            this.list.appendChild(item);
        });

        this.list.querySelectorAll('[data-document-remove]').forEach(button => {
            button.addEventListener('click', () => {
                this.remove(Number(button.dataset.documentRemove));
            });
        });
    },

    formatFileSize(size) {
        if (size < 1024) return `${size} B`;
        if (size < 1024 * 1024) return `${(size / 1024).toFixed(1)} KB`;
        return `${(size / (1024 * 1024)).toFixed(1)} MB`;
    },

    escape(value) {
        const div = document.createElement('div');
        div.textContent = value;
        return div.innerHTML;
    },

    reset() {
        this.selectedFiles = [];

        if (this.input) {
            this.input.value = '';
        }

        this.updateList();
    }
};

const EmployeeEdit = {
    init() {
        this.form = document.getElementById('employeeForm');

        document.body.addEventListener('htmx:beforeRequest', event => {
            if (event.detail.elt !== this.form) return;
            this.loading(true);
        });

        document.body.addEventListener('htmx:afterRequest', event => {
            if (event.detail.elt !== this.form) return;
            this.loading(false);
        });
    },

    loading(state) {
        const button = document.getElementById('submitEmployee');
        const spinner = document.getElementById('submitSpinner');
        const text = document.getElementById('submitText');

        if (!button) return;

        button.disabled = state;
        spinner?.classList.toggle('d-none', !state);

        if (text) {
            text.textContent = state
                ? 'Updating...'
                : 'Update Employee';
        }
    }
};

EmployeeAccess.init();
Documents.init();
EmployeeEdit.init();
</script>

<?= $this->endSection() ?>