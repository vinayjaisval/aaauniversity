<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">
                    <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('conform_payment'); ?>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3"><?php echo get_phrase('conform_payouts'); ?></h4>
                <form class="required-form" action="<?php echo site_url('admin/payouts_form/conform_edit_payouts/' . $id); ?>" enctype="multipart/form-data" method="post">
                    <div class="row">
                        <div class="col-12">

                            <!-- All are hidden input for help passing data-->

                            <input type="text" class="form-control" name="user_id" value="<?php echo $instructor_payouts_data[0]['user_id']; ?>" hidden>
                            <input type="text" class="form-control" name="start_date" value="<?php echo $instructor_payouts_data[0]['start_date']; ?>" hidden>
                            <input type="text" class="form-control" name="end_date" value="<?php echo $instructor_payouts_data[0]['end_date']; ?>" hidden>
                            <input type="text" class="form-control" name="duration" value="<?php echo $instructor_payouts_data[0]['duration']; ?>" hidden>
                            <input type="text" class="form-control" name="commission_by_hours" value="<?php echo $instructor_payouts_data[0]['commission_by_hours']; ?>" hidden>
                            <!-- End All are hidden input for help passing data-->

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label" for="instructor_name"><?php echo get_phrase('instructor_name'); ?><span class="required">*</span></label>
                                <div class="col-md-9">
                                    <select class="form-control select2" data-toggle="select2" name="instructor_name" id="instructor_name[]" multiple="multiple">-->
                                        <?php

                                        $students_lists = $instructor_payouts_data[0]['user_id'];

                                        foreach ($get_users as $instructors_list) :
                                        ?>
                                            <option value="<?php echo $instructors_list['id']; ?>" <?php if ($instructors_list['id'] == $students_lists)echo 'selected'; ?>>
                                                <?php echo $instructors_list['first_name'] . " " . $instructors_list['last_name'] . $instructor_payouts_data->user_id ?>
                                            </option>
                                        <?php
                                        endforeach; ?>
                                    </select>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group row  col-md-6">
                                        <label class="col-md-6 col-form-label" for="time"><?php echo get_phrase('start_date'); ?><span class="required">*</span></label>
                                        <div class="col-md-6">
                                            <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo $instructor_payouts_data[0]['start_date'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3 col-md-6">
                                        <label class="col-md-3 col-form-label" for="time"><?php echo get_phrase('end_date'); ?><span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo $instructor_payouts_data[0]['end_date'] ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <?php
                                $duration_array = explode(',', $instructor_payouts_data[0]['duration']);
                                $hours_array = explode(',', $instructor_payouts_data[0]['commission_by_hours']);
                                $amount = "";
                                $duration = $instructor_payouts_data[0]['duration'];
                                //                                print_r($instructor_payouts_data);

                                foreach ($commission as $key => $commission_list) :

                                    if ($duration_array["$key"] == 0) {
                                        if ($amount == "") {
                                            $amount = '0' . $amount;
                                        } else {
                                            $amount = $amount . ',' . '0';
                                        }
                                    } else {
                                        if ($amount == "") {
                                            $amount = $amount . $commission_list['amount'];
                                        } else {
                                            $amount = $amount . "," . $commission_list['amount'];
                                        }
                                    }

                                ?>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="form-group row  col-md-6">
                                                <label class="col-md-6 col-form-label" for="time"><?php echo get_phrase('duration_' . $commission_list['commission_type']); ?>
                                                </label>
                                                <div class="col-md-6 ">
                                                    <select class="form-control select2" id="Ultra" onchange="run()" data-toggle="select2" name="commission_type[]">

                                                        <option value="0" selected>Choose....</option>
                                                        <option value="<?php echo $commission_list['id']; ?>" <?php if ($commission_list['id'] == $duration_array["$key"]) echo "selected" ?>>
                                                            <?php echo $commission_list['commission_type'] ?>
                                                        </option>


                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3 col-md-6">
                                                <label class="col-md-3 col-form-label" for="time"><?php echo get_phrase('hours'); ?></label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="hours" name="hours[]" value="<?php echo $hours_array["$key"]; ?>">
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                <?php endforeach;
                                //                                print_r($amount) 
                                ?>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label" for="total_hours"><?php echo get_phrase('total_hours'); ?></label>
                                <div class="col-md-9">
                                    <input id="total_hours" type="text" name="total_hours" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label" for="total_amount"><?php echo get_phrase('total_amount'); ?><span class="required">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control TotalAmount" name="total_amount" id="total_amount" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label" for="payments_type"><?php echo get_phrase('payments_type'); ?><span class="required">*</span></label>
                                <div class="col-md-9">
                                    <select class="form-control select2" data-toggle="select2" name="payments_type" id="payments_type[]" multiple="multiple">
                                        <option value="paytm" <?php if ("paytm" == $instructor_payouts_data[0]['payments_type']) echo "selected" ?>>
                                            paytm
                                        </option>
                                    </select>
                                </div>
                            </div>


                        </div> <!-- end col -->
                    </div>
                    <div class="tab-pane" id="finish">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-primary" onclick="checkRequiredFields()" name="button"><?php echo get_phrase('conform_edit_payment'); ?></button>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                    </div>
                </form>
            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div>
</div>


<script>
    var total_amount = 0;

    /****** Duration by Amount Code *******/

    var amount_list = "<?php echo $amount ?>"

    var amounts = amount_list.split(',')
    // var add_amounts = 0
    // for (var i in amounts) {
    //     var get_amount = amounts[i]
    //     add_amounts += parseInt(get_amount)
    // }
    /****** End Duration by Amount Code *******/


    /****** Total Hours Code *******/

    var total_hours = "<?php echo $instructor_payouts_data[0]['commission_by_hours']; ?>"
    var hours = total_hours.split(',')
    var add_hours = 0
    for (var a in hours) {
        var get_hours = hours[a]
        var amu = amounts[a]

        total_amount += parseInt(get_hours) * parseInt(amu)

        // console.log(total_amount)
        add_hours += parseInt(get_hours)
    }

    /****** Set Amount And Hours in Input filed ******/
    document.getElementById("total_hours").value = add_hours;
    document.getElementById("total_amount").value = total_amount;
    /****** Set Amount And Hours in Input filed ******/

    /****** End Total Hours Code *******/
</script>