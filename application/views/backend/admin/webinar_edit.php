
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.css" rel="stylesheet">
   <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.js"></script>
   <!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">
                    <i class="mdi mdi-apple-keyboard-command title_icon"></i>
                    <?php echo get_phrase('Edit Webinar'); ?>
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
                    <h4 class="mb-2 header-title"><?php echo get_phrase('Webinar Edit form'); ?></h4>

                    <form class="required-form row"
                          action="<?php echo site_url('admin/webinar_form/edit_store/' . $webinar->id); ?>"
                          method="post" enctype="multipart/form-data">

                        <div class="form-group col-12">
                            <label for="name"><?php echo get_phrase('Course List'); ?><span
                                        class="required">*</span></label>
                            <select name="course[]" class=" couseres" multiple>
                                <option value="">-- Select Course --</option>
                                <?php
                                foreach ($courses as $course) {
                                    ?>
                                    <option value="<?= $course->id ?>" <?= (in_array("$course->id", $selected_course)) ? 'selected' : '' ?> > <?= $course->title ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-12">
                            <label for="name"><?php echo get_phrase('webinar_title'); ?><span
                                        class="required">*</span></label>
                            <input type="text" class="form-control" id="name" value="<?= $webinar->title ?>"
                                   name="title" required>
                        </div>

                        <div class="form-group col-9">
                            <label for="img">
                                <?php echo get_phrase('webinar_banner'); ?>
                                <span class="required">*</span></label>
                            <input type="file" class="form-control" id="img" name="image">
                            <input type="hidden" class="form-control" id="img" name="old_img"
                                   value="<?= $webinar->image ?>">
                        </div>

                        <div class="form-group col-3">
                            <label for="img">
                                <?php echo get_phrase('webinar_banner'); ?>
                                <span class="required">*</span>
                            </label>
                            <img class="img-fluid rounded-circle img-thumbnail"
                                 src="<?= base_url() . 'uploads/webinar/' . $webinar->image ?>">
                        </div>


                        <div class="form-group col-12">
                            <label for="short_dis"><?php echo get_phrase('Short_Description'); ?><span class="required">*</span></label>
                            <textarea id="summernote" name="short_dis" class="form-control" id="short_dis"
                                      required><?= $webinar->short_dis ?></textarea>
                        </div>


                        <div class="form-group col-6">
                            <label for="start_time">
                                <?php echo get_phrase('webinar_start_time'); ?>
                                <span class="required">*</span></label>
                            <input type="datetime-local" class="form-control" value="<?= $webinar->start_time ?>"
                                   min='<?= date('Y-m-d') . 'T' . date('H:i'); ?>' id="start_time" name="start_time"
                                   required>
                        </div>

                        <div class="form-group col-6">
                            <label for="end_time"><?php echo get_phrase('webinar_end_time'); ?><span
                                        class="required">*</span></label>
                            <input type="datetime-local" value="<?= $webinar->end_time ?>"
                                   min='<?= date('Y-m-d') . 'T' . date('H:i'); ?>'
                                   class="form-control" id="end_time" name="end_time" required>
                        </div>
                        <div class="form-group col-10" >
                            <label for="amount"><?php echo get_phrase('Amount'); ?><span
                                        class="required">*</span></label>
                            <input type="number" class="form-control" id="amount" name="amount" >
                        </div>


                        <div class="form-group col-10">
                            <label for="zoom_host_link"><?php echo get_phrase('webinar_host_zoom_link'); ?><span
                                        class="required">*</span></label>
                            <input type="text" class="form-control" value="<?= $webinar->zoom_host_link ?>"
                                   id="zoom_host_link" name="zoom_host_link" required>
                        </div>

                        <!-- <div class="form-group col-2">
                            <label for="get_link"><?php echo get_phrase('get_link'); ?></label>
                            <input type="button" onclick="" class="form-control btn btn-success" id="get_link"
                                   value="Get Link">
                        </div> -->

                        <div class="form-group col-12">
                            <label for="zoom_attend_link"><?php echo get_phrase('webinar_attend_zoom_link'); ?><span
                                        class="required">*</span></label>
                            <input type="text" value="<?= $webinar->zoom_attend_link ?>" class="form-control"
                                   id="zoom_attend_link" name="zoom_attend_link"
                                   required>
                        </div>
                        <div class="form-group col-12">
                            <label for="recording_link"><?php echo get_phrase('webinar_recording_link'); ?><span
                                        class="required">*</span></label>
                            <input type="text" value="<?= $webinar->recording_link ?>" class="form-control"
                                   id="recording_link" name="recording_link"
                                   required>
                        </div>
                        <div class="form-group col-9">
                            <label for="record">
                                <?php echo get_phrase('webinar_recording'); ?>
                                <span class="required">*</span></label>
                            <input type="file" class="form-control" id="record" name="recording">
                            <input type="hidden" class="form-control" id="record" name="old_rec"
                                   value="<?= $webinar->recording ?>">
                        </div>
                        <div class="form-group col-3">
                            <label for="img">
                                <?php echo get_phrase('webinar_Recording'); ?>
                                <span class="required">*</span>
                            </label>
                            <img class="img-fluid rounded-circle img-thumbnail"
                                 src="<?= base_url() . 'uploads/webinar/' . $webinar->recording ?>">
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
<script>
         $(document).ready(function() {
            $('#summernote').summernote({
               height: 300, // set editor height
               minHeight: null, // set minimum height of editor
               maxHeight: null, // set maximum height of editor
               focus: true // set focus to editable area after initializing summernote
            });
         });
         $('#save').click(function(){
            var aHTML = $('.summernote').code(); //save HTML If you need(aHTML: array).
            $('.summernote').destroy();
            $.ajax({
               url: '/save',
               type: 'post',
               data: {content: aHTML},
               success: function(){
                  alert('Your content was successfully saved');
               }
            });
         });
      </script>