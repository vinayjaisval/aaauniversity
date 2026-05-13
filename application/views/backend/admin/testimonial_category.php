<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"><i
                            class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('testimonial_category'); ?>
                    <a href="<?php echo site_url('admin/form_testimonial_category/add_form'); ?>"
                       class="btn btn-outline-primary btn-rounded alignToTitle"><i
                                class="mdi mdi-plus"></i><?php echo get_phrase('add_testimonial_category'); ?></a>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<!--testimonial_category_data-->

<div class="row">
    <?php foreach ($testimonial_category_data as $testimonial_category):
        ?>
        <div class="col-md-6 col-lg-6 col-xl-4 on-hover-action" id="<?php echo $testimonial_category['id']; ?>">
            <div class="card d-block">
                <img class="card-img-top" src="
                <?php echo base_url('uploads/testimonial/category_image/' . $testimonial_category['image']);
                ?>" alt="Card image cap">
                <div class="card-body">
                    <h4 class="card-title mb-0">
                        <i class="<?php echo $testimonial_category['icon']; ?>"></i>
                        <?php echo $testimonial_category['title']; ?>
                    </h4>
                </div>

                <div class="card-body">
                    <a href="<?php echo site_url('admin/form_testimonial_category/edit_form/' . $testimonial_category['slug']); ?>"
                       class="btn btn-icon btn-outline-info btn-sm"
                       id="category-edit-btn-<?php echo $testimonial_category['id']; ?>" style="display: none;"
                       style="margin-right:5px;">
                        <i class="mdi mdi-wrench"></i>
                        <?php echo get_phrase('edit'); ?>
                    </a>

                    <!--
                        <a href="#" class="btn btn-icon btn-outline-danger btn-sm"
                           id="category-delete-btn-<?php echo $testimonial_category['id']; ?>" style="float: right; display: none;"
                           onclick="confirm_modal('<?php echo site_url('admin/categories/delete/' . $testimonial_category['id']); ?>');"
                           style="margin-right:5px;">
                            <i class="mdi mdi-delete"></i>
                            <?php echo get_phrase('delete'); ?>
                        </a>
                    -->

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