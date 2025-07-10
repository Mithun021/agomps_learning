<?php

use App\Models\Teams_model;
$teams_model = new Teams_model();
$teams = $teams_model->get();
?>

<style>
    table{
        border-collapse: collapse;
    }
    .table th, .table td{
        padding: 5px;
        margin: 0;
    }

</style>
<div class="row">
    <div class="col-12 p-1">
        <div class="card card-body mb-0 p-2"><h4 class="card-title text-center m-0">POINTS TABLE</h4></div>
    </div>
    <div class="col-12 p-1">
        <div class="card card-body mb-0 p-2">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>TEAM</td>
                            <td>P</td>
                            <td>W</td>
                            <td>L</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($teams as $key => $value) { ?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td>
                                <?php if (!empty($value['logo']) && file_exists('public/assets/images/teams/' . $value['logo'])): ?>
                                    <a href="<?= base_url() ?>public/assets/images/teams/<?= $value['logo'] ?>" target="_blank"><img src="<?= base_url() ?>public/assets/images/teams/<?= $value['logo'] ?>" alt="" height="30px"></a>
                                <?php else: ?>
                                    <img src="<?= base_url() ?>public/assets/images/teams/invalid_image.png" alt="" height="40px">
                                <?php endif; ?>
                                <?= strtoupper($value['name']) ?></td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>