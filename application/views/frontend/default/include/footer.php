<style>
    .social-share li {
        padding-bottom: 10px;
    }
    .eARkMz{
        display: none;
    }
    .dmopMx{
        display: none;
    }
    .iILOR{
        display: none;
    }
    .fXBuHm{
        di
    }
</style>

<footer class="edu-footer footer-lighten bg-image footer-style-1">
    <div class="footer-top">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <div class="edu-footer-widget">
                        <div class="logo">
                            <a href="index.html">
                                <img class="logo-light"
                                     src="<?php echo base_url() . 'assets/frontend/default/assets/unilogo.png' ?>"
                                     STYLE="height: 100PX;" alt="Corporate Logo">
                                <img class="logo-dark"
                                     src="<?php echo base_url() . 'assets/frontend/default/assets/unilogo.png' ?>"
                                     alt="Corporate Logo">
                            </a>
                        </div>
                        <p class="description">The AAA University is an initiative of Ekon Solutions India Pvt Ltd that
                            provides learning opportunities for students and professionals in tier 2-3 cities and rural
                            areas of India. We provide comprehensive learning options, hands-on projects, & courses with
                            guaranteed placement assistance.</p>
                        <div class="widget-information">
                            <ul class="information-list">
                                <li><span> <b>Head Office:-</b> </span>B-37, 1st floor, Sector 2, Noida, Uttar Pradesh
                                    201301
                                </li>


                                <li><span>Call:</span><a href="tel:+91 8130331835">+91 8130331835</a></li>
                                <li><span>Email:</span><a href="mailto:info@aaatechnologies.co.in" target="_blank">info@aaatechnologies.co.in</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="edu-footer-widget explore-widget">
                        <h4 class="widget-title"> Courses</h4>
                        <div class="inner">
                            <ul class="footer-link link-hover">
                                <?php
                                $categories = $this->crud_model->get_categorie()->result_array();
                                foreach ($categories as $key => $category):

//                                                    $icon = $this->crud_model->course_icon_by_id($category['id'])
                                    ?>
                                    <li>
                                        <a href="<?php echo site_url('home/courses?category=' . $category['slug']); ?>">

                                            <!--                                             <i class="-->
                                            <?php //echo $category['font_awesome_class']
                                            ?><!--" aria-hidden="true"></i>-->

                                            <?php echo $category['name']; ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="edu-footer-widget quick-link-widget">
                        <h4 class="widget-title"> Quick Links</h4>
                        <div class="inner">
                            <ul class="footer-link link-hover">
                                <li><a href="<?php echo base_url() ?>">Home</a></li>
                                <li><a href="<?php echo base_url('home/about_us') ?>">About us</a></li>
                                <li><a href="<?php echo base_url('home/contact_us') ?>">Contact Us</a></li>
                                <li><a href="<?php echo base_url('home/courses') ?>">Courses</a></li>
                                <!--                                 <li><a href="blog.php">Blog</a></li>-->
                                <li><a href="<?php echo base_url('home/privacy_policy') ?>">Privacy policy</a></li>
                                <li><a href="<?php echo base_url('home/terms_and_condition') ?>"> Terms and
                                        condition</a></li>
                                <li><a href="<?php echo base_url('home/cancellation_and_refund_policy') ?>">
                                        Cancellation and refund policy</a></li>
                                <li><a href="<?php echo base_url('home/gallery') ?>">
                                        Gallery</a></li>
                                <li><a href="<?php echo base_url('home/placement_cell') ?>">
                                        Placement Cell</a></li>

                                         <li >
                                    <a href="<?php echo base_url('home/branches'); ?>"
                                     >
                                        
                                        Ours Branches</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="edu-footer-widget">
                        <h4 class="widget-title">Social Links</h4>
                        <div class="inner">
                            


                            <ul class="social-share icon-transparent">
                                <li><a href="https://www.facebook.com/ekonacademyofficial" class="color-fb" target="_blank"><i
                                                class="icon-facebook"> </i><span style="color: #484848">Facebook</span></a>
                                </li>
                            </ul>
                            <ul class="social-share icon-transparent">
                                <li><a href="https://www.linkedin.com/company/ekon-academy/" class="color-linkd" target="_blank"><i
                                                class="icon-linkedin2"> </i><span style="color: #484848">Linkedin</span></a>
                                </li>
                            </ul>
                            <ul class="social-share icon-transparent">
                                <li><a href="https://instagram.com/ekonacademyofficial" class="color-ig" target="_blank"><i
                                                class="icon-instagram"> </i><span
                                                style="color: #484848">Instagram</span></a></li>
                            </ul>
                            <ul class="social-share icon-transparent">
                                <li><a href="https://twitter.com/EkonAcademy" class="color-twitter" target="_blank"><i
                                                class="icon-twitter"> </i><span
                                                style="color: #484848">Twitter</span></a></li>
                            </ul>
                            <ul class="social-share icon-transparent">
                                <li><a href="https://www.youtube.com/@ekonacademy/" class="color-yt" target="_blank"><i class="icon-youtube" > </i><span
                                                style="color: #484848">YouTube</span></a></li>
                            </ul>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner text-center">
                        <p>Copyright 2022 <a href="https://ekonacademy.com/" target="_blank">AAA University</a> Designed
                            By <a href="https://www.ekonindia.com/" target="_blank"> EKON Solutions India Private
                                Limited</a>. All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


</div>

<div class="rn-progress-parent">
    <svg class="rn-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
    </svg>
</div>

<!-- GetButton.io widget -->
<script type="text/javascript">

    (function () {
        var options = {
            call: "8130331835", // Call phone number
            whatsapp: "8130331835", // WhatsApp number
            call_to_action: "Message us", // Call to action
            button_color: "#FF6550", // Color of button
            position: "left", // Position may be 'right' or 'left'
            order: "call,whatsapp", // Order of buttons
        };

        var proto = 'https:',
            host = "getbutton.io",
            url = proto + '//static.' + host;
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () {
            WhWidgetSendButton.init(host, proto, options);
        };
        var x = document.getElementsByTagName('script')[0];
        x.parentNode.insertBefore(s, x);
    })();
</script>

<?php
// $this->load->view('frontend/default/chatbot.php')
?>



<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/64a3f37994cf5d49dc61700a/1h4g6u5fr';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>


<!-- JS
   ============================================ -->
     <script src="https://unpkg.com/ityped@0.0.10"></script>
<script src="<?php echo base_url() . 'assets/frontend/default/assets/js/vendor/modernizr.min.js' ?>"></script>
<!-- Jquery Js -->
<script src="<?php echo base_url() . 'assets/frontend/default/assets/js/vendor/jquery.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default/assets/js/vendor/bootstrap.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default/assets/js/vendor/sal.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default/assets/js/vendor/backtotop.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default/assets/js/vendor/magnifypopup.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default/assets/js/vendor/jquery.countdown.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default/assets/js/vendor/odometer.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default/assets/js/vendor/isotop.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default/assets/js/vendor/imageloaded.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default/assets/js/vendor/lightbox.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default/assets/js/vendor/paralax.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default/assets/js/vendor/paralax-scroll.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default/assets/js/vendor/jquery-ui.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default/assets/js/vendor/swiper-bundle.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default/assets/js/vendor/svg-inject.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default/assets/js/vendor/vivus.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default/assets/js/vendor/tipped.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default/assets/js/vendor/smooth-scroll.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/frontend/default/assets/js/vendor/isInViewport.jquery.min.js' ?>"></script>

<!-- Site Scripts -->
<script src="<?php echo base_url() . 'assets/frontend/default/assets/js/app.js' ?>"></script>


<?php
if ($_SESSION['user_login']) {
    echo "<script>
            setTimeout(logout, 300000)
        
            function logout() {
                window.location = '" . base_url('login/logout') . "'
            }
          </script>";
}
?>
 <script>
            window.ityped.init(document.querySelector('.ityped'),{
                strings: [' Diploma In Cyber Security   ','Diploma In Cyber Forensic  ','Diploma In Cyber Security Audit', 'SOC'],
                loop: true
            })
    </script>
    <script>
            // array to store strings
            var poem = ["100% Job Placements.","Free Sessions for PD & PC",];
            var i = 0;
            // text animation loop
            var animInterval = window.setInterval(
            function(){
                document.querySelector("#text").textContent = poem[i];
                i = ++i % poem.length;
            },2500 /*1000ms = 1sec*/
            );
    </script>
</body>

</html>