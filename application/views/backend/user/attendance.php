<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">
                    <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('attendance'); ?>
                </h4>

                <a href="<?php echo site_url('user/attendance_form/attendance_add'); ?>"
                   class="btn btn-outline-primary btn-rounded alignToTitle">
                    <i class="mdi mdi-plus"></i>
                    <?php echo get_phrase('attendance_start'); ?>
                </a>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title"><?php echo get_phrase('attendance_list'); ?></h4>

                <div class="tab-content">
                    <div class="tab-pane show active" id="completed-b1">


                        <div class="row justify-content-md">
                            <div class="col-xl-12">
                                <form class="form-inline"
                                      action="<?php echo site_url('user/attendance_form/filter_date') ?>" method="get">
                                    <div class="col-xl-5">
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

                                    <div class="col-xl-1">
                                        <div class="form-group">
                                            <h4><span>Duration</span></h4>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <select class="form-control " style=" width: 100%" name="duration"
                                                    id="duration">
                                                <?php
                                                if ($duration != "") {
                                                    ?>
                                                    <option value="<?php echo $duration ?>"><?php echo get_phrase("$duration") ?></option>
                                                    <option value="all" <?php if ($duration == "all") {
                                                        echo "hidden";
                                                    } ?>>All
                                                    </option>
                                                    <option value="hourly" <?php if ($duration == "hourly") {
                                                        echo "hidden";
                                                    } ?>>Hourly
                                                    </option>
                                                    <option value="daily" <?php if ($duration == "daily") {
                                                        echo "hidden";
                                                    } ?>>Daily
                                                    </option>
                                                    <option value="weekly" <?php if ($duration == "weekly") {
                                                        echo "hidden";
                                                    } ?> >Weekly
                                                    </option>
                                                    <option value="monthly" <?php if ($duration == "monthly") {
                                                        echo 'hidden';
                                                    } ?>>Monthly
                                                    </option>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option value="all" <?php if ($duration == "all") {
                                                        echo "hidden";
                                                    } ?>>All
                                                    </option>
                                                    <option value="hourly" <?php if ($duration == "hourly") {
                                                        echo "hidden";
                                                    } ?>>Hourly
                                                    </option>
                                                    <option value="daily" <?php if ($duration == "daily") {
                                                        echo "hidden";
                                                    } ?>>Daily
                                                    </option>
                                                    <option value="weekly" <?php if ($duration == "weekly") {
                                                        echo "hidden";
                                                    } ?> >Weekly
                                                    </option>
                                                    <option value="monthly" <?php if ($duration == "monthly") {
                                                        echo 'hidden';
                                                    } ?>>Monthly
                                                    </option>
                                                    <?php
                                                }
                                                ?>

                                            </select>
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
                            <table id="basic-datatable" class="table table-striped table-centered mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo get_phrase('batch_name'); ?></th>
                                    <th><?php echo get_phrase('course_name'); ?></th>
                                    <th><?php echo get_phrase('date'); ?></th>
                                    <th><?php echo get_phrase('start_time'); ?></th>
                                    <th><?php echo get_phrase('end_time'); ?></th>
                                    <th><?php echo get_phrase('total_time'); ?></th>
                                    <th><?php echo get_phrase('status'); ?></th>
                                    <!--                            <th>-->
                                    <?php //echo get_phrase('actions'); ?><!--</th>-->
                                    <th><?php echo get_phrase('duration'); ?></th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($attendance_data as $key => $attendance_list): ?>
                                    <tr>
                                        <td><?php echo $key + 1; ?></td>
                                        <td><?php
                                            $result = $this->crud_model->get_course($attendance_list['batch_id']);
                                            echo $result[0]['title'];
                                            ?>
                                        </td>
                                        <td><?php
                                            $result = $this->crud_model->get_course($attendance_list['course_id']);
                                            echo $result[0]['title'];
                                            ?>
                                        </td>

                                        <td>
                                            <?php echo $attendance_list['date']; ?>
                                        </td>
                                        <td>
                                            <?php echo $attendance_list['start_time']; ?>
                                        </td>
                                        <td>
                                            <?php
                                            $end_time = $attendance_list['end_time'];
                                            if ($end_time != "") {
                                                echo $attendance_list['end_time'];
                                            } else {
                                                $id = $attendance_list['id'];

                                                ?>

                                                <h4>
                                                    <a href="<?php echo site_url("user/attendance_form/edit/$id/"); ?>"
                                                       class="badge badge-secondary text-nowrap"
                                                       style="background-color: #e393a7;border-color: #e393a7">
                                                        <b>Complete Attendance</b>
                                                    </a>
                                                </h4>

                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $start_time = $attendance_list['start_time'];
                                            if ($end_time != "") {
                                                $totalData = $this->lazyload->time_in_hours($start_time, $end_time);
                                                echo $totalData;
                                            } else {
                                                echo "Complete Attendance";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $status = $attendance_list['status'];
                                            if ($status != 1) {
                                                ?>
                                                <h4>
                                                    <b class="badge badge-secondary text-nowrap"
                                                       style="background-color: #e393a7;border-color: #e393a7;padding: 4px">
                                                        Pending
                                                    </b>
                                                </h4>
                                                <?php
                                            } else {
                                                ?>
                                                <h4>
                                                    <b class="badge badge-secondary text-nowrap"
                                                       style="background-color: #93e39b;padding: 4px">
                                                        Approved
                                                    </b>
                                                </h4>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $attendance_list['duration'] ?>
                                        </td>

                                        <!--                                <td>-->
                                        <!--                                    <div class="dropright dropright">-->
                                        <!--                                        <button type="button"-->
                                        <!--                                                class="btn btn-sm btn-outline-primary btn-rounded btn-icon"-->
                                        <!--                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                                        <!--                                            <i class="mdi mdi-dots-vertical"></i>-->
                                        <!--                                        </button>-->
                                        <!--                                        <ul class="dropdown-menu">-->
                                        <!--                                            <li><a class="dropdown-item"-->
                                        <!--                                                   href="-->
                                        <?php //echo site_url('user/batch_model_form/view_details/' . $attendance_list['id']) ?><!--">-->
                                        <?php //echo get_phrase('view_students'); ?><!--</a>-->
                                        <!--                                            </li>-->

                                        <!-- /**************** Edit And Delete Button ***************/ -->
                                        <!--                                            <li><a class="dropdown-item"-->
                                        <!--                                                   href="-->
                                        <?php //echo site_url('user/batch_model_form/batch_alert_edit/' . $attendance_list['id']) ?><!--">-->
                                        <?php //echo get_phrase('edit'); ?><!--</a>-->
                                        <!--                                            </li>-->
                                        <!--                                            <li><a class="dropdown-item" href="#"-->
                                        <!--                                                   onclick="confirm_modal('-->
                                        <?php //echo site_url('user/batch_model_form/batch_model_delete/' . $attendance_list['id']); ?><!--');"> -->
                                        <?php //echo get_phrase('delete'); ?><!--</a>-->
                                        <!--                                            </li>-->
                                        <!--                                        </ul>-->
                                        <!--                                    </div>-->
                                        <!--                                </td>-->
                                    </tr>
                                <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end card body-->
    </div> <!-- end card -->
</div><!-- end col-->


<script type="text/javascript">
    $(document).ready(function () {
        initDataTable(['#pending-payout', '#completed-payout']);
    });

    function update_date_range() {
        var x = $("#selectedValue").html();
        $("#date_range").val(x);
    }
</script>