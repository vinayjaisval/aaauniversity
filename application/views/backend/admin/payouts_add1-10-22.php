<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('add_new_payouts'); ?>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3"><?php echo get_phrase('add_payouts'); ?></h4>
                <form class="required-form" action="<?php echo site_url('admin/payouts_form/add'); ?>" enctype="multipart/form-data" method="post">
                    <div class="row">
                        <div class="col-12">

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label" for="instructor_name"><?php echo get_phrase('instructor_name'); ?><span class="required">*</span></label>
                                <div class="col-md-9">
                                    <select class="form-control select2" data-toggle="select2" name="instructor_name" id="instructor_name[]" multiple="multiple">
                                        <?php
                                        foreach ($students as $instructors_list) :
                                            if ($instructors_list['is_instructor'] == "1") { ?>
                                                <option value="<?php echo $instructors_list['id']; ?>">
                                                    <?php echo  $instructors_list['first_name'] . " " . $instructors_list['last_name'] ?>
                                                </option>
                                        <?php }
                                        endforeach; ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="row">
                                    <div class="form-group row  col-md-6">
                                        <label class="col-md-6 col-form-label" for="time"><?php echo get_phrase('start_date'); ?><span class="required">*</span></label>
                                        <div class="col-md-6">
                                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3 col-md-6">
                                        <label class="col-md-3 col-form-label" for="time"><?php echo get_phrase('end_date'); ?><span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label" for="commission_type"><?php echo get_phrase('duration'); ?><span class="required">*</span></label>
                                <div class="col-md-9">
                                    <select class="form-control select2" id="Ultra" onchange="run()" data-toggle="select2" name="commission_type" id="commission_type">
                                        <?php
                                        foreach ($commission as $commission_list) :
                                        ?>
                                            <option value="<?php echo $commission_list['id']; ?>">
                                                <?php echo  $commission_list['commission_type']  ?>
                                            </option>

                                        <?php endforeach; ?>

                                    </select>
                                    <input type="hide" class="form-control" name="" id="srt" readonly><br>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label" for="total_hours"><?php echo get_phrase('total_hours'); ?><span class="required">*</span></label>
                                <div class="col-md-9">
                                    <input id="qty" type="number" name="qty" class="form-control" name="" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label" for="total_amount"><?php echo get_phrase('total_amount'); ?><span class="required">*</span></label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control TotalAmount" name="total_amount" value="" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label" for="payments_type"><?php echo get_phrase('payments_type'); ?><span class="required">*</span></label>
                                <div class="col-md-9">
                                    <select class="form-control select2" data-toggle="select2" name="payments_type" id="payments_type[]" multiple="multiple">
                                        <option value="paytm">paytm</option>
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
                                        <button type="button" class="btn btn-primary" onclick="checkRequiredFields()" name="button"><?php echo get_phrase('submit'); ?></button>
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
    function run() {

        document.getElementById("srt").value = document.getElementById("Ultra").value;
    }

    $("#qty").on("keyup", function() {
        var qty = $("#qty").val();
        var balance = parseInt($("#srt").val());

        var result = (qty * balance);
        $('.TotalAmount').val(result);

        // $("#test").text("Balance -" + qty * balance); //you can change the id to place result whereever you want
    });
</script>