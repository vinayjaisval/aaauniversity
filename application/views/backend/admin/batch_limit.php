<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">
                    <i class="mdi mdi-apple-keyboard-command title_icon"></i>
                    <?php echo get_phrase('add_batch_limit'); ?>
                    <a href="<?php echo site_url('admin/batch_limit_form/add_form'); ?>"
                       class="btn btn-outline-primary btn-rounded alignToTitle">
                        <i class="mdi mdi-plus"></i>
                        <?php echo get_phrase('add_new_batch_limit'); ?>
                    </a>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div> <!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title"><?php echo get_phrase('batch'); ?></h4>
                <div class="table-responsive-sm mt-4">
                    <table id="basic-datatable" class="table table-striped table-centered mb-0" style="text-align: center">
                        <thead>
                        <tr>
                            <th>#</th>
<!--                            <th>--><?php //echo get_phrase('course_name'); ?><!--</th>-->
                            <th><?php echo get_phrase('limit'); ?></th>
                            <th><?php echo get_phrase('action'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($batch_limit as $key => $batch_limit_list): ?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>
<!--                                <td>--><?php
//                                    $r = explode(",", $batch_limit_list['course_id']);
//                                    if (sizeof($r) > 1) {
//                                        foreach ($r as $re) {
//                                            $result = $this->crud_model->get_course($re);
//                                            echo $result[0]['title'] . " ,";
//                                        }
//                                    } else {
//                                        $result = $this->crud_model->get_course($batch_limit_list['course_id']);
//                                        echo $result[0]['title'];
//                                    }
//                                    ?>
                                </td>

                                <td>
                                    <?php echo $batch_limit_list['limit']; ?>
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
                                                   href="<?php echo site_url('admin/batch_limit_form/batch_limit_edit/' . $batch_limit_list['id']) ?>"><?php echo get_phrase('edit'); ?></a>
                                            </li>
                                            <li><a class="dropdown-item" href="#"
                                                   onclick="confirm_modal('<?php echo site_url('admin/batch_limit_form/batch_limit_delete/' . $batch_limit_list['id']); ?>');"><?php echo get_phrase('delete'); ?></a>
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

