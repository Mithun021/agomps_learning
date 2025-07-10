<style>
        /* Tournament Category Styling */
        .tournament-category {
            position: relative;
            padding: 10px;
        }

        .tournament-items {
            background: linear-gradient(50deg, rgba(255, 103, 0, 0.4) 0%, rgba(255, 103, 0, 1) 100%);
            border-radius: 10px;
            display: flex;
            height: 100px;
            align-items: center;
            padding: 10px;
        }

        .tournament-items img {
            height: 100%;
            padding: 10px;
        }

        .category-details {
            padding-left: 10px;
            text-align: center;
            flex-grow: 1;
        }

        .category-details h4 {
            color: #FFF;
            margin: 0;
            text-transform: uppercase;
            text-shadow: 0px 0px 20px #ababab;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .tournament-items {
                height: 90px;
            }
            /* .tournament-items img {
                height: 70%;
            } */
        }

        /* Swiper Navigation */
        .swiper-button-next, .swiper-button-prev {
            color: black;
        }
        .swiper-pagination-bullet-active {
            background: black;
        }
        /* Swiper Pagination Styling */
        .swiper-pagination {
            position: relative;
            margin-top: 10px;
        }

        .swiper-pagination-bullet {
            width: 10px;
            height: 10px;
            background: rgba(0, 0, 0, 0.3);
            opacity: 1;
            transition: all 0.3s ease;
        }

        .swiper-pagination-bullet-active {
            width: 12px;
            height: 12px;
            background: #FF6700;
            opacity: 1;
            transform: scale(1.3);
            box-shadow: 0px 0px 10px rgba(255, 103, 0, 0.8);
        }

    </style>
<?php

use App\Models\Sports_model;
use App\Models\Tournament_model;

$sports_model = new Sports_model();
$tournament_model = new Tournament_model();
$sports = $sports_model->get();
?>

<div class="row">
    <div class="col-lg-12">
    <div class="card p-0">
            <div class="card-header">
                <h4 class="card-title">All Categories</h4>
            </div>
            <div class="card-body">
                <div class="tournament-category">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                        <?php foreach ($sports as $key => $value) { 
                            $count_tournament = $tournament_model->where('sports_id',$value['id'])->countAllResults();
                        ?>
                            <div class="swiper-slide tournament-items">
                                <img src="<?= base_url() ?>public/assets/images/sports/cricket.png" alt="Cricket">
                                <div class="category-details">
                                    <a href="#"><h4><?= $value['name'] ?></h4><h4><?= $count_tournament ?></h4></a>
                                </div>
                            </div>
                        <?php } ?>
                        </div>
                        <!-- Swiper Navigation -->
                        <!-- <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div> -->
                        <!-- Swiper Pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- end row -->