<?php
$this->load->view('frontend/default/include/header');

$course_details = $this->crud_model->get_course_by_id($course_id)->row_array();

             

// $instructor_details = $this->user_model->get_all_user($course_details['user_id'])->row_array();
//echo "<pre>";
//print_r($course_details);
//die();
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
        font-size: 30px;
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

    .review-reply {
        margin-left: 105px;
    }
</style>
<div class="edu-breadcrumb-area breadcrumb-style-3">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="edu-breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="separator"><i class="icon-angle-right"></i></li>
                <li class="breadcrumb-item active" aria-current="page">Course Details</li>
            </ul>
            <div class="page-title">
                <h1 class="title"> <?php echo $course_details['title']; ?></h1>
            </div>

        </div>
    </div>
    <ul class="shape-group">
        <li class="shape-1">
            <span></span>
        </li>
        <li class="shape-2 scene">
            <!--<img data-depth="2"-->
            <!--                           src="<?php echo base_url('uploads/system/images/about/shape-13.png') ?>"-->
            <!--                           alt="shape">-->
                                       </li>
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
<!--=     Courses Details Area Start    =-->
<!--=====================================-->
<section class="edu-section-gap course-details-area">
    <div class="container">
        <div class="row row--30">
            <div class="col-lg-8">
                <div class="course-details-content">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo ($_GET['review'] == '1') ? '' : 'active' ?>"
                                    id="overview-tab" data-bs-toggle="tab"
                                    data-bs-target="#overview" type="button" role="tab" aria-controls="overview"
                                    aria-selected="<?php echo ($_GET['review'] == '1') ? 'false' : 'true' ?>">Overview
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="carriculam-tab" data-bs-toggle="tab"
                                    data-bs-target="#carriculam" type="button" role="tab" aria-controls="carriculam"
                                    aria-selected="false">Curriculum
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="instructor-tab" data-bs-toggle="tab"
                                    data-bs-target="#instructor" type="button" role="tab" aria-controls="instructor"
                                    aria-selected="false">Instructor
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo ($_GET['review'] == '1') ? 'active' : '' ?>"
                                    id="review-tab" data-bs-toggle="tab" data-bs-target="#review"
                                    type="button" role="tab" aria-controls="review"
                                    aria-selected="<?php echo ($_GET['review'] == '1') ? 'true' : 'false' ?>">
                                Reviews
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link"
                                    id="document1" data-bs-toggle="tab" data-bs-target="#document"
                                    type="button" role="tab" aria-controls="document"
                                    aria-selected="">
                                Documents
                            </button>
                        </li>


                    </ul>

                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade <?php echo ($_GET['review'] == '1') ? '' : 'show active' ?>"
                             id="overview" role="tabpanel"
                             aria-labelledby="overview-tab">
                            <div class="course-tab-content">
                                <div class="course-overview">
                                    <h3 class="heading-title">Course Description</h3>
                                    <?php echo $course_details['description']; ?>
                                    <h5 class="title">What You’ll Learn</h5>
                                    <ul class="mb--60">
                                        <?php foreach (json_decode($course_details['outcomes']) as $outcome): ?>
                                            <?php if ($outcome != ""): ?>
                                                <li><?php echo $outcome; ?></li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="carriculam" role="tabpanel" aria-labelledby="carriculam-tab">
                            <div class="course-tab-content">
                                <div class="course-curriculam">
                                    <h3 class="heading-title">Course Curriculum</h3>
                                    <div class="course-lesson">
                                        <!-- <h5 class="title">Week 1-4</h5> -->
                                        <!--<p>Advanced story telling techniques for writers: Personas, Characters &-->
                                        <!--    Plots</p>-->
                                        <ul>
                                            <?php
                                            $sections = $this->crud_model->get_section('course', $course_id)->result_array();
                                            $counter = 0;
                                            foreach ($sections as $section): ?>
                                                <li>
                                                    <div class="text"><i class="icon-65"></i>
                                                        <?php echo $section['title']; ?>
                                                    </div>
                                                    <div class="badge-list" style='display:none'>
                                                            <span class="badge badge-primary">
                                                                <?php echo $this->crud_model->get_lessons('course', $course_details['id'])->num_rows() . ' ' . site_phrase('lessons'); ?>
                                                            </span>
                                                        <span class="badge badge-secondary">
                                                                <?php
                                                                echo $this->crud_model->get_total_duration_of_lesson_by_course_id($course_details['id']);
                                                                ?>
                                                            </span>
                                                    </div>
                                                </li>
                                                <?php $lessons = $this->crud_model->get_lessons('section', $section['id'])->result_array();
                                                foreach ($lessons as $lesson):?>


                                                <?php
                                                endforeach;
                                                $counter++;
                                            endforeach; ?>
                                        </ul>
                                    </div>
                                    <!-- Course Curriculum Part multi comment by chanchal -->
                                    <!--
                                    <div class="course-lesson">
                                        <h5 class="title">Week 5-8</h5>
                                        <p>Advanced story telling techniques for writers: Personas, Characters &
                                            Plots</p>
                                        <ul>
                                            <li>
                                                <div class="text"><i class="icon-65"></i> Defining Functions</div>
                                                <div class="icon"><i class="icon-68"></i></div>
                                            </li>
                                            <li>
                                                <div class="text"><i class="icon-65"></i>Function Parameters</div>
                                                <div class="icon"><i class="icon-68"></i></div>
                                            </li>
                                            <li>
                                                <div class="text"><i class="icon-65"></i> Return Values From Functions
                                                </div>
                                                <div class="badge-list">
                                                    <span class="badge badge-primary">0 Question</span>
                                                    <span class="badge badge-secondary">10 Minutes</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="text"><i class="icon-65"></i> Global Variable and Scope
                                                </div>
                                                <div class="icon"><i class="icon-68"></i></div>
                                            </li>
                                            <li>
                                                <div class="text"><i class="icon-65"></i>Newer Way of creating a
                                                    Constant
                                                </div>
                                                <div class="icon"><i class="icon-68"></i></div>
                                            </li>
                                            <li>
                                                <div class="text"><i class="icon-65"></i> Constants</div>
                                                <div class="icon"><i class="icon-68"></i></div>
                                            </li>
                                        </ul>
                                    </div>
                                    -->
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="instructor" role="tabpanel" aria-labelledby="instructor-tab">
                           <?php
                            $ins_ids = explode(',', $course_details['user_id']);

                            foreach ($ins_ids as $ins_id) {
                                $instructor_details = $this->user_model->get_all_user($ins_id)->row_array();

                                if ($ins_id != '') {
                                    ?>
                                    <div class="course-tab-content">
                                        <div class="course-instructor">
                                            <div class="thumbnail" style="width: 100px; height: 100px">
                                                <img src="<?php echo $this->user_model->get_user_image_url($instructor_details['id']); ?>"
                                                     alt="Author Images">
                                            </div>
                                            <div class="author-content">
                                                <h6 class="title">
                                                    <a href="<?php echo site_url('home/instructor_details/' . $ins_id); ?>">
                                                        <?php echo $instructor_details['first_name'] . ' ' . $instructor_details['last_name']; ?>
                                                    </a>
                                                </h6>
                                                <span class="subtitle">Instructor</span>
                                                <p>
                                                    <?php echo $instructor_details['biography']; ?>
                                                </p>
                                                <?php
                                                $dats = json_decode($instructor_details['social_links'], true);
                                                ?>
                                              
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            } ?>
                        </div>
                        <div class="tab-pane fade <?php echo ($_GET['review'] == '1') ? 'show active' : '' ?>"
                             id="review" role="tabpanel" aria-labelledby="review-tab">
                            <div class="course-tab-content">
                                <div class="course-review">


                                    <?php
                                    $total_rating = $this->crud_model->get_ratings('course', $course_details['id'], true)->row()->rating;
                                    $number_of_ratings = $this->crud_model->get_ratings('course', $course_details['id'])->num_rows();
                                    if ($number_of_ratings > 0) {
                                        $average_ceil_rating = ceil($total_rating / $number_of_ratings);
                                    } else {
                                        $average_ceil_rating = 0;
                                    }
                                    ?>

                                    <h3 class="heading-title">Course Rating</h3>
                                    <!--                                    <p>5.00 average rating based on 7 rating</p>-->
                                    <div class="row g-0 align-items-center">
                                        <div class="col-sm-4">
                                            <div class="rating-box">
                                                <div class="rating-number"><?php echo $average_ceil_rating; ?>.0</div>
                                                <div class="rating">
                                                    <?php for ($i = 1; $i < 6; $i++): ?>
                                                        <?php if ($i <= $average_ceil_rating): ?>
                                                            <i class="icon-23" style="color: #f8b81f;"></i>
                                                        <?php else: ?>
                                                            <i class="icon-23" style="color: #abb0bb;"></i>
                                                        <?php endif; ?>
                                                    <?php endfor; ?>
                                                </div>
                                                <span>( <?php echo $this->crud_model->all_number_of_ratings_by_course_id($course_id, true); ?> ) Reviews</span>
                                            </div>
                                        </div>


                                        <div class="col-sm-8">
                                            <div class="review-wrapper">
                                                <?php for ($k = 5; $k > 0; $k--):
                                                    $data = $this->crud_model->get_number_of_rating_by_rating_course_id($k, $course_id);
                                                    if ($data != 0) {
                                                        ?>
                                                        <div class="row">
                                                            <div class="single-progress-bar">
                                                                <div class="rating-text">
                                                                    <?php echo $k; ?> <i class="icon-23"></i>
                                                                </div>
                                                                <div class="progress">
                                                                    <div class="progress-bar" role="progressbar"
                                                                         style="width: 100%"
                                                                         aria-valuenow="100" aria-valuemin="0"
                                                                         aria-valuemax="100">
                                                                    </div>
                                                                </div>
                                                                <span class="rating-value">
                                                                <?php
                                                                $data = $this->crud_model->get_number_of_rating_by_rating_course_id($k, $course_id);
                                                                echo "$data";
                                                                ?>
                                                            </span>
                                                            </div>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="row">
                                                            <div class="single-progress-bar">
                                                                <div class="rating-text">
                                                                    <?php echo $k; ?> <i class="icon-23"></i>
                                                                </div>
                                                                <div class="progress">
                                                                    <div class="progress-bar" role="progressbar"
                                                                         style="width: 0%"
                                                                         aria-valuenow="100" aria-valuemin="0"
                                                                         aria-valuemax="100">
                                                                    </div>
                                                                </div>
                                                                <span class="rating-value">
                                                                <?php
                                                                $data = $this->crud_model->get_number_of_rating_by_rating_course_id($k, $course_id);
                                                                echo "$data";
                                                                ?>
                                                            </span>
                                                            </div>
                                                        </div>
                                                    <?php } endfor; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Start Review Area  -->
                                    <?php
                                    $num = $this->crud_model->all_number_of_ratings_by_course_id($course_id, true);
                                    if ($num > 0):
                                        ?>
                                        <div class="comment-area">
                                            <h3 class="heading-title">Reviews</h3>
                                            <div class="comment-list-wrapper">
                                                <!-- Start Single Comment  -->
                                                <?php

                                                $count = 0;
                                                $rating = $this->crud_model->all_number_of_ratings_by_course_id($course_id);
                                                foreach ($rating as $key => $rating_data) {
                                                    $user_id = $rating_data['user_id'];
                                                    $give_rating = $rating_data['rating'];
                                                    $give_review = $rating_data['review'];
                                                    $user_data = $this->user_model->get_user($user_id)->result_array();
                                                    $img = 'uploads/user_image/' . $user_data['0']['image'] . '.jpg';

                                                    if ($key < 3) { ?>

                                                        <div class="comment">
                                                            <div class="thumbnail">
                                                                <?php
                                                                if (file_exists($img)) {
                                                                    ?>
                                                                    <img src="<?php echo base_url('uploads/user_image/' . $user_data[0]['image'] . '.jpg'); ?>"
                                                                         alt="Comment Images"/>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <img src="<?php echo base_url('uploads/user_image/placeholder.png'); ?>"
                                                                         alt="Comment Images"/>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </div>
                                                            <div class="comment-content">
                                                                <div class="rating">
                                                                    <?php
                                                                    for ($r = 1; $r <= 5; $r++) {
                                                                        if ($r <= $give_rating) {
                                                                            ?>
                                                                            <i class="icon-23"></i>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <i class="icon-23"
                                                                               style="color:#ABB0BBFF "></i>

                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <h5 class="title">
                                                                    <?php echo $user_data['0']['first_name'] . " " . $user_data['0']['last_name'] ?>
                                                                </h5>
                                                                <span class="date">
                                                            <?php
                                                            echo date('D, d-M-Y', strtotime($rating_data['last_modified'])); ?>
                                                        </span>
                                                                <p><?php echo $give_review; ?></p>

                                                                <!--   Reply Form   -->
                                                                <div class="reply-btn-wrapper">
                                                                <span class="reply-btn "
                                                                      id="reply_button<?php echo $rating_data['id'] ?>"
                                                                      onclick="reply_button()" style="cursor:pointer;">Reply</span>
                                                                    <form method="post"
                                                                          action="<?php echo base_url('admin/course_review_form/review_reply') ?>"
                                                                          id="replyform<?php echo $rating_data['id'] ?>"
                                                                          class="form-control ">

                                                                        <div class="form-group col-lg-6" hidden>
                                                                            <input type="text" name="course_id"
                                                                                   id="comm-name"
                                                                                   value="<?php echo $course_id; ?>">
                                                                        </div>
                                                                        <div class="form-group col-lg-6" hidden>
                                                                            <input type="text" name="rating_id"
                                                                                   id="comm-name"
                                                                                   value="<?php echo $rating_data['id'] ?>">
                                                                        </div>
                                                                        <div class="form-group col-12">
                                                                        <textarea name="reply_text" id="comm-message"
                                                                                  cols="30" rows="2"
                                                                                  placeholder="Leave A Reply...."
                                                                                  style="border: solid 1px #b5b7b4"
                                                                                  required></textarea>
                                                                        </div>
                                                                        <div class="form-group col-12">
                                                                            <button type="submit"
                                                                                    class="edu-btn submit-btn">
                                                                                Send Message <i class="icon-4"></i>
                                                                            </button>
                                                                        </div>
                                                                    </form>

                                                                    <script type="text/javascript">

                                                                        $(document).ready(function () {
                                                                            $("#replyform<?php echo $rating_data['id']?>").hide()
                                                                        });
                                                                        $("#reply_button<?php echo $rating_data['id']?>").click(function () {
                                                                            $("#replyform<?php echo $rating_data['id']?>").toggle("medium");
                                                                        });
                                                                    </script>
                                                                </div>
                                                                <!-- End Reply Form -->

                                                            </div>
                                                        </div>

                                                        <!---   Reply View   ---->
                                                    <?php
                                                    $reviews_reply = $this->crud_model->get_reviews_reply($rating_data['id']);
                                                    if ($reviews_reply->num_rows() > 0){
                                                    $reply_data = $reviews_reply->result_array();
                                                    $reply_user_data = $this->user_model->get_user($reply_data[0]['user_id'])->result_array();
                                                    $img = 'uploads/user_image/' . $reply_user_data['0']['image'] . '.jpg';

                                                    $reply_nums = $reviews_reply->num_rows();

                                                    if ($reply_nums > 0){ ?>
                                                        <div id="befor_reply<?php echo $rating_data['id'] ?>"
                                                             class="comment review-reply">
                                                            <div class="thumbnail">
                                                                <?php
                                                                if (file_exists($img)) {
                                                                    ?>
                                                                    <img src="<?php echo base_url('uploads/user_image/' . $reply_user_data[0]['image'] . '.jpg'); ?>"
                                                                         alt="Comment Images"/>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <img src="<?php echo base_url('uploads/user_image/placeholder.png'); ?>"
                                                                         alt="Comment Images"/>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </div>
                                                            <div class="comment-content">

                                                                <h5 class="title">
                                                                    <?php echo $reply_user_data['0']['first_name'] . " " . $reply_user_data['0']['last_name'] ?>
                                                                </h5>
                                                                <span class="date">
                                                                                                <?php
                                                                                                echo date('D, d-M-Y', strtotime($reply_data[0]['created_at'])); ?>
                                                                                            </span>
                                                                <p><?php echo $reply_data[0]['review_reply']; ?></p>
                                                            </div>
                                                        </div>
                                                        <div style="margin-top: 20px; "
                                                             id="reply_text<?php echo $rating_data['id'] ?>"></div>
                                                    <?php };

                                                    if ($reply_nums > 1){ ?>

                                                        <p class="comment comment-reply"
                                                           id="view_all_text1-<?php echo $rating_data['id'] ?>"
                                                           style="cursor: pointer">View All</p>

                                                        <script type="text/javascript">
                                                            //$(document).ready(function (){
                                                            //    var _sa = $('#view_all_text<?php //echo $blog_comment['id']?>//')
                                                            //    console.log(_sa);
                                                            //})

                                                            $('#view_all_text1-<?php echo $rating_data['id']?>').click(function () {
                                                                $(this).text()
                                                                if ($(this).text() === "View All") {
                                                                    $(this).text("Close Reply")
                                                                    $('#befor_reply<?php echo $rating_data['id']?>').hide()

                                                                    $.ajax({
                                                                        url: '<?php echo base_url("admin/course_review_form/view_all_reply/" . $rating_data['id']);?>',
                                                                        dataType: 'json',
                                                                        success: function (data) {
                                                                            for (let key in data) {

                                                                                let d = data[key]['created_at']
                                                                                let date = d.split('-')
                                                                                let month = date[1];
                                                                                let year = date[0]
                                                                                let day = date[2].split(" ")[0]

                                                                                var reply_text = ` <div class="comment comment-reply">
                                                                                                 <div id="image${data[key]['id']}" class="thumbnail">
                                                                                                 </div>
                                                                                                 <div class="comment-content">
                                                                                                 <h5 id='name${data[key]['id']}' class="title"></h5>
                                                                                                 <span class="date">${month} / ${day} / ${year}</span>
                                                                                                 <p>${data[key]['review_reply']}</p>
                                                                                                 <div class="reply-btn-wrapper"></div>
                                                                                                 </div>
                                                                                                 </div>`

                                                                                $('#reply_text<?php echo $rating_data['id']?>').append(reply_text);


                                                                                $.ajax({
                                                                                    url: '<?php echo base_url("admin/blog_form/view_user/");?>' + data[key]['user_id'],
                                                                                    dataType: 'json',
                                                                                    success: function (data1) {
                                                                                        var name = data1[0]['first_name'] + " " + data1[0]['last_name'];
                                                                                        $("#name" + data[key]['id']).text(name);
                                                                                    }
                                                                                });

                                                                                $.ajax({
                                                                                    url: '<?php echo base_url("admin/blog_form/user_image/");?>' + data[key]['user_id'],
                                                                                    dataType: 'json',
                                                                                    success: function (data2) {
                                                                                        var image = '<img src="' + data2 + '" alt="Author Images" style="width: 100px">'
                                                                                        $("#image" + data[key]['id']).append(image);
                                                                                    }
                                                                                });

                                                                                //<img src="<?php //echo $this->user_model->get_user_image_url($comment_reply[0]['user_id']) ?><!--<!--" alt="Author Images" style="width: 100px">-->-->

                                                                            }
                                                                        }
                                                                    })

                                                                } else if ($(this).text() === "Close Reply") {
                                                                    $('#reply_text<?php echo $rating_data['id']?>').hide()
                                                                    $(this).text("View reply")
                                                                    $('#befor_reply<?php echo $rating_data['id']?>').show()

                                                                } else if ($(this).text() === "View reply") {
                                                                    $(this).text("Close Reply")
                                                                    $('#befor_reply<?php echo $rating_data['id']?>').hide()
                                                                    $('#reply_text<?php echo $rating_data['id']?>').show()
                                                                }
                                                            })
                                                        </script>
                                                    <?php }; ?>

                                                    <?php } ?>
                                                        <!--- End Reply View ---->

                                                    <?php
                                                    }else{
                                                    $count++

                                                    ?>
                                                        <div class="show_comment"
                                                             style=" border-top: 1px solid var(--color-border);padding-top: 30px;margin-top: 30px;">
                                                            <div class="comment">
                                                                <div class="thumbnail">
                                                                    <?php
                                                                    if (file_exists($img)) {
                                                                        ?>
                                                                        <img src="<?php echo base_url('uploads/user_image/' . $user_data[0]['image'] . '.jpg'); ?>"
                                                                             alt="Comment Images"/>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <img src="<?php echo base_url('uploads/user_image/placeholder.png'); ?>"
                                                                             alt="Comment Images"/>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="comment-content">
                                                                    <div class="rating">
                                                                        <?php
                                                                        for ($r = 1; $r <= 5; $r++) {
                                                                            if ($r <= $give_rating) {
                                                                                ?>
                                                                                <i class="icon-23"></i>
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <i class="icon-23"
                                                                                   style="color:#ABB0BBFF "></i>

                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                    <h5 class="title">
                                                                        <?php echo $user_data['0']['first_name'] . " " . $user_data['0']['last_name'] ?>
                                                                    </h5>
                                                                    <span class="date">
                                                            <?php
                                                            echo date('D, d-M-Y', strtotime($rating_data['last_modified'])); ?>
                                                        </span>
                                                                    <p><?php echo $give_review; ?></p>

                                                                    <!--   Reply Form   -->
                                                                    <div class="reply-btn-wrapper">
                                                                <span class="reply-btn "
                                                                      id="reply_button<?php echo $rating_data['id'] ?>"
                                                                      onclick="reply_button()" style="cursor:pointer;">Reply</span>
                                                                        <form method="post"
                                                                              action="<?php echo base_url('admin/course_review_form/review_reply') ?>"
                                                                              id="replyform<?php echo $rating_data['id'] ?>"
                                                                              class="form-control ">

                                                                            <div class="form-group col-lg-6" hidden>
                                                                                <input type="text" name="course_id"
                                                                                       id="comm-name"
                                                                                       value="<?php echo $course_id; ?>">
                                                                            </div>
                                                                            <div class="form-group col-lg-6" hidden>
                                                                                <input type="text" name="rating_id"
                                                                                       id="comm-name"
                                                                                       value="<?php echo $rating_data['id'] ?>">
                                                                            </div>
                                                                            <div class="form-group col-12">
                                                                        <textarea name="reply_text" id="comm-message"
                                                                                  cols="30" rows="2"
                                                                                  placeholder="Leave A Reply...."
                                                                                  style="border: solid 1px #b5b7b4"
                                                                                  required></textarea>
                                                                            </div>
                                                                            <div class="form-group col-12">
                                                                                <button type="submit"
                                                                                        class="edu-btn submit-btn">
                                                                                    Send Message <i class="icon-4"></i>
                                                                                </button>
                                                                            </div>
                                                                        </form>

                                                                        <script type="text/javascript">

                                                                            $(document).ready(function () {
                                                                                $("#replyform<?php echo $rating_data['id']?>").hide()
                                                                            });
                                                                            $("#reply_button<?php echo $rating_data['id']?>").click(function () {
                                                                                $("#replyform<?php echo $rating_data['id']?>").toggle("medium");
                                                                            });
                                                                        </script>
                                                                    </div>
                                                                    <!-- End Reply Form -->

                                                                </div>
                                                            </div>

                                                            <!---   Reply View   ---->
                                                            <?php
                                                            $reviews_reply = $this->crud_model->get_reviews_reply($rating_data['id']);
                                                            if ($reviews_reply->num_rows() > 0) {
                                                                $reply_data = $reviews_reply->result_array();
                                                                $reply_user_data = $this->user_model->get_user($reply_data[0]['user_id'])->result_array();
                                                                $img = 'uploads/user_image/' . $reply_user_data['0']['image'] . '.jpg';

                                                                $reply_nums = $reviews_reply->num_rows();

                                                            if ($reply_nums > 0){ ?>
                                                                <div id="befor_reply<?php echo $rating_data['id'] ?>"
                                                                     class="comment review-reply">
                                                                    <div class="thumbnail">
                                                                        <?php
                                                                        if (file_exists($img)) {
                                                                            ?>
                                                                            <img src="<?php echo base_url('uploads/user_image/' . $reply_user_data[0]['image'] . '.jpg'); ?>"
                                                                                 alt="Comment Images"/>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <img src="<?php echo base_url('uploads/user_image/placeholder.png'); ?>"
                                                                                 alt="Comment Images"/>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                    <div class="comment-content">

                                                                        <h5 class="title">
                                                                            <?php echo $reply_user_data['0']['first_name'] . " " . $reply_user_data['0']['last_name'] ?>
                                                                        </h5>
                                                                        <span class="date">
                                                                                                <?php
                                                                                                echo date('D, d-M-Y', strtotime($reply_data[0]['created_at'])); ?>
                                                                                            </span>
                                                                        <p><?php echo $reply_data[0]['review_reply']; ?></p>
                                                                    </div>
                                                                </div>
                                                                <div style="margin-top: 20px; "
                                                                     id="reply_text<?php echo $rating_data['id'] ?>"></div>
                                                            <?php };

                                                            if ($reply_nums > 1){ ?>

                                                                <p class="comment comment-reply"
                                                                   id="view_all_text1-<?php echo $rating_data['id'] ?>"
                                                                   style="cursor: pointer">View All</p>

                                                                <script type="text/javascript">
                                                                    //$(document).ready(function (){
                                                                    //    var _sa = $('#view_all_text<?php //echo $blog_comment['id']?>//')
                                                                    //    console.log(_sa);
                                                                    //})

                                                                    $('#view_all_text1-<?php echo $rating_data['id']?>').click(function () {
                                                                        $(this).text()
                                                                        if ($(this).text() === "View All") {
                                                                            $(this).text("Close Reply")
                                                                            $('#befor_reply<?php echo $rating_data['id']?>').hide()

                                                                            $.ajax({
                                                                                url: '<?php echo base_url("admin/course_review_form/view_all_reply/" . $rating_data['id']);?>',
                                                                                dataType: 'json',
                                                                                success: function (data) {
                                                                                    for (let key in data) {

                                                                                        let d = data[key]['created_at']
                                                                                        let date = d.split('-')
                                                                                        let month = date[1];
                                                                                        let year = date[0]
                                                                                        let day = date[2].split(" ")[0]

                                                                                        var reply_text = ` <div class="comment comment-reply">
                                                                                                 <div id="image${data[key]['id']}" class="thumbnail">
                                                                                                 </div>
                                                                                                 <div class="comment-content">
                                                                                                 <h5 id='name${data[key]['id']}' class="title"></h5>
                                                                                                 <span class="date">${month} / ${day} / ${year}</span>
                                                                                                 <p>${data[key]['review_reply']}</p>
                                                                                                 <div class="reply-btn-wrapper"></div>
                                                                                                 </div>
                                                                                                 </div>`

                                                                                        $('#reply_text<?php echo $rating_data['id']?>').append(reply_text);


                                                                                        $.ajax({
                                                                                            url: '<?php echo base_url("admin/blog_form/view_user/");?>' + data[key]['user_id'],
                                                                                            dataType: 'json',
                                                                                            success: function (data1) {
                                                                                                var name = data1[0]['first_name'] + " " + data1[0]['last_name'];
                                                                                                $("#name" + data[key]['id']).text(name);
                                                                                            }
                                                                                        });

                                                                                        $.ajax({
                                                                                            url: '<?php echo base_url("admin/blog_form/user_image/");?>' + data[key]['user_id'],
                                                                                            dataType: 'json',
                                                                                            success: function (data2) {
                                                                                                var image = '<img src="' + data2 + '" alt="Author Images" style="width: 100px">'
                                                                                                $("#image" + data[key]['id']).append(image);
                                                                                            }
                                                                                        });
                                                                                    }
                                                                                }
                                                                            })

                                                                        } else if ($(this).text() === "Close Reply") {
                                                                            $('#reply_text<?php echo $rating_data['id']?>').hide()
                                                                            $(this).text("View reply")
                                                                            $('#befor_reply<?php echo $rating_data['id']?>').show()

                                                                        } else if ($(this).text() === "View reply") {
                                                                            $(this).text("Close Reply")
                                                                            $('#befor_reply<?php echo $rating_data['id']?>').hide()
                                                                            $('#reply_text<?php echo $rating_data['id']?>').show()
                                                                        }
                                                                    })
                                                                </script>
                                                            <?php }; ?>

                                                            <?php } ?>
                                                            <!--- End Reply View ---->
                                                        </div>


                                                        <?php

                                                    }
                                                }
                                                if ($count > 0): ?>

                                                    <p class="show_comment_btn" id="view_all_text"
                                                       style="cursor: pointer; padding-top: 10px">View All Comment</p>
                                                <?php endif; ?>
                                                <script type="text/javascript">

                                                    $(document).ready(function () {
                                                        $('.show_comment').hide()
                                                    })
                                                    $('.show_comment_btn').click(function () {
                                                        if ($(this).text() === "View All Comment") {
                                                            $(this).text("Close Comment");
                                                        } else if ($(this).text() === "Close Comment") {
                                                            $(this).text("View All Comment");

                                                        }
                                                        $('.show_comment').toggle("medium")

                                                    })
                                                </script>


                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <!-- End Review Area  -->

                                    <div class="comment-form-area" <?php echo $this->session->userdata('user_id') ? '' : 'hidden' ?>>
                                        <h3 class="heading-title">Write a Review</h3>

                                        <form class="comment-form" action="<?php echo base_url('home/rate_course') ?>"
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

                                                <input type="hidden" name="course_id" value="<?php echo $course_id ?>">
                                                <div class="form-group col-12">
                                                    <label for="comm-message"> Write Review</label>
                                                    <textarea name="review" id="comm-message" cols="30" rows="5"
                                                              placeholder="Here....."></textarea>
                                                </div>
                                                <div class="form-group col-12">
                                                    <button type="submit" class="edu-btn submit-btn">Submit Review <i
                                                                class="icon-4"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <?php
                        if ($doc_show){ ?>
                            <div class="tab-pane fade " id="document" role="tabpanel" aria-labelledby="document1">
                                <div class="course-tab-content">
                                    <div class="course-review">
                                        <h3 class="heading-title">Course Documents</h3>
                                        <iframe style="width: 100%; height: 500px ;"
                                                src="<?php echo base_url('home/course_documents/'.$course_documents['id'])?>">
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                        <?php } else{ ?>
                            <div class="tab-pane fade " id="document" role="tabpanel" aria-labelledby="document1">
                                <div class="course-tab-content">
                                    <div class="course-review">
                                        <h3 class="heading-title">Course Documents</h3>
                                        <h4 class="heading-title">Purchase this course to see documents.</h4>

                                    </div>
                                </div>
                            </div>
                        <?php }?>



                    </div>
                </div>
            </div>


            <div class="col-lg-4">
                <div class="course-sidebar-3 sidebar-top-position">
                    <div class="edu-course-widget widget-course-summery">
                        <div class="inner">
                            <!--<div class="thumbnail">-->

                            <!--    <img src="<?php // echo base_url('uploads/system/images/course/course-45.jpg') ?>"-->
                            <!--         alt="Courses">-->
                            <!--    <a href="#"-->
                            <!--       class="play-btn video-popup-activation"><i class="icon-18"></i></a>-->
                            <!--</div>-->
                            <div class="content">
                                <h4 class="widget-title">Course Includes:</h4>
                                <ul class="course-item">
                                <li>
                              
                                    <li>
                                        <span class="label"><i class="icon-60"></i>Price:</span>
                                      
                                        <?php
                                        $this->db->where('FIND_IN_SET("'.$course_id.'",course_id) <>','0')->limit(1)->order_by('id',"DESC");
                                        $qw= $this->db->get('ck_webinar')->result_array();
                                        
                                        $datetime_1=$qw[0]['end_time']; 
                                                 
                                        date_default_timezone_set('Asia/Kolkata'); 
                                        $datetime_2 = date("Y-m-d H:i:s"); 
                                        $from_time = strtotime($datetime_1); 
                                        $to_time = strtotime($datetime_2); 
                                        $diff_minutes = round(abs($from_time - $to_time) / 60,2). " minutes";
                                        $now_time = date("Y-m-d H:i:s");
                                        $offer_start_time = $qw[0]['end_time'];
                                        
                                        $now_time = strtotime($now_time); 
                                    
                                     
                                        if($qw[0] != ''){
                                        
                                            $addfirst_offer_time= strtotime($offer_start_time.' + 120 minute');
                                        
                                     
                                            $end_time = strtotime($qw[0]['end_time']);
                                          
                                            if($now_time >= $end_time){
                                        
                                                if($now_time <= $addfirst_offer_time){
                                                //  echo 'first 25% off';
                                                    $dis= $course_details['price']*25/100;
                                                       
                                        
                                                }elseif($now_time <= strtotime($offer_start_time.' + 1080 minute')){
                                                    //  echo 'first 20% off';
                                                    $dis=$course_details['price']*20/100;
                                                    

                                                } else{
                                                    $dis=0;
                                                }
                                            }
                                        }else{
                                            $dis=0;
                                        }
                                        ?>
                                      
                                        <span class="value price" style="font-size:14px;"><del><?php echo $course_details['price'] ?>.00</del></span> <span class="value price"><?php echo $course_details['price'] -$dis?>.00</span>
                                      
                                    </li>
                                   
                                    <li>
                                        <span class="label"><i class="icon-62"></i>Instructor:</span>
                                        <span class="value"><?php
                                            $ins_ids = explode(',', $course_details['user_id']);
                                            foreach ($ins_ids as $ins_id) {
                                                if ($ins_id != "") {
                                                    $instructor_details = $this->user_model->get_all_user($ins_id)->row_array();
                                                    echo $instructor_details['first_name'] . ' ' . $instructor_details['last_name'] . '<br>';
                                                }
                                            }
                                            ?></span>
                                    </li>
                                    <li>
                                        <span class="label"><i class="icon-61"></i>Duration:</span>
                                        <span class="value"><?php echo $course_details['course_duration']; ?></span>
                                    </li>
                                    <!--<li>
                                                <span class="label">
                                                    <img class="svgInject"
                                                         src="<?php echo base_url('uploads/system/images/svg-icons/books.svg') ?>"
                                                         alt="book icon">
                                                    Lessons:</span>
                                        <span class="value">
                                            <?php
                                            $number_of_lessons = $this->crud_model->get_lessons('course', $course_id)->num_rows();
                                            echo $number_of_lessons;
                                            ?>
                                        </span>
                                    </li> -->
                                    <li>
                                        <span class="label"><i class="icon-63"></i>Enrolled:</span>
                                        <span class="value">
                                              <?php
                                              $course_data = $this->crud_model->get_enroll_by_course_id($course_id)->num_rows();
                                              echo $course_data . " Students";
                                              ?>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="label"><i class="icon-59"></i>Language:</span>
                                        <span class="value"><?php echo get_phrase($course_details['language']); ?></span>
                                    </li>
                                    <li>
                                        <span class="label"><i class="icon-64"></i>Certificate:</span>
                                        <span class="value">Yes</span>
                                    </li>
                                </ul>


                                <?php
                                $course_purchase = $this->crud_model->check_course_enrolled($course_id, $_SESSION['user_id']);
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
                                        if ($course_details['id'] == $id) {
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
                                            <a href="<?php echo base_url('home/cart_form/add_cart/' . $course_details['id']) ?>"
                                               class="edu-btn">Add to Cart <i class="icon-4"></i></a>
                                        </div>
                                    <?php }
                                } ?>

                                <div class="share-area">
                                    <h4 class="title">Share On:</h4>
                                    <ul class="social-share">
                                        <li><a href="#"><i class="icon-facebook"></i></a></li>
                                        <li><a href="#"><i class="icon-twitter"></i></a></li>
                                        <li><a href="#"><i class="icon-linkedin2"></i></a></li>
                                        <li><a href="#"><i class="icon-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=====================================-->
<!--=     More Courses Area Start    =-->
<!--=====================================-->
<!-- Start Course Area  -->
<div class="gap-bottom-equal">
    <div class="container">
        <div class="section-title section-left" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
            <h3 class="title">More Courses for You</h3>
        </div>
        <div class="row g-5">
            <!-- Start Single Course  -->
            <?php
            $category_details = $this->crud_model->get_categories($course_details['category_id'])->result_array();
            //            print_r($category_details);
            $category_data = $this->crud_model->get_course_by_category_id($course_details['category_id'])->result_array();
            foreach ($category_data as $key => $courses) {
                if ($key < 3) {
                    ?>
                    <div class="col-12 col-xl-4 col-lg-6 col-md-6" data-sal-delay="150" data-sal="slide-up"
                         data-sal-duration="800">


                        <div class="edu-course course-style-5 inline" data-tipped-options="inline: 'inline-tooltip-1'">
                            <div class="inner">
                                <div class="thumbnail">
                                    <a href="<?php echo base_url('home/course/' . rawurlencode(slugify($courses['title'])) . '/' . $courses['id']) ?>">
                                        <!--<img src="<?php echo $this->crud_model->get_course_thumbnail_url($courses['id']); ?>"-->
                                        <!--     style="height: 210px" alt="Course Meta">-->
                                        
                                                                            <?php
                                    $src = '';
                                    if ($courses['thumbnail'] == '') {
                                        $src = base_url() . 'uploads/thumbnails/course_thumbnails/course-thumbnail.png';
                                    } else {
                                        if (file_exists('uploads/thumbnails/course_thumbnails/' . $courses['thumbnail'])) {
                                            $src = base_url() . 'uploads/thumbnails/course_thumbnails/' . $courses['thumbnail'];
                                        } else {
                                            $src = base_url() . 'uploads/thumbnails/course_thumbnails/course-thumbnail.png';
                                        }
                                    }
                                    ?>
                                    <img src="<?php echo $src ?>"
                                         style="height: 210px" alt="Course Meta">
                                    </a>
                                </div>
                                <div class="content">
                                    <div class="course-price price-round"><?php echo "₹ " . $courses['price'] ?></div>
                                    <span class="course-level"><?php echo $category_details['0']['name'] ?></span>
                                    <h5 class="title">
                                        <a href="<?php echo base_url('home/course/' . rawurlencode(slugify($courses['title'])) . '/' . $courses['id']) ?>"><?php echo ellipsis($courses['title'], 30) ?></a>
                                    </h5>
                                    <div class="course-rating">
                                        <div class="rating">
                                            <?php
                                            $total_rating = $this->crud_model->get_ratings('course', $courses['id'], true)->row()->rating;
                                            $number_of_ratings = $this->crud_model->get_ratings('course', $courses['id'])->num_rows();
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
                                        <span class="rating-count">(<?php echo $average_ceil_rating ?>)</span>
                                    </div>
                                    <p><?php echo $courses['short_description'] ?>.</p>
                                    <ul class="course-meta">
                                        <!-- <li><i class="icon-24"></i>
                                            <?php
                                            $number_of_lessons = $this->crud_model->get_lessons('course', $course_id)->num_rows();
                                            echo $number_of_lessons;
                                            ?>
                                            Lessons
                                        </li> -->
                                        <li><i class="icon-25"></i>

                                            <?php
                                            $course_data = $this->crud_model->get_enroll_by_course_id($course_id)->num_rows();
                                            echo $course_data . " Students";
                                            ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <!--                <div id="inline-tooltip-1" style="display:none">-->
                        <!--                    <div class="course-layout-five-tooltip-content">-->
                        <!--                        <div class="content">-->
                        <!--                            <span class="course-level">Cooking</span>-->
                        <!--                            <h5 class="title">-->
                        <!--                                <a href="course-details.php">Healthy Sushi Roll - Japanese Popular Cooking Class</a>-->
                        <!--                            </h5>-->
                        <!--                            <div class="course-rating">-->
                        <!--                                <div class="rating">-->
                        <!--                                    <i class="icon-23"></i>-->
                        <!--                                    <i class="icon-23"></i>-->
                        <!--                                    <i class="icon-23"></i>-->
                        <!--                                    <i class="icon-23"></i>-->
                        <!--                                    <i class="icon-23"></i>-->
                        <!--                                </div>-->
                        <!--                                <span class="rating-count">(5)</span>-->
                        <!--                            </div>-->
                        <!--                            <ul class="course-meta">-->
                        <!--                                <li>15 Lessons</li>-->
                        <!--                                <li>35 hrs</li>-->
                        <!--                                <li>Beginner</li>-->
                        <!--                            </ul>-->
                        <!--                            <div class="course-feature">-->
                        <!--                                <h6 class="title">What You’ll Learn?</h6>-->
                        <!--                                <ul>-->
                        <!--                                    <li>Professional Japanese cooking from beginners to experts</li>-->
                        <!--                                    <li>Will be able to cook authentic Italian recipes in their own kitchen</li>-->
                        <!--                                    <li>Understand the HOW of cooking, before thinking of the WHAT to cook.</li>-->
                        <!--                                </ul>-->
                        <!--                            </div>-->
                        <!--                            <div class="button-group">-->
                        <!--                                <a href="#" class="edu-btn btn-medium">Add to Cart</a>-->
                        <!--                                <a href="#" class="wishlist-btn btn-outline-dark"><i class="icon-22"></i></a>-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                        <!--                    </div>-->
                        <!--                </div>-->
                    </div>
                    <?php
                }
            } ?>
            <!-- End Single Course  -->

            <!-- Start Single Course  -->
            <!--            <div class="col-12 col-xl-4 col-lg-6 col-md-6" data-sal-delay="150" data-sal="slide-up"-->
            <!--                 data-sal-duration="800">-->
            <!--                <div class="edu-course course-style-5 inline" data-tipped-options="inline: 'inline-tooltip-2'">-->
            <!--                    <div class="inner">-->
            <!--                        <div class="thumbnail">-->
            <!--                            <a href="course-details.php">-->
            <!--                                <img src="assets/images/course/course-16.jpg" alt="Course Meta">-->
            <!--                            </a>-->
            <!--                        </div>-->
            <!--                        <div class="content">-->
            <!--                            <div class="course-price price-round">$40</div>-->
            <!--                            <span class="course-level">Cooking</span>-->
            <!--                            <h5 class="title">-->
            <!--                                <a href="course-details.php">Nutrition Kitchen - Basics of Cooking for Busy People</a>-->
            <!--                            </h5>-->
            <!--                            <div class="course-rating">-->
            <!--                                <div class="rating">-->
            <!--                                    <i class="icon-23"></i>-->
            <!--                                    <i class="icon-23"></i>-->
            <!--                                    <i class="icon-23"></i>-->
            <!--                                    <i class="icon-23"></i>-->
            <!--                                    <i class="icon-23"></i>-->
            <!--                                </div>-->
            <!--                                <span class="rating-count">(4.8)</span>-->
            <!--                            </div>-->
            <!--                            <p>Lorem ipsum dolor sit amet consectur elit sed eiusmod ex tempor.</p>-->
            <!--                            <ul class="course-meta">-->
            <!--                                <li><i class="icon-24"></i>35 Lessons</li>-->
            <!--                                <li><i class="icon-25"></i>80 Students</li>-->
            <!--                            </ul>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!---->
            <!--                <div id="inline-tooltip-2" style="display:none">-->
            <!--                    <div class="course-layout-five-tooltip-content">-->
            <!--                        <div class="content">-->
            <!--                            <span class="course-level">Cooking</span>-->
            <!--                            <h5 class="title">-->
            <!--                                <a href="course-details.php">Nutrition Kitchen - Basics of Cooking for Busy People</a>-->
            <!--                            </h5>-->
            <!--                            <div class="course-rating">-->
            <!--                                <div class="rating">-->
            <!--                                    <i class="icon-23"></i>-->
            <!--                                    <i class="icon-23"></i>-->
            <!--                                    <i class="icon-23"></i>-->
            <!--                                    <i class="icon-23"></i>-->
            <!--                                    <i class="icon-23"></i>-->
            <!--                                </div>-->
            <!--                                <span class="rating-count">(4.8)</span>-->
            <!--                            </div>-->
            <!--                            <ul class="course-meta">-->
            <!--                                <li>35 Lessons</li>-->
            <!--                                <li>28 hrs</li>-->
            <!--                                <li>Advanced</li>-->
            <!--                            </ul>-->
            <!--                            <div class="course-feature">-->
            <!--                                <h6 class="title">What You’ll Learn?</h6>-->
            <!--                                <ul>-->
            <!--                                    <li>Prepare a huge variety of simple, delicious, healthy recipes.</li>-->
            <!--                                    <li>Professional Indian cooking from beginners to experts</li>-->
            <!--                                    <li>Serve delicious and healthy meals for your loved ones.</li>-->
            <!--                                </ul>-->
            <!--                            </div>-->
            <!--                            <div class="button-group">-->
            <!--                                <a href="#" class="edu-btn btn-medium">Add to Cart</a>-->
            <!--                                <a href="#" class="wishlist-btn btn-outline-dark"><i class="icon-22"></i></a>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!-- End Single Course  -->

            <!-- Start Single Course  -->
            <!--            <div class="col-12 col-xl-4 col-lg-6 col-md-6" data-sal-delay="150" data-sal="slide-up"-->
            <!--                 data-sal-duration="800">-->
            <!--                <div class="edu-course course-style-5 inline" data-tipped-options="inline: 'inline-tooltip-3'">-->
            <!--                    <div class="inner">-->
            <!--                        <div class="thumbnail">-->
            <!--                            <a href="course-details.php">-->
            <!--                                <img src="assets/images/course/course-17.jpg" alt="Course Meta">-->
            <!--                            </a>-->
            <!--                        </div>-->
            <!--                        <div class="content">-->
            <!--                            <div class="course-price price-round">$50</div>-->
            <!--                            <span class="course-level">Cooking</span>-->
            <!--                            <h5 class="title">-->
            <!--                                <a href="course-details.php">Vegan Thai Cooking Classes Popular Vegan Recipes</a>-->
            <!--                            </h5>-->
            <!--                            <div class="course-rating">-->
            <!--                                <div class="rating">-->
            <!--                                    <i class="icon-23"></i>-->
            <!--                                    <i class="icon-23"></i>-->
            <!--                                    <i class="icon-23"></i>-->
            <!--                                    <i class="icon-23"></i>-->
            <!--                                    <i class="icon-23"></i>-->
            <!--                                </div>-->
            <!--                                <span class="rating-count">(5)</span>-->
            <!--                            </div>-->
            <!--                            <p>Lorem ipsum dolor sit amet consectur elit sed eiusmod ex tempor.</p>-->
            <!--                            <ul class="course-meta">-->
            <!--                                <li><i class="icon-24"></i>8 Lessons</li>-->
            <!--                                <li><i class="icon-25"></i>20 Students</li>-->
            <!--                            </ul>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!---->
            <!--                <div id="inline-tooltip-3" style="display:none">-->
            <!--                    <div class="course-layout-five-tooltip-content">-->
            <!--                        <div class="content">-->
            <!--                            <span class="course-level">Cooking</span>-->
            <!--                            <h5 class="title">-->
            <!--                                <a href="course-details.php">Vegan Thai Cooking Classes Popular Vegan Recipes</a>-->
            <!--                            </h5>-->
            <!--                            <div class="course-rating">-->
            <!--                                <div class="rating">-->
            <!--                                    <i class="icon-23"></i>-->
            <!--                                    <i class="icon-23"></i>-->
            <!--                                    <i class="icon-23"></i>-->
            <!--                                    <i class="icon-23"></i>-->
            <!--                                    <i class="icon-23"></i>-->
            <!--                                </div>-->
            <!--                                <span class="rating-count">(5)</span>-->
            <!--                            </div>-->
            <!--                            <ul class="course-meta">-->
            <!--                                <li>8 Lessons</li>-->
            <!--                                <li>20 hrs</li>-->
            <!--                                <li>All Levels</li>-->
            <!--                            </ul>-->
            <!--                            <div class="course-feature">-->
            <!--                                <h6 class="title">What You’ll Learn?</h6>-->
            <!--                                <ul>-->
            <!--                                    <ul>-->
            <!--                                        <li>Cook much loved recipes like ravioli, pizza and pesto from scratch</li>-->
            <!--                                        <li>Cook better than restaurant Thai food at home</li>-->
            <!--                                        <li>Keep your food safe from harmful bacteria and disease.</li>-->
            <!--                                    </ul>-->
            <!--                                </ul>-->
            <!--                            </div>-->
            <!--                            <div class="button-group">-->
            <!--                                <a href="#" class="edu-btn btn-medium">Add to Cart</a>-->
            <!--                                <a href="#" class="wishlist-btn btn-outline-dark"><i class="icon-22"></i></a>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!-- End Single Course  -->
        </div>
    </div>
</div>

<!-- End Course Area -->
<!--=====================================-->
<!--=        Footer Area Start          =-->
<!--=====================================-->
<!-- Start Footer Area  -->

<?php $this->load->view('frontend/default/include/footer'); ?>


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
