<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"><i
                            class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('blog_list'); ?>
                    <a href="<?php echo site_url('admin/blog_form/add_form'); ?>"
                       class="btn btn-outline-primary btn-rounded alignToTitle"><i
                                class="mdi mdi-plus"></i><?php echo get_phrase('add_new_blog'); ?></a>
                </h4></div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>


<div class="row">
    <?php foreach ($blog_list as $blog_lists):
        if ($blog_lists['parent'] > 0)
            continue;
        $sub_categories = $this->crud_model->get_sub_categories($blog_lists['id']); ?>
        <div class="col-md-6 col-lg-6 col-xl-4 on-hover-action" id="<?php echo $blog_lists['id']; ?>">
            <div class="card d-block">

                <img class="card-img-top" src="
                <?php echo base_url('uploads/blog/thumb/' . $blog_lists['thumbnail']);
                ?>" alt="Card image cap" style="height: 200px">
                <div class="card-body">
                    <a href="<?php echo base_url('admin/blog_form/blog_details/'.$blog_lists['id']) ?>">
                        <h4 class="card-title mb-0">
                            <?php echo $blog_lists['title']; ?>
                        </h4>
                    </a>
                    <div>
                        <?php echo $blog_lists['short_description']; ?>
                    </div>
                </div>

                <div class="card-body">
                    <a href="<?php echo site_url('admin/blog_form/edit_form/' . $blog_lists['id']); ?>"
                       class="btn btn-icon btn-outline-info btn-sm"
                       id="category-edit-btn-<?php echo $blog_lists['id']; ?>" style="display: none;"
                       style="margin-right:5px;">
                        <i class="mdi mdi-wrench"></i>
                        <?php echo get_phrase('edit'); ?>
                    </a>

                    <a href="#" class="btn btn-icon btn-outline-secondary btn-sm"
                       id="category-delete-btn1-<?php echo $blog_lists['id']; ?>" style="float: right; display: none;"
                       style="margin-right:5px;">

                        <div class="dropdown show" style="float: right; display: none;"
                             id="category-delete-btn-<?php echo $blog_lists['id']; ?>">
                            <a class="btn btn-icon btn-outline-secondary btn-sm" href="#" role="button"
                               id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-more"></i> <?php echo get_phrase('action'); ?>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item"
                                   href="<?php echo base_url('admin/blog_form/view_comment/' . $blog_lists['id']) ?>">Comment
                                    View</a>
                                <span class="dropdown-item"
                                      onclick="confirm_modal('<?php echo site_url('admin/blog_form/blog_delete/' . $blog_lists['id']); ?>');">
                                    <?php echo get_phrase('delete'); ?>
                                </span>
                                <!--                                <a class="dropdown-item" href="#">Something else here</a>-->
                            </div>

                        </div>
                    </a>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
    <?php endforeach; ?>
</div>


<script type="text/javascript">
    $('.on-hover-action').mouseenter(function () {
        var id = this.id;
        $('#category-delete-btn-' + id).show();
        $('#category-edit-btn-' + id).show();
    });
    $('.on-hover-action').mouseleave(function () {
        var id = this.id;
        $('#category-delete-btn-' + id).hide();
        $('#category-edit-btn-' + id).hide();
    });
</script>
