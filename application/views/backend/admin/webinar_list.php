<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">
                    <i class="mdi mdi-apple-keyboard-command title_icon"></i>
                    <?php echo $page_title; ?>
                </h4>
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body" style="overflow-x: scroll;">
                <h4 class="mb-3 header-title"><?php echo get_phrase('webinar_list'); ?></h4>
                <div class="table-responsive-sm mt-4">
                    <table id="basic-datatable" class="table table-striped table-centered mb-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo get_phrase('image'); ?></th>
                            <th><?php echo get_phrase('title'); ?></th>
                            <th><?php echo get_phrase('description'); ?></th>
                            <th><?php echo get_phrase('start date time'); ?></th>
                            <th><?php echo get_phrase('end date time'); ?></th>
                            <th><?php echo get_phrase('host link'); ?></th>
                            <th><?php echo get_phrase('attend link'); ?></th>
                            <th><?php echo get_phrase('action'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($webinar_lists as $key => $webinar): ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td>
                                    <img src="<?php echo $this->user_model->get_user_image_url($webinar->id); ?>" alt=""
                                         height="50" width="50" class="img-fluid rounded-circle img-thumbnail">
                                </td>
                                <td><?= $webinar->title ?></td>
                                <td><?= $webinar->short_dis ?></td>
                                <td><?= $webinar->start_time ?></td>
                                <td><?= $webinar->end_time ?></td>
                                <td><?=ellipsis( $webinar->zoom_host_link,20) ?></td>
                                <td><?= ellipsis( $webinar->zoom_attend_link,20) ?></td>

                                <td>
                                    <div class="dropright dropright">
                                        <button type="button"
                                                class="btn btn-sm btn-outline-primary btn-rounded btn-icon"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item"
                                                   href="<?php echo site_url('admin/webinar_form/student_list/' . $webinar->id) ?>">
                                                    <?php echo get_phrase('Student List'); ?>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                   href="<?php echo site_url('admin/webinar_form/student_add/' . $webinar->id) ?>">
                                                    <?php echo get_phrase('Add New Student'); ?>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                   href="<?php echo site_url('admin/webinar_form/reminder_mail/' . $webinar->id) ?>">
                                                    <?php echo get_phrase('Reminder mail'); ?>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                   href="<?php echo site_url('admin/webinar_form/thanks_mail/' . $webinar->id) ?>">
                                                    <?php echo get_phrase('Thank You Mail'); ?>
                                                </a>
                                            </li>

                                            <!--                                            <li>-->
                                            <!--                                                <a class="dropdown-item"-->
                                            <!--                                                   href="-->
                                            <?php //echo site_url('admin/webinar_form/status_change/' . $webinar->id) ?><!--">-->
                                            <!--                                                    --><?php //echo get_phrase('status change'); ?>
                                            <!--                                                </a>-->
                                            <!--                                            </li>-->
                                            <li>
                                                <a class="dropdown-item"
                                                   href="<?php echo site_url('admin/webinar_form/edit/' . $webinar->id) ?>">
                                                    <?php echo get_phrase('edit'); ?>
                                                </a>
                                            </li>
                                            <!---
                                            <li>
                                                <a class="dropdown-item" href="#"
                                                   onclick="confirm_modal('<?php echo site_url('admin/webinar_form/delete/' . $webinar->id); ?>');">
                                                    <?php echo get_phrase('delete'); ?>
                                                </a>
                                            </li>
                                            -->
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
