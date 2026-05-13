<?php
//print_array($enquiry_data->result_array());
?>

<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"><i
                            class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('Enquiry_details'); ?>
                    <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"
                       class="btn btn-outline-dark btn-rounded alignToTitle">
                        <i class="mdi mdi-backspace"></i>
                        <?php echo get_phrase('go_back'); ?>
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
                <h4 class="mb-3 header-title"><?php echo get_phrase('Enquiry_details'); ?></h4>
                <div class="table-responsive-sm mt-4">
                    <table id="basic-datatable" class="table table-striped table-centered mb-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo get_phrase('Name'); ?></th>
                            <th><?php echo get_phrase('Email'); ?></th>
                            <th><?php echo get_phrase('Number'); ?></th>
                            <th><?php echo get_phrase('Message'); ?></th>
                            <th style="  white-space: nowrap;overflow: hidden;text-overflow: ellipsis"><?php echo get_phrase('age'); ?></th>
                            <th style="  white-space: nowrap;overflow: hidden;text-overflow: ellipsis"><?php echo get_phrase('time'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($enquiry_data->result_array() as $key => $enquiry_data_list): ?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td><?php
                                    echo $enquiry_data_list['name']
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $enquiry_data_list['email']
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $enquiry_data_list['phone']

                                    ?>
                                </td>
                                <td>
                                    <?php echo $enquiry_data_list['massage']; ?>
                                </td>
                                <td style="  white-space: nowrap;overflow: hidden;text-overflow: ellipsis">
                                   <?php

                                    $ac_date = date('d-m-Y', strtotime($enquiry_data_list['created_at']));

                                    $date1 = date_create(date('Y-m-d'));
                                    $date2 = date_create($ac_date);
                                    $diff = date_diff($date2, $date1);
                                    $r_date = $diff->format("%R%a ");
                                    if ($r_date > 0){
                                        echo abs($r_date)." Days Ago";
                                    }else{
                                        echo "Today";
                                    }

                                    ?>
                                </td>
                                <td style="  white-space: nowrap;overflow: hidden;text-overflow: ellipsis">
                                    <?php
                                    echo date('h : i A', strtotime($enquiry_data_list['created_at']));
                                    ?>
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
