<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('add_new_batch'); ?>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3"><?php echo get_phrase('add_batch'); ?></h4>
                <form class="required-form" action="<?php echo site_url('user/batch_model_form/add'); ?>" enctype="multipart/form-data" method="post">
                    <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="students"><?php echo get_phrase('students'); ?><span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <select class="form-control select2" data-toggle="select2" name="students[]" id="students"  multiple="multiple">
                                                    <?php foreach ($students as $students_list): ?>
                                                    <?php
                                                        if ($students_list['is_instructor'] !=1){
                                                        ?>
                                                        <option value="<?php echo $students_list['id']; ?>">
                                                            <?php echo  $students_list['first_name']." ".$students_list['last_name'] ?>
                                                        </option>
                                                    <?php
                                                        }
                                                        endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="course_name"><?php echo get_phrase('course_name'); ?><span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <select class="form-control select2" data-toggle="select2" name="course_name[]" id="course_name"  multiple="multiple">
                                                    <?php
                                                    foreach ($courses as $courses_list): ?>
                                                        <option value="<?php echo $courses_list['id']; ?>">
                                                            <?php echo  $courses_list['title'] ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="instructor_name"><?php echo get_phrase('instructor_name'); ?><span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <select class="form-control select2" data-toggle="select2" name="instructor_name[]" id="instructor_name[]"  multiple="multiple">
                                                    <?php
                                                    foreach ($students as $instructors_list):
                                                        if ($instructors_list['is_instructor'] == "1"){?>
                                                            <option value="<?php echo $instructors_list['id']; ?>">
                                                                <?php echo  $instructors_list['first_name']." ".$instructors_list['last_name'] ?>
                                                            </option>
                                                    <?php } endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="duration"><?php echo get_phrase('duration'); ?><span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <select class="form-control select2" data-toggle="select2" name="duration" id="duration" >
                                                    <option value="daily">Daily</option>
                                                    <option value="weekly">Weekly</option>
                                                    <option value="monthly">Monthly</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="date"><?php echo get_phrase('date'); ?><span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <input type="date" class="form-control" id="date" name="date" required>
                                            </div>

                                            <script language="javascript">
                                                var today = new Date();
                                                var dd = String(today.getDate()).padStart(2, '0');
                                                var mm = String(today.getMonth() + 1).padStart(2, '0');
                                                var yyyy = today.getFullYear();

                                                today = yyyy + '-' + mm + '-' + dd;
                                                $('#date').attr('min',today);
                                            </script>

                                        </div>

                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label" for="time"><?php echo get_phrase('time'); ?><span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <input type="time" class="form-control" id="time" name="time" required>
                                            </div>
                                        </div>


                                    </div> <!-- end col -->
                                </div>
                    <div class="tab-pane" id="finish">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="text-center">
                                            <div class="mb-3">
                                                <button type="button" class="btn btn-primary" onclick="checkRequiredFields()" name="button"><?php echo get_phrase('submit'); ?></button>
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            </div>
                </form>
            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div>
</div>