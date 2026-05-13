<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"><i
                            class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('Edit_testimonial_category'); ?>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row justify-content-center">
    <div class="col-xl-7">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12">
                    <h4 class="mb-3 header-title"><?php echo get_phrase('Edit_testimonial_category'); ?></h4>

                    <form class="required-form" action="<?php echo site_url('admin/form_testimonial_category/edit/'.$testimonial_category_edit[0]['slug']); ?>"
                          method="post" enctype="multipart/form-data">
                        <!--                        <div class="form-group">-->
                        <!--                            <label for="code">-->
                        <?php //echo get_phrase('category_code'); ?><!--</label>-->
                        <!--                            <input type="text" class="form-control" id="code" name = "code" value="-->
                        <?php //echo substr(md5(rand(0, 1000000)), 0, 10); ?><!--" readonly>-->
                        <!--                        </div>-->

                        <div class="form-group">
                            <label for="name"><?php echo get_phrase('testimonial_category_title'); ?><span
                                        class="required">*</span></label>
                            <input type="text" class="form-control" id="name" name="title" required
                                   value="<?php echo $testimonial_category_edit[0]['title'] ?>">
                        </div>

                        <div class="form-group">
                            <img src="<?php echo base_url('uploads/testimonial/category_image/' . $testimonial_category_edit[0]['image']) ?>"
                                 height="80px"><br>
                            <label for="file"><?php echo get_phrase('choose_category_image'); ?><span
                                        class="required">*</span></label>
                            <input type="file" class="form-control" id="file" name="image" required>
                        </div>

                        <div class="form-group" id="icon-picker-area">
                            <label for="font_awesome_class"><?php echo get_phrase('icon_picker'); ?></label>
                            <input type="text" id="font_awesome_class" name="font_awesome_class"
                                   class="form-control icon-picker" autocomplete="off"
                                   value="<?php echo $testimonial_category_edit[0]['icon'] ?>">
                        </div>

                        <button type="submit" class="btn btn-primary"
                                onclick="checkRequiredFields()"><?php echo get_phrase("submit"); ?></button>
                    </form>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<script type="text/javascript">
    function checkCategoryType(category_type) {
        if (category_type > 0) {
            $('#thumbnail-picker-area').hide();
            $('#icon-picker-area').hide();
        } else {
            $('#thumbnail-picker-area').show();
            $('#icon-picker-area').show();
        }
    }
</script>
