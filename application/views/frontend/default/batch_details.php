<?php $this->load->view('frontend/default/include/header'); ?>
<?php
isset($layout) ? "" : $layout = "Gride";
isset($selected_category_id) ? "" : $selected_category_id = "all";
isset($selected_level) ? "" : $selected_level = "all";
isset($selected_language) ? "" : $selected_language = "all";
isset($selected_rating) ? "" : $selected_rating = "all";
isset($selected_price) ? "" : $selected_price = "all";
// echo $selected_category_id.'-'.$selected_level.'-'.$selected_language.'-'.$selected_rating.'-'.$selected_price;
$number_of_visible_categories = 10;
if (isset($sub_category_id)) {
    $sub_category_details = $this->crud_model->get_category_details_by_id($sub_category_id)->row_array();
    $category_details = $this->crud_model->get_categories($sub_category_details['parent'])->row_array();
    $category_name = $category_details['name'];
    $sub_category_name = $sub_category_details['name'];
}
?>

<style>
    .gap-tb-text {
        padding: 5px 0 112px;
    }

    .edu-section-gap {
        padding: 78px 0 120px;
    }
</style>

<div class="edu-breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-inner">
            <div class="page-title">
                <h1 class="title">New Batch Lists</h1>
            </div>
            <ul class="edu-breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class="separator"><i class="icon-angle-right"></i></li>

                <li class="breadcrumb-item active" aria-current="page"> Batch List</li>
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

<section class="edu-section-gap course-details-area">
    <div class="container">
        <div class="row row--30">
            <div class="col-lg-4">
                <div class=" course-details-area">
                    <div class="course-sidebar-3">
                        <div class="edu-course-widget widget-course-summery">

                            <div class="inner">

                                <div class="content">
                                    <h4 class="widget-title">Batch Information:</h4>
                                    <ul class="course-item">
                                        <li>
                                            <span class="label"><i class="fa fa-users"></i>Batch Name:</span>
                                            <span class="value title"><b id="title">Batch Name</b></span>
                                        </li>
                                        <li>
                                            <span class="label"><i id="batch_date" class="fas fa-hourglass-end"></i>Start Date:</span>
                                            <span class="value title" id="batch_date1">Date</span>
                                        </li>
                                        <li>
                                            <span class="label"><i class="icon-62"></i>Instructor:</span>
                                            <span class="value" id="instructor_name">
                                                Instructor Name
                                            </span>
                                        </li>
                                        <li>
                                            <span class="label"><i class="icon-61"></i>Duration:</span>
                                            <span class="value" id="Duration">In Day</span>
                                        </li>
<!--                                        <li>-->
<!--                                            <span class="label"><i class="icon-61"></i>Days Left:</span>-->
<!--                                            <span class="value" id="Duration1">Every Second</span>-->
<!--                                        </li>-->
                                        <li>
                                            <span class="label"><i class="icon-63"></i>Enrolled:</span>
                                            <span class="value" id="enroll_st">
                                              <?php
                                              $course_data = $this->crud_model->get_enroll_by_course_id($course_id)->num_rows();
                                              echo $course_data . " Students";
                                              ?>
                                        </span>
                                        </li>
                                        <li>
                                            <span class="label"><i class="icon-30"></i>Batch Size:</span>
                                            <span class="value" id="batch_size"> In Number </span>
                                        </li>
                                        <li>
                                            <span class="label"><i class="icon-59"></i>Language:</span>
                                            <span class="value"
                                                  id="language"><?php echo $course_details['language']; ?></span>
                                        </li>
                                        <li>
                                            <span class="label"><i class="icon-64"></i>Certificate:</span>
                                            <span class="value">Yes</span>
                                        </li>
                                    </ul>

<!--                                    <div class="share-area">-->
<!--                                        <h4 class="title">Share On:</h4>-->
<!--                                        <ul class="social-share">-->
<!--                                            <li><a href="#"><i class="icon-facebook"></i></a></li>-->
<!--                                            <li><a href="#"><i class="icon-twitter"></i></a></li>-->
<!--                                            <li><a href="#"><i class="icon-linkedin2"></i></a></li>-->
<!--                                            <li><a href="#"><i class="icon-youtube"></i></a></li>-->
<!--                                        </ul>-->
<!--                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="edu-course-area course-area-1 gap-tb-text">
                    <div class="container">
                        <div class="row g-5">
                            <!-- Start Single Course  -->

                            <?php foreach ($batch_details as $batch_data):
                                ?>
                                <div class="col-md-6 col-lg-3 col-xl-4" data-sal-delay="100" data-sal="slide-up"
                                     data-sal-duration="800" id="data_box-<?php echo $batch_data->id ?>">
                                    <div class="edu-course course-style-1 course-box-shadow hover-button-bg-white" style="border-radius: 10px">
                                        <div class="inner">
                                            <div class="thumbnail" style="background: #666666; border-radius: 10px">
                                                <?php
                                                $c_data = $this->db->get_where('course', array('id' => $batch_data->course_id))->result_object();
                                                if (file_exists('uploads/thumbnails/course_thumbnails/' . $c_data[0]->thumbnail)) {
                                                    $src = base_url() . 'uploads/thumbnails/course_thumbnails/' . $c_data[0]->thumbnail;
                                                } else {
                                                    $src = base_url() . 'uploads/thumbnails/course_thumbnails/course-thumbnail.png';
                                                }
                                                ?>
                                                <img src="<?php echo $src?>"
                                                     style="height: 168px; width: 265px" alt="" class="img-fluid">
                                            </div>
                                            <div class="content">
                                                <h6 class="title">
                                                    <?php echo $c_data[0]->title?>
                                                </h6>
                                                <div class="course-rating">
                                                    <div class="rating">
                                                    </div>
                                                </div>
                                                <div style="font-weight: 600; color: black">Batch Size :- <?php echo $batch_data->batch_limit ?> </div>
                                                <div style="font-weight: 600; color: black">Duration :- <?php echo$c_data[0]->course_duration ?> </div>
<!--                                                <ul class="course-meta">-->
<!--                                                    <li><i class="icon-24"></i>-->
<!--                                                        Lessons-->
<!---->
<!--                                                    <li><i class="icon-25"></i>-->
<!--                                                        Students-->
<!--                                                    </li>-->
<!--                                                </ul>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <script type="text/javascript">

                                    $('#data_box-<?php echo $batch_data->id?>').on('click', function () {
                                        $.ajax({
                                            url: '<?php echo base_url("home/batch_ajax_data/data_box-" . $batch_data->id)?>',
                                            dataType: 'json',
                                            success: function (data) {

                                                $('#title').empty();
                                                $('#title').append(`${data[0]['title']}`)

                                                $('#batch_date1').empty();
                                                $('#batch_date1').append(`${data[0]['date']}`)

                                                $('#Duration').empty();
                                                $('#Duration').append(`${data[0]['course_duration']}`)

                                                $('#instructor_name').empty();
                                                $('#instructor_name').append(`${data['user_name']}`)

                                                $('#enroll_st').empty();
                                                $('#enroll_st').append(`${data['students']}`)

                                                $('#batch_size').empty();
                                                $('#batch_size').append(`${data[0]['batch_limit']}`)

                                                $('#language').empty();
                                                let string = `${data[0]['language']}`;
                                                $('#language').append(string[0].toUpperCase() + string.substring(1));
                                            }
                                        });
                                    });
                                </script>
                            <?php endforeach; ?>
                            <!-- End Single Course  -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php $this->load->view('frontend/default/include/footer'); ?>

<script>
    $(document).ready(function () {
        let data1 = 0;
        setInterval(function () {
            data1++
            if (data1 === 1) {
                $('#batch_date').removeClass('fas fa-hourglass-end')
                $('#batch_date').addClass('fas fa-hourglass-start')
            } else if (data1 === 2) {
                $('#batch_date').removeClass('fas fa-hourglass-start')
                $('#batch_date').addClass('fas fa-hourglass-half')

            } else if (data1 === 3) {
                $('#batch_date').removeClass('fas fa-hourglass-half')
                $('#batch_date').addClass('fas fa-hourglass-end')
                data1 = 0
            }
        }, 500)
    })
</script>

