<?php
$this->load->view('frontend/default/include/header');
?>


    <!---->
    <!--        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
    <!--    <link rel="stylesheet" href="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/default_thank_you.css">-->
    <!--    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">-->

    <!--    animati.css -->

    <style>
    </style>

    </head style="background: #e8e8e8 !important; ">
    <body style="padding: 0 0px;margin: 0px 0px;background: #eee; ">


    <?php if ($type == "success"){?>
    <div style="margin: 90px; text-align: center;">
        <header class="site-header" id="header">
            <center><a href="<?php echo base_url()?>">
                    <img src="<?php echo base_url('assets/frontend/default/assets/unilogo.png') ?>" style="height: 100px;"/> </a></center>
            <br>
            <h1 style="color: green" class="site-header_title animateanimated animate_backInDown " data-lead-id="site-header-title">THANK
                YOU!</h1>
<!--            <h6 style="color: green" class="site-header_title animateanimated animate_backInDown " data-lead-id="site-header-title">-->
<!--                YOUR PAYMENT SUCCESSFULLY COMPLETE!-->
<!--            </h6>-->
        </header>
        <div class="main-content">
            <i class="fa fa-check main-content_checkmark  animateanimated  animate_rotateIn" id="checkmark"
               style="font-size: 70px ;color: green;"></i>
            <br>
            <p class="main-content__body" data-lead-id="main-content-body" style="color:black">Thank You<br>
                START LEARNING</p>
            <p><a href="<?php echo base_url('home/my_courses')?>" style="color:black"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go to Courses </a>
            </p>
        </div>

    </div>
<?php } elseif ($type == "failed"){?>
    <div style="margin: 90px; text-align: center;">
        <header class="site-header" id="header">
            <center>
                <a href="https://ekonacademy.com/">
                    <img  src="<?php echo base_url('assets/frontend/default/assets/unilogo.png') ?>" style="height: 100px;"/>
                </a>
            </center>
            <br>
            <h1 style="color: #bf5656" class="site-header_title animateanimated animate_backInDown " data-lead-id="site-header-title">
                OPPS! PAYMENT FAILED!</h1>
        </header>
        <div class="main-content">
            <i class="fa fa-close main-content_checkmark  animateanimated  animate_rotateIn" id="checkmark"
               style="font-size: 70px ; color: #BF5656FF;"></i>
            <br>
<!--            <p class="main-content__body" data-lead-id="main-content-body" style="color:black"> Thanks for registering-->
<!--                your intrest in 6 to 8 week Certificate program. Our counsellors will contact you shortly-->
<!--            </p>-->
            <br>
            <p><a href="<?php echo base_url('home/checkout')?>" style="color:black"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go to Checkout Page </a>
            </p>
        </div>
    </div>
    <?php }?>
<script>
    setTimeout(change_url, 4000);

    function change_url() {
        window.location = "<?php echo base_url()?>"
    }
</script>

    </body>


    <!--=====================================-->
    <!--=        Footer Area Start          =-->
    <!--=====================================-->
    <!-- Start Footer Area  -->
<?php
$this->load->view('frontend/default/include/footer');
?>