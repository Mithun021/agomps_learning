<?= $this->extend('layouts/master') ?>
<?= $this->section('body-content') ?>
<div class="container-fluid my-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-body">
                <h2 class="text-primary text-center">Apply Now</h2>
                    <?php
                        if (session()->getFlashdata('status')) {
                            echo session()->getFlashdata('status');
                        }
                        print_r($customer_detail);
                    ?>
                <form action="<?= base_url() ?>apply-sponsor/<?= $sponsor_id ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <span>Firm/Business/Company Name<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="firm_name" value="<?php if($customer_detail){ echo $customer_detail['firm_name'] ?? ''; } ?>" <?php if($customer_detail && $customer_detail['firm_name']){ echo "readonly"; } ?> required>
                        </div>
                        <div class="col-md-6 form-group">
                            <span>Firm/Business/Company Type<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="firm_type" value="<?php if($customer_detail){ echo $customer_detail['firm_type'] ?? ''; } ?>" <?php if($customer_detail && $customer_detail['firm_type']){ echo "readonly"; } ?> required>
                        </div>
                        <div class="col-md-6 form-group">
                            <span>Firm/Business/Company Logo</span>
                            <input type="file" class="form-control form-control-sm" name="firm_logo">
                        </div>
                        <div class="col-md-12 form-group">
                            <span>Customer Name<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="customer_name" value="<?php if($customer_detail){ echo  $customer_detail['customer_name'] ?? ''; } ?>" <?php if($customer_detail && $customer_detail['customer_name']){ echo "readonly"; } ?> required>
                        </div>
                        <div class="col-md-6 form-group">
                            <span>Customer Phone<span class="text-danger">*</span></span>
                            <input type="tel" class="form-control form-control-sm" name="phone_number" maxlength="10" value="<?php if($customer_detail){ echo  $customer_detail['phone_number'] ?? ''; } ?>" <?php if($customer_detail && $customer_detail['phone_number']){ echo "readonly"; } ?> required>
                        </div>
                        <div class="col-md-6 form-group">
                            <span>Customer E-Mail<span class="text-danger">*</span></span>
                            <input type="email" class="form-control form-control-sm" name="email_id" value="<?php if($customer_detail){ echo  $customer_detail['email_id'] ?? ''; } ?>" <?php if($customer_detail && $customer_detail['email_id']){ echo "readonly"; } ?> required>
                        </div>
                        <div class="col-md-4 form-group">
                            <span>State<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="state" value="<?php if($customer_detail){ echo  $customer_detail['state'] ?? ''; } ?>" <?php if($customer_detail && $customer_detail['state']){ echo "readonly"; } ?> required>
                        </div>
                        <div class="col-md-4 form-group">
                            <span>City<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="city" value="<?php if($customer_detail){ echo  $customer_detail['city'] ?? ''; } ?>" <?php if($customer_detail && $customer_detail['city']){ echo "readonly"; } ?> required>
                        </div>
                        <div class="col-md-4 form-group">
                            <span>Pincode<span class="text-danger">*</span></span>
                            <input type="number" class="form-control form-control-sm" name="pincode" maxlength="6" value="<?php if($customer_detail){ echo  $customer_detail['pincode'] ?? ''; } ?>" <?php if($customer_detail && $customer_detail['pincode']){ echo "readonly"; } ?> required>
                        </div>
                        <div class="col-md-6 form-group">
                            <span>Aadhar Number<span class="text-danger">*</span></span>
                            <input type="number" class="form-control form-control-sm" name="aadhar_no" maxlength="12" value="<?php if($customer_detail){ echo  $customer_detail['aadhar_no'] ?? ''; } ?>" <?php if($customer_detail && $customer_detail['aadhar_no']){ echo "readonly"; } ?> required>
                        </div>
                        <div class="col-md-6 form-group">
                            <span>PAN Number<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="pan_no" value="<?php if($customer_detail){ echo  $customer_detail['pan_no'] ?? ''; } ?>" <?php if($customer_detail && $customer_detail['pan_no']){ echo "readonly"; } ?> required>
                        </div>
                        <div class="col-md-12 form-group">
                            <span>Amount<span class="text-danger">*</span></span>
                            <input type="text" class="form-control form-control-sm" name="sponsor_amount" value="<?= $sponsor_detail['discount_promotion_amount'] ??  $sponsor_detail['promotion_amount'] ?>" readonly required>
                        </div>
                        <div class="col-md-12 form-group">
                            <?php if($sponsor_detail){ ?>
                                <input type="submit" class="btn btn-primary" value="Pay Now" name="sponsor_payment_btn">
                            
                            <?php }else { ?>
                                <input type="submit" class="btn btn-primary" value="Apply Now">
                            <?php } ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>