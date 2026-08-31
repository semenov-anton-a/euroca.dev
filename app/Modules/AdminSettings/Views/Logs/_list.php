<?php if (empty($entries)): ?>

    <div class="text-muted text-center py-5">
        <i class="bi bi-file-text fs-1 d-block mb-3"></i>
        No log entries found.
    </div>

<?php else: ?>

    <div class="list-group list-group-flush">

        <?php foreach ($entries as $index => $entry): ?>

            <?php $collapseId = 'log-entry-' . $index; ?>

            <div class="list-group-item p-0">

                <button
                    type="button"
                    class="btn w-100 text-start p-3 border-0"
                    data-bs-toggle="collapse"
                    data-bs-target="#<?= esc($collapseId) ?>"
                    aria-expanded="false"
                    aria-controls="<?= esc($collapseId) ?>"
                >
                    <div class="d-flex align-items-center mb-1">
                        <span class="badge text-bg-secondary me-2">
                            <?= esc($entry['level']) ?>                            
                        </span>
                        <small class="text-muted">
                            <?= esc($entry['date']) ?>
                        </small>
                        <i class="bi bi-chevron-down ms-auto text-muted"></i>
                    </div>

                    <div class="text-break">
                        <?= esc(mb_substr($entry['message'], 0, 100)) ?><?= mb_strlen($entry['message']) > 100 ? '...' : '' ?>
                    </div>
                </button>

                <div id="<?= esc($collapseId) ?>" class="collapse">

                    <div class="px-3 pb-3">

                        <div class="bg-dark text-light rounded p-3">

                            <div class="small text-muted mb-2">
                                <?= esc($entry['level']) ?>
                                ·
                                <?= esc($entry['date']) ?>
                            </div>

                            <pre class="mb-0 text-light"
                                 style="white-space: pre-wrap;"><?= esc($entry['message']) ?></pre>

                        </div>

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

<?php endif; ?>