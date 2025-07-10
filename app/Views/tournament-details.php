<?= $this->extend('layouts/master') ?>
<?= $this->section('body-content') ?>

<style>
    #tournament-breadcrumb {
        position: relative;
    }

    .breadcrum-content {
        position: relative;
        width: 100%;
        display: flex;
    }

    .breadcrum-content .breadcrum-image {
        width: 90px;
        height: 90px;
        background: #fff;
        border-radius: 10px;
        padding: 5px;
        border: 1px solid #000;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .breadcrum-content .breadcrum-image img {
        width: 100%;
        height: auto;
    }

    .breadcrum-content .breadcrumb-detail {
        margin-left: 10px;
    }

    .breadcrum-content .breadcrumb-detail h3 {
        color: #000;
        font-size: 24px;
    }

    @media(max-width : 552px) {
        .breadcrum-content .breadcrumb-detail h3 {
            font-size: 16px;
        }
    }

    .tournament p {
        margin: 0;
    }

    .tournament-detail {
        position: relative;
        display: flex;
    }
    .tournament-detail2{
        margin-bottom: 10px;
    }

    .tournament-detail2 p:first-child {
        color: #000;
        font-weight: 500;
    }

    .tournament-detail p:last-child {
        padding-left: 20px;
    }

    .tournament-content {
        position: relative;
        width: 100%;
        border: 2px solid #000;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 10px;
    }

    .tournament-content span#tournament_for {
        position: absolute;
        right: 0px;
        top: 0px;
        background: #ffc300;
        padding: 2px 5px;
        color: #000;
        font-weight: 500;
        font-size: 12px;
        border-radius: 0px 0px 0px 5px;
    }

    .tournament-content .tournament {
        padding: 5px;
        position: relative;
        display: flex;
        width: 100%;
    }

    .tournament-content .tournament .tournament_image {
        position: relative;
        width: 20%;
        border: 1px solid #000;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 5px;
        border-radius: 10px;
    }

    .tournament-content .tournament .tournament_image img {
        width: 100%;
        height: auto;
    }

    .tournament-content .tournament .tournament-details {
        position: relative;
        width: 80%;
        padding-left: 5px;
    }

    .tournament-content .tournament .tournament-details h5 {
        font-size: 13px;
        margin: 0;
        margin-top: 10px;
        color: #000;
    }

    .tournament-content .tournament .tournament-details p {
        color: #000;
        margin: 0;
    }

    .tournament-content .tournament .tournament-details hr {
        margin: 0;
        margin: 2px 0px;
    }

    .tournament-content .tournament .tournament-details .tournament-date {
        display: flex;
        justify-content: space-between;
    }

    .tournament-content .tournament .tournament-details .tournament-date span {
        font-size: 12px;
        color: #000;
    }

    .tournament-content .tournament .tournament-details .tournament-date span.winning-price {
        border: 1px solid #000;
        border-radius: 20px;
        padding: 0px 5px;
    }

    .tournament-content .entree-fee {
        position: relative;
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #ebebeb;
    }

    .tournament-content .entree-fee span {
        color: #000;
        font-size: 12px;
    }

    .tournament-content .entree-fee a {
        border: none;
        outline: none;
        background-color: red;
        color: #FFF;
        padding: 2px 5px;
        font-size: 12px;
    }

    @media(max-width : 552px) {
        .tournament-content .tournament .tournament-details .tournament-date span {
            font-size: 10px;
        }

        .tournament-content .entree-fee span {
            font-size: 10px;
        }
    }

    .tournament-detail p:first-child {
        color: #000;
        font-weight: 500;
    }
</style>
<?php

use App\Models\Customer_detail_model;
use App\Models\Enroll_participant_model;
use App\Models\Enroll_tournament_model;
use App\Models\Players_category_model;
use App\Models\Sports_model;
use App\Models\Sports_subcategory_model;
use App\Models\Tournament_model;

$customer_detail_model = new Customer_detail_model();
$customer_ac_id = session()->get('customer_ac_id'); 

$customer_detail = $customer_detail_model->getByuserid($customer_ac_id);



$sports_model = new Sports_model();
$sports_subcategory_model = new Sports_subcategory_model();
$tournament_model = new Tournament_model();
$tournaments = $tournament_model->getActiveData();
$sports = $sports_model->get($tournament['sports_id']);
$sub_sports = $sports_subcategory_model->get($tournament['sport_subcategory']);
$players_category_model = new Players_category_model();
$enroll_tournament_model = new Enroll_tournament_model();
$enroll_participant_model = new Enroll_participant_model();

$players_category = $players_category_model->getbysports($tournament['sports_id']);

// Enroll Participant Data
$check_enrollerment = $enroll_tournament_model->get_by_participant_and_tournament($customer_detail['id'], $tournament_id);
if ($check_enrollerment) {
    $enroll_participant = $enroll_participant_model->get_by_enroll_tournament($check_enrollerment['id']);
}

if ($tournament['game_type'] == "Single") {
    $registration_fee = $tournament['registration_fee'];
    $discount_registration_fee = $tournament['discount_registration_fee'];
    $tournament_price = $registration_fee;
    if (!empty($discount_registration_fee) && $discount_registration_fee < $registration_fee) {
        $tournament_price = $discount_registration_fee;
    }
} else if ($tournament['game_type'] == "Team") {
    $registration_fee = $tournament['team_entry_fee'];
    $discount_registration_fee = $tournament['team_entry_fee_discount'];
    $tournament_price = $registration_fee;
    if (!empty($discount_registration_fee) && $discount_registration_fee < $registration_fee) {
        $tournament_price = $discount_registration_fee;
    }
}

?>

<section id="tournament-breadcrumb">
    <div class="card card-body p-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrum-content">
                        <div class="breadcrum-image">
                            <img src="<?= base_url() ?>public/assets/images/sports/cricket-cat.png" alt="Cricket">
                        </div>
                        <div class="breadcrumb-detail">
                            <h3 class="m-0"><?= strtoupper($tournament['title']) ?> <?= $customer_ac_id ?></h3>
                            <p class="m-0">📅 <?= date("d-M", strtotime($tournament['reg_date_start'])) ?> TO <?= date("d-M", strtotime($tournament['reg_date_end'])) ?> | <span class="text-primary"><?= $sports['name'] ?? '' ?></span> </p>
                            <hr class="my-1">
                            <p class="m-0"><i class="fas fa-map-marker-alt"></i> <?= $tournament['venue_address'] ?> </p>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <?php
            if (session()->getFlashdata('status')) {
                echo session()->getFlashdata('status');
            }
            ?>
        </div>
        <div class="col-md-7 p-1 tournament">
            <div class="card card-body p-2 mb-2">
                <h5 class="text-primary">Basic Details</h5>
                <?= $tournament['description'] ?>

                <hr>
                <div class="tournament-detail">
                    <p>Tournament ID :</p>
                    <p><?= $tournament['tournament_id'] ?></p>
                </div>
                <div class="tournament-detail">
                    <p>Category :</p>
                    <p><?= $sports['name'] ?? '' ?></p>
                </div>
                <div class="tournament-detail">
                    <p>Sub Category :</p>
                    <p><?= $sub_sports['sub_category_name'] ?? '' ?></p>
                </div>
                <div class="tournament-detail">
                    <p>Date : </p>
                    <p><?= date("d-M-y", strtotime($tournament['reg_date_start'])) ?> TO <?= date("d-M-y", strtotime($tournament['reg_date_end'])) ?></p>
                </div>
                <div class="tournament-detail">
                    <p>Joining Fee :</p>
                    <p>Rs. <?= $tournament_price ?>/-</p>
                </div>

            </div>

            <div class="card card-body p-2 mb-2">
                <h5 class="text-primary">Venue Details</h5>

                <div class="tournament-detail">
                    <p>📌Venue Address :</p>
                    <p> <?= $tournament['venue_address'] ?></p>
                </div>

                <div class="tournament-detail">
                    <p>🌐Area :</p>
                    <p><?= $tournament['city'] ?></p>
                </div>

                <div class="tournament-detail">
                    <p>🌐State :</p>
                    <p><?= $tournament['state'] ?></p>
                </div>
            </div>

            <div class="card card-body p-2 mb-2">
                <h5 class="text-primary">Winner Team Rank, Prize & Trophy</h5>

                <div class="tournament-detail2">
                    <p>🏆 1st Place – Winner Team :</p>
                    <p> Rs. <?= $tournament['first_rank_price'] ?> <?php if ($tournament['first_rank_trophy']) {
                                                                        echo "(" . $tournament['first_rank_trophy'] . ")";
                                                                    } ?></p>
                </div>

                <div class="tournament-detail2">
                    <p>🏆 2nd Place – Runner-Up Team :</p>
                    <p> Rs. <?= $tournament['second_rank_price'] ?> <?php if ($tournament['second_rank_trophy']) {
                                                                        echo "(" . $tournament['first_rank_trophy'] . ")";
                                                                    } ?></p>
                </div>

                <div class="tournament-detail2">
                    <p>🏆 3rd Place – 3rd Rank Team :</p>
                    <p> Rs. <?= $tournament['third_rank_price'] ?> <?php if ($tournament['third_rank_trophy']) {
                                                                        echo "(" . $tournament['first_rank_trophy'] . ")";
                                                                    } ?></p>
                </div>
            </div>
            <?php if ($tournament['gift_hampers']) { ?>
                <div class="card card-body p-2 bg-warning mb-2">
                    <h5 class="text-white m-0">Offer : Free <?= $tournament['gift_hampers'] ?></h5>
                </div>
            <?php } ?>

            <?php if ($tournament['game_type'] == "Single") { ?>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Prticipant Details (Single Registration)</h5>
                    </div>
                    <div class="card-body p-2 mb-2">
                        <?php if (!$check_enrollerment) { ?>
                            <form action="<?= base_url() ?>enroll_tournament/<?= $tournament_id ?>" method="post">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text" name="participant_id" value="<?= $customer_detail['id'] ?>"  required readonly>
                                        <span>Name</span>
                                        <input type="text" class="form-control form-control-sm" name="participant_name[]" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <span>Mobile Number</span>
                                        <input type="tel" class="form-control form-control-sm" name="participant_mobile[]" pattern="[6-9]\d{9}" maxlength="10" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <span>Age</span>
                                        <input type="number" class="form-control form-control-sm" name="participant_age[]" placeholder="<?= $tournament['min_age'] . " - " . $tournament['max_age'] ?>" min="<?= $tournament['min_age'] ?>" max="<?= $tournament['max_age'] ?>" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <span>Participant Type</span>
                                        <select class="form-control form-control-sm participant_type" name="participant_type[]" id="participant_type" required>
                                            <?php foreach ($players_category as $key => $type) { ?>
                                                <option value="<?= $type['name'] ?>"><?= $type['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <button type="submit" class="btn btn-primary">Register Now</button>
                                    </div>
                                </div>
                            </form>
                        <?php }else{  ?>
                            <?php foreach ($enroll_participant as $key => $players) {
                                echo '<p>'.++$key.". ".$players['participant_name']." (".$players['participant_type'].")".'</p>';
                            } if($check_enrollerment['payment_status'] == false) {?>

                            <h6 class="m-0 text-primary mt-5 mb-2">Complete Your Payment & Secure Your Spot in the Tournament!</h6>

                            <form action="<?= base_url() ?>enroll_payment/<?= $tournament_id ?>/<?= $customer_detail['id'] ?>" method="post">
                                <span>Registration Amount</span>
                                <input type="number" name="registration_amount" value="<?= $tournament_price ?>" class="form-control form-control-sm" readonly required>
                                <button type="submit" class="btn btn-primary mt-3">Pay Now</button>
                            </form>
                        <?php } } ?>
                    </div>
                </div>

            <?php } ?>

        </div>



        <div class="col-md-5 p-1">
            <?php if ($tournament['game_type'] == "Single") { ?>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">View More Tournaments</h4>
                    </div>
                    <div class="card-body p-2">
                        <div class="row">

                            <?php foreach ($tournaments as $key => $value) {
                                if ($key > 4) {
                                    break;
                                }
                                $sports = $sports_model->get($value['sports_id']);

                                if ($value['game_type'] == "Single") {
                                    $registration_fee = $value['registration_fee'];
                                    $discount_registration_fee = $value['discount_registration_fee'];
                                    $tournament_price = $registration_fee;
                                    if (!empty($discount_registration_fee) && $discount_registration_fee < $registration_fee) {
                                        $tournament_price = $discount_registration_fee;
                                    }
                                } else if ($value['game_type'] == "Team") {
                                    $registration_fee = $value['team_entry_fee'];
                                    $discount_registration_fee = $value['team_entry_fee_discount'];
                                    $tournament_price = $registration_fee;
                                    if (!empty($discount_registration_fee) && $discount_registration_fee < $registration_fee) {
                                        $tournament_price = $discount_registration_fee;
                                    }
                                }
                            ?>
                                <div class="col-lg-12">
                                    <div class="tournament-content">
                                        <span id="tournament_for">For <?= $value['league_for'] ?></span>
                                        <div class="tournament">
                                            <div class="tournament_image">
                                                <?php if (!empty($sports['sports_image']) && file_exists('public/assets/images/sports/' . $sports['sports_image'])): ?>
                                                    <img src="<?= base_url() ?>public/assets/images/sports/<?= $sports['sports_image'] ?>" alt="<?= $sports['name'] ?? '' ?>">
                                                <?php else: ?>
                                                    <img src="<?= base_url() ?>public/assets/images/sports/invalid_image.png" alt="">
                                                <?php endif; ?>
                                            </div>
                                            <div class="tournament-details">
                                                <span class="badge badge-primary badge-pill"><?= $sports['name'] ?? '' ?></span>
                                                <span class="badge badge-secondary badge-pill"><?= $value['game_type'] ?> Entry</span>
                                                <a href="<?= base_url() ?>tournament-details/<?= $value['id'] ?>">
                                                    <h5><?= strtoupper($value['title']) ?></h5>
                                                </a>
                                                <p>📍 <?= $value['venue_address'] ?></p>
                                                <hr>
                                                <div class="tournament-date">
                                                    <span class="enroll-date"> <?= date("d-M", strtotime($value['reg_date_start'])) ?> TO <?= date("d-M", strtotime($value['reg_date_end'])) ?></span>
                                                    <span class="winning-price">WIN GURANTEE : Rs. <?= $value['first_rank_price'] ?>/-</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="entree-fee">
                                            <span class="entre_amount">ENTREE FEE : Rs. <?= $tournament_price ?>/-</span>
                                            <span class="offers"><?php if ($value['gift_hampers']) {
                                                                        echo "(" . $value['gift_hampers'] . ")";
                                                                    } ?></span>
                                            <a href="<?= base_url() ?>tournament-details/<?= $value['id'] ?>"><i class="fas fa-angle-double-right"></i> Enrolll Now</a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="card">
                    <div class="card-header p-2">
                        <h5 class="card-title">Prticipant Details (Team Registration)</h5>
                        <p class="m-0">Register Your Team for <?= $tournament['title'] ?> – Minimim <span class="text-primary" id="minimum-players"> <?= $tournament['min_players'] ?></span>, <span class="text-primary">Maximum <?= $tournament['max_players'] ?></span> Players Required!</p>
                    </div>
                    <?php if (!$check_enrollerment) { ?>
                        <form action="<?= base_url() ?>enroll_tournament/<?= $tournament_id ?>" method="post" id="tournament_reggform">
                            <div class="card-body p-2 mb-2">

                                <?php for ($i = 1; $i <= $tournament['max_players']; $i++) { ?>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="text" name="participant_id" value="<?= $customer_detail['id'] ?>"  required readonly>
                                            <span>Name</span>
                                            <input type="text" class="form-control form-control-sm" name="participant_name[]">
                                        </div>
                                        <div class="col-lg-6">
                                            <span>Mobile Number</span>
                                            <input type="tel" class="form-control form-control-sm" name="participant_mobile[]" pattern="[6-9]\d{9}" maxlength="10">
                                        </div>
                                        <div class="col-lg-6">
                                            <span>Age</span>
                                            <input type="number" class="form-control form-control-sm" name="participant_age[]" placeholder="<?= $tournament['min_age'] . " - " . $tournament['max_age'] ?>" min="<?= $tournament['min_age'] ?>" max="<?= $tournament['max_age'] ?>">
                                        </div>
                                        <div class="col-lg-6">
                                            <span>Participant Type</span>
                                            <select class="form-control form-control-sm participant_type" name="participant_type[]" id="participant_type">
                                                <?php foreach ($players_category as $key => $type) { ?>
                                                    <option value="<?= $type['name'] ?>"><?= $type['name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <hr>
                                <?php } ?>
                            </div>
                            <div class="card-footer p-1">
                                <button type="submit" class="btn btn-primary">Register Now</button>
                            </div>
                        </form>
                    <?php }else{ ?>
                        <div class="card-body">
                            <?php foreach ($enroll_participant as $key => $players) {
                                echo '<p>'.++$key.". ".$players['participant_name']." (".$players['participant_type'].")".'</p>';
                            } if($check_enrollerment['payment_status'] == false) {?>

                            <h6 class="m-0 text-primary mt-5 mb-2">Complete Your Payment & Secure Your Spot in the Tournament!</h6>

                            <form action="<?= base_url() ?>enroll_payment/<?= $tournament_id ?>/<?= $customer_detail['id'] ?>" method="post">
                                <span>Registration Amount</span>
                                <input type="number" name="registration_amount" value="<?= $tournament_price ?>" class="form-control form-control-sm" readonly required>
                                <button type="submit" class="btn btn-primary mt-3">Pay Now</button>
                            </form>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>

        </div>
    </div>
</div>

<script src="<?= base_url() ?>public/assets/js/jquery.min.js"></script>

<script>
    document.getElementById("tournament_reggform").addEventListener("submit", function(event) {
        const minPlayers = parseInt(document.getElementById("minimum-players").textContent.trim());
        let filledRows = 0;

        // Select all rows dynamically
        const rows = document.querySelectorAll("form .row");

        rows.forEach(row => {
            const name = row.querySelector("input[name='participant_name[]']").value.trim();
            const mobile = row.querySelector("input[name='participant_mobile[]']").value.trim();
            const age = row.querySelector("input[name='participant_age[]']").value.trim();

            // Count only fully filled rows
            if (name && mobile && age) {
                filledRows++;
            }
        });

        if (filledRows < minPlayers) {
            event.preventDefault();
            alert(`Please fill at least ${minPlayers} participants.`);
        }
    });
</script>


<?= $this->endSection() ?>