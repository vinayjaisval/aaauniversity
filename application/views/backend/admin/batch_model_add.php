<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"><i
                            class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('add_new_batch'); ?>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<!---->
<!--<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>-->
<!--<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />-->
<!--<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>-->


<!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>-->
<!--<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>-->


<!--<script src="--><?php //echo site_url('assets/backend/js/select.js');?><!--"></script>-->


<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3"><?php echo get_phrase('add_batch_model'); ?></h4>
                <form class="required-form" action="<?php echo site_url('admin/batch_model_form/add'); ?>"
                      enctype="multipart/form-data" method="post">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label"
                                       for="batch_limit"><?php echo get_phrase('batch_limit'); ?><span class="required">*</span></label>
                                <div class="col-md-9">
                                    <select class="form-control select2" name="batch_limit" id="batch_limit">
                                        <option>
                                            Select Batch Limit...
                                        </option>
                                        <?php
                                        foreach ($batch_limit as $limit) : ?>
                                            <option value="<?php echo $limit['limit']; ?>">
                                                <?php echo $limit['limit'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label"
                                       for="country"><?php echo get_phrase('Country'); ?><span class="required">*</span></label>
                                <div class="col-md-9">
                                    <select data-placeholder="Choose a country..." id="country"
                                            class="form-control" name="country">
                                        <option>
                                            Choose Country....
                                        </option>
                                        <?php foreach ($country as $country_list): ?>
                                            <option value="<?php echo $country_list['id'] ?>" <?php echo ($country_list['id'] == '101') ? 'selected' : '' ?>><?php echo $country_list['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label"
                                       for="course_name">
                                    <?php echo get_phrase('State'); ?><span class="required">*</span></label>
                                <div class="col-md-9" id="state_f">
                                    <select class="form-control select2" name="state" id="state">
                                        <option>
                                            Choose State....
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label"
                                       for="course_name">
                                    <?php echo get_phrase('City'); ?><span class="required">*</span></label>
                                <div class="col-md-9" id="state_f">
                                    <select class="form-control select2" name="city" id="city">
                                        <option>
                                            Choose City....
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label"
                                       for="course_name"><?php echo get_phrase('course_name'); ?><span class="required">*</span></label>
                                <div class="col-md-9">
                                    <select class="form-control select2" name="course_name" id="course_name">
                                        <option>
                                            Choose Courses....
                                        </option>
                                        <?php
                                        foreach ($courses as $courses_list) : ?>
                                            <option value="<?php echo $courses_list['id']; ?>">
                                                <?php echo $courses_list['title'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row mb-3" id="student_field">
                                <label class="col-md-3 col-form-label"
                                       for="students"><?php echo get_phrase('students'); ?><span
                                            class="required">*</span></label>
                                <div class="col-md-9" id="student_select">
                                    <p id="select_limit_fun">Please Select Batch Limit on the first</p>
                                    <select id="students" class="mul-select form-control" name="students[]" multiple>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label"
                                       for="instructor_name"><?php echo get_phrase('instructor_name'); ?><span
                                            class="required">*</span></label>
                                <div class="col-md-9">


                                    <select class="form-control select2 " data-toggle="select2" name="instructor_name[]"
                                            id="instructor_name" multiple="multiple">
                                        <!--                                        --><?php
                                        //                                        foreach ($students as $instructors_list) :
                                        //                                            if ($instructors_list['is_instructor'] == "1") { ?>
                                        <!--                                                <option value="-->
                                        <?php //echo $instructors_list['id']; ?><!--">-->
                                        <!--                                                    --><?php //echo $instructors_list['first_name'] . " " . $instructors_list['last_name'] ?>
                                        <!--                                                </option>-->
                                        <!--                                            --><?php //}
                                        //                                        endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label"
                                       for="duration"><?php echo get_phrase('duration'); ?><span
                                            class="required">*</span></label>
                                <div class="col-md-9">
                                    <select class="form-control select2" data-toggle="select2" name="duration"
                                            id="duration">
                                        <option value="daily">Daily</option>
                                        <option value="weekly">Weekly</option>
                                        <option value="monthly">Monthly</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label" for="date"><?php echo get_phrase('date'); ?><span
                                            class="required">*</span></label>
                                <div class="col-md-9">
                                    <input type="date" class="form-control" id="date" name="date" required>
                                </div>

                                <script language="javascript">
                                    var today = new Date();
                                    var dd = String(today.getDate()).padStart(2, '0');
                                    var mm = String(today.getMonth() + 1).padStart(2, '0');
                                    var yyyy = today.getFullYear();

                                    today = yyyy + '-' + mm + '-' + dd;
                                    $('#date').attr('min', today);
                                </script>

                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label" for="time"><?php echo get_phrase('time'); ?><span
                                            class="required">*</span></label>
                                <div class="col-md-9">
                                    <input type="time" class="form-control" id="time" name="time" required>
                                </div>
                            </div>


                        </div> <!-- end col -->
                    </div>
                    <div class="tab-pane" id="finish">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-primary" onclick="checkRequiredFields()"
                                                name="button"><?php echo get_phrase('submit'); ?></button>
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

<script type="text/javascript">

    $("#country").select2({
        tags: true,

    });
    $("#state").select2({
        tags: true,
    });
    $("#city").select2({
        tags: true,
    });

    $(document).ready(function () {
        // $('#country').change(function () {
        // let country_id = $('#country').val();
        let country_id = 101;
        $('#state').empty();
        $.ajax({
            url: '<?php echo base_url("admin/state/")?>' + '/' + country_id,
            dataType: 'json',
            success: function (state) {
                $('#state').append(`<option value="">Choose State...</option>`)
                for (let key in state) {
                    if (state !== "") {
                        let state_dropdown = `<option value="${state[key]['id']}">${state[key]['name']}</option>`;
                        $('#state').append(state_dropdown)
                    }
                }
            }
        });
        // });
    })


    $('#state').change(function () {
        let state_id = $('#state').val();
        $('#city').empty();
        $.ajax({
            url: '<?php echo base_url("admin/cities/")?>' + '/' + state_id,
            dataType: 'json',
            success: function (city) {
                $('#city').append(`<option value="">Choose City...</option>`)
                for (let key in city) {
                    if (city !== "") {
                        let city_dropdown = `<option value="${city[key]['id']}">${city[key]['name']}</option>`;
                        $('#city').append(city_dropdown)
                    }
                }
            }
        });
    })


</script>

<script>
    let s_y_limit = 0;

    $(document).ready(function () {
        $('#student_field').hide()
    });
    if (s_y_limit == 0) {
        $('#select_limit_fun').show()
    } else {
        $('#select_limit_fun').hide()

    }

    var value1 = 0;
    let country = '';
    let state = '';
    let city = '';
    $('#batch_limit').change(function () {
        value1 = $('#batch_limit').val();
        limit(value1)
    })

    $("#student_select").click(function () {
        value1 = $('#batch_limit').val();
    });

    $('#course_name').change(function () {

        country = $("#country").val();
        state = $("#state").val();
        city = $("#city").val()

        let course_id = $(this).val();
        $('#students').empty();
        student(course_id);


    });

    function student(course_id) {
        let main_u = `<?php echo base_url("admin/batch_model_form/course_wise_users/");?>${course_id}/?country=101&state=${state}&city=${city}`
        $.ajax({
            url: main_u,
            dataType: 'json',
            success: function (data) {

                console.log(data)
                for (var key in data) {
                    if (data === "") {
                        $('#student_field').hide()
                    } else {
                        if (s_y_limit == 0) {
                            $('#select_limit_fun').show()
                        } else {
                            $('#select_limit_fun').hide()

                        }
                        $('#student_field').show()
                        if (data[key]['is_instructor'] == 0) {
                            let student_dropdown1 = `<option value="${data[key]['id']}">${data[key]['first_name'] + ' ' + data[key]['last_name']}</option>`;
                            $('#students').append(student_dropdown1)
                            // }else {
                            //     let instructor_name = `<option value="${data[key]['id']}">${data[key]['first_name']+' '+data[key]['last_name']}</option>`;
                            //     $('#instructor_name').append(instructor_name)
                        }
                    }
                }
            }
        });
    }

    // new SlimSelect({
    //     select: '#students',
    // })

    function limit(limit) {

        s_y_limit = 1
        $('#select_limit_fun').hide()


        $('.mul-select').select2({
            multiple: "multiple",
            maximumSelectionLength: limit,
            language: {
                maximumSelected: (args) => args.maximum + ' Your Student of Limit Full',
            }
        });
        // $('#student_select .mul-select').prop("disabled", true);

        // select2:close -> {"originalEvent":"[$.Event]","originalSelect2Event":{"originalEvent":"[$.Event]","data":{"selected":false,"disabled":false,"text":"Hawaii","id":"HI","title":"","_resultId":"select2-25xz-result-p9v2-HI","element":"[DOM node]"},"_type":"unselect"},"_type":"close"}


    }

    $('#course_name').on('change', function () {
        country = $("#country").val();
        state = $("#state").val();
        city = $("#city").val()

        let main_u = `<?php echo base_url("admin/batch_model_form/location_wise_instructor/");?>?country=${country}&state=${state}&city=${city}`
        $.ajax({
            url: main_u,
            dataType: 'json',
            success: function (data) {

                console.log(data)
                for (var key in data) {
                    if (data === "") {
                        // $('#student_field').hide()
                    } else {
                        // $('#student_field').show()
                        // if (data[key]['is_instructor'] == 0){

                        // let student_dropdown1 = `<option value="${data[key]['id']}">${data[key]['first_name']+' '+data[key]['last_name']}</option>`;
                        // $('#students').append(student_dropdown1)

                        // }else {
                        let instructor_name = `<option value="${data[key]['id']}">${data[key]['first_name'] + ' ' + data[key]['last_name']}</option>`;
                        $('#instructor_name').append(instructor_name)
                        // }

                    }
                }
            }
        });
    })

    // $('.mul-select').select2({})


</script>
