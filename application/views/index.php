<!--=====================================-->
<!--=        Header Area Start       	=-->
<!--=====================================-->

<?php $this->load->view('frontend/default/include/header'); ?>

<style>
    .sq:hover {
        transform: scale(1.5);
        z-index: 999999999;
    /*}.content{*/
    /*         margin-left: -92px;*/
         }
         h1 { 
    color:#ff8de3;
    font-size:25px;
}
span{
    color:#05256c;
}
h3{ 
   
    font-size:35px;
    color:#2e3092;
}

.blink {
            animation: blinker 1.5s linear infinite;
           
            font-family: sans-serif;
        }
        @keyframes blinker {
            40% {
                opacity: 0;
            }
        }

        .instructor-info.sal-animate {
  box-shadow: 2px 7px 18px 3px #8080801f;
}

#carouselExampleIndicators {
  border-radius: 72px;
}

.hero-banner.hero-style-8 .banner-thumbnail .shape-group li.shape-1 {
  top: 56px;
  left: 162px;
}

.hero-banner .banner-thumbnail .thumbnail {
  text-align: center;
  margin-top: 30px;
}

.imgbnr {
    border-radius: 9px  !important;
    border-style: dotted;
   border-color: blue;
}


    .cstmcolor {
    color: #00266c !important;
    top:12px;
    position: relative;
    font-size: 20px;
    }
    .instructor-info.sal-animate{
        margin-top: 64px;
    }


     
</style>

<div class="hero-banner hero-style-8" style="min-height: 500px;">
    <div class="container edublink-animated-shape">
        <div class="row align-items-center">
            <div class="col-lg-6">
            <h3  id="text" class="blink">100% job placements (Python). </h3>
                <div class="banner-content">
                    <h2 class="title" data-sal-delay="100" data-sal="slide-up" data-sal-duration="1000">
                        Courses that<span class="skl"> Upskill</span> You. <br>
                        Skills that make you <span class="skl"> Employable</span>.
                    </h2>
                    <p> <h1 >Distinctive <span class="ityped"></span></h1></p> 
                     <div class="instructor-info" data-sal-delay="600" data-sal="slide-up" data-sal-duration="1000">
                        <div class="inner">
                           <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
 <!------Dynamic Slider------>
                           <div class="carousel-indicators">
    <?php
    $i=0;
    $banner = $this->crud_model->get_all_banner()->result_array();       
    foreach ($banner as $key => $banner_data) {
      
  ?>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?=$i;?>" <?php if($i==0){ ?> class="active" aria-current="true" <?php } ?>  aria-label="Slide <?=$i;?>"></button>
      <?php ++$i; } ?>
     
    </div>
    <div class="carousel-inner">
    <!----------->
    <?php
    $i=0;
    $banner = $this->crud_model->get_all_banner()->result_array();       
    foreach ($banner as $key => $banner_data) : 
      
  ?>
  <div class="carousel-item <?php if($i==0){ echo 'active';} ?> ">       
  <a href="<?php echo ( $banner_data['url']) ?>">
  <img src="<?php echo base_url().'uploads/banner/'.$banner_data['image'] ?>" alt="vactor Image" class="imgbnr" />
  <div class="carousel-caption ">
                               <h2 class="cstmcolor"><?php echo ( $banner_data['title']) ?> </h2></a>
                              
                             </div>
        </div>
  <?php  ++$i; endforeach; ?>
 
  
  </div> 
   <!----------End Dynamic Slider------------>
  <!-- static slider--->
  <!-- <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    
    <div class="carousel-item active">

    <img src="<?php echo base_url() ?>/assets/frontend/default/assets/images/banner/ddddddd-01.png"  
                             alt="vactor Image" class="imgbnr" >
    </div>

    <div class="carousel-item">
                <img  src="<?php echo base_url() ?>/assets/frontend/default/assets/images/banner/ddddddd-02.png" 
                             alt="vactor Image" class="imgbnr" > </div>
    <div class="carousel-item">
   <img  src="<?php echo base_url() ?>/assets/frontend/default/assets/images/banner/ddddddd-03.png" 
                             alt="vactor Image" class="imgbnr" > </div>
  
  </div> -->
  <!----End Static Slider----->
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="banner-thumbnail">
                    <div class="thumbnail" data-sal-delay="500" data-sal="slide-left" data-sal-duration="1000">
                        <img src="<?php echo base_url() ?>/assets/frontend/default/assets/images/banner/home8-vactor-bg.png"  
                             alt="vactor Image" style="height:400px">
                    </div>
                  
                    <ul class="shape-group">
                        <li class="shape-1" data-sal-delay="1000" data-sal="fade" data-sal-duration="1000">
                            <img data-depth="1.5"
                                 src="<?php echo base_url() . 'assets/frontend/default/assets/images/others/shape-30.png' ?>"
                                 alt="Shape">
                        </li>
                        <li class="shape-2 scene" data-sal-delay="1000" data-sal="fade" data-sal-duration="1000">
                            <img data-depth="2"
                                 src="<?php echo base_url() . 'assets/frontend/default/assets/images/others/shape-31.png' ?>"
                                 alt="Shape">
                        </li>
                        <li class="shape-3 scene shape-light" data-sal-delay="1000" data-sal="fade"
                            data-sal-duration="1000">
                            <img data-depth="-2"
                                 src="<?php echo base_url() . 'assets/frontend/default/assets/images/faq/shape-09.png' ?>"
                                 alt="Shape">
                        </li>
                        <li class="shape-3 scene shape-dark" data-sal-delay="1000" data-sal="fade"
                            data-sal-duration="1000">
                            <img data-depth="-2"
                                 src="<?php echo base_url() . 'assets/frontend/default/assets/images/faq/dark-shape-09.png' ?>"
                                 alt="Shape">
                        </li>
                        <li class="shape-4 scene shape-light" data-sal-delay="1000" data-sal="fade"
                            data-sal-duration="1000">
                            <img data-depth="-2"
                                 src="<?php echo base_url() . 'assets/frontend/default/assets/images/faq/shape-13.png' ?>"
                                 alt="Shape">
                        </li>
                        <li class="shape-4 scene shape-dark" data-sal-delay="1000" data-sal="fade"
                            data-sal-duration="1000">
                            <img data-depth="-2"
                                 src="<?php echo base_url() . 'assets/frontend/default/assets/images/faq/dark-shape-13.png' ?>"
                                 alt="Shape">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="shape-group">
            <li class="shape-5">
                <span></span>
            </li>
            <li class="shape-6 scene" data-sal-delay="1000" data-sal="fade" data-sal-duration="1000">
                <img data-depth="1.2"
                     src="<?php echo base_url() . 'assets/frontend/default/assets/images/others/shape-32.png' ?>"
                     alt="Shape">
            </li>
        </ul>
    </div>
</div>
<!--=====================================-->
<!--=       Brand Area Start      		=-->
<!--=====================================-->
<!-- Start Brand Area  -->
<div class="edu-brand-area brand-area-6">
    <div class="container">
        <div class="brand-grid-wrap brand-style-2">
            <div class="brand-grid">
                <img src="<?php echo base_url() . 'assets/frontend/default/assets/images/brand/brand-14.png' ?>"
                     alt="Brand Logo">
            </div>
            <div class="brand-grid">
                <img src="<?php echo base_url() . 'assets/frontend/default/assets/images/brand/brand-15.png' ?>"
                     alt="Brand Logo">
            </div>
            <div class="brand-grid">
                <img src="<?php echo base_url() . 'assets/frontend/default/assets/images/brand/brand-16.png' ?>"
                     alt="Brand Logo">
            </div>
            <div class="brand-grid">
                <img src="<?php echo base_url() . 'assets/frontend/default/assets/images/brand/brand-17.png' ?>"
                     alt="Brand Logo">
            </div>
            <div class="brand-grid">
                <img src="<?php echo base_url() . 'assets/frontend/default/assets/images/brand/brand-18.png' ?>"
                     alt="Brand Logo">
            </div>
        </div>
    </div>
</div>
<!-- End Brand Area  -->
<!--=====================================-->
<!--=       Categories Area Start      =-->
<!--=====================================-->
<!-- Start Categories Area  -->
<div class="edu-categorie-area categorie-area-4 edu-section-gap">
    <div class="container">
        <div class="section-title section-center" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
            <h2 class="title"> A diverse range of programs.</h2>
            <span class="shape-line"><i class="icon-19"></i></span>
            <p>Choose your course from the programs listed. Upskill and Sail yourself to
                better opportunities.</p>
        </div>

        <div class="row g-5">
            <?php
            $categories = $this->crud_model->get_categories()->result_array();
            foreach ($categories as $key => $category):
                if ($key < 9) {
                    ?>
                    <div class="col-lg-4 col-md-6" data-sal-delay="50" data-sal="slide-up" data-sal-duration="800">
                        <div class="categorie-grid categorie-style-4 color-primary-style edublink-svg-animate">
                            <div class="icon">
                                <!--                                <img src="-->
                                <?php //echo site_url('uploads/thumbnails/category_thumbnails/' . $category['thumbnail']); ?><!--"-->
                                <!--                                     style="height: 40px;"/>-->
                                <i class="<?php echo $category['font_awesome_class'] ?>" aria-hidden="true"></i>


                            </div>
                            <div class="content">
                                <a href="<?php echo site_url('home/courses?category=' . $category['slug']); ?>">
                                    <h5 class="title"><?php echo $category['name']; ?></h5>
                                </a>
                                <span class="course-count"><?php echo $this->crud_model->get_course_by_category_id($category['id'])->num_rows(); ?> Courses</span>
                            </div>
                        </div>
                    </div>
                <?php } endforeach; ?>

        </div>
    </div>
</div>


<div class="edu-course-area course-area-1 gap-tb-text" style="padding-top: 80px;padding-bottom: 80px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title section-center sal-animate" data-sal-delay="150" data-sal="slide-up"
                     data-sal-duration="800">
                    <span class="pre-title"> Our Courses</span>
                    <h2 class="title"> Discover the key to your dream job at <span class="color-secondary"></span> with
                        us </h2>
                    <span class="shape-line">
                    <i class="icon-19"></i>
                  </span>
                    <p>Enroll in one of our courses now and join the thousands of successful students who have found
                        their dream jobs through AAA University.</p>
                </div>
            </div>
        </div>
        <div class="row g-5">

            <?php
            $latest_courses = $this->crud_model->latest_courses();
            foreach ($latest_courses as $key => $course):
                if ($key <= 6) {
                    ?>
                    <div class="col-12 col-xl-3 col-lg-6 col-md-6 sal-animate" data-sal-delay="150" data-sal="slide-up"
                         data-sal-duration="800">
                        <div class="edu-course course-style-5 inline"
                             data-tipped-options="inline: 'inline-tooltip-<?= $key ?>'">
                            <div class="inner">
                                <a href="<?php echo site_url('home/course/' . rawurlencode(slugify($course['title'])) . '/' . $course['id']) ?>"
                                   class="h-100 img-fluid w w-100">
                                    <?php
                                    $src = '';
                                    if ($course['thumbnail'] == '') {
                                        $src = base_url() . 'uploads/thumbnails/course_thumbnails/course-thumbnail.png';
                                    } else {
                                        if (file_exists('uploads/thumbnails/course_thumbnails/' . $course['thumbnail'])) {
                                            $src = base_url() . 'uploads/thumbnails/course_thumbnails/' . $course['thumbnail'];
                                        } else {
                                            $src = base_url() . 'uploads/thumbnails/course_thumbnails/course-thumbnail.png';
                                        }
                                    }
                                    ?>
                                    <img src="<?php echo $src ?>" style="border-radius: 6px; width: 100%"
                                         alt=""
                                         class="img-fluid">
                                </a>

                                <div class="content">
                                    <div class="course-price price-round">₹<?php echo $course['price']; ?></div>
                                    <span class="course-level " style="color: #0d0d0d;"> 100 % job Placement</span>
                                    <h5 class="title">
                                        <a href="<?php echo site_url('home/course/' . rawurlencode(slugify($course['title'])) . '/' . $course['id']) ?>">
                                            <?php echo $course['title']; ?>
                                        </a>
                                    </h5>
                                    <div class="course-rating">
                                        <?php
                                        $total_rating = $this->crud_model->get_ratings('course', $course['id'], true)->row()->rating;
                                        $number_of_ratings = $this->crud_model->get_ratings('course', $course['id'])->num_rows();
                                        if ($number_of_ratings > 0) {
                                            $average_ceil_rating = ceil($total_rating / $number_of_ratings);
                                        } else {
                                            $average_ceil_rating = 0;
                                        }

                                        for ($i = 1; $i < 6; $i++):?>
                                            <?php if ($i <= $average_ceil_rating): ?>
                                                <i class="icon-23" style="color: #f8b81f"></i>
                                            <?php else: ?>
                                                <i class="icon-23" style="color: #dcd6d6;"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <div class="rating">
                                        </div>
                                        <span class="rating-count">( <?php echo ($total_rating == "") ? 0 : $total_rating; ?>.0 / 5 Rating)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="inline-tooltip-<?= $key ?>" style="display:none">
                            <div class="course-layout-five-tooltip-content">
                                <div class="content">
                                    <span class="course-level"><?php echo site_phrase($course['level']); ?></span>
                                    <h5 class="title">
                                        <a href="<?php echo site_url('home/course/' . rawurlencode(slugify($course['title'])) . '/' . $course['id']) ?>">
                                            <?php echo $course['title']; ?>
                                        </a>
                                    </h5>
                                    <div class="course-rating">
                                        <?php
                                        $total_rating = $this->crud_model->get_ratings('course', $course['id'], true)->row()->rating;
                                        $number_of_ratings = $this->crud_model->get_ratings('course', $course['id'])->num_rows();
                                        if ($number_of_ratings > 0) {
                                            $average_ceil_rating = ceil($total_rating / $number_of_ratings);
                                        } else {
                                            $average_ceil_rating = 0;
                                        }

                                        for ($i = 1; $i < 6; $i++):?>
                                            <?php if ($i <= $average_ceil_rating): ?>
                                                <i class="icon-23" style="color: #f8b81f"></i>
                                            <?php else: ?>
                                                <i class="icon-23" style="color: #dcd6d6;"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <div class="rating">
                                        </div>
                                        <span class="rating-count">( <?php echo ($total_rating == "") ? 0 : $total_rating; ?>.0 / 5 Rating)</span>
                                    </div>
                                    <ul class="course-meta">
                                        <li>
                                            <?php
                                            $number_of_lessons = $this->crud_model->get_lessons('course', $course['id'])->num_rows();
                                            echo $number_of_lessons . " Lessons";
                                            ?>
                                        </li>
                                        <li>
                                            <?php echo $this->crud_model->get_total_duration_of_lesson_by_course_id($course['id']); ?>
                                        </li>
<!--                                        <li>All Levels</li>-->
                                    </ul>
                                    <div class="course-feature">
                                        <h6 class="title">What You’ll Learn?</h6>
                                        <ul class="mb--60">
                                            <?php foreach (json_decode($course['outcomes']) as $outcome): ?>
                                                <?php if ($outcome != ""): ?>
                                                    <li><?php echo $outcome; ?></li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <div class="button-group">
                                        <?php
                                        $course_purchase = $this->crud_model->check_course_enrolled($course['id'], $_SESSION['user_id']);
                                        if ($course_purchase == 1) {
                                            ?>
                                            <div class="read-more-btn">
                                                <a class="edu-btn btn btn-secondary" style="background-color:#039646">Start
                                                    Learning <i class="icon-4"></i></a>
                                            </div>
                                            <?php

                                        } else {
                                            $cart_item = $this->session->userdata('course_cart');
                                            $cart_course_id = explode(',', $cart_item);
                                            $count = 0;
                                            foreach ($cart_course_id as $id) {
                                                if ($course['id'] == $id) {
                                                    $count++
                                                    ?>
                                                    <div class="read-more-btn">
                                                        <a class="edu-btn" style="background-color: #0acf97"
                                                           id="all_ready_added_btn"><i class="fa fa-check"
                                                                                       style="font-size: 16px"> </i> All Ready
                                                            Added</a>
                                                    </div>
                                                    <div class="alert alert-success" role="alert">
                                                        <strong>Success!</strong> You have already added this course!
                                                    </div>
                                                    <?php break;
                                                }
                                            }
                                            if ($count < 1) {
                                                ?>
                                                <div class="read-more-btn">
                                                    <a href="<?php echo base_url('home/cart_form/add_cart/' . $course['id']) ?>"
                                                       class="edu-btn">Add to Cart <i class="icon-4"></i></a>
                                                </div>
                                            <?php }
                                        } ?>

<!--                                        <a href="#" class="edu-btn btn-medium">Add to Cart</a>-->
<!--                                        <a href="#" class="wishlist-btn btn-outline-dark">-->
<!--                                            <i class="icon-22"></i>-->
<!--                                        </a>-->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } endforeach; ?>

            <script>
                $(document).ready(function () {
                    $(".alert").hide()
                })
                $('#all_ready_added_btn').click(function () {
                    $(".alert").show()
                    window.setTimeout(function () {
                        $(".alert").toggle('medium')
                    }, 1500);
                })
            </script>
        </div>
    </div>
</div>
<!-- End Categories Area  -->
<!--=====================================-->
<!--=       Course Area Start      		=-->
<!--=====================================-->
<!-- Start Course Area  -->
<div class="home-eight-course edu-course-area course-area-8 gap-tb-text bg-image">
    <div class="container edublink-animated-shape">
        <ul>
            <li>
                <div class="section-title section-left" data-sal-delay="150" data-sal="slide-up"
                     data-sal-duration="800">
                    <span class="pre-title">Popular Courses</span>
                    <h2 class="title">Select Your Course To Get Started</h2>
                    <span class="shape-line"><i class="icon-19"></i></span>
                </div>
            </li>
            <li>
                <div class="course-view-all" data-sal-delay="150" data-sal="slide-up" data-sal-duration="1200">
                    <a href="<?php echo base_url('home/courses') ?>" class="edu-btn">Browse more courses <i
                                class="icon-4"></i></a>
                </div>
            </li>
        </ul>
        <div class="row g-5">
            <!-- Start Single Course  -->
            <?php $top_courses = $this->crud_model->get_top_courses()->result_array();
            //            echo "<pre>";
            //            print_r($top_courses);
            //            $cart_items = $this->session->userdata('cart_items');
            foreach ($top_courses as $key => $top_course) :

                if ($key < 4):?>

                    <div class="col-xl-6" data-sal-delay="100" data-sal="slide-up" data-sal-duration="800">
                        <div class="edu-course course-style-4">
                            <div class="inner">
                                <div class="thumbnail">
                                    <!--                            <a href="course-details.php">-->
                                    <!--                                <img src="-->
                                    <?php //echo base_url() . 'assets/frontend/default/assets/images/course/course-11.jpg'
                                    ?><!--"-->
                                    <!--                                     alt="Course Meta">-->
                                    <!--                            </a>-->
                                    <a href="<?php echo site_url('home/course/' . rawurlencode(slugify($top_course['title'])) . '/' . $top_course['id']) ?>">
                                        <?php
                                        $src = '';
                                        if ($top_course['thumbnail'] == ''){
                                            $src = base_url() . 'uploads/thumbnails/course_thumbnails/course-thumbnail.png';
                                        }else {
                                            if (file_exists('uploads/thumbnails/course_thumbnails/' . $top_course['thumbnail'])) {
                                                $src = base_url() . 'uploads/thumbnails/course_thumbnails/' . $top_course['thumbnail'];
                                            } else {
                                                $src = base_url() . 'uploads/thumbnails/course_thumbnails/course-thumbnail.png';
                                            }
                                        }
                                        ?>
                                        <img src="<?php echo $src ?>" alt="" class="img-fluid" style="height: 200px; width: 200px">

                                        <?php
                                        //                                         $img = $this->crud_model->get_course_thumbnail_url($top_course['id']);
                                        //
                                        //                                         $this->crud_model->resize_image($img);
                                        ?>
                                    </a>
                                    <div class="time-top">
                                <span class="duration"><i class="icon-61"></i>
                                    <?php echo $top_course['course_duration']; ?>
                                </span>
                                    </div>
                                </div>
                                <div class="content">
                                    <!--                                    <div class="course-price">-->
                                    <?php //echo $top_course['price']
                                    ?><!--</div>-->
                                    <h6 class="title">
                                        <a href="<?php echo site_url('home/course/' . rawurlencode(slugify($top_course['title'])) . '/' . $top_course['id']) ?>">
                                            <?php echo $top_course['title'] ?>
                                        </a>
                                    </h6>
                                    <div class="course-rating">
                                        <div class="rating">
                                            <?php
                                            $total_rating = $this->crud_model->get_ratings('course', $top_course['id'], true)->row()->rating;
                                            $number_of_ratings = $this->crud_model->get_ratings('course', $top_course['id'])->num_rows();
                                            if ($number_of_ratings > 0) {
                                                $average_ceil_rating = ceil($total_rating / $number_of_ratings);
                                            } else {
                                                $average_ceil_rating = 0;
                                            }

                                            for ($i = 1; $i < 6; $i++):?>
                                                <?php if ($i <= $average_ceil_rating): ?>
                                                    <i class="icon-23" style="color: #f8b81f"></i>
                                                <?php else: ?>
                                                    <i class="icon-23" style="color: #dcd6d6;"></i>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                            <div class="rating">
                                            </div>
                                        </div>
                                        <span class="rating-count">( <?php echo ($total_rating == "") ? 0 : $total_rating; ?>.0 / 5 Rating)</span>
                                    </div>
                                    <ul class="course-meta">
                                        <li><i class="icon-24"></i>
                                            <?php
                                            $number_of_lessons = $this->crud_model->get_lessons('course', $top_course['id'])->num_rows();
                                            echo $number_of_lessons . " Lessons";
                                            ?>
                                        </li>
                                        <li><i class="icon-25"></i>
                                            <?php
                                            $number_of_students = $this->crud_model->get_enroll_by_course_id($top_course['id'])->num_rows();
                                            echo $number_of_students . " Students";
                                            ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endif; endforeach; ?>
            <!-- End Single Course  -->
        </div>
        <ul class="shape-group">
            <li class="shape-1 scene" data-sal-delay="500" data-sal="fade" data-sal-duration="200">
                <img data-depth="-2"
                     src="<?php echo base_url() . 'assets/frontend/default/assets/images/about/shape-13.png' ?>"
                     alt="Shape">
            </li>
            <li class="shape-2">
                <span></span>
            </li>
            <li class="shape-3 scene" data-sal-delay="500" data-sal="fade" data-sal-duration="200">
                <img data-depth="-2"
                     src="<?php echo base_url() . 'assets/frontend/default/assets/images/about/shape-13.png' ?>"
                     alt="Shape">
            </li>
            <li class="shape-4 sal-animate" data-sal-delay="1000" data-sal="fade" data-sal-duration="1000">
                <img data-depth="-1"
                     src="<?php echo base_url() . 'assets/frontend/default/assets/images/counterup/shape-02.png' ?>"
                     alt="Shape">
            </li>
        </ul>
    </div>
</div>
<!-- End Course Area -->
<!--=====================================-->
<!--=       FAQ Area Start      		=-->
<!--=====================================-->
<div class="edu-faq-area faq-style-5 section-gap-equal">
    <div class="container">
        <div class="row g-5 row--45">
            <div class="col-lg-6">
                <div class="edu-faq-gallery">
                    <div class="faq-thumbnail thumbnail-1" data-sal-delay="50" data-sal="slide-right"
                         data-sal-duration="800">
                        <img src="<?php echo base_url() . 'assets/frontend/default/assets/images/others/faq-5.png' ?>"
                             alt="Faq Images">
                    </div>
                    <ul class="shape-group">
                        <li class="shape-1 scene" data-sal-delay="500" data-sal="fade" data-sal-duration="200">
                            <img data-depth="1.5"
                                 src="<?php echo base_url() . 'assets/frontend/default/assets/images/faq/shape-35.png' ?>"
                                 alt="Shape Images">
                        </li>
                        <li class="shape-2 scene" data-sal-delay="500" data-sal="fade" data-sal-duration="200">
                            <img data-depth="-2"
                                 src="<?php echo base_url() . 'assets/frontend/default/assets/images/faq/shape-36.png' ?>"
                                 alt="Shape Images">
                        </li>
                        <li class="shape-3">
                            <img src="<?php echo base_url() . 'assets/frontend/default/assets/images/faq/shape-34.png' ?>"
                                 alt="Shape Images">
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6" data-sal-delay="100" data-sal="slide-up" data-sal-duration="800">
                <div class="edu-faq-content">
                    <div class="section-title section-left">
                        <span class="pre-title">FAq’s</span>
                        <h2 class="title">Over 10 Years in <span class="color-secondary"> <br> Skill</span>
                            Development</h2>
                        <span class="shape-line"><i class="icon-19"></i></span>
                    </div>
                 <div class="faq-accordion" id="faq-accordion">
                       <div class="accordion">
                            <div class="accordion-item">
                                <h5 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true">
                                        What is AAA University?
                                    </button>
                                </h5>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                     data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                       <p> AAA University is an initiative of Ekon Solutions India Pvt Ltd that provides learning opportunities to students and professionals in tier 2-3 cities and rural areas of India. We provide comprehensive learning options, hands-on projects, & courses with guaranteed placement assistance. We train candidates and connect them with related job openings after they fulfil the skill requirement. AAA University empowers students and professionals to take on any challenges their profession demands.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h5 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseTwo" aria-expanded="false">
                                        How can we start learning?
                                    </button>
                                </h5>
                                <div id="collapseTwo" class="accordion-collapse collapse"
                                     data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                        <p>On AAA University, learning is easy. Browse www.ekonacademy.com
                                            and search for the course that you want to take. Buy the course
                                            and log in to the portal with the username and password you got
                                            in the confirmation email. You will get an email containing information
                                            about the allotted batch, timing, and trainer. You can take
                                            the class at a scheduled time online or at the enhancement centre, chosen by you.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h5 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree" aria-expanded="false">
                                        Where are the branches of AAA University located?
                                    </button>
                                </h5>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                     data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                       <p>We offer classes in hybrid mode (both offline and online). Head office of AAA University is located at Noida and We are expanding in various states across the country. Especially in tier 2 and rural areas, to provide equal opportunities for upskilling.
                                            <br>
                                            Right now we are at:
                                            <li>Gorakhpur</li>
                                            <li>Patna </li>
                                            .</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h5 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseFour" aria-expanded="false">
                                        What makes AAA University different from other  e-learning platforms?
                                    </button>
                                </h5>
                                <div id="collapseFour" class="accordion-collapse collapse"
                                     data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                        <p>Our learner-centric collaborative approach and one-to-one interaction make us special among our counterparts. With a personalized plan, we offer comprehensive assistance to our patrons and provide training in the chosen course with guarantee placement assistance. Our experience enables us to impart the knowledge and training and give opportunities to the students and professionals of the tier 2 cities and rural areas of India, on par with their metropolitan counterparts
                                            .</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h5 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseFive" aria-expanded="false">
                                        What are the benefits of taking courses on AAA University?
                                    </button>
                                </h5>
                                <div id="collapseFive" class="accordion-collapse collapse"
                                     data-bs-parent="#faq-accordion">
                                    <div class="accordion-body">
                                        <p>You will get training from experienced trainers who have spent a considerable
                                            amount of time in the industry and guaranteed placement assistance in
                                            the related field. Other than this, you will get study materials,
                                            online lecture videos, one-to-one assistance,
                                            and doubt-clearing sessions.
                                            </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="shape-group">
                        <li class="shape-1 scene shape-light" data-sal-delay="500" data-sal="fade"
                            data-sal-duration="200">
                            <img data-depth="1.5"
                                 src="<?php echo base_url() . 'assets/frontend/default/assets/images/about/shape-02.png' ?>"
                                 alt="Shape Images">
                        </li>
                        <li class="shape-2 scene" data-sal-delay="500" data-sal="fade" data-sal-duration="200">
                            <span data-depth="-2.2"></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!--=====================================-->
<!--=       CounterUp Area Start      	=-->
<!--=====================================-->
<div class="counterup-area-3 gap-bottom-equal">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-3 col-sm-6">
                <div class="edu-counterup counterup-style-3">
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
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="edu-counterup counterup-style-3">
                    <h2 class="counter-item count-number secondary-color">
                        <span class="odometer" data-odometer-final="32.4">.</span><span>K</span>
                    </h2>
                    <h6 class="title">Class Completed</h6>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="edu-counterup counterup-style-3">
                    <h2 class="counter-item count-number extra02-color">
                        <span class="odometer" data-odometer-final="99.9">.</span><span>%</span>
                    </h2>
                    <h6 class="title">Satisfaction Rate</h6>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="edu-counterup counterup-style-3 border-none">
                    <h2 class="counter-item count-number extra05-color">
                        <span class="odometer" data-odometer-final="354">.</span><span>+</span>
                    </h2>
                    <h6 class="title">Top Instructors</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Start Testimonial Area  -->
<div class="testimonial-area-2 ">
    <div class="container edublink-animated-shape">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title section-center" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                    <span class="pre-title">Testimonials</span>
                    <h2 class="title">What Our <span class="color-secondary">Students</span> <br> Have To Say</h2>
                    <span class="shape-line"><i class="icon-19"></i></span>
                    <p>Our student's words about us say everything about our legacy.</p>
                </div>
            </div>
        </div>
        <div class="testimonial-activation swiper">
            <div class="swiper-wrapper">
                <?php
                $testimonial_data = $this->crud_model->get_all_testimonial()->result_array();
               foreach ($testimonial_data as $testimonial) : ?>
                    <div class="swiper-slide">
                        <div class="testimonial-slide">
                            <div class="content">
                                <!--  <div class="logo"><img src="<?php echo base_url() . 'assets/frontend/default/assets/images/testimonial/logo-01.png' ?>" alt="Logo"></div>-->
                                <p><?php echo $testimonial['testimonial_text'] ?></p>
                                <div class="rating-icon">
                                    <?php
                                    for ($i = 1; $i <= 5; $i++) :
                                        if ($i <= $testimonial['rating']) :
                                    ?>
                                            <i class="icon-23" style="color: #F8B81F"></i>
                                        <?php else : ?>
                                            <i class="icon-23" style="color: #ABB0BB"></i>
                                    <?php endif;
                                    endfor; ?>
                                </div>
                            </div>
                            <div class="author-info">
                                <!--                                <div class="thumb">-->
                                <!--                                    <img src="-->
                                <?php //echo base_url() . 'assets/frontend/default/assets/images/testimonial/testimonial-01.png'
                                ?><!--"-->
                                <!--                                         alt="Testimonial">-->
                                <!--                                </div>-->
                                <div class="thumb" style="width: 70px; height: 70px">
                                    <?php
                                    $src = '';
                                    if ($testimonial['writer_image'] == '') {
                                        $src = $this->user_model->get_user_image_url($testimonial['user_id']);
                                    } else {
                                        $src = base_url('uploads/testimonial/writer_image/' . $testimonial['writer_image']);
                                    }
                                    //echo $name;
                                    ?>
                                    <img src="<?php echo $src; ?>" alt="Author Images">
                                </div>
                                <div class="info">
                                    <h5 class="title">
                                        <?php
                                        $name = '';
                                        if ($testimonial['writer_name'] == '') {
                                            $user_data = $this->user_model->get_all_user($testimonial['user_id'])->result_array();
                                            $name = $user_data[0]['first_name'] . " " . $user_data[0]['last_name'];
                                        } else {
                                            $name = $testimonial['writer_name'];
                                        }
                                        echo $name;
                                        ?>
                                    </h5>
                                    <span class="subtitle">
                                        <?php
                                        $cate = $this->crud_model->get_testimonial_by_slug_and_id($testimonial['testimonial_category_id'])->result_array();
                                        echo strtoupper($cate[0]['title']);
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="swiper-pagination"></div>
        <ul class="shape-group">
            <li class="shape-1 scene" data-sal-delay="200" data-sal="fade" data-sal-duration="1000">
                <img data-depth="1.4" src="<?php echo base_url() . 'assets/frontend/default/assets/images/about/shape-30.png' ?>" alt="Shape">
            </li>
            <li class="shape-2 scene" data-sal-delay="200" data-sal="fade" data-sal-duration="1000">
                <img data-depth="-1.4" src="<?php echo base_url() . 'assets/frontend/default/assets/images/about/shape-25.png' ?>" alt="Shape">
            </li>
        </ul>
    </div>
    <ul class="shape-group">
        <li class="shape-3" data-sal-delay="200" data-sal="fade" data-sal-duration="1000">
            <img src="<?php echo base_url() . 'assets/frontend/default/assets/images/others/map-shape-3.png' ?>" alt="Shape">
        </li>
    </ul>
</div>
<!-- End Testimonial Area  -->
<!--=====================================-->
<!--=       CTA Banner Area Start      =-->
<!--=====================================-->
<!-- Start Ad Banner Area  -->
<div class="modern-schooling-cta-wrapper edu-cta-banner-area-6 bg-image">
    <div class="container">
        <div class="edu-cta-banner">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="thumbnail">
                        <img src="<?php echo base_url() . 'assets/frontend/default/assets/images/cta/cta-girl-bg.png' ?>"
                             alt="girl image">
                    </div>
                    <ul class="shape-group">
                        <li class="shape-01 scene">
                            <img data-depth="2.5"
                                 src="<?php echo base_url() . 'assets/frontend/default/assets/images/cta/shape-43.png' ?>"
                                 alt="shape">
                        </li>
                        <li class="shape-02">
                            <img src="<?php echo base_url() . 'assets/frontend/default/assets/images/cta/shape-42.png' ?>"
                                 alt="shape">
                        </li>
                        <li class="shape-03 scene">
                            <img data-depth="-2"
                                 src="<?php echo base_url() . 'assets/frontend/default/assets/images/cta/shape-40.png' ?>"
                                 alt="shape">
                        </li>
                        <li class="shape-04 scene">
                            <img data-depth="2"
                                 src="<?php echo base_url() . 'assets/frontend/default/assets/images/cta/shape-38.png' ?>"
                                 alt="shape">
                        </li>

                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="section-title section-left" data-sal-delay="150" data-sal="slide-up"
                         data-sal-duration="800">
                        <h2 class="title">Get Your Quality <br> Skills Certificate Through <br> AAA University</h2>
<!--                        <a href="contact.php" class="edu-btn btn-secondary">Get started now <i class="icon-4"></i></a>-->
                    </div>
                </div>
            </div>
            <ul class="shape-group">
                <li class="shape-05 scene">
                    <img data-depth="2.5"
                         src="<?php echo base_url() . 'assets/frontend/default/assets/images/cta/shape-39.png' ?>"
                         alt="shape">
                </li>
                <li class="shape-06">
                    <img src="<?php echo base_url() . 'assets/frontend/default/assets/images/cta/cta-round.svg' ?>"
                         alt="shape">
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Ad Banner Area  -->
<!-- Start Webinar Area  -->
<div class="edu-blog-area blog-area-6 bg-image section-gap-equal">
    <div class="container">
        <div class="section-title section-center" data-sal-delay="100" data-sal="slide-up" data-sal-duration="800">
            <h2 class="title">Our Webinar</h2>
            <span class="shape-line"><i class="icon-19"></i></span>
            <span class="title"></span>
        </div>
        <ul class="nav nav-tabs" id="AllEvents" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pastEvents-tab" data-bs-toggle="tab" data-bs-target="#pastEvents" type="button" role="tab" aria-controls="pastEvents" aria-selected="true">Past Events</button>
            </li>
            <li class="nav-item ms-2" role="presentation">
                <button class="nav-link" id="upcoming-tab" data-bs-toggle="tab" data-bs-target="#upcoming" type="button" role="tab" aria-controls="upcoming" aria-selected="false">Upcoming Events</button>
            </li>
        </ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="pastEvents" role="tabpanel" aria-labelledby="pastEvents-tab">
  <div class="row g-5">
        <?php
        $web = $this->crud_model->get_all_webinar_upcoming()->result_array();
        foreach ($web as $key => $web_data) :
            if ($key < 4):
                ?>
                <div class="col-lg-3 col-md-6 col-12" data-sal-delay="100" data-sal="slide-up"
                    data-sal-duration="800">
                    <div class="edu-blog blog-style-6">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="#">
                                    <img src="<?= base_url() . 'uploads/webinar/' . $web_data['image']?>"
                                        alt="Webinar Banner" style="width: 270px; max-height: 300px; height: 200px">
                                </a>
                                <span class="date">
                                    <?php echo date('M d, Y', strtotime($web_data['start_time'])) ?>
                                </span>
                            </div>
                            <div class="content position-top">
                            <div class="read-more-btn">
                                                <a class="btn-icon-round"
                                                href="<?php echo base_url('home/webinar_details/'.$web_data['id'] ) ?>"><i
                                                            class="icon-4"></i></a>
                                            </div>
                                <!-- <div class="category-wrap">
                                    <a href="#" class="blog-category">
                                        <?php
                                        // $data = $this->crud_model->get_by_id_and_slug_blog_category($blog_data['blog_category_id'])->result_array();
                                        // echo $data[0]['title'];
                                        ?>
                                    </a>
                                </div> -->
                                <h5 class="title">
                                    <a href="#">
                                        <?php
                                        echo strlen($web_data['title']) > 50 ? substr($web_data['title'], 0, 50) . "..." : $web_data['title'];
                                        ?>
                                    </a>
                                </h5>
                                <p><?php
                                    echo strlen($web_data['short_dis']) > 120 ? substr($web_data['short_dis'], 0, 120) . "..." : $web_data['short_dis'];
                                    ?></p>
                            </div>
                </div>
            </div>
        </div>
        <!-- End Blog Grid  -->
     <?php endif; endforeach; ?>
   </div>
</div>
<div class="tab-pane fade" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
  <div class="row g-5">
  <?php
        $web = $this->crud_model->get_all_webinar_completed()->result_array();
        foreach ($web as $key => $web_data) :
            if ($key < 4):
                ?>
                <div class="col-lg-3 col-md-6 col-12" data-sal-delay="100" data-sal="slide-up"
                    data-sal-duration="800">
                    <div class="edu-blog blog-style-6">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="#">
                                    <img src="<?= base_url() . 'uploads/webinar/' . $web_data['image']?>"
                                        alt="Webinar Banner" style="width: 270px; max-height: 300px; height: 200px">
                                </a>
                                <span class="date">
                                    <?php echo date('M d, Y', strtotime($web_data['start_time'])) ?>
                                </span>
                            </div>
                            <div class="content position-top">
                            <div class="read-more-btn">
                                                <a class="btn-icon-round"
                                                href="<?php echo base_url('home/webinar_details/'.$web_data['id'] ) ?>"><i
                                                            class="icon-4"></i></a>
                                            </div>
                                <!-- <div class="category-wrap">
                                    <a href="#" class="blog-category">
                                        <?php
                                        // $data = $this->crud_model->get_by_id_and_slug_blog_category($blog_data['blog_category_id'])->result_array();
                                        // echo $data[0]['title'];
                                        ?>
                                    </a>
                                </div> -->
                                <h5 class="title">
                                    <a href="#">
                                        <?php
                                        echo strlen($web_data['title']) > 50 ? substr($web_data['title'], 0, 50) . "..." : $web_data['title'];
                                        ?>
                                    </a>
                                </h5>
                                <p><?php
                                    echo strlen($web_data['short_dis']) > 120 ? substr($web_data['short_dis'], 0, 120) . "..." : $web_data['short_dis'];
                                    ?></p>
                            </div>
                </div>
            </div>
        </div>
        <!-- End Blog Grid  -->
     <?php endif; endforeach; ?>
</div>
  </div>
</div>
    </div>
</div>
<!-- End Webinar Area  -->
<!--=      		Blog Area Start   		=-->
<!--=====================================-->
<!-- Start Blog Area  -->
<div class="edu-blog-area blog-area-6 bg-image section-gap-equal">
    <div class="container">
        <div class="section-title section-center" data-sal-delay="100" data-sal="slide-up" data-sal-duration="800">

            <h2 class="title">Our Blog</h2>
            <span class="shape-line"><i class="icon-19"></i></span>
            <span class="title">Discover some informative articles about EdTech</span>

        </div>


        <div class="row g-5">
            <!-- Start Blog Grid  -->
            <?php

            $blog = $this->crud_model->get_all_blog()->result_array();
            foreach ($blog as $key => $blog_data) :
                if ($key < 4):
                    ?>
                    <div class="col-lg-3 col-md-6 col-12" data-sal-delay="100" data-sal="slide-up"
                         data-sal-duration="800">
                        <div class="edu-blog blog-style-6">
                            <div class="inner">
                                <div class="thumbnail">
                                    <a href="<?php echo base_url('home/blog_details/' . $blog_data['id']) ?>">
                                        <img src="<?php echo base_url() . 'uploads/blog/thumb/' . $blog_data['thumbnail'] ?>"
                                             alt="Blog Images" style="width: 270px; max-height: 300px; height: 200px">
                                    </a>
                                    <span class="date">
                                        <?php echo date('M d, Y', strtotime($blog_data['created_at'])) ?>
                                    </span>
                                </div>
                                <div class="content position-top">
                                    <div class="read-more-btn">
                                        <a class="btn-icon-round"
                                           href="<?php echo base_url('home/blog_details/' . $blog_data['id']) ?>"><i
                                                    class="icon-4"></i></a>
                                    </div>
                                    <div class="category-wrap">
                                        <a href="#" class="blog-category">
                                            <?php
                                            $data = $this->crud_model->get_by_id_and_slug_blog_category($blog_data['blog_category_id'])->result_array();
                                            echo $data[0]['title'];

                                            ?>
                                        </a>
                                    </div>
                                    <h5 class="title">
                                        <a href="<?php echo base_url('home/blog_details/' . $blog_data['id']) ?>">
                                            <?php
                                            echo strlen($blog_data['title']) > 50 ? substr($blog_data['title'], 0, 50) . "..." : $blog_data['title'];
                                            ?>
                                        </a>
                                    </h5>
                                    <p><?php
                                        echo strlen($blog_data['short_description']) > 120 ? substr($blog_data['short_description'], 0, 120) . "..." : $blog_data['short_description'];
                                        ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Blog Grid  -->
                <?php endif; endforeach; ?>
        </div>
    </div>
</div>
<!-- End Blog Area  -->
<!--=====================================-->
<!--=        Footer Area Start       	=-->
<!--=====================================-->
<!-- Start Footer Area  -->

<?php $this->load->view('frontend/default/include/footer'); ?>