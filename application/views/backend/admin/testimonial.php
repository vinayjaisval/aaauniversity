<!-- start page title -->
<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"><i
                            class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('testimonial'); ?>
                    <a href="
                    <?php echo site_url('admin/testimonial_form/add_form'); ?>"
                       class="btn btn-outline-primary btn-rounded alignToTitle"><i class="mdi mdi-plus"></i>
                        <?php echo get_phrase('add_new_testimonial'); ?></a>
                </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <?php foreach ($testimonial_data as $testimonial_list):
        ?>
        <div class="col-md-6 col-lg-6 col-xl-4 on-hover-action" id="<?php echo $testimonial_list['id']; ?>">
            <div class="card d-block">

                <!--                <img class="card-img-top" src="-->
                <!--                --><?php //echo base_url('uploads/blog/thumb/' . $testimonial_list['thumbnail']);
                //
                ?><!--" alt="Card image cap" style="height: 200px">-->
                <div class="card-body">
                    <div>
                        <?php echo $testimonial_list['testimonial_text']; ?>
                    </div>
                    <div style="padding-top: 10px">
                        <?php
                        $cate = $this->crud_model->get_testimonial_by_slug_and_id($testimonial_list['testimonial_category_id'])->result_array();
                        echo strtoupper($cate[0]['title']) ; ?>
                    </div>
                    <div class="rating">
                            <?php for ($i = 1; $i < 6; $i++): ?>
                                <?php if ($i <= $testimonial_list['rating']): ?>
                                    <i class="fa fa-star" style="color: #f8b81f;"></i>
                                <?php else: ?>
                                    <i class="fa fa-star" style="color: #abb0bb;"></i>
                                <?php endif; ?>
                            <?php endfor; ?>
                    </div>
                </div>

                <div class="card-body">
                    <a href="<?php echo site_url('admin/testimonial_form/edit_form/' . $testimonial_list['id']); ?>"
                       class="btn btn-icon btn-outline-info btn-sm"
                       id="category-edit-btn-<?php echo $testimonial_list['id']; ?>" style="display: none;"
                       style="margin-right:5px;">
                        <i class="mdi mdi-wrench"></i>
                        <?php echo get_phrase('edit'); ?>
                    </a>

                    <a href="#" class="btn btn-icon btn-outline-secondary btn-sm"
                       id="category-delete-btn1-<?php echo $testimonial_list['id']; ?>"
                       style="float: right; display: none;"
                       style="margin-right:5px;">

                        <div class="dropdown show" style="float: right; display: none;"
                             id="category-delete-btn-<?php echo $testimonial_list['id']; ?>">
                            <a class="btn btn-icon btn-outline-secondary btn-sm" href="#" role="button"
                               id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-more"></i> <?php echo get_phrase('action'); ?>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
<!--                                <a class="dropdown-item"-->
<!--                                   href="--><?php //echo base_url('admin/blog_form/view_comment/' . $testimonial_list['id']) ?><!--">Comment-->
<!--                                    View</a>-->
                                <span class="dropdown-item"
                                      onclick="confirm_modal('<?php echo site_url('admin/testimonial_form/delete/' . $testimonial_list['id']); ?>');">
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