

        <!--=====================================-->
        <!--=        Header Area Start       	=-->
        <!--=====================================-->
        <?php $this->load->view('frontend/default/include/header'); ?>
        <!--=====================================-->
        <!--=       Breadcrumb Area Start      =-->
        <!--=====================================-->


        <div class="edu-breadcrumb-area breadcrumb-style-2 bg-image bg-image--19">
            <div class="container">
                <div class="breadcrumb-inner">
                    <div class="page-title">
                        <h1 class="title">About Us</h1>
                    </div>
                    <ul class="edu-breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="separator"><i class="icon-angle-right"></i></li>
                        <li class="breadcrumb-item active" aria-current="page">About Us </li>
                    </ul>
                </div>
            </div>
        </div>

        <!--=====================================-->
        <!--=       Why Choose Area Start       =-->
        <!--=====================================-->
        <!-- Start Why Choose Area  -->
        <section class="why-choose-area-3 edu-section-gap">
            <div class="container">
                <div class="row row--45">
                    <div class="section-title-flex section-title" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        <div class="right-content">
                           <h2 class="title"> Best learning experience.<br> Guaranteed.</h2>
                            <span class="shape-line"><i class="icon-19"></i></span>
                        </div>
                        <div class="right-content">
                            <?php echo get_frontend_settings('about_us'); ?>
                        </div>
                    </div>
                </div>

                <div class="row g-5">
                    <div class="col-lg-4" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        <div class="why-choose-box-2 features-box color-primary-style">
                        <div class="icon color-extra02"><i class="icon-51"></i></div>
                            <div class="content">
                                <h4 class="title">Mission</h4>
                                <?php echo get_frontend_settings('about_us_mission'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        <div class="why-choose-box-2 features-box color-secondary-style">
                            <div class="icon">
                                <i class="icon-52"></i>
                            </div>
                            <div class="content">
                                <h4 class="title"> Our Vision</h4>
                                <?php echo get_frontend_settings('about_us_vision'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        <div class="why-choose-box-2 features-box color-extra08-style">
                            <div class="icon">
                                <i class="icon-47"></i>
                            </div>
                            <div class="content">
                                <h4 class="title">Values</h4>
                                <?php echo get_frontend_settings('about_us_values'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="shape-group">
                <li class="shape-1 scene">
                    <span data-depth=".8"></span>
                </li>
                <li class="shape-2 scene">
                    <img data-depth="-2" src="<?php echo base_url('uploads/system/images/about/shape-13.png')?>" alt="shape">
                </li>
                <li class="shape-3">
                    <img data-parallax='{"x": 0, "y": 100}' src="<?php echo base_url('uploads/system/images/about/shape-12.png')?>" alt="shape">
                </li>
            </ul>
        </section>

        <!--
        <div class="testimonial-area-2 edu-section-gap">
            <div class="container edublink-animated-shape">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="section-title section-center" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                            <span class="pre-title">Testimonials</span>
                            <h2 class="title">What Our <span class="color-secondary">Students</span> <br> Have To Say</h2>
                            <span class="shape-line"><i class="icon-19"></i></span>
                            <p>Our student's words and feedbacks about us say everything about our legacy.</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-activation swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="testimonial-slide">
                                <div class="content">
                                    <div class="logo"><img src="assets/images/testimonial/logo-01.png" alt="Logo"></div>
                                    <p>This workshop is very useful for us. It gives a lot of knowledge and also learning about many such new technologies in modern era. It also gives us motivation to enjoy and learning lots of things in an easy and simple way. Thank you"</p>
                                    <div class="rating-icon">
                                        <i class="icon-23"></i>
                                        <i class="icon-23"></i>
                                        <i class="icon-23"></i>
                                        <i class="icon-23"></i>
                                        <i class="icon-23"></i>
                                    </div>
                                </div>
                                <div class="author-info">
                                    <div class="thumb">
                                        <img src="assets/images/testimonial/testimonial-01.png" alt="Testimonial">
                                    </div>
                                    <div class="info">
                                        <h5 class="title">Haley Bennet</h5>
                                        <span class="subtitle">Designer</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-slide">
                                <div class="content">
                                    <div class="logo"><img src="assets/images/testimonial/logo-02.png" alt="Logo"></div>
                                    <p>Brilliant session! Thank you Sir “this was a fabulous session! it was marvellous. this is such a fun and informative course and Absolutely a very inspiring and fantastic day.</p>
                                    <div class="rating-icon">
                                        <i class="icon-23"></i>
                                        <i class="icon-23"></i>
                                        <i class="icon-23"></i>
                                        <i class="icon-23"></i>
                                        <i class="icon-23"></i>
                                    </div>
                                </div>
                                <div class="author-info">
                                    <div class="thumb">
                                        <img src="assets/images/testimonial/testimonial-03.png" alt="Testimonial">
                                    </div>
                                    <div class="info">
                                        <h5 class="title">Simon Baker</h5>
                                        <span class="subtitle">Designer</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-slide">
                                <div class="content">
                                    <div class="logo"><img src="assets/images/testimonial/logo-03.png" alt="Logo"></div>
                                    <p>This workshop is very useful for us. It gives a lot of knowledge and also learning about many such new technologies in modern era.It also gives us motivation to enjoy and learning lots of things in an easy and simple way. Thank you".</p>
                                    <div class="rating-icon">
                                        <i class="icon-23"></i>
                                        <i class="icon-23"></i>
                                        <i class="icon-23"></i>
                                        <i class="icon-23"></i>
                                        <i class="icon-23"></i>
                                    </div>
                                </div>
                                <div class="author-info">
                                    <div class="thumb">
                                        <img src="assets/images/testimonial/testimonial-02.png" alt="Testimonial">
                                    </div>
                                    <div class="info">
                                        <h5 class="title">Richard Gere</h5>
                                        <span class="subtitle">Designer</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonial-slide">
                                <div class="content">
                                    <div class="logo"><img src="assets/images/testimonial/logo-02.png" alt="Logo"></div>
                                    <p>It was excellent but sir in future try to take the dataset related to any organization because it will be easy to understand for students.</p>
                                    <div class="rating-icon">
                                        <i class="icon-23"></i>
                                        <i class="icon-23"></i>
                                        <i class="icon-23"></i>
                                        <i class="icon-23"></i>
                                        <i class="icon-23"></i>
                                    </div>
                                </div>
                                <div class="author-info">
                                    <div class="thumb">
                                        <img src="assets/images/testimonial/testimonial-03.png" alt="Testimonial">
                                    </div>
                                    <div class="info">
                                        <h5 class="title">Simon Baker</h5>
                                        <span class="subtitle">Designer</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
                <ul class="shape-group">
                    <li class="shape-1 scene" data-sal-delay="200" data-sal="fade" data-sal-duration="1000">
                        <img data-depth="1.4" src="assets/images/about/shape-30.png" alt="Shape">
                    </li>
                    <li class="shape-2 scene" data-sal-delay="200" data-sal="fade" data-sal-duration="1000">
                        <img data-depth="-1.4" src="assets/images/about/shape-25.png" alt="Shape">
                    </li>
                </ul>
            </div>
            <ul class="shape-group">
                <li class="shape-3" data-sal-delay="200" data-sal="fade" data-sal-duration="1000">
                    <img src="assets/images/others/map-shape-3.png" alt="Shape">
                </li>
            </ul>
        </div>
        -->
        <!-- End Testimonial Area  -->
        <!--=====================================-->
        <!--=       CounterUp Area Start        =-->
        <!--=====================================-->
        <div class="counterup-area-7 section-gap-equal">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-5">
                        <div class="counterup-content">
                            <div class="section-title section-left" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                                <h3 class="title">Served 500+ Students .<br>
                                    Now, it’s your turn to take your career to the next level.
                                </h3>
                                <span class="shape-line"><i class="icon-19"></i></span>
                               <p>
                                    Over 500 students have been trained and placed in jobs
                                    across a variety of industries since we started. Our aim is
                                    to be among the top educational institutions in the country by
                                    providing quality training and education.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="counterup-box-wrap">
                            <div class="counterup-box counterup-box-1">
                                <div class="edu-counterup counterup-style-2">
                                    <h2 class="counter-item count-number primary-color">
                                        <?php $total_user = $this->crud_model->get_only_user()->num_rows();
                                        $change_value = $total_user * 11;

                                        $data = $this->lazyload->thousand_upper_number_change_in_k($change_value);
                                        $new_data = explode("/", $data)
                                        //                                echo $data;
                                        //                                die();
                                        ?>
                                        <span class="odometer"
                                              data-odometer-final="<?php echo $new_data[0]; ?>">.</span><span><?php echo $new_data[1]; ?></span>
                                    </h2>
                                    <h6 class="title">Student Enrolled</h6>
                                </div>
                                <div class="edu-counterup counterup-style-2">
                                    <h2 class="counter-item count-number secondary-color">
                                        <span class="odometer" data-odometer-final="32.4">.</span><span>K</span>
                                    </h2>
                                    <h6 class="title">Class Completed</h6>
                                </div>
                            </div>
                            <div class="counterup-box counterup-box-2">
                                <div class="edu-counterup counterup-style-2">
                                    <h2 class="counter-item count-number extra05-color">
                                        <span class="odometer" data-odometer-final="354">.</span><span>+</span>
                                    </h2>
                                    <h6 class="title">Top Instructors</h6>
                                </div>
                                <div class="edu-counterup counterup-style-2">
                                    <h2 class="counter-item count-number extra02-color">
                                        <span class="odometer" data-odometer-final="99.9">.</span><span>%</span>
                                    </h2>
                                    <h6 class="title">Satisfaction Rate</h6>
                                </div>
                            </div>
                            <ul class="shape-group">
                                <li class="shape-1 scene">
                                    <img data-depth="-2" src="<?php echo base_url('uploads/system/images/about/shape-13.png')?>" alt="Shape">
                                </li>
                                <li class="shape-2">
                                    <img class="rotateit" src="<?php echo base_url('uploads/system/images/about/shape-02.png')?>" alt="Shape">
                                </li>
                                <li class="shape-3 scene">
                                    <img data-depth="1.6" src="<?php echo base_url('uploads/system/images/about/shape-04.png')?>" alt="Shape">
                                </li>
                                <li class="shape-4 scene">
                                    <img class="rotateit" src="<?php echo base_url('uploads/system/images/about/shape-02.png')?>" alt="Shape">                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
           <!-- Start Footer Area  -->
           <?php $this->load->view('frontend/default/include/footer'); ?>