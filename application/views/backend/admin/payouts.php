<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"><i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('payouts'); ?>
                    <a href="<?php echo site_url('admin/payouts_form/payouts_add'); ?>" class="btn btn-outline-primary btn-rounded alignToTitle">
                        <i class="mdi mdi-plus"></i>
                        <?php echo get_phrase('payouts'); ?>
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
                <h4 class="mb-3 header-title"><?php echo get_phrase('payouts'); ?></h4>
                <div class="table-responsive-sm mt-4">
                    <table id="basic-datatable" class="table table-striped table-centered mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo get_phrase('instructor_name'); ?></th>
                                <th><?php echo get_phrase('start_date'); ?></th>
                                <th><?php echo get_phrase('end_date'); ?></th>
                                <th><?php echo get_phrase('commission_type'); ?></th>
                                <th><?php echo get_phrase('total_hours'); ?></th>
                                <th><?php echo get_phrase('total_amount'); ?></th>
                                <th><?php echo get_phrase('payments_type'); ?></th>
                                <th><?php echo get_phrase('status'); ?></th>

                                <th><?php echo get_phrase('actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($instructor_payouts as $key => $payouts_list) : ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td>
                                        <?php $uid = $payouts_list['user_id'];
                                        $result = $this->crud_model->get_user_by_id($uid);
                                        echo $result[0]['first_name'] . " " . $result[0]['last_name'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $payouts_list['start_date']; ?>
                                    </td>
                                    <td>
                                        <?php echo $payouts_list['end_date']; ?>
                                    </td>
                                    <td>
                                    <?php
                                            $uid = $payouts_list['duration'];
                                            $t_hours = $payouts_list['commission_by_hours'];
                                            $array_hours = explode(",", $t_hours);
                                            $array_data = explode(',', $uid);
                                            foreach ($array_data as $key => $id) {
                                                if ($id == "0") {

                                                } else {
                                                    $result = $this->user_model->get_all_commission($id)->result_array();
                                                    echo "<small>" . $result[0]['commission_type'] . " = " . $array_hours[$key] . "</small> <br>";
                                                }
                                            }
                                            ?>
                                    </td>
                                    <td>
                                        <?php echo $payouts_list['total_hours']; ?>
                                    </td>
                                    <td>
                                        <?php echo $payouts_list['total_amount']; ?>
                                    </td>
                                    <td>
                                        <?php echo $payouts_list['payments_type']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $status = $payouts_list['status'];
                                        // print_r($status);
                                        // die;
                                        if ($status != 1) {
                                        ?>
                                            <h4>
                                                <b class="badge badge-secondary text-nowrap" style="background-color: #e393a7;border-color: #e393a7;padding: 4px">
                                                    Pending
                                                </b>
                                            </h4>
                                        <?php
                                        } else {
                                        ?>
                                            <h4>
                                                <b class="badge badge-secondary text-nowrap" style="background-color: #93e39b;padding: 4px">
                                                    Approved
                                                </b>
                                            </h4>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <div class="dropright dropright">
                                            <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">

                                                <li><a class="dropdown-item" href="<?php echo site_url('admin/payouts_form/payouts_edit/' . $payouts_list['id']) ?>"><?php echo get_phrase('edit'); ?></a>
                                                </li>
                                                <li><a class="dropdown-item" href="#" onclick="confirm_modal('<?php echo site_url('admin/payouts_form/payouts_delete/' . $payouts_list['id']); ?>');"><?php echo get_phrase('delete'); ?></a>
                                                </li>
                                                <li>
                                                    <?php
                                                    if ($payouts_list['status'] == 1) {
                                                    ?>
                                                        <a class="dropdown-item" href="<?php echo site_url('admin/payouts_form/status_pending/' . $payouts_list['id']) ?>">
                                                            <?php echo get_phrase('status_pending'); ?></a>
                                                    <?php
                                                    } else {
                                                        //
                                                    ?>
                                                        <a class="dropdown-item" href="<?php echo site_url('admin/payouts_form/status_approved/' . $payouts_list['id']) ?>">
                                                            <?php echo get_phrase('status_approved'); ?></a>
                                                    <?php
                                                    }
                                                    ?>

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