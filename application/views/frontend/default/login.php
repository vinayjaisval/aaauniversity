<?php if (get_frontend_settings('recaptcha_status')): ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php endif;

//if ($this->session->flashdata('error_message')){
//    echo "<script> alert('".$this->session->flashdata('error_message')."')</script>";
//}
?>



<?php $this->load->view('frontend/default/include/header'); ?>


<!--<div class="edu-breadcrumb-area" onload="hide_form()">-->

    <!--    <h2>--><?php //echo $this->session->flashdata('error_message'); ?><!--</h2>-->

<!--    <div class="container">-->
<!--        <div class="breadcrumb-inner">-->
<!--            <div class="page-title">-->
<!--                <h1 class="title"> Sign in</h1>-->
<!--            </div>-->
<!--            <ul class="edu-breadcrumb">-->
<!--                <li class="breadcrumb-item"><a href="index.html">Home</a></li>-->
<!--                <li class="separator"><i class="icon-angle-right"></i></li>-->

<!--                <li class="breadcrumb-item active" aria-current="page">sign in</li>-->
<!--            </ul>-->
<!--        </div>-->
<!--    </div>-->
<!--    <ul class="shape-group">-->
<!--        <li class="shape-1">-->
<!--            <span></span>-->
<!--        </li>-->
<!--        <li class="shape-2 scene"><img data-depth="2"-->
<!--                                       src="<?php echo base_url('uploads/system/images/about/shape-13.png') ?>"-->
<!--                                       alt="shape"></li>-->
<!--        <li class="shape-3 scene"><img data-depth="-2"-->
<!--                                       src="<?php echo base_url('uploads/system/images/about/shape-15.png') ?>"-->
<!--                                       alt="shape"></li>-->
<!--        <li class="shape-4">-->
<!--            <span></span>-->
<!--        </li>-->
<!--        <li class="shape-5 scene"><img data-depth="2"-->
<!--                                       src="<?php echo base_url('uploads/system/images/about/shape-07.png') ?>"-->
<!--                                       alt="shape"></li>-->

<!--    </ul>-->
<!--</div>-->

<!--=====================================-->
<!--=          Login Area Start         =-->
<!--=====================================-->
<section class="account-page-area section-gap-equal">
    <div class="container position-relative">

        <div class="row g-5 justify-content-center">
            <div class="col-lg-5">
                <div class="login-form-box login-form ">
                    <h3 class="title">Sign in</h3>
                    <p>Don’t have an account? <a href="<?php echo site_url('home/sign_up'); ?>">Sign up</a></p>
                    <form class="was-validated" action="<?php echo site_url('login/validate_login/user'); ?>"
                          method="post">
                        <?php
                        if (!$this->session->flashdata('error_message')) {
                            ?>
                            <div class="form-group">
                                <label for="current-log-email">Username or email*</label>
                                <input type="email" name="email" id="current-log-email"
                                       placeholder="Email or username">
                            </div>


                            <?php
                        } else {
                            ?>
                            <div class="form-group">
                                <label for="validationCustom05" class="form-label">Username or email*</label>
                                <input type="email" name="email" class="form-control" id="validationCustom05" required>
                                <div class="invalid-feedback">
                                    This Credential Don't Match Our Records
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                        <div class="form-group">
                            <label for="current-log-password">Password*</label>
                            <input type="password" name="password" id="myInput"
                                   placeholder="Password">
                            <span class="password-show"><i class="icon-76" onclick="myFunction()"></i></span>
                        </div>





                        <?php if (get_frontend_settings('recaptcha_status')): ?>
                            <div class="form-group">
                                <div class="g-recaptcha"
                                     data-sitekey="<?php echo get_frontend_settings('recaptcha_sitekey'); ?>"></div>
                            </div>
                        <?php endif; ?>
                        <div class="form-group chekbox-area">
                            <div class="edu-form-check">
                                <input type="checkbox" id="remember-me">
                                <label for="remember-me">Remember Me</label>
                            </div>
                            <a href="javascript::"
                               onclick="toggoleForm('forgot_password')"><?php echo site_phrase('forgot_password'); ?></a>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="edu-btn btn-medium">Sign in <i class="icon-4"></i></button>
                        </div>
                    </form>
                </div>


                <div class="login-form-box forgot-password-form">
                    <h3 class="title">Forget Password</h3>
                    <div class="content-title-box">
                        <div class="subtitle"><?php echo site_phrase('provide_your_email_address_to_get_password'); ?>
                            .
                        </div>
                    </div>

                    <form action="<?php echo site_url('login/forgot_password/frontend'); ?>"
                          method="post"
                          id="forgot_password">

                        <div class="content-box">
                            <div class="basic-group">
                                <div class="form-group">
                                    <label for="current-log-email">Username or email*</label>
                                    <input type="email" name="email" id="current-log-email"
                                           placeholder="Email or username">
                                    <small class="form-text text-muted">
                                        <?php echo site_phrase('provide_your_email_address_to_get_password'); ?>
                                    </small>
                                </div>
                                <?php if (get_frontend_settings('recaptcha_status')): ?>
                                    <div class="form-group">
                                        <div class="g-recaptcha"
                                             data-sitekey="<?php echo get_frontend_settings('recaptcha_sitekey'); ?>"></div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="edu-btn btn-medium mt-5"
                                    type="submit"><?php echo site_phrase('reset_password'); ?></button>
                        </div>

                        <div class="forgot-pass text-center">
                            <?php echo site_phrase('want_to_go_back'); ?>?
                            <a href="javascript::"
                               onclick="toggoleForm('login')"><?php echo site_phrase('login'); ?></a>
                        </div>
                    </form>
                </div>

            </div>

        </div>
        <ul class="shape-group">
            <li class="shape-1 scene"><img data-depth="2"
                                           src="<?php echo base_url('uploads/system/images/about/shape-07.png') ?>"
                                           alt="Shape"></li>
            <li class="shape-2 scene"><img data-depth="-2"
                                           src="<?php echo base_url('uploads/system/images/about/shape-13.png') ?>"
                                           alt="Shape"></li>
            <li class="shape-3 scene"><img data-depth="2"
                                           src="<?php echo base_url('uploads/system/images/about/shape-02.png') ?>"
                                           alt="Shape"></li>
        </ul>
    </div>
</section>
<!--=====================================-->
<!--=        Footer Area Start          =-->
<!--=====================================-->
<!-- Start Footer Area  -->

<script type="text/javascript">
    function toggoleForm(form_type) {
        if (form_type === 'login') {
            $('.login-form').show();
            $('.forgot-password-form').hide();
            $('.register-form').hide();
        } else if (form_type === 'registration') {
            $('.login-form').hide();
            $('.forgot-password-form').hide();
            $('.register-form').show();
        } else if (form_type === 'forgot_password') {
            $('.login-form').hide();
            $('.forgot-password-form').show();
            $('.register-form').hide();
        } else if (form_type === "") {
            console.log("null");
            $('.login-form').show();
            $('.forgot-password-form').hide();
            $('.register-form').hide();
        }
    }

    window.onload = function hide_form() {
        $('.forgot-password-form').hide();
        $('.register-form').hide();
    }

</script>
<script>
    function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>


<?php $this->load->view('frontend/default/include/footer'); ?>
