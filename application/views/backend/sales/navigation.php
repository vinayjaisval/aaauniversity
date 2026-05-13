<?php
$status_wise_courses = $this->crud_model->get_status_wise_courses();
?>
<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu left-side-menu-detached">
	<div class="leftbar-user">
		<a href="javascript: void(0);">
			<img src="<?php echo $this->user_model->get_user_image_url($this->session->userdata('user_id')); ?>" alt="user-image" height="42" class="rounded-circle shadow-sm">
			<?php
			$admin_details = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
			?>
			<span class="leftbar-user-name"><?php echo $admin_details['first_name'].' '.$admin_details['last_name']; ?></span>
		</a>
	</div>

	<!--- Sidemenu -->
	<ul class="metismenu side-nav side-nav-light">

		<li class="side-nav-title side-nav-item"><?php echo get_phrase('navigation'); ?></li>

		<li class="side-nav-item <?php if ($page_name == 'dashboard')echo 'active';?>">
			<a href="<?php echo site_url('sales/dashboard'); ?>" class="side-nav-link">
				<i class="dripicons-view-apps"></i>
				<span><?php echo get_phrase('dashboard'); ?></span>
			</a>
		</li>

		<!---
		<li class="side-nav-item">
			<a href="<?php echo site_url('sales/courses'); ?>" class="side-nav-link <?php if ($page_name == 'courses' || $page_name == 'course_add' || $page_name == 'course_edit')echo 'active';?>">
				<i class="dripicons-archive"></i>
				<span><?php echo get_phrase('courses'); ?></span>
			</a>
		</li>
		--->
		

		<li class="side-nav-item">
			<a href="<?php echo site_url('sales/users'); ?>" class="side-nav-link <?php if ($page_name == 'users' || $page_name == 'user_add' || $page_name == 'user_edit')echo 'active';?>">
				<i class="dripicons-user-group"></i>
				<span><?php echo get_phrase('students'); ?></span>
			</a>
		</li>

		<li class="side-nav-item <?php if ($page_name == 'enrol_history' || $page_name == 'enrol_student'): ?> active <?php endif; ?>">
			<a href="javascript: void(0);" class="side-nav-link <?php if ($page_name == 'enrol_history' || $page_name == 'enrol_student'): ?> active <?php endif; ?>">
				<i class="dripicons-network-3"></i>
				<span> <?php echo get_phrase('enrolment'); ?> </span>
				<span class="menu-arrow"></span>
			</a>
			<ul class="side-nav-second-level" aria-expanded="false">
				<li class = "<?php if($page_name == 'enrol_history') echo 'active'; ?>">
					<a href="<?php echo site_url('sales/enrol_history'); ?>"><?php echo get_phrase('enrol_history'); ?></a>
				</li>

				<li class = "<?php if($page_name == 'enrol_student') echo 'active'; ?>">
					<a href="<?php echo site_url('sales/enrol_student'); ?>"><?php echo get_phrase('enrol_a_student'); ?></a>
				</li>
			</ul>
		</li>

		
		<li class="side-nav-item <?php if ($page_name == 'manage_profile')echo 'active';?>">
			<a href="<?php echo site_url(strtolower($this->session->userdata('role')).'/manage_profile'); ?>" class="side-nav-link">
				<i class="dripicons-user"></i>
				<span><?php echo get_phrase('manage_profile'); ?></span>
			</a>
		</li>
	</ul>
</div>
