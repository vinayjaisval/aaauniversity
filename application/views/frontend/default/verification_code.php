<?php if (get_frontend_settings('recaptcha_status')): ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php endif; ?>


<?php $this->load->view('frontend/default/include/header'); ?>


<div class="edu-breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="page-title">
                <h1 class="title"> Verification Code</h1>
            </div>
            <ul class="edu-breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="separator"><i class="icon-angle-right"></i></li>

                <li class="breadcrumb-item active" aria-current="page">Verification</li>
            </ul>
        </div>
    </div>
    <ul class="shape-group">
        <li class="shape-1">
            <span></span>
        </li>
        <li class="shape-2 scene"><img data-depth="2"
                                       src="<?php echo base_url('uploads/system/images/about/shape-13.png') ?>"
                                       alt="shape"></li>
        <li class="shape-3 scene"><img data-depth="-2"
                                       src="<?php echo base_url('uploads/system/images/about/shape-15.png') ?>"
                                       alt="shape"></li>
        <li class="shape-4">
            <span></span>
        </li>
        <li class="shape-5 scene"><img data-depth="2"
                                       src="<?php echo base_url('uploads/system/images/about/shape-07.png') ?>"
                                       alt="shape"></li>
    </ul>
</div>

<!--=====================================-->
<!--=          Login Area Start         =-->
<!--=====================================-->
<section class="account-page-area section-gap-equal">
    <div class="container position-relative">

        <div class="row g-5 justify-content-center">
            <div class="col-lg-5">
                <div class="login-form-box login-form ">
                    <h3 class="title">Enter the code from your email</h3>
                    <p>
                        Let us know that this email address belongs to you Enter the code from the email sent to
                        <?php echo $this->session->userdata('register_email') ?>
                    </p>
                    <form action="javascript:;" method="post">
                        <div class="form-group">
                            <label for="current-log-email">Verification Code</label>
                            <input type="text" id="verification_code" required
                                   placeholder="verification code">
                        </div>
                        <!--                        <label for="login-email">-->
                        <?php //echo site_phrase('verification_code'); ?><!--:</label>-->
                        <!--                        <input type="text" class="form-control" id = "verification_code" required>-->

                        <div class="form-group">
                            <a href="javascript:;" class="text-left p-3" id="resend_mail_button"
                               onclick="resend_verification_code()">
                                Resend Mail
                                <div id="resend_mail_loader" class="float-left pl-2"></div>
                            </a>
                        </div>
                        <div class="form-group">
                            <button type="submit" onclick="continue_verify()" class="edu-btn btn-medium">Continue <i
                                        class="icon-4"></i></button>

                            <!--                            <a href="javascript:;" onclick="continue_verify()" class="edu-btn btn-medium">Continue</a>-->

                            <!--                            <button type="submit" class="edu-btn btn-medium">Sign in <i class="icon-4"></i></button>-->
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <ul class="shape-group">
            <li class="shape-1 scene"><img data-depth="2" src="<?php echo base_url('uploads/system/images/about/shape-07.png') ?>" alt="Shape"></li>
            <li class="shape-2 scene"><img data-depth="-2" src="<?php echo base_url('uploads/system/images/about/shape-13.png') ?>" alt="Shape"></li>
            <li class="shape-3 scene"><img data-depth="2" src="<?php echo base_url('uploads/system/images/about/shape-02.png') ?>" alt="Shape"></li>
        </ul>
    </div>
</section>
<!--=====================================-->
<!--=        Footer Area Start          =-->
<!--=====================================-->
<!-- Start Footer Area  -->

<script type="text/javascript">
    function continue_verify() {
        var email = '<?= $this->session->userdata('register_email'); ?>';
        var verification_code = $('#verification_code').val();
        $.ajax({
            type: 'post',
            url: '<?php echo site_url('login/verify_email_address/'); ?>',
            data: {verification_code: verification_code, email: email},
            success: function (response) {
                if (response) {
                    window.location.replace('<?= site_url('home/login'); ?>');
                } else {
                    location.reload();
                }
            }
        });
    }

    function resend_verification_code() {
        $("#resend_mail_loader").html('<img src="<?= base_url('assets/global/gif/page-loader-3.gif'); ?>" style="width: 25px;">');
        var email = '<?= $this->session->userdata('register_email'); ?>';
        $.ajax({
            type: 'post',
            url: '<?php echo site_url('login/resend_verification_code/'); ?>',
            data: {email: email},
            success: function (response) {
                toastr.success('<?php echo site_phrase('mail_successfully_sent_to_your_inbox');?>');
                $("#resend_mail_loader").html('');
            }
        });
    }
</script>


<?php $this->load->view('frontend/default/include/footer'); ?>
