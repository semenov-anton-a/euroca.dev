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
            <div id="employees-table"> 
                <div class="card-body table-responsive p-0"> 
                    <?= view($viewTemplatePath, ['employees' => $employees]) ?> 
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