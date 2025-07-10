<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<?php

use App\Models\League_session_model;
use App\Models\Sports_model;
use App\Models\Sports_subcategory_model;

$sports_model = new Sports_model();
$sports_subcategory_model = new Sports_subcategory_model();
$league_session_model = new League_session_model();
?>

<!-- start page title -->
<div class="row">
    <div class="col-lg-12 p-0">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?></h4>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Tournament Title</td>
                                <td>League Session Name</td>
                                <td>League For</td>
                                <td>Game Type</td>
                                <td>Sports Category</td>
                                <td>Reg. Date</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tournament as $key => $value): ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $value['title'] ?></td>
                                    <td><?= $league_session_model->get($value['league_session_id'])['league_name'] ?? '' ?></td>
                                    <td><?= $value['league_for'] ?></td>
                                    <td><?= $value['game_type'] ?></td>
                                    <td><?= $sports_model->get($value['sports_id'])['name'] ?></td>
                                    <td><?= date('d-m-Y', strtotime($value['reg_date_start'])) ?> - <?= date('d-m-Y', strtotime($value['reg_date_end'])) ?></td>
                                    <td><?= ($value['status'] == "0") ? "<span class='badge badge-danger badge-pill'>Inactive</span>" : (($value['status'] == "1") ? "<span class='badge badge-success badge-pill'>Active</span>" : "") ?></td>
                                    <td>
                                        <a href="<?= base_url() ?>admin/delete-tournament/<?= $value['id'] ?>" class="btn btn-sm btn-circle btn-danger" onclick="return confirm('Are you sure..!')"><span class="fa fa-times"></span></a>
                                        <a href="<?= base_url() ?>admin/edit-tournament/<?= $value['id'] ?>" class="btn btn-sm btn-circle btn-primary"><span class="fa fa-pen"></span></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>