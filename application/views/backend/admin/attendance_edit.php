<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">
                    <i class="mdi mdi-apple-keyboard-command title_icon"></i>
                    <?php echo get_phrase('attendance_edit'); ?>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3"><?php echo get_phrase('attendance_edit'); ?></h4>
                <form class="required-form" action="<?php echo site_url('admin/attendance_list/edit/'. $attendance_data[0]['id']); ?>"
                      enctype="multipart/form-data" method="post">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label" for="batch"><?php echo get_phrase('batch');
                                    ?><span class="required">*</span></label>
                                <div class="col-md-9">
                                    <select class="form-control select2" data-toggle="select2" name="batch"
                                            id="batch" onChange="update()">
                                        <option value=" ">Choose....</option>
                                        <?php

                                        foreach ($batch_data as $key => $batch_model_list):
                                            $r = explode(",", $batch_model_list['course_id']);
                                            if (sizeof($r) > 1) {
                                                foreach ($r as $re) {
                                                    $result = $this->crud_model->get_course($re);
                                                    ?>
                                                    <option value="<?php echo $result[0]['id']; ?>"  <?php if ($attendance_data[0]['batch_id'] == $re ) echo "selected"?>><?php echo $result[0]['title'] ?></option>
                                                    <?php
                                                }
                                            } else {
                                                $result = $this->crud_model->get_course($batch_model_list['course_id']);
                                                ?>
                                                <option value="<?php echo $result[0]['id']; ?>" <?php if ($attendance_data[0]['batch_id'] == $result[0]['id'] ) echo "selected"?>><?php echo $result[0]['title'].$batch_model_list['batch_id'] ?></option>
                                                <?php
                                            }
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label"
                                       for="course_name"><?php echo get_phrase('course_name'); ?><span class="required">*</span></label>
                                <div class="col-md-9">
                                    <select class="form-control select2" data-toggle="select2" name="course_name"
                                            id="course_name" onchange="update()">
                                        <option value=" ">Choose....</option>
                                        <?php
                                        foreach ($courses_data as $key => $course_lists):
                                            ?>
                                            <option value="<?php echo $course_lists['id']; ?>" <?php if ($attendance_data[0]['course_id'] == $course_lists['id'] ) echo "selected"?>><?php echo $course_lists['title'] ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <script>
                                $(document).ready(function () {
                                    var batch_data = document.getElementById('batch');
                                    var course_data = document.getElementById('course_name');
                                    var batch = batch_data.options[batch_data.selectedIndex];
                                    var course = course_data.options[course_data.selectedIndex];

                                    if (batch.value != " ") {
                                        course_data.setAttribute("disabled", "disabled");
                                    } else {
                                        course_data.removeAttribute("disabled");
                                    }

                                    if (course.value != " ") {
                                        batch_data.setAttribute("disabled", "disabled")
                                    } else {
                                        batch_data.removeAttribute("disabled");
                                    }
                                });
                            </script>


                            <!--                            <div class="form-group row mb-3">-->
                            <!--                                <label class="col-md-3 col-form-label"-->
                            <!--                                       for="instructor">-->
                            <?php //echo get_phrase('instructor'); ?><!--<span class="required">*</span></label>-->
                            <!--                                <div class="col-md-9">-->
                            <!--                                </div>-->
                            <!--                            </div>-->

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label"
                                       for="duration"><?php echo get_phrase('duration'); ?></label>
                                <div class="col-md-9">

                                    <select class="form-control " style=" width: 100%"  name="duration"
                                            id="duration">
                                        <?php
                                        $duration = $attendance_data[0]['duration'];
                                        if ($duration != "") {
                                            ?>
                                            <option value="<?php echo $duration ?>"><?php echo get_phrase("$duration") ?></option>
                                            <option  value="all" <?php if ($duration=="all"){ echo "hidden";}?>>All</option>
                                            <option  value="hourly" <?php if ($duration=="hourly"){ echo "hidden";}?>>Hourly</option>
                                            <option  value="daily" <?php if ($duration=="daily"){ echo "hidden";}?>>Daily</option>
                                            <option  value="weekly" <?php if ($duration=="weekly"){ echo "hidden";}?> >Weekly</option>
                                            <option  value="monthly" <?php if ($duration=="monthly"){ echo 'hidden';}?>>Monthly</option>
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <option  value="all" <?php if ($duration=="all"){ echo "hidden";}?>>All</option>
                                            <option  value="hourly" <?php if ($duration=="hourly"){ echo "hidden";}?>>Hourly</option>
                                            <option  value="daily" <?php if ($duration=="daily"){ echo "hidden";}?>>Daily</option>
                                            <option  value="weekly" <?php if ($duration=="weekly"){ echo "hidden";}?> >Weekly</option>
                                            <option  value="monthly" <?php if ($duration=="monthly"){ echo 'hidden';}?>>Monthly</option>
                                            <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label" for="date"><?php echo get_phrase('date'); ?><span
                                            class="required">*</span></label>
                                <div class="col-md-9">
                                    <input type="date" class="form-control" id="date" name="date" value="<?php echo $attendance_data[0]['date']?>" >
                                </div>

<!--                                <script language="javascript">-->
<!---->
<!--                                    /********** Today Date************/-->
<!--                                    Date.prototype.toDateInputValue = (function () {-->
<!--                                        var local = new Date(this);-->
<!--                                        local.setMinutes(this.getMinutes() - this.getTimezoneOffset());-->
<!--                                        return local.toJSON().slice(0, 10);-->
<!--                                    });-->
<!---->
<!--                                    $('#date').val(new Date().toDateInputValue());-->
<!---->
<!--                                    /********* Today Date End ********/-->
<!--                                    var today = new Date();-->
<!--                                    var dd = String(today.getDate()).padStart(2, '0');-->
<!--                                    var mm = String(today.getMonth() + 1).padStart(2, '0');-->
<!--                                    var yyyy = today.getFullYear();-->
<!---->
<!--                                    today = yyyy + '-' + mm + '-' + dd;-->
<!--                                    $('#date').attr('min', today);-->
<!---->
<!--                                    document.getElementById('date').value = new Date().toDateInputValue();-->
<!---->
<!--                                </script>-->

                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label"
                                       for="start_time"><?php echo get_phrase('start_time'); ?><span
                                            class="required">*</span></label>
                                <div class="col-md-9">
                                    <input type="time" class="form-control" id="start_time" name="start_time" value="<?php echo $attendance_data[0]['start_time']?>">
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label" for="end_time"><?php echo get_phrase('end_time'); ?>
                                    <span class="required">*</span></label>
                                <div class="col-md-9">
                                    <input type="time" class="form-control" id="end_time" name="end_time"  value="<?php echo $attendance_data[0]['end_time']?>">
                                </div>
                            </div>


<!--                            <script language="javascript">/********** Today Date************/-->
<!---->
<!--                                Date.prototype.toDateInputValue = (function () {-->
<!--                                    var local = new Date(this);-->
<!--                                    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());-->
<!--                                    return local.toJSON().slice(0, 10);-->
<!--                                });-->
<!---->
<!--                                Date.prototype.timeToInput = function(){-->
<!--                                    return  ('0' + (this.getHours())).substr(-2,2) + ':' + ('0' + this.getMinutes()).substr(-2,2);-->
<!--                                }-->
<!---->
<!--                                $('#date').val(new Date().toDateInputValue());-->
<!---->
<!---->
<!--                                /********* Today Date End ********/-->
<!--                                var today = new Date();-->
<!--                                var dd = String(today.getDate()).padStart(2, '0');-->
<!--                                var mm = String(today.getMonth() + 1).padStart(2, '0');-->
<!--                                var yyyy = today.getFullYear();-->
<!---->
<!--                                today = yyyy + '-' + mm + '-' + dd;-->
<!--                                $('#date').attr('min', today);-->
<!---->
<!--                                document.getElementById('date').value = new Date().toDateInputValue();-->
<!---->
<!--                                /***** Time Select ******/-->
<!---->
<!--                                var time = new Date();-->
<!--                                var  currentTime= time.toLocaleTimeString("sv-SE")-->
<!---->
<!--                                // setInterval(function() {-->
<!--                                //     document.getElementById('start_time').value = new Date().toLocaleTimeString("sv-SE");-->
<!--                                // }, 1000);-->
<!--                            </script>-->


                        </div> <!-- end col -->
                    </div>
                    <div class="tab-pane" id="finish">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center">
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-primary" onclick="checkRequiredFields()"
                                                name="button"><?php echo get_phrase('attendance update'); ?></button>
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