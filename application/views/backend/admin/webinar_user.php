<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title">
                    <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo $page_title; ?>
                </h4>
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title"><?php echo get_phrase('instructors'); ?></h4>
                <div class="table-responsive-sm mt-4">
                    <table id="basic-datatable" class="table table-striped table-centered mb-0">
                        <thead>
                        <tr>
                            <th>#</th>
<!--                            <th>--><?php //echo get_phrase('image'); ?><!--</th>-->
                            <th><?php echo get_phrase('Name'); ?></th>
                            <th><?php echo get_phrase('email'); ?></th>
                            <th><?php echo get_phrase('phone'); ?></th>
                            <th><?php echo get_phrase('message'); ?></th>
                            <th><?php echo get_phrase('action'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($webinar_user as $key => $webinar): ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $webinar->name ?></td>
                                <td><?= $webinar->email ?></td>
                                <td><?= $webinar->phone ?></td>
                                <td><?= $webinar->short_dis ?></td>
                                <td>
                                    <div class="dropright dropright">
                                        <button type="button"
                                                class="btn btn-sm btn-outline-primary btn-rounded btn-icon"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
<!--                                            <li>-->
<!--                                                <a class="dropdown-item"-->
<!--                                                   href="--><?php //echo site_url('admin/webinar_form/status_change/' . $webinar->id) ?><!--">-->
<!--                                                    --><?php //echo get_phrase(''); ?>
<!--                                                </a>-->
<!--                                            </li>-->
<!--                                            <li>-->
<!--                                                <a class="dropdown-item"-->
<!--                                                   href="--><?php //echo site_url('admin/webinar_form/edit/' . $webinar->id) ?><!--">-->
<!--                                                    --><?php //echo get_phrase('edit'); ?>
<!--                                                </a>-->
<!--                                            </li>-->
                                            <li>
                                                <a class="dropdown-item" href="#"
                                                   onclick="confirm_modal('<?php echo site_url('admin/webinar_form/delete/' . $webinar->id); ?>');">
                                                    <?php echo get_phrase('delete'); ?>
                                                </a>
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
