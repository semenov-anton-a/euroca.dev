<?= $this->extend('layouts/main') ?>

<?php $this->section('headerContentModule') ?>

<?php $this->endSection() ?>

<?php $this->section('content') ?>

<div class="card">

    <div class="row g-0">

        <!-- LOG FILES -->

        <div class="col-md-2 border-end">

            <div class="card-header">
                <div class="row">
                    <h3 class="card-title mb-2">
                        <i class="bi bi-files me-2"></i>
                        Log files
                    </h3>
                </div>
                <div class="btn-group">
                    <button
                        type="button"
                        id="removeLogs"
                        class="btn btn-danger btn-sm"
                        disabled
                        hx-post="<?= route_to('admin_settings.logs.remove_all') ?>"
                        hx-swap="none"
                        hx-on::after-request="
                            if (event.detail.successful) {
                                this.disabled = true;
                                document.getElementById('unlockLogs').setAttribute('aria-expanded', 'false');
                                document.querySelector('#unlockLogs i').className = 'bi bi-lock-fill';
                            }
                        ">
                        Remove all Logs files
                    </button>

                    <button
                        type="button"
                        id="unlockLogs"
                        class="btn btn-danger btn-sm"
                        aria-expanded="false"
                        hx-on:click="
                            const removeButton = document.getElementById('removeLogs');
                            const unlocked = this.getAttribute('aria-expanded') === 'true';

                            removeButton.disabled = unlocked;
                            this.setAttribute('aria-expanded', String(!unlocked));

                            this.querySelector('i').className = unlocked
                                ? 'bi bi-lock-fill'
                                : 'bi bi-unlock2';
                        ">
                        <i class="bi bi-lock-fill"></i>
                    </button>


                </div>
            </div>

            <div class="card-body p-0">

                <div class="list-group list-group-flush">

                    <?php foreach ($files as $logFile): ?>

                        <?php $fileName = basename($logFile); ?>

                        <button
                            type="button"
                            class="list-group-item list-group-item-action"
                            hx-get="<?= route_to('admin_settings.logs.read', $fileName) ?>"
                            hx-target="#log-content"
                            hx-swap="innerHTML">
                            <i class="bi bi-file-text me-2"></i>
                            <?= esc($fileName) ?>
                        </button>

                    <?php endforeach; ?>

                    <?php if (empty($files)): ?>

                        <div class="p-3 text-muted text-center">
                            No log files found.
                        </div>

                    <?php endif; ?>

                </div>

            </div>

        </div>


        <!-- LOG CONTENT -->

        <div class="col-md-10">

            <div class="card-header d-flex flex-wrap align-items-center">

                <h3 class="card-title mb-0">
                    <i class="bi bi-terminal me-2"></i>
                    Log
                </h3>

                <div class="ms-auto d-flex flex-wrap gap-1 justify-content-end"">

                    <button
                        type=" button"
                    class="btn btn-sm btn-outline-secondary"
                    hx-get="<?= $file ? route_to('admin_settings.logs.read', basename($file)) : '#' ?>"
                    hx-target="#log-content"
                    hx-swap="innerHTML">
                    <i class="bi bi-list me-1"></i>All
                    </button>

                    <?php
                    $levelClasses = [
                        'DEBUG'     => 'btn-outline-secondary',
                        'INFO'      => 'btn-outline-info',
                        'NOTICE'    => 'btn-outline-primary',
                        'WARNING'   => 'btn-outline-warning',
                        'ERROR'     => 'btn-outline-danger',
                        'CRITICAL'  => 'btn-danger',
                        'ALERT'     => 'btn-danger',
                        'EMERGENCY' => 'btn-dark',
                    ];
                    ?>

                    <?php foreach ($levels as $level): ?>

                        <button
                            type="button"
                            class="btn btn-sm <?= $levelClasses[$level] ?? 'btn-outline-secondary' ?>"
                            hx-get="<?= $file ? route_to('admin_settings.logs.read', basename($file)) . '?level=' . urlencode($level) : '#' ?>"
                            hx-target="#log-content"
                            hx-swap="innerHTML">
                            <?= esc(ucfirst(strtolower($level))) ?>
                        </button>

                    <?php endforeach; ?>

                </div>

            </div>

            <div
                id="log-content"
                class="card-body p-0"
                style="max-height: 700px; overflow-y: auto;">

                <?= view('Modules\AdminSettings\Views\Logs\_list', [
                    'entries' => $entries,
                ]) ?>

            </div>

        </div>

    </div>

</div>

<?php $this->endSection() ?>