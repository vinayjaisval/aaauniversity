<!-- start page title -->

<style>
    #pending_transaction_datatable{
        margin-top: 10px !important;
        margin-bottom: 10px !important;
        overflow-x: scroll;
    }
</style>

<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"><i
                            class="mdi mdi-apple-keyboard-command title_icon"></i> <a
                            href="<?php echo base_url('admin/transaction_history') ?>"><?php echo get_phrase('transaction_history'); ?></a>

                    <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" <?php echo ($visible == "one") ? '' : 'hidden' ?>
                       class="btn btn-outline-dark btn-rounded alignToTitle fixed-bottom w-15 mb-4"
                       style=" left: auto; right: 50px!important;">
                        <i class="mdi mdi-backspace"></i>
                        <?php echo get_phrase('back_transaction_history'); ?>
                    </a>
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

$payment_transaction = $this->db->get('payment_transaction')->result_array();
$enroll_data = $this->db->get('enrol')->result_array();
$offline_payment_data = $this->db->get('offline_payment')->result_array();

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
                        <a href="<?php echo ($pending_amount > 0) ? site_url('admin/transaction_history/pending') : '#'; ?>"
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


<div class="row" <?php echo ($visible == "all") ? '' : 'hidden' ?> id="all_transaction">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title"><?php echo get_phrase('transaction_history'); ?></h4>
                <div class="row justify-content-md-center">
                    <div class="col-xl-6">
                        <form class="form-inline"
                              action="<?php echo site_url('admin/transaction_history/filter_by_date_range') ?>"
                              method="get">
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
                </div>
                <div class="table-responsive-sm mt-4">
                    <?php if (count($transaction_history->result_array()) > 0): ?>
                        <table id="<?php echo ($visible == "all") ? 'transaction_datatable' : '' ?>"
                               class="table table-striped table-centered mb-0">
                            <thead>
                            <tr>
                                <th><?php echo get_phrase('Payment Id'); ?></th>
                                <th><?php echo get_phrase('Razorpay Order Id'); ?></th>
                                <th><?php echo get_phrase('Amount'); ?></th>
                                <th><?php echo get_phrase('Email'); ?></th>
                                <th><?php echo get_phrase('Status'); ?></th>
                                <th style="white-space: nowrap;overflow: hidden; text-overflow: ellipsis;" aria-sort="descending">
                                    <?php echo get_phrase('last_date'); ?>
                                </th>
                                <th><?php echo get_phrase('actions'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($transaction_history->result_array() as $transaction):

                                $user_data = $this->db->get_where('users', array('id' => $transaction['user_id']))->row_array();
                                ?>
                                <tr class="gradeU">
                                    <td>
                                        <b><?php echo $transaction['payment_id']; ?></b><br>
                                    </td>
                                    <td>
                                        <b><?php echo $transaction['payment_order_id']; ?></b><br>
                                    </td>
                                    <td>
                                        <b><?php echo "₹ " . $transaction['amount']; ?></b><br>
                                    </td>
                                    <td>
                                        <b><?php echo $transaction['email']; ?></b><br>
                                    </td>
                                    <td>
                                        <b><?php echo $transaction['status']; ?></b><br>
                                    </td>
                                    <td>
                                        <span style="display:none;"> <?php echo strtotime($transaction['updated_at'])?> </span>
                                        <b><?php echo date('d-m-y h:i',strtotime($transaction['updated_at'])); ?></b>
                                    </td>
                                    <td>

                                        <?php
                                        if ($transaction['status'] == "pending"):
                                            ?>
                                            <div class="dropright dropright">
                                                <button type="button"
                                                        class="btn btn-sm btn-outline-primary btn-rounded btn-icon"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="<?php echo base_url('admin/transaction_history/' . $transaction['payment_id']) ?>"
                                                           class="dropdown-item"><?php echo get_phrase('view_installment'); ?></a>
                                                    </li>
                                                    <li id="repay_id">
                                                        <a class="dropdown-item"
                                                           href="<?php echo base_url('admin/installment_repay/' . $transaction['payment_id']) ?>"
                                                           target="_blank"><?php echo get_phrase('repay_installment'); ?></a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                           onclick="confirm_modal('<?php echo site_url('admin/transaction_history/history_delete/' . $transaction['id']); ?>');"><?php echo get_phrase('Delete'); ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        <?php else: ?>
                                            <button type="button"
                                                    onclick="confirm_modal('<?php echo site_url('admin/transaction_history/history_delete/' . $transaction['id']); ?>');"
                                                    class="btn btn-outline-danger btn-icon btn-rounded btn-sm"><i
                                                        class="dripicons-trash"></i></button>
                                        <?php endif; ?>
                                    </td>
                                </tr>

                            <?php endforeach; ?>


                            </tbody>
                        </table>
                    <?php endif; ?>
                    <?php if (count($transaction_history->result_array()) == 0): ?>
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


<div class="row" <?php echo ($visible == "one") ? '' : 'hidden' ?> id="one_transaction">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title"><?php echo get_phrase('transaction_history'); ?></h4>
                <div class="row justify-content-md-center">
                    <div class="col-xl-6">
                        <form class="form-inline"
                              action="<?php echo site_url('admin/transaction_history/filter_by_date_range') ?>"
                              method="get">
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
                </div>
                <div class="table-responsive-sm mt-4">
                    <?php if (count($transaction_history->result_array()) > 0): ?>
                        <table id="<?php echo ($visible == "one") ? 'transaction_datatable_one' : '' ?>"
                               class="table table-striped table-centered mb-0">
                            <thead>
                            <tr>
                                <th><?php echo get_phrase('Payment Id'); ?></th>
                                <th><?php echo get_phrase('Razorpay Order Id'); ?></th>
                                <!--                                <th>-->
                                <?php //echo get_phrase('Course name'); ?><!--</th>-->
                                <th><?php echo get_phrase('Amount'); ?></th>
                                <th><?php echo get_phrase('Email'); ?></th>
                                <!--                                <th>-->
                                <?php //echo get_phrase('Created At'); ?><!--</th>-->
                                <th><?php echo get_phrase('Status'); ?></th>
                                <th><?php echo get_phrase('next_due_date'); ?></th>
                                <!--                                <th>-->
                                <?php //echo get_phrase('new'); ?><!--</th>-->
                                <th><?php echo get_phrase('actions'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($transaction_history->result_array() as $transaction1):
                                $user_data = $this->db->get_where('users', array('id' => $transaction1['user_id']))->row_array();
                                ?>
                                <tr class="gradeU">
                                    <td>
                                        <b><?php echo $transaction1['payment_id']; ?></b><br>
                                    </td>
                                    <td>
                                        <b><?php echo $transaction1['payment_order_id']; ?></b><br>
                                    </td>
                                    <td>
                                        <b><?php echo "₹ " . $transaction1['amount']; ?></b><br>
                                    </td>
                                    <td>
                                        <b><?php echo $transaction1['email']; ?></b><br>
                                    </td>
                                    <td>
                                        <b><?php echo $transaction1['status']; ?></b><br>
                                    </td>
                                    <td>
                                        <b><?php echo ($transaction1['next_due_date'] == null) ? 'No Due' : date_diff_days($transaction1['next_due_date']); ?></b><br>
                                    </td>
                                    <td>

                                        <?php
                                        if ($transaction1['payment_order_id'] == ""):
                                            ?>
                                            <div class="dropright dropright">
                                                <button type="button"
                                                        class="btn btn-sm btn-outline-primary btn-rounded btn-icon"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu" style="position: relative ">
                                                    <li><a class="dropdown-item" style="cursor: pointer"
                                                           onclick="view_history()"
                                                           id="view_<?php echo $transaction1['id'] ?>"><?php echo get_phrase('view_installment'); ?></a>
                                                    </li>
                                                    <li id="repay_id">
                                                        <a class="dropdown-item"
                                                           href="<?php echo base_url('admin/installment_repay/' . $transaction1['payment_id']) ?>"
                                                           target="_self"><?php echo get_phrase('repay_installment'); ?></a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                           onclick="confirm_modal('<?php echo site_url('admin/transaction_history/history_delete/' . $transaction1['id']); ?>');"><?php echo get_phrase('Delete'); ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        <?php else: ?>
                                            <button type="button"
                                                    class="btn btn-outline-danger btn-icon btn-rounded btn-sm"><i
                                                        class="dripicons-trash"></i></button>
                                        <?php endif; ?>
                                    </td>
                                </tr>

                                <table id="install<?php echo $transaction1['id'] ?>">
                                    <?php

                                    $get_off_pay = $this->crud_model->get_offline_payment($transaction1['payment_id'])->row_array();
                                    $course_data = $this->db->get_where('course', array('id' => $get_off_pay['course_id']))->row_array();
                                    $user_data = $this->db->get_where('users', array('id' => $transaction1['user_id']))->row_array();
                                    $offline_payment_data = $this->db->get_where('offline_payment', array('tr_num' => $transaction1['payment_id']))->result_array();
                                    ?>
                                    <tr>
                                        <th style="padding: 10px">
                                            #
                                        </th>
                                        <th style="padding: 10px">
                                            Payment Date
                                        </th>
                                        <th style="padding: 10px">
                                            Student Name
                                        </th>
                                        <th style="padding: 10px">
                                            Course Name
                                        </th>
                                        <th style="padding: 10px">
                                            Course Price
                                        </th>
                                        <th style="padding: 10px">
                                            Student Pay
                                        </th>
                                        <th style="padding: 10px">
                                            Arrears Amount
                                        </th>
                                    </tr>
                                    <?php
                                    $repay_visible = 'no';
                                    $total_amu = '';
                                    $payable_amu = '';
                                    foreach ($offline_payment_data as $key => $offline_data) {
                                        $total_amu = $total_amu + $offline_data['amount'];
                                        $payable_amu = $payable_amu + $offline_data['amount'];
                                        ?>
                                        <tr>
                                            <td style="padding: 10px">
                                                <?php echo $key + 1 ?>
                                            </td>
                                            <td style="padding: 10px">
                                                <?php echo date('M d , Y', strtotime($offline_data['created_at'])) ?>
                                            </td>
                                            <td style="padding: 10px">
                                                <?php echo $user_data['first_name'] . ' ' . $user_data['last_name'] ?>
                                            </td>
                                            <td style="padding: 10px">
                                                <?php echo $course_data['title'] ?>
                                            </td>
                                            <td style="padding: 10px">
                                                <?php echo $course_data['price'] ?>
                                            </td>
                                            <td style="padding: 10px">
                                                <?php echo $offline_data['amount'] ?>
                                            </td>
                                            <td style="padding: 10px">
                                                <?php echo $course_data['price'] - $payable_amu ?>
                                            </td>
                                        </tr>
                                    <?php }
                                    if ($total_amu == $course_data['price']) {
                                        $repay_visible = 'yes';
                                    }
                                    ?>
                                </table>

                                <script>

                                    $(document).ready(function () {
                                        //$('#install<?php //echo $transaction1['id']?>//').hide()

                                        let repay = "<?php echo $repay_visible?>"
                                        if (repay === 'yes') {
                                            $('#repay_id').hide()
                                        }

                                    });

                                    function view_history() {
                                        $('#install<?php echo $transaction1['id']?>').toggle('medium')
                                    }
                                </script>


                            <?php endforeach; ?>


                            </tbody>
                        </table>
                    <?php endif; ?>
                    <?php if (count($transaction_history->result_array()) == 0): ?>
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

<div class="row" <?php echo ($visible == "pending") ? '' : 'hidden' ?> id="pending_transaction">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title"><?php echo get_phrase('transaction_history'); ?></h4>
                <div class="row justify-content-md-center">
                    <div class="col-xl-6">
                        <form class="form-inline"
                              action="<?php echo site_url('admin/transaction_history/filter_by_date_range') ?>"
                              method="get">
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
                </div>
                <div class="table-responsive-sm mt-4">
                    <?php if (count($transaction_history->result_array()) > 0): ?>
                        <table id="<?php echo ($visible == "pending") ? 'pending_transaction_datatable' : '' ?>" style="margin-bottom: 500px"
                               class="table table-striped table-centered mb-0">
                            <thead>
                            <tr>
                                <th><?php echo get_phrase('Payment Id'); ?></th>
                                <th><?php echo get_phrase('Razorpay Order Id'); ?></th>
                                <!--                                <th>-->
                                <?php //echo get_phrase('Course name'); ?><!--</th>-->
                                <th><?php echo get_phrase('Amount'); ?></th>
                                <th><?php echo get_phrase('Email'); ?></th>
                                <!--                                <th>-->
                                <?php //echo get_phrase('Created At'); ?><!--</th>-->
                                <th><?php echo get_phrase('Status'); ?></th>
                                <th ><?php echo get_phrase('next_due_date'); ?></th>
                                <!--                                <th>-->
                                <?php //echo get_phrase('new'); ?><!--</th>-->
                                <th><?php echo get_phrase('actions'); ?></th>
                            </tr>
                            </thead>
                            <tbody style="margin-top: 100px">
                            <?php foreach ($transaction_history->result_array() as $transaction1):
                                $user_data = $this->db->get_where('users', array('id' => $transaction1['user_id']))->row_array();
                                ?>
                                <tr class="gradeU">
                                    <td>
                                        <b><?php echo $transaction1['payment_id']; ?></b><br>
                                    </td>
                                    <td>
                                        <b><?php echo $transaction1['payment_order_id']; ?></b><br>
                                    </td>
                                    <td>
                                        <b><?php echo "₹ " . $transaction1['amount']; ?></b><br>
                                    </td>
                                    <td>
                                        <b><?php echo $transaction1['email']; ?></b><br>
                                    </td>
                                    <td>
                                        <b><?php echo $transaction1['status']; ?></b><br>
                                    </td>
                                    <td>
                                        <b><?php echo date_diff_days($transaction1['next_due_date']); ?></b><br>
                                    </td>
                                    <td>

                                        <?php
                                        if ($transaction1['payment_order_id'] == ""):
                                            ?>
                                            <div class="dropright dropright">
                                                <button type="button"
                                                        class="btn btn-sm btn-outline-primary btn-rounded btn-icon"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu" style="z-index:9999999999999 !important;">
                                                    <li>
                                                        <a href="<?php echo base_url('admin/transaction_history/' . $transaction1['payment_id']) ?>"
                                                           class="dropdown-item" style="cursor: pointer"
                                                           id="view_<?php echo $transaction1['id'] ?>"><?php echo get_phrase('view_installment'); ?></a>
                                                    </li>
                                                    <!--                                                    <li id="repay_id">-->
                                                    <!--                                                        <a class="dropdown-item"-->
                                                    <!--                                                           href="-->
                                                    <?php //echo base_url('admin/installment_repay/' . $transaction1['payment_id'])
                                                    ?><!--"-->
                                                    <!--                                                           target="_self">-->
                                                    <?php //echo get_phrase('repay_installment');
                                                    ?><!--</a>-->
                                                    <!--                                                    </li>-->
                                                    <li><a class="dropdown-item" style="cursor: pointer"
                                                           onclick="confirm_modal('<?php echo site_url('admin/transaction_history/history_delete/' . $transaction1['id']); ?>');"><?php echo get_phrase('Delete'); ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        <?php else: ?>
                                            <button type="button"
                                                    class="btn btn-outline-danger btn-icon btn-rounded btn-sm"><i
                                                        class="dripicons-trash"></i></button>
                                        <?php endif; ?>
                                    </td>
                                </tr>


                            <?php endforeach; ?>


                            </tbody>
                        </table>
                    <?php endif; ?>
                    <?php if (count($transaction_history->result_array()) == 0): ?>
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

<script type="text/javascript">
    function update_date_range() {
        var x = $("#selectedValue").html();
        $("#date_range").val(x);
    }

    $(document).ready(function () {

        $('#transaction_datatable').DataTable({
            scrollX: true,
            "order": [[5, "desc" ]],
            "bSort": false,
        });
        $('#pending_transaction_datatable').DataTable({
            scrollX: true,
        });
        $('#transaction_datatable_one').DataTable({
            paging: false,
            scrollX:false
        });

    });
</script>