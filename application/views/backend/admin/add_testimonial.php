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
</style>


<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"><i
                            class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('add_testimonial'); ?>
                    <!--                    <a href="-->
                    <?php //echo site_url('admin/form_testimonial_category/add_form'); ?><!--"-->
                    <!--                       class="btn btn-outline-primary btn-rounded alignToTitle"><i-->
                    <!--                            class="mdi mdi-plus"></i>-->
                    <?php //echo get_phrase('add_testimonial_category'); ?><!--</a>-->
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row justify-content-center">
    <div class="col-xl-10">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12">
                    <h4 class="mb-2 header-title"><?php echo get_phrase('testimonial_add_form'); ?></h4>

                    <form class="required-form" action="<?php echo site_url('admin/testimonial_form/add'); ?>"
                          method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="select"><?php echo get_phrase('select_testimonial_category'); ?><span
                                        class="required">*</span></label>
                            <select class="form-control" name="testimonial_category_id"  id="select" required>
                                <?php
                                $all_blog_category = $this->crud_model->get_all_testimonial_category()->result_array();
                                foreach ($all_blog_category as $key => $category):
                                    ?>

                                    <option value="<?php echo $category['id'] ?>">
                                        <?php echo $category['title'] ?>
                                    </option>

                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group" style="padding-bottom: 10px">
                            <label style="margin-bottom: 45px" for="rating"><?php echo get_phrase('Rating here....'); ?>
                                <span class="required">*</span></label>
                            <div id="rating" class="rating">
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


                        <div class="form-group">
                            <label for="testimonial"><?php echo get_phrase('testimonial_content'); ?><span
                                        class="required">*</span></label>
                            <textarea name="testimonial" class="form-control" id="testimonial" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="write_name"><?php echo get_phrase('testimonial_writer_name'); ?></label>
                            <input type="text" name="writer_name" class="form-control" id="write_name" placeholder="Write Name..." >
                        </div>

                        <div class="form-group">
                            <label for="write_image"><?php echo get_phrase('testimonial_writer_image'); ?></label>
                            <input type="file" name="writer_image" class="form-control" id="write_image" >
                        </div>


                        <!--                        <div class="form-group" id = "thumbnail-picker-area">-->
                        <!--                            <label> -->
                        <?php //echo get_phrase('blog_category_thumbnail'); ?><!-- <small>(-->
                        <?php //echo get_phrase('the_image_size_should_be'); ?><!--: 400 X 255)</small> </label>-->
                        <!--                            <div class="input-group">-->
                        <!--                                <div class="custom-file">-->
                        <!--                                    <input type="file" class="custom-file-input" id="category_thumbnail" name="category_thumbnail" accept="image/*" onchange="changeTitleOfImageUploader(this)">-->
                        <!--                                    <label class="custom-file-label" for="category_thumbnail">-->
                        <?php //echo get_phrase('choose_thumbnail'); ?><!--</label>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                        </div>-->

                        <button type="submit" class="btn btn-primary"
                                onclick="checkRequiredFields()"><?php echo get_phrase("submit"); ?></button>
                    </form>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<script type="text/javascript">
    $(document).ready(function () {
        initSummerNote(['#blog']);
    });
</script>