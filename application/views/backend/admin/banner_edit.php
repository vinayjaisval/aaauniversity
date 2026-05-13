<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">
                    <i class="mdi mdi-apple-keyboard-command title_icon"></i>
                    <?php echo get_phrase('Edit Banner'); ?>
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
                    <h4 class="mb-2 header-title"><?php echo get_phrase('Banner Edit form'); ?></h4>

                    <form class="required-form row"
                          action="<?php echo site_url('admin/Banner_form/edit_store/' . $banner->id); ?>"
                          method="post" enctype="multipart/form-data">

                      

                        <div class="form-group col-12">
                            <label for="name"><?php echo get_phrase('Banner_title'); ?><span
                                        class="required">*</span></label>
                            <input type="text" class="form-control" id="name" value="<?= $banner->title ?>"
                                   name="title" required>
                        </div>

                        <div class="form-group col-9">
                            <label for="img">
                                <?php echo get_phrase('banner'); ?>
                                <span class="required">*</span></label>
                            <input type="file" class="form-control" id="img" name="image">
                            <input type="hidden" class="form-control" id="img" name="old_img"
                                   value="<?= $banner->image ?>">
                        </div>

                        <div class="form-group col-3">
                            <label for="img">
                                <?php echo get_phrase('banner'); ?>
                                <span class="required">*</span>
                            </label>
                            <img class="img-fluid rounded-circle img-thumbnail"
                                 src="<?= base_url() . 'uploads/banner/' . $banner->image ?>">
                        </div>

                        <div class="form-group col-10">
                            <label for="url"><?php echo get_phrase('url'); ?><span
                                        class="required">*</span></label>
                            <input type="text" class="form-control" value="<?= $banner->url?>"
                                   id="url" name="url" required>
                        </div>

                       



                        <div class="form-group col-12">
                            <button type="submit" class="btn btn-primary"
                                    onclick="checkRequiredFields()"><?php echo get_phrase("Update"); ?></button>
                        </div>
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

    new SlimSelect({
        select: '.couseres'
    })
</script>
