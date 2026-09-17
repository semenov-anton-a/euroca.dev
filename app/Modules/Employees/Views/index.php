<?= $this->extend('layouts/main') ?>

<?= $this->section('headerContentModule') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">
                    <i class="bi bi-people me-2"></i>Employees
                </h3>

                <div class="card-tools">
                    <a href="<?= route_to('employees.newemployee') ?>"
                       class="btn btn-primary btn-sm">
                        <i class="bi bi-person-plus me-1"></i>
                        New Employee
                    </a>
                </div>
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width:40px;"></th>
                            <th>Employee</th>
                            <th>Position</th>
                            <th>Department</th>
                            <th>Birthday</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($employees['employees'] as $employee): ?>
                            <?php
                            $initials = mb_strtoupper(
                                mb_substr($employee->first_name, 0, 1) .
                                mb_substr($employee->last_name, 0, 1)
                            );
                            ?>

                            <tr class="accordion-row"
                                data-accordion-row
                                data-employee-id="<?= $employee->id ?>">
                                <td>
                                    <i class="bi bi-chevron-right" data-accordion-icon></i>
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                                             style="width:40px;height:40px;">
                                            <strong><?= esc($initials) ?></strong>
                                        </div>

                                        <div>
                                            <div class="fw-semibold">
                                                <?= esc($employee->first_name . ' ' . $employee->last_name) ?>
                                            </div>

                                            <?php if ($employee->email): ?>
                                                <small class="text-muted">
                                                    <?= esc($employee->email) ?>
                                                </small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>

                                <td><?= esc($employee->position ?? '—') ?></td>
                                <td><span class="text-muted">—</span></td>

                                <td>
                                    <?= $employee->birthday
                                        ? esc(date('d.m.Y', strtotime($employee->birthday)))
                                        : '—'
                                    ?>
                                </td>

                                <td>
                                    <?php if ($employee->status === 'active'): ?>
                                        <span class="badge text-bg-success">Active</span>
                                    <?php elseif ($employee->status === 'inactive'): ?>
                                        <span class="badge text-bg-secondary">Inactive</span>
                                    <?php else: ?>
                                        <span class="badge text-bg-danger">
                                            <?= esc(ucfirst($employee->status)) ?>
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td class="text-end">
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= route_to('employees.edit', $employee->id) ?>"
                                           class="btn btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <button type="button"
                                                class="btn btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="card-footer clearfix">
                <div class="float-start text-muted small">
                    Showing <?= count($employees['employees']) ?>
                    of <?= $employees['pager']->getTotal() ?> employees
                </div>

                <div class="float-end">
                    <?= $employees['pager']->links() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .rotate-90 { transform: rotate(90deg); }
</style>
<script type="text/javascript">
const EmployeeAccordion = {
    init() {
        document.addEventListener('click', (event) => {
            const row = event.target.closest('[data-accordion-row]');

            if (!row || event.target.closest('a, button')) {
                return;
            }

            this.toggle(row);
        });
    },

    toggle(row) {
        const employeeId = row.dataset.employeeId;
        const nextRow = row.nextElementSibling;
        const icon = row.querySelector('[data-accordion-icon]');

        if (nextRow?.dataset.accordionDetails === 'true') {
            nextRow.remove();
            icon?.classList.remove('bi-chevron-down');
            icon?.classList.add('bi-chevron-right');
            return;
        }

        this.closeAll();

        const details = document.createElement('tr');
        details.dataset.accordionDetails = 'true';

        details.innerHTML = `
            <td colspan="7">
                <div class="p-3 text-center">
                    <div class="spinner-border spinner-border-sm" role="status"></div>
                </div>
            </td>
        `;

        row.after(details);

        icon?.classList.remove('bi-chevron-right');
        icon?.classList.add('bi-chevron-down');

        htmx.ajax(
            'GET',
            '<?= site_url('employees/') ?>' + employeeId,
            {
                target: details.querySelector('td'),
                swap: 'innerHTML'
            }
        );
    },

    closeAll() {
        document
            .querySelectorAll('[data-accordion-details="true"]')
            .forEach((row) => row.remove());

        document
            .querySelectorAll('[data-accordion-icon]')
            .forEach((icon) => {
                icon.classList.remove('bi-chevron-down');
                icon.classList.add('bi-chevron-right');
            });
    }
};

EmployeeAccordion.init();

</script>

<?= $this->endSection() ?>