<?= $this->extend('layouts/master') ?>
<?= $this->section('body-content') ?>

<?php

use App\Models\Teams_model;

$teams_model = new Teams_model();
$teams = $teams_model->findAll();
?>

<div class="container mt-5">
    <h2 class="mb-4">Investment Form</h2>
    <form action="<?= site_url('investment/save') ?>" method="post">
        <?= csrf_field() ?>

        <!-- Team Selection -->
        <div class="mb-3">
            <label for="team" class="form-label">Select Team</label>
            <select name="team" id="team" class="form-control" required>
                <option value="">-- Select Team --</option>
                <?php foreach ($teams as $team): ?>
                    <option value="<?= esc($team['id']) ?>"><?= esc($team['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Personal Details -->
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" name="first_name" id="first_name" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="father_name" class="form-label">Father's Name</label>
                <input type="text" name="father_name" id="father_name" class="form-control" required>
            </div>
        </div>

        <!-- Contact and Address -->
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="tel" name="mobile" id="mobile" class="form-control" required pattern="[0-9]{10}">
            </div>
            <div class="col-md-8 mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea name="address" id="address" class="form-control" rows="2" required></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" name="city" id="city" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="state" class="form-label">State</label>
                <input type="text" name="state" id="state" class="form-control" required>
            </div>
            <div class="col-md-4 mb-3">
                <label for="pincode" class="form-label">Pincode</label>
                <input type="text" name="pincode" id="pincode" class="form-control" required pattern="[0-9]{6}">
            </div>
        </div>

        <!-- Investment Amount -->
        <div class="mb-3">
            <label for="amount" class="form-label">Investment Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" required min="1">
        </div>

        <button type="submit" class="btn btn-primary">Submit Investment</button>
    </form>
</div>

<?= $this->endSection() ?>