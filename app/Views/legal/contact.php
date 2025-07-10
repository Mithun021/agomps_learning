<?= $this->extend('layouts/master') ?>
<?= $this->section('body-content') ?>
<div class="container-fluid my-5">
    <div class="row">
        <!-- Left part start -->
        <div class="col-lg-8">
            <div class="p-a30 bg-gray clearfix m-b30 ">
                <h2>Contact form</h2>
                <div class="dzFormMsg"></div>
                <form method="post" class="dzForm" action="script/contact_smtp.php">
                    <input type="hidden" value="Contact" name="dzToDo">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <input name="dzName" type="text" required class="form-control" placeholder="Your Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <input name="dzEmail" type="email" class="form-control" required placeholder="Your Email Id">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <input name="dzPhoneNumber" type="text" required class="form-control" placeholder="Phone">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <input name="dzOther[Subject]" type="text" required class="form-control" placeholder="Subject">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <textarea name="dzMessage" rows="4" class="form-control" required placeholder="Your Message..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="g-recaptcha" data-sitekey="6LefsVUUAAAAADBPsLZzsNnETChealv6PYGzv3ZN" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>
                                    <input class="form-control d-none" style="display:none;" data-recaptcha="true" required data-error="Please complete the Captcha">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button name="submit" type="submit" value="Submit" class="btn btn-primary"> <span>Submit</span> </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Left part END -->
        <!-- right part start -->
        <div class="col-lg-4 d-lg-flex">
            <div class="p-a30 m-b30 border-1 contact-area align-self-stretch">
                <h2 class="m-b10">Quick Contact</h2>
                <p>If you have any questions simply use the following contact details.</p>
                <ul class="no-margin">
                    <li class="icon-bx-wraper left m-b30">
                        <div class="icon-bx-xs bg-primary"> <a href="javascript:void(0);" class="icon-cell"><i class="ti-location-pin"></i></a> </div>
                        <div class="icon-content">
                            <h6 class="text-uppercase m-tb0 dlab-tilte">Address:</h6>
                            <p>Vill + Post : Seuta, Sitapur UP-261205</p>
                        </div>
                    </li>
                    <li class="icon-bx-wraper left  m-b30">
                        <div class="icon-bx-xs bg-primary"> <a href="javascript:void(0);" class="icon-cell"><i class="ti-email"></i></a> </div>
                        <div class="icon-content">
                            <h6 class="text-uppercase m-tb0 dlab-tilte">Email:</h6>
                            <p>contact@agomps.com</p>
                        </div>
                    </li>
                    <li class="icon-bx-wraper left">
                        <div class="icon-bx-xs bg-primary"> <a href="javascript:void(0);" class="icon-cell"><i class="ti-mobile"></i></a> </div>
                        <div class="icon-content">
                            <h6 class="text-uppercase m-tb0 dlab-tilte">PHONE</h6>
                            <p>+91 9129926008</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- right part END -->
    </div>
</div>
<?= $this->endSection() ?>