<?= $this->extend("admin/layouts/master") ?>
<?=  $this->section("body-content"); ?>
<!-- start page title -->
<div class="row">
<div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add League Category</h4>
            </div>
            <?php
            if (session()->getFlashdata('status')) {
                echo session()->getFlashdata('status');
            }
            ?>
            <form action="<?= base_url() ?>admin/league-session" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <span>League Session Name</span>
                        <input type="text" class="form-control" placeholder="Enter league session name" name="league_session_name" required>
                    </div>
                    <div class="form-group">
                        <span>League Session Notes</span>
                        <input type="text" class="form-control" placeholder="Enter league session notes" name="league_session_notes" required>
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
                <h4 class="card-title m-0">League Category List</h4>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Notes</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($league_session as $key => $value) { ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $value['league_name'] ?></td>
                                    <td><?= $value['notes'] ?></td>
                                    <td><?= ($value['status'] == "0") ? "<span class='badge badge-danger badge-pill'>Inactive</span>" : (($value['status'] == "1") ? "<span class='badge badge-success badge-pill'>Active</span>" : "") ?></td>
                                    <td>
                                        <a href="<?= base_url() ?>admin/edit-league-category" class="btn btn-sm btn-circle btn-danger"><span class="fa fa-times"></span></a>
                                        <a href="<?= base_url() ?>admin/edit-league-category" class="btn btn-sm btn-circle btn-primary"><span class="fa fa-pen"></span></a>
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