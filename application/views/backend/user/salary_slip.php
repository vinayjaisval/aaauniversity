<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"><i
                            class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('salary_slip') ?>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title"><?php echo get_phrase('salary_slip_list'); ?></h4>

                <div class="tab-content">
                    <div class="tab-pane show active" id="completed-b1">


                        <div class="row justify-content-md ">
                            <div class="col-xl-12 align-content-xl-center">
                                <form class="form-inline center"
                                      action="<?php echo site_url('user/salary_form/filter_month') ?>" method="get">
                                    <div class="col-xl-3">

                                    </div>

                                    <!--                                    <div class="col-xl-5">-->
                                    <!--                                        <div class="form-group">-->
                                    <!--                                            <div id="reportrange" class="form-control" data-toggle="date-picker-range"-->
                                    <!--                                                 data-target-display="#selectedValue" data-cancel-class="btn-light"-->
                                    <!--                                                 style="width: 100%;">-->
                                    <!--                                                <i class="mdi mdi-calendar"></i>&nbsp;-->
                                    <!--                                                <span id="selectedValue">-->
                                    <?php //echo date("F d, Y", $timestamp_start) . " - " . date("F d, Y", $timestamp_end); ?><!--</span>-->
                                    <!--                                                <i class="mdi mdi-menu-down"></i>-->
                                    <!--                                            </div>-->
                                    <!--                                            <input id="date_range" type="hidden" name="date_range"-->
                                    <!--                                                   value="-->
                                    <?php //echo date("d F, Y", $timestamp_start) . " - " . date("d F, Y", $timestamp_end); ?><!--">-->
                                    <!--                                        </div>-->
                                    <!--                                    </div>-->

                                    <div class="col-xl-5">
                                        <select class="form-control" name="month">
                                            <option value="" <?php if ($month == "") echo "selected"; ?> selected>
                                                Chose Month.....
                                            </option>

                                            <option value="january" <?php if ($month == "January") echo "selected"; ?>>
                                                January
                                            </option>

                                            <option value="February" <?php if ($month == "february") echo "selected"; ?>>
                                                February
                                            </option>

                                            <option value="march" <?php if ($month == "march") echo "selected"; ?>>
                                                March
                                            </option>

                                            <option value="april" <?php if ($month == "april") echo "selected"; ?>>
                                                April
                                            </option>

                                            <option value="may" <?php if ($month == "may") echo "selected"; ?>>
                                                May
                                            </option>

                                            <option value="June" <?php if ($month == "June") echo "selected"; ?>>
                                                June
                                            </option>

                                            <option value="july" <?php if ($month == "July") echo "selected"; ?>>
                                                July
                                            </option>

                                            <option value="august" <?php if ($month == "august") echo "selected"; ?>>
                                                August
                                            </option>

                                            <option value="september" <?php if ($month == "september") echo "selected"; ?>>
                                                September
                                            </option>

                                            <option value="october" <?php if ($month == "october") echo "selected"; ?>>
                                                October
                                            </option>

                                            <option value="november" <?php if ($month == "november") echo "selected"; ?>>
                                                November
                                            </option>

                                            <option value="december" <?php if ($month == "december") echo "selected"; ?>>
                                                December
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-xl-2">
                                        <button type="submit" class="btn btn-info" id="submit-button"
                                                onclick="update_date_range();"> <?php echo get_phrase('filter'); ?></button>
                                    </div>

                                    <div class="col-xl-2">

                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="table-responsive-sm mt-4">
                            <table id="basic-datatable" class="table table-striped table-centered mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo get_phrase('instructor_name'); ?></th>
                                    <th><?php echo get_phrase('start_date'); ?></th>
                                    <th><?php echo get_phrase('end_date'); ?></th>
                                    <th><?php echo get_phrase('total_amounts'); ?></th>
                                    <th><?php echo get_phrase('payment_type'); ?></th>
                                    <th><?php echo get_phrase('status'); ?></th>
                                    <th><?php echo get_phrase('action'); ?></th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $key = 0;
                                foreach ($salary_slip_data as $key => $salary_slip_list): ?>
                                    <tr>
                                        <td><?php echo $key + 1; ?></td>

                                        <td>
                                            <?php
                                            $name = $this->crud_model->get_user($salary_slip_list['user_id'])->result_array();
                                            echo $name[0]['first_name'] . " " . $name[0]['last_name'];
                                            ?>
                                        </td>

                                        <td>
                                            <?php echo $salary_slip_list['start_date'] ?>
                                        </td>

                                        <td>
                                            <?php echo $salary_slip_list['end_date'] ?>
                                        </td>

                                        <td>
                                            <?php echo $salary_slip_list['total_amount'] ?>
                                        </td>

                                        <td>
                                            <?php echo $salary_slip_list['payments_type'] ?>
                                        </td>

                                        <td>
                                            <?php
                                            if ($salary_slip_list['status'] == 1) {
                                                ?>
                                                <div class="badge badge-success"><?php echo get_phrase('success'); ?></div>
                                                <?php
                                            } else {
                                                ?>
                                                <div class="badge badge-danger"><?php echo get_phrase('pending'); ?></div>
                                                <?php
                                            }
                                            ?>
                                        </td>

                                        <td>

                                            <?php
                                            if ($salary_slip_list['status'] == 1) {
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
                                                            <?php
                                                            $id = urlencode(base64_encode($salary_slip_list['id']));
                                                            ?>
                                                            <a class="dropdown-item" target="_blank"
                                                               href="<?php echo site_url('user/salary_form/view_slip/' . $id) ?>">
                                                                <?php echo get_phrase('view_slip'); ?></a>
                                                        </li>
<!--                                                        <li>-->
<!--                                                            <a class="dropdown-item"-->
<!--                                                               href="--><?php //echo site_url('user/salary_form/download_slip/' . $salary_slip_list['id']) ?><!--">-->
<!--                                                                --><?php //echo get_phrase('download_slip'); ?><!--</a>-->
<!--                                                        </li>-->
                                                    </ul>
                                                </div>                                                <?php
                                            } else {
                                                ?>
                                                <div class="dropright dropright">
                                                    <button type="button"
                                                            class="btn btn-sm btn-outline-primary btn-rounded btn-icon"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                        <i class="mdi mdi-dots-vertical"></i>
                                                    </button>
                                                </div>
                                                <?php
                                            }
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
        </div> <!-- end card body-->
    </div> <!-- end card -->
</div><!-- end col-->
