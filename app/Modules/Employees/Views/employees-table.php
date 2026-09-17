<table class="table table-hover align-middle mb-0">
    <thead>
        <tr>
            <th style="width:40px;"></th>
            <th>Employee</th>
            <th>Role</th>
            <th>Position</th>
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

            <tr class="accordion-row" data-accordion-row data-employee-id="<?= $employee->id ?>" >
                <td>
                    <i class="bi bi-chevron-right accordion-icon" data-accordion-icon></i>
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
                                <small class="text-muted"><?= esc($employee->email) ?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                </td>

                <td><?= esc($employee->role_name ?? '—') ?></td>
                <td><?= esc($employee->position ?? '—') ?></td>

                <td>
                    <?= $employee->birthday
                        ? esc(date('d.m.Y', strtotime($employee->birthday)))
                        : '—' ?>
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

            <tr id="employee-<?= $employee->id ?>"
                class="accordion-details">
                <td colspan="7">
                    <div class="accordion-content">
                        <div class="htmx-indicator justify-content-center py-4">
                            <div class="spinner-border spinner-border-sm" role="status"></div>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
$pager = $employees['pager'];
$currentPage = $pager->getCurrentPage();
$totalPages = $pager->getPageCount();

$pages = paginationPages($currentPage, $totalPages, 3);
?>

<div class="card-footer d-flex justify-content-center align-items-center">
    <?php if ($totalPages > 1): ?>
        <ul class="pagination pagination-sm mb-0">
            <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                <a class="page-link"
                   href="<?= $currentPage > 1 ? $pager->getPageURI($currentPage - 1) : '#' ?>"
                   hx-get="<?= $currentPage > 1 ? $pager->getPageURI($currentPage - 1) : '#' ?>"
                   hx-target="#employees-table"
                   hx-swap="innerHTML"
                   hx-push-url="true">
                    <i class="bi bi-chevron-left"></i>
                </a>
            </li>

            <?php foreach ($pages as $page): ?>
                <?php if ($page === '...'): ?>
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                <?php else: ?>
                    <li class="page-item <?= $page === $currentPage ? 'active' : '' ?>">
                        <a class="page-link"
                           href="<?= $pager->getPageURI($page) ?>"
                           hx-get="<?= $pager->getPageURI($page) ?>"
                           hx-target="#employees-table"
                           hx-swap="innerHTML"
                           hx-push-url="true">
                            <?= $page ?>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>

            <li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
                <a class="page-link"
                   href="<?= $currentPage < $totalPages ? $pager->getPageURI($currentPage + 1) : '#' ?>"
                   hx-get="<?= $currentPage < $totalPages ? $pager->getPageURI($currentPage + 1) : '#' ?>"
                   hx-target="#employees-table"
                   hx-swap="innerHTML"
                   hx-push-url="true">
                    <i class="bi bi-chevron-right"></i>
                </a>
            </li>
        </ul>
    <?php endif; ?>
</div>

<div class="text-muted small text-center">
    Showing <?= count($employees['employees']) ?> of <?= $pager->getTotal() ?> employees
</div>
