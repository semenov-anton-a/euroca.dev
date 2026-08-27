<?php if (empty($entries)): ?>

    <div class="text-muted text-center py-5">
        <i class="bi bi-file-text fs-1 d-block mb-3"></i>
        No log entries found.
    </div>

<?php else: ?>

    <div class="list-group list-group-flush">

        <?php foreach ($entries as $entry): ?>

            <div class="list-group-item">

                <div class="d-flex align-items-center mb-1">

                    <span class="badge text-bg-secondary me-2">
                        <?= esc($entry['level']) ?>
                    </span>

                    <small class="text-muted">
                        <?= esc($entry['date']) ?>
                    </small>

                </div>

                <div class="text-break">
                    <?= esc($entry['message']) ?>
                </div>

            </div>

        <?php endforeach; ?>

    </div>

<?php endif; ?>