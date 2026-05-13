<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"><i
                            class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('batch'); ?>
                    <a href="<?php echo site_url('admin/batch_model_form/batch_model_add'); ?>"
                       class="btn btn-outline-primary btn-rounded alignToTitle">
                        <i class="mdi mdi-plus"></i>
                        <?php echo get_phrase('add_new_batch'); ?>
                    </a>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title"><?php echo get_phrase('batch'); ?></h4>
                <div class="table-responsive-sm mt-4">
                    <table id="basic-datatable" class="table table-striped table-centered mb-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo get_phrase('course_name'); ?></th>
                            <th><?php echo get_phrase('instructors_name'); ?></th>
                            <th><?php echo get_phrase('enrol_student'); ?></th>
                            <th><?php echo get_phrase('duration'); ?></th>
                            <th><?php echo get_phrase('date'); ?></th>
                            <th><?php echo get_phrase('time'); ?></th>
                            <th><?php echo get_phrase('limit'); ?></th>
                            <th><?php echo get_phrase('actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($batch_models as $key => $batch_model_list): ?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td><?php
                                    $r = explode(",", $batch_model_list['course_id']);
                                    if (sizeof($r) > 1) {
                                        foreach ($r as $re) {
                                            $result = $this->crud_model->get_course($re);
                                            echo $result[0]['title'] . " ,";
                                        }
                                    } else {
                                        $result = $this->crud_model->get_course($batch_model_list['course_id']);
                                        echo $result[0]['title'];
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $r = explode(",", $batch_model_list['instructor_id']);
                                    if (sizeof($r) > 1) {
                                        foreach ($r as $re) {
                                            $result = $this->crud_model->get_user_by_id($re);
                                            echo $result[0]['first_name'] . " " . $result[0]['last_name'] . " ,";
                                        }
                                    } else {
                                        $result = $this->crud_model->get_user_by_id($batch_model_list['instructor_id']);
                                        echo $result[0]['first_name'] . " " . $result[0]['last_name'];
                                    }
                                    ?>
                                </td>
                                <td>
                                    <small class="text-muted"><?php
                                        $total_enrollment = explode(",", $batch_model_list['students_id']);
                                        echo get_phrase('total_enrollment:') . '<b>' . sizeof($total_enrollment) . '</b>'; ?></small>
                                </td>
                                <td>
                                    <?php echo $batch_model_list['duration']; ?>
                                </td>
                                <td>
                                    <?php echo $batch_model_list['date']; ?>
                                </td>
                                <td>
                                    <?php echo $batch_model_list['time']; ?>
                                </td>
                                <td>
                                    <?php echo $batch_model_list['batch_limit']; ?>
                                </td>

                                <td>
                                    <div class="dropright dropright">
                                        <button type="button"
                                                class="btn btn-sm btn-outline-primary btn-rounded btn-icon"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item"
                                                   href="<?php echo site_url('admin/batch_model_form/view_students/' . $batch_model_list['id']) ?>"><?php echo get_phrase('view_students'); ?></a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                   href="<?php echo site_url('admin/batch_model_form/batch_model_edit/' . $batch_model_list['id']) ?>"><?php echo get_phrase('edit'); ?></a>
                                            </li>
                                            <li><a class="dropdown-item" href="#"
                                                   onclick="confirm_modal('<?php echo site_url('admin/batch_model_form/batch_model_delete/' . $batch_model_list['id']); ?>');"><?php echo get_phrase('delete'); ?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>




