
<style>
.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

#basic-datatable {
    width: 100% !important;
}

#basic-datatable th,
#basic-datatable td {
    vertical-align: middle;
}

#basic-datatable td {
    word-break: break-word;
}

#basic-datatable td:nth-child(5) {
    min-width: 250px;
    white-space: normal !important;
}

@media (max-width: 768px) {
    #basic-datatable {
        min-width: 900px;
    }

    #basic-datatable th,
    #basic-datatable td {
        font-size: 13px;
        padding: 8px;
    }
}
</style>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">
                    <i class="mdi mdi-apple-keyboard-command title_icon"></i>
                    <?php echo get_phrase('Enquiry_details'); ?>

                    <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"
                       class="btn btn-outline-dark btn-rounded alignToTitle">
                        <i class="mdi mdi-backspace"></i>
                        <?php echo get_phrase('go_back'); ?>
                    </a>
                </h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                <h4 class="mb-3 header-title">
                    <?php echo get_phrase('Enquiry_details'); ?>
                </h4>

                <div class="table-responsive mt-4">

                    <table id="basic-datatable" class="table table-striped table-centered mb-0 w-100">

                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo get_phrase('Name'); ?></th>
                            <th><?php echo get_phrase('Email'); ?></th>
                            <th><?php echo get_phrase('Number'); ?></th>
                            <th><?php echo get_phrase('Message'); ?></th>
                            <th><?php echo get_phrase('age'); ?></th>
                            <th><?php echo get_phrase('time'); ?></th>
                        </tr>
                        </thead>

                        <tbody>

                        <?php foreach ($enquiry_data->result_array() as $key => $enquiry_data_list): ?>

                            <tr>

                                <td><?php echo $key + 1; ?></td>

                                <td>
                                    <?php echo $enquiry_data_list['name']; ?>
                                </td>

                                <td>
                                    <?php echo $enquiry_data_list['email']; ?>
                                </td>

                                <td>
                                    <?php echo $enquiry_data_list['phone']; ?>
                                </td>

                                <td>
                                    <?php echo $enquiry_data_list['massage']; ?>
                                </td>

                                <td style="white-space: nowrap;">

                                    <?php

                                    $ac_date = date('d-m-Y', strtotime($enquiry_data_list['created_at']));

                                    $date1 = date_create(date('Y-m-d'));
                                    $date2 = date_create($ac_date);

                                    $diff = date_diff($date2, $date1);

                                    $r_date = $diff->format("%R%a");

                                    if ($r_date > 0) {
                                        echo abs($r_date) . " Days Ago";
                                    } else {
                                        echo "Today";
                                    }

                                    ?>

                                </td>

                                <td style="white-space: nowrap;">

                                    <?php
                                    echo date('h : i A', strtotime($enquiry_data_list['created_at']));
                                    ?>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {

    if ($.fn.DataTable.isDataTable('#basic-datatable')) {
        $('#basic-datatable').DataTable().destroy();
    }

    $('#basic-datatable').DataTable({
        responsive: true,
        autoWidth: false,
        scrollX: true
    });

});
</script>