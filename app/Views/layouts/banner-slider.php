<style>
    .banner_slider .swiper-slide img {
        width: 100%;
        height: auto;
    }
</style>
<div class="row banner-slider">
    <div class="col-xl-12">
        <div class="card p-0">
            <div class="card-body p-0">
                 <!-- Swiper -->
                <div class="swiper mySwiper banner_slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><img src="<?= base_url() ?>public/assets/images/banner/cricket.png" alt=""></div>
                        <div class="swiper-slide"><img src="<?= base_url() ?>public/assets/images/banner/football.png" alt=""></div>
                        <div class="swiper-slide"><img src="<?= base_url() ?>public/assets/images/banner/kabaddi.png" alt=""></div>
                        <div class="swiper-slide"><img src="<?= base_url() ?>public/assets/images/banner/badminton.png" alt=""></div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>
