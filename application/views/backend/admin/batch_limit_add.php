<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">
                    <i class="mdi mdi-apple-keyboard-command title_icon"></i>
                    <?php echo get_phrase('add_batch_limit'); ?>
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
                    <h4 class="mb-3 header-title"><?php echo get_phrase('add_batch_limit'); ?></h4>

                    <form class="required-form" action="<?php echo site_url('admin/batch_limit_form/add'); ?>"
                          method="post" enctype="multipart/form-data">


                        <!--
                        <div class="form-group">
                            <label for="select"><?php echo get_phrase('select_a_course_name'); ?></label>
                            <select name="course_id" id="select" class="form-control">
                                <option value="">
                                    Choose Courses Name ...
                                </option>
                                <?php
                                foreach ($courses as $course_list) {
                                    ?>
                                    <option value="<?php echo $course_list['id'] ?>">
                                        <?php echo $course_list['title'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <label for="limit"></label>
                        </div>
                        -->

                        <div class="form-group">
                            <label for="select"><?php echo get_phrase('add_limit'); ?></label>

                            <input type="text" id="limit" name="limit" class="form-control">

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
    $(document).ready(function () {
        // $('#limit').hide()
    })

    $('#select').change(function () {
        if ($('#select').val() === '') {
            $('#limit').hide()
        } else {
            $('#limit').show()
        }
    })

    $('#limit').keyup(function () {
        if ($('#limit').val() === "") {
            $("#sub_btn").attr('disabled', 'disabled')
        } else {
            $('#sub_btn').removeAttr('disabled')
        }
        console.log($('#limit').val())
    })

</script>
