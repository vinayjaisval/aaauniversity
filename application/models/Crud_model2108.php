<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (file_exists("application/aws-module/aws-autoloader.php")) {
    include APPPATH . 'aws-module/aws-autoloader.php';
}

class Crud_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function get_categories($param1 = "")
    {
        if ($param1 != "") {
            $this->db->where('id', $param1);
        }
        $this->db->where('parent', 0);
        //  $this->db->order_by('id',"desc");
        // $this->db->limit(5);
        return $this->db->get('category');
        //  print_r($this->db->last_query());die;
    }
    
      public function get_categorie($param1 = "")
    {
        if ($param1 != "") {
            $this->db->where('id', $param1);
        }
        $this->db->where('parent', 0);
        $this->db->order_by('id',"desc");
        $this->db->limit(5);
       
        return $this->db->get('category');
        //  print_r($this->db->last_query());die;
    }

    public function get_category_details_by_id($id)
    {
        return $this->db->get_where('category', array('id' => $id));
    }

    public function get_category_id($slug = "")
    {
        $category_details = $this->db->get_where('category', array('slug' => $slug))->row_array();
        return $category_details['id'];
    }

    public function add_category()
    {
        $data['code'] = html_escape($this->input->post('code'));
        $data['name'] = html_escape($this->input->post('name'));
        $data['parent'] = html_escape($this->input->post('parent'));
        $data['slug'] = slugify(html_escape($this->input->post('name')));

        // CHECK IF THE CATEGORY NAME ALREADY EXISTS
        $this->db->where('name', $data['name']);
        $this->db->or_where('slug', $data['slug']);
        $previous_data = $this->db->get('category')->num_rows();

        if ($previous_data == 0) {
            if ($this->input->post('parent') == 0) {
                // Font awesome class adding
                if ($_POST['font_awesome_class'] != "") {
                    $data['font_awesome_class'] = html_escape($this->input->post('font_awesome_class'));
                } else {
                    $data['font_awesome_class'] = 'fas fa-chess';
                }

                // category thumbnail adding
                if (!file_exists('uploads/thumbnails/category_thumbnails')) {
                    mkdir('uploads/thumbnails/category_thumbnails', 0777, true);
                }
                if ($_FILES['category_thumbnail']['name'] == "") {
                    $data['thumbnail'] = 'category-thumbnail.png';
                } else {
                    $data['thumbnail'] = md5(rand(10000000, 20000000)) . '.jpg';
                    move_uploaded_file($_FILES['category_thumbnail']['tmp_name'], 'uploads/thumbnails/category_thumbnails/' . $data['thumbnail']);
                }
            }
            $data['date_added'] = strtotime(date('D, d-M-Y'));
            $this->db->insert('category', $data);
            return true;
        }

        return false;
    }

    public function edit_category($param1)
    {
        $data['name'] = html_escape($this->input->post('name'));
        $data['parent'] = html_escape($this->input->post('parent'));
        $data['slug'] = slugify(html_escape($this->input->post('name')));

        // CHECK IF THE CATEGORY NAME ALREADY EXISTS
        $this->db->where('name', $data['name']);
        $this->db->or_where('slug', $data['slug']);
        $previous_data = $this->db->get('category')->result_array();

        $checker = true;
        foreach ($previous_data as $row) {
            if ($row['id'] != $param1) {
                $checker = false;
                break;
            }
        }

        if ($checker) {
            if ($this->input->post('parent') == 0) {
                // Font awesome class adding
                if ($_POST['font_awesome_class'] != "") {
                    $data['font_awesome_class'] = html_escape($this->input->post('font_awesome_class'));
                } else {
                    $data['font_awesome_class'] = 'fas fa-chess';
                }
                // category thumbnail adding
                if (!file_exists('uploads/thumbnails/category_thumbnails')) {
                    mkdir('uploads/thumbnails/category_thumbnails', 0777, true);
                }
                if ($_FILES['category_thumbnail']['name'] != "") {
                    $data['thumbnail'] = md5(rand(10000000, 20000000)) . '.jpg';
                    move_uploaded_file($_FILES['category_thumbnail']['tmp_name'], 'uploads/thumbnails/category_thumbnails/' . $data['thumbnail']);
                }
            }
            $data['last_modified'] = strtotime(date('D, d-M-Y'));
            $this->db->where('id', $param1);
            $this->db->update('category', $data);

            return true;
        }
        return false;
    }

    public function delete_category($category_id)
    {
        $this->db->where('id', $category_id);
        $this->db->delete('category');
    }

    public function get_sub_categories($parent_id = "")
    {
        return $this->db->get_where('category', array('parent' => $parent_id))->result_array();
    }

    public function enrol_history($course_id = "")
    {
        if ($course_id > 0) {
            return $this->db->get_where('enrol', array('course_id' => $course_id));
        } else {
            return $this->db->get('enrol');
        }
    }

    public function enrol_history_by_user_id($user_id = "")
    {
        return $this->db->get_where('enrol', array('user_id' => $user_id));
    }

    public function all_enrolled_student()
    {
        $this->db->select('user_id');
        $this->db->distinct('user_id');
        return $this->db->get('enrol');
    }

    public function enrol_history_by_date_range($timestamp_start = "", $timestamp_end = "")
    {
        $this->db->order_by('created_at', 'desc');
        $this->db->where('date_added >=', $timestamp_start);
        $this->db->where('date_added <=', $timestamp_end);
        return $this->db->get('enrol');
    }

    public function get_revenue_by_user_type($timestamp_start = "", $timestamp_end = "", $revenue_type = "")
    {
        $course_ids = array();
        $courses = array();
        $admin_details = $this->user_model->get_admin_details()->row_array();
        if ($revenue_type == 'admin_revenue') {
            $this->db->where('date_added >=', $timestamp_start);
            $this->db->where('date_added <=', $timestamp_end);
        } elseif ($revenue_type == 'instructor_revenue') {
            $this->db->where('user_id !=', $admin_details['id']);
            $this->db->select('id');
            $courses = $this->db->get('course')->result_array();
            foreach ($courses as $course) {
                if (!in_array($course['id'], $course_ids)) {
                    array_push($course_ids, $course['id']);
                }
            }
            if (sizeof($course_ids)) {
                $this->db->where_in('course_id', $course_ids);
            } else {
                return array();
            }
        }

        $this->db->order_by('date_added', 'desc');
        return $this->db->get('payment')->result_array();
    }

    public function get_instructor_revenue($user_id = "", $timestamp_start = "", $timestamp_end = "")
    {
        $course_ids = array();
        $courses = array();

        if ($user_id > 0) {
            $this->db->where('user_id', $user_id);
        } else {
            $this->db->where('user_id', $this->session->userdata('user_id'));
        }

        $this->db->select('id');
        $courses = $this->db->get('course')->result_array();
        foreach ($courses as $course) {
            if (!in_array($course['id'], $course_ids)) {
                array_push($course_ids, $course['id']);
            }
        }
        if (sizeof($course_ids)) {
            $this->db->where_in('course_id', $course_ids);
        } else {
            return array();
        }

        // CHECK IF THE DATE RANGE IS SELECTED
        if (!empty($timestamp_start) && !empty($timestamp_end)) {
            $this->db->where('date_added >=', $timestamp_start);
            $this->db->where('date_added <=', $timestamp_end);
        }

        $this->db->order_by('date_added', 'desc');
        return $this->db->get('payment')->result_array();
    }

    public function delete_payment_history($param1)
    {
        $this->db->where('id', $param1);
        $this->db->delete('payment');
    }

    public function delete_enrol_history($param1)
    {
        $this->db->where('id', $param1);
        $enrol_data = $this->db->get('enrol')->row_object();

        $this->db->where('payment_id', $enrol_data->tr_num);
        $this->db->delete('payment_transaction');

        $this->db->where('tr_num', $enrol_data->tr_num);
        $this->db->delete('offline_payment');

        $this->db->where('id', $param1);
        $this->db->delete('enrol');
    }

    public function purchase_history($user_id)
    {
        if ($user_id > 0) {
            return $this->db->get_where('payment', array('user_id' => $user_id));
        } else {
            return $this->db->get('payment');
        }
    }

    public function get_payment_details_by_id($payment_id = "")
    {
        return $this->db->get_where('payment', array('id' => $payment_id))->row_array();
    }

    public function update_payout_status($payout_id = "", $payment_type = "")
    {
        $updater = array(
            'status' => 1,
            'payment_type' => $payment_type,
            'last_modified' => strtotime(date('D, d-M-Y'))
        );
        $this->db->where('id', $payout_id);
        $this->db->update('payout', $updater);
    }

    public function update_system_settings()
    {
        $data['value'] = html_escape($this->input->post('system_name'));
        $this->db->where('key', 'system_name');
        $this->db->update('settings', $data);

        $data['value'] = html_escape($this->input->post('system_title'));
        $this->db->where('key', 'system_title');
        $this->db->update('settings', $data);

        $data['value'] = html_escape($this->input->post('author'));
        $this->db->where('key', 'author');
        $this->db->update('settings', $data);

        $data['value'] = html_escape($this->input->post('slogan'));
        $this->db->where('key', 'slogan');
        $this->db->update('settings', $data);

        $data['value'] = html_escape($this->input->post('language'));
        $this->db->where('key', 'language');
        $this->db->update('settings', $data);

        $data['value'] = html_escape($this->input->post('text_align'));
        $this->db->where('key', 'text_align');
        $this->db->update('settings', $data);

        $data['value'] = html_escape($this->input->post('system_email'));
        $this->db->where('key', 'system_email');
        $this->db->update('settings', $data);

        $data['value'] = html_escape($this->input->post('address'));
        $this->db->where('key', 'address');
        $this->db->update('settings', $data);

        $data['value'] = html_escape($this->input->post('phone'));
        $this->db->where('key', 'phone');
        $this->db->update('settings', $data);

        $data['value'] = html_escape($this->input->post('youtube_api_key'));
        $this->db->where('key', 'youtube_api_key');
        $this->db->update('settings', $data);

        $data['value'] = html_escape($this->input->post('vimeo_api_key'));
        $this->db->where('key', 'vimeo_api_key');
        $this->db->update('settings', $data);

        $data['value'] = html_escape($this->input->post('purchase_code'));
        $this->db->where('key', 'purchase_code');
        $this->db->update('settings', $data);

        $data['value'] = html_escape($this->input->post('footer_text'));
        $this->db->where('key', 'footer_text');
        $this->db->update('settings', $data);

        $data['value'] = html_escape($this->input->post('footer_link'));
        $this->db->where('key', 'footer_link');
        $this->db->update('settings', $data);

        $data['value'] = html_escape($this->input->post('website_keywords'));
        $this->db->where('key', 'website_keywords');
        $this->db->update('settings', $data);

        $data['value'] = html_escape($this->input->post('website_description'));
        $this->db->where('key', 'website_description');
        $this->db->update('settings', $data);

        $data['value'] = html_escape($this->input->post('student_email_verification'));
        $this->db->where('key', 'student_email_verification');
        $this->db->update('settings', $data);
    }

    public function update_smtp_settings()
    {
        $data['value'] = html_escape($this->input->post('protocol'));
        $this->db->where('key', 'protocol');
        $this->db->update('settings', $data);

        $data['value'] = html_escape($this->input->post('smtp_host'));
        $this->db->where('key', 'smtp_host');
        $this->db->update('settings', $data);

        $data['value'] = html_escape($this->input->post('smtp_port'));
        $this->db->where('key', 'smtp_port');
        $this->db->update('settings', $data);

        $data['value'] = html_escape($this->input->post('smtp_user'));
        $this->db->where('key', 'smtp_user');
        $this->db->update('settings', $data);

        $data['value'] = html_escape($this->input->post('smtp_pass'));
        $this->db->where('key', 'smtp_pass');
        $this->db->update('settings', $data);
    }

    public function update_paypal_settings()
    {
        // update paypal keys
        $paypal_info = array();
        $paypal['active'] = $this->input->post('paypal_active');
        $paypal['mode'] = $this->input->post('paypal_mode');
        $paypal['sandbox_client_id'] = $this->input->post('sandbox_client_id');
        $paypal['sandbox_secret_key'] = $this->input->post('sandbox_secret_key');

        $paypal['production_client_id'] = $this->input->post('production_client_id');
        $paypal['production_secret_key'] = $this->input->post('production_secret_key');

        array_push($paypal_info, $paypal);

        $data['value'] = json_encode($paypal_info);
        $this->db->where('key', 'paypal');
        $this->db->update('settings', $data);

        $data['value'] = html_escape($this->input->post('paypal_currency'));
        $this->db->where('key', 'paypal_currency');
        $this->db->update('settings', $data);
    }

    public function update_stripe_settings()
    {
        // update stripe keys
        $stripe_info = array();

        $stripe['active'] = $this->input->post('stripe_active');
        $stripe['testmode'] = $this->input->post('testmode');
        $stripe['public_key'] = $this->input->post('public_key');
        $stripe['secret_key'] = $this->input->post('secret_key');
        $stripe['public_live_key'] = $this->input->post('public_live_key');
        $stripe['secret_live_key'] = $this->input->post('secret_live_key');

        array_push($stripe_info, $stripe);

        $data['value'] = json_encode($stripe_info);
        $this->db->where('key', 'stripe_keys');
        $this->db->update('settings', $data);

        $data['value'] = html_escape($this->input->post('stripe_currency'));
        $this->db->where('key', 'stripe_currency');
        $this->db->update('settings', $data);
    }

    public function update_system_currency()
    {
        $data['value'] = html_escape($this->input->post('system_currency'));
        $this->db->where('key', 'system_currency');
        $this->db->update('settings', $data);

        $data['value'] = html_escape($this->input->post('currency_position'));
        $this->db->where('key', 'currency_position');
        $this->db->update('settings', $data);
    }

    public function update_instructor_settings()
    {
        if (isset($_POST['allow_instructor'])) {
            $data['value'] = html_escape($this->input->post('allow_instructor'));
            $this->db->where('key', 'allow_instructor');
            $this->db->update('settings', $data);
        }

        if (isset($_POST['instructor_revenue'])) {
            $data['value'] = html_escape($this->input->post('instructor_revenue'));
            $this->db->where('key', 'instructor_revenue');
            $this->db->update('settings', $data);
        }

        if (isset($_POST['instructor_application_note'])) {
            $data['value'] = html_escape($this->input->post('instructor_application_note'));
            $this->db->where('key', 'instructor_application_note');
            $this->db->update('settings', $data);
        }
    }

    public function get_lessons($type = "", $id = "")
    {
        $this->db->order_by("order", "asc");
        if ($type == "course") {
            return $this->db->get_where('lesson', array('course_id' => $id));
        } elseif ($type == "section") {
            return $this->db->get_where('lesson', array('section_id' => $id));
        } elseif ($type == "lesson") {
            return $this->db->get_where('lesson', array('id' => $id));
        } else {
            return $this->db->get('lesson');
        }
    }

    public function add_course($param1 = "")
    {
        $outcomes = $this->trim_and_return_json($this->input->post('outcomes'));
        $requirements = $this->trim_and_return_json($this->input->post('requirements'));

        $data['course_type'] = html_escape($this->input->post('course_type'));
        $data['title'] = html_escape($this->input->post('title'));
        $data['short_description'] = html_escape($this->input->post('short_description'));
        $data['description'] = $this->input->post('description');
        $data['course_duration'] = $this->input->post('course_duration');

        $data['outcomes'] = $outcomes;
        $data['language'] = $this->input->post('language_made_in');
        $data['sub_category_id'] = $this->input->post('sub_category_id');
        $category_details = $this->get_category_details_by_id($this->input->post('sub_category_id'))->row_array();
        $data['category_id'] = $data['sub_category_id'];
        $data['requirements'] = $requirements;
        $data['price'] = $this->input->post('price');
        $data['discount_flag'] = $this->input->post('discount_flag');
        $data['discounted_price'] = $this->input->post('discounted_price');
        $data['level'] = $this->input->post('level');
        $data['is_free_course'] = $this->input->post('is_free_course');
        $data['video_url'] = html_escape($this->input->post('course_overview_url'));

        $data['thumbnail'] = $this->resize_image($_FILES['course_thumbnail']['name'], $_FILES['course_thumbnail']['tmp_name'], "thumbnails/course_thumbnails", 400, 400);

        if ($this->input->post('course_overview_url') != "") {
            $data['course_overview_provider'] = html_escape($this->input->post('course_overview_provider'));
        } else {
            $data['course_overview_provider'] = "";
        }

        $data['date_added'] = strtotime(date('D, d-M-Y'));
        $data['section'] = json_encode(array());
        $data['is_top_course'] = $this->input->post('is_top_course');
        $data['user_id'] = $this->session->userdata('user_id');
        $data['meta_description'] = $this->input->post('meta_description');
        $data['meta_keywords'] = $this->input->post('meta_keywords');
        $admin_details = $this->user_model->get_admin_details()->row_array();
        if ($admin_details['id'] == $data['user_id']) {
            $data['is_admin'] = 1;
        } else {
            $data['is_admin'] = 0;
        }
        if ($param1 == "save_to_draft") {
            $data['status'] = 'draft';
        } else {
            if ($this->session->userdata('admin_login')) {
                $data['status'] = 'active';
            } else {
                $data['status'] = 'pending';
            }
        }
        $this->db->insert('course', $data);

        $course_id = $this->db->insert_id();
        // Create folder if does not exist
        if (!file_exists('uploads/thumbnails/course_thumbnails')) {
            mkdir('uploads/thumbnails/course_thumbnails', 0777, true);
        }

        // Upload different number of images according to activated theme. Data is taking from the config.json file
        $course_media_files = themeConfiguration(get_frontend_settings('theme'), 'course_media_files');
        foreach ($course_media_files as $course_media => $size) {
            if ($_FILES[$course_media]['name'] != "") {
                move_uploaded_file($_FILES[$course_media]['tmp_name'], 'uploads/thumbnails/course_thumbnails/' . $course_media . '_' . get_frontend_settings('theme') . '_' . $course_id . '.jpg');
            }
        }

        if ($data['status'] == 'approved') {
            $this->session->set_flashdata('flash_message', get_phrase('course_added_successfully'));
        } elseif ($data['status'] == 'pending') {
            $this->session->set_flashdata('flash_message', get_phrase('course_added_successfully') . '. ' . get_phrase('please_wait_untill_Admin_approves_it'));
        } elseif ($data['status'] == 'draft') {
            $this->session->set_flashdata('flash_message', get_phrase('your_course_has_been_added_to_draft'));
        }

        $this->session->set_flashdata('flash_message', get_phrase('course_has_been_added_successfully'));
        return $course_id;
    }

    function add_shortcut_course($param1 = "")
    {
        $data['course_type'] = html_escape($this->input->post('course_type'));
        $data['title'] = html_escape($this->input->post('title'));
        $data['outcomes'] = '[]';
        $data['language'] = $this->input->post('language_made_in');
        $data['sub_category_id'] = $this->input->post('sub_category_id');
        $category_details = $this->get_category_details_by_id($this->input->post('sub_category_id'))->row_array();
        $data['category_id'] = $category_details['parent'];

        $data['requirements'] = '[]';
        $data['price'] = $this->input->post('price');
        $data['discount_flag'] = $this->input->post('discount_flag');
        $data['discounted_price'] = $this->input->post('discounted_price');
        $data['level'] = $this->input->post('level');
        $data['is_free_course'] = $this->input->post('is_free_course');

        $data['date_added'] = strtotime(date('D, d-M-Y'));
        $data['section'] = json_encode(array());

        $data['user_id'] = $this->session->userdata('user_id');

        $admin_details = $this->user_model->get_admin_details()->row_array();
        if ($admin_details['id'] == $data['user_id']) {
            $data['is_admin'] = 1;
        } else {
            $data['is_admin'] = 0;
        }
        if ($param1 == "save_to_draft") {
            $data['status'] = 'draft';
        } else {
            if ($this->session->userdata('admin_login')) {
                $data['status'] = 'active';
            } else {
                $data['status'] = 'pending';
            }
        }
        if ($data['is_free_course'] == 1 || $data['is_free_course'] != 1 && $data['price'] > 0 && $data['discount_flag'] != 1 || $data['discount_flag'] == 1 && $data['discounted_price'] > 0) {
            $this->db->insert('course', $data);

            $this->session->set_flashdata('flash_message', get_phrase('course_has_been_added_successfully'));

            $response['status'] = 1;
            return json_encode($response);
        } else {
            $response['status'] = 0;
            $response['message'] = get_phrase('please_fill_up_the_price_field');
            return json_encode($response);
        }
    }

    function trim_and_return_json($untrimmed_array)
    {
        $trimmed_array = array();
        if (sizeof($untrimmed_array) > 0) {
            foreach ($untrimmed_array as $row) {
                if ($row != "") {
                    array_push($trimmed_array, $row);
                }
            }
        }
        return json_encode($trimmed_array);
    }

    public function update_course($course_id, $type = "")
    {
        $course_details = $this->get_course_by_id($course_id)->row_array();


        $outcomes = $this->trim_and_return_json($this->input->post('outcomes'));
        $requirements = $this->trim_and_return_json($this->input->post('requirements'));
        $data['title'] = $this->input->post('title');
        $data['short_description'] = html_escape($this->input->post('short_description'));
        $data['description'] = $this->input->post('description');
        $data['course_duration'] = $this->input->post('course_duration');

        $data['outcomes'] = $outcomes;
        $data['language'] = $this->input->post('language_made_in');
        $data['sub_category_id'] = $this->input->post('sub_category_id');
        $category_details = $this->get_category_details_by_id($this->input->post('sub_category_id'))->row_array();
        $data['category_id'] = $data['sub_category_id'];
        $data['requirements'] = $requirements;
        $data['is_free_course'] = $this->input->post('is_free_course');
        $data['price'] = $this->input->post('price');
        $data['discount_flag'] = $this->input->post('discount_flag');
        $data['discounted_price'] = $this->input->post('discounted_price');
        $data['level'] = $this->input->post('level');
        $data['video_url'] = $this->input->post('course_overview_url');


        $old_img = $this->input->post('course_thumbnail_old');

        if ($_FILES['course_thumbnail']['name'] != "") {
            if (file_exists('uploads/thumbnails/course_thumbnails/' . $old_img)) {
                unlink('uploads/thumbnails/course_thumbnails/' . $old_img);
            }
            $data['thumbnail'] = $this->resize_image($_FILES['course_thumbnail']['name'], $_FILES['course_thumbnail']['tmp_name'], "thumbnails/course_thumbnails", 400, 300);
        } else {
            $data['thumbnail'] = $old_img;
        }


        $data['user_id'] = $this->input->post('new_instructor');

        if ($this->input->post('course_overview_url') != "") {
            $data['course_overview_provider'] = html_escape($this->input->post('course_overview_provider'));
        } else {
            $data['course_overview_provider'] = "";
        }

        if ($this->input->post('new_instructor')) {
            $data['user_id'];
        } else {
            $value = '';
            $data['user_id'] = $this->input->post('new_instructors');

            // print_r($data['user_id']);
            // die;

            for ($i = 0; $i < count($data['user_id']); $i++) {
                $value = $value . strval($data['user_id'][$i]) . ',';
            }

            if ($value == '') {
                $data['user_id'] = $_SESSION['user_id'];
            } else {
                $data['user_id'] = $value;
            }
        }

//         print_r($data['user_id']);
//         die;

        $data['meta_description'] = $this->input->post('meta_description');
        $data['meta_keywords'] = $this->input->post('meta_keywords');
        $data['last_modified'] = strtotime(date('D, d-M-Y'));

        if ($this->input->post('is_top_course') != 1) {
            $data['is_top_course'] = 0;
        } else {
            $data['is_top_course'] = 1;
        }


        if ($type == "save_to_draft") {
            $data['status'] = 'draft';
        } else {
            if ($this->session->userdata('admin_login')) {
                $data['status'] = 'active';
            } else {
                $data['status'] = $course_details['status'];
            }
        }
        $this->db->where('id', $course_id);
        $this->db->update('course', $data);

        // Upload different number of images according to activated theme. Data is taking from the config.json file
        $course_media_files = themeConfiguration(get_frontend_settings('theme'), 'course_media_files');
        foreach ($course_media_files as $course_media => $size) {
            if ($_FILES[$course_media]['name']) {
                if (file_exists('uploads/thumbnails/course_thumbnails/' . $course_media . '_' . get_frontend_settings('theme') . '_' . $course_id . '.jpg')) {
                    unlink('uploads/thumbnails/course_thumbnails/' . $course_media . '_' . get_frontend_settings('theme') . '_' . $course_id . '.jpg');
                }
                move_uploaded_file($_FILES[$course_media]['tmp_name'], 'uploads/thumbnails/course_thumbnails/' . $course_media . '_' . get_frontend_settings('theme') . '_' . $course_id . '.jpg');
            }
        }

        if ($data['status'] == 'active') {
            $this->session->set_flashdata('flash_message', get_phrase('course_updated_successfully'));
        } elseif ($data['status'] == 'pending') {
            $this->session->set_flashdata('flash_message', get_phrase('course_updated_successfully') . '. ' . get_phrase('please_wait_untill_Admin_approves_it'));
        } elseif ($data['status'] == 'draft') {
            $this->session->set_flashdata('flash_message', get_phrase('your_course_has_been_added_to_draft'));
        }
    }

    public function change_course_status($status = "", $course_id = "")
    {
        if ($status == 'active') {
            if ($this->session->userdata('admin_login') != true) {
                redirect(site_url('login'), 'refresh');
            }
        }
        $updater = array(
            'status' => $status
        );
        $this->db->where('id', $course_id);
        $this->db->update('course', $updater);
    }

    public function get_course_thumbnail_url($course_id, $type = 'course_thumbnail')
    {
        // Course media placeholder is coming from the theme config file. Which has all the placehoder for different images. Choose like course type.
        $course_media_placeholders = themeConfiguration(get_frontend_settings('theme'), 'course_media_placeholders');
        // if (file_exists('uploads/thumbnails/course_thumbnails/'.$type.'_'.get_frontend_settings('theme').'_'.$course_id.'.jpg')){
        //     return base_url().'uploads/thumbnails/course_thumbnails/'.$type.'_'.get_frontend_settings('theme').'_'.$course_id.'.jpg';
        // } elseif(file_exists('uploads/thumbnails/course_thumbnails/'.$course_id.'.jpg')){
        //     return base_url().'uploads/thumbnails/course_thumbnails/'.$course_id.'.jpg';
        // } else{
        //     return $course_media_placeholders[$type.'_placeholder'];
        // }

        /*********** Old Code For Course Thumbnails chanchal comment *************/

//        if (file_exists('uploads/thumbnails/course_thumbnails/' . $type . '_' . get_frontend_settings('theme') . '_' . $course_id . '.jpg')) {
//            return base_url() . 'uploads/thumbnails/course_thumbnails/' . $type . '_' . get_frontend_settings('theme') . '_' . $course_id . '.jpg';
//        } else {
//            return base_url() . $course_media_placeholders[$type . '_placeholder'];
//        }

        /*********** New Code For Course Thumbnails chanchal *************/

        if (file_exists('uploads/thumbnails/course_thumbnails/' . $type . '_' . get_frontend_settings('theme') . '_' . $course_id . '.jpg')) {
            return base_url() . 'uploads/thumbnails/course_thumbnails/' . $type . '_' . get_frontend_settings('theme') . '_' . $course_id . '.jpg';
        } else {
            return base_url() . 'uploads/thumbnails/course_thumbnails/course-thumbnail.png';
        }

    }

    public function get_lesson_thumbnail_url($lesson_id)
    {

        if (file_exists('uploads/thumbnails/lesson_thumbnails/' . $lesson_id . '.jpg'))
            return base_url() . 'uploads/thumbnails/lesson_thumbnails/' . $lesson_id . '.jpg';
        else
            return base_url() . 'uploads/thumbnails/thumbnail.png';
    }

    public function get_my_courses_by_category_id($category_id)
    {
        $this->db->select('course_id');
        $course_lists_by_enrol = $this->db->get_where('enrol', array('user_id' => $this->session->userdata('user_id')))->result_array();
        $course_ids = array();
        foreach ($course_lists_by_enrol as $row) {
            if (!in_array($row['course_id'], $course_ids)) {
                array_push($course_ids, $row['course_id']);
            }
        }
        $this->db->where_in('id', $course_ids);
        $this->db->where('category_id', $category_id);
        return $this->db->get('course');
    }

    public function get_my_courses_by_search_string($search_string)
    {
        $this->db->select('course_id');
        $course_lists_by_enrol = $this->db->get_where('enrol', array('user_id' => $this->session->userdata('user_id')))->result_array();
        $course_ids = array();
        foreach ($course_lists_by_enrol as $row) {
            if (!in_array($row['course_id'], $course_ids)) {
                array_push($course_ids, $row['course_id']);
            }
        }
        $this->db->where_in('id', $course_ids);
        $this->db->like('title', $search_string);
        return $this->db->get('course');
    }

    public function get_courses_by_search_string($search_string)
    {
        $this->db->like('title', $search_string);
        $this->db->where('status', 'active');
        return $this->db->get('course');
    }


    public function get_course_by_id($course_id = "")
    {
        return $this->db->get_where('course', array('id' => $course_id));
    }

    public function delete_course($course_id)
    {
        $course_type = $this->get_course_by_id($course_id)->row('course_type');

        $this->db->where('id', $course_id);
        $this->db->delete('course');

        if ($course_type == 'general') {
            // DELETE ALL THE LESSONS OF THIS COURSE FROM LESSON TABLE
            $lesson_checker = array('course_id' => $course_id);
            $this->db->delete('lesson', $lesson_checker);

            // DELETE ALL THE section OF THIS COURSE FROM section TABLE
            $this->db->where('course_id', $course_id);
            $this->db->delete('section');
        } elseif ($course_type == 'scorm') {
            $this->load->model('addons/scorm_model');
            $scorm_query = $this->scorm_model->get_scorm_curriculum_by_course_id($course_id);

            $this->db->where('course_id', $course_id);
            $this->db->delete('scorm_curriculum');

            if ($scorm_query->num_rows() > 0) {
                //deleted previews course directory
                $this->scorm_model->deleteDir('uploads/scorm/courses/' . $scorm_query->row('identifier'));
            }
        }
    }

    public function get_top_courses()
    {
        if (addon_status('scorm_course')) {
            return $this->db->get_where('course', array('is_top_course' => 1, 'status' => 'active'));
        } else {
            return $this->db->get_where('course', array('is_top_course' => 1, 'status' => 'active', 'course_type' => 'general'));
        }
    }

    public function get_default_category_id()
    {
        $categories = $this->get_categories()->result_array();
        foreach ($categories as $category) {
            return $category['id'];
        }
    }

    public function get_courses_by_user_id($param1 = "")
    {
        $courses['draft'] = $this->db->get_where('course', array('user_id' => $param1, 'status' => 'draft'));
        $courses['pending'] = $this->db->get_where('course', array('user_id' => $param1, 'status' => 'pending'));
        $courses['active'] = $this->db->get_where('course', array('user_id' => $param1, 'status' => 'active'));
        return $courses;
    }

    public function get_status_wise_courses($status = "")
    {
        if (addon_status('scorm_course')) {
            if ($status != "") {
                $courses = $this->db->get_where('course', array('status' => $status));
            } else {
                $courses['draft'] = $this->db->get_where('course', array('status' => 'draft'));
                $courses['pending'] = $this->db->get_where('course', array('status' => 'pending'));
                $courses['active'] = $this->db->get_where('course', array('status' => 'active'));
            }
        } else {
            if ($status != "") {
                $courses = $this->db->get_where('course', array('status' => $status, 'course_type' => 'general'));
            } else {
                $courses['draft'] = $this->db->get_where('course', array('status' => 'draft', 'course_type' => 'general'));
                $courses['pending'] = $this->db->get_where('course', array('status' => 'pending', 'course_type' => 'general'));
                $courses['active'] = $this->db->get_where('course', array('status' => 'active', 'course_type' => 'general'));
            }
        }
        return $courses;
    }

    public function get_status_wise_courses_for_instructor($status = "")
    {
        if ($status != "") {
            $this->db->where('status', $status);
            $this->db->where('user_id', $this->session->userdata('user_id'));
            $courses = $this->db->get('course');
        } else {
            $this->db->where('status', 'draft');
            $this->db->where('user_id', $this->session->userdata('user_id'));
            $courses['draft'] = $this->db->get('course');

            $this->db->where('user_id', $this->session->userdata('user_id'));
            $this->db->where('status', 'draft');
            $courses['pending'] = $this->db->get('course');

            $this->db->where('status', 'draft');
            $this->db->where('user_id', $this->session->userdata('user_id'));
            $courses['active'] = $this->db->get_where('course');
        }
        return $courses;
    }

    public function get_default_sub_category_id($default_cateegory_id)
    {
        $sub_categories = $this->get_sub_categories($default_cateegory_id);
        foreach ($sub_categories as $sub_category) {
            return $sub_category['id'];
        }
    }

    public function get_instructor_wise_courses($instructor_id = "", $return_as = "")
    {
        $courses = $this->db->get_where('course', array('user_id' => $instructor_id));
        if ($return_as == 'simple_array') {
            $array = array();
            foreach ($courses->result_array() as $course) {
                if (!in_array($course['id'], $array)) {
                    array_push($array, $course['id']);
                }
            }
            return $array;
        } else {
            return $courses;
        }
    }

    public function get_instructor_wise_payment_history($instructor_id = "")
    {
        $courses = $this->get_instructor_wise_courses($instructor_id, 'simple_array');
        if (sizeof($courses) > 0) {
            $this->db->where_in('course_id', $courses);
            return $this->db->get('payment')->result_array();
        } else {
            return array();
        }
    }

    public function add_section($course_id)
    {
        $data['title'] = html_escape($this->input->post('title'));
        $data['course_id'] = $course_id;
        $this->db->insert('section', $data);
        $section_id = $this->db->insert_id();

        $course_details = $this->get_course_by_id($course_id)->row_array();
        $previous_sections = json_decode($course_details['section']);

        if (sizeof($previous_sections) > 0) {
            array_push($previous_sections, $section_id);
            $updater['section'] = json_encode($previous_sections);
            $this->db->where('id', $course_id);
            $this->db->update('course', $updater);
        } else {
            $previous_sections = array();
            array_push($previous_sections, $section_id);
            $updater['section'] = json_encode($previous_sections);
            $this->db->where('id', $course_id);
            $this->db->update('course', $updater);
        }
    }

    public function edit_section($section_id)
    {
        $data['title'] = $this->input->post('title');
        $this->db->where('id', $section_id);
        $this->db->update('section', $data);
    }

    public function delete_section($course_id, $section_id)
    {
        $this->db->where('id', $section_id);
        $this->db->delete('section');

        $this->db->where('section_id', $section_id);
        $this->db->delete('lesson');


        $course_details = $this->get_course_by_id($course_id)->row_array();
        $previous_sections = json_decode($course_details['section']);

        if (sizeof($previous_sections) > 0) {
            $new_section = array();
            for ($i = 0; $i < sizeof($previous_sections); $i++) {
                if ($previous_sections[$i] != $section_id) {
                    array_push($new_section, $previous_sections[$i]);
                }
            }
            $updater['section'] = json_encode($new_section);
            $this->db->where('id', $course_id);
            $this->db->update('course', $updater);
        }
    }

    public function get_section($type_by, $id)
    {
        $this->db->order_by("order", "asc");
        if ($type_by == 'course') {
            return $this->db->get_where('section', array('course_id' => $id));
        } elseif ($type_by == 'section') {
            return $this->db->get_where('section', array('id' => $id));
        }
    }

    public function serialize_section($course_id, $serialization)
    {
        $updater = array(
            'section' => $serialization
        );
        $this->db->where('id', $course_id);
        $this->db->update('course', $updater);
    }

    public function add_lesson()
    {
        $data['course_id'] = html_escape($this->input->post('course_id'));
        $data['title'] = html_escape($this->input->post('title'));
        $data['section_id'] = html_escape($this->input->post('section_id'));

        $lesson_type_array = explode('-', $this->input->post('lesson_type'));
        $lesson_type = $lesson_type_array[0];

        $attachment_type = $lesson_type_array[1];
        $data['attachment_type'] = $attachment_type;
        $data['lesson_type'] = $lesson_type;

        if ($lesson_type == 'video') {
            // This portion is for web application's video lesson
            $lesson_provider = $this->input->post('lesson_provider');
            if ($lesson_provider == 'youtube' || $lesson_provider == 'vimeo') {
                if ($this->input->post('video_url') == "" || $this->input->post('duration') == "") {
                    $this->session->set_flashdata('error_message', get_phrase('invalid_lesson_url_and_duration'));
                    redirect(site_url(strtolower($this->session->userdata('role')) . '/course_form/course_edit/' . $data['course_id']), 'refresh');
                }
                $data['video_url'] = html_escape($this->input->post('video_url'));

                $duration_formatter = explode(':', $this->input->post('duration'));
                $hour = sprintf('%02d', $duration_formatter[0]);
                $min = sprintf('%02d', $duration_formatter[1]);
                $sec = sprintf('%02d', $duration_formatter[2]);
                $data['duration'] = $hour . ':' . $min . ':' . $sec;

                $video_details = $this->video_model->getVideoDetails($data['video_url']);
                $data['video_type'] = $video_details['provider'];
            } elseif ($lesson_provider == 'html5') {
                if ($this->input->post('html5_video_url') == "" || $this->input->post('html5_duration') == "") {
                    $this->session->set_flashdata('error_message', get_phrase('invalid_lesson_url_and_duration'));
                    redirect(site_url(strtolower($this->session->userdata('role')) . '/course_form/course_edit/' . $data['course_id']), 'refresh');
                }
                $data['video_url'] = html_escape($this->input->post('html5_video_url'));
                $duration_formatter = explode(':', $this->input->post('html5_duration'));
                $hour = sprintf('%02d', $duration_formatter[0]);
                $min = sprintf('%02d', $duration_formatter[1]);
                $sec = sprintf('%02d', $duration_formatter[2]);
                $data['duration'] = $hour . ':' . $min . ':' . $sec;
                $data['video_type'] = 'html5';
            } else {
                $this->session->set_flashdata('error_message', get_phrase('invalid_lesson_provider'));
                redirect(site_url(strtolower($this->session->userdata('role')) . '/course_form/course_edit/' . $data['course_id']), 'refresh');
            }

            // This portion is for mobile application video lessons
            if ($this->input->post('html5_video_url_for_mobile_application') == "" || $this->input->post('html5_duration_for_mobile_application') == "") {
                $mobile_app_lesson_url = "https://www.html5rocks.com/en/tutorials/video/basics/devstories.webm";
                $mobile_app_lesson_duration = "00:01:10";
            } else {
                $mobile_app_lesson_url = $this->input->post('html5_video_url_for_mobile_application');
                $mobile_app_lesson_duration = $this->input->post('html5_duration_for_mobile_application');
            }
            $duration_for_mobile_application_formatter = explode(':', $mobile_app_lesson_duration);
            $hour = sprintf('%02d', $duration_for_mobile_application_formatter[0]);
            $min = sprintf('%02d', $duration_for_mobile_application_formatter[1]);
            $sec = sprintf('%02d', $duration_for_mobile_application_formatter[2]);
            $data['duration_for_mobile_application'] = $hour . ':' . $min . ':' . $sec;
            $data['video_type_for_mobile_application'] = 'html5';
            $data['video_url_for_mobile_application'] = $mobile_app_lesson_url;
        } elseif ($lesson_type == "s3") {
            // SET MAXIMUM EXECUTION TIME 600
            ini_set('max_execution_time', '600');

            $fileName = $_FILES['video_file_for_amazon_s3']['name'];
            $tmp = explode('.', $fileName);
            $fileExtension = strtoupper(end($tmp));

            $video_extensions = ['WEBM', 'MP4'];
            if (!in_array($fileExtension, $video_extensions)) {
                $this->session->set_flashdata('error_message', get_phrase('please_select_valid_video_file'));
                redirect(site_url(strtolower($this->session->userdata('role')) . '/course_form/course_edit/' . $data['course_id']), 'refresh');
            }

            if ($this->input->post('amazon_s3_duration') == "") {
                $this->session->set_flashdata('error_message', get_phrase('invalid_lesson_duration'));
                redirect(site_url(strtolower($this->session->userdata('role')) . '/course_form/course_edit/' . $data['course_id']), 'refresh');
            }

            $upload_loaction = get_settings('video_upload_location');
            $access_key = get_settings('amazon_s3_access_key');
            $secret_key = get_settings('amazon_s3_secret_key');
            $bucket = get_settings('amazon_s3_bucket_name');
            $region = get_settings('amazon_s3_region_name');

            $s3config = array(
                'region' => $region,
                'version' => 'latest',
                'credentials' => [
                    'key' => $access_key, //Put key here
                    'secret' => $secret_key // Put Secret here
                ]
            );


            $tmpfile = $_FILES['video_file_for_amazon_s3'];

            $s3 = new Aws\S3\S3Client($s3config);
            $key = str_replace(".", "-" . rand(1, 9999) . ".", $tmpfile['name']);

            $result = $s3->putObject([
                'Bucket' => $bucket,
                'Key' => $key,
                'SourceFile' => $tmpfile['tmp_name'],
                'ACL' => 'public-read'
            ]);

            $data['video_url'] = $result['ObjectURL'];
            $data['video_type'] = 'amazon';
            $data['lesson_type'] = 'video';
            $data['attachment_type'] = 'file';

            $duration_formatter = explode(':', $this->input->post('amazon_s3_duration'));
            $hour = sprintf('%02d', $duration_formatter[0]);
            $min = sprintf('%02d', $duration_formatter[1]);
            $sec = sprintf('%02d', $duration_formatter[2]);
            $data['duration'] = $hour . ':' . $min . ':' . $sec;

            $data['duration_for_mobile_application'] = $hour . ':' . $min . ':' . $sec;
            $data['video_type_for_mobile_application'] = "html5";
            $data['video_url_for_mobile_application'] = $result['ObjectURL'];
        } elseif ($lesson_type == "system") {
            // SET MAXIMUM EXECUTION TIME 600
            ini_set('max_execution_time', '600');

            $fileName = $_FILES['system_video_file']['name'];

            // CHECKING IF THE FILE IS AVAILABLE AND FILE SIZE IS VALID
            if (array_key_exists('system_video_file', $_FILES)) {
                if ($_FILES['system_video_file']['error'] !== UPLOAD_ERR_OK) {
                    $error_code = $_FILES['system_video_file']['error'];
                    $this->session->set_flashdata('error_message', phpFileUploadErrors($error_code));
                    redirect(site_url(strtolower($this->session->userdata('role')) . '/course_form/course_edit/' . $data['course_id']), 'refresh');
                }
            } else {
                $this->session->set_flashdata('error_message', get_phrase('please_select_valid_video_file'));
                redirect(site_url(strtolower($this->session->userdata('role')) . '/course_form/course_edit/' . $data['course_id']), 'refresh');
            };

            $tmp = explode('.', $fileName);
            $fileExtension = strtoupper(end($tmp));

            $video_extensions = ['WEBM', 'MP4'];

            if (!in_array($fileExtension, $video_extensions)) {
                $this->session->set_flashdata('error_message', get_phrase('please_select_valid_video_file'));
                redirect(site_url(strtolower($this->session->userdata('role')) . '/course_form/course_edit/' . $data['course_id']), 'refresh');
            }

            // custom random name of the video file
            $uploadable_video_file = md5(uniqid(rand(), true)) . '.' . strtolower($fileExtension);

            if ($this->input->post('system_video_file_duration') == "") {
                $this->session->set_flashdata('error_message', get_phrase('invalid_lesson_duration'));
                redirect(site_url(strtolower($this->session->userdata('role')) . '/course_form/course_edit/' . $data['course_id']), 'refresh');
            }


            $tmp_video_file = $_FILES['system_video_file']['tmp_name'];

            if (!file_exists('uploads/lesson_files/videos')) {
                mkdir('uploads/lesson_files/videos', 0777, true);
            }
            $video_file_path = 'uploads/lesson_files/videos/' . $uploadable_video_file;
            move_uploaded_file($tmp_video_file, $video_file_path);
            $data['video_url'] = site_url($video_file_path);
            $data['video_type'] = 'system';
            $data['lesson_type'] = 'video';
            $data['attachment_type'] = 'file';

            $duration_formatter = explode(':', $this->input->post('system_video_file_duration'));
            $hour = sprintf('%02d', $duration_formatter[0]);
            $min = sprintf('%02d', $duration_formatter[1]);
            $sec = sprintf('%02d', $duration_formatter[2]);
            $data['duration'] = $hour . ':' . $min . ':' . $sec;

            $data['duration_for_mobile_application'] = $hour . ':' . $min . ':' . $sec;
            $data['video_type_for_mobile_application'] = "html5";
            $data['video_url_for_mobile_application'] = site_url($video_file_path);
        } else {
            if ($attachment_type == 'iframe') {
                if (empty($this->input->post('iframe_source'))) {
                    $this->session->set_flashdata('error_message', get_phrase('invalid_source'));
                    redirect(site_url(strtolower($this->session->userdata('role')) . '/course_form/course_edit/' . $data['course_id']), 'refresh');
                }
                $data['attachment'] = $this->input->post('iframe_source');
            } else {
                if ($_FILES['attachment']['name'] == "") {
                    $this->session->set_flashdata('error_message', get_phrase('invalid_attachment'));
                    redirect(site_url(strtolower($this->session->userdata('role')) . '/course_form/course_edit/' . $data['course_id']), 'refresh');
                } else {
                    $fileName = $_FILES['attachment']['name'];
                    $tmp = explode('.', $fileName);
                    $fileExtension = end($tmp);
                    $uploadable_file = md5(uniqid(rand(), true)) . '.' . $fileExtension;
                    $data['attachment'] = $uploadable_file;

                    if (!file_exists('uploads/lesson_files')) {
                        mkdir('uploads/lesson_files', 0777, true);
                    }
                    move_uploaded_file($_FILES['attachment']['tmp_name'], 'uploads/lesson_files/' . $uploadable_file);
                }
            }
        }

        $data['date_added'] = strtotime(date('D, d-M-Y'));
        $data['summary'] = $this->input->post('summary');
        $data['video_type'] = ($lesson_provider == 'youtube') ? $lesson_provider : $data['video_type'];
        $this->db->insert('lesson', $data);
        $inserted_id = $this->db->insert_id();

        if ($_FILES['thumbnail']['name'] != "") {
            if (!file_exists('uploads/thumbnails/lesson_thumbnails')) {
                mkdir('uploads/thumbnails/lesson_thumbnails', 0777, true);
            }
            move_uploaded_file($_FILES['thumbnail']['tmp_name'], 'uploads/thumbnails/lesson_thumbnails/' . $inserted_id . '.jpg');
        }
    }

    public function edit_lesson($lesson_id)
    {

        $previous_data = $this->db->get_where('lesson', array('id' => $lesson_id))->row_array();

        $data['course_id'] = html_escape($this->input->post('course_id'));
        $data['title'] = html_escape($this->input->post('title'));
        $data['section_id'] = html_escape($this->input->post('section_id'));

        $lesson_type_array = explode('-', $this->input->post('lesson_type'));
        $lesson_type = $lesson_type_array[0];

        $attachment_type = $lesson_type_array[1];
        $data['attachment_type'] = $attachment_type;
        $data['lesson_type'] = $lesson_type;

        if ($lesson_type == 'video') {
            $lesson_provider = $this->input->post('lesson_provider');
            if ($lesson_provider == 'youtube' || $lesson_provider == 'vimeo') {
                if ($this->input->post('video_url') == "" || $this->input->post('duration') == "") {
                    $this->session->set_flashdata('error_message', get_phrase('invalid_lesson_url_and_duration'));
                    redirect(site_url(strtolower($this->session->userdata('role')) . '/course_form/course_edit/' . $data['course_id']), 'refresh');
                }
                $data['video_url'] = html_escape($this->input->post('video_url'));

                $duration_formatter = explode(':', $this->input->post('duration'));
                $hour = sprintf('%02d', $duration_formatter[0]);
                $min = sprintf('%02d', $duration_formatter[1]);
                $sec = sprintf('%02d', $duration_formatter[2]);
                $data['duration'] = $hour . ':' . $min . ':' . $sec;

                $video_details = $this->video_model->getVideoDetails($data['video_url']);
                $data['video_type'] = $video_details['provider'];
            } elseif ($lesson_provider == 'html5') {
                if ($this->input->post('html5_video_url') == "" || $this->input->post('html5_duration') == "") {
                    $this->session->set_flashdata('error_message', get_phrase('invalid_lesson_url_and_duration'));
                    redirect(site_url(strtolower($this->session->userdata('role')) . '/course_form/course_edit/' . $data['course_id']), 'refresh');
                }
                $data['video_url'] = html_escape($this->input->post('html5_video_url'));

                $duration_formatter = explode(':', $this->input->post('html5_duration'));
                $hour = sprintf('%02d', $duration_formatter[0]);
                $min = sprintf('%02d', $duration_formatter[1]);
                $sec = sprintf('%02d', $duration_formatter[2]);
                $data['duration'] = $hour . ':' . $min . ':' . $sec;
                $data['video_type'] = 'html5';

                if ($_FILES['thumbnail']['name'] != "") {
                    if (!file_exists('uploads/thumbnails/lesson_thumbnails')) {
                        mkdir('uploads/thumbnails/lesson_thumbnails', 0777, true);
                    }
                    move_uploaded_file($_FILES['thumbnail']['tmp_name'], 'uploads/thumbnails/lesson_thumbnails/' . $lesson_id . '.jpg');
                }
            } else {
                $this->session->set_flashdata('error_message', get_phrase('invalid_lesson_provider'));
                redirect(site_url(strtolower($this->session->userdata('role')) . '/course_form/course_edit/' . $data['course_id']), 'refresh');
            }
            $data['attachment'] = "";

            // This portion is for mobile application video lessons
            if ($this->input->post('html5_video_url_for_mobile_application') == "" || $this->input->post('html5_duration_for_mobile_application') == "") {
                $mobile_app_lesson_url = "https://www.html5rocks.com/en/tutorials/video/basics/devstories.webm";
                $mobile_app_lesson_duration = "00:01:10";
            } else {
                $mobile_app_lesson_url = $this->input->post('html5_video_url_for_mobile_application');
                $mobile_app_lesson_duration = $this->input->post('html5_duration_for_mobile_application');
            }
            $duration_for_mobile_application_formatter = explode(':', $mobile_app_lesson_duration);
            $hour = sprintf('%02d', $duration_for_mobile_application_formatter[0]);
            $min = sprintf('%02d', $duration_for_mobile_application_formatter[1]);
            $sec = sprintf('%02d', $duration_for_mobile_application_formatter[2]);
            $data['duration_for_mobile_application'] = $hour . ':' . $min . ':' . $sec;
            $data['video_type_for_mobile_application'] = 'html5';
            $data['video_url_for_mobile_application'] = $mobile_app_lesson_url;
        } elseif ($lesson_type == "s3") {
            // SET MAXIMUM EXECUTION TIME 600
            ini_set('max_execution_time', '600');

            if (isset($_FILES['video_file_for_amazon_s3']) && !empty($_FILES['video_file_for_amazon_s3']['name'])) {
                $fileName = $_FILES['video_file_for_amazon_s3']['name'];
                $tmp = explode('.', $fileName);
                $fileExtension = strtoupper(end($tmp));

                $video_extensions = ['WEBM', 'MP4'];
                if (!in_array($fileExtension, $video_extensions)) {
                    $this->session->set_flashdata('error_message', get_phrase('please_select_valid_video_file'));
                    redirect(site_url(strtolower($this->session->userdata('role')) . '/course_form/course_edit/' . $data['course_id']), 'refresh');
                }

                $upload_loaction = get_settings('video_upload_location');
                $access_key = get_settings('amazon_s3_access_key');
                $secret_key = get_settings('amazon_s3_secret_key');
                $bucket = get_settings('amazon_s3_bucket_name');
                $region = get_settings('amazon_s3_region_name');

                $s3config = array(
                    'region' => $region,
                    'version' => 'latest',
                    'credentials' => [
                        'key' => $access_key, //Put key here
                        'secret' => $secret_key // Put Secret here
                    ]
                );


                $tmpfile = $_FILES['video_file_for_amazon_s3'];

                $s3 = new Aws\S3\S3Client($s3config);
                $key = str_replace(".", "-" . rand(1, 9999) . ".", preg_replace('/\s+/', '', $tmpfile['name']));

                $result = $s3->putObject([
                    'Bucket' => $bucket,
                    'Key' => $key,
                    'SourceFile' => $tmpfile['tmp_name'],
                    'ACL' => 'public-read'
                ]);

                $data['video_url'] = $result['ObjectURL'];
                $data['video_url_for_mobile_application'] = $result['ObjectURL'];
            }

            $data['video_type'] = 'amazon';
            $data['lesson_type'] = 'video';
            $data['attachment_type'] = 'file';


            if ($this->input->post('amazon_s3_duration') == "") {
                $this->session->set_flashdata('error_message', get_phrase('invalid_lesson_duration'));
                redirect(site_url(strtolower($this->session->userdata('role')) . '/course_form/course_edit/' . $data['course_id']), 'refresh');
            }

            $duration_formatter = explode(':', $this->input->post('amazon_s3_duration'));
            $hour = sprintf('%02d', $duration_formatter[0]);
            $min = sprintf('%02d', $duration_formatter[1]);
            $sec = sprintf('%02d', $duration_formatter[2]);
            $data['duration'] = $hour . ':' . $min . ':' . $sec;

            $data['duration_for_mobile_application'] = $hour . ':' . $min . ':' . $sec;
            $data['video_type_for_mobile_application'] = "html5";
        } elseif ($lesson_type == "system") {
            // SET MAXIMUM EXECUTION TIME 600
            ini_set('max_execution_time', '600');

            if (isset($_FILES['system_video_file']) && !empty($_FILES['system_video_file']['name'])) {
                //delete previews video
                $previews_video_url = $this->db->get_where('lesson', array('id' => $lesson_id))->row('video_url');
                $video_file = explode('/', $previews_video_url);
                unlink('uploads/lesson_files/videos/' . end($video_file));
                //end delete previews video

                $fileName = $_FILES['system_video_file']['name'];

                // CHECKING IF THE FILE IS AVAILABLE AND FILE SIZE IS VALID
                if (array_key_exists('system_video_file', $_FILES)) {
                    if ($_FILES['system_video_file']['error'] !== UPLOAD_ERR_OK) {
                        $error_code = $_FILES['system_video_file']['error'];
                        $this->session->set_flashdata('error_message', phpFileUploadErrors($error_code));
                        redirect(site_url(strtolower($this->session->userdata('role')) . '/course_form/course_edit/' . $data['course_id']), 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('error_message', get_phrase('please_select_valid_video_file'));
                    redirect(site_url(strtolower($this->session->userdata('role')) . '/course_form/course_edit/' . $data['course_id']), 'refresh');
                };

                $tmp = explode('.', $fileName);
                $fileExtension = strtoupper(end($tmp));

                $video_extensions = ['WEBM', 'MP4'];
                if (!in_array($fileExtension, $video_extensions)) {
                    $this->session->set_flashdata('error_message', get_phrase('please_select_valid_video_file'));
                    redirect(site_url(strtolower($this->session->userdata('role')) . '/course_form/course_edit/' . $data['course_id']), 'refresh');
                }

                // custom random name of the video file
                $uploadable_video_file = md5(uniqid(rand(), true)) . '.' . strtolower($fileExtension);


                $tmp_video_file = $_FILES['system_video_file']['tmp_name'];

                if (!file_exists('uploads/lesson_files/videos')) {
                    mkdir('uploads/lesson_files/videos', 0777, true);
                }
                $video_file_path = 'uploads/lesson_files/videos/' . $uploadable_video_file;
                move_uploaded_file($tmp_video_file, $video_file_path);

                $data['video_url'] = site_url($video_file_path);
                $data['video_url_for_mobile_application'] = site_url($video_file_path);
            }

            $data['video_type'] = 'system';
            $data['lesson_type'] = 'video';
            $data['attachment_type'] = 'file';


            if ($this->input->post('system_video_file_duration') == "") {
                $this->session->set_flashdata('error_message', get_phrase('invalid_lesson_duration'));
                redirect(site_url(strtolower($this->session->userdata('role')) . '/course_form/course_edit/' . $data['course_id']), 'refresh');
            }

            $duration_formatter = explode(':', $this->input->post('system_video_file_duration'));
            $hour = sprintf('%02d', $duration_formatter[0]);
            $min = sprintf('%02d', $duration_formatter[1]);
            $sec = sprintf('%02d', $duration_formatter[2]);
            $data['duration'] = $hour . ':' . $min . ':' . $sec;

            $data['duration_for_mobile_application'] = $hour . ':' . $min . ':' . $sec;
            $data['video_type_for_mobile_application'] = "html5";
        } else {
            if ($attachment_type == 'iframe') {
                if (empty($this->input->post('iframe_source'))) {
                    $this->session->set_flashdata('error_message', get_phrase('invalid_source'));
                    redirect(site_url(strtolower($this->session->userdata('role')) . '/course_form/course_edit/' . $data['course_id']), 'refresh');
                }
                $data['attachment'] = $this->input->post('iframe_source');
            } else {
                if ($_FILES['attachment']['name'] != "") {
                    // unlinking previous attachments
                    if ($previous_data['attachment'] != "") {
                        unlink('uploads/lesson_files/' . $previous_data['attachment']);
                    }

                    $fileName = $_FILES['attachment']['name'];
                    $tmp = explode('.', $fileName);
                    $fileExtension = end($tmp);
                    $uploadable_file = md5(uniqid(rand(), true)) . '.' . $fileExtension;
                    $data['attachment'] = $uploadable_file;
                    $data['video_type'] = "";
                    $data['duration'] = "";
                    $data['video_url'] = "";
                    $data['duration_for_mobile_application'] = "";
                    $data['video_type_for_mobile_application'] = '';
                    $data['video_url_for_mobile_application'] = "";
                    if (!file_exists('uploads/lesson_files')) {
                        mkdir('uploads/lesson_files', 0777, true);
                    }
                    move_uploaded_file($_FILES['attachment']['tmp_name'], 'uploads/lesson_files/' . $uploadable_file);
                }
            }
        }

        $data['last_modified'] = strtotime(date('D, d-M-Y'));
        $data['summary'] = $this->input->post('summary');
        $data['video_type'] = ($lesson_provider == 'youtube') ? $lesson_provider : $data['video_type'];
        $this->db->where('id', $lesson_id);
        $this->db->update('lesson', $data);
    }

    public function delete_lesson($lesson_id)
    {
        $this->db->where('id', $lesson_id);
        $this->db->delete('lesson');
    }

    public function update_frontend_settings()
    {
        $data['value'] = html_escape($this->input->post('banner_title'));
        $this->db->where('key', 'banner_title');
        $this->db->update('frontend_settings', $data);

        $data['value'] = html_escape($this->input->post('banner_sub_title'));
        $this->db->where('key', 'banner_sub_title');
        $this->db->update('frontend_settings', $data);

        $data['value'] = html_escape($this->input->post('cookie_status'));
        $this->db->where('key', 'cookie_status');
        $this->db->update('frontend_settings', $data);

        $data['value'] = $this->input->post('cookie_note');
        $this->db->where('key', 'cookie_note');
        $this->db->update('frontend_settings', $data);

        $data['value'] = $this->input->post('cookie_policy');
        $this->db->where('key', 'cookie_policy');
        $this->db->update('frontend_settings', $data);


        $data['value'] = $this->input->post('about_us');
        $this->db->where('key', 'about_us');
        $this->db->update('frontend_settings', $data);


        $data['value'] = $this->input->post('about_us_mission');
        $this->db->where('key', 'about_us_mission');
        $this->db->update('frontend_settings', $data);


        $data['value'] = $this->input->post('about_us_vision');
        $this->db->where('key', 'about_us_vision');
        $this->db->update('frontend_settings', $data);


        $data['value'] = $this->input->post('about_us_values');
        $this->db->where('key', 'about_us_values');
        $this->db->update('frontend_settings', $data);

        $data['value'] = $this->input->post('terms_and_condition');
        $this->db->where('key', 'terms_and_condition');
        $this->db->update('frontend_settings', $data);

        $data['value'] = $this->input->post('privacy_policy');
        $this->db->where('key', 'privacy_policy');
        $this->db->update('frontend_settings', $data);

        $data['value'] = $this->input->post('cancellation_and_refund_policy');
        $this->db->where('key', 'cancellation_and_refund_policy');
        $this->db->update('frontend_settings', $data);
    }

    public function update_recaptcha_settings()
    {
        $data['value'] = html_escape($this->input->post('recaptcha_status'));
        $this->db->where('key', 'recaptcha_status');
        $this->db->update('frontend_settings', $data);

        $data['value'] = html_escape($this->input->post('recaptcha_sitekey'));
        $this->db->where('key', 'recaptcha_sitekey');
        $this->db->update('frontend_settings', $data);

        $data['value'] = html_escape($this->input->post('recaptcha_secretkey'));
        $this->db->where('key', 'recaptcha_secretkey');
        $this->db->update('frontend_settings', $data);
    }

    public function update_frontend_banner()
    {
        if (isset($_FILES['banner_image']) && $_FILES['banner_image']['name'] != "") {
            unlink('uploads/system/' . get_frontend_settings('banner_image'));
            $data['value'] = md5(rand(1000, 100000)) . '.jpg';
            $this->db->where('key', 'banner_image');
            $this->db->update('frontend_settings', $data);
            move_uploaded_file($_FILES['banner_image']['tmp_name'], 'uploads/system/' . $data['value']);
        }
    }

    public function update_light_logo()
    {
        if (isset($_FILES['light_logo']) && $_FILES['light_logo']['name'] != "") {
            unlink('uploads/system/' . get_frontend_settings('light_logo'));
            $data['value'] = md5(rand(1000, 100000)) . '.png';
            $this->db->where('key', 'light_logo');
            $this->db->update('frontend_settings', $data);
            move_uploaded_file($_FILES['light_logo']['tmp_name'], 'uploads/system/' . $data['value']);
        }
    }

    public function update_dark_logo()
    {
        if (isset($_FILES['dark_logo']) && $_FILES['dark_logo']['name'] != "") {
            unlink('uploads/system/' . get_frontend_settings('dark_logo'));
            $data['value'] = md5(rand(1000, 100000)) . '.png';
            $this->db->where('key', 'dark_logo');
            $this->db->update('frontend_settings', $data);
            move_uploaded_file($_FILES['dark_logo']['tmp_name'], 'uploads/system/' . $data['value']);
        }
    }

    public function update_small_logo()
    {
        if (isset($_FILES['small_logo']) && $_FILES['small_logo']['name'] != "") {
            unlink('uploads/system/' . get_frontend_settings('small_logo'));
            $data['value'] = md5(rand(1000, 100000)) . '.png';
            $this->db->where('key', 'small_logo');
            $this->db->update('frontend_settings', $data);
            move_uploaded_file($_FILES['small_logo']['tmp_name'], 'uploads/system/' . $data['value']);
        }
    }

    public function update_favicon()
    {
        if (isset($_FILES['favicon']) && $_FILES['favicon']['name'] != "") {
            unlink('uploads/system/' . get_frontend_settings('favicon'));
            $data['value'] = md5(rand(1000, 100000)) . '.png';
            $this->db->where('key', 'favicon');
            $this->db->update('frontend_settings', $data);
            move_uploaded_file($_FILES['favicon']['tmp_name'], 'uploads/system/' . $data['value']);
        }
        //move_uploaded_file($_FILES['favicon']['tmp_name'], 'uploads/system/favicon.png');
    }

    public function handleWishList($course_id)
    {
        $wishlists = array();
        $user_details = $this->user_model->get_user($this->session->userdata('user_id'))->row_array();
        if ($user_details['wishlist'] == "") {
            array_push($wishlists, $course_id);
        } else {
            $wishlists = json_decode($user_details['wishlist']);
            if (in_array($course_id, $wishlists)) {
                $container = array();
                foreach ($wishlists as $key) {
                    if ($key != $course_id) {
                        array_push($container, $key);
                    }
                }
                $wishlists = $container;
                // $key = array_search($course_id, $wishlists);
                // unset($wishlists[$key]);
            } else {
                array_push($wishlists, $course_id);
            }
        }

        $updater['wishlist'] = json_encode($wishlists);
        $this->db->where('id', $this->session->userdata('user_id'));
        $this->db->update('users', $updater);
    }

    public function is_added_to_wishlist($course_id = "")
    {
        if ($this->session->userdata('user_login') == 1) {
            $wishlists = array();
            $user_details = $this->user_model->get_user($this->session->userdata('user_id'))->row_array();
            $wishlists = json_decode($user_details['wishlist']);
            if (in_array($course_id, $wishlists)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getWishLists($user_id = "")
    {
        if ($user_id == "") {
            $user_id = $this->session->userdata('user_id');
        }
        $user_details = $this->user_model->get_user($user_id)->row_array();
        return json_decode($user_details['wishlist']);
    }

    public function get_latest_10_course($category = "")
    {
        if (!addon_status('scorm_course')) {
            $this->db->where('course_type', 'general');
        }
        if (!empty($category)) {
            $this->db->where('sub_category_id', $category);
        }
        $this->db->order_by("id", "desc");
        $this->db->limit('10');
        $this->db->where('status', 'active');
        return $this->db->get('course')->result_array();
    }

    public function enrol_student($user_id)
    {
        $purchased_courses = $this->session->userdata('cart_items');
        foreach ($purchased_courses as $purchased_course) {
            $data['user_id'] = $user_id;
            $data['course_id'] = $purchased_course;
            $data['date_added'] = strtotime(date('D, d-M-Y'));
            $this->db->insert('enrol', $data);
        }
    }

    public function enrol_a_student_manually()
    {
        $data['course_id'] = $this->input->post('course_id');
        $data['user_id'] = $this->input->post('user_id');
        $user_data = $this->user_model->get_user($data['user_id'])->result_array();
        $course_data = $this->db->get_where('course', array('id' => $data['course_id']))->row_array();

        if ($this->db->get_where('enrol', $data)->num_rows() > 0) {
            $this->session->set_flashdata('error_message', get_phrase('student_has_already_been_enrolled_to_this_course'));
        } else {
            /**** Chanchal Code For offline payment ****/

            $d = random_string('alnum', 10);
            $offline_payment = [
                'user_id' => $data['user_id'],
                'course_id' => $data['course_id'],
                'tr_num' => 'offline_' . $d,
                'payment_option' => $this->input->post('installment_payment'),
                'amount' => $this->input->post('installment_money'),
                'next_due_date' => $this->input->post('due_date'),
            ];

//            print_array($offline_payment);
//            die();
            $this->db->insert('offline_payment', $offline_payment);

            $payment_transaction = [
                'payment_id' => 'offline_' . $d,
                'amount' => $this->input->post('installment_money'),
                'currency' => 'INR',
                'method' => 'offline',
                'user_id' => $data['user_id'],
                'contact' => $user_data[0]['contact'],
                'email' => $user_data[0]['email'],
                'offline_payment_id' => 'offline_' . $d,
                'next_due_date' => $this->input->post('due_date'),
            ];
            if ($this->input->post('installment_money') == $course_data['price']) {
                $payment_transaction['status'] = 'success';
            } else {
                $payment_transaction['status'] = 'pending';
            }
            $this->db->insert('payment_transaction', $payment_transaction);
            $data['p_status'] = 'offline';
            $data['tr_num'] = 'offline_' . $d;

            /**** Chanchal Code For offline payment ****/

//            print_array($offline_payment);
//            print_array($payment_transaction);
//            die();


            $data['date_added'] = strtotime(date('D, d-M-Y'));
            $this->db->insert('enrol', $data);
            $this->session->set_flashdata('flash_message', get_phrase('student_has_been_enrolled_to_that_course'));
        }
    }

    public function shortcut_enrol_a_student_manually()
    {
        $data['course_id'] = $this->input->post('course_id');
        $data['user_id'] = $this->input->post('user_id');
        if ($this->db->get_where('enrol', $data)->num_rows() > 0) {
            $response['status'] = 0;
            $response['message'] = get_phrase('student_has_already_been_enrolled_to_this_course');
            return json_encode($response);
        } else {
            $data['date_added'] = strtotime(date('D, d-M-Y'));
            $this->db->insert('enrol', $data);
            $this->session->set_flashdata('flash_message', get_phrase('student_has_been_enrolled_to_that_course'));

            $response['status'] = 1;
            return json_encode($response);
        }
    }

    public function enrol_to_free_course($course_id = "", $user_id = "")
    {
        $course_details = $this->get_course_by_id($course_id)->row_array();
        if ($course_details['is_free_course'] == 1) {
            $data['course_id'] = $course_id;
            $data['user_id'] = $user_id;
            if ($this->db->get_where('enrol', $data)->num_rows() > 0) {
                $this->session->set_flashdata('error_message', get_phrase('student_has_already_been_enrolled_to_this_course'));
            } else {
                $data['date_added'] = strtotime(date('D, d-M-Y'));
                $this->db->insert('enrol', $data);
                $this->session->set_flashdata('flash_message', get_phrase('successfully_enrolled'));
            }
        } else {
            $this->session->set_flashdata('error_message', get_phrase('this_course_is_not_free_at_all'));
            redirect(site_url('home/course/' . slugify($course_details['title']) . '/' . $course_id), 'refresh');
        }
    }

    public function course_purchase($user_id, $method, $amount_paid, $param1 = "", $param2 = "")
    {
        $purchased_courses = $this->session->userdata('cart_items');
        foreach ($purchased_courses as $purchased_course) {

            if ($method == 'stripe') {
                //param1 transaction_id, param2 session_id for stripe
                $data['transaction_id'] = $param1;
                $data['session_id'] = $param2;
            }

            $data['user_id'] = $user_id;
            $data['payment_type'] = $method;
            $data['course_id'] = $purchased_course;
            $course_details = $this->get_course_by_id($purchased_course)->row_array();
            if ($course_details['discount_flag'] == 1) {
                $data['amount'] = $course_details['discounted_price'];
            } else {
                $data['amount'] = $course_details['price'];
            }
            if (get_user_role('role_id', $course_details['user_id']) == 1) {
                $data['admin_revenue'] = $data['amount'];
                $data['instructor_revenue'] = 0;
                $data['instructor_payment_status'] = 1;
            } else {
                if (get_settings('allow_instructor') == 1) {
                    $instructor_revenue_percentage = get_settings('instructor_revenue');
                    $data['instructor_revenue'] = ceil(($data['amount'] * $instructor_revenue_percentage) / 100);
                    $data['admin_revenue'] = $data['amount'] - $data['instructor_revenue'];
                } else {
                    $data['instructor_revenue'] = 0;
                    $data['admin_revenue'] = $data['amount'];
                }
                $data['instructor_payment_status'] = 0;
            }
            $data['date_added'] = strtotime(date('D, d-M-Y'));
            $this->db->insert('payment', $data);
        }
    }

    public function get_default_lesson($section_id)
    {
        $this->db->order_by('order', "asc");
        $this->db->limit(1);
        $this->db->where('section_id', $section_id);
        return $this->db->get('lesson');
    }

    public function get_courses_by_wishlists()
    {
        $wishlists = $this->getWishLists();
        if (sizeof($wishlists) > 0) {
            $this->db->where_in('id', $wishlists);
            return $this->db->get('course')->result_array();
        } else {
            return array();
        }
    }


    public function get_courses_of_wishlists_by_search_string($search_string)
    {
        $wishlists = $this->getWishLists();
        if (sizeof($wishlists) > 0) {
            $this->db->where_in('id', $wishlists);
            $this->db->like('title', $search_string);
            return $this->db->get('course')->result_array();
        } else {
            return array();
        }
    }

    public function get_total_duration_of_lesson_by_course_id($course_id)
    {
        $total_duration = 0;
        $lessons = $this->crud_model->get_lessons('course', $course_id)->result_array();
        foreach ($lessons as $lesson) {
            if ($lesson['lesson_type'] != "other") {
                $time_array = explode(':', $lesson['duration']);
                $hour_to_seconds = $time_array[0] * 60 * 60;
                $minute_to_seconds = $time_array[1] * 60;
                $seconds = $time_array[2];
                $total_duration += $hour_to_seconds + $minute_to_seconds + $seconds;
            }
        }
        // return gmdate("H:i:s", $total_duration).' '.get_phrase('hours');
        $hours = floor($total_duration / 3600);
        $minutes = floor(($total_duration % 3600) / 60);
        $seconds = $total_duration % 60;
        return sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds) . ' ' . get_phrase('hours');
    }

    public function get_total_duration_of_lesson_by_section_id($section_id)
    {
        $total_duration = 0;
        $lessons = $this->crud_model->get_lessons('section', $section_id)->result_array();
        foreach ($lessons as $lesson) {
            if ($lesson['lesson_type'] != 'other') {
                $time_array = explode(':', $lesson['duration']);
                $hour_to_seconds = $time_array[0] * 60 * 60;
                $minute_to_seconds = $time_array[1] * 60;
                $seconds = $time_array[2];
                $total_duration += $hour_to_seconds + $minute_to_seconds + $seconds;
            }
        }
        //return gmdate("H:i:s", $total_duration).' '.get_phrase('hours');
        $hours = floor($total_duration / 3600);
        $minutes = floor(($total_duration % 3600) / 60);
        $seconds = $total_duration % 60;
        return sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds) . ' ' . get_phrase('hours');
    }

    public function rate($data)
    {
        if ($this->db->get_where('rating',
                array(
                    'user_id' => $data['user_id'],
                    'ratable_id' => $data['ratable_id'],
                    'ratable_type' => $data['ratable_type'],
                )
            )->num_rows() == 0) {
            $this->db->insert('rating', $data);
        } else {
            $checker = array('user_id' => $data['user_id'], 'ratable_id' => $data['ratable_id'], 'ratable_type' => $data['ratable_type']);
            $this->db->where($checker);
            $this->db->update('rating', $data);
        }
    }

    public function get_user_specific_rating($ratable_type = "", $ratable_id = "")
    {
        return $this->db->get_where('rating', array('ratable_type' => $ratable_type, 'user_id' => $this->session->userdata('user_id'), 'ratable_id' => $ratable_id))->row_array();
    }

    public function get_ratings($ratable_type = "", $ratable_id = "", $is_sum = false)
    {
        if ($is_sum) {
            $this->db->select_sum('rating');
            return $data = $this->db->get_where('rating', array('ratable_type' => $ratable_type, 'ratable_id' => $ratable_id));
        } else {
            return $this->db->get_where('rating', array('ratable_type' => $ratable_type, 'ratable_id' => $ratable_id));
        }
    }

    public function get_instructor_wise_course_ratings($instructor_id = "", $ratable_type = "", $is_sum = false)
    {
        $course_ids = $this->get_instructor_wise_courses($instructor_id, 'simple_array');
        if ($is_sum) {
            $this->db->where('status', '1');
            $this->db->where('ratable_type', $ratable_type);
            $this->db->where_in('ratable_id', $course_ids);
            $this->db->select_sum('rating');
            return $this->db->get('rating');
        } else {
            $this->db->where('status', '1');
            $this->db->where('ratable_type', $ratable_type);
            $this->db->where_in('ratable_id', $course_ids);
            return $this->db->get('rating');
        }
    }

    public function get_percentage_of_specific_rating($rating = "", $ratable_type = "", $ratable_id = "")
    {
        $number_of_user_rated = $this->db->get_where('rating', array(
            'ratable_type' => $ratable_type,
            'ratable_id' => $ratable_id
        ))->num_rows();

        $number_of_user_rated_the_specific_rating = $this->db->get_where('rating', array(
            'ratable_type' => $ratable_type,
            'ratable_id' => $ratable_id,
            'rating' => $rating
        ))->num_rows();

        //return $number_of_user_rated.' '.$number_of_user_rated_the_specific_rating;
        if ($number_of_user_rated_the_specific_rating > 0) {
            $percentage = ($number_of_user_rated_the_specific_rating / $number_of_user_rated) * 100;
        } else {
            $percentage = 0;
        }
        return floor($percentage);
    }

    ////////private message//////
    function send_new_private_message()
    {
        $message = $this->input->post('message');
        $timestamp = strtotime(date("Y-m-d H:i:s"));

        $receiver = $this->input->post('receiver');
        $sender = $this->session->userdata('user_id');

        //check if the thread between those 2 users exists, if not create new thread
        $num1 = $this->db->get_where('message_thread', array('sender' => $sender, 'receiver' => $receiver))->num_rows();
        $num2 = $this->db->get_where('message_thread', array('sender' => $receiver, 'receiver' => $sender))->num_rows();
        if ($num1 == 0 && $num2 == 0) {
            $message_thread_code = substr(md5(rand(100000000, 20000000000)), 0, 15);
            $data_message_thread['message_thread_code'] = $message_thread_code;
            $data_message_thread['sender'] = $sender;
            $data_message_thread['receiver'] = $receiver;
            $this->db->insert('message_thread', $data_message_thread);
        }
        if ($num1 > 0)
            $message_thread_code = $this->db->get_where('message_thread', array('sender' => $sender, 'receiver' => $receiver))->row()->message_thread_code;
        if ($num2 > 0)
            $message_thread_code = $this->db->get_where('message_thread', array('sender' => $receiver, 'receiver' => $sender))->row()->message_thread_code;


        $data_message['message_thread_code'] = $message_thread_code;
        $data_message['message'] = $message;
        $data_message['sender'] = $sender;
        $data_message['timestamp'] = $timestamp;
        $this->db->insert('message', $data_message);

        return $message_thread_code;
    }

    function send_reply_message($message_thread_code)
    {
        $message = html_escape($this->input->post('message'));
        $timestamp = strtotime(date("Y-m-d H:i:s"));
        $sender = $this->session->userdata('user_id');

        $data_message['message_thread_code'] = $message_thread_code;
        $data_message['message'] = $message;
        $data_message['sender'] = $sender;
        $data_message['timestamp'] = $timestamp;
        $this->db->insert('message', $data_message);
    }

    function mark_thread_messages_read($message_thread_code)
    {
        // mark read only the oponnent messages of this thread, not currently logged in user's sent messages
        $current_user = $this->session->userdata('user_id');
        $this->db->where('sender !=', $current_user);
        $this->db->where('message_thread_code', $message_thread_code);
        $this->db->update('message', array('read_status' => 1));
    }

    function count_unread_message_of_thread($message_thread_code)
    {
        $unread_message_counter = 0;
        $current_user = $this->session->userdata('user_id');
        $messages = $this->db->get_where('message', array('message_thread_code' => $message_thread_code))->result_array();
        foreach ($messages as $row) {
            if ($row['sender'] != $current_user && $row['read_status'] == '0')
                $unread_message_counter++;
        }
        return $unread_message_counter;
    }

    public function get_last_message_by_message_thread_code($message_thread_code)
    {
        $this->db->order_by('message_id', 'desc');
        $this->db->limit(1);
        $this->db->where(array('message_thread_code' => $message_thread_code));
        return $this->db->get('message');
    }

    function curl_request($code = '')
    {

        $product_code = $code;

        $personal_token = "FkA9UyDiQT0YiKwYLK3ghyFNRVV9SeUn";
        $url = "https://api.envato.com/v3/market/author/sale?code=" . $product_code;
        $curl = curl_init($url);

        //setting the header for the rest of the api
        $bearer = 'bearer ' . $personal_token;
        $header = array();
        $header[] = 'Content-length: 0';
        $header[] = 'Content-type: application/json; charset=utf-8';
        $header[] = 'Authorization: ' . $bearer;

        $verify_url = 'https://api.envato.com/v1/market/private/user/verify-purchase:' . $product_code . '.json';
        $ch_verify = curl_init($verify_url . '?code=' . $product_code);

        curl_setopt($ch_verify, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch_verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch_verify, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch_verify, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch_verify, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

        $cinit_verify_data = curl_exec($ch_verify);
        curl_close($ch_verify);

        $response = json_decode($cinit_verify_data, true);

        if (count($response['verify-purchase']) > 0) {
            return true;
        } else {
            return false;
        }
    }


    // version 1.3
    function get_currencies()
    {
        return $this->db->get('currency')->result_array();
    }

    function get_paypal_supported_currencies()
    {
        $this->db->where('paypal_supported', 1);
        return $this->db->get('currency')->result_array();
    }

    function get_stripe_supported_currencies()
    {
        $this->db->where('stripe_supported', 1);
        return $this->db->get('currency')->result_array();
    }

    // version 1.4
    function filter_course($selected_category_id = "", $selected_price = "", $selected_level = "", $selected_language = "", $selected_rating = "")
    {
        //echo $selected_category_id.' '.$selected_price.' '.$selected_level.' '.$selected_language.' '.$selected_rating;

        $course_ids = array();
        if ($selected_category_id != "all") {
            $category_details = $this->get_category_details_by_id($selected_category_id)->row_array();

            if ($category_details['parent'] > 0) {
                $this->db->where('sub_category_id', $selected_category_id);
            } else {
                $this->db->where('category_id', $selected_category_id);
            }
        }

        if ($selected_price != "all") {
            if ($selected_price == "paid") {
                $this->db->where('is_free_course', null);
            } elseif ($selected_price == "free") {
                $this->db->where('is_free_course', 1);
            }
        }

        if ($selected_level != "all") {
            $this->db->where('level', $selected_level);
        }

        if ($selected_language != "all") {
            $this->db->where('language', $selected_language);
        }
        $this->db->where('status', 'active');
        $courses = $this->db->get('course')->result_array();

        foreach ($courses as $course) {
            if ($selected_rating != "all") {
                $total_rating = $this->get_ratings('course', $course['id'], true)->row()->rating;
                $number_of_ratings = $this->get_ratings('course', $course['id'])->num_rows();
                if ($number_of_ratings > 0) {
                    $average_ceil_rating = ceil($total_rating / $number_of_ratings);
                    if ($average_ceil_rating == $selected_rating) {
                        array_push($course_ids, $course['id']);
                    }
                }
            } else {
                array_push($course_ids, $course['id']);
            }
        }

        if (count($course_ids) > 0) {
            if (!addon_status('scorm_course')) {
                $this->db->where('course_type', 'general');
            }
            $this->db->where_in('id', $course_ids);
            return $this->db->get('course')->result_array();
        } else {
            return array();
        }
    }

    public function get_courses($category_id = "", $sub_category_id = "", $instructor_id = 0)
    {
        if ($category_id > 0 && $sub_category_id > 0 && $instructor_id > 0) {
            return $this->db->get_where('course', array('category_id' => $category_id, 'sub_category_id' => $sub_category_id, 'user_id' => $instructor_id));
        } elseif ($category_id > 0 && $sub_category_id > 0 && $instructor_id == 0) {
            return $this->db->get_where('course', array('category_id' => $category_id, 'sub_category_id' => $sub_category_id));
        } else {
            return $this->db->get('course');
        }
    }

    public function filter_course_for_backend($category_id, $instructor_id, $price, $status)
    {
        // print_r($instructor_id);
        //     die;
        if ($category_id != "all") {
            $this->db->where('sub_category_id', $category_id);
        }

        if ($price != "all") {
            if ($price == "paid") {
                $this->db->where('is_free_course', null);
            } elseif ($price == "free") {
                $this->db->where('is_free_course', 1);
            }
        }

        if ($instructor_id != "all") {

            $this->db->where_in('user_id', $instructor_id);
        }

        if ($status != "all") {
            $this->db->where('status', $status);
        }
        return $this->db->get('course')->result_array();
    }

    public function sort_section($section_json)
    {
        $sections = json_decode($section_json);
        foreach ($sections as $key => $value) {
            $updater = array(
                'order' => $key + 1
            );
            $this->db->where('id', $value);
            $this->db->update('section', $updater);
        }
    }

    public function sort_lesson($lesson_json)
    {
        $lessons = json_decode($lesson_json);
        foreach ($lessons as $key => $value) {
            $updater = array(
                'order' => $key + 1
            );
            $this->db->where('id', $value);
            $this->db->update('lesson', $updater);
        }
    }

    public function sort_question($question_json)
    {
        $questions = json_decode($question_json);
        foreach ($questions as $key => $value) {
            $updater = array(
                'order' => $key + 1
            );
            $this->db->where('id', $value);
            $this->db->update('question', $updater);
        }
    }

    public function get_free_and_paid_courses($price_status = "", $instructor_id = "")
    {
        if (!addon_status('scorm_course')) {
            $this->db->where('course_type', 'general');
        }
        $this->db->where('status', 'active');
        if ($price_status == 'free') {
            $this->db->where('is_free_course', 1);
        } else {
            $this->db->where('is_free_course', null);
        }

        if ($instructor_id > 0) {
            $this->db->where('user_id', $instructor_id);
        }
        return $this->db->get('course');
    }

    // Adding quiz functionalities
    public function add_quiz($course_id = "")
    {
        $data['course_id'] = $course_id;
        $data['title'] = html_escape($this->input->post('title'));
        $data['section_id'] = html_escape($this->input->post('section_id'));

        $data['lesson_type'] = 'quiz';
        $data['duration'] = '00:00:00';
        $data['date_added'] = strtotime(date('D, d-M-Y'));
        $data['summary'] = html_escape($this->input->post('summary'));
        $this->db->insert('lesson', $data);
    }

    // updating quiz functionalities
    public function edit_quiz($lesson_id = "")
    {
        $data['title'] = html_escape($this->input->post('title'));
        $data['section_id'] = html_escape($this->input->post('section_id'));
        $data['last_modified'] = strtotime(date('D, d-M-Y'));
        $data['summary'] = html_escape($this->input->post('summary'));
        $this->db->where('id', $lesson_id);
        $this->db->update('lesson', $data);
    }

    // Get quiz questions
    public function get_quiz_questions($quiz_id)
    {
        $this->db->order_by("order", "asc");
        $this->db->where('quiz_id', $quiz_id);
        return $this->db->get('question');
    }

    public function get_quiz_question_by_id($question_id)
    {
        $this->db->order_by("order", "asc");
        $this->db->where('id', $question_id);
        return $this->db->get('question');
    }

    // Add Quiz Questions
    public function add_quiz_questions($quiz_id)
    {
        $question_type = $this->input->post('question_type');
        if ($question_type == 'mcq') {
            $response = $this->add_multiple_choice_question($quiz_id);
            return $response;
        }
    }

    public function update_quiz_questions($question_id)
    {
        $question_type = $this->input->post('question_type');
        if ($question_type == 'mcq') {
            $response = $this->update_multiple_choice_question($question_id);
            return $response;
        }
    }

    // multiple_choice_question crud functions
    function add_multiple_choice_question($quiz_id)
    {
        if (sizeof($this->input->post('options')) != $this->input->post('number_of_options')) {
            return false;
        }
        foreach ($this->input->post('options') as $option) {
            if ($option == "") {
                return false;
            }
        }
        if (sizeof($this->input->post('correct_answers')) == 0) {
            $correct_answers = [""];
        } else {
            $correct_answers = $this->input->post('correct_answers');
        }
        $data['quiz_id'] = $quiz_id;
        $data['title'] = html_escape($this->input->post('title'));
        $data['number_of_options'] = html_escape($this->input->post('number_of_options'));
        $data['type'] = 'multiple_choice';
        $data['options'] = json_encode($this->input->post('options'));
        $data['correct_answers'] = json_encode($correct_answers);
        $this->db->insert('question', $data);
        return true;
    }

    // update multiple choice question
    function update_multiple_choice_question($question_id)
    {
        if (sizeof($this->input->post('options')) != $this->input->post('number_of_options')) {
            return false;
        }
        foreach ($this->input->post('options') as $option) {
            if ($option == "") {
                return false;
            }
        }

        if (sizeof($this->input->post('correct_answers')) == 0) {
            $correct_answers = [""];
        } else {
            $correct_answers = $this->input->post('correct_answers');
        }

        $data['title'] = html_escape($this->input->post('title'));
        $data['number_of_options'] = html_escape($this->input->post('number_of_options'));
        $data['type'] = 'multiple_choice';
        $data['options'] = json_encode($this->input->post('options'));
        $data['correct_answers'] = json_encode($correct_answers);
        $this->db->where('id', $question_id);
        $this->db->update('question', $data);
        return true;
    }

    function delete_quiz_question($question_id)
    {
        $this->db->where('id', $question_id);
        $this->db->delete('question');
        return true;
    }

    function get_application_details()
    {
        $purchase_code = get_settings('purchase_code');
        $returnable_array = array(
            'purchase_code_status' => get_phrase('not_found'),
            'support_expiry_date' => get_phrase('not_found'),
            'customer_name' => get_phrase('not_found')
        );

        $personal_token = "gC0J1ZpY53kRpynNe4g2rWT5s4MW56Zg";
        $url = "https://api.envato.com/v3/market/author/sale?code=" . $purchase_code;
        $curl = curl_init($url);

        //setting the header for the rest of the api
        $bearer = 'bearer ' . $personal_token;
        $header = array();
        $header[] = 'Content-length: 0';
        $header[] = 'Content-type: application/json; charset=utf-8';
        $header[] = 'Authorization: ' . $bearer;

        $verify_url = 'https://api.envato.com/v1/market/private/user/verify-purchase:' . $purchase_code . '.json';
        $ch_verify = curl_init($verify_url . '?code=' . $purchase_code);

        curl_setopt($ch_verify, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch_verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch_verify, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch_verify, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch_verify, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

        $cinit_verify_data = curl_exec($ch_verify);
        curl_close($ch_verify);

        $response = json_decode($cinit_verify_data, true);

        if (count($response['verify-purchase']) > 0) {

            //print_r($response);
            $item_name = $response['verify-purchase']['item_name'];
            $purchase_time = $response['verify-purchase']['created_at'];
            $customer = $response['verify-purchase']['buyer'];
            $licence_type = $response['verify-purchase']['licence'];
            $support_until = $response['verify-purchase']['supported_until'];
            $customer = $response['verify-purchase']['buyer'];

            $purchase_date = date("d M, Y", strtotime($purchase_time));

            $todays_timestamp = strtotime(date("d M, Y"));
            $support_expiry_timestamp = strtotime($support_until);

            $support_expiry_date = date("d M, Y", $support_expiry_timestamp);

            if ($todays_timestamp > $support_expiry_timestamp)
                $support_status = get_phrase('expired');
            else
                $support_status = get_phrase('valid');

            $returnable_array = array(
                'purchase_code_status' => $support_status,
                'support_expiry_date' => $support_expiry_date,
                'customer_name' => $customer
            );
        } else {
            $returnable_array = array(
                'purchase_code_status' => 'invalid',
                'support_expiry_date' => 'invalid',
                'customer_name' => 'invalid'
            );
        }

        return $returnable_array;
    }

    // Version 2.2 codes

    // This function is responsible for retreving all the language file from language folder
    function get_all_languages()
    {
        $language_files = array();
        $all_files = $this->get_list_of_language_files();
        foreach ($all_files as $file) {
            $info = pathinfo($file);
            if (isset($info['extension']) && strtolower($info['extension']) == 'json') {
                $file_name = explode('.json', $info['basename']);
                array_push($language_files, $file_name[0]);
            }
        }
        return $language_files;
    }

    // This function is responsible for showing all the installed themes
    function get_installed_themes($dir = APPPATH . '/views/frontend')
    {
        $result = array();
        $cdir = $files = preg_grep('/^([^.])/', scandir($dir));
        foreach ($cdir as $key => $value) {
            if (!in_array($value, array(".", ".."))) {
                if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
                    array_push($result, $value);
                }
            }
        }
        return $result;
    }

    // This function is responsible for showing all the uninstalled themes inside themes folder
    function get_uninstalled_themes($dir = 'themes')
    {
        $result = array();
        $cdir = $files = preg_grep('/^([^.])/', scandir($dir));
        foreach ($cdir as $key => $value) {
            if (!in_array($value, array(".", "..", ".DS_Store"))) {
                array_push($result, $value);
            }
        }
        return $result;
    }

    // This function is responsible for retreving all the language file from language folder
    function get_list_of_language_files($dir = APPPATH . '/language', &$results = array())
    {
        $files = scandir($dir);
        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = $path;
            } else if ($value != "." && $value != "..") {
                $this->get_list_of_directories_and_files($path, $results);
                $results[] = $path;
            }
        }
        return $results;
    }

    // This function is responsible for retreving all the files and folder
    function get_list_of_directories_and_files($dir = APPPATH, &$results = array())
    {
        $files = scandir($dir);
        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = $path;
            } else if ($value != "." && $value != "..") {
                $this->get_list_of_directories_and_files($path, $results);
                $results[] = $path;
            }
        }
        return $results;
    }

    function remove_files_and_folders($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir . "/" . $object) == "dir")
                        $this->remove_files_and_folders($dir . "/" . $object);
                    else unlink($dir . "/" . $object);
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }

    function get_category_wise_courses($category_id = "")
    {
        $category_details = $this->get_category_details_by_id($category_id)->row_array();

        if ($category_details['parent'] > 0) {
            $this->db->where('sub_category_id', $category_id);
        } else {
            $this->db->where('category_id', $category_id);
        }
        $this->db->where('status', 'active');
        return $this->db->get('course');
    }

    function activate_theme($theme_to_active)
    {
        $data['value'] = $theme_to_active;
        $this->db->where('key', 'theme');
        $this->db->update('frontend_settings', $data);
    }

    // code of mark this lesson as completed
    function save_course_progress()
    {
        $lesson_id = $this->input->post('lesson_id');
        $progress = $this->input->post('progress');
        $user_id = $this->session->userdata('user_id');
        $user_details = $this->user_model->get_all_user($user_id)->row_array();
        $watch_history = $user_details['watch_history'];
        $watch_history_array = array();
        if ($watch_history == '') {
            array_push($watch_history_array, array('lesson_id' => $lesson_id, 'progress' => $progress));
        } else {
            $founder = false;
            $watch_history_array = json_decode($watch_history, true);
            for ($i = 0; $i < count($watch_history_array); $i++) {
                $watch_history_for_each_lesson = $watch_history_array[$i];
                if ($watch_history_for_each_lesson['lesson_id'] == $lesson_id) {
                    $watch_history_for_each_lesson['progress'] = $progress;
                    $watch_history_array[$i]['progress'] = $progress;
                    $founder = true;
                }
            }
            if (!$founder) {
                array_push($watch_history_array, array('lesson_id' => $lesson_id, 'progress' => $progress));
            }
        }
        $data['watch_history'] = json_encode($watch_history_array);
        $this->db->where('id', $user_id);
        $this->db->update('users', $data);

        // CHECK IF THE USER IS ELIGIBLE FOR CERTIFICATE
        if (addon_status('certificate')) {
            $this->load->model('addons/Certificate_model', 'certificate_model');
            $this->certificate_model->check_certificate_eligibility("lesson", $lesson_id, $user_id);
        }

        return $progress;
    }


    //FOR MOBILE
    function enrol_to_free_course_mobile($course_id = "", $user_id = "")
    {
        $data['course_id'] = $course_id;
        $data['user_id'] = $user_id;
        $data['date_added'] = strtotime(date('D, d-M-Y'));
        if ($this->db->get_where('course', array('id' => $course_id))->row('is_free_course') == 1) :
            $this->db->insert('enrol', $data);
        endif;
    }

    function check_course_enrolled($course_id = "", $user_id = "")
    {
        return $this->db->get_where('enrol', array('course_id' => $course_id, 'user_id' => $user_id))->num_rows();
    }


    // GET PAYOUTS
    public function get_payouts($id = "", $type = "")
    {
        $this->db->order_by('id', 'DESC');
        if ($id > 0 && $type == 'user') {
            $this->db->where('user_id', $id);
        } elseif ($id > 0 && $type == 'payout') {
            $this->db->where('id', $id);
        }
        return $this->db->get('payout');
    }

    // GET COMPLETED PAYOUTS BY DATE RANGE
    public function get_completed_payouts_by_date_range($timestamp_start = "", $timestamp_end = "")
    {
        $this->db->order_by('id', 'DESC');
        $this->db->where('date_added >=', $timestamp_start);
        $this->db->where('date_added <=', $timestamp_end);
        $this->db->where('status', 1);
        return $this->db->get('payout');
    }

    // GET PENDING PAYOUTS BY DATE RANGE
    public function get_pending_payouts()
    {
        $this->db->order_by('id', 'DESC');
        $this->db->where('status', 0);
        return $this->db->get('payout');
    }

    // GET TOTAL PAYOUT AMOUNT OF AN INSTRUCTOR
    public function get_total_payout_amount($id = "")
    {
        $checker = array(
            'user_id' => $id,
            'status' => 1
        );
        $this->db->order_by('id', 'DESC');
        $payouts = $this->db->get_where('payout', $checker)->result_array();
        $total_amount = 0;
        foreach ($payouts as $payout) {
            $total_amount = $total_amount + $payout['amount'];
        }
        return $total_amount;
    }

    // GET TOTAL REVENUE AMOUNT OF AN INSTRUCTOR
    public function get_total_revenue($id = "")
    {
        $revenues = $this->get_instructor_revenue($id);
        $total_amount = 0;
        foreach ($revenues as $key => $revenue) {
            $total_amount = $total_amount + $revenue['instructor_revenue'];
        }
        return $total_amount;
    }

    // GET TOTAL PENDING AMOUNT OF AN INSTRUCTOR
    public function get_total_pending_amount($id = "")
    {
        $total_revenue = $this->get_total_revenue($id);
        $total_payouts = $this->get_total_payout_amount($id);
        $total_pending_amount = $total_revenue - $total_payouts;
        return $total_pending_amount;
    }

    // GET REQUESTED WITHDRAWAL AMOUNT OF AN INSTRUCTOR
    public function get_requested_withdrawal_amount($id = "")
    {
        $requested_withdrawal_amount = 0;
        $checker = array(
            'user_id' => $id,
            'status' => 0
        );
        $payouts = $this->db->get_where('payout', $checker);
        if ($payouts->num_rows() > 0) {
            $payouts = $payouts->row_array();
            $requested_withdrawal_amount = $payouts['amount'];
        }
        return $requested_withdrawal_amount;
    }

    // GET REQUESTED WITHDRAWALS OF AN INSTRUCTOR
    public function get_requested_withdrawals($id = "")
    {
        $requested_withdrawal_amount = 0;
        $checker = array(
            'user_id' => $id,
            'status' => 0
        );
        $payouts = $this->db->get_where('payout', $checker);

        return $payouts;
    }

    // ADD NEW WITHDRAWAL REQUEST
    public function add_withdrawal_request()
    {
        $user_id = $this->session->userdata('user_id');
        $total_pending_amount = $this->get_total_pending_amount($user_id);

        $requested_withdrawal_amount = $this->input->post('withdrawal_amount');
        if ($total_pending_amount > 0 && $total_pending_amount >= $requested_withdrawal_amount) {
            $data['amount'] = $requested_withdrawal_amount;
            $data['user_id'] = $this->session->userdata('user_id');
            $data['date_added'] = strtotime(date('D, d M Y'));
            $data['status'] = 0;
            $this->db->insert('payout', $data);
            $this->session->set_flashdata('flash_message', get_phrase('withdrawal_requested'));
        } else {
            $this->session->set_flashdata('error_message', get_phrase('invalid_withdrawal_amount'));
        }
    }

    // DELETE WITHDRAWAL REQUESTS
    public function delete_withdrawal_request()
    {
        $checker = array(
            'user_id' => $this->session->userdata('user_id'),
            'status' => 0
        );
        $requested_withdrawal = $this->db->get_where('payout', $checker);
        if ($requested_withdrawal->num_rows() > 0) {
            $this->db->where($checker);
            $this->db->delete('payout');
            $this->session->set_flashdata('flash_message', get_phrase('withdrawal_deleted'));
        } else {
            $this->session->set_flashdata('error_message', get_phrase('withdrawal_not_found'));
        }
    }

    // get instructor wise total enrolment. this function return the number of enrolment for a single instructor
    public function instructor_wise_enrolment($instructor_id)
    {
        $course_ids = $this->crud_model->get_instructor_wise_courses($instructor_id, 'simple_array');
        if (!count($course_ids) > 0) {
            return false;
        }
        $this->db->select('user_id');
        $this->db->where_in('course_id', $course_ids);
        return $this->db->get('enrol');
    }

    public function check_duplicate_payment_for_stripe($transaction_id = "", $stripe_session_id = "", $user_id = "")
    {
        if ($user_id == "") {
            $user_id = $this->session->userdata('user_id');
        }

        $query = $this->db->get_where('payment', array('user_id' => $user_id, 'transaction_id' => $transaction_id, 'session_id' => $stripe_session_id));
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_course_by_course_type($type = "")
    {
        if ($type != "") {
            $this->db->where('course_type', $type);
        }
        return $this->db->get('course');
    }

    public function check_recaptcha()
    {
        if (isset($_POST["g-recaptcha-response"])) {
            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $data = array(
                'secret' => get_frontend_settings('recaptcha_secretkey'),
                'response' => $_POST["g-recaptcha-response"]
            );
            $query = http_build_query($data);
            $options = array(
                'http' => array(
                    'header' => "Content-Type: application/x-www-form-urlencoded\r\n" .
                        "Content-Length: " . strlen($query) . "\r\n" .
                        "User-Agent:MyAgent/1.0\r\n",
                    'method' => 'POST',
                    'content' => $query
                )
            );
            $context = stream_context_create($options);
            $verify = file_get_contents($url, false, $context);
            $captcha_success = json_decode($verify);
            if ($captcha_success->success == false) {
                return false;
            } else if ($captcha_success->success == true) {
                return true;
            }
        } else {
            return false;
        }
    }

    function get_course_by_user($user_id = "", $course_type = "")
    {
        if ($course_type != "") {
            $this->db->where('course_type', $course_type);
        }
        $this->db->where('user_id', $user_id);
        return $this->db->get('course');
    }

    function get_all_levels()
    {
        $language_files = array();
        $all_files = $this->get_list_of_level_files();
        foreach ($all_files as $file) {
            $info = pathinfo($file);
            if (isset($info['extension']) && strtolower($info['extension']) == 'json') {
                $file_name = explode('.json', $info['basename']);
                array_push($language_files, $file_name[0]);
            }
        }
        return $language_files;
    }

    function get_list_of_level_files($dir = APPPATH . '/level', &$results = array())
    {
        $files = scandir($dir);
        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = $path;
            } else if ($value != "." && $value != "..") {
                $this->get_list_of_directories_and_files($path, $results);
                $results[] = $path;
            }
        }
        return $results;
    }

    /*----------------------- Start By vinay ---------------------------- */

    public function get_user($param1 = "")
    {
        if ($param1 != "") {
            $this->db->where('id', $param1);
        }
        $this->db->where('is_instructor', 1);
        $query = $this->db->get('users');

        return $query;
    }
    /*----------------------- End By vinay ---------------------------- */


    /*-------------------- Instructor Commission type Start By Vinay Kumar--------------------------------  */

    public function get_all_instructor_commission()
    {
        $sql = "SELECT * FROM instructor_commission";
        $query = $this->db->query($sql);
        return $query;
    }

    public function add_instructor_commission()
    {

        $data = [

            'amount' => $this->input->post('amount'),
            'commission_type' => $this->input->post('commission_type'),
        ];
        $this->db->insert('instructor_commission', $data);
    }

    public function update_instructor_commission($param)
    {

        $data = [
            'amount' => $this->input->post('amount'),
            'commission_type' => $this->input->post('commission_type'),
        ];
        $this->db->where('id', $param);
        $this->db->update('instructor_commission', $data);
    }


    public function show_instructor_commission_id($param)
    {
        $this->db->where('id', $param);
        $query = $this->db->get('instructor_commission');
        return $query->result_array();
    }


    public function delete_instructor_commission($param)
    {
        $this->db->where('id', $param);
        $this->db->delete('instructor_commission');
    }

    /*-------------------- Instructor Commission type End--------------------------------  */


    /*-------------------- Instructor payouts type Start By Vinay Kumar--------------------------------  */

    public function get_all_instructor_payouts()
    {
        //        $sql = "SELECT * FROM instructor_payouts";
        $this->db->order_by('id', 'DESC');
        $this->db->where('created_at >=', date("Y-m-01)"));
        $this->db->where('created_at <=', date("Y-m-t"));
        $query = $this->db->get('instructor_payouts');

        // print_r($query);
        // die;
        return $query;
    }

    public function add_instructor_payouts()
    {
        $data = [
            'user_id' => $this->input->post('user_id'),
            'start_date' => $this->input->post('start_date'),
            'end_date' => $this->input->post('end_date'),
            'duration' => $this->input->post('duration'),
            'commission_by_hours' => $this->input->post('commission_by_hours'),
            'total_hours' => $this->input->post('total_hours'),
            'total_amount' => $this->input->post('total_amount'),
            'payments_type' => $this->input->post('payments_type'),
        ];


        $this->db->insert('instructor_payouts', $data);
    }

    // public function update_instructor_payouts($param)
    // {
    //     // print_r($param);
    //     // die;

    //     $data = [
    //         'user_id' => $this->input->post('instructor_name'),
    //         'start_date' => $this->input->post('start_date'),
    //         'end_date' => $this->input->post('end_date'),
    //         'duration' => $this->input->post('commission_type'),
    //         'total_hours' => $this->input->post('qty'),
    //         'total_amount' => $this->input->post('total_amount'),
    //         'payments_type' => $this->input->post('payments_type'),
    //     ];


    //     $this->db->where('id', $param);
    //     $this->db->update('instructor_payouts', $data);
    // }


    public function update_instructor_payouts($param)
    {
        // print_r($param);
        // die;

        //        $data = [
        //            'user_id' => $this->input->post('instructor_name'),
        //            'start_date' => $this->input->post('start_date'),
        //            'end_date' => $this->input->post('end_date'),
        //            'duration' => $this->input->post('commission_type'),
        //            'total_hours' => $this->input->post('qty'),
        //            'total_amount' => $this->input->post('total_amount'),
        //            'payments_type' => $this->input->post('payments_type'),
        //        ];

        $data = [
            'user_id' => $this->input->post('user_id'),
            'start_date' => $this->input->post('start_date'),
            'end_date' => $this->input->post('end_date'),
            'duration' => $this->input->post('duration'),
            'commission_by_hours' => $this->input->post('commission_by_hours'),
            'total_hours' => $this->input->post('total_hours'),
            'total_amount' => $this->input->post('total_amount'),
            'payments_type' => $this->input->post('payments_type'),
        ];

        $this->db->where('id', $param);
        $this->db->update('instructor_payouts', $data);
    }


    public function show_instructor_payouts_id($param)
    {
        $this->db->where('id', $param);
        $query = $this->db->get('instructor_payouts');
        return $query->result_array();
    }


    public function delete_instructor_payouts($param)
    {

        $this->db->where('id', $param);
        $this->db->delete('instructor_payouts');
    }

    public function update_status_in_payouts($param, $param2)
    {
        // print_r($param);
        //     die;
        if ($param2 == 0) {
            $data = [
                "status" => "0",
            ];
        } else {
            $data = [
                "status" => "1",
            ];
        }
        $this->db->where('id', $param);
        $this->db->update('instructor_payouts', $data);
    }

    /*-------------------- Instructor payouts type End--------------------------------  */


    /********************* Chanchal Start Code *********************/

    public function show_courses($param)
    {
        //        $this->db->like('user_id', "%" . $param . "%");
        $this->db->select('*');
        $this->db->from('course');
        $this->db->where("user_id LIKE '%$param%'");
        $result = $this->db->get()->result_array();
        return $result;
    }


    /************** Chanchal Code Start For Batch Model *************/

    public function get_all_batch()
    {
        $sql = "SELECT * FROM batch_model";
        $query = $this->db->query($sql);
        return $query;
    }

    public function get_all_batch_by_instructor($param)
    {
        $this->db->where("instructor_id LIKE '%" . $param . "%'");
        $query = $this->db->get('batch_model');
        return $query;
    }

    public function get_course_by_user_id($params)
    {
        //        $this->db->where_in('user_id', $params);

        $this->db->where("user_id LIKE '%$params%'");
        $query = $this->db->get('course');
        return $query->result_array();
    }

    public function add_batch_model()
    {
        $data = [
            'students_id' => implode(",", $this->input->post('students')),
//            'course_id' => implode(",", $this->input->post('course_name')),
            'course_id' => $this->input->post('course_name'),
            'instructor_id' => implode(",", $this->input->post('instructor_name')),
            'batch_limit' => $this->input->post('batch_limit'),
            'date' => $this->input->post('date'),
            'time' => $this->input->post('time'),
            'duration' => $this->input->post('duration'),
            'country_id' => $this->input->post('country'),
            'state_id' => $this->input->post('state'),
            'city_id' => $this->input->post('city'),
        ];

        $this->db->insert('batch_model', $data);
    }

    public function update_batch_model($param)
    {
        $data = [
            'students_id' => implode(",", $this->input->post('students')),
            'course_id' => $this->input->post('course_name'),
//            'course_id' => implode(",", $this->input->post('course_name')),
            'instructor_id' => implode(",", $this->input->post('instructor_name')),
            'batch_limit' => $this->input->post('batch_limit'),
            'date' => $this->input->post('date'),
            'time' => $this->input->post('time'),
            'duration' => $this->input->post('duration'),
            'country_id' => $this->input->post('country'),
            'state_id' => $this->input->post('state'),
            'city_id' => $this->input->post('city'),
        ];
        $this->db->where('id', $param);
        $this->db->update('batch_model', $data);
    }

    public function delete_batch_model($param)
    {
        $this->db->where('id', $param);
        $this->db->delete('batch_model');
    }

    public function show_batch_model_by_id($param)
    {
        $this->db->where('id', $param);
        $query = $this->db->get('batch_model');
        return $query->result_array();
    }

    public function get_course($params)
    {
        $this->db->where('id', $params);
        $query = $this->db->get('course');
        return $query->result_array();
    }

    public function get_user_by_id($param)
    {
        $this->db->where('id', $param);
        $query = $this->db->get('users');
        return $query->result_array();
    }

    public function batch_limit_add($data)
    {
        $this->db->where('course_id', $data['course_id']);
        $get_limit = $this->db->get('batch_limit');
        if ($data['limit'] != "") {

            $this->db->where('course_id', $data['course_id']);
            $get_limit = $this->db->get('batch_limit');

            if ($get_limit->num_rows() > 0) {
                $this->batch_limit_update($data);
            } else {
                $this->db->insert('batch_limit', $data);
            }
        }
    }

    public function batch_limit_update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('batch_limit', array('limit' => $data['limit']));
    }

    public function batch_limit_delete($data)
    {
        $this->db->where('id', $data);
        $this->db->delete('batch_limit');
    }

    public function get_all_batch_limit($param = '')
    {
        if ($param == "") {

        } else {
            $this->db->where('id', $param);
        }
        return $this->db->get('batch_limit');
    }

    /************** Chanchal Code End For Batch Model ***************/


    /************** Chanchal Code Start For attendance model ***************/

    public function add_attendance()
    {

        $data = [
            'batch_id' => $this->input->post('batch'),
            'course_id' => $this->input->post('course_name'),
            'instructor_id' => $this->input->post('instructor_id'),
            'duration' => $this->input->post('duration'),
            'date' => date('y-m-d'),
            'start_time' => $this->input->post('start_time'),
            'end_time' => $this->input->post('end_time')
        ];


        $this->db->insert('attendance', $data);
    }

    public function get_all_attendance_by_instructor($params)
    {
        $this->db->order_by('id', 'DESC');
        $this->db->where('created_at >=', date("Y-m-01"));
        $this->db->where('created_at <=', date("Y-m-t"));
        $this->db->where("instructor_id LIKE '%$params%'");
        $query = $this->db->get('attendance');
        return $query->result_array();
    }

    public function update_attendance_end_time($param)
    {
        date_default_timezone_set("Asia/Kolkata");
        $data = [
            'end_time' => date('H:i:s'),
        ];
        $this->db->where('id', $param);
        $this->db->update('attendance', $data);
    }

    public function update_attendance($param)
    {

        $data = [
            'batch_id' => $this->input->post('batch'),
            'course_id' => $this->input->post('course_name'),
            //            'instructor_id' => $this->input->post('instructor_id'),
            'duration' => $this->input->post('duration'),
            'date' => date('y-m-d'),
            'start_time' => $this->input->post('start_time'),
            'end_time' => $this->input->post('end_time')
        ];


        $this->db->where('id', $param);
        $this->db->update('attendance', $data);
    }

    public function get_all_attendance_by_id($param)
    {
        $this->db->where("id LIKE '%$param%'");
        $query = $this->db->get('attendance');
        return $query->result_array();
    }

    public function get_attendance_by_date_range($timestamp_start = "", $timestamp_end = "", $param3 = "", $param4 = '')
    {
        if ($param3 == "all") {
            $this->db->order_by('id', 'DESC');
            $this->db->where('created_at >=', date("Y-m-d", $timestamp_start));
            $this->db->where('created_at <=', date("Y-m-d", $timestamp_end));
            $this->db->where('end_time !=', "");
            $this->db->where('instructor_id LIKE', '%' . $param4 . '%');
            return $this->db->get('attendance')->result_array();
        } else {
            $this->db->order_by('id', 'DESC');
            $this->db->where('date >=', date("Y-m-d", $timestamp_start));
            $this->db->where('date <=', date("Y-m-d", $timestamp_end));
            $this->db->where('end_time !=', "");
            $this->db->where('duration LIKE', '%' . $param3 . '%');
            $this->db->where('instructor_id LIKE', '%' . $param4 . '%');

            return $this->db->get('attendance')->result_array();
        }
    }

    public function update_status_in_attendance($param, $param2)
    {
        if ($param2 == 0) {
            $data = [
                "status" => "0",
            ];
        } else {
            $data = [
                "status" => "1",
            ];
        }
        $this->db->where('id', $param);
        $this->db->update('attendance', $data);
    }

    public function total_number_of_attendance_by_month($param)
    {
        $this->db->where('date >=', date("Y-m-01"));
        $this->db->where('date <=', date("Y-m-t"));
        $this->db->where('instructor_id LIKE', '%' . $param . '%');
        $this->db->where('end_time !=', "");


        return $this->db->get('attendance')->num_rows();
    }


    public function delete_attendance_list($param)
    {
        $this->db->where('id', $param);
        $this->db->delete('attendance');
    }


    public function get_salary_slip_by_id($param, $user_id = "")
    {
        $this->db->where('id', $param);
        //        $this->db->where('user_id LIKE', '%' . $param . '%');
        return $this->db->get('instructor_payouts')->result_array();
    }

    public function get_salary_slip_by_user_id($user_id)
    {

        $this->db->where('user_id', $user_id);
        //        $this->db->where('user_id LIKE', '%' . $param . '%');
        return $this->db->get('instructor_payouts')->result_array();
    }

    /************** Chanchal Code End For attendance model *****************/


    /********************* Start Code Salary Slip *********************/
    public function get_by_instructor_id_salary_slip($param)
    {
        $this->db->order_by('id', 'DESC');
        $this->db->where('user_id LIKE', '%' . $param . '%');
        return $this->db->get('instructor_payouts')->result_array();
    }

    public function get_by_month_salary_slip($param, $param2)
    {
        if ($param2 == "") {
            $this->db->where('created_at >=', date("Y-m-01"));
            $this->db->where('created_at <=', date("Y-m-t"));
        } else {
            $this->db->where('MONTHNAME(created_at) = ', $param2);
        }
        $this->db->where('user_id LIKE', '%' . $param . '%');
        return $this->db->get('instructor_payouts')->result_array();
    }

    /********************* End Code Salary Slip ***********************/


    public function array_to_coma_separator($array_data)
    {
        $convert_data = "";
        foreach ($array_data as $key => $data_key) {
            if ($convert_data == "") {
                if ($data_key == "") {
                    $convert_data = "0";
                } else {

                    $convert_data = $data_key;
                }
            } else {
                if ($data_key == "") {
                    $convert_data = $convert_data . "," . "0";
                } else {
                    $convert_data = $convert_data . "," . $data_key;
                }
            }
        }
        return $convert_data;
    }

    /********************* Start Code Payout ***********************/

    public function get_by_month_payout($param)
    {
        if ($param == "") {
            $this->db->where('created_at >=', date("Y-m-01"));
            $this->db->where('created_at <=', date("Y-m-t"));
        } else {
            $this->db->where('MONTHNAME(created_at) = ', $param);
        }
        return $this->db->get('instructor_payouts')->result_array();
    }
    /********************* End Code Payout ***********************/

    /************** Start Code Enrol by course new theme ****************/
    public function get_enroll_by_course_id($param, $country = '', $state = '', $city = '')
    {
        $this->db->from('enrol');

        $this->db->join('user_location', 'enrol.user_id = user_location.user_id');
        $this->db->join('users', 'users.id = user_location.user_id');

        $this->db->where('course_id', $param);
        $this->db->where('country_id', $country);
        $this->db->where('state_id', $state);
        $this->db->where('city_id', $city);
        $this->db->where('is_instructor', '0');
        return $this->db->get();
    }

    public function get_enroll_by_payment_id($param)
    {
        $this->db->where('tr_num', $param);
        return $this->db->get("enrol");
    }

    public function get_total_duration_of_lesson_by_course_id_in_hours($course_id)
    {
        $total_duration = 0;
        $lessons = $this->crud_model->get_lessons('course', $course_id)->result_array();
        foreach ($lessons as $lesson) {
            if ($lesson['lesson_type'] != "other") {
                $time_array = explode(':', $lesson['duration']);
                $hour_to_seconds = $time_array[0] * 60 * 60;
                $minute_to_seconds = $time_array[1] * 60;
                $seconds = $time_array[2];
                $total_duration += $hour_to_seconds + $minute_to_seconds + $seconds;
            }
        }
        // return gmdate("H:i:s", $total_duration).' '.get_phrase('hours');
        $hours = floor($total_duration / 3600);
        $minutes = floor(($total_duration % 3600) / 60);
        $seconds = $total_duration % 60;
        return sprintf("%02d:%02d", $hours, $minutes) . ' ' . get_phrase('hours');
    }

    public function course_icon_by_id($param)
    {
        $this->db->where('course_id', $param);
        return $this->db->get("course_icon")->result_array();
    }

    public function all_number_of_ratings_by_course_id($param, $is_total_number = false, $param3 = '')
    {
        if ($is_total_number == true) {
            $this->db->where('status', '1');
            $this->db->where('ratable_id', $param);
            return $this->db->get('rating')->num_rows();
        } elseif ($param3 == 'admin') {
            $this->db->where('ratable_id', $param);
            return $this->db->get('rating');
        } else {
            $this->db->where('status', '1');
            $this->db->where('ratable_id', $param);
            return $this->db->get('rating')->result_array();
        }
    }

    public function get_number_of_rating_by_rating_course_id($param, $param1)
    {
        $this->db->where('status', '1');
        $this->db->where('rating', $param);
        $this->db->where('ratable_id', $param1);
        return $this->db->get("rating")->num_rows();
    }

    public function get_course_by_category_id($param)
    {
        $this->db->where('category_id', $param);
        $this->db->where('status', 'active');
        return $this->db->get('course');

    }

    public function get_only_user()
    {
        $this->db->where('role_id', '2');
        $this->db->where('is_instructor', '0');
        return $this->db->get('users');
    }


    /************** End Code Enrol by course new theme ******************/


    /************** Start Code for blog ******************/
    public function add_blog_category()
    {
        $title = $this->input->post('title');
        $data = [
            'title' => $title,
            'slug' => str_replace(' ', '_', $title),
            'icon' => $this->input->post('font_awesome_class'),
            'image' => $this->resize_image($_FILES['image']['name'], $_FILES['image']['tmp_name'], "blog/category_image", 200, 100),
        ];
        $this->db->insert('blog_category', $data);
    }

    public function update_blog_category($param)
    {

        $title = $this->input->post('title');
        $data = [
            'title' => $title,
            'slug' => str_replace(' ', '_', $title),
            'icon' => $this->input->post('font_awesome_class'),
        ];
        $this->db->where("slug", $param);
        $this->db->update('blog_category', $data);
    }

    public function get_all_blog_category()
    {
        return $this->db->get('blog_category');
    }

    public function get_by_id_and_slug_blog_category($param)
    {
        if ($param) {
            $this->db->where("id", $param);
            $num = $this->db->get('blog_category')->num_rows();
            if ($num == 0) {
                $this->db->where("slug", $param);
                return $this->db->get('blog_category');
            } else {
                $this->db->where("id", $param);
                return $this->db->get('blog_category');
            }
        }
    }

    public function add_blog()
    {
        $data = [
            'title' => $this->input->post("title"),
            'blog_category_id' => $this->input->post("category_id"),
            'short_description' => $this->input->post("short_dis"),
            'description' => $this->input->post("blog"),
            'banner' => $this->resize_image($_FILES['banner_image']['name'], $_FILES['banner_image']['tmp_name'], 'blog/banner', 1920, 500),
            'content_image' => $this->resize_image($_FILES['content_image']['name'], $_FILES['content_image']['tmp_name'], 'blog/content_image', 720, 450),
            'thumbnail' => $this->resize_image($_FILES['thumb_image']['name'], $_FILES['thumb_image']['tmp_name'], 'blog/thumb', 270, 350),
            'user_id' => $_SESSION['user_id'],
        ];
        $this->db->insert('blog', $data);

    }

    public function edit_blog($param)
    {
        if ($_FILES['banner_image']['name'] == "" && $_FILES['content_image']['name'] == "" && $_FILES['thumb_image']['name'] == "") {
            $data = [
                'title' => $this->input->post("title"),
                'blog_category_id' => $this->input->post("category_id"),
                'short_description' => $this->input->post("short_dis"),
                'description' => $this->input->post("blog"),
//                'banner' => $this->resize_image($_FILES['banner_image']['name'], $_FILES['banner_image']['tmp_name'], 'banner', 1920, 500),
//                'content_image' => $this->resize_image($_FILES['content_image']['name'], $_FILES['content_image']['tmp_name'], 'content_image', 720, 450),
//                'thumbnail' => $this->resize_image($_FILES['thumb_image']['name'], $_FILES['thumb_image']['tmp_name'], 'thumb', 270, 350),
                'user_id' => $_SESSION['user_id'],
            ];
        } elseif ($_FILES['banner_image']['name'] == "" && $_FILES['content_image']['name'] == "") {
            $data = [
                'title' => $this->input->post("title"),
                'blog_category_id' => $this->input->post("category_id"),
                'short_description' => $this->input->post("short_dis"),
                'description' => $this->input->post("blog"),
                'thumbnail' => $this->resize_image($_FILES['thumb_image']['name'], $_FILES['thumb_image']['tmp_name'], 'blog/thumb', 270, 350),
                'user_id' => $_SESSION['user_id'],
            ];
        } elseif ($_FILES['content_image']['name'] == "" && $_FILES['thumb_image']['name'] == "") {
            $data = [
                'title' => $this->input->post("title"),
                'blog_category_id' => $this->input->post("category_id"),
                'short_description' => $this->input->post("short_dis"),
                'description' => $this->input->post("blog"),
                'banner' => $this->resize_image($_FILES['banner_image']['name'], $_FILES['banner_image']['tmp_name'], 'blog/banner', 1920, 500),
                'user_id' => $_SESSION['user_id'],
            ];
        } elseif ($_FILES['thumb_image']['name'] == "" && $_FILES['banner_image']['name'] == "") {
            $data = [
                'title' => $this->input->post("title"),
                'blog_category_id' => $this->input->post("category_id"),
                'short_description' => $this->input->post("short_dis"),
                'description' => $this->input->post("blog"),
                'content_image' => $this->resize_image($_FILES['content_image']['name'], $_FILES['content_image']['tmp_name'], 'blog/content_image', 720, 450),
                'user_id' => $_SESSION['user_id'],
            ];
        } elseif ($_FILES['content_image']['name'] == "") {
            $data = [
                'title' => $this->input->post("title"),
                'blog_category_id' => $this->input->post("category_id"),
                'short_description' => $this->input->post("short_dis"),
                'description' => $this->input->post("blog"),
                'banner' => $this->resize_image($_FILES['banner_image']['name'], $_FILES['banner_image']['tmp_name'], 'blog/banner', 1920, 500),
                'thumbnail' => $this->resize_image($_FILES['thumb_image']['name'], $_FILES['thumb_image']['tmp_name'], 'blog/thumb', 270, 350),
                'user_id' => $_SESSION['user_id'],
            ];
        } elseif ($_FILES['thumb_image']['name'] == "") {
            $data = [
                'title' => $this->input->post("title"),
                'blog_category_id' => $this->input->post("category_id"),
                'short_description' => $this->input->post("short_dis"),
                'description' => $this->input->post("blog"),
                'banner' => $this->resize_image($_FILES['banner_image']['name'], $_FILES['banner_image']['tmp_name'], 'blog/banner', 1920, 500),
                'content_image' => $this->resize_image($_FILES['content_image']['name'], $_FILES['content_image']['tmp_name'], 'blog/content_image', 720, 450),
                'user_id' => $_SESSION['user_id'],
            ];
        } elseif ($_FILES['banner_image']['name'] == "") {
            $data = [
                'title' => $this->input->post("title"),
                'blog_category_id' => $this->input->post("category_id"),
                'short_description' => $this->input->post("short_dis"),
                'description' => $this->input->post("blog"),
                'content_image' => $this->resize_image($_FILES['content_image']['name'], $_FILES['content_image']['tmp_name'], 'blog/content_image', 720, 450),
                'thumbnail' => $this->resize_image($_FILES['thumb_image']['name'], $_FILES['thumb_image']['tmp_name'], 'blog/thumb', 270, 350),
                'user_id' => $_SESSION['user_id'],
            ];
        } else {
            $data = [
                'title' => $this->input->post("title"),
                'blog_category_id' => $this->input->post("category_id"),
                'short_description' => $this->input->post("short_dis"),
                'description' => $this->input->post("blog"),
                'banner' => $this->resize_image($_FILES['banner_image']['name'], $_FILES['banner_image']['tmp_name'], 'blog/banner', 1920, 500),
                'content_image' => $this->resize_image($_FILES['content_image']['name'], $_FILES['content_image']['tmp_name'], 'blog/content_image', 720, 450),
                'thumbnail' => $this->resize_image($_FILES['thumb_image']['name'], $_FILES['thumb_image']['tmp_name'], 'blog/thumb', 270, 350),
                'user_id' => $_SESSION['user_id'],
            ];
        }

//        print_r($param);
//        die();
        $this->db->where("id", $param);
        $this->db->update('blog', $data);
    }

    public function get_all_blog()
    {
        $this->db->order_by("created_at", "desc");
        return $this->db->get("blog");
    }

    public function get_blog_by_id($param)
    {
        $this->db->where('id', $param);
        return $this->db->get('blog');
    }

    public function get_category_by_blog($param)
    {
        return $this->db->where("blog_category_id", $param);
    }


    /************** Start Blog Comment Area **************/

    public function add_blog_comment()
    {
        if (!$this->session->userdata('user_login')) {
            redirect(site_url('home/login'), 'refresh');
        } else {
            $data = [
                'blog_id' => $this->input->post("blog_id"),
                'user_id' => $_SESSION['user_id'],
                'comment_text' => $this->input->post("comment"),
                'status' => "1"
            ];
            $this->db->insert("blog_comment", $data);
        }
    }

    public function get_all_blog_comment()
    {
        $this->db->where('status', '1');
        return $this->db->get('blog_comment');
    }

    public function get_all_blog_comment_by_blog_id($param, $param2 = "")
    {
        if ($param2 == "admin") {

        } else {
            $this->db->where('status', '1');
        }
        $this->db->where('blog_id', $param);
        return $this->db->get('blog_comment');
    }

    public function action_on_status($param, $param2)
    {
        $this->db->where('id', $param);
        $comment_data = $this->db->get($param2)->result_array();

        if ($comment_data[0]['status'] == "0") {
            $data = [
                "status" => "1"
            ];
            $this->db->where('id', $param);
            $this->db->update($param2, $data);
            return true;
        } else {
            $data = [
                "status" => "0"
            ];
            $this->db->where('id', $param);
            $this->db->update($param2, $data);
            return true;
        }
    }

    /**************  End Blog Comment Area  **************/

    /**************  Start Blog Comment Reply Code  **************/
    public function add_blog_comment_reply()
    {
        if (!$this->session->userdata('user_login')) {
            redirect(site_url('home/login'), 'refresh');
        } else {
            $data = [
                'comment_id' => $this->input->post('blog_comment_id'),
                'blog_id' => $this->input->post('blog_id'),
                'user_id' => $_SESSION['user_id'],
                'reply_text' => $this->input->post('reply_text'),
                'status' => '1'
            ];
            $this->db->insert('blog_comment_thread', $data);
        }
    }

    public function get_all_blog_reply()
    {
        $this->db->where('status', '1');
        return $this->db->get('blog_comment_thread');
    }

    public function get_blog_reply_by_comment_id($param)
    {
        $this->db->where("comment_id", $param);
        $this->db->where('status', '1');
        return $this->db->get('blog_comment_thread');
    }

    public function get_blog_reply_by_comment_id_admin($param)
    {
        $this->db->where("comment_id", $param);
//        $this->db->where('status', '0');
        return $this->db->get('blog_comment_thread');
    }

    public function action_on_status_reply($param, $table_name)
    {
        $this->db->where('id', $param);
        $comment_data = $this->db->get($table_name)->result_array();

        if ($comment_data[0]['status'] == "0") {
            $data = [
                "status" => "1"
            ];
            $this->db->where('id', $param);
            $this->db->update($table_name, $data);
            return 1;
        } else {
            $data = [
                "status" => "0"
            ];
            $this->db->where('id', $param);
            $this->db->update($table_name, $data);
            return 0;
        }
    }

    /**************   End Blog Comment Reply Code   **************/

    public function resize_image($image_name, $image_temp_name, $upload_file_name, $width, $height)
    {

        $image_name_random = strtoupper(random(5)) . rand(1111, 9999) .
            strtoupper(random_string('alnum', 1));

        $config['image_library'] = 'gd2';
        $config['source_image'] = $image_temp_name;
//        $config['create_thumb'] = TRUE;
        $config['overwrite'] = false;
        $config['thumb_marker'] = ""; // REMOVE AFTER IMAGE NAME _thumb ADDED
        $config['maintain_ratio'] = false;
        $config['width'] = $width;
        $config['height'] = $height;

        $config['new_image'] = 'uploads/' . $upload_file_name . '/' . $image_name_random . $image_name;


        $this->load->library('image_lib', $config);
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        $this->image_lib->clear();


        return $image_name_random . $image_name;
    }

    /**************  End Code for blog  ******************/


    /**************  Start Code for Testimonial  ******************/
    public function add_testimonial_category()
    {
        $title = $this->input->post('title');
        $data = [
            'title' => $title,
            'slug' => str_replace(' ', '_', $title),
            'icon' => $this->input->post('font_awesome_class'),
            'image' => $this->resize_image($_FILES['image']['name'], $_FILES['image']['tmp_name'], "testimonial/category_image", 200, 100),
        ];
        $this->db->insert("testimonial_category", $data);
    }

    public function edit_testimonial_category($param)
    {
        $title = $this->input->post('title');
        if ($_FILES['image']['name'] == "") {
            $data = [
                'title' => $title,
                'slug' => str_replace(' ', '_', $title),
                'icon' => $this->input->post('font_awesome_class'),
//                'image' => $this->resize_image($_FILES['image']['name'], $_FILES['image']['tmp_name'], "testimonial/category_image", 200, 100),
            ];
        } else {
            $data = [
                'title' => $title,
                'slug' => str_replace(' ', '_', $title),
                'icon' => $this->input->post('font_awesome_class'),
                'image' => $this->resize_image($_FILES['image']['name'], $_FILES['image']['tmp_name'], "testimonial/category_image", 200, 100),
            ];
        }

        $this->db->where("slug", $param);
        $this->db->update('testimonial_category', $data);

    }

    public function get_testimonial_by_slug_and_id($param)
    {
        if ($param) {
            $this->db->where("id", $param);
            $num = $this->db->get('testimonial_category')->num_rows();
            if ($num == 0) {
                $this->db->where("slug", $param);
                return $this->db->get('testimonial_category');
            } else {
                $this->db->where("id", $param);
                return $this->db->get('testimonial_category');
            }
        }
    }

    public function get_all_testimonial_category()
    {
        $this->db->order_by("created_at", "desc");
        return $this->db->get('testimonial_category');
    }


    public function add_testimonial()
    {
        $data = [
            'testimonial_category_id' => $this->input->post('testimonial_category_id'),
            'testimonial_text' => $this->input->post('testimonial'),
            'rating' => $this->input->post('rating'),
            'user_id' => $this->session->userdata('user_id'),
            'writer_name' => $this->input->post('writer_name'),

        ];

        if (!file_exists('uploads/testimonial/writer_image')) {
            mkdir('uploads/testimonial/writer_image', 0777, true);
        }
        $data['writer_image'] = $this->resize_image($_FILES['writer_image']['name'], $_FILES['writer_image']['tmp_name'], "testimonial/writer_image/", 100, 100);

        $this->db->insert('testimonial', $data);
    }

    public function get_all_testimonial()
    {
        $this->db->order_by("created_at", "desc");
        return $this->db->get('testimonial');
    }

    public function get_testimonial_by_id($param)
    {
        $this->db->where('id', $param);
        return $this->db->get('testimonial');
    }

    public function edit_testimonial($param)
    {
        $data = [
            'testimonial_category_id' => $this->input->post('testimonial_category_id'),
            'testimonial_text' => $this->input->post('testimonial'),
            'rating' => $this->input->post('rating'),
            'user_id' => $this->session->userdata('user_id'),
            'writer_name' => $this->input->post('writer_name'),
        ];
        $old_img = $this->input->post('writer_image_old');

        if ($_FILES['writer_image']['name'] != '') {
            unlink('uploads/testimonial/writer_image/' . $old_img);
            $data['writer_image'] = $this->resize_image($_FILES['writer_image']['name'], $_FILES['writer_image']['tmp_name'], "testimonial/writer_image/", 100, 100);
        } else {
            $data['writer_image'] = $old_img;
        }

        $this->db->where('id', $param);
        $this->db->update("testimonial", $data);
    }

    /**************   End Code for Testimonial   ******************/


    /**************   Start Code for Razorpay   ******************/
    public function update_user_contact($param, $param1)
    {
        $data['contact'] = $param1;
        $this->db->where('id', $param);
        $this->db->update('users', $data);
    }

    public function update_razorpay_settings()
    {
        $razorpay_info = array();

        $razorpay['active'] = $this->input->post('stripe_active');
        $razorpay['testmode'] = $this->input->post('testmode');
        $razorpay['public_key'] = $this->input->post('public_key');
        $razorpay['secret_key'] = $this->input->post('secret_key');
        $razorpay['public_live_key'] = $this->input->post('public_live_key');
        $razorpay['secret_live_key'] = $this->input->post('secret_live_key');

        array_push($razorpay_info, $razorpay);

        $data['value'] = json_encode($razorpay_info);
        $this->db->where('key', 'razorpay');
        $this->db->update('settings', $data);

        $data['value'] = html_escape($this->input->post('razorpay_currency'));
        $this->db->where('key', 'razorpay_currency');
        $this->db->update('settings', $data);
    }

    public function payment_transaction($data, $table_name)
    {
        $this->db->insert($table_name, $data);
    }

    public function get_all_transaction_history($param = '')
    {
        $this->db->order_by("created_at", "desc");
        return $this->db->get('payment_transaction');
    }

    public function get_all_transaction_history_by_payment_id($param)
    {
        $this->db->where('payment_id', $param);
        return $this->db->get('payment_transaction');
    }

    public function get_all_transaction_history_by_user_id($param)
    {
        $this->db->order_by("created_at", "desc");
        $this->db->where('user_id', $param);
        return $this->db->get('payment_transaction');
    }

    public function get_all_transaction_history_status_pending()
    {
        $this->db->order_by("created_at", "desc");
        $this->db->where('status', 'pending');
        return $this->db->get('payment_transaction');
    }

    /**************    End Code for Razorpay    ******************/


    /**************  Start Code for Course Review  ******************/
    public function get_reviews_reply($param, $param2 = "")
    {
        if ($param2 == "admin") {
            $this->db->where('rating_id', $param);
        } else {
            $this->db->where('status', '1');
            $this->db->where('rating_id', $param);
        }
        return $this->db->get('rating_reply');

    }

    public function get_courses_review_reply_by_rating_id($param)
    {
        $this->db->where("rating_id", $param);
        $this->db->where('status', '1');
        return $this->db->get('rating_reply');
    }

    public function transaction_history_by_date_range($timestamp_start = "", $timestamp_end = "")
    {
        $this->db->order_by('created_at', 'desc');
        $this->db->where('created_at >=', date('Y-m-d H:m:s', $timestamp_start));
        $this->db->where('created_at <=', date('Y-m-d H:m:s', $timestamp_end));
        return $this->db->get('payment_transaction');
    }

    /**************   End Code for Course Review   ******************/


    /************   Start Code for Course Documents   ****************/
    public function course_documents()
    {
        $course_id = $this->input->post('course_id');
        $doc_text = $this->input->post('doc_text');

        $this->db->where('course_id', $course_id);
        $num_row = $this->db->get('course_documents')->num_rows();
//        $documents_data = $this->db->get('course_documents')->row_array();
        $data = [
            'course_id' => $this->input->post('course_id'),
            'document_text' => $this->input->post('doc_text')
        ];

        if ($num_row > 0) {
            $sql = "UPDATE `course_documents` SET `document_text` = '$doc_text'  WHERE `course_documents`.`course_id` = '$course_id'";
            $this->db->query($sql);
        } else {
            $data = [
                'course_id' => $this->input->post('course_id'),
                'document_text' => $this->input->post('doc_text')
            ];
            $this->db->insert('course_documents', $data);
        }
//            print_r($this->db->get_compiled_select());

    }

    public function get_course_documents($param = '')
    {
        if ($param != "") {
            $this->db->where('id', $param);
        }
        return $this->db->get('course_documents');
    }

    public function get_course_documents_by_course_id($param)
    {
        $this->db->where('course_id', $param);
        return $this->db->get('course_documents');

    }
    /************    End Code for Course Documents    ****************/

    /************    Start Code for Offline Payment     ****************/
    public function get_offline_payment($param = '')
    {
        if ($param != '') {
            $this->db->where('tr_num', $param);
        }
        return $this->db->get('offline_payment');


    }

    public function installment_repay($param)
    {

    }
    /************     End Code for Offline Payment      ****************/

    /************     End Code for Enquiry Form      ****************/
    public function enquiry_form($param = '')
    {
        if ($param == '') {
            $data = [
                'name' => $this->input->post('contact-name'),
                'email' => $this->input->post('contact-email'),
                'phone' => $this->input->post('contact-phone'),
                'massage' => $this->input->post('contact-message'),
            ];
            $this->db->insert('enquiry', $data);
        } elseif ($param == 'get_all') {
            $this->db->order_by('created_at', 'DESC');
            return $this->db->get('enquiry');
        }
    }
    /************     End Code for Enquiry Form      ****************/

    /************     Start Code for Enrol Pending Amount  **********/
    public function pending_amount()
    {
        $this->db->order_by('created_at', 'DESC');
        $this->db->where('status', 'pending');
        return $this->db->get('payment_transaction');
    }
    /************      End Code for Enrol Pending Amount   **********/


    /************     Start Code for Branch Location  **********/
    public function add_branch()
    {
        $data['branch_name'] = html_escape($this->input->post('branch_name'));
        $data['address'] = html_escape($this->input->post('address'));
        $data['email'] = html_escape($this->input->post('email'));
        $data['google_map_link'] = html_escape($this->input->post('g_map_link'));
        $data['city'] = html_escape($this->input->post('city'));
        $data['state'] = html_escape($this->input->post('state'));

        $data['branch_image'] = $this->resize_image($_FILES['branch_image']['name'], $_FILES['branch_image']['tmp_name'], "branch_image", 390, 390);

        $social_links = array(
            'facebook' => $this->input->post('facebook'),
            'twitter' => $this->input->post('twitter'),
            'linkedin' => $this->input->post('linked')
        );
        $data['social_link'] = json_encode($social_links);
        $this->db->insert('branch_location', $data);

    }

    public function update_branch($param)
    {
        $data['branch_name'] = html_escape($this->input->post('branch_name'));
        $data['address'] = html_escape($this->input->post('address'));
        $data['email'] = html_escape($this->input->post('email'));
        $data['google_map_link'] = html_escape($this->input->post('g_map_link'));
        $data['city'] = html_escape($this->input->post('city'));
        $data['state'] = html_escape($this->input->post('state'));
        $old_img = html_escape($this->input->post('branch_image1'));


        if ($_FILES['branch_image']['name'] != "") {
            if (file_exists('uploads/branch_image/' . $old_img)) {
                unlink('uploads/branch_image/' . $old_img);
            }
            $data['branch_image'] = $this->resize_image($_FILES['branch_image']['name'], $_FILES['branch_image']['tmp_name'], "branch_image", 390, 390);
        } else {
            $data['branch_image'] = $old_img;
        }

        $social_links = array(
            'facebook' => $this->input->post('facebook'),
            'twitter' => $this->input->post('twitter'),
            'linkedin' => $this->input->post('linked')
        );
        $data['social_link'] = json_encode($social_links);

        $this->db->where('id', $param);
        $this->db->update('branch_location', $data);
    }
    /************      End Code for Branch Location   **********/


    public function latest_batch(){
        date_default_timezone_set('Asia/Kolkata');
        $this->db->limit(1);
        $this->db->where('date >=', date('Y-m-d'));
        return $this->db->get('batch_model')->result_array();
    }
    
    public function latest_courses(){
        date_default_timezone_set('Asia/Kolkata');
            $this->db->where('date_added >=', date('Ymd'));
        return $this->db->get('course')->result_array();
    }


    /********************* Chanchal End Code *********************/
     public function get_all_webinar()
    {
        $this->db->order_by("created_at", "desc");
        return $this->db->get("ck_webinar");
    }
    public function get_all_banner()
    {      
        return $this->db->get("banner");
    }
}
