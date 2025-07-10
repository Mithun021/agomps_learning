<style>
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
</style>

<?php

use App\Models\Sports_model;
use App\Models\Sports_subcategory_model;
use App\Models\Tournament_model;

$sports_model = new Sports_model();
$sports_subcategory_model = new Sports_subcategory_model();
$tournament_model = new Tournament_model();
$tournaments = $tournament_model->getActiveData();
$sports = $sports_model->getActiveData();
?>

<div class="row">
    <div class="col-md-3 p-1">
        <div class="card">
            <div class="card-header text-center">
                <h4 class="card-title">Search</h4>
            </div>
            <div class="card-body p-2">
                <form id="filter_tournament">
                    <div class="form-group">
                        <select name="tournament_for" id="tournament_for" class="form-control form-control-sm">
                            <option value="">All Categories</option>
                            <option value="Men">Men</option>
                            <option value="Women">Women</option>
                            <option value="Junior">Junior</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="sports_category" id="sports_category" class="form-control form-control-sm">
                            <option value="">All Tournament</option>
                            <?php foreach ($sports as $key => $value) { ?>
                                <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="sport_subcategory" id="sport_subcategory" class="form-control form-control-sm">
                            <option value="">All Formats</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary form-control" id="search_tournaments">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-9 p-1">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All tournaments</h4>
            </div>
            <div class="card-body">
                <div class="row" id="tournament_list">
                    <?php foreach ($tournaments as $key => $value) {

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
                        <div class="col-lg-6 p-1">
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
                                <div class="registration-start d-flex justify-content-between px-2 bg-primary text-white">
                                    <span class="registration_start">Registration Start : </span>
                                    <span  class="counter"></span>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
            <div class="card-footer">
                <a href="<?= base_url() ?>tournaments" class="btn btn-primary">View All</a>
            </div>
        </div>
    </div>
</div>

<!-- jQuery  -->
<script src="<?= base_url() ?>public/assets/js/jquery.min.js"></script>
<script>
    $('#sports_category').on('change', function() {
        var sports_id = $(this).val();
        if (sports_id !== "") {
            $.ajax({
                type: "post",
                url: "<?= base_url() ?>fetch_sports_subcategory",
                data: {
                    sports_id: sports_id
                },
                dataType: "json",
                success: function(response) {
                    // console.log(response);
                    $('#sport_subcategory').empty();
                    $('#sport_subcategory').html('<option value="">Select Format</option>');
                    if (response.length > 0) {
                        $.each(response, function(index, subcat) {
                            $('#sport_subcategory').append('<option value="' + subcat.id + '">' + subcat.sub_category_name + '</option>');
                        });
                    } else {
                        $('#sport_subcategory').html('<option value="">Data not available</option>');
                    }
                }
            });
        } else {
            $('#sport_subcategory').empty();
        }
    });


    $('#search_tournaments').on('click', function() {
        var tournament_for = $('#tournament_for').val();
        var sports_category = $('#sports_category').val();
        var sport_subcategory = $('#sport_subcategory').val();

        if (tournament_for === "" && sports_category === "" && sport_subcategory === "") {
            alert("Please select at least one filter option to search.");
            return;
        }

        $.ajax({
            url: '<?= base_url() ?>search-tournament',
            method: 'POST',
            data: {
                tournament_for: tournament_for,
                sports_category: sports_category,
                sport_subcategory: sport_subcategory
            },
            beforeSend: function() {
                $('#tournament_list').html('<div class="text-center py-4"><strong>Please wait...</strong></div>');
            },
            success: function(response) {
                $('#tournament_list').html(''); // Clear the loading message

                if (typeof response === 'string') {
                    response = JSON.parse(response);
                }

                if (response.length === 0) {
                    $('#tournament_list').html('<div class="alert alert-warning text-center">No tournament found.</div>');
                    return;
                }

                $.each(response, function(index, tournament) {
                    let tournament_price = 0;

                    if (tournament.game_type === "Single") {
                        let registration_fee = parseFloat(tournament.registration_fee);
                        let discount_registration_fee = parseFloat(tournament.discount_registration_fee);

                        tournament_price = registration_fee;
                        if (!isNaN(discount_registration_fee) && discount_registration_fee < registration_fee) {
                            tournament_price = discount_registration_fee;
                        }
                    } else if (tournament.game_type === "Team") {
                        let registration_fee = parseFloat(tournament.team_entry_fee);
                        let discount_registration_fee = parseFloat(tournament.team_entry_fee_discount);

                        tournament_price = registration_fee;
                        if (!isNaN(discount_registration_fee) && discount_registration_fee < registration_fee) {
                            tournament_price = discount_registration_fee;
                        }
                    }

                    let html = '';
                    html += '<div class="col-lg-6 p-1">';
                    html += '<div class="tournament-content">';
                    html += '<span id="tournament_for">For ' + tournament.league_for + '</span>';
                    html += '<div class="tournament">';
                    html += '<div class="tournament_image">';
                    if (tournament.sports_image && tournament.sports_image !== '') {
                        html += '<img src="<?= base_url() ?>public/assets/images/sports/' + tournament.sports_image + '" alt="' + tournament.sports_name + '" onerror="this.onerror=null;this.src=\'<?= base_url() ?>public/assets/images/sports/invalid_image.png\';">';
                    } else {
                        html += '<img src="<?= base_url() ?>public/assets/images/sports/invalid_image.png" alt="No Image">';
                    }
                    html += '</div>'; // close image
                    html += '<div class="tournament-details">';
                    html += '<span class="badge badge-primary badge-pill">' + tournament.sports_name + '</span>';
                    html += '<span class="badge badge-secondary badge-pill">' + tournament.game_type + ' Entry</span>';
                    html += '<a href="<?= base_url() ?>tournament-details/' + tournament.id + '"><h5>' + tournament.title.toUpperCase() + '</h5></a>';
                    html += '<p>📍 ' + tournament.venue_address + '</p>';
                    html += '<hr>';
                    html += '<div class="tournament-date">';
                    html += '<span class="enroll-date"> ' + formatDateToDayMonth(tournament.reg_date_start) + ' TO ' + formatDateToDayMonth(tournament.reg_date_end) + '</span>';
                    html += '<span class="winning-price">WIN GURANTEE : Rs. ' + tournament.first_rank_price + '/-</span>';
                    html += '</div>'; // tournament-date
                    html += '</div>'; // tournament-details
                    html += '</div>'; // tournament
                    html += '<div class="entree-fee">';
                    html += '<span class="entre_amount">ENTREE FEE : Rs. ' + tournament_price + '/-</span>';
                    html += '<span class="offers">' + (tournament.gift_hampers ? '(' + tournament.gift_hampers + ')' : '') + '</span>';
                    html += '<a href="<?= base_url() ?>tournament-details/' + tournament.id + '"><i class="fas fa-angle-double-right"></i> Enroll Now</a>';
                    html += '</div>'; // entree-fee
                    html += '</div>'; // tournament-content
                    html += '</div>'; // col-lg-6

                    $('#tournament_list').append(html);
                });
            },
            error: function() {
                $('#tournament_list').html('<div class="alert alert-danger text-center">An error occurred while fetching tournaments.</div>');
            }
        });


    });

    function formatDateToDayMonth(dateString) {
        const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", 
                        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        const date = new Date(dateString);
        const day = String(date.getDate()).padStart(2, '0');
        const month = months[date.getMonth()];
        return `${day}-${month}`;
    }
</script>

<script>
    document.querySelectorAll('.counter').forEach(counter => {
        const targetDateStr = counter.getAttribute('data-target');
        const targetDate = new Date(targetDateStr).getTime();

        const updateCountdown = () => {
            const now = new Date().getTime();
            const distance = targetDate - now;

            if (distance < 0) {
                counter.innerHTML = "🎉 Tournament Start";
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            counter.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
        };

        // Initial call and then interval
        updateCountdown();
        setInterval(updateCountdown, 1000);
    });
</script>

<script>
    const targetDate = new Date("April 21, 2025 15:00:00").getTime();

    document.querySelectorAll('.counter').forEach(counter => {
        const updateCountdown = () => {
            const now = new Date().getTime();
            const distance = targetDate - now;

            if (distance < 0) {
                counter.innerHTML = "🎉 Tournament Start";
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            counter.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
        };

        // Initial run
        updateCountdown();
        setInterval(updateCountdown, 1000);
    });
</script>