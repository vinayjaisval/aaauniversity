<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">
                    <i class="mdi mdi-apple-keyboard-command title_icon"></i>
                    <?php echo get_phrase('Add Webinar Student'); ?>
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
                    <h4 class="mb-2 header-title"><?php echo get_phrase('Student Add'); ?></h4>

                    <form class="row" action="<?php echo site_url('admin/webinar_form/add_student'); ?>"
                          method="post" enctype="multipart/form-data">
                        <input type="hidden" name="webinar_id" value="<?= $webinar_id ?>">

                        <div class="form-group col-12">
                            <label for="name"><?php echo get_phrase('Name'); ?><span
                                        class="required">*</span></label>
                            <input type="text" class="form-control" value="<?php echo set_value('name'); ?>"
                                   placeholder="Full Name" id="name" name="name"
                                   required>
                        </div>

                        <div class="form-group col-12">
                            <label for="email">
                                <?php echo get_phrase('email'); ?>
                                <span class="required">*</span></label>
                            <input type="text" name="email" class="form-control"
                                   value="<?php echo set_value('email'); ?>" size="50"/>
                            <span class="text-danger"><?php echo form_error('email'); ?></span>

                        </div>

                        <div class="form-group col-12">
                            <label for="phone">
                                <?php echo get_phrase('phone'); ?>
                                <span class="required">*</span></label>
                            <input type="text" placeholder="Phone No" value="<?php echo set_value('phone'); ?>"
                                   class="form-control phone" id="phone" name="phone"
                                   required>
                            <span class="text-danger"><?php echo form_error('phone'); ?></span>

                        </div>
                        <div class="form-group col-12">
                            <label for="message">
                                <?php echo get_phrase('message'); ?>
                            </label>
                            <textarea type="text" rows="3" placeholder="Message..." class="form-control" id="message"
                                      name="message"><?php echo set_value('message'); ?></textarea>
                        </div>

                        <div class="form-group col-12">
                            <button type="submit" class="btn btn-primary "
                                    onclick="checkRequiredFields()"><?php echo get_phrase("Add Student"); ?></button>

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
</script>
