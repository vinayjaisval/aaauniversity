<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"><i
                        class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('edit_blog'); ?>
                    <!--                    <a href="-->
                    <?php //echo site_url('admin/blog_form/add_form'); ?><!--" class="btn btn-outline-primary btn-rounded alignToTitle"><i class="mdi mdi-plus"></i>-->
                    <?php //echo get_phrase('add_new_blog'); ?><!--</a>-->
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

<!--                    --><?php //print_r($blog_details)?>
                    <h4 class="mb-2 header-title"><?php echo get_phrase('Edit_blog'); ?></h4>

                    <form class="required-form" action="<?php echo site_url('admin/blog_form/edit/'.$blog_details[0]['id']); ?>" method="post" enctype="multipart/form-data">
                        <!--                        <div class="form-group">-->
                        <!--                            <label for="code">--><?php //echo get_phrase('category_code'); ?><!--</label>-->
                        <!--                            <input type="text" class="form-control" id="code" name = "code" value="--><?php //echo substr(md5(rand(0, 1000000)), 0, 10); ?><!--" readonly>-->
                        <!--                        </div>-->

                        <div class="form-group">
                            <label for="name"><?php echo get_phrase('blog_title'); ?><span class="required">*</span></label>
                            <input type="text" class="form-control" id="name" name = "title" value="<?php echo $blog_details[0]['title']?>" required>
                        </div>

                        <div class="form-group">
                            <label for="name"><?php echo get_phrase('select_blog_category'); ?><span class="required">*</span></label>
                            <select class="form-control" name="category_id" required>
                                <?php
                                $all_blog_category = $this->crud_model->get_all_blog_category()->result_array();
                                foreach ($all_blog_category as $key => $category):
                                    ?>

                                    <option value="<?php echo $category['id']?>" <?php echo ($category['id'] == $blog_details[0]['blog_category_id'] )?"selected" : "" ?>>
                                        <?php echo $category['title']?>
                                    </option>

                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <img id="thumb" src="<?php echo base_url('uploads/blog/thumb/'.$blog_details[0]['thumbnail'])?>" height="80px">
                            <label for="blog_thumb_image"><?php echo get_phrase('blog_thumb_image'); ?><span class="required">*</span></label>
                            <input type="file" class="form-control" id="blog_thumb_image" name = "thumb_image"  accept="image/png,image/jpg, image/jpeg" onchange="showPreview(event,'thumb');" value="<?php echo $blog_details[0]['thumbnail']?>">
                        </div>

                        <div class="form-group">
                            <img id="content_image" src="<?php echo base_url('uploads/blog/content_image/'.$blog_details[0]['content_image'])?>" height="80px">
                            <label for="blog_content_image"><?php echo get_phrase('blog_content_image'); ?><span class="required">*</span></label>
                            <input type="file" class="form-control" id="blog_content_image" name = "content_image" accept="image/png,image/jpg, image/jpeg" onchange="showPreview(event,'content_image');" value="<?php echo $blog_details[0]['content_image']?>">
                        </div>

                        <div class="form-group">
                            <img id="banner" src="<?php echo base_url('uploads/blog/banner/'.$blog_details[0]['banner'])?>" height="80px">
                            <label for="banner_image"><?php echo get_phrase('blog_banner_image'); ?><span class="required">*</span></label>
                            <input type="file" class="form-control" id="banner_image" name = "banner_image" accept="image/png,image/jpg, image/jpeg" onchange="showPreview(event,'banner');" >
                        </div>

                        <div class="form-group">
                            <label for="short_dis"><?php echo get_phrase('Short_Description'); ?><span class="required">*</span></label>
                            <input name="short_dis" class="form-control" id="short_dis" row="3" value="<?php echo $blog_details[0]['short_description']?>"></input>
                        </div>


                        <div class="form-group">
                            <label for="blog"><?php echo get_phrase('blog_content'); ?><span class="required">*</span></label>
                            <textarea id="blog" name="blog" class="form-control" required><?php echo $blog_details[0]['description']?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary" onclick="checkRequiredFields()"><?php echo get_phrase("submit"); ?></button>
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



    function showPreview(event,data){
        if (data === 'thumb') {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("thumb");
                preview.src = src;
                preview.style.display = "block";
            }
        }else if (data === 'content_image'){
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("content_image");
                preview.src = src;
                preview.style.display = "block";
            }
        }else if (data === 'banner'){
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("banner");
                preview.src = src;
                preview.style.display = "block";
            }
        }
    }
</script>