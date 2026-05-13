<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->library('session');
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        if (!$this->session->userdata('cart_items')) {
            $this->session->set_userdata('cart_items', array());
        }
    }

    public function index() {
        if ($this->session->userdata('sales_login') == true) {
            $this->dashboard();
        }else {
            redirect(site_url('login'), 'refresh');
        }
    }
    public function dashboard() {
        
        if ($this->session->userdata('sales_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('dashboard');
        $this->load->view('backend/index.php', $page_data);
    }

    public function blank_template() {
        if ($this->session->userdata('sales_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        $page_data['page_name'] = 'blank_template';
        $this->load->view('backend/index.php', $page_data);
    }

    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('sales_login') != 1)
        redirect(site_url('login'), 'refresh');
        if ($param1 == 'update_profile_info') {
            $this->user_model->edit_user($param2);
            redirect(site_url('sales/manage_profile'), 'refresh');
        }
        if ($param1 == 'change_password') {
            $this->user_model->change_password($param2);
            redirect(site_url('sales/manage_profile'), 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('users', array(
            'id' => $this->session->userdata('user_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }

    public function users($param1 = "", $param2 = "") {
        if ($this->session->userdata('sales_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
       
        if ($param1 == "add") {
            $this->user_model->add_user();
            redirect(site_url('sales/users'), 'refresh');
        }
        elseif ($param1 == "edit") {
            $this->user_model->edit_user($param2);
            redirect(site_url('sales/users'), 'refresh');
        }
        elseif ($param1 == "delete") {
            $this->user_model->delete_user($param2);
            redirect(site_url('sales/users'), 'refresh');
        }

        $sales_person_id = $this->input->get('sales_person_id');

        $page_data['page_name'] = 'users';
        $page_data['page_title'] = get_phrase('student');
        $page_data['users'] = $this->user_model->get_user($param2, $sales_person_id);
        $this->load->view('backend/index', $page_data);
    }

    public function add_shortcut_student(){
        if ($this->session->userdata('sales_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        $is_instructor = 0;
        echo $this->user_model->add_shortcut_user($is_instructor);
    }

    public function user_form($param1 = "", $param2 = "") {
        if ($this->session->userdata('sales_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        if ($param1 == 'add_user_form') {
            $page_data['page_name'] = 'user_add';
            $page_data['page_title'] = get_phrase('student_add');
            $this->load->view('backend/index', $page_data);
        }
        elseif ($param1 == 'edit_user_form') {
            $page_data['page_name'] = 'user_edit';
            $page_data['user_id'] = $param2;
            $page_data['page_title'] = get_phrase('student_edit');
            $this->load->view('backend/index', $page_data);
        }
    }

    public function enrol_history($param1 = "") {
        if ($this->session->userdata('sales_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        if ($param1 != "") {
            $date_range                   = $this->input->get('date_range');
            $date_range                   = explode(" - ", $date_range);
            $page_data['timestamp_start'] = strtotime($date_range[0]);
            $page_data['timestamp_end']   = strtotime($date_range[1]);
        }else {
            $first_day_of_month = "1 ".date("M")." ".date("Y").' 00:00:00';
            $last_day_of_month = date("t")." ".date("M")." ".date("Y").' 23:59:59';
            $page_data['timestamp_start']   = strtotime($first_day_of_month);
            $page_data['timestamp_end']     = strtotime($last_day_of_month);
        }
        $page_data['page_name'] = 'enrol_history';
        $page_data['enrol_history'] = $this->crud_model->enrol_history_by_date_range($page_data['timestamp_start'], $page_data['timestamp_end']);
        $page_data['page_title'] = get_phrase('enrol_history');
        $this->load->view('backend/index', $page_data);
    }

    public function enrol_student($param1 = "") {
        if ($this->session->userdata('sales_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        if ($param1 == 'enrol') {
            $this->crud_model->enrol_a_student_manually();
            redirect(site_url('sales/enrol_history'), 'refresh');
        }
        $page_data['page_name'] = 'enrol_student';
        $page_data['page_title'] = get_phrase('enrol_a_student');
        $this->load->view('backend/index', $page_data);
    }

    public function shortcut_enrol_student() {
        if ($this->session->userdata('sales_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        echo $this->crud_model->shortcut_enrol_a_student_manually();
    }


    public function courses() {
        
        if ($this->session->userdata('sales_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        $page_data['selected_category_id']   = isset($_GET['category_id']) ? $_GET['category_id'] : "all";
        $page_data['selected_instructor_id'] = isset($_GET['instructor_id']) ? $_GET['instructor_id'] : "all";
        $page_data['selected_price']         = isset($_GET['price']) ? $_GET['price'] : "all";
        $page_data['selected_status']        = isset($_GET['status']) ? $_GET['status'] : "all";

        // Courses query is used for deciding if there is any course or not. Check the view you will get it
        $page_data['courses']                = $this->crud_model->filter_course_for_backend($page_data['selected_category_id'], $page_data['selected_instructor_id'], $page_data['selected_price'], $page_data['selected_status']);
        $page_data['status_wise_courses']    = $this->crud_model->get_status_wise_courses();
        $page_data['instructors']            = $this->user_model->get_instructor()->result_array();
        $page_data['page_name']              = 'courses-server-side';
        $page_data['categories']             = $this->crud_model->get_categories();
        $page_data['page_title']             = get_phrase('active_courses');
        $this->load->view('backend/index', $page_data);
    }

    // This function is responsible for loading the course data from server side for datatable SILENTLY
    public function get_courses() {
        if ($this->session->userdata('sales_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        $courses = array();
        // Filter portion
        $filter_data['selected_category_id']   = $this->input->post('selected_category_id');
        $filter_data['selected_instructor_id'] = $this->input->post('selected_instructor_id');
        $filter_data['selected_price']         = $this->input->post('selected_price');
        $filter_data['selected_status']        = $this->input->post('selected_status');

        // Server side processing portion
        $columns = array(
            0 => '#',
            1 => 'title',
            2 => 'category',
            3 => 'lesson_and_section',
            4 => 'enrolled_student',
            5 => 'status',
            6 => 'price',
            7 => 'actions',
            8 => 'course_id'
        );

        // Coming from databale itself. Limit is the visible number of data
        $limit = html_escape($this->input->post('length'));
        $start = html_escape($this->input->post('start'));
        $order = "";
        $dir   = $this->input->post('order')[0]['dir'];

        $totalData = $this->lazyload->count_all_courses($filter_data);
        $totalFiltered = $totalData;

        // This block of code is handling the search event of datatable
        if(empty($this->input->post('search')['value'])) {
            $courses = $this->lazyload->courses($limit, $start, $order, $dir, $filter_data);
        }
        else {
            $search = $this->input->post('search')['value'];
            $courses =  $this->lazyload->course_search($limit, $start, $search, $order, $dir, $filter_data);
            $totalFiltered = $this->lazyload->course_search_count($search);
        }

        // Fetch the data and make it as JSON format and return it.
        $data = array();
        if(!empty($courses)) {
            foreach ($courses as $key => $row) {
                $instructor_details = $this->user_model->get_all_user($row->user_id)->row_array();
                $category_details = $this->crud_model->get_category_details_by_id($row->sub_category_id)->row_array();
                $sections = $this->crud_model->get_section('course', $row->id);
                $lessons = $this->crud_model->get_lessons('course', $row->id);
                $enroll_history = $this->crud_model->enrol_history($row->id);

                $status_badge = "badge-success-lighten";
                if ($row->status == 'pending') {
                    $status_badge = "badge-danger-lighten";
                }elseif ($row->status == 'draft') {
                    $status_badge = "badge-dark-lighten";
                }

                $price_badge = "badge-dark-lighten";
                $price = 0;
                if ($row->is_free_course == null){
                    if ($row->discount_flag == 1) {
                        $price = currency($row->discounted_price);
                    }else{
                        $price = currency($row->price);
                    }
                }elseif ($row->is_free_course == 1){
                    $price_badge = "badge-success-lighten";
                    $price = get_phrase('free');
                }

                $view_course_on_frontend_url = site_url('home/course/'.rawurlencode(slugify($row->title)).'/'.$row->id);
                $edit_this_course_url = site_url('sales/course_form/course_edit/'.$row->id);
                $section_and_lesson_url = site_url('sales/course_form/course_edit/'.$row->id);

                if ($row->status == 'active') {
                    $course_status_changing_message = get_phrase('mark_as_pending');
                    if ($row->user_id != $this->session->userdata('user_id')) {
                        $course_status_changing_action = "showAjaxModal('".site_url('modal/popup/mail_on_course_status_changing_modal/pending/'.$row->id.'/'.$filter_data['selected_category_id'].'/'.$filter_data['selected_instructor_id'].'/'.$filter_data['selected_price'].'/'.$filter_data['selected_status'])."', '".$course_status_changing_message."')";
                    }else{
                        $course_status_changing_action = "confirm_modal('".site_url('sales/change_course_status_for_sales/pending/'.$row->id.'/'.$filter_data['selected_category_id'].'/'.$filter_data['selected_instructor_id'].'/'.$filter_data['selected_price'].'/'.$filter_data['selected_status'])."')";
                    }
                }else{
                    $course_status_changing_message = get_phrase('mark_as_active');
                    if ($row->user_id != $this->session->userdata('user_id')) {
                        $course_status_changing_action = "showAjaxModal('".site_url('modal/popup/mail_on_course_status_changing_modal/active/'.$row->id.'/'.$filter_data['selected_category_id'].'/'.$filter_data['selected_instructor_id'].'/'.$filter_data['selected_price'].'/'.$filter_data['selected_status'])."', '".$course_status_changing_message."')";
                    }else{
                        $course_status_changing_action = "confirm_modal('".site_url('sales/change_course_status_for_sales/active/'.$row->id.'/'.$filter_data['selected_category_id'].'/'.$filter_data['selected_instructor_id'].'/'.$filter_data['selected_price'].'/'.$filter_data['selected_status'])."')";
                    }
                }



                $delete_course_url = "confirm_modal('".site_url('sales/course_actions/delete/'.$row->id)."')";
                
                if($row->course_type != 'scorm'){
                    $section_and_lesson_menu = '<li><a class="dropdown-item" href="'.$section_and_lesson_url.'">'.get_phrase("section_and_lesson").'</a></li>';
                }else{
                    $section_and_lesson_menu = "";
                }

                $action = '
                <div class="dropright dropright">
                <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="mdi mdi-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="'.$view_course_on_frontend_url.'" target="_blank">'.get_phrase("view_course_on_frontend").'</a></li>
                <li><a class="dropdown-item" href="'.$edit_this_course_url.'">'.get_phrase("edit_this_course").'</a></li>
                '.$section_and_lesson_menu.'
                <li><a class="dropdown-item" href="javascript::" onclick="'.$course_status_changing_action.'">'.$course_status_changing_message.'</a></li>
                
                </ul>
                </div>
                ';

                $nestedData['#'] = $key+1;

                $nestedData['title'] = '<strong><a href="'.site_url('sales/course_form/course_edit/'.$row->id).'">'.substr($row->title,0,15).'</a></strong><br>
                <small class="text-muted">'.get_phrase('instructor').': <b>'.$instructor_details['first_name'].' '.$instructor_details['last_name'].'</b></small>';

                $nestedData['category'] = '<span class="badge badge-dark-lighten">'.$category_details['name'].'</span>';

                if($row->course_type == 'scorm'){
                    $nestedData['lesson_and_section'] = '<span class="badge badge-info-lighten">'.get_phrase('scorm_course').'</span>';
                }elseif($row->course_type == 'general'){
                    $nestedData['lesson_and_section'] = '
                    <small class="text-muted"><b>'.get_phrase('total_section').'</b>: '.$sections->num_rows().'</small><br>
                    <small class="text-muted"><b>'.get_phrase('total_lesson').'</b>: '.$lessons->num_rows().'</small>';
                }

                $nestedData['enrolled_student'] = '<small class="text-muted"><b>'.get_phrase('total_enrolment').'</b>: '.$enroll_history->num_rows().'</small>';

                $nestedData['status'] = '<span class="badge '.$status_badge.'">'.get_phrase($row->status).'</span>';

                $nestedData['price'] = '<span class="badge '.$price_badge.'">'.$price.'</span>';

                $nestedData['actions'] = $action;

                $nestedData['course_id'] = $row->id;

                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    public function pending_courses() {
        if ($this->session->userdata('sales_login') != true) {
            redirect(site_url('login'), 'refresh');
        }


        $page_data['page_name'] = 'pending_courses';
        $page_data['page_title'] = get_phrase('pending_courses');
        $this->load->view('backend/index', $page_data);
    }

    public function course_actions($param1 = "", $param2 = "") {
        if ($this->session->userdata('sales_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        if ($param1 == "add") {
            $course_id = $this->crud_model->add_course();
            redirect(site_url('sales/course_form/course_edit/'.$course_id), 'refresh');

        }elseif($param1 == 'add_shortcut'){
            echo $this->crud_model->add_shortcut_course();
        }elseif ($param1 == "edit") {
            $this->crud_model->update_course($param2);

            // CHECK IF LIVE CLASS ADDON EXISTS, ADD OR UPDATE IT TO ADDON MODEL
            if (addon_status('live-class')) {
                $this->load->model('addons/Liveclass_model','liveclass_model');
                $this->liveclass_model->update_live_class($param2);
            }

            redirect(site_url('sales/courses'), 'refresh');
        }
        elseif ($param1 == 'delete') {
            $this->is_drafted_course($param2);
            $this->crud_model->delete_course($param2);
            redirect(site_url('sales/courses'), 'refresh');
        }
    }


    public function course_form($param1 = "", $param2 = "") {

        if ($this->session->userdata('sales_login') != true) {
            redirect(site_url('login'), 'refresh');
        }

        if ($param1 == 'add_course') {
            $page_data['languages'] = $this->crud_model->get_all_languages();
            $page_data['levels'] = $this->crud_model->get_all_levels();
            $page_data['categories'] = $this->crud_model->get_categories();
            $page_data['page_name'] = 'course_add';
            $page_data['page_title'] = get_phrase('add_course');
            $this->load->view('backend/index', $page_data);

        }elseif ($param1 == 'add_course_shortcut') {
            $page_data['languages'] = $this->crud_model->get_all_languages();
            $page_data['levels'] = $this->crud_model->get_all_levels();
            $page_data['categories'] = $this->crud_model->get_categories();
            $this->load->view('backend/sales/course_add_shortcut', $page_data);
        }elseif ($param1 == 'course_edit') {
            $this->is_drafted_course($param2);
            $page_data['page_name'] = 'course_edit';
            $page_data['course_id'] =  $param2;
            $page_data['page_title'] = get_phrase('edit_course');
            $page_data['languages'] = $this->crud_model->get_all_languages();
            $page_data['levels'] = $this->crud_model->get_all_levels();
            $page_data['categories'] = $this->crud_model->get_categories();
            $this->load->view('backend/index', $page_data);
        }
    }

    private function is_drafted_course($course_id){
        if ($this->session->userdata('sales_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
        if ($course_details['status'] == 'draft') {
            $this->session->set_flashdata('error_message', get_phrase('you_do_not_have_right_to_access_this_course'));
            redirect(site_url('sales/courses'), 'refresh');
        }
    }

    public function change_course_status($updated_status = "") {
        if ($this->session->userdata('sales_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        $course_id = $this->input->post('course_id');
        $category_id = $this->input->post('category_id');
        $instructor_id = $this->input->post('instructor_id');
        $price = $this->input->post('price');
        $status = $this->input->post('status');
        if (isset($_POST['mail_subject']) && isset($_POST['mail_body'])) {
            $mail_subject = $this->input->post('mail_subject');
            $mail_body = $this->input->post('mail_body');
            $this->email_model->send_mail_on_course_status_changing($course_id, $mail_subject, $mail_body);
        }
        $this->crud_model->change_course_status($updated_status, $course_id);
        $this->session->set_flashdata('flash_message', get_phrase('course_status_updated'));
        redirect(site_url('sales/courses?category_id='.$category_id.'&status='.$status.'&instructor_id='.$instructor_id.'&price='.$price), 'refresh');
    }

    public function change_course_status_for_sales($updated_status = "", $course_id = "", $category_id = "", $status = "", $instructor_id = "", $price = "") {
        if ($this->session->userdata('sales_login') != true) {
            redirect(site_url('login'), 'refresh');
        }
        $this->crud_model->change_course_status($updated_status, $course_id);
        $this->session->set_flashdata('flash_message', get_phrase('course_status_updated'));
        redirect(site_url('sales/courses?category_id='.$category_id.'&status='.$status.'&instructor_id='.$instructor_id.'&price='.$price), 'refresh');
    }

    // AJAX PORTION
    // this function is responsible for managing multiple choice question
    function manage_multiple_choices_options() {
        $page_data['number_of_options'] = $this->input->post('number_of_options');
        $this->load->view('backend/sales/manage_multiple_choices_options', $page_data);
    }

    public function ajax_get_sub_category($category_id) {
        $page_data['sub_categories'] = $this->crud_model->get_sub_categories($category_id);

        return $this->load->view('backend/sales/ajax_get_sub_category', $page_data);
    }

    public function ajax_get_section($course_id){
        $page_data['sections'] = $this->crud_model->get_section('course', $course_id)->result_array();
        return $this->load->view('backend/sales/ajax_get_section', $page_data);
    }

    public function ajax_get_video_details() {
        $video_details = $this->video_model->getVideoDetails($_POST['video_url']);
        echo $video_details['duration'];
    }
    public function ajax_sort_section() {
        $section_json = $this->input->post('itemJSON');
        $this->crud_model->sort_section($section_json);
    }
    public function ajax_sort_lesson() {
        $lesson_json = $this->input->post('itemJSON');
        $this->crud_model->sort_lesson($lesson_json);
    }
    public function ajax_sort_question() {
        $question_json = $this->input->post('itemJSON');
        $this->crud_model->sort_question($question_json);
    }

    
}
