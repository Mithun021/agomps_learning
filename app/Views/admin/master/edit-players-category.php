<?= $this->extend("admin/layouts/master") ?>
<?=  $this->section("body-content"); ?>

<?php

use App\Models\Sports_model;
$sports_model = new Sports_model();
?>

<!-- start page title -->
<div class="row">
    <div class="col-lg-4 g-0">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add Sports Category</h4>
            </div>
            <?php
            if (session()->getFlashdata('status')) {
                echo session()->getFlashdata('status');
            }
            ?>
            <form action="<?= base_url() ?>admin/edit-players-category/<?= $players_id ?>" method="post" enctype="multipart/form-data">
                <div class="card-body p-2">
                    <div class="form-group">
                        <span>Sports Category </span>
                        <select class="form-control" name="sports_category" required>
                            <option value="">--Select--</option>
                        <?php foreach ($sports as $key => $value) { ?>
                            <option value="<?= $value['id'] ?>" <?php if($players_detail['sports_id'] == $value['id']){ echo "selected"; } ?>><?= $value['name'] ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <span>Players Category</span>
                        <input class="form-control" placeholder="Enter Player Type" name="player_category" value="<?= $players_detail['name'] ?>" required>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">Update Players Category</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-8 g-0">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Players Category List</h4>
            </div>
            <div class="card-body p-2">
                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Sports</td>
                            <td>Name</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($players as $key => $value): ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= $sports_model->get($value['sports_id'])['name'] ?></td>
                                <td><?= $value['name'] ?></td>
                                <td>
                                    <a href="<?= base_url() ?>admin/delete-players-category/<?= $value['id'] ?>" class="btn btn-sm btn-circle btn-danger" onclick="return confirm('Are you sure...!')"><span class="fa fa-times"></span></a>
                                    <a href="<?= base_url() ?>admin/edit-players-category/<?= $value['id'] ?>" class="btn btn-sm btn-circle btn-primary"><span class="fa fa-pen"></span></a>
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