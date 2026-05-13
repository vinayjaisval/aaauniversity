<?php
$this->load->view('frontend/default/include/header');

if ($this->session->userdata('course_search')) {
    $my_courses = $my_courses_data;
//    print_array($my_courses);
//    die();
} else {
    $my_courses = $this->user_model->my_courses()->result_array();
}

?>
<style>
    .rating input[type="radio"]:not(:nth-of-type(0)) {
        /* hide visually */
        border: 0;
        clip: rect(0 0 0 0);
        height: 1px;
        margin: -1px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        width: 1px;
    }

    .rating [type="radio"]:not(:nth-of-type(0)) + label {
        display: none;
    }


    .rating .stars label:before {
        content: "★";
        cursor: pointer;
    }

    .stars {
        font-size: 25px;
        margin-top: -55px;
        height: 20px !important;
        color: #b9b5b5 !important;
    }

    .rating_color label {
        color: #d1cfcf !important;
        margin: 0px !important;
    }


    .rating [type="radio"]:nth-of-type(1):checked ~ .stars label:nth-of-type(-n+1),
    .rating [type="radio"]:nth-of-type(2):checked ~ .stars label:nth-of-type(-n+2),
    .rating [type="radio"]:nth-of-type(3):checked ~ .stars label:nth-of-type(-n+3),
    .rating [type="radio"]:nth-of-type(4):checked ~ .stars label:nth-of-type(-n+4),
    .rating [type="radio"]:nth-of-type(5):checked ~ .stars label:nth-of-type(-n+5) {
        color: orange !important;
    }

    .rating [type="radio"]:nth-of-type(1):focus ~ .stars label:nth-of-type(1),
    .rating [type="radio"]:nth-of-type(2):focus ~ .stars label:nth-of-type(2),
    .rating [type="radio"]:nth-of-type(3):focus ~ .stars label:nth-of-type(3),
    .rating [type="radio"]:nth-of-type(4):focus ~ .stars label:nth-of-type(4),
    .rating [type="radio"]:nth-of-type(5):focus ~ .stars label:nth-of-type(5) {
        color: darkorange;
    }
</style>

<div class="edu-breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="page-title">
                <h1 class="title"> My Courses </h1>
            </div>
            <ul class="edu-breadcrumb">
                <li class="breadcrumb-item"><a href="index-one.html">Home</a></li>
                <li class="separator"><i class="icon-angle-right"></i></li>
                <li class="breadcrumb-item"><a href="#"> My Courses</a></li>

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
<!--=        Courses Area Start         =-->
<!--=====================================-->
<div class="edu-course-area course-area-1 " style="margin-top: 30px;">
    <div class="container">


        <div class="edu-sorting-area">
            <div class="sorting-left">
                <?php

                    if (count($my_courses) > 0):?>

                        <nav class="mainmenu-nav">
                            <form method="post" action="<?php echo base_url('home/my_courses_by_search_string') ?>">
                                <input type="search" name="search_string" placeholder="Search"
                                       value="<?php echo $this->session->userdata('course_search') ?>">
                                <button type="submit" style="background: none; border: none" class="fa fa-search my_course_search" aria-hidden="true">

                            </form>
                        </nav> <?php
                    endif;
                ?>
            </div>
            <div class="sorting-right">
                <div class="layout-switcher">
                    <label> <a href="javascript:;" onclick="relod()">Reset </a></label>
                    <!--  <ul class="switcher-btn">
                         <li><a href="course-one.html" class="active"><i class="icon-53"></i></a></li>
                         <li><a href="course-four.html" class=""><i class="icon-54"></i></a></li>
                     </ul> -->
                </div>
                <!--                <div class="edu-sorting">-->
                <!--                    <div class="icon"><i class="icon-55"></i></div>-->
                <!--                    <select class="edu-select">-->
                <!--                        <option>Category</option>-->
                <!--                        <option>Low To High</option>-->
                <!--                        <option>High Low To</option>-->
                <!--                        <option>Last Viewed</option>-->
                <!--                    </select>-->
                <!--                </div>-->
            </div>
        </div>

        <div class="row g-5">
            <!-- Start Single Course  -->
            <?php foreach ($my_courses as $my_course) :
                if ($this->session->userdata('course_search')) {
                    $course_details = $this->crud_model->get_course_by_id($my_course['id'])->row_array();
                } else {
                    $course_details = $this->crud_model->get_course_by_id($my_course['course_id'])->row_array();
                }
                $instructor_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array(); ?>
                <div class="col-md-6 col-lg-4" data-sal-delay="100" data-sal="slide-up" data-sal-duration="800">
                    <div class="edu-course course-style-3 course-box-shadow">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="<?php echo site_url('home/course/' . rawurlencode(slugify($course_details['title'])) . '/' . $course_details['id']) ?>">
                                    <img src="<?php echo $this->crud_model->get_course_thumbnail_url($my_course['course_id']); ?>"
                                         alt="" class="img-fluid">

                                    <!--                                    <img src="assets/images/course/course-08.jpg" alt="Course Meta">-->
                                </a>
                                <div class="time-top">
                                    <span class="duration"><i class="icon-61"></i>Online + Onsite</span>
                                </div>
                            </div>
                            <div class="content">
                                <!--                                <span class="course-level">Management</span>-->
                                <h5 class="title">
                                    <a href="<?php echo site_url('home/course/' . rawurlencode(slugify($course_details['title'])) . '/' . $course_details['id']) ?>"><?php echo ellipsis($course_details['title']); ?></a>
                                </h5>
                                <p><?php echo $course_details['short_description'] ?></p>
                                <div class="course-rating">
                                    <div class="rating">
                                        <?php
                                        $total_rating = $this->crud_model->get_ratings('course', $course_details['id'], true)->row()->rating;
                                        $number_of_ratings = $this->crud_model->get_ratings('course', $course_details['id'])->num_rows();
                                        if ($number_of_ratings > 0) {
                                            $average_ceil_rating = ceil($total_rating / $number_of_ratings);
                                        } else {
                                            $average_ceil_rating = 0;
                                        }
                                        ?>

                                        <?php for ($i = 1; $i < 6; $i++): ?>
                                            <?php if ($i <= $average_ceil_rating): ?>
                                                <i class="icon-23" style="color: #f8b81f;"></i>
                                            <?php else: ?>
                                                <i class="icon-23" style="color: #abb0bb;"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                    <span class="rating-count">(<?php echo $average_ceil_rating ?> / 5 Rating) </span>
                                    <a href="<?php echo site_url('home/course/' . rawurlencode(slugify($course_details['title'])) . '/' . $course_details['id'] . '?review=1') ?>"
                                       onclick="openReview()" style="margin-left: 30px">Write Review</a>

                                </div>

                                <form style="display: none" id="review" class="comment-form"
                                      action="<?php echo base_url('home/rate_course') ?>"
                                      method="post">
                                    <div class="row g-5">
                                        <label for="rating"><b>Rating Here</b></label>
                                        <div class="form-group rating_color col-lg-6">
                                            <div class="rating">
                                                <input id="demo-1" type="radio" name="rating" value="1">
                                                <label for="demo-1">1 star</label>
                                                <input id="demo-2" type="radio" name="rating" value="2">
                                                <label for="demo-2">2 stars</label>
                                                <input id="demo-3" type="radio" name="rating" value="3">
                                                <label for="demo-3">3 stars</label>
                                                <input id="demo-4" type="radio" name="rating" value="4">
                                                <label for="demo-4">4 stars</label>
                                                <input id="demo-5" type="radio" name="rating" value="5">
                                                <label for="demo-5">5 stars</label>

                                                <div class="stars">
                                                    <label for="demo-1" aria-label="1 star"
                                                           title="1 star"></label>
                                                    <label for="demo-2" aria-label="2 stars"
                                                           title="2 stars"></label>
                                                    <label for="demo-3" aria-label="3 stars"
                                                           title="3 stars"></label>
                                                    <label for="demo-4" aria-label="4 stars"
                                                           title="4 stars"></label>
                                                    <label for="demo-5" aria-label="5 stars"
                                                           title="5 stars"></label>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="course_id"
                                               value="<?php echo $course_details['id'] ?>">
                                        <div class="form-group col-12">
                                            <label for="comm-message"> Write Review</label>
                                            <textarea name="review" id="comm-message" cols="30" rows="5"
                                                      placeholder="Here....."></textarea>
                                        </div>

                                        <div class=" form-group row col-12"
                                             style="padding-top: 20px; padding-left: 18px">
                                            <div class="col-md-6 col-6">
                                                <button type="submit" class="edu-btn btn-small btn-secondary"
                                                        style="width:100%"> Submit Review
                                                </button>
                                            </div>

                                            <div class="col-md-6 col-6">
                                                <button class="edu-btn btn-small btn-secondary"
                                                        onclick="openReviewCancel()" style="width:100%" type="button">
                                                    Cancel
                                                </button>

                                            </div>
                                        </div>

                                    </div>
                                </form>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="read-more-btn">
                                            <a class="edu-btn btn-small btn-secondary"
                                               href="<?php echo site_url('home/course/' . rawurlencode(slugify($course_details['title'])) . '/' . $course_details['id']) ?>">
                                                Courses Details <i class="icon-4"></i></a>
                                        </div>


                                    </div>

                                    <div class="col-md-6">
                                        <div class="read-more-btn">
                                            <a class="edu-btn btn-small btn-secondary" href="course-details.html"> Start
                                                Learning <i class="icon-4"></i></a>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            <?php endforeach;
            $this->session->unset_userdata('course_search');
            ?>

            <!-- End Single Course  -->
            <!-- Start Single Course  -->


            <!-- End Single Course  -->
        </div>

    </div>
</div>
<br>
<br>
<!-- End Course Area -->
<!--=====================================-->
<!--=        Footer Area Start          =-->
<!--=====================================-->
<!-- Start Footer Area  -->

<script>
    function openReview() {
        console.log("helo")
        document.getElementById('review').style.display = "block"
    }

    function openReviewCancel() {
        // console.log("helo")
        document.getElementById('review').style.display = "none"
    }

    function relod() {
        window.location.reload();
    }

</script>

<?php $this->load->view('frontend/default/include/footer'); ?>
