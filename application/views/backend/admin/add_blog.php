<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('add_blog'); ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row justify-content-center">
    <div class="col-xl-10">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12">
                    <h4 class="mb-2 header-title"><?php echo get_phrase('blog_add_form'); ?></h4>

                    <form class="required-form" action="<?php echo site_url('admin/blog_form/add'); ?>" method="post" enctype="multipart/form-data">
                        <!--                        <div class="form-group">-->
                        <!--                            <label for="code">--><?php //echo get_phrase('category_code'); ?><!--</label>-->
                        <!--                            <input type="text" class="form-control" id="code" name = "code" value="--><?php //echo substr(md5(rand(0, 1000000)), 0, 10); ?><!--" readonly>-->
                        <!--                        </div>-->

                        <div class="form-group">
                            <label for="name"><?php echo get_phrase('blog_title'); ?><span class="required">*</span></label>
                            <input type="text" class="form-control" id="name" name = "title" required>
                        </div>

                        <div class="form-group">
                            <label for="name"><?php echo get_phrase('select_blog_category'); ?><span class="required">*</span></label>
                            <select class="form-control" name="category_id" required>
                                <?php
                                $all_blog_category = $this->crud_model->get_all_blog_category()->result_array();
                                foreach ($all_blog_category as $key => $category):
                                ?>

                                <option value="<?php echo $category['id']?>">
                                    <?php echo $category['title']?>
                                </option>

                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="blog_thumb_image"><?php echo get_phrase('blog_thumb_image'); ?><span class="required">*</span></label>
                            <input type="file" class="form-control" id="blog_thumb_image" name = "thumb_image"  accept="image/png,image/jpg, image/jpeg" required>
                        </div>

                        <div class="form-group">
                            <label for="blog_content_image"><?php echo get_phrase('blog_content_image'); ?><span class="required">*</span></label>
                            <input type="file" class="form-control" id="blog_content_image" name = "content_image" accept="image/png,image/jpg, image/jpeg" required>
                        </div>

                        <div class="form-group">
                            <label for="banner_image"><?php echo get_phrase('blog_banner_image'); ?><span class="required">*</span></label>
                            <input type="file" class="form-control" id="banner_image" name = "banner_image" accept="image/png,image/jpg, image/jpeg" required>
                        </div>

                        <div class="form-group">
                            <label for="short_dis"><?php echo get_phrase('Short_Description'); ?><span class="required">*</span></label>
                            <textarea name="short_dis" class="form-control" id="short_dis" required></textarea>
                        </div>


                        <div class="form-group">
                            <label for="blog"><?php echo get_phrase('blog_content'); ?><span class="required">*</span></label>
                            <textarea name="blog" class="form-control" id="blog" required></textarea>
                        </div>




                        <!--                        <div class="form-group" id = "thumbnail-picker-area">-->
                        <!--                            <label> --><?php //echo get_phrase('blog_category_thumbnail'); ?><!-- <small>(--><?php //echo get_phrase('the_image_size_should_be'); ?><!--: 400 X 255)</small> </label>-->
                        <!--                            <div class="input-group">-->
                        <!--                                <div class="custom-file">-->
                        <!--                                    <input type="file" class="custom-file-input" id="category_thumbnail" name="category_thumbnail" accept="image/*" onchange="changeTitleOfImageUploader(this)">-->
                        <!--                                    <label class="custom-file-label" for="category_thumbnail">--><?php //echo get_phrase('choose_thumbnail'); ?><!--</label>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                        </div>-->

                        <button type="submit" class="btn btn-primary" onclick="checkRequiredFields()"><?php echo get_phrase("submit"); ?></button>
                    </form>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<!--<script type="text/javascript">-->
<!--    function checkCategoryType(category_type) {-->
<!--        if (category_type > 0) {-->
<!--            $('#thumbnail-picker-area').hide();-->
<!--            $('#icon-picker-area').hide();-->
<!--        }else {-->
<!--            $('#thumbnail-picker-area').show();-->
<!--            $('#icon-picker-area').show();-->
<!--        }-->
<!--    }-->
<!--</script>-->

<script type="text/javascript">
    $(document).ready(function () {
        initSummerNote(['#blog']);
    });
</script>
