<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>
<!-- start page title -->
<div class="row">
    <div class="col-lg-4 p-1">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add Sports Category</h4>
            </div>
            <?php
            if (session()->getFlashdata('status')) {
                echo session()->getFlashdata('status');
            }
            ?>
            <form action="<?= base_url() ?>admin/edit-sports-category/<?= $sports_id ?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <span>Sports Category Name</span>
                        <input type="text" class="form-control" placeholder="Enter sports category name" name="sports_category_name" value="<?= $sports_detail['name'] ?>" required>
                    </div>
                    <div class="form-group">
                        <span><input type="checkbox" name="cometitive_tournament" value="1" <?php if($sports_detail['cometitive_tournament'] == 1){ echo "checked"; } ?>> Competitive Tournament Categoy</span>
                    </div>
                    <div class="form-group">
                        <span>Sports Category Description</span>
                        <!-- <textarea class="form-control" placeholder="Enter sports category description" name="sports_category_description" id="summernote"></textarea> -->
                        <textarea class="form-control" placeholder="Enter sports category description" name="sports_category_description"><?= $sports_detail['description'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <span>Upload Logo(JPG,PNG)</span>
                        <input type="file" class="form-control" name="sports_category_image" accept=".png,.jpg">
                        <?php if (!empty($sports_detail['sports_image']) && file_exists('public/assets/images/sports/' . $sports_detail['sports_image'])): ?>
                            <a href="<?= base_url() ?>public/assets/images/sports/<?= $sports_detail['sports_image'] ?>" target="_blank"><img src="<?= base_url() ?>public/assets/images/sports/<?= $sports_detail['sports_image'] ?>" class="avatar-xs" height="30px"></a>
                        <?php else: ?>
                            <img src="<?= base_url() ?>public/assets/images/sports/invalid_image.png" alt="" height="40px">
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <span>White Image(JPG,PNG)</span>
                        <input type="file" class="form-control" name="sports_category_white_image" accept=".png,.jpg">
                        <?php if (!empty($sports_detail['sports_image_category']) && file_exists('public/assets/images/sports/' . $sports_detail['sports_image_category'])): ?>
                            <a href="<?= base_url() ?>public/assets/images/sports/<?= $sports_detail['sports_image_category'] ?>" target="_blank"><img src="<?= base_url() ?>public/assets/images/sports/<?= $sports_detail['sports_image_category'] ?>" class="avatar-xs" height="30px"></a>
                        <?php else: ?>
                            <img src="<?= base_url() ?>public/assets/images/sports/invalid_image.png" alt="" height="40px">
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <span>Status</span>
                        <select class="form-control" name="sports_category_status" required>
                            <option value="1" <?php if($sports_detail['status'] == 1){ echo "selected"; } ?>>Active</option>
                            <option value="0" <?php if($sports_detail['status'] == 0){ echo "selected"; } ?>>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">Add Sports Category</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-8 p-1">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Sports Category List</h4>
            </div>
            <div class="card-body p-2">
                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>File</td>
                            <td>Name</td>
                            <td>Competitive Tour.</td>
                            <td>Status</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sports as $key => $value): ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td>
                                    <?php if (!empty($value['sports_image']) && file_exists('public/assets/images/sports/' . $value['sports_image'])): ?>
                                        <a href="<?= base_url() ?>public/assets/images/sports/<?= $value['sports_image'] ?>" target="_blank"><img src="<?= base_url() ?>public/assets/images/sports/<?= $value['sports_image'] ?>" alt="" height="30px"></a>
                                    <?php else: ?>
                                        <img src="<?= base_url() ?>public/assets/images/sports/invalid_image.png" alt="" height="40px">
                                    <?php endif; ?>

                                    <?php if (!empty($value['sports_image_category']) && file_exists('public/assets/images/sports/' . $value['sports_image_category'])): ?>
                                        <a href="<?= base_url() ?>public/assets/images/sports/<?= $value['sports_image_category'] ?>" target="_blank"><img src="<?= base_url() ?>public/assets/images/sports/<?= $value['sports_image_category'] ?>" alt="" height="30px"></a>
                                    <?php else: ?>
                                        <img src="<?= base_url() ?>public/assets/images/sports/invalid_image.png" alt="" height="40px">
                                    <?php endif; ?>
                                </td>
                                <td><?= $value['name'] ?></td>
                                <td><?= ($value['cometitive_tournament'] == "0") ? "<span class='badge badge-danger badge-pill'>No</span>" : (($value['cometitive_tournament'] == "1") ? "<span class='badge badge-success badge-pill'>Yes</span>" : "") ?></td>
                                <td><?= ($value['status'] == "0") ? "<span class='badge badge-danger badge-pill'>Inactive</span>" : (($value['status'] == "1") ? "<span class='badge badge-success badge-pill'>Active</span>" : "") ?></td>
                                <td>
                                    <a href="<?= base_url() ?>admin/delete-sports-category/<?= $value['id'] ?>" class="btn btn-sm btn-circle btn-danger" onclick="return confirm('Are you sure...!')"><span class="fa fa-times"></span></a>
                                    <a href="<?= base_url() ?>admin/edit-sports-category/<?= $value['id'] ?>" class="btn btn-sm btn-circle btn-primary"><span class="fa fa-pen"></span></a>
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