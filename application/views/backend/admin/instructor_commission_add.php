<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('add_new_commission'); ?>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3"><?php echo get_phrase('add_commission_type'); ?></h4>
                <form class="required-form" action="<?php echo site_url('admin/instructor_commission_form/add'); ?>" enctype="multipart/form-data" method="post">
                    <div class="row">
                        <div class="col-12">




                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label" for="commission_type"><?php echo get_phrase('commission_type'); ?><span class="required">*</span></label>
                                <div class="col-md-9">
                                    <select class="form-control select2" data-toggle="select2" name="commission_type" id="commission_type">

                                        <option value="hourly">Hourly</option>

                                        <option value="daily">Daily</option>
                                        <option value="weekly">Weekly</option>
                                        <option value="monthly">Monthly</option>
                                    </select>
                                </div>
                            </div>



                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label" for="time"><?php echo get_phrase('amount'); ?><span class="required">*</span></label>
                                <div class="col-md-9">
                                    <input type="no" class="form-control" id="amount" name="amount" required>
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