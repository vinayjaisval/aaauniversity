<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">
                    <i class="mdi mdi-apple-keyboard-command title_icon"></i>
                    <?php echo get_phrase('edit_batch_limit'); ?>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div> <!-- end col-->
</div>

<div class="row justify-content-center">
    <div class="col-xl-7">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12">
                    <h4 class="mb-3 header-title"><?php echo get_phrase('edit_batch_limit'); ?></h4>

                    <form class="required-form" action="<?php echo site_url('admin/batch_limit_form/edit'); ?>"
                          method="post" enctype="multipart/form-data">


<!--                        <div class="form-group">-->
<!--                            --><?php
//
//                            $result = $this->crud_model->get_course($batch_limit_data[0]['course_id']);
////                            print_r($result);
////                            die();
//                            ?>
<!--                            <label for="c_name">--><?php //echo get_phrase('course_name'); ?><!--</label>-->
<!--                            <input type="text" id="c_name" name="course_name" value="--><?php //echo $result[0]['title']?><!--" class="form-control" disabled>-->
                            <input type="text" id="c_name" name="id" value="<?php echo $id?>" class="form-control" hidden>
<!--                        </div>-->

                        <div class="form-group">
                            <label for="limit"><?php echo get_phrase('change limit'); ?></label>
                            <input type="number" id="limit" name="limit" value="<?php echo $batch_limit_data[0]['limit']?>" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary" id="sub_btn" disabled="disabled"
                                onclick="checkRequiredFields()"><?php echo get_phrase("submit"); ?></button>
                    </form>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<script type="text/javascript">

    $('#limit').keyup(function () {
        if ($('#limit').val() === "") {
            $("#sub_btn").attr('disabled', 'disabled')
        } else {
            $('#sub_btn').removeAttr('disabled')
        }
        console.log($('#limit').val())
    })

</script>
