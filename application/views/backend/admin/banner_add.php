<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">
                    <i class="mdi mdi-apple-keyboard-command title_icon"></i>
                    <?php echo get_phrase('Add Banner'); ?>
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
                    <h4 class="mb-2 header-title"><?php echo get_phrase('Banner Add form'); ?></h4>

                    <form class="required-form row" action="<?php echo site_url('admin/banner_form/add_store'); ?>"
                          method="post" enctype="multipart/form-data">                   


                        <div class="form-group col-12">
                            <label for="name"><?php echo get_phrase('banner_title'); ?><span
                                        class="required">*</span></label>
                            <input type="text" class="form-control" id="name" name="title" required>
                        </div>

                        <div class="form-group col-12">
                            <label for="img">
                                <?php echo get_phrase('banner_image'); ?>
                                <span class="required">*</span></label>
                            <input type="file" class="form-control" id="img" name="image" required>
                        </div>
                        <div class="form-group col-10">
                            <label for="url"><?php echo get_phrase('url'); ?><span
                                        class="required">*</span></label>
                            <input type="text" class="form-control" id="url" name="url" required>
                        </div>
                      

                        <button type="submit" class="btn btn-primary"
                                onclick="checkRequiredFields()"><?php echo get_phrase("submit"); ?></button>
                    </form>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

