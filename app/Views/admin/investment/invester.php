<?= $this->extend("admin/layouts/master") ?>
<?= $this->section("body-content"); ?>

<!-- start page title -->
<div class="row">
    <div class="col-lg-4 g-0">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0">Add <?= $title ?></h4>
            </div>
            <?php
            if (session()->getFlashdata('status')) {
                echo session()->getFlashdata('status');
            }
            ?>

            <form action="<?= base_url() ?>admin/investment/invester" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <span>Team Name</span>
                        <select name="team_id" class="form-control">
                            <?php foreach ($teams as $team): ?>
                                <option value="<?= $team['id'] ?>"><?= $team['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <span>Investment Name</span>
                        <input type="text" name="investor_name" placeholder="Investor Name" class="form-control" required>

                    </div>
                    <div class="form-group">
                        <span>Amount (Min ₹100)</span>
                        <input type="number" name="amount" placeholder="Amount (Min ₹100)" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <span>Status</span>
                        <select class="form-control" name="sports_category_status" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">Add Category</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-8 g-0">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> List</h4>
            </div>
            <div class="card-body p-2">
                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Investor</th>
                            <th>Team</th>
                            <th>Amount</th>
                            <th>Investment ID</th>
                            <th>Receipt</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($investments as $row): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= esc($row['investor_name']) ?></td>
                                <td><?= esc($row['team_name']) ?></td>
                                <td>₹<?= number_format($row['amount'], 2) ?></td>
                                <td><?= esc($row['unique_investment_id']) ?></td>
                                <td><?= esc($row['receipt_number']) ?></td>
                                <td><?= date('d-m-Y', strtotime($row['created_at'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title m-0"><?= $title ?> List</h4>
            </div>
            <div class="card-body p-2">
                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Investor</th>
                            <th>Investment ID</th>
                            <th>Invested Amount</th>
                            <th>Return (₹)</th>
                            <th>Bonus (₹)</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($returns as $row): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= esc($row['investor_name']) ?></td>
                                <td><?= esc($row['unique_investment_id']) ?></td>
                                <td>₹<?= number_format($row['amount'], 2) ?></td>
                                <td>₹<?= number_format($row['return_amount'], 2) ?></td>
                                <td>₹<?= number_format($row['bonus_amount'], 2) ?></td>
                                <td><?= date('d-m-Y', strtotime($row['created_at'])) ?></td>
                                <td>
                                    <?php if ($row['sent_to_bank']): ?>
                                        <span class="badge bg-success">Sent</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    <?php endif; ?>
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