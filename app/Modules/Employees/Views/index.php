<?= $this->extend('layouts/main') ?>


<?= $this->section('headerContentModule') ?>

<?php 
// view('partials/headerContent', [
//     'title' => $title,

//     'breadcrumb' => [
//         [
//             'label' => 'Settings',
//             'url'   => route_to('settings'),
//         ],
//         [
//             'label' => 'Roles & Permissions',
//             'url'   => route_to('settings.roles'),
//         ],
//     ],
// ]) 
?>

<?= $this->endSection() ?>


<?= $this->section('content') ?>

<div class=row>
    <div class="col-4">
        <div class="card-body">
            <div class="card">
                <!-- Card Header -->
                <div class="card-header border-0">
                    <h3 class="card-title">
                        
                    </h3>

                    <div class="card-tools">
                        <a href="#" class="btn btn-primary btn-sm">New Role</a>
                        <!-- <a href="#" class="btn btn-tool btn-sm">
                            <i class="bi bi-download"></i>
                        </a>
                        <a href="#" class="btn btn-tool btn-sm">
                            <i class="bi bi-list"></i>
                        </a> -->
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body table-responsive p-0">
                    
                    <table class="table table-striped align-middle" role="table" data-accordion >

                        <thead>
                            <tr>
                                <th scope="col">
                        
                                </th>
                                <th scope="col">
                        
                                </th>                           
                            </tr>
                        </thead>
                        <tbody>
                                <tr class="accordion-row" data-accordion-row data-accordion-target="">
                                    <td>
                                        <i class="bi bi-chevron-right accordion-icon me-2" data-accordion-icon></i>
                        
                                    </td>
                                    <td>
                                        asdsdsadsadsad
                                    </td>
                                </tr>

                                <!-- Содержимое accordion -->
                                <tr id="" class="accordion-details">
                                    <td colspan="4">
                                        <div class="accordion-content" data-accordion-content>
                                            <div class="p-3">
                                                <strong>
                                                    Permissions
                                                </strong>
                                                <div class="mt-2">
                                                    Permission 1<br>
                                                    Permission 2<br>
                                                    Permission 3
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>