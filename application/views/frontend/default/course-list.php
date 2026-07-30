<?php $this->load->view('frontend/default/include/header'); ?>
<style>
    .edu-breadcrumb-area.breadcrumb-style-3 {
        padding-bottom: 30px !important;
    }
    .edu-course-area.section-gap-equal {
        padding-top: 30px !important;
        padding-bottom: 40px !important;
    }
</style>
<?php
isset($layout) ? "" : $layout = "list";
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


<div class="edu-breadcrumb-area breadcrumb-style-3">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="edu-breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class="separator"><i class="icon-angle-right"></i></li>

                <li class="breadcrumb-item active" aria-current="page"> Course List</li>
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


<div class="edu-course-area course-area-1 section-gap-equal">
    <div class="container">
        <div class="row ">
            <div class="col-lg-3">
                <div class="edu-course-sidebar">
                    <div class="edu-course-widget widget-category">
                        <div class="inner">
                            <h5 class="widget-title">Filter by Categories</h5>
                            <div class="content">
                                <div class="edu-form-check">
                                    <input type="radio" id="category_all" name="sub_category"
                                           class="categories custom-radio" value="all"
                                           onclick="filter(this)" <?php if ($selected_category_id == 'all') echo 'checked'; ?>>
                                    <label for="category_all">All category</label>
                                </div>

                                <?php
                                $counter = 1;
                                $total_number_of_categories = $this->db->get('category')->num_rows();
                                $categories = $this->crud_model->get_categories()->result_array();
                                foreach ($categories as $category): ?>
                                    <div class="edu-form-check">
                                        <input class="categories" type="radio"
                                               id="category-<?php echo $category['id']; ?>"
                                               name="sub_category" value="<?php echo $category['slug']; ?>"
                                               onclick="filter(this)" <?php echo ($selected_category_id == $category['id']) ? 'checked' : 'unchecked'; ?>>
                                        <label for="category-<?php echo $category['id']; ?>"><?php echo $category['name']; ?></label>
                                    </div>
                                <?php endforeach; ?>

                                <!--- Start Check Box Filter multi Comment --->
                                <!--
                                <div class="edu-form-check">
                                    <input type="checkbox" id="cat-check2">
                                    <label for="cat-check2">Development <span>(2)</span></label>
                                </div>
                                <div class="edu-form-check">
                                    <input type="checkbox" id="cat-check3">
                                    <label for="cat-check3">Business <span>(3)</span></label>
                                </div>
                                <div class="edu-form-check">
                                    <input type="checkbox" id="cat-check4">
                                    <label for="cat-check4">Marketing <span>(6)</span></label>
                                </div>
                                <div class="edu-form-check">
                                    <input type="checkbox" id="cat-check5">
                                    <label for="cat-check5">Academics <span>(2)</span></label>
                                </div>
                                <div class="edu-form-check">
                                    <input type="checkbox" id="cat-check6">
                                    <label for="cat-check6">Data Science <span>(9)</span></label>
                                </div>
                                -->
                                <!--- End Check Box Filter multi Comment   --->

                            </div>
                        </div>
                    </div>

                    <!--- Start instructor Filter multi Comment --->
                    <!--
                    <div class="edu-course-widget widget-instructor">
                        <div class="inner">
                            <h5 class="widget-title">Instructor</h5>
                            <div class="content">
                                <div class="edu-form-check">
                                    <input type="checkbox" id="inst-check1">
                                    <label for="inst-check1">Madge Alvarez <span>(2)</span></label>
                                </div>
                                <div class="edu-form-check">
                                    <input type="checkbox" id="inst-check2">
                                    <label for="inst-check2">Tyler Hardy <span>(14)</span></label>
                                </div>
                                <div class="edu-form-check">
                                    <input type="checkbox" id="inst-check3">
                                    <label for="inst-check3">Dabiv Matina <span>(10)</span></label>
                                </div>
                                <div class="edu-form-check">
                                    <input type="checkbox" id="inst-check4">
                                    <label for="inst-check4">Robbin Lee <span>(5)</span></label>
                                </div>
                                <div class="edu-form-check">
                                    <input type="checkbox" id="inst-check5">
                                    <label for="inst-check5">Donald Logan <span>(2)</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    -->
                    <!--- End instructor Filter multi Comment   --->

                    <div class="edu-course-widget widget-level">
                        <div class="inner">
                            <h5 class="widget-title">Level</h5>
                            <div class="content">
                                <div class="edu-form-check">
                                    <label for="level-check1"></label>
                                    <input name="level" type="radio" id="all" value="all" class="level"
                                           onclick="filter(this)" <?php echo ($selected_level == 'all') ? 'checked' : 'unchecked'; ?>>
                                    <label for="all">All Levels </label>
                                </div>
                                <div class="edu-form-check">
                                    <input name="level" type="radio" id="beginner" value="beginner" class="level"
                                           onclick="filter(this)" <?php echo ($selected_level == 'beginner') ? 'checked' : 'unchecked'; ?>>
                                    <label for="beginner">Beginner </label>
                                </div>
                                <div class="edu-form-check">
                                    <input name="level" type="radio" id="advanced" value="advanced" class="level"
                                           onclick="filter(this)" <?php echo ($selected_level == 'advanced') ? 'checked' : 'unchecked'; ?>>
                                    <label for="advanced">High </label>
                                </div>
                                <div class="edu-form-check">
                                    <input name="level" type="radio" id="intermediate" value="intermediate"
                                           class="level"
                                           onclick="filter(this)" <?php echo ($selected_level == 'intermediate') ? 'checked' : 'unchecked'; ?>>
                                    <label for="intermediate">Intermediate</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="edu-course-widget widget-language">
                        <div class="inner">
                            <h5 class="widget-title">Language</h5>
                            <div class="content">
                                <div class="edu-form-check">
                                    <input type="radio" id="all" name="language" value="all"
                                           onclick="filter(this)" <?php echo ($selected_language == 'all') ? 'checked' : 'unchecked'; ?>>
                                    <label for="all">All Language</label>
                                </div>
                                <?php
                                $languages = $this->crud_model->get_all_languages();
                                foreach ($languages as $language): ?>
                                    <div class="edu-form-check">
                                        <input type="radio" id="language_<?php echo $language; ?>" name="language"
                                               class="languages"
                                               value="<?php echo $language; ?>"
                                               onclick="filter(this)" <?php echo ($selected_language == $language) ? 'checked' : 'unchecked'; ?>>
                                        <label for="language_<?php echo $language; ?>"><?php echo ucfirst($language); ?> </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!--- Start price Filter multi Comment --->
                    <!--
                    <div class="edu-course-widget widget-price">
                        <div class="inner">
                            <h5 class="widget-title">Price</h5>
                            <div class="content">
                                <div class="edu-form-check">
                                    <input type="checkbox" id="price-check1">
                                    <label for="price-check1">All Price</label>
                                </div>
                                <div class="edu-form-check">
                                    <input type="checkbox" id="price-check2">
                                    <label for="price-check2">Free</label>
                                </div>
                                <div class="edu-form-check">
                                    <input type="checkbox" id="price-check3">
                                    <label for="price-check3">Low to High</label>
                                </div>
                                <div class="edu-form-check">
                                    <input type="checkbox" id="price-check4">
                                    <label for="price-check4">High to Low</label>
                                </div>
                                <div class="edu-form-check">
                                    <input type="checkbox" id="price-check5">
                                    <label for="price-check5">Paid</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    -->
                    <!---  End price Filter multi Comment  --->

                    <div class="edu-course-widget widget-rating">
                        <div class="inner">
                            <h5 class="widget-title">Rating</h5>
                            <div class="content">
                                <div class="edu-form-check">
                                    <input type="radio" id="all_rating" name="rating" class="ratings custom-radio"
                                           value="<?php echo 'all'; ?>"
                                           onclick="filter(this)" <?php if ($selected_rating == "all") echo 'checked'; ?>>
                                    <label for="all_rating">All</label>

                                </div>

                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <div class="edu-form-check">


                                        <input type="radio" id="rating_<?php echo $i; ?>" name="rating"
                                               class="ratings custom-radio" value="<?php echo $i; ?>"
                                               onclick="filter(this)" <?php if ($selected_rating == $i) echo 'checked'; ?>>
                                        <label for="rating_<?php echo $i; ?>">
                                            <?php for ($j = 1; $j <= $i; $j++): ?>
                                                <i class="icon-23" style="color: #f4c150;"></i>
                                            <?php endfor; ?>
                                            <?php for ($j = $i; $j < 5; $j++): ?>
                                                <i class="icon-23" style="color: #ebebea;"></i>
                                            <?php endfor; ?>
                                        </label>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 col-pl--35">


                <div class="edu-sorting-area">
                    <div class="sorting-left">
                        <h6 class="showing-text">We found
                            <span><?php echo count($courses) ?></span>
                            courses available for you
                        </h6>
                    </div>
                    <div class="sorting-right">
                        <div class="layout-switcher">
                            <label>Grid</label>
                            <ul class="switcher-btn">
                                <li>
                                    <a href="javascript::" onclick="toggleLayout('grid')"
                                       class="<?php echo ($layout == 'grid') ? 'active' : '' ?>">
                                        <i class="icon-53"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript::" onclick="toggleLayout('list')"
                                       class="<?php echo ($layout == 'list') ? 'active' : '' ?>">
                                        <i class="icon-54"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>


                    </div>
                </div>


                <div>
                    <?php if ($layout == "list"): ?>

                        <?php foreach ($courses as $course):


$flag=0;
$dis=0;
$sql = $this->db->query("SELECT * FROM ck_webinar WHERE 1 AND FIND_IN_SET('".$course['id']."', course_id) ORDER BY id DESC LIMIT 0, 1");
foreach($sql->result() as $row){
    $last_date = $row->end_time;
    $flag=1;
}

if($flag==1){
    $datetime_1=$last_date; 
                         
    date_default_timezone_set('Asia/Kolkata'); 
    $datetime_2 = date("Y-m-d H:i:s"); 
    $from_time = strtotime($datetime_1); 
    $to_time = strtotime($datetime_2); 
    $diff_minutes = round(abs($from_time - $to_time) / 60,2). " minutes";
    $now_time = date("Y-m-d H:i:s");
    $offer_start_time = $last_date;

    $now_time = strtotime($now_time); 
    $addfirst_offer_time= strtotime($offer_start_time.' + 120 minute');
    $end_time = strtotime($last_date);
    if($now_time >= $end_time){
        if($now_time <= $addfirst_offer_time){
        //  echo 'first 25% off';
            $dis= $course['price']*25/100;
        }elseif($now_time <= strtotime($offer_start_time.' + 1080 minute')){
            //  echo 'first 20% off';
            $dis=$course['price']*20/100;
        } else{
            $dis=0;
        }
    }
}

// ===================================================



                            $instructor_details = $this->user_model->get_all_user($course['user_id'])->row_array(); ?>


                            <div class="edu-course course-style-4 course-style-8">
                                <div class="inner">
                                    <div class="thumbnail">
                                        <a href="<?php echo site_url('home/course/' . rawurlencode(slugify($course['title'])) . '/' . $course['id']) ?>">
                                          <?php
                                                    $src = '';
                                                    if ($course['thumbnail'] == ''){
                                                $src = base_url() . 'uploads/thumbnails/course_thumbnails/course-thumbnail.png';
                                            }else {
                                                    if (file_exists('uploads/thumbnails/course_thumbnails/'.$course['thumbnail'])) {
                                                        $src = base_url() . 'uploads/thumbnails/course_thumbnails/'.$course['thumbnail'];
                                                    } else {
                                                        $src = base_url() . 'uploads/thumbnails/course_thumbnails/course-thumbnail.png';
                                                    }}
                                                    ?>
                                                    <img src="<?php echo $src ?>" style="height: 168px; width: 265px" alt="" class="img-fluid">
                                        </a>

                                        <div class="time-top">
                                    <span class="duration"><i
                                                class="icon-61"></i><?php echo $course['course_duration'] ?></span>
                                        </div>
                                    </div>
                                 
                                    <div class="content">
                                        <div class="course-price">
                                            
                                            <?php  if($dis > 0){ ?>
                                                <span style="color:red"> 
                                                    ₹ <?= ($course['price']-$dis); ?>
                                                </span>
                                                <del>₹ <?php echo $course['price'] ?> </del>
                                            <?php } else { ?>
                                            ₹ <?php echo $course['price'] ?> 
                                            <?php } ?>
                                            
                                        </div>
                                        <?php
                                        $course_id = $course['title'];
                                        
                                        // echo '<pre>';
                                        // print_r($array_course_webinar);
                                        // die;                                     
                                        ?>
                                   
                                        <h6 class="title">
                                            <a href="<?php echo site_url('home/course/' . rawurlencode(slugify($course['title'])) . '/' . $course['id']) ?>">
                                                <?php echo $course['title']; ?></a>
                                        </h6>
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
                                                <?php if ($i >= $average_ceil_rating): ?>
                                                    <i class="icon-23" style="color: #f8b81f"></i>
                                                <?php else: ?>
                                                    <i class="icon-23" style="color: #dcd6d6;"></i>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                            <div class="rating">
                                            </div>
                                            <span class="rating-count">( 5.0 / 5 Rating)</span>
                                        </div>
                                        <p>
                                            <!--<a href="<?php echo site_url('home/instructor_page/' . $instructor_details['id']) ?>"-->
                                            <!--   class="course-instructor">-->
                                                <!-- <span class="course-instructor instructor-name"><?php echo $instructor_details['first_name'] . ' ' . $instructor_details['last_name']; ?></span> -->
                                            <!--</a>-->
                                            </p>
                                        <p>
                                            <?php echo ellipsis($course['short_description'], 130); ?>
                                            <!--<?php echo $course['short_description']; ?>-->
                                            
                                            </p>
                                        <ul class="course-meta">
                                           <!-- <li>
                                                <i class="icon-24"></i>
                                                <?php
                                                $number_of_lessons = $this->crud_model->get_lessons('course', $course['id'])->num_rows();
                                                echo $number_of_lessons . " Lessons";
                                                ?> 

                                            </li> -->
                                            <!-- <li>
                                                <i class="icon-25"></i> -->
                                                <!--                                        --><?php
                                                //                                        $course_data = $this->crud_model->get_enroll_by_course_id($course['id']);
                                                //                                        //                                        $r = explode(",", $course_data[0]['user_id']);
                                                //                                        echo $course_data . " Students";
                                                //
                                                //
                                                ?>
                                                <?php // echo $this->crud_model->get_total_duration_of_lesson_by_course_id($course['id']); ?>

                                           <!-- </li> -->
                                            
                                             
                                            <li><?php echo site_phrase($course['level']); ?></li>

                                        </ul>
                                    </div>
                                </div>

                                <!--- Start Hover Code multi Comment --->
                                <!--
                        <div class="hover-content-aside">
                            <div class="content">
                                <span class="course-level">Engineering</span>
                                <h5 class="title">
                                    <a href="course-details.php">
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
                                    <span class="rating-count">(<?php echo ($total_rating == "") ? 0 : $total_rating; ?>)</span>
                                </div>
                                <ul class="course-meta">
                                    <li><?php echo $number_of_lessons . " Lessons"; ?></li>
                                    <li>
                                        <?php echo $this->crud_model->get_total_duration_of_lesson_by_course_id_in_hours($course['id']); ?>
                                    </li>
                                    <li><?php echo site_phrase($course['level']); ?></li>
                                </ul>
                                <div class="course-feature">
                                    <h6 class="title">What You’ll Learn?</h6>
                                    <ul>
                                        <li>Learn to use Python professionally, learning both Python 2 & Python 3!</li>
                                        <li>Build 6 beautiful real-world projects for your portfolio (not boring toy
                                        </li>
                                        <li>Understand the Theory behind Vue.js and use it in Real Projects</li>
                                    </ul>
                                </div>
                                <div class="button-group">
                                    <a href="#" class="edu-btn btn-medium">Add to Cart</a>
                                    <a href="#" class="wishlist-btn btn-outline-dark"><i class="icon-22"></i></a>
                                </div>
                            </div>
                        </div>
            -->
                                <!--- End Hover Code multi Comment   --->

                            </div>

                        <?php endforeach; ?>

                    

                    <?php else: ?>
                        <div class="row">
                            <?php foreach ($courses as $course):
                                $instructor_details = $this->user_model->get_all_user($course['user_id'])->row_array(); ?>

                                <div class="col-md-6 col-lg-4 col-xl-4" data-sal-delay="100" data-sal="slide-up"
                                     data-sal-duration="800">
                                    <div class="edu-course course-style-1 course-box-shadow hover-button-bg-white">
                                        <div class="inner">
                                            <div class="thumbnail">
                                                <a href="<?php echo site_url('home/course/' . rawurlencode(slugify($course['title'])) . '/' . $course['id']) ?>">
                                                  <?php
                                                    $src = '';
                                                    if ($course['thumbnail'] == ''){
                                                $src = base_url() . 'uploads/thumbnails/course_thumbnails/course-thumbnail.png';
                                            }else {
                                                    if (file_exists('uploads/thumbnails/course_thumbnails/'.$course['thumbnail'])) {
                                                        $src = base_url() . 'uploads/thumbnails/course_thumbnails/'.$course['thumbnail'];
                                                    } else {
                                                        $src = base_url() . 'uploads/thumbnails/course_thumbnails/course-thumbnail.png';
                                                    }}
                                                    ?>
                                                    <img src="<?php echo $src ?>" style="height: 168px; width: 265px" alt="" class="img-fluid">
                                                </a>

                                                <div class="time-top">
                                    <span class="duration">
                                    <i class="icon-61"></i>
                                    <?php echo $course['course_duration'] ?>
                                    </span>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <span class="course-level"><?php echo $course['level']; ?></span>
                                                <h6 class="title">
                                                    <a href="<?php echo site_url('home/course/' . rawurlencode(slugify($course['title'])) . '/' . $course['id']) ?>">
                                                        <?php echo ellipsis($course['title'], 22); ?></a>
                                                </h6>
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
                                                <div class="course-price">₹ <?php echo $course['price'] ?></div>
                                                <ul class="course-meta">
                                                   <!-- <li><i class="icon-24"></i>
                                                        <?php
                                                        $number_of_lessons = $this->crud_model->get_lessons('course', $course['id'])->num_rows();
                                                        echo $number_of_lessons . " Lessons";
                                                        ?> -->
                                                    <li><i class="icon-25"></i>
                                                        <?php
                                                        $course_data = $this->crud_model->get_enroll_by_course_id($course['id'])->num_rows();
                                                        echo $course_data . " Students";
                                                        ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                    <br>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    <?php endif; ?>
                    <!-- Pagination of course page -->
                    <?php if ($selected_category_id != "all" ) {
                        echo $this->pagination->create_links();
                    }elseif ($selected_category_id == "all"&& $selected_price == 0 && $selected_level == 'all' && $selected_language == 'all' && $selected_rating == 'all'){
                        echo $this->pagination->create_links();
                    } ?>
                    
                </div>

            </div>

            <div style="display: none" class="col-lg-9 ">

            </div>

        </div>


    </div>
</div>


<div style="display: none" class="edu-course-area course-area-1 gap-tb-text">
    <div class="container">


        <div class="edu-sorting-area">
            <div class="sorting-left">
                <h6 class="showing-text">We found
                    <span><?php echo count($courses) ?></span>
                    courses available for you
                </h6>
            </div>
            <div class="sorting-right">
                <div class="layout-switcher">
                    <label>Grid</label>
                    <ul class="switcher-btn">
                        <li>
                            <a href="javascript::" onclick="toggleLayout('grid')" class="active">
                                <i class="icon-53"></i>
                            </a>
                        </li>
                        <li>
                            <a href="javascript::" onclick="toggleLayout('list')">
                                <i class="icon-54"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="edu-sorting">
                    <div class="icon"><i class="icon-55"></i></div>
                    <select class="edu-select">
                        <option>Filters</option>
                        <option>Low To High</option>
                        <option>High Low To</option>
                        <option>Last Viewed</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row g-5">
            <!-- Start Single Course  -->

            <?php foreach ($courses as $course):
                $instructor_details = $this->user_model->get_all_user($course['user_id'])->row_array(); ?>

                <div class="col-md-6 col-lg-4 col-xl-3" data-sal-delay="100" data-sal="slide-up"
                     data-sal-duration="800">
                    <div class="edu-course course-style-1 course-box-shadow hover-button-bg-white">
                        <div class="inner">
                            <div class="thumbnail">
                                <a href="<?php echo site_url('home/course/' . rawurlencode(slugify($course['title'])) . '/' . $course['id']) ?>">
                                    <img src="<?php echo $this->crud_model->get_course_thumbnail_url($course['id']); ?>"
                                         style="height: 168px; width: 265px" alt="" class="img-fluid">
                                </a>

                                <div class="time-top">
                                    <span class="duration">
                                    <i class="icon-61"></i>
                                    <?php echo $course['course_duration'] ?>
                                    </span>
                                </div>
                            </div>
                            <div class="content">
                                <span class="course-level"><?php echo $course['level']; ?></span>
                                <h6 class="title">
                                    <a href="#"><?php echo $course['title']; ?></a>
                                </h6>
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
                                <div class="course-price">₹ <?php echo $course['price'] ?></div>
                                <ul class="course-meta">
                                    <li><i class="icon-24"></i>
                                        <?php
                                        $number_of_lessons = $this->crud_model->get_lessons('course', $course['id'])->num_rows();
                                        echo $number_of_lessons . " Lessons";
                                        ?>
                                    <li><i class="icon-25"></i>
                                        <?php
                                        $course_data = $this->crud_model->get_enroll_by_course_id($course['id'])->num_rows();
                                        echo $course_data . " Students";
                                        ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="course-hover-content-wrapper">
                            <button class="wishlist-btn"><i class="icon-22"></i></button>
                        </div>
                        <div class="course-hover-content-wrapper">
                            <button class="wishlist-btn"><i class="icon-22"></i></button>
                        </div>
                        <div class="course-hover-content">
                            <div class="content">
                                <button class="wishlist-btn"><i class="icon-22"></i></button>
                                <span class="course-level">Advanced</span>
                                <h6 class="title">
                                    <a href="course-details.php">The Complete Camtasia Course for Content Creators</a>
                                </h6>
                                <div class="course-rating">
                                    <div class="rating">
                                        <i class="icon-23"></i>
                                        <i class="icon-23"></i>
                                        <i class="icon-23"></i>
                                        <i class="icon-23"></i>
                                        <i class="icon-23"></i>
                                    </div>
                                    <span class="rating-count">(5.0 /9 Rating)</span>
                                </div>
                                <div class="course-price">$49.00</div>
                                <p>Lorem ipsum dolor sit amet consectur adipiscing elit sed eiusmod tempor.</p>
                                <ul class="course-meta">
                                    <li><i class="icon-24"></i>15 Lessons</li>
                                    <li><i class="icon-25"></i>31 Students</li>
                                </ul>
                                <a href="course-details.php" class="edu-btn btn-secondary btn-small">Enrolled <i
                                            class="icon-4"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <!-- End Single Course  -->
        </div>

    </div>
</div>


<?php $this->load->view('frontend/default/include/footer'); ?>


<!--- Start Chanchal Code for list filter in script  --->

<script type="text/javascript">

    function get_url() {
        var urlPrefix = '<?php echo site_url('home/courses?'); ?>'
        var urlSuffix = "";
        var slectedCategory = "";
        var selectedPrice = "";
        var selectedLevel = "";
        var selectedLanguage = "";
        var selectedRating = "";

        // Get selected category
        $('.categories:checked').each(function () {

            slectedCategory = $(this).attr('value');
        });

        // Get selected price
        // $('.prices:checked').each(function () {
        //     selectedPrice = $(this).attr('value');
        // });

        // Get selected difficulty Level
        $('.level:checked').each(function () {
            selectedLevel = $(this).attr('value');
        });

        // Get selected difficulty Level
        $('.languages:checked').each(function () {
            selectedLanguage = $(this).attr('value');
        });

        // Get selected rating
        $('.ratings:checked').each(function () {
            selectedRating = $(this).attr('value');
        });

        urlSuffix = "category=" + slectedCategory + "&&price=" + selectedPrice + "&&level=" + selectedLevel + "&&language=" + selectedLanguage + "&&rating=" + selectedRating;
        var url = urlPrefix + urlSuffix;
        return url;
    }

    function filter() {
        var url = get_url();
        window.location.replace(url);
        //console.log(url);
    }

    function toggleLayout(layout) {
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('home/set_layout_to_session'); ?>',
            data: {layout: layout},
            success: function (response) {
                location.reload();
            }
        });
    }

    function showToggle(elem, selector) {
        $('.' + selector).slideToggle(20);
        if ($(elem).text() === "<?php echo site_phrase('show_more'); ?>") {
            $(elem).text('<?php echo site_phrase('show_less'); ?>');
        } else {
            $(elem).text('<?php echo site_phrase('show_more'); ?>');
        }
    }
</script>

<!---  End Chanchal Code for list filter in script   --->
