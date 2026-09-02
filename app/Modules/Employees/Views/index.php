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
                            <th>Hire Date</th>
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
                                                    Hire Date
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

                        <!-- Employee #2 -->
                        <tr class="accordion-row"
                            data-accordion-row
                            data-accordion-target="employee-2">

                            <td>
                                <i class="bi bi-chevron-right accordion-icon"
                                    data-accordion-icon></i>
                            </td>

                            <td>
                                <div class="d-flex align-items-center">

                                    <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                        style="width:40px;height:40px;">
                                        <strong>JD</strong>
                                    </div>

                                    <div>
                                        <div class="fw-semibold">
                                            John Doe
                                        </div>
                                        <small class="text-muted">
                                            john@example.com
                                        </small>
                                    </div>

                                </div>
                            </td>

                            <td>Warehouse Manager</td>

                            <td>
                                <span class="text-muted">
                                    Warehouse
                                </span>
                            </td>

                            <td>12.05.2024</td>

                            <td>
                                <span class="badge text-bg-success">
                                    Active
                                </span>
                            </td>

                            <td class="text-end">

                                <div class="btn-group btn-group-sm">

                                    <button type="button"
                                        class="btn btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <button type="button"
                                        class="btn btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                </div>

                            </td>

                        </tr>

                        <!-- Employee #2 Details -->
                        <tr id="employee-2" class="accordion-details">

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
                                                    John Doe
                                                </strong>
                                            </div>

                                            <div class="col-md-4">
                                                <small class="text-muted d-block">
                                                    Email
                                                </small>
                                                <strong>
                                                    john@example.com
                                                </strong>
                                            </div>

                                            <div class="col-md-4">
                                                <small class="text-muted d-block">
                                                    Phone
                                                </small>
                                                <strong>
                                                    +358 50 555 1234
                                                </strong>
                                            </div>

                                            <div class="col-md-4">
                                                <small class="text-muted d-block">
                                                    Position
                                                </small>
                                                <strong>
                                                    Warehouse Manager
                                                </strong>
                                            </div>

                                            <div class="col-md-4">
                                                <small class="text-muted d-block">
                                                    Department
                                                </small>
                                                <strong>
                                                    Warehouse
                                                </strong>
                                            </div>

                                            <div class="col-md-4">
                                                <small class="text-muted d-block">
                                                    Hire Date
                                                </small>
                                                <strong>
                                                    12.05.2024
                                                </strong>
                                            </div>

                                        </div>

                                        <div class="mt-4">
                                            <small class="text-muted d-block mb-1">
                                                Additional Information
                                            </small>

                                            <div class="text-muted">
                                                No additional information.
                                            </div>
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

                <form id="employeeForm"
                    method="post"
                    enctype="multipart/form-data">

                    <!-- Personal Information -->
                    <h6 class="text-muted border-bottom pb-2 mb-3">
                        Personal Information
                    </h6>

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label for="first_name" class="form-label">
                                First Name
                            </label>

                            <input type="text"
                                class="form-control"
                                id="first_name"
                                name="first_name"
                                required>
                        </div>

                        <div class="col-md-4">
                            <label for="last_name" class="form-label">
                                Last Name
                            </label>

                            <input type="text"
                                class="form-control"
                                id="last_name"
                                name="last_name"
                                required>
                        </div>

                        <div class="col-md-4">
                            <label for="middle_name" class="form-label">
                                Middle Name
                            </label>

                            <input type="text"
                                class="form-control"
                                id="middle_name"
                                name="middle_name">
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">
                                Email
                            </label>

                            <input type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                placeholder="email@example.com"
                                required>
                        </div>

                        <div class="col-md-6">
                            <label for="phone" class="form-label">
                                Phone
                            </label>

                            <input type="text"
                                class="form-control"
                                id="phone"
                                name="phone"
                                placeholder="+358 ...">
                        </div>

                    </div>


                    <!-- Employment Information -->
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
                                placeholder="e.g. Accountant">
                        </div>

                        <div class="col-md-6">
                            <label for="department" class="form-label">
                                Department
                            </label>

                            <input type="text"
                                class="form-control"
                                id="department"
                                name="department"
                                placeholder="e.g. Accounting">
                        </div>

                        <div class="col-md-6">
                            <label for="hire_date" class="form-label">
                                Hire Date
                            </label>

                            <input type="date"
                                class="form-control"
                                id="hire_date"
                                name="hire_date">
                        </div>

                    </div>


                    <!-- System Access -->
                    <h6 class="text-muted border-bottom pb-2 mt-4 mb-3">
                        System Access
                    </h6>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="username" class="form-label">
                                Username
                            </label>

                            <input type="text"
                                class="form-control"
                                id="username"
                                name="username"
                                autocomplete="off"
                                placeholder="Username">
                        </div>

                        <div class="col-md-6">
                            <label for="role_id" class="form-label">
                                Role
                            </label>

                            <select class="form-select"
                                id="role_id"
                                name="role_id">

                                <option value="" selected disabled>
                                    Select role
                                </option>

                                <option value="2">Accountant</option>
                                <option value="3">Manager</option>
                                <option value="4">Warehouse Manager</option>

                            </select>

                            <div class="form-text">
                                The role determines system permissions.
                            </div>
                        </div>


                        <div class="col-12">

                            <div class="form-check form-switch">
                                <input class="form-check-input"
                                    type="checkbox"
                                    role="switch"
                                    id="enable_access"
                                    name="enable_access"
                                    checked>

                                <label class="form-check-label"
                                    for="enable_access">
                                    Enable system access
                                </label>
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


                    <!-- Documents -->
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
                            Select multiple documents at once.
                            PDF, JPG, PNG, DOC and DOCX.
                        </div>

                    </div>


                    <!-- Selected Files -->
                    <div id="selectedDocuments"
                        class="list-group mb-3 d-none">
                    </div>


                    <!-- Additional Information -->
                    <h6 class="text-muted border-bottom pb-2 mt-4 mb-3">
                        Additional Information
                    </h6>

                    <div class="mb-2">

                        <textarea class="form-control"
                            id="notes"
                            name="notes"
                            rows="4"
                            placeholder="Enter any additional information about the employee..."></textarea>

                        <div class="form-text">
                            Additional notes about the employee.
                        </div>

                    </div>

                </form>

            </div>


            <!-- Footer -->
            <div class="modal-footer">

                <button type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    Cancel
                </button>

                <button type="submit"
                    form="employeeForm"
                    class="btn btn-primary">

                    <i class="bi bi-check-lg me-1"></i>
                    Create Employee

                </button>

            </div>

        </div>
    </div>

</div>


<script>
    const documentInput = document.getElementById('documents');
    const selectedDocuments = document.getElementById('selectedDocuments');

    let selectedFiles = [];


    documentInput.addEventListener('change', function() {

        selectedFiles = [
            ...selectedFiles,
            ...Array.from(this.files)
        ];

        updateDocumentList();

        this.value = '';
    });


    function updateDocumentList() {

        selectedDocuments.innerHTML = '';

        if (!selectedFiles.length) {
            selectedDocuments.classList.add('d-none');
            return;
        }

        selectedDocuments.classList.remove('d-none');

        selectedFiles.forEach((file, index) => {

            const row = document.createElement('div');

            row.className =
                'list-group-item d-flex align-items-center justify-content-between';

            row.innerHTML = `
            <div class="d-flex align-items-center">

                <i class="bi bi-file-earmark-text fs-4 me-3 text-muted"></i>

                <div>
                    <div class="fw-semibold">
                        ${escapeHtml(file.name)}
                    </div>

                    <small class="text-muted">
                        ${formatFileSize(file.size)}
                    </small>
                </div>

            </div>

            <button type="button"
                    class="btn btn-sm btn-outline-danger"
                    onclick="removeDocument(${index})"
                    title="Remove">

                <i class="bi bi-x-lg"></i>

            </button>
        `;

            selectedDocuments.appendChild(row);
        });
    }


    function removeDocument(index) {

        selectedFiles.splice(index, 1);

        updateDocumentList();
    }


    function formatFileSize(bytes) {

        if (bytes < 1024) {
            return bytes + ' B';
        }

        if (bytes < 1024 * 1024) {
            return (bytes / 1024).toFixed(1) + ' KB';
        }

        return (bytes / (1024 * 1024)).toFixed(1) + ' MB';
    }


    function escapeHtml(value) {

        const div = document.createElement('div');

        div.textContent = value;

        return div.innerHTML;
    }


    document.getElementById('employeeForm').addEventListener('submit', function(event) {

        event.preventDefault();

        const formData = new FormData(this);

        formData.delete('documents[]');

        selectedFiles.forEach(file => {
            formData.append('documents[]', file);
        });

        /*
         * Здесь позже будет HTMX / fetch:
         *
         * fetch('/employees/create', {
         *     method: 'POST',
         *     body: formData
         * });
         */
    });
</script>



<?= $this->endSection() ?>