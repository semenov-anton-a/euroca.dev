<<<<<<< HEAD
<div class="app-content-header">
=======
<div class="app-content-header p-0 mt-1">
>>>>>>> Module/Admin_Settings
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
<<<<<<< HEAD
                <h3 class="mb-0">This file is -> Views/partials/headerContent</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
=======
                <h3 class="mb-0"><?= esc($title) ?></h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <?php foreach ($breadcrumb as $item): ?>
                        <li class="breadcrumb-item">
                            <a href="<?= esc($item['url']) ?>"><?= esc($item['label']) ?></a>
                        </li>
                    <?php endforeach; ?>
>>>>>>> Module/Admin_Settings
                </ol>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>