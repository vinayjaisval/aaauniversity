<?php $this->load->view('frontend/default/include/header'); ?>

        <div class="edu-breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-inner">
                    <div class="page-title">
                        <h1 class="title"> Sign up</h1>
                    </div>
                    <ul class="edu-breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
                        <li class="separator"><i class="icon-angle-right"></i></li>
                  
                        <li class="breadcrumb-item active" aria-current="page">sign up</li>
                    </ul>
                </div>
            </div>
            <ul class="shape-group">
                <li class="shape-1">
                    <span></span>
                </li>
                <li class="shape-2 scene"><img data-depth="2" src="<?php echo base_url('uploads/system/images/about/shape-13.png')?>" alt="shape"></li>
                <li class="shape-3 scene"><img data-depth="-2" src="<?php echo base_url('uploads/system/images/about/shape-15.png')?>" alt="shape"></li>
                <li class="shape-4">
                    <span></span>
                </li>
                <li class="shape-5 scene"><img data-depth="2" src="<?php echo base_url('uploads/system/images/about/shape-07.png')?>" alt="shape"></li>
            </ul>
        </div>

        <!--=====================================-->
        <!--=          Login Area Start         =-->
        <!--=====================================-->
        <section class="account-page-area section-gap-equal">
            <div class="container position-relative">
                <div class="row g-5 justify-content-center">
                    <div class="col-lg-5">
                        <div class="login-form-box registration-form">
                            <h3 class="title">Registration</h3>
                            <p>Already have an account? <a href="<?php echo base_url('home/login')?>">Sign in</a></p>
                            <form action="<?php echo site_url('login/register'); ?>" method="post">
                                <div class="form-group">
                                    <label for="reg-name">First Name*</label>
                                    <input type="text" onkeypress="return /[a-z]/i.test(event.key)" name="first_name" id="reg-name" placeholder="First name" required>
                                </div>

                                <div class="form-group">
                                    <label for="reg-name">Last Name*</label>
                                    <input type="text" onkeypress="return /[a-z]/i.test(event.key)" name="last_name" id="reg-name" placeholder="Last name" required>
                                </div>

                                <div class="form-group">
                                    <label for="contact">Mobile Number</label>
                                    <input type="text" onkeypress="return /[0-9]/i.test(event.key)" name="contact" id="contact" maxlength="10" placeholder="Your Mobile Number " required>
                                </div>
                                <div class="form-group">
                                    <label for="log-email">Username or email*</label>
                                    <input type="email" name="email" id="log-email" placeholder="Email or username" required>
                                </div>
                                <div class="form-group">
                                    <label for="log-password">Password*</label>
                                    <input type="password" name="password" id="myInput" placeholder="Password" required>
                                    <span class="password-show"><i class="icon-76" onclick="myFunction()"></i></span>
                                </div>
                                <div class="form-group chekbox-area">
                                    <div class="edu-form-check">
                                        <input type="checkbox" id="terms-condition" required>
                                        <label for="terms-condition">I agree the User Agreement and <a href="<?php echo base_url('home/terms_and_condition')?>">Terms & Condition.</a> </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="edu-btn btn-medium">Create Account <i class="icon-4"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <ul class="shape-group">
                    <li class="shape-1 scene"><img data-depth="2" src="<?php echo base_url('uploads/system/images/about/shape-07.png')?>" alt="Shape"></li>
                    <li class="shape-2 scene"><img data-depth="-2" src="<?php echo base_url('uploads/system/images/about/shape-13.png')?>" alt="Shape"></li>
                    <li class="shape-3 scene"><img data-depth="2" src="<?php echo base_url('uploads/system/images/about/shape-02.png')?>" alt="Shape"></li></ul>
            </div>
        </section>
        <!--=====================================-->
        <!--=        Footer Area Start          =-->
        <!--=====================================-->
        <!-- Start Footer Area  -->

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
