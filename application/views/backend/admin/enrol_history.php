<?php
$payment_transaction = $this->db->get('payment_transaction')->result_array();
$enroll_data = $this->db->get('enrol')->result_array();
$offline_payment_data = $this->db->get('offline_payment')->result_array();


/******** Enroll History Data ********/
$enrol_history1 = $enrol_history;
$enrol_list = [];
if ($pending == 'yes') {
    foreach ($enrol_history1->result_array() as $enrol_data) {
        $enrol_list[] = $this->db->get_where('enrol', array('tr_num' => $enrol_data['payment_id']))->row_array();
    }
} else {
    $enrol_list = $enrol_history1->result_array();
}
?>


<style>
    .scroll_table {
        overflow-x: scroll !important;
    }
</style>
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"><i
                            class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('enrol_history'); ?>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<?php

$online_amount = 0;
$offline_amount = 0;
$pending_amount = 0;
$total_E_C_amount = 0;

foreach ($enroll_data as $enrol) {
    if ($enrol['p_status'] == 'offline') {
        $course = $this->db->get_where('course', array('id' => $enrol['course_id']))->row_array();
        $total_E_C_amount = $total_E_C_amount + $course['price'];
    }

}

foreach ($payment_transaction as $pay_data) {

    if ($pay_data['method'] != 'offline') {
        $online_amount = $online_amount + $pay_data['amount'];
    } else {
        $offline_amount = $offline_amount + $pay_data['amount'];
    }
}


if ($offline_amount > 0) {
    $pending_amount = $total_E_C_amount - $offline_amount;
}


?>


<div class="row">
    <div class="col-12">
        <div class="card widget-inline">
            <div class="card-body p-0">
                <div class="row no-gutters">
                    <div class="col-sm-6 col-xl-4">
                        <a href="<?php echo '#' //site_url('admin/courses'); ?>" class="text-secondary">
                            <div class="card shadow-none m-0">
                                <div class="card-body text-center">
                                    <i class="dripicons-archive text-muted" style="font-size: 24px;"></i>
                                    <h3><span><?php echo $online_amount; ?></span></h3>
                                    <p class="text-muted font-15 mb-0"><?php echo get_phrase('Online_amount'); ?></p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-6 col-xl-4">
                        <a class="text-secondary">
                            <div class="card shadow-none m-0 border-left">
                                <div class="card-body text-center">
                                    <i class="dripicons-camcorder text-muted" style="font-size: 24px;"></i>
                                    <h3><span><?php echo $offline_amount; ?></span></h3>
                                    <p class="text-muted font-15 mb-0"><?php echo get_phrase('offline_amount'); ?></p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-6 col-xl-4">
                        <a href="<?php echo ($pending_amount > 0) ? site_url('admin/pending_amount') : '#'; ?>"
                           class="text-secondary">
                            <div class="card shadow-none m-0 border-left">
                                <div class="card-body text-center">
                                    <i class="dripicons-network-3 text-muted" style="font-size: 24px;"></i>
                                    <h3><span><?php echo $pending_amount; ?></span></h3>
                                    <p class="text-muted font-15 mb-0"><?php echo get_phrase('pending_amount'); ?></p>
                                </div>
                            </div>
                        </a>
                    </div>

                </div> <!-- end row -->
            </div>
        </div> <!-- end card-box-->
    </div> <!-- end col-->
</div>


<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body scroll_table">
                <h4 class="mb-3 header-title"><?php echo get_phrase('enrol_histories'); ?></h4>
                <div class="row justify-content-md-center">
                    <div class="col-xl-6">
                        <form class="form-inline"
                              action="<?php echo site_url('admin/enrol_history/filter_by_date_range') ?>" method="get">
                            <div class="col-xl-10">
                                <div class="form-group">
                                    <div id="reportrange" class="form-control" data-toggle="date-picker-range"
                                         data-target-display="#selectedValue" data-cancel-class="btn-light"
                                         style="width: 100%;">
                                        <i class="mdi mdi-calendar"></i>&nbsp;
                                        <span id="selectedValue"><?php echo date("F d, Y", $timestamp_start) . " - " . date("F d, Y", $timestamp_end); ?></span>
                                        <i class="mdi mdi-menu-down"></i>
                                    </div>
                                    <input id="date_range" type="hidden" name="date_range"
                                           value="<?php echo date("d F, Y", $timestamp_start) . " - " . date("d F, Y", $timestamp_end); ?>">
                                </div>
                            </div>
                            <div class="col-xl-2">
                                <button type="submit" class="btn btn-info" id="submit-button"
                                        onclick="update_date_range();"> <?php echo get_phrase('filter'); ?></button>
                            </div>
                        </form>
                    </div>

                    <div class="col-xl-6">
                        <form class="form-inline"
                              action="<?php echo site_url('admin/enrol_history/filter_by_date_range') ?>" method="get">
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <select class="form-control" id="status_select">
                                        <option value="">Select Status</option>
                                        <option value="OFFLINE">OFFLINE</option>
                                        <option value="ONLINE">ONLINE</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive-sm mt-4 pr-10">
                    <?php
                    if (count($enrol_list) > 0):
                        ?>
                        <table id="enroll_data_table" class="table mb-0 ">
                            <thead>
                            <tr>
                                <th><?php echo get_phrase('photo'); ?></th>
                                <th><?php echo get_phrase('user_name'); ?></th>
                                <th><?php echo get_phrase('contact'); ?></th>
                                <th><?php echo get_phrase('transaction_number'); ?></th>
                                <th><?php echo get_phrase('enrolled_course'); ?></th>
                                <th><?php echo get_phrase('enrolment_date'); ?></th>
                                <th><?php echo get_phrase('purchase_status'); ?></th>
                                <th><?php echo get_phrase('due_date'); ?></th>
                                <th><?php echo get_phrase('actions'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            foreach ($enrol_list as $enrol):
                                $user_data = $this->db->get_where('users', array('id' => $enrol['user_id']))->row_array();
                                $course_data = $this->db->get_where('course', array('id' => $enrol['course_id']))->row_array();
                                $transaction_data = $this->db->get_where('payment_transaction', array('payment_id' => $enrol['tr_num']))->row_array(); ?>
                                <tr class="gradeU">
                                    <td>
                                        <img src="<?php echo $this->user_model->get_user_image_url($enrol['user_id']); ?>"
                                             alt="" height="50" width="50"
                                             class="img-fluid rounded-circle img-thumbnail">
                                    </td>
                                    <td>
                                        <b><?php echo $user_data['first_name'] . ' ' . $user_data['last_name']; ?></b><br>
                                        <small><?php echo get_phrase('email') . ': ' . $user_data['email']; ?></small>
                                    </td>
                                    <td>
                                        <b><?php echo $user_data['contact']; ?></b><br>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url('admin/transaction_history/' . $enrol['tr_num']) ?>"
                                           target="_blank"> <b><?php echo $enrol['tr_num']; ?></b></a><br>
                                    </td>
                                    <td>
                                        <strong><a href="<?php echo site_url('home/course/' . $course_data['title'] . '/' . $course_data['id']); ?>"
                                                   target="_blank"><?php echo $course_data['title']; ?></a></strong>
                                    </td>
                                    <td><?php echo date('D, d-M-Y', strtotime($enrol['created_at'])); ?></td>

                                    <td><?php echo strtoupper($enrol['p_status']); ?></td>
                                    <td style="white-space: nowrap;overflow: hidden; text-overflow: ellipsis;">
                                        <b><?php
                                            if ($transaction_data['next_due_date'] == '') {
                                                echo "No Due";
                                            } else {
                                                echo date_diff_days($transaction_data['next_due_date']);
                                            } ?>
                                        </b>
                                        <br>

                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-outline-danger btn-icon btn-rounded btn-sm"
                                                onclick="confirm_modal('<?php echo site_url('admin/enrol_history_delete/' . $enrol['id']); ?>');">
                                            <i class="dripicons-trash"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                    <?php if (count($enrol_history->result_array()) == 0): ?>
                        <div class="img-fluid w-100 text-center">
                            <img style="opacity: 1; width: 100px;"
                                 src="<?php echo base_url('assets/backend/images/file-search.svg'); ?>"><br>
                            <?php echo get_phrase('no_data_found'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    function update_date_range() {
        var x = $("#selectedValue").html();
        $("#date_range").val(x);
    }

    $(document).ready(function () {
        $('#enroll_data_table').dataTable({
            "scrollX": true,
            "scrollCollapse": true
        });
        var oTable = $('#enroll_data_table').dataTable();


        $('#status_select').change( function () {  oTable.fnFilter( this.value, 6 );  } );

    });

    // $('#status_select').change(function () {
    //
    //     let s_val = $(this).val();
    //     if (s_val > 0) {
    //         if (parseInt(s_val) === 1) {
    //             // console.log(s_val)
    //             $('#enroll_data_table').dataTable({
    //                 "order": [[6, "ASE"]],
    //                 "bSort": false,
    //             });
    //         }
    //         if (parseInt(s_val) === 2) {
    //             // console.log(s_val)
    //             $('#enroll_data_table').dataTable({
    //                 "order": [[6, "DSEC"]],
    //                 "bSort": false,
    //             });
    //         }
    //
    //     }
    //
    // })

</script>
