<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"><i
                            class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('view_course_document'); ?>
                    <a href="
                    <?php echo site_url('admin/courses_document_form/add_form'); ?>"
                       class="btn btn-outline-primary btn-rounded alignToTitle"><i class="mdi mdi-plus"></i>
                        <?php echo get_phrase('add_new_courses_document'); ?></a>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title"><?php echo get_phrase('Courses Documents'); ?></h4>
                <div class="table-responsive-sm mt-4">
                    <table id="basic-datatable" class="table table-striped table-centered mb-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo get_phrase('Course_name'); ?></th>
                            <th><?php echo get_phrase('Documents'); ?></th>
                            <!--                            <th>--><?php //echo get_phrase('email'); ?><!--</th>-->
                            <!--                            <th>-->
                            <?php //echo get_phrase('number_of_active_courses'); ?><!--</th>-->
                            <th><?php echo get_phrase('actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($courses_documents as $key => $documents): ?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td>
                                    <?php
                                    $course = $this->crud_model->get_course_by_id($documents['course_id'])->result_array();
                                    echo $course[0]['title'] ?>
                                </td>
                                <td>
                                    <?php $doc_text = strlen($documents['document_text']) > 40 ? substr(strip_tags($documents['document_text']),0,40) . "..." : $documents['document_text'];
                                        echo  $doc_text;
                                    ?>
                                </td>
                                <td>
                                    <div class="dropright dropright">
                                        <button type="button"
                                                class="btn btn-sm btn-outline-primary btn-rounded btn-icon"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item"
                                                   href="<?php echo site_url('home/course/'.$course[0]['title'].'/'.$documents['course_id']) ?>"><?php echo get_phrase('view_courses'); ?></a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                   href="<?php echo site_url('admin/courses_document_form/edit_form/' . $documents['id']) ?>"><?php echo get_phrase('edit'); ?></a>
                                            </li>
                                            <li><a class="dropdown-item" href="#"
                                                   onclick="confirm_modal('<?php echo site_url('admin/courses_document_form/delete/' . $documents['id']); ?>');"><?php echo get_phrase('delete'); ?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
