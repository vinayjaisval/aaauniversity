<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"><i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('commission_type'); ?>
                    <a href="<?php echo site_url('admin/instructor_commission_form/instructor_commission_add'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle">
                        <i class="mdi mdi-plus"></i>
                        <?php echo get_phrase('instructor_commission_add'); ?>
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
                <h4 class="mb-3 header-title"><?php echo get_phrase('commission_type'); ?></h4>
                <div class="table-responsive-sm mt-4">
                    <table id="basic-datatable" class="table table-striped table-centered mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo get_phrase('commission_type'); ?></th>
                                <th><?php echo get_phrase('amount'); ?></th>
                                <th><?php echo get_phrase('actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($instructor_commission as $key => $batch_model_list) : ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <!-- <td><?php
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
                                    </td> -->
                                    <td>
                                        <?php echo $batch_model_list['commission_type']; ?>
                                    </td>
                                    <td>
                                        <?php echo $batch_model_list['amount']; ?>
                                    </td>


                                    <td>
                                        <div class="dropright dropright">
                                            <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">

                                                <li><a class="dropdown-item" href="<?php echo site_url('admin/instructor_commission_form/instructor_commission_edit/' . $batch_model_list['id']) ?>"><?php echo get_phrase('edit'); ?></a>
                                                </li>
                                                <!-- <li><a class="dropdown-item" href="#" onclick="confirm_modal('<?php echo site_url('admin/instructor_commission_form/instructor_commission_delete/' . $batch_model_list['id']); ?>');"><?php echo get_phrase('delete'); ?></a>
                                                </li> -->
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