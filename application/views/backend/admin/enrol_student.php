<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"><i
                            class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('enrol_a_student'); ?>
                </h4>


            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row justify-content-center">
    <div class="col-xl-7">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12">
                    <h4 class="mb-3 header-title"><?php echo get_phrase('enrolment_form'); ?></h4>

                    <form class="required-form" action="<?php echo site_url('admin/enrol_student/enrol'); ?>"
                          method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="user_id"><?php echo get_phrase('user'); ?><span class="required">*</span>
                            </label>
                            <select class="form-control select2" data-toggle="select2" name="user_id" id="user_id"
                                    required>
                                <option value=""><?php echo get_phrase('select_a_user'); ?></option>
                                <?php $user_list = $this->user_model->get_user(0, '', 'students')->result_array();
                                foreach ($user_list as $user):?>
                                    <option value="<?php echo $user['id'] ?>"><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="course_id"><?php echo get_phrase('course_to_enrol'); ?><span
                                        class="required">*</span> </label>
                            <select class="form-control select2" name="course_id" id="course_id"
                                    required>
                                <option value=""><?php echo get_phrase('select_a_course'); ?></option>
                                <?php $course_list = $this->crud_model->get_courses()->result_array();
                                foreach ($course_list as $course):
                                    if ($course['status'] != 'active')
                                        continue; ?>
                                    <option value="<?php echo $course['id'] ?>"><?php echo $course['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group" id="input">
                        </div>
                        <div class="form-group" id="select">
                            <label for="course_id"><?php echo get_phrase('Partial_payment'); ?><span
                                        class="required">*</span> </label>
                            <select class="form-control" id="installment_payment" name="installment_payment" required>
                                <option value="">Select Payment</option>
                                <option value="1">Full Payment</option>
                                <option value="2">Partial Payment</option>
                            </select>
                        </div>
                        <div class="form-group" id="select_money">
                            <input type="number" id="inst_money" class="form-control" placeholder="Partial Money..."
                                   name="installment_money">
                        </div>

                        <div class="form-group" id="next_date">
                            <label for="course_id"><?php echo get_phrase('next_due_date'); ?><span
                                        class="required">*</span> </label>

                            <input type="date" id="date" class="form-control" placeholder="Next Due Date..."
                                   name="due_date">
                        </div>

                        <button type="button" class="btn btn-primary"
                                onclick="checkRequiredFields()"><?php echo get_phrase('enrol_student'); ?></button>
                    </form>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script>

    document.addEventListener('contextmenu', event => event.preventDefault());


    $(document).ready(function () {
        let cp = 0
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        $('#date').attr('min', today);

        $('#c_money').hide();
        $('#select').hide();
        $('#select_money').hide();
        $('#next_date').hide()


    })

    $('#course_id').change(function () {
        $('#input').empty()
        let course_id = $('#course_id').val()

        if (course_id !== "") {
            $.ajax({
                url: '<?php echo base_url("admin/course_actions/get_price/");?>' + course_id,
                dataType: 'json',
                success: function (data) {
                    if (data === "") {
                        $('#c_money').hide();
                        $('#select').hide();
                        $('#date').hide();

                    } else {

                        cp = data[0]['price'];
                        $('#c_money').show();
                        $('#select').show();

                        var input = `<input type="text" id="c_money" class="form-control" value="${data[0]['price']}" readonly>`
                        $('#input').append(input)
                    }
                }
            });
        } else {
            $('#c_money').hide();
            $('#select').hide();
        }


    })

    $('#installment_payment').change(function () {

        let value = $('#installment_payment').val()

        if (value > 1) {
            $('#select_money').show();
            $('#next_date').show()
            $("#inst_money").prop('required', true);
            $("#date").prop('required', true);
        } else {
            $('#select_money').hide();
            $('#next_date').hide()
            $("#inst_money").prop('required', false);
            $("#date").prop('required', false);
        }


    })

    // $( "#datepicker" ).datepicker({ minDate: 0})
    $(function () {
        $('#inst_money').keyup(function(){
            if (parseInt($(this).val()) > parseInt(cp)){
                $('#next_date').hide()
                alert("Your Course Price" + cp );
                $(this).val(cp);

            }
            if (parseInt($(this).val()) < parseInt(cp)){
                $('#next_date').show()
                $("#date").prop('required', true);
            }
            if (parseInt($(this).val()) === parseInt(cp)){
                $('#next_date').hide()
                $("#date").prop('required', false);
            }
        });
    });

</script>