<?= $this->extend('layouts/master') ?>
<?= $this->section('body-content') ?>

<?php

use App\Models\Sponsor_model;
use App\Models\Sponsor_package_model;
use App\Models\Sponsor_package_type_model;

$sponsor_model = new Sponsor_model();
$sponsor_package_model = new Sponsor_package_model();
$sponsor_package_type_model = new Sponsor_package_type_model();
?>

<style>
    .pricing-card {
        position: relative;
        border-radius: 20px;
        color: #fff;
        padding: 30px 20px;
        text-align: center;
        margin: 20px 10px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .pricing-card:after{
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 80px;
        border-radius: 0px 0px 80px 80px;
        background-color: rgba(255, 255, 255, 0.3);
    }

    .personal {
        background: linear-gradient(to bottom, #f85032, #e73827);
    }

    .standard {
        background: linear-gradient(to bottom, #000428, #004e92);
    }

    .business {
        background: linear-gradient(to bottom, #50D5B7, #067D68);
    }

    .pricing-card h3 {
        font-size: 20px;
        margin-bottom: 10px;
        font-weight: 700;
        text-transform: uppercase;
        color: #FFF;
    }

    .pricing-card .icon {
        font-size: 40px;
        margin-bottom: 10px;
    }

    .pricing-card .price {
        font-size: 38px;
        font-weight: 700;
        margin-bottom: 20px;
        margin-top: 50px;
    }

    .pricing-card ul {
        list-style: none;
        padding: 0;
        margin: 20px 0;
        text-align: left;
    }

    .pricing-card ul li {
        font-size: 16px;
        margin: 10px 0;
        text-align: center;
    }

    .check {
        color: #00ff90;
        margin-right: 5px;
    }

    .cross {
        color: #ff4b2b;
        margin-right: 5px;
    }

    .btn-started {
        border: none;
        padding: 10px 25px;
        border-radius: 30px;
        font-weight: 600;
        margin-top: 15px;
        transition: 0.3s;
    }

    .btn-personal {
        background: #fff;
        color: #ff4b2b;
    }

    .btn-standard {
        background: #fff;
        color: #7f00ff;
    }

    .btn-business {
        background: #fff;
        color: #78ffd6;
    }

    .btn-started:hover {
        background: #333;
        color: #fff;
    }
    .pricing-card ul li:nth-child(even) {
        background: rgba(255, 255, 255, 0.5);  /* semi-transparent white background */
        padding: 5px;
        text-align: center;
    }
    .pricing-card ul li:nth-child(odd) {
        background: rgba(255, 255, 255, 0.13);  /* semi-transparent white background */
        padding: 5px;
        text-align: center;
    }
</style>
<div class="container-fluid my-5">
    <div class="row">

    <?php foreach ($sponsor_category as $key => $cat) {
            $sponsors = $sponsor_model->getByCategory($cat['id']); ?>
            <div class="col-lg-12">
                <h1 class="m-4 text-center"><?= $cat['sponsor_categpry'] ?></h1>
            </div>
            <?php if ($sponsors) {
                $col = 4;
                foreach ($sponsors as $key => $value) {
                    $package = $sponsor_package_model->get($value['package_name']);
                    $getcol = $col * ++$key;

                    if($getcol == 4 || $getcol == 24){ $pricebg = "personal"; }
                    if($getcol == 8 || $getcol == 16 ){ $pricebg = "standard"; }
                    if($getcol == 12 || $getcol == 20 ){ $pricebg = "business"; }
            ?>

        <!-- Personal Plan -->
        <div class="col-md-4">
            <div class="pricing-card <?= $pricebg ?>">
                <!-- <div class="icon"><i class="fas fa-file-alt"></i></div> -->
                <h3><?= strtoupper($package['package_name']) ?? '' ?></h3>
                <div class="price">₹<?= $value['discount_promotion_amount'] ?? $value['promotion_amount'] ?><span style="font-size:16px;">/<?= $value['promotion_days'] ?> Days</span></div>
                <ul>
                    <li><span class="check">&#10003;</span>
                    <?php $package_type = explode(',',$value['package_type']); foreach($package_type as $type){
                            $package_type = $sponsor_package_type_model->get($type);
                            if($package_type){ echo $package_type['package_type']." + "; }
                        }
                    ?>
                    </li>
                    <li><span class="check">&#10003;</span>Duration : <?= $value['promotion_days'] ?> Days</li>
                    <?php if($value['promotion_location']){ ?> <li><span class="check">&#10003;</span> Location : <?= $value['promotion_location'] ?> </li><?php } ?>
                    <li><span class="check">&#10003;</span> Email Support</li>
                    <?php if($value['additional_benefits']){ ?><li><span class="cross">&#10007;</span> Additional : <?= $value['additional_benefits'] ?></li> <?php } ?>
                </ul>
                <a href="<?= base_url() ?>apply-sponsor/<?= $value['id'] ?>"><button class="btn-started btn-<?= $pricebg ?>">GET STARTED</button></a>
            </div>
        </div>

        <?php } 
        }
    }?>

        

    </div>
</div>
<?= $this->endSection() ?>