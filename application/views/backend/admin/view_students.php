<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"><i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('view_student'); ?>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-12">
        <div class="card ">
            <div class="card-body p-0">
                <div class="row ">

                    <div class="col-sm-4 ">
                        <div class="card shadow-none m-0 border-left">
                            <div class="card-body text-left">
                                <h4>
                                    <p class="font-18 mb-0 font-bold"><?php echo get_phrase('instructor name :-'); ?></p>
                                </h4>
                                <span>
                                    <?php
                                    $instructors_lists = explode(",", $batch_model_data[0]['instructor_id']);
                                    foreach ($students as $instructors_list) {
                                        foreach ($instructors_lists as $key => $instructors_id) {
                                            $result = $this->crud_model->get_user_by_id($instructors_id);

                                            if (sizeof($instructors_lists) > 1) {
                                                if ($instructors_list['id'] == $instructors_id) {
                                                    if ($result[0]['is_instructor'] == "1") {
                                                        echo "<b style='font-size:17px'>" . $result[0]['first_name'] . " " . $result[0]['last_name'] . "</b></br>";
                                                    }
                                                }
                                            } elseif ($instructors_list['id'] == $batch_model_data[0]['instructor_id']) {
                                                echo "<b class='text-muted' style='font-size:17px'>" . $result[0]['first_name'] . " " . $result[0]['last_name'] . "</b>";
                                            }
                                        }
                                    }
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-4 ">
                        <div class="card shadow-none m-0 border-left">
                            <div class="card-body text-left">
                                <h4>
                                    <p class="font-18 mb-0 font-bold"><?php echo get_phrase('courses :-'); ?></p>
                                </h4>
                                <!--                                <i class="dripicons-tags text-muted" style="font-size: 24px;"></i>-->
                                <?php
                                $courses_lists = explode(",", $batch_model_data[0]['course_id']);
                                foreach ($courses as $courses_list) {
                                    foreach ($courses_lists as $key => $like) {
                                        if (sizeof($courses_lists) > 1) {
                                            if ($courses_list['id'] == $like) {
                                                echo "<b class='text-muted' style='font-size:17px'>" . $courses_list['title'] . "</b></br>";
                                            }
                                        } elseif ($courses_list['id'] == $batch_model_data[0]['course_id']) {
                                            echo "<b class='text-muted' style='font-size:17px'>" . $courses_list['title'] . "</b>";
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 ">
                        <div class="card shadow-none m-0 border-left">
                            <div class="card-body text-left">
                                <h4>
                                    <p class="font-18 mb-0 font-bold"><?php echo get_phrase('total students :-'); ?></p>
                                </h4>
                                <!--                                <i class="dripicons-tags text-muted" style="font-size: 24px;"></i>-->
                                <?php
                                $total_students = explode(",", $batch_model_data[0]['students_id']);
                                echo "<b class='text-muted' style='font-size:17px'>" . sizeof($total_students) . "</b>";
                                ?>
                            </div>
                        </div>
                    </div>

                </div> <!-- end row -->
            </div>
        </div> <!-- end card-box-->
    </div> <!-- end col-->
</div>


<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3"><?php echo get_phrase('view_student'); ?></h4>
                <form class="required-form" action="<?php echo site_url('admin/batch_model_form/edit/' . $id); ?>" enctype="multipart/form-data" method="post">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive-sm mt-1">
                                <table class="table table-striped table-centered mb-0">
                                    <thead>
                                        <th class="col-2">
                                            <h4>#</h4>
                                        </th>
                                        <th class="col-10">
                                            <h4>Name</h4>
                                        </th>
                                    </thead>

                                    <?php
                                    $student_lists = explode(",", $batch_model_data[0]['students_id']);
                                    $sno = 1;
                                    foreach ($students as $student_list) {
                                        foreach ($student_lists as $key => $student_id) {
                                            $result = $this->crud_model->get_user_by_id($student_id);
                                            if (sizeof($student_lists) > 1) {
                                                if ($student_list['id'] == $student_id) { ?>

                                                    <tbody>
                                                        <th class="col-2"><?php echo $sno ?></th>
                                                        <th class="col-10"><?php echo "<b style='font-size:17px'>" . $result[0]['first_name'] . " " .
                                                                                $result[0]['last_name'] . "</b>"; ?></th>
                                                    </tbody>

                                                <?php
                                                    $sno = $sno + 1;
                                                }
                                            } elseif ($student_list['id'] == $batch_model_data[0]['students_id']) {
                                                ?>
                                                <tbody>
                                                    <th class="col-2"><?php echo $sno ?></th>
                                                    <th class="col-10"><?php echo "<b style='font-size:17px'>" . $result[0]['first_name'] . " " .
                                                                            $result[0]['last_name'] . "</b>"; ?></th>
                                                </tbody>

                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </table>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </form>
            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div>
</div>