<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"><i
                            class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('all_blog_category'); ?>
                    <a href="<?php echo site_url('admin/form_blog_category/add_form'); ?>"
                       class="btn btn-outline-primary btn-rounded alignToTitle"><i
                                class="mdi mdi-plus"></i><?php echo get_phrase('add_new_blog_category'); ?></a>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <?php foreach ($blog_category as $category):
        if ($category['parent'] > 0)
            continue;
        $sub_categories = $this->crud_model->get_sub_categories($category['id']); ?>
        <div class="col-md-6 col-lg-6 col-xl-4 on-hover-action" id="<?php echo $category['id']; ?>">
            <div class="card d-block">
                <img class="card-img-top" src="
                <?php echo base_url('uploads/blog/category_image/'.$category['image']);
                ?>" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title mb-0">
                        <i class="<?php echo $category['icon']; ?>"></i>
                        <?php echo $category['title']; ?>
                    </h4>
                </div>

                <div class="card-body">
                    <a href="<?php echo site_url('admin/form_blog_category/edit_form/' . $category['slug']); ?>"
                       class="btn btn-icon btn-outline-info btn-sm"
                       id="category-edit-btn-<?php echo $category['id']; ?>" style="display: none;"
                       style="margin-right:5px;">
                        <i class="mdi mdi-wrench"></i>
                        <?php echo get_phrase('edit'); ?>
                    </a>
                    <a href="#" class="btn btn-icon btn-outline-danger btn-sm"
                       id="category-delete-btn-<?php echo $category['id']; ?>" style="float: right; display: none;"
                       onclick="confirm_modal('<?php echo site_url('admin/categories/delete/' . $category['id']); ?>');"
                       style="margin-right:5px;">
                        <i class="mdi mdi-delete"></i>
                        <?php echo get_phrase('delete'); ?>
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
