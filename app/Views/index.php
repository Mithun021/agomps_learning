<?= $this->extend('layouts/master') ?>
<?= $this->section('body-content') ?>
<?= view('layouts/banner-slider') ?>
<div class="container-fluid">
    <?= view('layouts/tournament-category') ?>
    <?= view('layouts/tournaments') ?>
</div>
<section class="bg-primary py-3 mb-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8"><?= view('layouts/upcomming-match') ?></div>
            <div class="col-md-4"><?= view('layouts/team-point-table') ?></div>
        </div>
    </div>
</section>
<div class="container-fluid">
    <?= view('layouts/sponsor') ?>

</div>
<?= $this->endSection() ?>
