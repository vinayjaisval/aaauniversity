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

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3"><?php echo get_phrase('add_batch_model'); ?></h4>
                <form class="required-form" action="<?php echo site_url('admin/courses_document_form/add'); ?>"
                      enctype="multipart/form-data" method="post">
                    <div class="row">
                        <div class="col-12">

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label"
                                       for="course_name"><?php echo get_phrase('course_name'); ?><span class="required">*</span></label>
                                <div class="col-md-9">
                                    <select class="form-control select2" name="course_id" id="course_name">
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

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label"
                                       for="doc_text"><?php echo get_phrase('Add Courses Documents'); ?><span class="required">*</span></label>
                                <div class="col-md-9">
                                    <textarea name="doc_text" class="form-control" id="doc_text" required></textarea>
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
    $(document).ready(function () {
        initSummerNote(['#doc_text']);
    });
</script>
