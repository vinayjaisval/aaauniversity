<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . "libraries/razorpay/razorpay-php/Razorpay.php");

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class Home extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
        $this->load->library('session');
        // $this->load->library('stripe');
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

        // CHECK CUSTOM SESSION DATA
        $this->session_data();


    }

    public function index()
    {
        $this->home();
    }


    public function verification_code()
    {
        if (!$this->session->userdata('register_email')) {
            redirect(site_url('home/sign_up'), 'refresh');
        }
        $page_data['page_name'] = "verification_code";
        $page_data['page_title'] = site_phrase('verification_code');
//        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/verification_code', $page_data);
    }

    public function home()
    {
        $page_data['page_name'] = "home";
        $page_data['page_title'] = site_phrase('home');
        /********************* Old Method for view home page ***********************/
//        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);

        /********************* Chanchal view home page ***********************/

        $page_data['latest_batch_info'] = $this->crud_model->latest_batch();


        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }

    public function shopping_cart()
    {
        if (!$this->session->userdata('cart_items')) {
            $this->session->set_userdata('cart_items', array());
        }
        $page_data['page_name'] = "shopping_cart";
        $page_data['page_title'] = site_phrase('shopping_cart');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }

    public function courses()
    {
//        die("one");
        if (!$this->session->userdata('layout')) {
            $this->session->set_userdata('layout', 'list');
        }
        $layout = $this->session->userdata('layout');
        $selected_category_id = "all";
        $selected_price = "all";
        $selected_level = "all";
        $selected_language = "all";
        $selected_rating = "all";
        // Get the category ids
        if (isset($_GET['category']) && !empty($_GET['category'] && $_GET['category'] != "all")) {
            $s = explode('/', $_GET['category']);
            $selected_category_id = $this->crud_model->get_category_id($s[0]);
        }

        // Get the selected price
        if (isset($_GET['price']) && !empty($_GET['price'])) {
            $selected_price = $_GET['price'];
        }

        // Get the selected level
        if (isset($_GET['level']) && !empty($_GET['level'])) {
            $selected_level = $_GET['level'];
        }

        // Get the selected language
        if (isset($_GET['language']) && !empty($_GET['language'])) {
            $selected_language = $_GET['language'];
        }

        // Get the selected rating
        if (isset($_GET['rating']) && !empty($_GET['rating'])) {
            $selected_rating = $_GET['rating'];
        }


        if ($selected_category_id !== "all" && $selected_price == "all" && $selected_level == 'all' && $selected_language == 'all' && $selected_rating == 'all') {
            if (!addon_status('scorm_course')) {
                $this->db->where('course_type', 'general');
            }
//            die($selected_category_id);
            $total_rows = $this->crud_model->get_course_by_category_id($selected_category_id)->num_rows();
            $s = explode('/', $_GET['category']);
            $config = array();
            $config = new_pagination($total_rows, 6);
            $config['base_url'] = base_url('home/courses');
            $this->pagination->initialize($config);
            if (!addon_status('scorm_course')) {
                $this->db->where('course_type', 'general');
            }
            $this->db->where('status', 'active');
            $this->db->where('category_id', $selected_category_id);
            $page_data['courses'] = $this->db->get('course', $config['per_page'], $this->uri->segment(3))->result_array();

        } elseif ($selected_category_id == "all" && $selected_price == "all" && $selected_level == 'all' && $selected_language == 'all' && $selected_rating == 'all') {

            if (!addon_status('scorm_course')) {
                $this->db->where('course_type', 'general');
            }
            $this->db->where('status', 'active');
            $total_rows = $this->db->get('course')->num_rows();
            $config = array();
            $config = new_pagination($total_rows, 6);
            $config['base_url'] = site_url('home/courses/');
            $this->pagination->initialize($config);
            if (!addon_status('scorm_course')) {
                $this->db->where('course_type', 'general');
            }
            $this->db->where('status', 'active');
            $page_data['courses'] = $this->db->get('course', $config['per_page'], $this->uri->segment(3))->result_array();
        } else {
            $courses = $this->crud_model->filter_course($selected_category_id, $selected_price, $selected_level, $selected_language, $selected_rating);
            $page_data['courses'] = $courses;
        }

        $page_data['page_name'] = "course-list";
        $page_data['page_title'] = site_phrase('course-list');
        $page_data['layout'] = $layout;
        $page_data['selected_category_id'] = $selected_category_id;
        $page_data['selected_price'] = $selected_price;
        $page_data['selected_level'] = $selected_level;
        $page_data['selected_language'] = $selected_language;
        $page_data['selected_rating'] = $selected_rating;

        /********* Old Open Courses Link **********/
//        $this->load->view('frontend/'.get_frontend_settings('theme').'/index', $page_data);

        /********* New Open Courses Link **********/
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/course-list', $page_data);
    }

    public function set_layout_to_session()
    {
        $layout = $this->input->post('layout');
        $this->session->set_userdata('layout', $layout);
    }

    public function course($slug = "", $course_id = "")
    {
        $this->access_denied_courses($course_id);
        $page_data['course_id'] = $course_id;


        /********* Show Documents Code **********/
        $page_data['doc_show'] = false;
        if ($this->session->userdata('user_login')) {
            $this->db->where('course_id', $course_id);
            $this->db->where('user_id', $this->session->userdata('user_id'));
            $num_rows = $this->db->get('enrol')->num_rows();
            if ($num_rows > 0) {
                $page_data['doc_show'] = true;
            }
        }
        /********* Show Documents Code **********/

        $page_data['course_documents'] = $this->crud_model->get_course_documents_by_course_id($course_id)->row_array();
        $page_data['page_name'] = "course_page";
        $page_data['page_title'] = site_phrase('course');

        /********* Old Open Courses Link **********/
//        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);

        /********* New Open Courses Link **********/
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/course-details', $page_data);

    }

    public function instructor_page($instructor_id = "")
    {
        $page_data['page_name'] = "instructor_page";
        $page_data['page_title'] = site_phrase('instructor_page');
        $page_data['instructor_id'] = $instructor_id;


        /********* Old Open Courses Link **********/
        //        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);

        /********* New Open Courses Link **********/
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/course-details', $page_data);


    }

    public function my_courses()
    {

        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('home'), 'refresh');
        }

        $page_data['page_name'] = "my_courses";
        $page_data['page_title'] = site_phrase("my_courses");

        /******* Old Code for view courses ********/
//        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);

        /******* Chanchal Code for view courses ********/
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/my_courses', $page_data);


    }

    public function my_messages($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('home'), 'refresh');
        }
        if ($param1 == 'read_message') {
            $page_data['message_thread_code'] = $param2;
        } elseif ($param1 == 'send_new') {
            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('flash_message', site_phrase('message_sent'));
            redirect(site_url('home/my_messages/read_message/' . $message_thread_code), 'refresh');
        } elseif ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2); //$param2 = message_thread_code
            $this->session->set_flashdata('flash_message', site_phrase('message_sent'));
            redirect(site_url('home/my_messages/read_message/' . $param2), 'refresh');
        }
        $page_data['page_name'] = "my_messages";
        $page_data['page_title'] = site_phrase('my_messages');
        /*********** Old Code for Messages view ************/
//        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);

        /*********** Chanchal Code for Messages view ************/
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/my_message', $page_data);
    }

    public function my_notifications()
    {
        $page_data['page_name'] = "my_notifications";
        $page_data['page_title'] = site_phrase('my_notifications');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }

    public function my_wishlist()
    {
        if (!$this->session->userdata('cart_items')) {
            $this->session->set_userdata('cart_items', array());
        }
        $my_courses = $this->crud_model->get_courses_by_wishlists();
        $page_data['my_courses'] = $my_courses;
        $page_data['page_name'] = "my_wishlist";
        $page_data['page_title'] = site_phrase('my_wishlist');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }

    public function purchase_history()
    {
        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('home'), 'refresh');
        }

        $total_rows = $this->crud_model->purchase_history($this->session->userdata('user_id'))->num_rows();
        $config = array();
        $config = pagintaion($total_rows, 10);
        $config['base_url'] = site_url('home/purchase_history');
        $this->pagination->initialize($config);
        $page_data['per_page'] = $config['per_page'];

        if (addon_status('offline_payment') == 1):
            $this->load->model('addons/offline_payment_model');
            $page_data['pending_offline_payment_history'] = $this->offline_payment_model->pending_offline_payment($this->session->userdata('user_id'))->result_array();
        endif;

        $page_data['page_name'] = "purchase_history";
        $page_data['page_title'] = site_phrase('purchase_history');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }

    public function profile($param1 = "")
    {
        if ($this->session->userdata('user_login') != true) {
            redirect(site_url('home'), 'refresh');
        }

        if ($param1 == 'user_profile') {
            $page_data['page_name'] = "user_profile";
            $page_data['page_title'] = site_phrase('user_profile');
        } elseif ($param1 == 'user_credentials') {
            $page_data['page_name'] = "user_credentials";
            $page_data['page_title'] = site_phrase('credentials');
        } elseif ($param1 == 'user_photo') {
            $page_data['page_name'] = "update_user_photo";
            $page_data['page_title'] = site_phrase('update_user_photo');
        }
        $page_data['user_details'] = $this->user_model->get_user($this->session->userdata('user_id'));

        /******** Old Code for profile view ********/
//        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);

        /******** Chanchal Code for profile view ********/
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/' . $page_data['page_name'], $page_data);

    }

    public function update_profile($param1 = "")
    {
        if ($param1 == 'update_basics') {
            $this->user_model->edit_user($this->session->userdata('user_id'));
            redirect(site_url('home/profile/user_profile'), 'refresh');
        } elseif ($param1 == "update_credentials") {
            $this->user_model->update_account_settings($this->session->userdata('user_id'));

            /********* Old Code for user credentials view ***********/
//            redirect(site_url('home/profile/user_credentials'), 'refresh');

            /********* Chanchal Code for user credentials View ***********/
            redirect(site_url('home/profile/user_profile'), 'refresh');


        } elseif ($param1 == "update_photo") {
            if (isset($_FILES['user_image']) && $_FILES['user_image']['name'] != "") {
                unlink('uploads/user_image/' . $this->db->get_where('users', array('id' => $this->session->userdata('user_id')))->row('image') . '.jpg');
                $data['image'] = md5(rand(10000, 10000000));
                $this->db->where('id', $this->session->userdata('user_id'));
                $this->db->update('users', $data);
                $this->user_model->upload_user_image($data['image']);

            }
            $this->session->set_flashdata('flash_message', site_phrase('updated_successfully'));

            /********* Old Code for user credentials view ***********/
//            redirect(site_url('home/profile/user_photo'), 'refresh');

            /********* Chanchal Code for user credentials View ***********/
            redirect(site_url('home/profile/user_profile'), 'refresh');

        }

    }

    public function handleWishList($return_number = "")
    {
        if ($this->session->userdata('user_login') != 1) {
            echo false;
        } else {
            if (isset($_POST['course_id'])) {
                $course_id = $this->input->post('course_id');
                $this->crud_model->handleWishList($course_id);
            }
            if ($return_number == 'true') {
                echo sizeof($this->crud_model->getWishLists());
            } else {
                $this->load->view('frontend/' . get_frontend_settings('theme') . '/wishlist_items');
            }
        }
    }

    public function handleCartItems($return_number = "")
    {
        if (!$this->session->userdata('cart_items')) {
            $this->session->set_userdata('cart_items', array());
        }

        $course_id = $this->input->post('course_id');
        $previous_cart_items = $this->session->userdata('cart_items');
        if (in_array($course_id, $previous_cart_items)) {
            $key = array_search($course_id, $previous_cart_items);
            unset($previous_cart_items[$key]);
        } else {
            array_push($previous_cart_items, $course_id);
        }

        $this->session->set_userdata('cart_items', $previous_cart_items);
        if ($return_number == 'true') {
            echo sizeof($previous_cart_items);
        } else {
            $this->load->view('frontend/' . get_frontend_settings('theme') . '/cart_items');
        }
    }

    public function handleCartItemForBuyNowButton()
    {
        if (!$this->session->userdata('cart_items')) {
            $this->session->set_userdata('cart_items', array());
        }

        $course_id = $this->input->post('course_id');
        $previous_cart_items = $this->session->userdata('cart_items');
        if (!in_array($course_id, $previous_cart_items)) {
            array_push($previous_cart_items, $course_id);
        }
        $this->session->set_userdata('cart_items', $previous_cart_items);
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/cart_items');
    }

    public function refreshWishList()
    {
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/wishlist_items');
    }

    public function refreshShoppingCart()
    {
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/shopping_cart_inner_view');
    }

    public function isLoggedIn()
    {
        if ($this->session->userdata('user_login') == 1)
            echo true;
        else
            echo false;
    }

    //choose payment gateway
    public function payment()
    {
        if ($this->session->userdata('user_login') != 1)
            redirect('login', 'refresh');

        $page_data['total_price_of_checking_out'] = $this->session->userdata('total_price_of_checking_out');
        $page_data['page_title'] = site_phrase("payment_gateway");
        $this->load->view('payment/index', $page_data);
    }

    // SHOW PAYPAL CHECKOUT PAGE
    public function paypal_checkout($payment_request = "only_for_mobile")
    {
        if ($this->session->userdata('user_login') != 1 && $payment_request != 'true')
            redirect('home', 'refresh');

        //checking price
        if ($this->session->userdata('total_price_of_checking_out') == $this->input->post('total_price_of_checking_out')):
            $total_price_of_checking_out = $this->input->post('total_price_of_checking_out');
        else:
            $total_price_of_checking_out = $this->session->userdata('total_price_of_checking_out');
        endif;
        $page_data['payment_request'] = $payment_request;
        $page_data['user_details'] = $this->user_model->get_user($this->session->userdata('user_id'))->row_array();
        $page_data['amount_to_pay'] = $total_price_of_checking_out;
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/paypal_checkout', $page_data);
    }

    // PAYPAL CHECKOUT ACTIONS
    public function paypal_payment($user_id = "", $amount_paid = "", $paymentID = "", $paymentToken = "", $payerID = "", $payment_request_mobile = "")
    {
        $paypal_keys = get_settings('paypal');
        $paypal = json_decode($paypal_keys);

        if ($paypal[0]->mode == 'sandbox') {
            $paypalClientID = $paypal[0]->sandbox_client_id;
            $paypalSecret = $paypal[0]->sandbox_secret_key;
        } else {
            $paypalClientID = $paypal[0]->production_client_id;
            $paypalSecret = $paypal[0]->production_secret_key;
        }

        //THIS IS HOW I CHECKED THE PAYPAL PAYMENT STATUS
        $status = $this->payment_model->paypal_payment($paymentID, $paymentToken, $payerID, $paypalClientID, $paypalSecret);
        if (!$status) {
            $this->session->set_flashdata('error_message', site_phrase('an_error_occurred_during_payment'));
            redirect('home/shopping_cart', 'refresh');
        }
        $this->crud_model->enrol_student($user_id);
        $this->crud_model->course_purchase($user_id, 'paypal', $amount_paid);
        $this->email_model->course_purchase_notification($user_id, 'paypal', $amount_paid);
        $this->session->set_flashdata('flash_message', site_phrase('payment_successfully_done'));
        if ($payment_request_mobile == 'true'):
            $course_id = $this->session->userdata('cart_items');
            redirect('home/payment_success_mobile/' . $course_id[0] . '/' . $user_id . '/paid', 'refresh');
        else:
            $this->session->set_userdata('cart_items', array());
            redirect('home/my_courses', 'refresh');
        endif;


    }

    // SHOW STRIPE CHECKOUT PAGE
    public function stripe_checkout($payment_request = "only_for_mobile")
    {
        if ($this->session->userdata('user_login') != 1 && $payment_request != 'true')
            redirect('home', 'refresh');

        //checking price
        $total_price_of_checking_out = $this->session->userdata('total_price_of_checking_out');
        $page_data['payment_request'] = $payment_request;
        $page_data['user_details'] = $this->user_model->get_user($this->session->userdata('user_id'))->row_array();
        $page_data['amount_to_pay'] = $total_price_of_checking_out;
        $this->load->view('payment/stripe/stripe_checkout', $page_data);
    }

    // STRIPE CHECKOUT ACTIONS
    public function stripe_payment($user_id = "", $payment_request_mobile = "", $session_id = "")
    {
        //THIS IS HOW I CHECKED THE STRIPE PAYMENT STATUS
        $response = $this->payment_model->stripe_payment($user_id, $session_id);

        if ($response['payment_status'] === 'succeeded') {
            // STUDENT ENROLMENT OPERATIONS AFTER A SUCCESSFUL PAYMENT
            $check_duplicate = $this->crud_model->check_duplicate_payment_for_stripe($response['transaction_id'], $session_id);
            if ($check_duplicate == false):
                $this->crud_model->enrol_student($user_id);
                $this->crud_model->course_purchase($user_id, 'stripe', $response['paid_amount'], $response['transaction_id'], $session_id);
                $this->email_model->course_purchase_notification($user_id, 'stripe', $response['paid_amount']);
            else:
                //duplicate payment
                $this->session->set_flashdata('error_message', site_phrase('session_time_out'));
                redirect('home/shopping_cart', 'refresh');
            endif;

            if ($payment_request_mobile == 'true'):
                $course_id = $this->session->userdata('cart_items');
                $this->session->set_flashdata('flash_message', site_phrase('payment_successfully_done'));
                redirect('home/payment_success_mobile/' . $course_id[0] . '/' . $user_id . '/paid', 'refresh');
            else:
                $this->session->set_userdata('cart_items', array());
                $this->session->set_flashdata('flash_message', site_phrase('payment_successfully_done'));
                redirect('home/my_courses', 'refresh');
            endif;
        } else {
            if ($payment_request_mobile == 'true'):
                $course_id = $this->session->userdata('cart_items');
                $this->session->set_flashdata('flash_message', $response['status_msg']);
                redirect('home/payment_success_mobile/' . $course_id[0] . '/' . $user_id . '/error', 'refresh');
            else:
                $this->session->set_flashdata('error_message', $response['status_msg']);
                redirect('home/shopping_cart', 'refresh');
            endif;

        }

    }


    public function lesson($slug = "", $course_id = "", $lesson_id = "")
    {
        if ($this->session->userdata('user_login') != 1) {
            if ($this->session->userdata('admin_login') != 1) {
                redirect('home', 'refresh');
            }
        }

        $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();

        if ($course_details['course_type'] == 'general') {
            $sections = $this->crud_model->get_section('course', $course_id);
            if ($sections->num_rows() > 0) {
                $page_data['sections'] = $sections->result_array();
                if ($lesson_id == "") {
                    $default_section = $sections->row_array();
                    $page_data['section_id'] = $default_section['id'];
                    $lessons = $this->crud_model->get_lessons('section', $default_section['id']);
                    if ($lessons->num_rows() > 0) {
                        $default_lesson = $lessons->row_array();
                        $lesson_id = $default_lesson['id'];
                        $page_data['lesson_id'] = $default_lesson['id'];
                    }
                } else {
                    $page_data['lesson_id'] = $lesson_id;
                    $section_id = $this->db->get_where('lesson', array('id' => $lesson_id))->row()->section_id;
                    $page_data['section_id'] = $section_id;
                }

            } else {
                $page_data['sections'] = array();
            }
        } else if ($course_details['course_type'] == 'scorm') {
            $this->load->model('addons/scorm_model');
            $scorm_course_data = $this->scorm_model->get_scorm_curriculum_by_course_id($course_id);
            $page_data['scorm_curriculum'] = $scorm_course_data->row_array();
        }

        // Check if the lesson contained course is purchased by the user
        if (isset($page_data['lesson_id']) && $page_data['lesson_id'] > 0 && $course_details['course_type'] == 'general') {
            if ($this->session->userdata('role_id') != 1 && $course_details['user_id'] != $this->session->userdata('user_id')) {
                if (!is_purchased($course_id)) {
                    redirect(site_url('home/course/' . slugify($course_details['title']) . '/' . $course_details['id']), 'refresh');
                }
            }
        } else if ($course_details['course_type'] == 'scorm' && $scorm_course_data->num_rows() > 0) {
            if ($this->session->userdata('role_id') != 1 && $course_details['user_id'] != $this->session->userdata('user_id')) {
                if (!is_purchased($course_id)) {
                    redirect(site_url('home/course/' . slugify($course_details['title']) . '/' . $course_details['id']), 'refresh');
                }
            }
        } else {
            if (!is_purchased($course_id)) {
                redirect(site_url('home/course/' . slugify($course_details['title']) . '/' . $course_details['id']), 'refresh');
            }
        }


        $page_data['course_details'] = $course_details;
        $page_data['course_id'] = $course_id;
        $page_data['page_name'] = 'lessons';
        $page_data['page_title'] = $course_details['title'];
        // echo '<pre>';
        // print_r($page_data);
        // die();
        $this->load->view('lessons/index', $page_data);
    }

    public function my_courses_by_category()
    {

        $category_id = $this->input->post('category_id');
        $course_details = $this->crud_model->get_my_courses_by_category_id($category_id)->result_array();
        $page_data['my_courses'] = $course_details;
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/reload_my_courses', $page_data);
    }

    public function search($search_string = "")
    {
        if (isset($_GET['query']) && !empty($_GET['query'])) {
            $search_string = $_GET['query'];
            $page_data['courses'] = $this->crud_model->get_courses_by_search_string($search_string)->result_array();
        } else {
            $this->session->set_flashdata('error_message', site_phrase('no_search_value_found'));
            redirect(site_url(), 'refresh');
        }

        if (!$this->session->userdata('layout')) {
            $this->session->set_userdata('layout', 'list');
        }
        $page_data['layout'] = $this->session->userdata('layout');
        $page_data['page_name'] = 'courses_page';
        $page_data['search_string'] = $search_string;
        $page_data['page_title'] = site_phrase('search_results');

        /*************** Old Code for search view ***************/
//        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
        /*************** Chacnhal Code for search view ***************/
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/course-list', $page_data);

    }

    public function my_courses_by_search_string()
    {
        $search_string = $this->input->post('search_string');
        $course_details = $this->crud_model->get_my_courses_by_search_string($search_string)->result_array();
        $page_data['my_courses_data'] = $course_details;
        $this->session->set_userdata('course_search', $search_string);
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/my_courses', $page_data);

//        $this->load->view('frontend/' . get_frontend_settings('theme') . '/reload_my_courses', $page_data);
    }

    public function get_my_wishlists_by_search_string()
    {
        $search_string = $this->input->post('search_string');
        $course_details = $this->crud_model->get_courses_of_wishlists_by_search_string($search_string);
        $page_data['my_courses'] = $course_details;
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/reload_my_wishlists', $page_data);
    }

    public function reload_my_wishlists()
    {
        $my_courses = $this->crud_model->get_courses_by_wishlists();
        $page_data['my_courses'] = $my_courses;
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/reload_my_wishlists', $page_data);
    }

    public function get_course_details()
    {
        $course_id = $this->input->post('course_id');
        $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
        echo $course_details['title'];
    }

    public function rate_course()
    {
        $data['review'] = $this->input->post('review');
        $data['status'] = '1';
        $data['ratable_id'] = $this->input->post('course_id');
        $data['ratable_type'] = 'course';
        $data['rating'] = $this->input->post('rating');
        $data['date_added'] = date('D, d-M-Y');
        $data['user_id'] = $this->session->userdata('user_id');

        $this->crud_model->rate($data);

        $url = explode("?", $_SERVER['HTTP_REFERER']);
        if ("review=1" == $url[1]) {
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        } else {
            redirect($_SERVER['HTTP_REFERER'] . "?review=1", 'refresh');
        }
    }

    public function about_us()
    {
        $page_data['page_name'] = 'about_us';
        $page_data['page_title'] = site_phrase('about_us');
//        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);

        $this->load->view('frontend/' . get_frontend_settings('theme') . '/about', $page_data);
    }

    public function terms_and_condition()
    {
        $page_data['page_name'] = 'terms_and_condition';
        $page_data['page_title'] = site_phrase('terms_and_condition');
//        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);


        /*********** Chanchal code for term condition *************/
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/terms-condition', $page_data);
    }

    public function privacy_policy()
    {
        $page_data['page_name'] = 'privacy_policy';
        $page_data['page_title'] = site_phrase('privacy_policy');
//        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);

        /*********** Chanchal code for term condition *************/
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/privacy-policy', $page_data);
    }

    public function cookie_policy()
    {
        $page_data['page_name'] = 'cookie_policy';
        $page_data['page_title'] = site_phrase('cookie_policy');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }


    // Version 1.1
    public function dashboard($param1 = "")
    {
        if ($this->session->userdata('user_login') != 1) {
            redirect('home', 'refresh');
        }

        if ($param1 == "") {
            $page_data['type'] = 'active';
        } else {
            $page_data['type'] = $param1;
        }

        $page_data['page_name'] = 'instructor_dashboard';
        $page_data['page_title'] = site_phrase('instructor_dashboard');
        $page_data['user_id'] = $this->session->userdata('user_id');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }

    public function create_course()
    {
        if ($this->session->userdata('user_login') != 1) {
            redirect('home', 'refresh');
        }

        $page_data['page_name'] = 'create_course';
        $page_data['page_title'] = site_phrase('create_course');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }

    public function edit_course($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('user_login') != 1) {
            redirect('home', 'refresh');
        }

        if ($param2 == "") {
            $page_data['type'] = 'edit_course';
        } else {
            $page_data['type'] = $param2;
        }
        $page_data['page_name'] = 'manage_course_details';
        $page_data['course_id'] = $param1;
        $page_data['page_title'] = site_phrase('edit_course');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }

    public function course_action($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('user_login') != 1) {
            redirect('home', 'refresh');
        }

        if ($param1 == 'create') {
            if (isset($_POST['create_course'])) {
                $this->crud_model->add_course();
                redirect(site_url('home/create_course'), 'refresh');
            } else {
                $this->crud_model->add_course('save_to_draft');
                redirect(site_url('home/create_course'), 'refresh');
            }
        } elseif ($param1 == 'edit') {
            if (isset($_POST['publish'])) {
                $this->crud_model->update_course($param2, 'publish');
                redirect(site_url('home/dashboard'), 'refresh');
            } else {
                $this->crud_model->update_course($param2, 'save_to_draft');
                redirect(site_url('home/dashboard'), 'refresh');
            }
        }
    }


    public function sections($action = "", $course_id = "", $section_id = "")
    {
        if ($this->session->userdata('user_login') != 1) {
            redirect('home', 'refresh');
        }

        if ($action == "add") {
            $this->crud_model->add_section($course_id);

        } elseif ($action == "edit") {
            $this->crud_model->edit_section($section_id);

        } elseif ($action == "delete") {
            $this->crud_model->delete_section($course_id, $section_id);
            $this->session->set_flashdata('flash_message', site_phrase('section_deleted'));
            redirect(site_url("home/edit_course/$course_id/manage_section"), 'refresh');

        } elseif ($action == "serialize_section") {
            $container = array();
            $serialization = json_decode($this->input->post('updatedSerialization'));
            foreach ($serialization as $key) {
                array_push($container, $key->id);
            }
            $json = json_encode($container);
            $this->crud_model->serialize_section($course_id, $json);
        }
        $page_data['course_id'] = $course_id;
        $page_data['course_details'] = $this->crud_model->get_course_by_id($course_id)->row_array();
        return $this->load->view('frontend/' . get_frontend_settings('theme') . '/reload_section', $page_data);
    }

    public function manage_lessons($action = "", $course_id = "", $lesson_id = "")
    {
        if ($this->session->userdata('user_login') != 1) {
            redirect('home', 'refresh');
        }
        if ($action == 'add') {
            $this->crud_model->add_lesson();
            $this->session->set_flashdata('flash_message', site_phrase('lesson_added'));
        } elseif ($action == 'edit') {
            $this->crud_model->edit_lesson($lesson_id);
            $this->session->set_flashdata('flash_message', site_phrase('lesson_updated'));
        } elseif ($action == 'delete') {
            $this->crud_model->delete_lesson($lesson_id);
            $this->session->set_flashdata('flash_message', site_phrase('lesson_deleted'));
        }
        redirect('home/edit_course/' . $course_id . '/manage_lesson');
    }

    public function lesson_editing_form($lesson_id = "", $course_id = "")
    {
        if ($this->session->userdata('user_login') != 1) {
            redirect('home', 'refresh');
        }
        $page_data['type'] = 'manage_lesson';
        $page_data['course_id'] = $course_id;
        $page_data['lesson_id'] = $lesson_id;
        $page_data['page_name'] = 'lesson_edit';
        $page_data['page_title'] = site_phrase('update_lesson');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }

    public function download($filename = "")
    {
        $tmp = explode('.', $filename);
        $fileExtension = strtolower(end($tmp));
        $yourFile = base_url() . 'uploads/lesson_files/' . $filename;
        $file = @fopen($yourFile, "rb");

        header('Content-Description: File Transfer');
        header('Content-Type: text/plain');
        header('Content-Disposition: attachment; filename=' . $filename);
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($yourFile));
        while (!feof($file)) {
            print(@fread($file, 1024 * 8));
            ob_flush();
            flush();
        }
    }

    // Version 1.3 codes
    public function get_enrolled_to_free_course($course_id)
    {
        if ($this->session->userdata('user_login') == 1) {
            $this->crud_model->enrol_to_free_course($course_id, $this->session->userdata('user_id'));
            redirect(site_url('home/my_courses'), 'refresh');
        } else {
            redirect(site_url('login'), 'refresh');
        }
    }

    // Version 1.4 codes
    public function login()
    {
        if ($this->session->userdata('admin_login')) {
            redirect(site_url('admin'), 'refresh');
        } elseif ($this->session->userdata('user_login')) {
            redirect(site_url('user'), 'refresh');
        }
        $page_data['page_name'] = 'login';
        $page_data['page_title'] = site_phrase('login');

        $this->load->view('frontend/' . get_frontend_settings('theme') . '/login', $page_data);
//        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }

    public function sign_up()
    {
        if ($this->session->userdata('admin_login')) {
            redirect(site_url('admin'), 'refresh');
        } elseif ($this->session->userdata('user_login')) {
            redirect(site_url('user'), 'refresh');
        }
        $page_data['page_name'] = 'sign_up';
        $page_data['page_title'] = site_phrase('sign_up');
//        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/sign_up', $page_data);
    }

    public function forgot_password()
    {
        if ($this->session->userdata('admin_login')) {
            redirect(site_url('admin'), 'refresh');
        } elseif ($this->session->userdata('user_login')) {
            redirect(site_url('user'), 'refresh');
        }
        $page_data['page_name'] = 'forgot_password';
        $page_data['page_title'] = site_phrase('forgot_password');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }

    public function submit_quiz($from = "")
    {
        $submitted_quiz_info = array();
        $container = array();
        $quiz_id = $this->input->post('lesson_id');
        $quiz_questions = $this->crud_model->get_quiz_questions($quiz_id)->result_array();
        $total_correct_answers = 0;
        foreach ($quiz_questions as $quiz_question) {
            $submitted_answer_status = 0;
            $correct_answers = json_decode($quiz_question['correct_answers']);
            $submitted_answers = array();
            foreach ($this->input->post($quiz_question['id']) as $each_submission) {
                if (isset($each_submission)) {
                    array_push($submitted_answers, $each_submission);
                }
            }
            sort($correct_answers);
            sort($submitted_answers);
            if ($correct_answers == $submitted_answers) {
                $submitted_answer_status = 1;
                $total_correct_answers++;
            }
            $container = array(
                "question_id" => $quiz_question['id'],
                'submitted_answer_status' => $submitted_answer_status,
                "submitted_answers" => json_encode($submitted_answers),
                "correct_answers" => json_encode($correct_answers),
            );
            array_push($submitted_quiz_info, $container);
        }
        $page_data['submitted_quiz_info'] = $submitted_quiz_info;
        $page_data['total_correct_answers'] = $total_correct_answers;
        $page_data['total_questions'] = count($quiz_questions);
        if ($from == 'mobile') {
            $this->load->view('mobile/quiz_result', $page_data);
        } else {
            $this->load->view('lessons/quiz_result', $page_data);
        }
    }

    private function access_denied_courses($course_id)
    {
        $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
        if ($course_details['status'] == 'draft' && $course_details['user_id'] != $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error_message', site_phrase('you_do_not_have_permission_to_access_this_course'));
            redirect(site_url('home'), 'refresh');
        } elseif ($course_details['status'] == 'pending') {
            if ($course_details['user_id'] != $this->session->userdata('user_id') && $this->session->userdata('role_id') != 1) {
                $this->session->set_flashdata('error_message', site_phrase('you_do_not_have_permission_to_access_this_course'));
                redirect(site_url('home'), 'refresh');
            }
        }
    }

    public function invoice($purchase_history_id = '')
    {
        if ($this->session->userdata('user_login') != 1) {
            redirect('home', 'refresh');
        }
        $purchase_history = $this->crud_model->get_payment_details_by_id($purchase_history_id);
        if ($purchase_history['user_id'] != $this->session->userdata('user_id')) {
            redirect('home', 'refresh');
        }
        $page_data['payment_info'] = $purchase_history;
        $page_data['page_name'] = 'invoice';
        $page_data['page_title'] = 'invoice';
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }

    public function page_not_found()
    {
        $page_data['page_name'] = '404';
        $page_data['page_title'] = site_phrase('404_page_not_found');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }

    // AJAX CALL FUNCTION FOR CHECKING COURSE PROGRESS
    function check_course_progress($course_id)
    {
        echo course_progress($course_id);
    }

    // This is the function for rendering quiz web view for mobile
    public function quiz_mobile_web_view($lesson_id = "")
    {
        $data['lesson_details'] = $this->crud_model->get_lessons('lesson', $lesson_id)->row_array();
        $data['page_name'] = 'quiz';
        $this->load->view('mobile/index', $data);
    }


    // CHECK CUSTOM SESSION DATA
    public function session_data()
    {
        // SESSION DATA FOR CART
        if (!$this->session->userdata('cart_items')) {
            $this->session->set_userdata('cart_items', array());
        }

        // SESSION DATA FOR FRONTEND LANGUAGE
        if (!$this->session->userdata('language')) {
            $this->session->set_userdata('language', get_settings('language'));
        }

    }

    // SETTING FRONTEND LANGUAGE
    public function site_language()
    {
        $selected_language = $this->input->post('language');
        $this->session->set_userdata('language', $selected_language);
        echo true;
    }


    //FOR MOBILE
    public function course_purchase($auth_token = '', $course_id = '')
    {
        $this->load->model('jwt_model');
        if (empty($auth_token) || $auth_token == "null") {
            $page_data['cart_item'] = $course_id;
            $page_data['user_id'] = '';
            $page_data['is_login_now'] = 0;
            $page_data['enroll_type'] = null;
            $page_data['page_name'] = 'shopping_cart';
            $this->load->view('mobile/index', $page_data);
        } else {

            $logged_in_user_details = json_decode($this->jwt_model->token_data_get($auth_token), true);

            if ($logged_in_user_details['user_id'] > 0) {

                $credential = array('id' => $logged_in_user_details['user_id'], 'status' => 1, 'role_id' => 2);
                $query = $this->db->get_where('users', $credential);
                if ($query->num_rows() > 0) {
                    $row = $query->row();
                    $page_data['cart_item'] = $course_id;
                    $page_data['user_id'] = $row->id;
                    $page_data['is_login_now'] = 1;
                    $page_data['enroll_type'] = null;
                    $page_data['page_name'] = 'shopping_cart';

                    $cart_item = array($course_id);
                    $this->session->set_userdata('cart_items', $cart_item);
                    $this->session->set_userdata('user_login', '1');
                    $this->session->set_userdata('user_id', $row->id);
                    $this->session->set_userdata('role_id', $row->role_id);
                    $this->session->set_userdata('role', get_user_role('user_role', $row->id));
                    $this->session->set_userdata('name', $row->first_name . ' ' . $row->last_name);
                    $this->load->view('mobile/index', $page_data);
                }
            }

        }
    }

    //FOR MOBILE
    public function get_enrolled_to_free_course_mobile($course_id = "", $user_id = "", $get_request = "")
    {
        if ($get_request == "true") {
            $this->crud_model->enrol_to_free_course_mobile($course_id, $user_id);
        }
    }

    //FOR MOBILE
    public function payment_success_mobile($course_id = "", $user_id = "", $enroll_type = "")
    {
        if ($course_id > 0 && $user_id > 0):
            $page_data['cart_item'] = $course_id;
            $page_data['user_id'] = $user_id;
            $page_data['is_login_now'] = 1;
            $page_data['enroll_type'] = $enroll_type;
            $page_data['page_name'] = 'shopping_cart';

            $this->session->unset_userdata('user_id');
            $this->session->unset_userdata('role_id');
            $this->session->unset_userdata('role');
            $this->session->unset_userdata('name');
            $this->session->unset_userdata('user_login');
            $this->session->unset_userdata('cart_items');

            $this->load->view('mobile/index', $page_data);
        endif;
    }

    //FOR MOBILE
    public function payment_gateway_mobile($course_id = "", $user_id = "")
    {
        if ($course_id > 0 && $user_id > 0):
            $page_data['page_name'] = 'payment_gateway';
            $this->load->view('mobile/index', $page_data);
        endif;
    }

    public function pay_now()
    {
        $page_data['page_name'] = 'pay_now';
        $page_data['page_title'] = site_phrase('pay_now');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/pay_now', $page_data);
//        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);
    }

    /*********** Start Chanchal Code For blog**************/

    public function blog_details($param)
    {
        $page_data['blog_details'] = $this->crud_model->get_blog_by_id($param)->result_array();
   
        $page_data['blog_comments'] = $this->crud_model->get_all_blog_comment_by_blog_id($param);
        $page_data['page_name'] = 'blog-details';
        $page_data['page_title'] = site_phrase('blog-details');

        /************* Old Code for blog-details *****************/
//        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);

        /************* Chanchal New Code Start for blog-details *****************/
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/blog-details', $page_data);
    }

    /*********** End Chanchal Code For blog**************/


    /*********** Start Chanchal Code For Comment form**************/
    public function comment_form($param)
    {
        if ($param == "add") {
            $this->crud_model->add_blog_comment(true);
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        } elseif ($param == "reply_comment") {
            $this->crud_model->add_blog_comment_reply(true);
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        }

    }

    /*********** End Chanchal Code For Comment form**************/


    /*********** Start Chanchal Code For Add Cart **************/


    public function cart_form($param, $param2 = '')
    {
        if ($param == "add_cart") {
            if ($this->session->userdata('course_cart') == "") {
                $this->session->set_userdata('course_cart', $param2);
            } else {
                $cart_data = $this->session->userdata('course_cart') . ',' . $param2;
                $this->session->set_userdata('course_cart', $cart_data);
            }
            redirect($_SERVER['HTTP_REFERER'], 'refresh');

        } elseif ($param == "remove_course") {
            $cart_item = $this->session->userdata('course_cart');
            $cart_course_id = explode(',', $cart_item);

            if (($key = array_search($param2, $cart_course_id)) !== FALSE) {
                unset($cart_course_id[$key]);
                $this->session->unset_userdata('course_cart');
            }
            foreach ($cart_course_id as $id) {
                if ($this->session->userdata('course_cart') == "") {
                    $this->session->set_userdata('course_cart', $id);
                } else {
                    $cart_data = $this->session->userdata('course_cart') . ',' . $id;
                    $this->session->set_userdata('course_cart', $cart_data);
                }
            }
            redirect($_SERVER['HTTP_REFERER'], 'refresh');

        } elseif ($param == 'add_courses') {
            $this->session->unset_userdata('course_cart');
            redirect(base_url('home/courses'), 'refresh');
        }

    }

    public function add_cart()
    {
        $page_data['page_name'] = 'cart';
        $page_data['page_title'] = site_phrase('cart');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/cart', $page_data);
    }

    /***********  End Chanchal Code For Add Cart  **************/


    /***********  Start Chanchal Code For Checkout  **************/

    public function checkout()
    {
        if (!$this->session->userdata('user_login')) {
            redirect(site_url('home/login'), 'refresh');
        } else {
            $page_data['page_name'] = 'checkout';
            $page_data['page_title'] = site_phrase('checkout');
            $this->load->view('frontend/' . get_frontend_settings('theme') . '/checkout', $page_data);

        }
    }
    /***********   End Chanchal Code For Checkout   **************/


    /***********   Start Chanchal Code For Razor Pay   **************/

    public function razorpay()
    {
        // Razorpay Setting
        $razorpay_settings = $this->db->get_where('settings', array('key' => 'razorpay'))->row()->value;
        $razorpay = json_decode($razorpay_settings);

        return $razorpay;
    }

    public function pay()
    {
        if (!$this->session->userdata('user_login')) {
            redirect(site_url('home/login'), 'refresh');
        } else {
            $razorpay_currency = $this->db->get_where('settings', array('key' => 'razorpay_currency'))->row()->value;

            $razorpay = $this->razorpay();
            $api = new Api($razorpay[0]->public_key, $razorpay[0]->secret_key);
           //                die("done");

            /**
             * You can calculate payment amount as per your logic
             * Always set the amount from backend for security reasons
             */
            $_SESSION['payable_amount'] = $_SESSION['total_courses_amount'];

            $razorpayOrder = $api->order->create(array(
                'receipt' => rand(),
                'amount' => $_SESSION['payable_amount'] * 100, // 2000 rupees in paise
                'currency' => $razorpay_currency,
                'payment_capture' => 1 // auto capture
            ));

            $amount = $razorpayOrder['amount'];

            $razorpayOrderId = $razorpayOrder['id'];

            $_SESSION['razorpay_order_id'] = $razorpayOrderId;


            $data = $this->prepareData($amount, $razorpayOrderId);

            $this->load->view('frontend/razorpay/razorpay', array('data' => $data));
        }
    }

    public function load()
    {

        $this->load->view('frontend/' . get_frontend_settings('theme') . '/loader');

    }

    public function verify()
    {
        $razorpay = $this->razorpay();
        $success = true;
        $error = "payment_failed";

        $api = new Api($razorpay[0]->public_key, $razorpay[0]->secret_key);
        $payment_data = $api->payment->fetch($_POST['razorpay_payment_id']);

        if (empty($_POST['razorpay_payment_id']) === false) {

            try {
                $attributes = array(
                    'razorpay_order_id' => $_SESSION['razorpay_order_id'],
                    'razorpay_payment_id' => $_POST['razorpay_payment_id'],
                    'razorpay_signature' => $_POST['razorpay_signature'],
                );
                $api->utility->verifyPaymentSignature($attributes);

                $payment_data = $api->payment->fetch($_POST['razorpay_payment_id']);

                /************* Update User Contact ****************/
                $user_data = $this->user_model->get_all_users($_SESSION['user_id'])->row();
                if ($user_data->contact == 0) {
                    $num = $payment_data->contact;
                    $country_code = +91;
                    $number = preg_replace("/^\+?{$country_code}/", '', $num);
                    $this->crud_model->update_user_contact($_SESSION['user_id'], $number);
                }

                $trans_data = [
                    'payment_id' => $payment_data->id,
                    'amount' => $payment_data->amount / 100,
                    'currency' => $payment_data->currency,
                    'status' => $payment_data->status,
                    'payment_order_id' => $payment_data->order_id,
                    'method' => $payment_data->method,
                    'description' => $payment_data->description,
                    'card_id' => $payment_data->card_id,
                    'bank' => $payment_data->bank,
                    'wallet' => $payment_data->wallet,
                    'vpa' => $payment_data->vpa,
                    'contact' => $payment_data->contact,
                    'email' => $payment_data->email,
                    'user_id' => $this->session->userdata('user_id'),
                    'upi_transaction_id' => $payment_data->acquirer_data->upi_transaction_id,
                    'bank_transaction_id' => $payment_data->acquirer_data->bank_transaction_id,
                    'transaction_id' => $payment_data->acquirer_data->transaction_id,
                ];

                $this->crud_model->payment_transaction($trans_data, 'payment_transaction');

                if ($payment_data->card_id != "") {
                    $card_data = [
                        'card_id' => $payment_data->card->id,
                        'entity' => $payment_data->card->entity,
                        'name' => $payment_data->card->name,
                        'last4_digit' => $payment_data->card->last4,
                        'network' => $payment_data->card->network,
                        'type' => $payment_data->card->type,
                        'issuer' => $payment_data->card->issuer,
                        'international' => $payment_data->card->international,
                        'emi' => $payment_data->card->emi,
                        'sub_type' => $payment_data->card->sub_type,
                        'token_iin' => $payment_data->card->token_iin,
                        'auth_code' => $payment_data->acquirer_data->auth_code,
                        'authentication_reference_number' => $payment_data->acquirer_data->authentication_reference_number,
                    ];

                    $this->crud_model->payment_transaction($card_data, 'payment_card_transaction');

                }


            } catch (SignatureVerificationError $e) {
                $success = false;
                $error = 'Razorpay_Error : ' . $e->getMessage();
            }
        }
        if ($success === true) {
            /**
             * Call this function from where ever you want
             * to save save data before of after the payment
             */
            $this->update_enrol_course_of_user($payment_data->id);
            redirect(base_url() . 'home/payment_success');
        } else {
            redirect(base_url() . 'home/payment_failed');
        }
    }
    

    public function payment_success()
    {
        $page_data['type'] = 'success';
        $page_data['page_name'] = 'payment_success';
        $page_data['page_title'] = site_phrase('payment_success');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/payment_success', $page_data);

    }

    public function payment_failed()
    {
        $page_data['type'] = 'failed';
        $page_data['page_name'] = 'payment_success';
        $page_data['page_title'] = site_phrase('payment_success');
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/payment_success', $page_data);

    }

    public function prepareData($amount, $razorpayOrderId)
    {
        $user_data = $this->user_model->get_all_users($_SESSION['user_id'])->row();
        $razorpay = $this->razorpay();
        $number = "";
        if ($user_data->contact == 0) {
            $number = "";
        } else {
            $number = $user_data->contact;
        }
        $data = array(
            "key" => $razorpay[0]->public_key,
            "amount" => $amount,
            "name" => "EKON Solutions India Private Limited. ",
            "description" => "Course Purchase",
            "image" => base_url('assets/frontend/default/assets/elogo.png'),
            "prefill" => array(
                "name" => $user_data->first_name . " " . $user_data->last_name,
                "email" => $user_data->email,
                "contact" => $number,
            ),
            "notes" => array(
                "address" => "Hello World",
                "merchant_order_id" => rand(),
            ),
            "theme" => array(
                "color" => "#F37254"
            ),
            "order_id" => $razorpayOrderId,
        );

        return $data;
    }

    /***********    End Chanchal Code For Razor Pay    **************/

    public function update_enrol_course_of_user($tr_num)
    {
        $user_id = $this->session->userdata('user_id');
        $cart_item = $this->session->userdata('course_cart');
        $cart_course_id = explode(',', $cart_item);
        foreach ($cart_course_id as $id) {
            if ($id != "") {
                $data = [
                    'user_id' => $user_id,
                    'course_id' => $id,
                    'date_added' => strtotime(date('D, d-M-Y')),
                    'p_status' => 'online',
                    'tr_num' => $tr_num,
                ];
                $this->db->insert('enrol', $data);
            }
        }
        $this->email_model->purchase_course_by_online($user_id, $cart_course_id);

        $this->session->unset_userdata('course_cart');
    }


    /************* Start Chanchal Code for Purchase History ***********/

    public function user_courses_purchase_history()
    {
        if (!$this->session->userdata('user_login')) {
            redirect(base_url('home/login'));
        }
        $user_id = $this->session->userdata('user_id');
        $page_data['purchase_details'] = $this->crud_model->get_all_transaction_history_by_user_id($user_id);
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/purchase_history', $page_data);
    }

    public function purchase_history_form($param, $param2 = '')
    {

        if ($param == "view_history") {
            $page_data['pdf_data'] = $this->crud_model->get_enroll_by_payment_id($param2)->result_array();
            $this->load->view('frontend/' . get_frontend_settings('theme') . '/slip_pdf', $page_data);
            $html = $this->output->get_output();
            $this->load->library('pdf');
            $this->dompdf->loadHtml($html);
            $this->dompdf->set_option('isRemoteEnabled', true);
            $this->dompdf->setPaper('A4', 'portrait ');
            $this->dompdf->render();
            $this->dompdf->stream("slip_pdf.php", array("Attachment" => 0));
        }
    }

    /*************  End Chanchal Code for Purchase History  ***********/


    /*************  Start Chanchal Code for Courses Documents  ***********/

    public function course_documents($param)
    {

        $page_data['course_doc_data'] = $this->crud_model->get_course_documents($param)->row_array();

        $this->load->view('frontend/' . get_frontend_settings('theme') . '/doc', $page_data);

    }
    /*************   End Chanchal Code for Courses Documents   ***********/


    /*************   Start Chanchal Code for Instructor list  ***********/

    public function get_instructor($param = '')
    {

        $page_data['ins_list'] = $this->user_model->get_instructor($param)->result_array();

        $this->load->view('frontend/' . get_frontend_settings('theme') . '/instructor', $page_data);

    }

    public function instructor_details($param = "")
    {
        $page_data['instructor_details'] = $this->user_model->get_instructor($param)->row_array();
//        print_array($page_data['instructor_details']);
//        die();
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/instructor_deatils', $page_data);
    }

    /*************    End Chanchal Code for Instructor list   ***********/

    /*************    Start Chanchal Code for Contact Us   ***********/

    public function contact_us()
    {
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/contact');
    }

    public function contact_us_form()
    {
        $this->crud_model->enquiry_form('', true);
        redirect(base_url());
    }

    /*************    End Chanchal Code for Contact Us   ***********/

    /*************    Start Chanchal Code for Branch Location  ***********/

    public function branches()
    {
        $page_data['branch_data'] = "";
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/branch_location', $page_data);

    }
    /*************     End Chanchal Code for Branch Location   ***********/

    /*************     Start Chanchal Code for cancellation and refund policy   ***********/
    public function cancellation_and_refund_policy()
    {
        $page_data['page_name'] = 'cancellation_and_refund_policy';
        $page_data['page_title'] = site_phrase('cancellation_and_refund_policy');
//        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);


        /*********** Chanchal code for term condition *************/
        $this->load->view('frontend/' . get_frontend_settings('theme') . '/cancellation_and_refund_policy', $page_data);
    }

    /*************      End Chanchal Code for cancellation and refund policy    ***********/


    /******** Chanchal Code for location Wise batch *******/
    public function batch($param = '')
    {
        $ids = explode('-', $param);
        $state_id = $ids[0];
        $city_id = $ids[1];

        if ($param == '') {
            $page_data['batch_details'] = $this->db->get('batch_model')->result_object();
        } else {
            $this->db->where('state_id', $state_id);
            $this->db->where('city_id', $city_id);
            $page_data['batch_details'] = $this->db->get('batch_model')->result_object();
        }

        $this->load->view('frontend/' . get_frontend_settings('theme') . '/batch_details', $page_data);

    }

    public function batch_ajax_data($param)
    {
        $id = explode('-', $param)[1];

        $this->db->from('batch_model');
        $this->db->join('course', 'course.id = batch_model.course_id');
        $this->db->where('batch_model.id', $id);
        $data = $this->db->get()->result_object();

        $data['user_name'] = [];
        $s = explode(',', $data[0]->instructor_id);
        if (sizeof($s) > 0) {
            $name_data = '';
            foreach ($s as $ins_id) {
                $dat = $this->user_model->get_user($ins_id)->result_array();
                if ($name_data != "") {
                    $name_data = $name_data . '<br>' . $dat[0]['first_name'] . ' ' . $dat[0]['first_name'];
                } else {
                    $name_data = $dat[0]['first_name'] . ' ' . $dat[0]['last_name'];
                }
            }
            $data['user_name'] = $name_data;
        }
        $enrolled = explode(',', $data[0]->students_id);
        $data['students'] = count($enrolled);

        $data['latest_batch_info'] = $this->crud_model->latest_batch();

        echo json_encode($data);
    }

    /******** Chanchal Code for location Wise batch *******/

    public function important()
    {
        $this->load->view('frontend/default/chatbot');
    }

   
    public function webinar_register()
    {  
        $this->load->library('form_validation');


        $curr_date = date('Y-m-d H:i:s');
        $this->db->where('start_time >=', $curr_date);
        $this->db->where('end_time >=', $curr_date);
        $webinar_id = $this->db->get('ck_webinar')->result_object()[0]->id;

      
        $ip = $this->input->ip_address();
        if (!$this->input->valid_ip($ip)) {
            $ip = '';
        }


        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $message = $this->input->post('message');
        $amount = $this->input->post('amount');

        $register_data = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'system_ip' => $ip,
            'short_dis' => $message,
            'webinar_id' => $webinar_id,
        ];
 
     

        $this->form_validation->set_rules('name', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('phone', 'Phone ', 'required|regex_match[/^[0-9]{10}$/]');
        $this->form_validation->set_rules('message', 'Email', 'required');
        $email=$this->input->post('email');                
        $this->db->where('email', $email);   
        $this->db->where('webinar_id', $webinar_id);
        $result = $this->db->get('ck_webinar_register')->result_array(); 
 
        // print_r($result) ;
        // die();        
        if(count($result) > 0){         
        
            //  die('ok');    
            $this->session->set_tempdata('success','This email already register with this webinar');
            return redirect('ekon_landing');        
        }else{ 
            
            if($amount > 0){
                
              $web_result=$this->pay_web_amount();
                
                if(!$payment_success){
               
                    $this->session->set_tempdata('success','payment failed', 10);
                    $this->db->insert('ck_webinar_register', $register_data);
                    return redirect('ekon_landing');
                }

                //$web_result=$this->pay_web_amount();
            }

            $this->db->insert('ck_webinar_register', $register_data);
            // Send Welcome mail by email and webinar id
            $this->email_model->webinar_register_mail($register_data['email'] , $webinar_id);

            $this->session->set_tempdata('success','Connect success check mail', 10);
            
            return redirect('ekon_landing');
        } 
    }
//     public function webinar_details($param)
//     {
//         $page_data['webinar_details'] = $this->crud_model->get_webinar_by_id($param)->result_array();
     
//         $page_data['page_name'] = 'webinar-details';
//         $page_data['page_title'] = site_phrase('webinar-details');

//         /************* Old Code for blog-details *****************/
// //        $this->load->view('frontend/' . get_frontend_settings('theme') . '/index', $page_data);

//         /************* Chanchal New Code Start for blog-details *****************/
//         $this->load->view('frontend/' . get_frontend_settings('theme') . '/webinar-details', $page_data);
//     }
                
public function webinar_details($param)
    {
        $page_data['webinar_details'] = $this->crud_model->get_webinar_by_id($param)->result_array();
      
        // print_r( $page_data['webinar_details'] );
        // die;
        $page_data['page_name'] = 'webinar-details';
        $page_data['page_title'] = site_phrase('webinar-details');

        $this->load->view('frontend/' . get_frontend_settings('theme') . '/webinar-details', $page_data);
        // $this->load->view('frontend/default/webinar-details', $page_data);
    }
    public function ekon()
    {     
        $this->load->view('assets/index');
    }
    public function webinar_amount($result)
    {   
        $ekon_data['webinar'] = $this->crud_model->get_webinar_amount_by_id($result)->result_array();
        $this->load->view( 'assets/index', $ekon_data);
        print_r($ekon_data);
        die;
         
    }
    public function pay_web_amount()
    {
        
        $this->load->library('form_validation');
      
            $razorpay_currency = $this->db->get_where('settings', array('key' => 'razorpay_currency'))->row()->value;

            $razorpay = $this->razorpay();
            $api = new Api($razorpay[0]->public_key, $razorpay[0]->secret_key);
          

            /**
             * You can calculate payment amount as per your logic
             * Always set the amount from backend for security reasons
             */
            $_SESSION['amount'] = $_SESSION['amount'];
         
            $razorpayOrder = $api->order->create(array(
                'receipt' => rand(),
                'amount' => $_SESSION['amount'] * 100,
              
     // 2000 rupees in paise
                'currency' => $razorpay_currency,
                'payment_capture' => 1 // auto capture
            ));
           
           

            $amount = $razorpayOrder['amount'];
          
            $razorpayOrderId = $razorpayOrder['id'];

            $_SESSION['razorpay_order_id'] = $razorpayOrderId;
        

            $data = $this->web_prepareData($amount, $razorpayOrderId);

            $this->load->view('frontend/razorpay/web_razorpay', array('data' => $data));
       
 

    }

    public function web_prepareData($amount, $razorpayOrderId)
    {

        $razorpay = $this->razorpay();
    
        $data = array(
            "key" => $razorpay[0]->public_key,
            "amount" => $amount,
            "name" => "EKON Solutions India Private Limited. ",
            "description" => "Course Purchase",
            "image" => base_url('assets/frontend/default/assets/elogo.png'),
            "prefill" => array(
                "name" => "Chancnla",
                "email" => "ck@gmail.com",
                "contact" => "966623427",
            ),
            "notes" => array(
                "address" => "Hello World",
                "merchant_order_id" => rand(),
            ),
            "theme" => array(
                "color" => "#F37254"
            ),
            "order_id" => $razorpayOrderId,
        );

        return $data;
    }
    public function web_verify()
    {
        $razorpay = $this->razorpay();
        $success = true;
        $error = "payment_failed";

        $api = new Api($razorpay[0]->public_key, $razorpay[0]->secret_key);
        $payment_data = $api->payment->fetch($_POST['razorpay_payment_id']);

        if (empty($_POST['razorpay_payment_id']) === false) {

            try {
                $attributes = array(
                    'razorpay_order_id' => $_SESSION['razorpay_order_id'],
                    'razorpay_payment_id' => $_POST['razorpay_payment_id'],
                    'razorpay_signature' => $_POST['razorpay_signature'],
                );
                $api->utility->verifyPaymentSignature($attributes);

                $payment_data = $api->payment->fetch($_POST['razorpay_payment_id']);

                /************* Update User Contact ****************/
                // $user_data = $this->user_model->get_all_users($_SESSION['user_id'])->row();
                if ($user_data->contact == 0) {
                    $num = $payment_data->contact;
                    $country_code = +91;
                    $number = preg_replace("/^\+?{$country_code}/", '', $num);
                    // $this->crud_model->update_user_contact($_SESSION['user_id'], $number);
                }

                $trans_data = [
                    'payment_id' => $payment_data->id,
                    'amount' => $payment_data->amount / 100,
                    'currency' => $payment_data->currency,
                    'status' => $payment_data->status,
                    'payment_order_id' => $payment_data->order_id,
                    'method' => $payment_data->method,
                    'description' => $payment_data->description,
                    'card_id' => $payment_data->card_id,
                    'bank' => $payment_data->bank,
                    'wallet' => $payment_data->wallet,
                    'vpa' => $payment_data->vpa,
                    'contact' => $payment_data->contact,
                    'email' => $payment_data->email,
                    // 'user_id' => $this->session->userdata('user_id'),
                    'upi_transaction_id' => $payment_data->acquirer_data->upi_transaction_id,
                    'bank_transaction_id' => $payment_data->acquirer_data->bank_transaction_id,
                    'transaction_id' => $payment_data->acquirer_data->transaction_id,
                ];
                // print_r( $trans_data);
                // die;

                $this->crud_model->payment_transaction($trans_data, 'payment_transaction');

                if ($payment_data->card_id != "") {
                    $card_data = [
                        'card_id' => $payment_data->card->id,
                        'entity' => $payment_data->card->entity,
                        'name' => $payment_data->card->name,
                        'last4_digit' => $payment_data->card->last4,
                        'network' => $payment_data->card->network,
                        'type' => $payment_data->card->type,
                        'issuer' => $payment_data->card->issuer,
                        'international' => $payment_data->card->international,
                        'emi' => $payment_data->card->emi,
                        'sub_type' => $payment_data->card->sub_type,
                        'token_iin' => $payment_data->card->token_iin,
                        'auth_code' => $payment_data->acquirer_data->auth_code,
                        'authentication_reference_number' => $payment_data->acquirer_data->authentication_reference_number,
                    ];

                    $this->crud_model->payment_transaction($card_data, 'payment_card_transaction');

                }


            } catch (SignatureVerificationError $e) {
                $success = false;
                $error = 'Razorpay_Error : ' . $e->getMessage();
            }
        }
        if ($success === true) {
            // $this->webinar_register();
            /**
             * Call this function from where ever you want
             * to save save data before of after the payment
             */
            $this->update_enrol_course_of_user($payment_data->id);
            redirect(base_url() . 'home/payment_success');
        } else {
            redirect(base_url() . 'home/payment_failed');
        }
    }
    
    
}


