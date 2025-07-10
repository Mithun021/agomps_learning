<?= $this->extend("admin/layouts/master") ?>
<?=  $this->section("body-content"); ?>
<?php

use App\Models\Sponsor_category_model;
$sponsor_category_model = new Sponsor_category_model();
?>

<!-- start page title -->
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header"><h4 class="card-title m-0">Add <?= $title ?></h4></div>
            <form action="<?= base_url() ?>admin/edit-sponsor-package/<?= $package_id ?>" method="post">
                <div class="card-body p-2">
                    <?php
                    if (session()->getFlashdata('status')) {
                        echo session()->getFlashdata('status');
                    }
                    ?>
                    <div class="form-group">
                        <span>Category Name</span>
                        <select class="form-control form-control-sm" name="sponsor_category_id" required>
                            <option value="">--Select--</option>
                        <?php foreach ($category as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>" <?php if($value['id'] == $package_detail['sponsor_category_id']){ echo "selected"; } ?>><?= $value['sponsor_categpry'] ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <span>Package Name</span>
                        <input type="text" class="form-control form-control-sm" name="package_name" value="<?= $package_detail['package_name'] ?>" required>
                    </div>
                </div>
                <div class="card-footer p-2">
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-8 p-1">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> List</h4>
            </div>
            <div class="card-body p-2">
                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Sponsor Category</td>
                            <td>Name</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($package as $key => $value): ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= $sponsor_category_model->get($value['sponsor_category_id'])['sponsor_categpry'] ?? '' ?></td>
                                <td><?= $value['package_name'] ?></td>
                                <td>
                                    <a href="<?= base_url() ?>admin/delete-sponsor-package/<?= $value['id'] ?>" class="btn btn-sm btn-circle btn-danger" onclick="return confirm('Are you sure...!')"><span class="fa fa-times"></span></a>
                                    <a href="<?= base_url() ?>admin/edit-sponsor-package/<?= $value['id'] ?>" class="btn btn-sm btn-circle btn-primary"><span class="fa fa-pen"></span></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>