<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"><i
                            class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo $page_title; ?> </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title mb-3"><?php echo get_phrase('student_add_form'); ?></h4>

                <form class="required-form" action="<?php echo site_url('admin/users/add'); ?>"
                      enctype="multipart/form-data" method="post">
                    <div id="progressbarwizard">
                        <ul class="nav nav-pills nav-justified form-wizard-header mb-3">
                            <li class="nav-item">
                                <a href="#basic_info" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-face-profile mr-1"></i>
                                    <span class="d-none d-sm-inline"><?php echo get_phrase('basic_info'); ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#login_credentials" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-lock mr-1"></i>
                                    <span class="d-none d-sm-inline"><?php echo get_phrase('login_credentials'); ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#social_information" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-wifi mr-1"></i>
                                    <span class="d-none d-sm-inline"><?php echo get_phrase('social_information'); ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#payment_info" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-currency-eur mr-1"></i>
                                    <span class="d-none d-sm-inline"><?php echo get_phrase('payment_info'); ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#finish" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                    <i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>
                                    <span class="d-none d-sm-inline"><?php echo get_phrase('finish'); ?></span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content b-0 mb-0">

                            <div id="bar" class="progress mb-3" style="height: 7px;">
                                <div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success"></div>
                            </div>

                            <div class="tab-pane" id="basic_info">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label"
                                                   for="first_name"><?php echo get_phrase('first_name'); ?><span
                                                        class="required">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="first_name"
                                                       name="first_name" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label"
                                                   for="last_name"><?php echo get_phrase('last_name'); ?><span
                                                        class="required">*</span></label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="last_name" name="last_name"
                                                       required>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label"
                                                   for="last_name"><?php echo get_phrase('select_country'); ?><span
                                                        class="required">*</span></label>
                                            <div class="col-md-9">
                                                <!--                                                <select class="form-control" id="county_selected" multiple>-->
                                                <select data-placeholder="Choose a country..." id="country"
                                                        class="form-control" name="country">

                                                    <?php foreach ($country as $country_list): ?>
                                                        <option value="<?php echo $country_list['id'] ?>" <?php echo ($country_list['id'] == '101')?'selected':''?>><?php echo $country_list['name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label"
                                                   for="last_name"><?php echo get_phrase('select_state'); ?><span
                                                        class="required">*</span></label>
                                            <div class="col-md-9">
                                                <select class="form-control" id="state_drop_down" name="state">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label"
                                                   for="last_name"><?php echo get_phrase('select_city'); ?><span
                                                        class="required">*</span></label>
                                            <div class="col-md-9">
                                                <select class="form-control" id="city_drop_down" name="city">
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label"
                                                   for="linkedin_link"><?php echo get_phrase('biography'); ?></label>
                                            <div class="col-md-9">
                                                <textarea name="biography" id="summernote-basic"
                                                          class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label"
                                                   for="user_image"><?php echo get_phrase('user_image'); ?></label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="user_image"
                                                               name="user_image" accept="image/*"
                                                               onchange="changeTitleOfImageUploader(this)">
                                                        <label class="custom-file-label"
                                                               for="user_image"><?php echo get_phrase('choose_user_image'); ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            </div>

                            <div class="tab-pane" id="login_credentials">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label"
                                                   for="email"><?php echo get_phrase('email'); ?><span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <input type="email" id="email" name="email" class="form-control"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label"
                                                   for="password"><?php echo get_phrase('password'); ?><span
                                                        class="required">*</span></label>
                                            <div class="col-md-9">
                                                <input type="password" id="password" name="password"
                                                       class="form-control" required>
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            </div>

                            <div class="tab-pane" id="social_information">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label"
                                                   for="facebook_link"> <?php echo get_phrase('facebook'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" id="facebook_link" name="facebook_link"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label"
                                                   for="twitter_link"><?php echo get_phrase('twitter'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" id="twitter_link" name="twitter_link"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label"
                                                   for="linkedin_link"><?php echo get_phrase('linkedin'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" id="linkedin_link" name="linkedin_link"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            </div>
                            <div class="tab-pane" id="payment_info">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label"
                                                   for="facebook_link"> <?php echo get_phrase('paypal_client_id'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" id="paypal_client_id" name="paypal_client_id"
                                                       class="form-control">
                                                <small><?php echo get_phrase("required_for_instructor"); ?></small>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label"
                                                   for="paypal_secret_key"> <?php echo get_phrase('paypal_secret_key'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" id="paypal_secret_key" name="paypal_secret_key"
                                                       class="form-control">
                                                <small><?php echo get_phrase("required_for_instructor"); ?></small>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label"
                                                   for="stripe_public_key"><?php echo get_phrase('stripe_public_key'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" id="stripe_public_key" name="stripe_public_key"
                                                       class="form-control">
                                                <small><?php echo get_phrase("required_for_instructor"); ?></small>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-md-3 col-form-label"
                                                   for="stripe_secret_key"><?php echo get_phrase('stripe_secret_key'); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" id="stripe_secret_key" name="stripe_secret_key"
                                                       class="form-control">
                                                <small><?php echo get_phrase("required_for_instructor"); ?></small>
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            </div>
                            <div class="tab-pane" id="finish">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="text-center">
                                            <h2 class="mt-0"><i class="mdi mdi-check-all"></i></h2>
                                            <h3 class="mt-0"><?php echo get_phrase('thank_you'); ?> !</h3>

                                            <p class="w-75 mb-2 mx-auto"><?php echo get_phrase('you_are_just_one_click_away'); ?></p>

                                            <div class="mb-3">
                                                <button type="button" class="btn btn-primary"
                                                        onclick="checkRequiredFields()"
                                                        name="button"><?php echo get_phrase('submit'); ?></button>
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            </div>

                            <ul class="list-inline mb-0 wizard text-center">
                                <li class="previous list-inline-item">
                                    <a href="javascript::" class="btn btn-info"> <i class="mdi mdi-arrow-left-bold"></i>
                                    </a>
                                </li>
                                <li class="next list-inline-item">
                                    <a href="javascript::" class="btn btn-info"> <i
                                                class="mdi mdi-arrow-right-bold"></i> </a>
                                </li>
                            </ul>

                        </div> <!-- tab-content -->
                    </div> <!-- end #progressbarwizard-->
                </form>

            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div>
</div>


<script>
    // $(function(){
    //     $('.chosen-select').chosen();
    //     $(".chosen-select").chosen({max_selected_options: 5});
    //
    // });

</script>

<script type="text/javascript">

    $("select").select2();

    // $('#country').change(function () {
        // let country_id = $('#country').val();

    $(document).ready(function (){

        let country_id = 101;
        $('#state_drop_down').empty();
        $.ajax({
            url: '<?php echo base_url("admin/state/")?>' + '/' + country_id,
            dataType: 'json',
            success: function (state) {
                $('#state_drop_down').append(`<option value="">Choose State...</option>`)
                for (let key in state) {
                    if (state !== "") {
                        let state_dropdown = `<option value="${state[key]['id']}">${state[key]['name']}</option>`;
                        $('#state_drop_down').append(state_dropdown)
                    }
                }
            }
        });
    })

    // });

    $('#state_drop_down').change(function (){
        let state_id = $('#state_drop_down').val();
        $('#city_drop_down').empty();
        $.ajax({
            url: '<?php echo base_url("admin/cities/")?>' + '/' + state_id,
            dataType: 'json',
            success: function (city) {
                $('#city_drop_down').append(`<option value="">Choose City...</option>`)
                for (let key in city) {
                    if (city !== "") {
                        let city_dropdown = `<option value="${city[key]['id']}">${city[key]['name']}</option>`;
                        $('#city_drop_down').append(city_dropdown)
                    }
                }
            }
        });
    })
</script>