<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"><i
                            class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo $page_title; ?>
                    <a href="<?php echo site_url('admin/branch_form/add'); ?>"
                       class="btn btn-outline-primary btn-rounded alignToTitle"><i
                                class="mdi mdi-plus"></i><?php echo get_phrase('add_branch'); ?></a>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3 header-title"><?php echo get_phrase('branch'); ?></h4>
                <div class="table-responsive-sm mt-4">
                    <table id="basic-datatable" class="table table-striped table-centered mb-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo get_phrase('photo'); ?></th>
                            <th><?php echo get_phrase('Branch_name'); ?></th>
                            <th><?php echo get_phrase('email'); ?></th>
                            <th><?php echo get_phrase('address'); ?></th>
                            <th><?php echo get_phrase('city'); ?></th>
                            <th><?php echo get_phrase('actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($all_branch as $key => $branch_data): ?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td>
                                    <img src="<?php echo base_url('uploads/branch_image/' . $branch_data['branch_image']); ?>"
                                         alt="" height="50" width="50" class="img-fluid rounded-circle img-thumbnail">
                                </td>
                                <td><?php echo get_phrase($branch_data['branch_name']); ?></td>
                                <td><?php echo $branch_data['email']; ?></td>
                                <td>
                                    <?php echo get_phrase($branch_data['address']); ?>
                                </td>
                                <td>
                                    <?php
                                    $name_or_id = $this->db->get_where('cities', array('id' => $branch_data['city']));
                                    if ($name_or_id->num_rows() > 0) {
                                        $city_data = $name_or_id->result_array();
                                        echo get_phrase($city_data[0]['name']);
                                    } else {
                                        echo get_phrase($branch_data['city']);
                                    }
                                    ?>
                                </td>
                                <td>
                                    <div class="dropright">
                                        <button type="button"
                                                class="btn btn-sm btn-outline-primary btn-rounded btn-icon"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item"
                                                   href="<?php echo site_url('admin/branch_form/edit/' . $branch_data['id']) ?>"><?php echo get_phrase('edit'); ?></a>
                                            </li>
                                            <li><a class="dropdown-item" href="#"
                                                   onclick="confirm_modal('<?php echo site_url('admin/branch_form/delete/' . $branch_data['id']); ?>');"><?php echo get_phrase('delete'); ?></a>
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
