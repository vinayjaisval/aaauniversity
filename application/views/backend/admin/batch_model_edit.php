<?php
$cities = $this->db->get_where('cities', array('country_id' => '101'))->result_array();

?>

<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"><i
                            class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('edit_batch'); ?>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3"><?php echo get_phrase('edit_batch'); ?></h4>
                <form class="required-form" action="<?php echo site_url('admin/batch_model_form/edit/' . $id); ?>"
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
                                            <option value="<?php echo $limit['limit']; ?>" <?php echo ($batch_model_data[0]['batch_limit'] == $limit['limit']) ? 'selected' : '' ?>>
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

                                        <?php
                                        foreach ($cities as $city_list): ?>
                                            <option value="<?php echo $city_list['id'] ?>" <?php echo ($city_list['id'] == $batch_model_data[0]['city_id']) ? 'selected' : '' ?> ><?php echo $city_list['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label"
                                       for="course_name"><?php echo get_phrase('course_name'); ?><span class="required">*</span></label>
                                <div class="col-md-9">
                                    <input type="hidden" value="<?php echo $batch_model_data[0]['course_id'] ?>"
                                           name="course_name">
                                    <select class="form-control select2" name="course_name" id="course_name" disabled>
                                        <?php
                                        $courses_lists = explode(",", $batch_model_data[0]['course_id']);

                                        foreach ($courses as $courses_list) : ?>
                                            <?php
                                            foreach ($courses_lists as $key => $like) {
                                                if (sizeof($courses_lists) > 1) {
                                                    if ($courses_list['id'] == $like) { ?>
                                                        <option value="<?php echo $courses_list['id'] ?>" selected>
                                                            <?php
                                                            echo $courses_list['title'];
                                                            ?>
                                                        </option>
                                                        <?php
                                                    }
                                                } elseif ($courses_list['id'] == $batch_model_data[0]['course_id']) {
                                                    ?>
                                                    <option value="<?php echo $courses_list['id'] ?>" selected>
                                                        <?php
                                                        echo $courses_list['title'];
                                                        ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <option value="<?php echo $courses_list['id']; ?>">
                                                <?php echo $courses_list['title'] ?>
                                            </option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label" for="students"><?php echo get_phrase('students');
                                    ?>
                                    <span class="required">*</span></label>
                                <div class="col-md-9" id="student_select">

                                    <select class="form-control select2" name="students[]"
                                            id="students" multiple="multiple">
                                        <?php
                                        $students_lists = explode(",", $batch_model_data[0]['students_id']);
                                        foreach ($register_student->result_array() as $key => $student_data):
                                            ?>
                                            <option value="<?php echo $student_data['user_id'] ?>" <?php echo(in_array($student_data['user_id'], $students_lists) ? 'selected' : '') ?>>
                                                <?php
                                                $result = $this->crud_model->get_user_by_id($student_data['user_id']);
                                                echo $result[0]['first_name'] . " " . $result[0]['last_name'];
                                                ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label"
                                       for="instructor_name"><?php echo get_phrase('instructor_name'); ?><span
                                            class="required">*</span></label>
                                <div class="col-md-9">

                                    <select class="form-control select2" data-toggle="select2" name="instructor_name[]"
                                            id="instructor_name" multiple="multiple">
                                        <?php
                                        $instructors_lists = explode(",", $batch_model_data[0]['instructor_id']);

                                        foreach ($get_instructor_by_batch as $instructor_list) : ?>

                                            <option value="<?php echo $instructor_list['user_id'] ?>" <?php echo(in_array($instructor_list['user_id'], $instructors_lists) ? 'selected' : '') ?>>
                                                <?php
                                                echo $instructor_list['first_name'] . " " . $instructor_list['last_name'];
                                                ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label"
                                       for="duration"><?php echo get_phrase('duration'); ?></label>
                                <div class="col-md-9">
                                    <select class="form-control select2" data-toggle="select2" name="duration"
                                            id="duration">
                                        <?php
                                        $option_value = $batch_model_data[0]['duration'];
                                        if (!empty($option_value)) {
                                            ?>
                                            <option value="daily"
                                                    selected><?php echo get_phrase($batch_model_data[0]['duration']); ?></option>
                                            <?php
                                        }
                                        ?>
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
                                    <input type="date" class="form-control" id="date" name="date"
                                           value="<?php echo $batch_model_data[0]['date'] ?>" required>
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
                                    <input type="time" class="form-control" id="time" name="time"
                                           value="<?php echo $batch_model_data[0]['time'] ?>" required>
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
                                                name="button"><?php echo get_phrase('update'); ?></button>
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

<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>-->

<script>

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
        let batch_state_id = "<?php echo $batch_model_data[0]['state_id']?>";

        console.log('state_id = ' + batch_state_id)
        $('#state').empty();
        $.ajax({
            url: '<?php echo base_url("admin/state/")?>' + '/' + country_id,
            dataType: 'json',
            success: function (state) {
                $('#state').append(`<option value="">Choose State...</option>`)
                for (let key in state) {
                    if (state !== "") {
                        let state_dropdown = `<option value="${state[key]['id']}" ${(batch_state_id == state[key]['id']) ? 'selected' : ''}>${state[key]['name']}</option>`;
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


    $(document).ready(function () {
        var limit_in_databse = "<?php echo $batch_model_data[0]['batch_limit']?>"
        limit(limit_in_databse)
    });

    $('#batch_limit').change(function () {
        let value1 = $('#batch_limit').val();
        limit(value1)
    });

    function limit(limit_value) {
        $('#student_select .select2').select2({
            multiple: "multiple",
            maximumSelectionLength: limit_value,
            language: {
                maximumSelected: (args) => args.maximum + ' Your Student of Limit Full'
            },
        });
    }

</script>
