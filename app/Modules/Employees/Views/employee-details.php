<div class="p-3">
    <div class="row g-3">
        <div class="col-md-4">
            <small class="text-muted d-block">Full Name</small>
            <strong><?= esc($employee->first_name . ' ' . $employee->last_name) ?></strong>
        </div>

        <div class="col-md-4">
            <small class="text-muted d-block">Email</small>
            <strong><?= esc($employee->email ?? '—') ?></strong>
        </div>

        <div class="col-md-4">
            <small class="text-muted d-block">Phone</small>
            <strong><?= esc($employee->phone ?? '—') ?></strong>
        </div>

        <div class="col-md-4">
            <small class="text-muted d-block">Position</small>
            <strong><?= esc($employee->position ?? '—') ?></strong>
        </div>

        <div class="col-md-4">
            <small class="text-muted d-block">Birthday</small>
            <strong>
                <?= $employee->birthday
                    ? esc(date('d.m.Y', strtotime($employee->birthday)))
                    : '—' ?>
            </strong>
        </div>

        <div class="col-md-4">
            <small class="text-muted d-block">Status</small>
            <strong><?= esc(ucfirst($employee->status)) ?></strong>
        </div>
    </div>

    <?php if (!empty($employee->note)): ?>
        <div class="mt-4">
            <small class="text-muted d-block mb-1">Additional Information</small>
            <div><?= nl2br(esc($employee->note)) ?></div>
        </div>
    <?php endif; ?>

    <hr>
    <!-- Documents -->
    <div class="mt-3">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <strong>Documents <span class="badge bg-secondary"><?= count($documents) ?></span></strong>            
        </div>

        <?php if ($documents === []): ?>
            <div class="text-muted small">No documents.</div>
        <?php else: ?>
            <div class="list-group">
                <?php foreach ($documents as $document): ?>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <div class="fw-semibold">
                                <a href="<?= route_to('employees.document', $document->file_name) ?>"
                                    class="btn btn-sm btn-outline-primary" target="_blank">
                                    <?= esc($document->title) ?>
                                </a>
                            </div>
                            <small class="text-muted">
                                <?= esc($document->mime_type ?? 'Unknown type') ?>
                                <?php if ($document->file_size !== null): ?>
                                    · <?= esc(number_format($document->file_size / 1024, 1)) ?> KB
                                <?php endif; ?>
                            </small>
                        </div>
                        <a href="<?= route_to('employees.document', $document->file_name) ?>"
                            class="btn btn-sm btn-outline-primary"
                            target="_blank">
                            <i class="bi bi-download"></i>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <hr/>
    <div class="d-flex justify-content-end gap-2">
        <a href="<?= route_to('employees.edit', $employee->id) ?>"
            class="btn btn-sm btn-primary">
            <i class="bi bi-pencil me-1"></i>
            Edit Employee
        </a>

        <button type="button"
            class="btn btn-sm btn-outline-danger">
            <i class="bi bi-trash me-1"></i>
            Delete
        </button>
    </div>
</div>