<?php
$status_wise_courses = $this->crud_model->get_status_wise_courses();
?>
<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu left-side-menu-detached">
    <div class="leftbar-user">
        <a href="javascript: void(0);">
            <img src="<?php echo $this->user_model->get_user_image_url($this->session->userdata('user_id')); ?>"
                 alt="user-image" height="42" class="rounded-circle shadow-sm">
            <?php
            $admin_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
            ?>
            <span class="leftbar-user-name"><?php echo $admin_details['first_name'] . ' ' . $admin_details['last_name']; ?></span>
        </a>
    </div>

    <!--- Sidemenu -->
    <ul class="metismenu side-nav side-nav-light">

        <li class="side-nav-title side-nav-item"><?php echo get_phrase('navigation'); ?></li>

        <li class="side-nav-item <?php if ($page_name == 'dashboard') echo 'active'; ?>">
            <a href="<?php echo site_url('admin/dashboard'); ?>" class="side-nav-link">
                <i class="dripicons-view-apps"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>
     
        <li class="side-nav-item <?php if ($page_name == 'webinar' || $page_name == 'webinar_student_add' || $page_name == 'student_list' || $page_name == 'reminder_mail' || $page_name == 'thanks_mail' || $page_name == 'webinar_add' || $page_name == 'webinar_user' || $page_name == 'webinar_edit' || $page_name == 'webinar_list') : ?> active <?php endif; ?>">
            <a href="javascript: void(0);"
               class="side-nav-link <?php if ($page_name == 'webinar' || $page_name == 'webinar_student_add' || $page_name == 'reminder_mail' || $page_name == 'webinar_add' || $page_name == 'thanks_mail' || $page_name == 'webinar_user' || $page_name == 'webinar_edit' || $page_name == 'webinar_list') : ?> active <?php endif; ?>">
                <i class="dripicons-rocket"></i>
                <span> <?php echo get_phrase('Webinar'); ?> </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
              <li class="<?php if ($page_name == 'webinar' || $page_name == 'webinar_edit') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/webinar'); ?>"><?php echo get_phrase('Webinar List'); ?></a>
                </li> 
           <li class="<?php if ($page_name == 'webinar_add') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/webinar_form/add'); ?>"><?php echo get_phrase('Add Webinar'); ?></a>
                </li> 
                           <li class="<?php if ($page_name == 'webinar_user') echo 'active'; ?>">
                             <a href="<?php echo site_url('admin/webinar_form/add'); ?>">
                                     <?php echo get_phrase('Webinar User'); ?>
                                 </a>
                            </li> 
            </ul>
        </li>
        <li class="side-nav-item <?php if ($page_name == 'banner_add' || $page_name == 'banner_edit' ) : ?> active <?php endif; ?>">
            <a href="javascript: void(0);"
               class="side-nav-link <?php if ($page_name == 'banner_add' || $page_name == 'banner_edit' ) : ?> active <?php endif; ?>">
                <i class="dripicons-rocket"></i>
                <span> <?php echo get_phrase('Banner'); ?> </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
              <li class="<?php if ($page_name == 'banner' || $page_name == 'banner_edit') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/banner'); ?>"><?php echo get_phrase('Banner List'); ?></a>
                </li> 
           <li class="<?php if ($page_name == 'banner_add') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/banner_form/add'); ?>"><?php echo get_phrase('Add banner'); ?></a>
                </li> 
                         
            </ul>
        </li>

       
        <li class="side-nav-item <?php if ($page_name == 'categories' || $page_name == 'category_add' || $page_name == 'category_edit') : ?> active <?php endif; ?>">
            <a href="javascript: void(0);"
               class="side-nav-link <?php if ($page_name == 'categories' || $page_name == 'category_add' || $page_name == 'category_edit') : ?> active <?php endif; ?>">
                <i class="dripicons-network-1"></i>
                <span> <?php echo get_phrase('categories'); ?> </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
                <li class="<?php if ($page_name == 'categories' || $page_name == 'category_edit') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/categories'); ?>"><?php echo get_phrase('categories'); ?></a>
                </li>

                <li class="<?php if ($page_name == 'category_add') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/category_form/add_category'); ?>"><?php echo get_phrase('add_new_category'); ?></a>
                </li>
            </ul>
        </li>

        <li class="side-nav-item">
            <a href="<?php echo site_url('admin/courses'); ?>"
               class="side-nav-link <?php if ($page_name == 'courses' || $page_name == 'course_add' || $page_name == 'course_edit') echo 'active'; ?>">
                <i class="dripicons-archive"></i>
                <span><?php echo get_phrase('courses'); ?></span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="<?php echo site_url('admin/courses_document'); ?>"
               class="side-nav-link <?php if ($page_name == 'courses_document' || $page_name == 'course_add' || $page_name == 'course_edit') echo 'active'; ?>">
                <i class="dripicons-archive"></i>
                <span><?php echo get_phrase('courses_document'); ?></span>
            </a>
        </li>

        <?php if (addon_status('course_bundle')) : ?>
            <li class="side-nav-item <?php if ($page_name == 'add_bundle' || $page_name == 'manage_course_bundle' || $page_name == 'edit_bundle' || $page_name == 'active_bundle_subscription_report' || $page_name == 'expire_bundle_subscription_report' || $page_name == 'bundle_invoice') : ?> active <?php endif; ?>">
                <a href="javascript: void(0);" class="side-nav-link">
                    <i class="dripicons-pamphlet"></i>
                    <span> <?php echo get_phrase('course_bundle'); ?> </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li class="<?php if ($page_name == 'add_bundle') echo 'active'; ?>">
                        <a href="<?php echo site_url('addons/bundle/add_bundle_form'); ?>"><?php echo get_phrase('add_new_bundle'); ?></a>
                    </li>
                </ul>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li class="<?php if ($page_name == 'manage_course_bundle') echo 'active'; ?>">
                        <a href="<?php echo site_url('addons/bundle/manage_bundle'); ?>"><?php echo get_phrase('manage_bundle'); ?></a>
                    </li>
                </ul>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li class="<?php if ($page_name == 'active_bundle_subscription_report' || $page_name == 'expire_bundle_subscription_report' || $page_name == 'bundle_invoice') echo 'active'; ?>">
                        <a href="<?php echo site_url('addons/bundle/subscription_report/active'); ?>"><?php echo get_phrase('subscription_report'); ?></a>
                    </li>
                </ul>
            </li>
        <?php endif; ?>

        <li class="side-nav-item <?php if ($page_name == 'instructors' || $page_name == 'instructor_add' || $page_name == 'instructor_edit') : ?> active <?php endif; ?>">
            <a href="javascript: void(0);"
               class="side-nav-link <?php if ($page_name == 'instructors' || $page_name == 'instructor_add' || $page_name == 'instructor_edit') : ?> active <?php endif; ?>">
                <i class="mdi mdi-incognito"></i>
                <span> <?php echo get_phrase('instructors'); ?> </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
                <li class="<?php if ($page_name == 'instructors' || $page_name == 'instructor_add' || $page_name == 'instructor_edit') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/instructors'); ?>"><?php echo get_phrase('instructor_list'); ?></a>
                </li>

                <li class="<?php if ($page_name == 'instructor_payout') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/instructor_payout'); ?>">
                        <?php echo get_phrase('instructor_payout'); ?>
                        <span class="badge badge-danger-lighten"><?php echo $this->crud_model->get_pending_payouts()->num_rows(); ?></span>
                    </a>
                </li>

                <li class="<?php if ($page_name == 'instructor_settings') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/instructor_settings'); ?>"><?php echo get_phrase('instructor_settings'); ?></a>
                </li>

                <li class="<?php if ($page_name == 'instructor_application') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/instructor_application'); ?>">
                        <?php echo get_phrase('instructor_application'); ?>
                        <span class="badge badge-danger-lighten"><?php echo $this->user_model->get_pending_applications()->num_rows(); ?></span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="side-nav-item">
            <a href="<?php echo site_url('admin/users'); ?>"
               class="side-nav-link <?php if ($page_name == 'users' || $page_name == 'user_add' || $page_name == 'user_edit') echo 'active'; ?>">
                <i class="dripicons-user-group"></i>
                <span><?php echo get_phrase('students'); ?></span>
            </a>
        </li>

        <li class="side-nav-item <?php if ($page_name == 'enrol_history' || $page_name == 'enrol_student') : ?> active <?php endif; ?>">
            <a href="javascript: void(0);"
               class="side-nav-link <?php if ($page_name == 'enrol_history' || $page_name == 'enrol_student') : ?> active <?php endif; ?>">
                <i class="dripicons-network-3"></i>
                <span> <?php echo get_phrase('enrolment'); ?> </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
                <li class="<?php if ($page_name == 'enrol_history') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/enrol_history'); ?>"><?php echo get_phrase('enrol_history'); ?></a>
                </li>

                <li class="<?php if ($page_name == 'enrol_student') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/enrol_student'); ?>"><?php echo get_phrase('enrol_a_student'); ?></a>
                </li>
            </ul>
        </li>

        <li class="side-nav-item">
            <a href="javascript: void(0);"
               class="side-nav-link <?php if ($page_name == 'admin_revenue' || $page_name == 'instructor_revenue' || $page_name == 'invoice') : ?> active <?php endif; ?>">
                <i class="dripicons-box"></i>
                <span> <?php echo get_phrase('report'); ?> </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
                <li class="<?php if ($page_name == 'admin_revenue') echo 'active'; ?>"><a
                            href="<?php echo site_url('admin/admin_revenue'); ?>"><?php echo get_phrase('admin_revenue'); ?></a>
                </li>
                <?php if (get_settings('allow_instructor') == 1) : ?>
                    <li class="<?php if ($page_name == 'instructor_revenue') echo 'active'; ?>">
                        <a href="<?php echo site_url('admin/instructor_revenue'); ?>">
                            <?php echo get_phrase('instructor_revenue'); ?>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </li>

        <?php if (addon_status('offline_payment')) : ?>
            <li class="side-nav-item">
                <a href="javascript: void(0);"
                   class="side-nav-link <?php if ($page_name == 'offline_payment_pending' || $page_name == 'offline_payment_approve' || $page_name == 'offline_payment_suspended') : ?> active <?php endif; ?>">
                    <i class="dripicons-box"></i>
                    <span> <?php echo get_phrase('offline_payment'); ?></span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="side-nav-second-level" aria-expanded="false">
                    <li class="<?php if ($page_name == 'offline_payment_pending') echo 'active'; ?>">
                        <a href="<?php echo site_url('addons/offline_payment/pending'); ?>">
                            <?php echo get_phrase('pending_request'); ?>
                            <span class="badge badge-danger-lighten badge-pill float-right"><?php echo get_pending_offline_payment(); ?></span></span>
                        </a>
                    </li>
                    <li class="<?php if ($page_name == 'offline_payment_approve') echo 'active'; ?>">
                        <a href="<?php echo site_url('addons/offline_payment/approve'); ?>"><?php echo get_phrase('accepted_request'); ?></a>
                    </li>
                    <li class="<?php if ($page_name == 'offline_payment_suspended') echo 'active'; ?>">
                        <a href="<?php echo site_url('addons/offline_payment/suspended'); ?>"><?php echo get_phrase('suspended_request'); ?></a>
                    </li>
                </ul>
            </li>
        <?php endif; ?>

        <li class="side-nav-item">
            <a href="<?php echo site_url('admin/message'); ?>"
               class="side-nav-link <?php if ($page_name == 'message' || $page_name == 'message_new' || $page_name == 'message_read') echo 'active'; ?>">
                <i class="dripicons-message"></i>
                <span><?php echo get_phrase('message'); ?></span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="javascript: void(0);"
               class="side-nav-link <?php if ($page_name == 'addons' || $page_name == 'addon_add' || $page_name == 'available_addons') : ?> active <?php endif; ?>">
                <i class="dripicons-graph-pie"></i>
                <span> <?php echo get_phrase('addons'); ?> </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
                <li class="<?php if ($page_name == 'addons') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/addon'); ?>"><?php echo get_phrase('addon_manager'); ?></a>
                </li>
                <li class="<?php if ($page_name == 'available_addons') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/available_addons'); ?>"><?php echo get_phrase('available_addons'); ?></a>
                </li>
            </ul>
        </li>

        <li class="side-nav-item  <?php if ($page_name == 'system_settings' || $page_name == 'frontend_settings' || $page_name == 'payment_settings' || $page_name == 'smtp_settings' || $page_name == 'manage_language' || $page_name == 'manage_level' || $page_name == 'about' || $page_name == 'themes') : ?> active <?php endif; ?>">
            <a href="javascript: void(0);" class="side-nav-link">
                <i class="dripicons-toggles"></i>
                <span> <?php echo get_phrase('settings'); ?> </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
                <li class="<?php if ($page_name == 'system_settings') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/system_settings'); ?>"><?php echo get_phrase('system_settings'); ?></a>
                </li>
                <li class="<?php if ($page_name == 'frontend_settings') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/frontend_settings'); ?>"><?php echo get_phrase('website_settings'); ?></a>
                </li>
                <?php if (addon_status('certificate')) : ?>
                    <li class="<?php if ($page_name == 'certificate_settings') echo 'active'; ?>">
                        <a href="<?php echo site_url('addons/certificate/settings'); ?>"><?php echo get_phrase('certificate_settings'); ?></a>
                    </li>
                <?php endif; ?>
                <?php if (addon_status('amazon-s3')) : ?>
                    <li class="<?php if ($page_name == 's3_settings') echo 'active'; ?>">
                        <a href="<?php echo site_url('addons/amazons3/settings'); ?>"><?php echo get_phrase('s3_settings'); ?></a>
                    </li>
                <?php endif; ?>
                <?php if (addon_status('live-class')) : ?>
                    <li class="<?php if ($page_name == 'live_class_settings') echo 'active'; ?>">
                        <a href="<?php echo site_url('addons/liveclass/settings'); ?>"><?php echo get_phrase('live_class_settings'); ?></a>
                    </li>
                <?php endif; ?>
                <li class="<?php if ($page_name == 'payment_settings') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/payment_settings'); ?>"><?php echo get_phrase('payment_settings'); ?></a>
                </li>
                <li class="<?php if ($page_name == 'manage_language') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/manage_language'); ?>"><?php echo get_phrase('language_settings'); ?></a>
                </li>
                <li class="<?php if ($page_name == 'manage_level') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/manage_level'); ?>"><?php echo get_phrase('level_settings'); ?></a>
                </li>
                <li class="<?php if ($page_name == 'smtp_settings') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/smtp_settings'); ?>"><?php echo get_phrase('smtp_settings'); ?></a>
                </li>
                <li class="<?php if ($page_name == 'theme_settings') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/theme_settings'); ?>"><?php echo get_phrase('theme_settings'); ?></a>
                </li>
                <li class="<?php if ($page_name == 'about') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/about'); ?>"><?php echo get_phrase('about'); ?></a>
                </li>
                <li class="<?php if ($page_name == 'add_branch') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/branch'); ?>"><?php echo get_phrase('branch_location'); ?></a>
                </li>

               
            </ul>
        </li>


        <li class="side-nav-item <?php if ($page_name == 'sales_persons' || $page_name == 'sales_person_add' || $page_name == 'sales_person_edit') echo 'active'; ?>">
            <a href="<?php echo site_url(strtolower($this->session->userdata('role')) . '/sales_persons'); ?>"
               class="side-nav-link">
                <i class="dripicons-user"></i>
                <span><?php echo get_phrase('sales_persons'); ?></span>
            </a>
        </li>

        <li class="side-nav-item <?php if ($page_name == 'manage_profile') echo 'active'; ?>">
            <a href="<?php echo site_url(strtolower($this->session->userdata('role')) . '/manage_profile'); ?>"
               class="side-nav-link">
                <i class="dripicons-user"></i>
                <span><?php echo get_phrase('manage_profile'); ?></span>
            </a>
        </li>

        <li class="side-nav-item  <?php if ($page_name == 'batch_model' || $page_name == 'batch_limit'  || $page_name == 'batch_limit_add') : ?> active <?php endif; ?>">
            <a href="javascript: void(0);" class="side-nav-link">
                <i class='dripicons-user-group'></i>
                <span> <?php echo get_phrase('Batch '); ?> </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
                <li class="<?php if ($page_name == 'batch_model') echo 'active'; ?>">
                <li class="<?php if ($page_name == 'batch_model') echo 'active'; ?>">
                    <a href="<?php echo site_url(strtolower($this->session->userdata('role')) . '/batch_model'); ?>">
<!--                        <i class="dripicons-user-group"></i>-->
                        <span><?php echo get_phrase('batch'); ?></span>
                    </a>                </li>
                <!--                <li class="--><?php //if ($page_name == 'blog') echo 'active'; ?><!--">-->
                <!--                    <a href="--><?php //echo site_url('admin/blog_form/add_form'); ?><!--">--><?php //echo get_phrase('blog'); ?><!--</a>-->
                <!--                </li>-->
                <li class="<?php if ($page_name == 'batch_limit') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/batch_limit'); ?>"><?php echo get_phrase('batch_limit'); ?></a>
                </li>
            </ul>
        </li>

<!--        <li class="side-nav-item --><?php //if ($page_name == 'batch_model') echo 'active'; ?><!--">-->
<!--            <a href="--><?php //echo site_url(strtolower($this->session->userdata('role')) . '/batch_model'); ?><!--"-->
<!--               class="side-nav-link">-->
<!--                <i class="dripicons-user-group"></i>-->
<!--                <span>--><?php //echo get_phrase('batch'); ?><!--</span>-->
<!--            </a>-->
<!--        </li>-->


        <li class="side-nav-item <?php if ($page_name == 'instructor_commission') echo 'active'; ?>">
            <a href="<?php echo site_url(strtolower($this->session->userdata('role')) . '/instructor_commission'); ?>"
               class="side-nav-link">
                <i class="fas fa-money-bill-wave"></i>
                <span><?php echo get_phrase('instructor_commission'); ?></span>
            </a>
        </li>

        <li class="side-nav-item <?php if ($page_name == 'payouts') echo 'active'; ?>">
            <a href="<?php echo site_url(strtolower($this->session->userdata('role')) . '/payouts'); ?>"
               class="side-nav-link">
                <i class="fas fa-money-bill"></i>
                <span><?php echo get_phrase('payouts'); ?></span>
            </a>
        </li>

        <li class="side-nav-item <?php if ($page_name == 'attendance') echo 'active'; ?>">
            <a href="<?php echo site_url(strtolower($this->session->userdata('role')) . '/attendance'); ?>"
               class="side-nav-link">
                <i class="fas fa-user-edit"></i>
                <span><?php echo get_phrase('attendance'); ?></span>
            </a>
        </li>


        <li class="side-nav-item  <?php if ($page_name == 'blog_category' || $page_name == 'blog_add') : ?> active <?php endif; ?>">
            <a href="javascript: void(0);" class="side-nav-link">
                <i class="mdi mdi-apple-keyboard-command"></i>
                <span> <?php echo get_phrase('blog'); ?> </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
                <li class="<?php if ($page_name == 'blog_category') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/blog_category'); ?>"><?php echo get_phrase('blog_category'); ?></a>
                </li>
<!--                <li class="--><?php //if ($page_name == 'blog') echo 'active'; ?><!--">-->
<!--                    <a href="--><?php //echo site_url('admin/blog_form/add_form'); ?><!--">--><?php //echo get_phrase('blog'); ?><!--</a>-->
<!--                </li>-->
                <li class="<?php if ($page_name == 'blog_add') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/blog'); ?>"><?php echo get_phrase('blog'); ?></a>
                </li>
            </ul>
        </li>

        <li class="side-nav-item  <?php if ($page_name == 'testimonial' || $page_name == 'testimonial_category') : ?> active <?php endif; ?>">
            <a href="javascript: void(0);" class="side-nav-link">
                <i class="fa fa-quote-left"></i>
                <span> <?php echo get_phrase('testimonial'); ?> </span>
                <span class="menu-arrow"></span>
            </a>
            <ul class="side-nav-second-level" aria-expanded="false">
                <li class="<?php if ($page_name == 'testimonial_category') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/testimonial_category'); ?>"><?php echo get_phrase('testimonial_category'); ?></a>
                </li>
<!--                <li class="--><?php //if ($page_name == 'blog') echo 'active'; ?><!--">-->
<!--                    <a href="--><?php //echo site_url('admin/blog_form/add_form'); ?><!--">--><?php //echo get_phrase('blog'); ?><!--</a>-->
<!--                </li>-->
                <li class="<?php if ($page_name == 'testimonial') echo 'active'; ?>">
                    <a href="<?php echo site_url('admin/testimonial'); ?>"><?php echo get_phrase('testimonial'); ?></a>
                </li>
            </ul>
        </li>

        <li class="side-nav-item <?php if ($page_name == 'course_review') echo 'active'; ?>">
            <a href="<?php echo site_url(strtolower($this->session->userdata('role')) . '/course_review'); ?>"
               class="side-nav-link">
                <i class="fas fa-book-open"></i>
                <span><?php echo get_phrase('course_review'); ?></span>
            </a>
        </li>

        <li class="side-nav-item <?php if ($page_name == 'transaction_history') echo 'active'; ?>">
            <a href="<?php echo site_url(strtolower($this->session->userdata('role')) . '/transaction_history'); ?>"
               class="side-nav-link">
                <i class="fa fa-history"></i>
                <span><?php echo get_phrase('transaction_history'); ?></span>
            </a>
        </li>
    </ul>
</div>