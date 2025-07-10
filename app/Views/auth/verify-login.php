
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>AGOMPS INDIA : <?= $title ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="MyraStudio" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="<?= base_url() ?>public/assets/images/favicon.png">

        <!-- App css -->
        <link href="<?= base_url() ?>public/assets/css/bootstrap.mins.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>public/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>public/assets/css/theme.min.css" rel="stylesheet" type="text/css" />
        <style>
            body{
                background-image: url('<?= base_url() ?>public/assets/images/loginbg.jpg');
                background-size: cover;
                background-position: center;
            }
            .login-header h2 a{
                color: #FFF;
            }
            .google-login a{
                display: flex;
                align-items: center;
                border: 1px solid #252525;
                padding: 10px 5px;
                justify-content: center;
                font-size: 16px;
                border-radius: 20px;
                color: #000;
            }
            .google-login a img{
                height: 25px;
                padding-right: 10px;
            }
            form.user input, form.user button{
                height: 40px;
                border-radius: 20px;
            }
            .divider {
                display: flex;
                align-items: center;
                width: 60%;
            }

            .line {
                flex-grow: 1;
                height: 1px;
                background-color: black;
            }

            .text {
                margin: 0 10px;
                font-size: 16px;
                font-weight: bold;
            }
            #divideroption{
                display: flex;
                justify-content: center;
                align-items: center;
                margin-bottom: 20px;
            }
            
        </style>
    </head>

    <body>
 
        <div id="login-llg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7 col-12">
                        <div class="d-flex align-items-center min-vh-100">
                            <div class="w-100 d-block bg-white shadow-lg rounded my-5">
                                <div class="login-header bg-primary">
                                    <h2 class="text-white mx-2 py-2"><a href="<?= base_url() ?>">AGOMPS</a></h2>
                                </div>
                                <div class="row justify-content-center">
                                    <!-- <div class="col-lg-5 d-none d-lg-block bg-login rounded-left"></div> -->
                                    <div class="col-lg-9">
                                        <div class="p-5">
                                            <h1 class="h3 mb-1 text-center">Verify</h1>
                                            
                                            <form class="user" method="post" action="<?= base_url() ?>verify-login">
                                                <div class="custom-control custom-checkbox custom-control-inline d-flex justify-content-center mb-3">
                                                    <input type="checkbox" class="custom-control-input" name="accept_terms" id="customCheck5" checked disabled>
                                                    <span class="custom-control-label" for="customCheck5"> I agree to <a href="#" target="_blank">Privacy Policy</a> and <a href="#" target="_blank">T & C </a></span>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-user" name="verify_otp" placeholder="Enter 6 Digit OTP" required maxlength="6" minlength="6">
                                                </div>
                                                <!-- <div class="form-group">
                                                    <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                                </div> -->
                                                <button type="submit" class="btn btn-primary btn-block waves-effect waves-light"> Verify and Login </button>
                                            </form>
    
                                            <div class="row mt-4">
                                                <div class="col-12 text-center">
                                                    <p class="text-muted mb-0">Already have an account? <a href="<?= base_url() ?>user-login" class="text-muted font-weight-medium ml-1"><b>Sign Up</b></a></p>
                                                
                                                
                                                    <?php
                                                        if (session()->getFlashdata('status')) {
                                                            echo session()->getFlashdata('status');
                                                        }
                                                    ?>

                                                </div> <!-- end col -->
                                            </div>
                                            <!-- end row -->
                                        </div> <!-- end .padding-5 -->
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            </div> <!-- end .w-100 -->
                        </div> <!-- end .d-flex -->
                    </div> <!-- end col-->
                </div> <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->
    
        <!-- jQuery  -->
        <script src="<?= base_url() ?>public/assets/js/jquery.min.js"></script>
        <script src="<?= base_url() ?>public/assets/js/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url() ?>public/assets/js/metismenu.min.js"></script>
        <script src="<?= base_url() ?>public/assets/js/waves.js"></script>
        <script src="<?= base_url() ?>public/assets/js/simplebar.min.js"></script>
    
        <!-- App js -->
        <script src="<?= base_url() ?>public/assets/js/theme.js"></script>
    
    </body>
    
    </html>