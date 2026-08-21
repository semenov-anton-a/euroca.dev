<div class="app-content-header p-0 mt-1">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0"><?= esc($title) ?></h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <?php foreach ($breadcrumb as $item): ?>
                        <li class="breadcrumb-item">
                            <a href="<?= esc($item['url']) ?>"><?= esc($item['label']) ?></a>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>