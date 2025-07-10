<?= $this->extend("admin/layouts/master") ?>
<?=  $this->section("body-content"); ?>
<!-- start page title -->
<div class="row">
<div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add Team</h4>
            </div>
            <?php
            if (session()->getFlashdata('status')) {
                echo session()->getFlashdata('status');
            }
            ?>
            <form action="<?= base_url() ?>admin/teams" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <span>Team Name</span>
                        <input type="text" class="form-control" placeholder="Enter team name" name="team_name" required>
                    </div>
                    <div class="form-group">
                        <span>Upload Logo(JPG,PNG)</span>
                        <input type="file" class="form-control" name="team_logo" accept=".png,.jpg" required>
                    </div>
                    <div class="form-group">
                        <span>Status</span>
                        <select class="form-control" name="status" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">Add League Category</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Team List</h4>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>File</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($teams as $key => $value) { ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td>
                                        <?php if (!empty($value['logo']) && file_exists('public/assets/images/teams/' . $value['logo'])): ?>
                                            <a href="<?= base_url() ?>public/assets/images/teams/<?= $value['logo'] ?>" target="_blank"><img src="<?= base_url() ?>public/assets/images/teams/<?= $value['logo'] ?>" alt="" height="30px"></a>
                                        <?php else: ?>
                                            <img src="<?= base_url() ?>public/assets/images/teams/invalid_image.png" alt="" height="40px">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $value['name'] ?></td>
                                    <td><?= ($value['status'] == "0") ? "<span class='badge badge-danger badge-pill'>Inactive</span>" : (($value['status'] == "1") ? "<span class='badge badge-success badge-pill'>Active</span>" : "") ?></td>
                                    <td>
                                        <a href="<?= base_url() ?>admin/delete-teams" class="btn btn-sm btn-circle btn-danger"><span class="fa fa-times"></span></a>
                                        <a href="<?= base_url() ?>admin/edit-teams" class="btn btn-sm btn-circle btn-primary"><span class="fa fa-pen"></span></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>