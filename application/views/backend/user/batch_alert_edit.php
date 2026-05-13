<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"><i
                            class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('edit_batch'); ?>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3"><?php echo get_phrase('edit_batch'); ?></h4>
                <form class="required-form" action="<?php echo site_url('user/batch_model_form/edit/'.$id); ?>"
                      enctype="multipart/form-data" method="post">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label" for="students"><?php echo get_phrase('students');
                                    ?><span class="required">*</span></label>
                                <div class="col-md-9">
                                    <select class="form-control select2" data-toggle="select2" name="students[]"
                                            id="students" multiple="multiple">
                                        <?php
                                        $students_lists = explode(",", $batch_model_data[0]['students_id']);
                                        foreach ($students as $students_list): ?>
                                            <?php
                                            foreach ($students_lists as $key => $like) {
                                                if (sizeof($students_lists) > 1) {
                                                    if ($students_list['id'] == $like) { ?>
                                                        <option value="<?php echo $students_list['id'] ?>" selected>
                                                            <?php
                                                            $result = $this->crud_model->get_user_by_id($like);
                                                            echo $result[0]['first_name'] . " " . $result[0]['last_name'];
                                                            ?>
                                                        </option>
                                                        <?php
                                                    }
                                                } elseif ($students_list['id'] == $batch_model_data[0]['students_id']) {
                                                    ?>
                                                    <option value="<?php echo $students_list['id'] ?>" selected>
                                                        <?php
                                                        $result = $this->crud_model->get_user_by_id($like);
                                                        echo $result[0]['first_name'] . " " . $result[0]['last_name'];
                                                        ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        <?php
                                            if ($students_list['is_instructor'] !=1){
                                            ?>
                                            <option value="<?php echo $students_list['id']; ?>">
                                                <?php echo  $students_list['first_name']." ".$students_list['last_name'] ?>
                                            </option>
                                        <?php }
                                            endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label"
                                       for="course_name"><?php echo get_phrase('course_name'); ?><span class="required">*</span></label>
                                <div class="col-md-9">
                                    <select class="form-control select2" data-toggle="select2" name="course_name[]"
                                            id="course_name" multiple="multiple">
                                        <?php
                                        $courses_lists = explode(",", $batch_model_data[0]['course_id']);

                                        foreach ($courses as $courses_list): ?>
                                            <?php
                                            foreach ($courses_lists as $key => $like) {
                                                if (sizeof($courses_lists) > 1) {
                                                    if ($courses_list['id'] == $like) { ?>
                                                        <option value="<?php echo $courses_list['id'] ?>" selected>
                                                            <?php
                                                            echo $courses_list['title'];
                                                            ?>
                                                        </option>
                                                        <?php
                                                    }
                                                } elseif ($courses_list['id'] == $batch_model_data[0]['course_id']) {
                                                    ?>
                                                    <option value="<?php echo $courses_list['id'] ?>" selected>
                                                        <?php
                                                        echo $courses_list['title'];
                                                        ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <option value="<?php echo $courses_list['id']; ?>">
                                                <?php echo $courses_list['title'] ?>
                                            </option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label"
                                       for="instructor_name"><?php echo get_phrase('instructor_name'); ?><span
                                            class="required">*</span></label>
                                <div class="col-md-9">

                                    <select class="form-control select2" data-toggle="select2" name="instructor_name[]"
                                            id="instructor_name" multiple="multiple">
                                        <?php
                                        $instructors_lists = explode(",", $batch_model_data[0]['instructor_id']);
                                        foreach ($students as $instructors_list):
                                            ?>
                                            <?php
                                            foreach ($instructors_lists as $key => $instructors_id) {
                                                if (sizeof($instructors_lists) > 1) {

                                                    if ($instructors_list['id'] == $instructors_id) { ?>

                                                    <option value="<?php echo $instructors_list['id'] ?>" selected>
                                                        <?php
                                                        $result = $this->crud_model->get_user_by_id($instructors_id);
                                                        if ($result[0]['is_instructor'] == "1") {
                                                            echo $result[0]['first_name'] . " " . $result[0]['last_name'];
                                                            ?>
                                                            </option>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                elseif ($instructors_list['id'] == $batch_model_data[0]['instructor_id']) {
                                                    ?>
                                                    <option value="<?php echo $instructors_list['id'] ?>" selected>
                                                        <?php
                                                        echo $result[0]['first_name'] . " " . $result[0]['last_name'];
                                                        ?>
                                                    </option>
                                                    <?php
                                                }
                                                if ($instructors_list['is_instructor'] == "1") {
                                                    ?>
                                                    <option value="<?php echo $instructors_list['id']; ?>">
                                                        <?php echo $instructors_list['first_name'] . " " . $instructors_list['last_name'] ?>
                                                    </option>
                                                <?php }
                                            }

                                        endforeach; ?>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label"
                                       for="duration"><?php echo get_phrase('duration'); ?></label>
                                <div class="col-md-9">
                                    <select class="form-control select2" data-toggle="select2" name="duration"
                                            id="duration">

                                        <?php
                                        $option_value = $batch_model_data[0]['duration'];

                                        if (!empty($option_value)){
                                            ?>
                                            <option value="daily" selected><?php echo get_phrase($batch_model_data[0]['duration']);?></option>
                                            <?php
                                        }
                                        ?>
                                        <option value="daily">Daily</option>
                                        <option value="weekly">Weekly</option>
                                        <option value="monthly">Monthly</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label" for="date"><?php echo get_phrase('date'); ?><span
                                            class="required">*</span></label>
                                <div class="col-md-9">
                                    <input type="date" class="form-control" id="date" name="date" value="<?php echo $batch_model_data[0]['date']?>" required >
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
                                    <input type="time" class="form-control" id="time" name="time" value="<?php echo $batch_model_data[0]['time']?>" required>
                                </div>
                            </div>

                        </div> <!-- end col -->
                    </div>
                    <div class="tab-pane" id="finish">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-primary" onclick="checkRequiredFields()"
                                                name="button"><?php echo get_phrase('update'); ?></button>
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