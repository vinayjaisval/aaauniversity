<?php $this->load->view('frontend/default/include/header'); ?>

<div class="edu-breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="page-title">
                <h1 class="title">Contact Us</h1>
            </div>
            <ul class="edu-breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Home</a></li>
                <li class="separator"><i class="icon-angle-right"></i></li>
                <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
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
<!--=       Contact Me Area Start       =-->
<!--=====================================-->
<section class="contact-us-area">
    <div class="container">
        <div class="row g-5">
            <div class="col-xl-4 col-lg-6">
                <div class="contact-us-info">
                    <h3 class="heading-title">We're Always Eager to Hear From You!</h3>
                    <ul class="address-list">
                        <li>
                            <h5 class="title">Address</h5>
                            <br>
                            
                          <p> <b style="    color: #00276c;">Head Office :- </b> B-37, 1st FLOOR,, Sector 2, Noida, Uttar Pradesh 201301
                          </p>
                            <p> <b style="    color: #00276c;">Gorakhpur :-</b> H N 708, Near Jain Eye Hospital, Mohaddipur, Gorakhpur
                            </p>
                            <p> <b style="    color: #00276c;">Patna :-</b> Trishul Market, Near Goraknath Complex, Boring Canal Rd, opp. Hotel Lalita, Patna, Bihar 800001
                            </p>
                          
                        </li>
                        <li>
                            <h5 class="title">Email</h5>
                            <p><a href="mailto:info@ekonacademy.com">info@ekonacademy.com</a></p>
                        </li>
                        <li>
                            <h5 class="title">Phone</h5>
        <p><a href="tel:+918414003455"> (+91) 8414003455 </a></p>
                        </li>
                    </ul>
                    <ul class="social-share">
                        <li><a href="#"><i class="icon-share-alt"></i></a></li>
                        <li><a href="#"><i class="icon-facebook"></i></a></li>
                        <li><a href="#"><i class="icon-twitter"></i></a></li>
                        <li><a href="#"><i class="icon-linkedin2"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="offset-xl-2 col-lg-6">
                <div class="contact-form form-style-2">
                    <div class="section-title">
                        <h4 class="title">Get In Touch</h4>
                        <p>Fill out this form for booking a consultant advising session.</p>
                    </div>
                    <form action="<?php echo base_url('home/contact_us_form') ?>" method="post">
                        <div class="row row--10">
                            <div class="form-group col-12">
                                <input type="text" name="contact-name" id="contact-name" onkeypress="return /[A-Z]/i.test(event.key)" placeholder="Your name"
                                       required>
                            </div>
                            <div class="form-group col-12">
                                <input type="email" name="contact-email" id="contact-email" 
                                       placeholder="Enter your email">
                            </div>
                            <div class="form-group col-12">
                                <input type="text" maxlength="10" name="contact-phone" id="contact-phone" onkeypress="return /[0-9]/i.test(event.key)"
                                       placeholder="Phone number">
                            </div>
                            <div class="form-group col-12">
                                <textarea name="contact-message" id="contact-message" cols="30" rows="4"
                                          placeholder="Your message"></textarea>
                            </div>
                            <div class="form-group col-12">
                                <!--                                        <input type="submit" value="Sub,mit">-->
                                <button class="edu-btn btn-medium submit-btn" style="cursor: pointer" type="submit">
                                    Submit Message <i class="icon-4"></i></button>
                            </div>
                        </div>
                    </form>
                    <ul class="shape-group">
                        <li class="shape-1 scene"><img data-depth="1"
                                                       src="<?php echo base_url('uploads/system/images/about/shape-13.png') ?>"
                                                       alt="Shape"></li>
                        <li class="shape-2 scene"><img data-depth="-1"
                                                       src="<?php echo base_url('uploads/system/images/about/shape-02.png') ?>"
                                                       alt="Shape"></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=====================================-->
<!--=      Google Map Area Start        =-->
<!--=====================================-->
<div class="google-map-area">
    <div class="mapouter">
        <div class="gmap_canvas">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3562.997687143012!2d83.38055779999999!3d26.7444499!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39914501691b608d%3A0xe4289ebd31708cf8!2sEkon%20Academy!5e0!3m2!1sen!2sin!4v1668763142039!5m2!1sen!2sin"
                    width="100%" height="600px" allowfullscreen="" frameborder="0" scrolling="no" marginheight="0"
                    marginwidth="0" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <!--                    <iframe id="gmap_canvas" src="https://goo.gl/maps/dnTU4adVbWWoUuBg9" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>-->
        </div>
    </div>
</div>

<!--=====================================-->
<!--=        Footer Area Start          =-->
<!--=====================================-->
<!-- Start Footer Area  -->

<?php $this->load->view('frontend/default/include/footer'); ?>
