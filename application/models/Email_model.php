<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function send_email_verification_mail($to = "", $verification_code = "")
    {
        $to_name = $this->db->get_where('users', array('email' => $to))->row_array();

        $subject = "Verify email address";
        $from = get_settings('system_email');
        $message = "Hi " . $to_name['first_name'] . " " . $to_name['last_name'] . ", <br>
		The OTP to get registered on Ekon Academy is " . $verification_code . ". <br>
		Do not share this to anyone.<br>
		Thanks <br>
		Team Ekon";
        $email_data['to_name'] = $to_name['first_name'] . ' ' . $to_name['last_name'];
        $email_data['verification_code'] = $verification_code;
        $email_template = $this->load->view('email/email_verification', $email_data, TRUE);
        //$this->send_smtp_mail($email_template, $email_data['subject'], $email_data['to'], $email_data['from'], 'verification');
        $this->leadofy_mail_api('YjMxNTQ4MDA3Yzk5MTI3MDkxY2M5YTEwYmNhYzhhNTY=', $subject, $to, '1', $email_template, '#', "Ekon Academy", $from, "Ekon Academy", $from);
    }


    function password_reset_email($new_password = '', $email = '')
    {
        $query = $this->db->get_where('users', array('email' => $email));
        if ($query->num_rows() > 0) {
            $email_data['subject'] = "Password reset request";
            $email_data['from'] = get_settings('system_email');
            $email_data['to'] = $email;
            $email_data['to_name'] = $query->row('first_name') . ' ' . $query->row('last_name');
            $email_data['message'] = 'Hi <b>' . $query->row('first_name') . ' ' . $query->row('last_name') . '</b>,<br>
                                      We have got a request to reset your password. <b style="cursor: pointer;"><u>' . $new_password . '</u></b> is your new password.<br>
                                      Do not share it with anyone </br> ';
            $email_template = $this->load->view('email/common_template', $email_data, TRUE);
            //$this->send_smtp_mail($email_template, $email_data['subject'], $email_data['to'], $email_data['from']);
            $this->leadofy_mail_api('YjMxNTQ4MDA3Yzk5MTI3MDkxY2M5YTEwYmNhYzhhNTY=', $email_data['subject'], $email_data['to'], '1', $email_template, '#', "Ekon Academy", $email_data['from'], "Ekon Academy", $email_data['from']);
            return true;
        } else {
            return false;
        }
    }

    public function send_mail_on_course_status_changing($course_id = "", $mail_subject = "", $mail_body = "")
    {
        $instructor_id = 0;
        $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
        if ($course_details['user_id'] != "") {
            $instructor_id = $course_details['user_id'];
        } else {
            $instructor_id = $this->session->userdata('user_id');
        }
        $instuctor_details = $this->user_model->get_all_user($instructor_id)->row_array();


        $email_data['subject'] = $mail_subject;
        $email_data['from'] = get_settings('system_email');
        $email_data['to'] = $instuctor_details['email'];
        $email_data['to_name'] = $instuctor_details['first_name'] . ' ' . $instuctor_details['last_name'];
        $email_data['message'] = $mail_body;
        $email_template = $this->load->view('email/common_template', $email_data, TRUE);
        //$this->send_smtp_mail($email_template, $email_data['subject'], $email_data['to'], $email_data['from']);
        $this->leadofy_mail_api('YjMxNTQ4MDA3Yzk5MTI3MDkxY2M5YTEwYmNhYzhhNTY=', $email_data['subject'], $email_data['to'], '1', $email_template, '#', "Ekon Academy", $email_data['from'], "Ekon Academy", $email_data['from']);
    }

    public function course_purchase_notification($student_id = "", $payment_method = "", $amount_paid = "")
    {
        $purchased_courses = $this->session->userdata('cart_items');
        $student_data = $this->user_model->get_all_user($student_id)->row_array();
        $student_full_name = $student_data['first_name'] . ' ' . $student_data['last_name'];
        $admin_id = $this->user_model->get_admin_details()->row('id');
        foreach ($purchased_courses as $course_id) {
            $course_owner_user_id = $this->crud_model->get_course_by_id($course_id)->row('user_id');
            if ($course_owner_user_id != $admin_id):
                $this->course_purchase_notification_admin($course_id, $student_full_name, $student_data['email'], $amount_paid);
            endif;
            $this->course_purchase_notification_instructor($course_id, $student_full_name, $student_data['email']);
            $this->course_purchase_notification_student($course_id, $student_id);
        }
    }

    public function course_purchase_notification_admin($course_id = "", $student_full_name = "", $student_email = "", $amount = "")
    {
        $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
        $admin_details = $this->user_model->get_admin_details();
        $instructor_details = $this->user_model->get_all_user($course_details['user_id'])->row_array();
        $admin_msg = "<h2>" . $course_details['title'] . "</h2>";
        $admin_msg .= "<h3><b><u><span style='color: #2ec75e;'>Course Price : " . currency($amount) . "</span></u></b></h3>";
        $admin_msg .= "<p><b>Course owner:</b></p>";
        $admin_msg .= "<p>Name: <b>" . $instructor_details['first_name'] . " " . $instructor_details['last_name'] . "</b></p>";
        $admin_msg .= "<p>Email: <b>" . $instructor_details['email'] . "</b></p>";
        $admin_msg .= "<hr style='opacity: .4;'>";
        $admin_msg .= "<p><b>Bought the course:-</b></p>";
        $admin_msg .= "<p>Name: <b>" . $student_full_name . "</b></p>";
        $admin_msg .= "<p>Email: <b>" . $student_email . "</b></p>";


        $email_data['subject'] = 'The course has sold out';
        $email_data['from'] = get_settings('system_email');
        $email_data['to'] = $admin_details->row('email');
        $email_data['to_name'] = $admin_details->row('first_name') . ' ' . $admin_details->row('last_name');
        $email_data['message'] = $admin_msg;
        $email_template = $this->load->view('email/common_template', $email_data, TRUE);
        //$this->send_smtp_mail($email_template, $email_data['subject'], $email_data['to'], $email_data['from']);
        $this->leadofy_mail_api('YjMxNTQ4MDA3Yzk5MTI3MDkxY2M5YTEwYmNhYzhhNTY=', $email_data['subject'], $email_data['to'], '1', $email_template, '#', "Ekon Academy", $email_data['from'], "Ekon Academy", $email_data['from']);
    }

    public function course_purchase_notification_instructor($course_id = "", $student_full_name = "", $student_email = "")
    {
        $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
        $instructor_details = $this->user_model->get_all_user($course_details['user_id']);
        $instructor_msg = "<h2>" . $course_details['title'] . "</h2>";
        $instructor_msg .= "<p>Congratulation!! Your <b>" . $course_details['title'] . "</b> courses have been sold.</p>";
        $instructor_msg .= "<p><b>Bought the course:-</b></p>";
        $instructor_msg .= "<p>Name: <b>" . $student_full_name . "</b></p>";
        $instructor_msg .= "<p>Email: <b>" . $student_email . "</b></p>";

        $email_data['subject'] = 'The course has sold out';
        $email_data['from'] = get_settings('system_email');
        $email_data['to'] = $instructor_details->row('email');
        $email_data['to_name'] = $instructor_details->row('first_name') . ' ' . $instructor_details->row('last_name');
        $email_data['message'] = $instructor_msg;
        $email_template = $this->load->view('email/common_template', $email_data, TRUE);
        //$this->send_smtp_mail($email_template, $email_data['subject'], $email_data['to'], $email_data['from']);
        $this->leadofy_mail_api('YjMxNTQ4MDA3Yzk5MTI3MDkxY2M5YTEwYmNhYzhhNTY=', $email_data['subject'], $email_data['to'], '1', $email_template, '#', "Ekon Academy", $email_data['from'], "Ekon Academy", $email_data['from']);

    }

    public function course_purchase_notification_student($course_id = "", $student_id = "")
    {
        $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
        $student_details = $this->user_model->get_all_user($student_id);
        $instructor_details = $this->user_model->get_all_user($course_details['user_id'])->row_array();
        $student_msg = "<h2>" . $course_details['title'] . "</h2>";
        $student_msg .= "<p><b>Congratulation!!</b> You have purchased a <b>" . $course_details['title'] . "</b> course.</p>";
        $student_msg .= "<hr style='opacity: .4;'>";
        $student_msg .= "<p><b>Course owner:</b></p>";
        $student_msg .= "<p>Name: <b>" . $instructor_details['first_name'] . " " . $instructor_details['last_name'] . "</b></p>";
        $student_msg .= "<p>Email: <b>" . $instructor_details['email'] . "</b></p>";

        $email_data['subject'] = 'Course Purchase';
        $email_data['from'] = get_settings('system_email');
        $email_data['to'] = $student_details->row('email');
        $email_data['to_name'] = $student_details->row('first_name') . ' ' . $student_details->row('last_name');
        $email_data['message'] = $student_msg;
        $email_template = $this->load->view('email/common_template', $email_data, TRUE);
        //$this->send_smtp_mail($email_template, $email_data['subject'], $email_data['to'], $email_data['from']);
        $this->leadofy_mail_api('YjMxNTQ4MDA3Yzk5MTI3MDkxY2M5YTEwYmNhYzhhNTY=', $email_data['subject'], $email_data['to'], '1', $email_template, '#', "Ekon Academy", $email_data['from'], "Ekon Academy", $email_data['from']);
    }

    public function notify_on_certificate_generate($user_id = "", $course_id = "")
    {
        $checker = array(
            'course_id' => $course_id,
            'student_id' => $user_id
        );
        $result = $this->db->get_where('certificates', $checker)->row_array();
        $certificate_link = site_url('certificate/' . $result['shareable_url']);
        $course_details = $this->crud_model->get_course_by_id($course_id)->row_array();
        $user_details = $this->user_model->get_all_user($user_id)->row_array();
        $email_msg = "<b>Congratulations!!</b> " . $user_details['first_name'] . " " . $user_details['last_name'] . ",";
        $email_msg .= "<p>You have successfully completed the course named, <b>" . $course_details['title'] . ".</b></p>";
        $email_msg .= "<p>You can get your course completion certificate from here <b>" . $certificate_link . ".</b></p>";

        $email_data['subject'] = 'Course Completion Notification';
        $email_data['from'] = get_settings('system_email');
        $email_data['to'] = $user_details['email'];
        $email_data['to_name'] = $user_details['first_name'] . ' ' . $user_details['last_name'];
        $email_data['message'] = $student_msg;
        $email_template = $this->load->view('email/common_template', $email_data, TRUE);
        //$this->send_smtp_mail($email_template, $email_data['subject'], $email_data['to'], $email_data['from']);
        $this->leadofy_mail_api('YjMxNTQ4MDA3Yzk5MTI3MDkxY2M5YTEwYmNhYzhhNTY=', $email_data['subject'], $email_data['to'], '1', $email_template, '#', "Ekon Academy", $email_data['from'], "Ekon Academy", $email_data['from']);
    }

    public function suspended_offline_payment($user_id = "")
    {
        $user_details = $this->user_model->get_all_user($user_id);
        $email_msg = "<p>Your offline payment has been <b style='color: red;'>suspended</b> !</p>";
        $email_msg .= "<p>Please provide a valid document of your payment.</p>";

        $email_data['subject'] = 'Suspended Offline Payment';
        $email_data['from'] = get_settings('system_email');
        $email_data['to'] = $user_details->row('email');
        $email_data['to_name'] = $user_details->row('first_name') . ' ' . $user_details->row('last_name');
        $email_data['message'] = $email_msg;
        $email_template = $this->load->view('email/common_template', $email_data, TRUE);
        //$this->send_smtp_mail($email_template, $email_data['subject'], $email_data['to'], $email_data['from']);
        $this->leadofy_mail_api('YjMxNTQ4MDA3Yzk5MTI3MDkxY2M5YTEwYmNhYzhhNTY=', $email_data['subject'], $email_data['to'], '1', $email_template, '#', "Ekon Academy", $email_data['from'], "Ekon Academy", $email_data['from']);
    }


    public function bundle_purchase_notification($student_id = "", $payment_method = "", $amount_paid = "")
    {
        $bundle_id = $this->session->userdata('checkout_bundle_id');
        $bundle_details = $this->course_bundle_model->get_bundle($bundle_id)->row_array();

        $admin_details = $this->user_model->get_admin_details()->row_array();
        $bundle_creator_details = $this->user_model->get_all_user($bundle_details['user_id'])->row_array();
        $student_details = $this->user_model->get_all_user($student_id)->row_array();

        if ($admin_details['id'] != $bundle_creator_details['id']) {
            $this->bundle_purchase_notification_admin($bundle_details, $admin_details, $bundle_creator_details, $student_details);
        }
        $this->bundle_purchase_notification_bundle_creator($bundle_details, $admin_details, $bundle_creator_details, $student_details);
        $this->bundle_purchase_notification_student($bundle_details, $admin_details, $bundle_creator_details, $student_details);
    }

    function bundle_purchase_notification_admin($bundle_details = "", $admin_details = "", $bundle_creator_details = "", $student_details = "")
    {
        $email_msg = "<h2>" . $bundle_details['title'] . "</h2>";
        $email_msg .= "<h3><b><u><span style='color: #2ec75e;'>Bundle Price : " . currency($bundle_details['price']) . "</span></u></b></h3>";
        $email_msg .= "<p><b>Bundle owner:</b></p>";
        $email_msg .= "<p>Name: <b>" . $bundle_creator_details['first_name'] . " " . $bundle_creator_details['last_name'] . "</b></p>";
        $email_msg .= "<p>Email: <b>" . $bundle_creator_details['email'] . "</b></p>";
        $email_msg .= "<hr style='opacity: .4;'>";
        $email_msg .= "<p><b>Bought the bundle:-</b></p>";
        $email_msg .= "<p>Name: <b>" . $student_details['first_name'] . " " . $student_details['last_name'] . "</b></p>";
        $email_msg .= "<p>Email: <b>" . $student_details['email'] . "</b></p>";

        $email_data['subject'] = 'The bundle has sold out';
        $email_data['from'] = get_settings('system_email');
        $email_data['to'] = $admin_details['email'];
        $email_data['to_name'] = $admin_details['first_name'] . ' ' . $admin_details['last_name'];
        $email_data['message'] = $email_msg;
        $email_template = $this->load->view('email/common_template', $email_data, TRUE);
        //$this->send_smtp_mail($email_template, $email_data['subject'], $email_data['to'], $email_data['from']);
        $this->leadofy_mail_api('YjMxNTQ4MDA3Yzk5MTI3MDkxY2M5YTEwYmNhYzhhNTY=', $email_data['subject'], $email_data['to'], '1', $email_template, '#', "Ekon Academy", $email_data['from'], "Ekon Academy", $email_data['from']);
    }

    function bundle_purchase_notification_bundle_creator($bundle_details = "", $admin_details = "", $bundle_creator_details = "", $student_details = "")
    {
        $email_msg = "<h2>" . $bundle_details['title'] . "</h2>";
        $email_msg .= "<p>Congratulation!! Your <b>" . $bundle_details['title'] . "</b> course bundle have been sold.</p>";
        $email_msg .= "<h3><b><u><span style='color: #2ec75e;'>Bundle Price : " . currency($bundle_details['price']) . "</span></u></b></h3>";
        $email_msg .= "<p><b>Bought the bundle:-</b></p>";
        $email_msg .= "<p>Name: <b>" . $student_details['first_name'] . ' ' . $student_details['last_name'] . "</b></p>";
        $email_msg .= "<p>Email: <b>" . $student_details['email'] . "</b></p>";

        $email_data['subject'] = 'The bundle has sold out';
        $email_data['from'] = get_settings('system_email');
        $email_data['to'] = $bundle_creator_details['email'];
        $email_data['to_name'] = $bundle_creator_details['first_name'] . ' ' . $bundle_creator_details['last_name'];
        $email_data['message'] = $email_msg;
        $email_template = $this->load->view('email/common_template', $email_data, TRUE);
        //$this->send_smtp_mail($email_template, $email_data['subject'], $email_data['to'], $email_data['from']);
        $this->leadofy_mail_api('YjMxNTQ4MDA3Yzk5MTI3MDkxY2M5YTEwYmNhYzhhNTY=', $email_data['subject'], $email_data['to'], '1', $email_template, '#', "Ekon Academy", $email_data['from'], "Ekon Academy", $email_data['from']);
    }

    function bundle_purchase_notification_student($bundle_details = "", $admin_details = "", $bundle_creator_details = "", $student_details = "")
    {
        $email_msg = "<h2>" . $bundle_details['title'] . "</h2>";
        $email_msg .= "<p><b>Congratulation!!</b> You have purchased a <b>" . $bundle_details['title'] . "</b> bundle.</p>";
        $email_msg .= "<h3><b><u><span style='color: #2ec75e;'>Bundle Price : " . currency($bundle_details['price']) . "</span></u></b></h3>";
        $email_msg .= "<hr style='opacity: .4;'>";
        $email_msg .= "<p><b>Bundle owner:</b></p>";
        $email_msg .= "<p>Name: <b>" . $bundle_creator_details['first_name'] . " " . $bundle_creator_details['last_name'] . "</b></p>";
        $email_msg .= "<p>Email: <b>" . $bundle_creator_details['email'] . "</b></p>";

        $email_data['subject'] = 'Bundle Purchase';
        $email_data['from'] = get_settings('system_email');
        $email_data['to'] = $student_details['email'];
        $email_data['to_name'] = $student_details['first_name'] . ' ' . $student_details['last_name'];
        $email_data['message'] = $email_msg;
        $email_template = $this->load->view('email/common_template', $email_data, TRUE);
        //$this->send_smtp_mail($email_template, $email_data['subject'], $email_data['to'], $email_data['from']);
        $this->leadofy_mail_api('YjMxNTQ4MDA3Yzk5MTI3MDkxY2M5YTEwYmNhYzhhNTY=', $email_data['subject'], $email_data['to'], '1', $email_template, '#', "Ekon Academy", $email_data['from'], "Ekon Academy", $email_data['from']);
    }

    function send_notice($notice_id = "", $course_id = "")
    {
        $course_details = $this->crud_model->get_courses($course_id)->row_array();
        $notice_details = $this->noticeboard_model->get_notices($notice_id)->row_array();

        $email_data['subject'] = htmlspecialchars_decode($notice_details['title']);
        $email_data['from'] = get_settings('system_email');
        $email_data['course_title'] = $course_details['title'];

        $enrolled_students = $this->crud_model->enrol_history($course_id)->result_array();
        foreach ($enrolled_students as $enrolled_student):
            $student_details = $this->user_model->get_user($enrolled_student['user_id'])->row_array();
            $email_data['to'] = $student_details['email'];
            $email_data['to_name'] = $student_details['first_name'] . ' ' . $student_details['last_name'];
            $email_data['message'] = htmlspecialchars_decode($notice_details['description']) . '<hr style="border: 1px solid #efefef; margin-top: 50px;"> <small><b>' . get_phrase('course') . ':</b> ' . $course_details['title'] . '<br> <b>' . get_phrase('instructor') . ': </b> ' . $course_details['title'] . '</small>';

            $email_template = $this->load->view('email/common_template', $email_data, TRUE);
            //$this->send_smtp_mail($email_template, $email_data['subject'], $email_data['to'], $email_data['from']);
            $this->leadofy_mail_api('YjMxNTQ4MDA3Yzk5MTI3MDkxY2M5YTEwYmNhYzhhNTY=', $email_data['subject'], $email_data['to'], '1', $email_template, '#', "Ekon Academy", $email_data['from'], "Ekon Academy", $email_data['from']);
        endforeach;

        return 1;
    }

    public function send_smtp_mail($msg = NULL, $sub = NULL, $to = NULL, $from = NULL, $email_type = NULL, $verification_code = null)
    {

        //Load email library

        $this->load->library('email');

        if ($from == NULL)
            $from = $this->db->get_where('settings', array('key' => 'system_email'))->row()->value;

        //SMTP & mail configuration

        $config = array(
            'protocol' => get_settings('protocol'),
            'smtp_host' => get_settings('smtp_host'),
            'smtp_port' => get_settings('smtp_port'),
            'smtp_user' => get_settings('smtp_user'),
            'smtp_pass' => get_settings('smtp_pass'),
            'mailtype' => 'html',
            'charset' => 'utf-8'
        );
        $this->email->set_header('MIME-Version', 1.0);
        $this->email->set_header('Content-type', 'text/html');
        $this->email->set_header('charset', 'UTF-8');

        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        $this->email->to($to);
        $this->email->from($from, get_settings('system_name'));
        $this->email->subject($sub);
        $this->email->message($msg);

        //Send email
        $this->email->send();
    }

    public function leadofy_mail_api($api_key, $subject, $emails, $type, $template, $url, $sender_name, $sender_email)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://bulkmail.smsby2.in/api.html');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        $payload = array(
            'api_key' => $api_key,
            'subject' => $subject,
            'sender_name' => $sender_name,
            'sender_email' => $sender_email,
            'emails' => $emails,
            'type' => $type,
            'template' => $template,
            'url' => $url
        );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        $response = curl_exec($ch);
        curl_close($ch);
    }


    public function send_email_student_register_mail($to = "")
    {

        //  $to_name = $this->user_model->get_all_user($user_id);
        //  print_r($to_name);die;


        array('email' => $to);

        // $to_name1 =$to_name['first_name'];
        // $to_name2 =$to_name['last_name'];

        $subject = "Register your Account email address";
        $from = get_settings('system_email');
        $message = "Hi ";
        // .$to_name1." ".$to_name2.", <br>
        // The OTP to get registered on Ekon Academy is ".$user_id.". <br>
        // Do not share this to anyone.<br>
        // Thanks <br>
        // Team Ekon";

        //  $email_data['to_name'] = $to_name1.' '.$to_name2;
        //  $email_data['verification_code'] = $to_name1.' '.$to_name2;
        // $email_template = $this->load->view('email/email_verification', $email_data, TRUE);
        //$this->send_smtp_mail($email_template, $email_data['subject'], $email_data['to'], $email_data['from'], 'verification');
        $this->leadofy_mail_api('YjMxNTQ4MDA3Yzk5MTI3MDkxY2M5YTEwYmNhYzhhNTY=', $subject, $to, '1', $message, '#', "Ekon Academy", $from, "Ekon Academy", $from);
    }

    public function send_email_student_register_mail1($user_id = "", $to = "")
    {
        $user_details = $this->user_model->get_all_user($user_id, array('email' => $to));
        $email_msg = "<p>Your offline payment has been <b style='color: red;'>suspended</b> !</p>";
        $email_msg .= "<p>Please provide a valid document of your payment.</p>";

        $email_data['subject'] = 'Suspended Offline Payment';
        $email_data['from'] = get_settings('system_email');
        $email_data['to'] = $user_details->row('email');
        $email_data['to_name'] = $user_details->row('first_name') . ' ' . $user_details->row('last_name');
        $email_data['message'] = $email_msg;
        $email_template = $this->load->view('email/common_template', $email_data, TRUE);
        //$this->send_smtp_mail($email_template, $email_data['subject'], $email_data['to'], $email_data['from']);
        $this->leadofy_mail_api('YjMxNTQ4MDA3Yzk5MTI3MDkxY2M5YTEwYmNhYzhhNTY=', $email_data['subject'], $email_data['to'], '1', $email_template, '#', "Ekon Academy", $email_data['from'], "Ekon Academy", $email_data['from']);
    }


    public function send_mail_on_course_status_changingg($value = "", $mail_subject = "", $mail_body = "")
    {
        $id = 0;
        // $course_details    = $this->crud_model->get_course_by_id($course_id)->row_array();
        // if ($course_details['user_id'] != "") {
        // 	$instructor_id = $course_details['user_id'];
        // }else {
        // 	$instructor_id = $this->session->userdata('user_id');
        // }
        //  $to_name = $this->db->get_where('users', array('email' => $to))->row_array();
        $instuctor_details = $this->user_model->get_all_user($id)->row_array();


        $email_data['subject'] = $mail_subject;
        $email_data['from'] = get_settings('system_email');
        $email_data['to'] = $instuctor_details['email'];
        $email_data['to_name'] = $instuctor_details['first_name'] . ' ' . $instuctor_details['last_name'];
        $email_data['message'] = $mail_body;
        $email_template = $this->load->view('email/common_template', $email_data, TRUE);
        //$this->send_smtp_mail($email_template, $email_data['subject'], $email_data['to'], $email_data['from']);
        $this->leadofy_mail_api('YjMxNTQ4MDA3Yzk5MTI3MDkxY2M5YTEwYmNhYzhhNTY=', $email_data['subject'], $email_data['to'], '1', $email_template, '#', "Ekon Academy", $email_data['from'], "Ekon Academy", $email_data['from']);

    }

    public function purchase_course_by_online($user_id, $cart_course_id = '')
    {
        $student_details = $this->user_model->get_all_user($user_id)->row_array();

        $course_name = "";
        foreach ($cart_course_id as $id) {
            if ($id != "") {
                $course_details = $this->crud_model->get_course($id);
                if ($course_name == "") {
                    $course_name = $course_details[0]['title'];
                } else {
                    $course_name = $course_name . ',' . $course_details[0]['title'];
                }
            }
        }
        $email_msg .= 'Hi <b>' . $student_details['first_name'] . ' ' . $student_details['last_name'] . '</b>,<br> 
                        Thank You,<br>
                        You have successfully purchased a course from Us. <br>
                        Course details: - <b>' . $course_name . '</b><br>
                      ';
        $email_msg .= "<hr style='opacity: .4;'>";

        $email_data['subject'] = 'Courses Purchase';
        $email_data['from'] = get_settings('system_email');
//        $email_data['to'] = $student_details['email'];
        $email_data['to'] = ($student_details['email'] . ',' . 'vinay@skylabstech.com');
        $email_data['to_name'] = $student_details['first_name'] . ' ' . $student_details['last_name'];
        $email_data['message'] = $email_msg;
        $email_template = $this->load->view('email/common_template', $email_data, TRUE);
        //$this->send_smtp_mail($email_template, $email_data['subject'], $email_data['to'], $email_data['from']);

        $this->leadofy_mail_api('YjMxNTQ4MDA3Yzk5MTI3MDkxY2M5YTEwYmNhYzhhNTY=', $email_data['subject'], $email_data['to'], '1', $email_template, '#', "Ekon Academy", $email_data['from']);

//        $this->leadofy_mail_api('YjMxNTQ4MDA3Yzk5MTI3MDkxY2M5YTEwYmNhYzhhNTY=', $email_data['subject'], $email_data['to'], '1', $email_template, '#', "Ekon Academy", $email_data['from'], "Ekon Academy", $email_data['from']);
    }

    public function new_register_student($user_id, $pass = "")
    {
        $student_details = $this->user_model->get_all_user($user_id)->row_array();
        $email_msg = "Hi " . $student_details['first_name'] . ' ' . $student_details['last_name'] . "<br>
                        You have successfully registered on Ekon Academy. Thank You for joining.<br>
                        Username :-" . $student_details['email'] . "<br>
                        Password :-" . $pass . "<br>
                        Don’t share your password with anyone.
                      ";

        $email_data['subject'] = 'Register Successfully';
        $email_data['from'] = get_settings('system_email');
        $email_data['to'] = ($student_details['email'] . ',' . $email_data['from']);
//        $email_data['to'] = $student_details['email'];
        $email_data['to_name'] = $student_details['first_name'] . ' ' . $student_details['last_name'];
        $email_data['message'] = $email_msg;
        $email_template = $this->load->view('email/common_template', $email_data, TRUE);
        //$this->send_smtp_mail($email_template, $email_data['subject'], $email_data['to'], $email_data['from']);
        $this->leadofy_mail_api('YjMxNTQ4MDA3Yzk5MTI3MDkxY2M5YTEwYmNhYzhhNTY=', $email_data['subject'], $email_data['to'], '1', $email_template, '#', "Ekon Academy", $email_data['from']);
//        $this->leadofy_mail_api('YjMxNTQ4MDA3Yzk5MTI3MDkxY2M5YTEwYmNhYzhhNTY=', $email_data['subject'], $email_data['to'], '1', $email_template, '#', "Ekon Academy", $email_data['from'], "Ekon Academy", $email_data['from']);
    }

    public function batch_info_mail_is_instructor($user_id, $course_id = '', $time = '')
    {
        $student_details = $this->user_model->get_all_user($user_id)->row_array();
        $course_details = $this->crud_model->get_course($course_id);

        $email_msg .= "<hr style='opacity: .4;'>";
        $email_msg .= 'Hi <b>' . $student_details['first_name'] . ' ' . $student_details['last_name'] . '</b> ,<br>
                        Your allotted batch of <b><u>' . $course_details[0]['title'] . '</u></b> will start time <b><u>' . date('h:i A', strtotime($time)) . '</u></b>.';
        $email_msg .= "<hr style='opacity: .4;'>";


        $email_data['subject'] = 'Batch information';
        $email_data['from'] = get_settings('system_email');
//        $email_data['to'] = $student_details['email'];
        $email_data['to'] = ($student_details['email'] . ',' . 'vinay@skylabstech.com');
        $email_data['to_name'] = $student_details['first_name'] . ' ' . $student_details['last_name'];
        $email_data['message'] = $email_msg;
        $email_template = $this->load->view('email/common_template', $email_data, TRUE);
        //$this->send_smtp_mail($email_template, $email_data['subject'], $email_data['to'], $email_data['from']);

        $this->leadofy_mail_api('YjMxNTQ4MDA3Yzk5MTI3MDkxY2M5YTEwYmNhYzhhNTY=', $email_data['subject'], $email_data['to'], '1', $email_template, '#', "Ekon Academy", $email_data['from']);
    }

    public function batch_info_mail($user_id, $course_id = '', $time = '', $ins_id = '')
    {
        $student_details = $this->user_model->get_all_user($user_id)->row_array();
//        $ins_details = $this->user_model->get_all_user($ins_id)->row_array();
        $course_details = $this->crud_model->get_course($course_id);

        $ins_name = "";
        foreach ($ins_id as $instructor_id) {
            $ins_details = $this->user_model->get_all_user($instructor_id)->row_array();
            if ($ins_name == "") {
                $ins_name = $ins_details['first_name'] . ' ' . $ins_details['last_name'];
            } else {
                $ins_name = $ins_name . ',' . $ins_details['first_name'] . ' ' . $ins_details['last_name'];
            }
        }

        $email_msg .= 'Hi <b>' . $student_details['first_name'] . ' ' . $student_details['last_name'] . '</b> <br>
                       You have enrolled in <b><u>' . $course_details[0]['title'] . '</u></b> course. Your allotted batch will start time <b><u>' . date('h:i A', strtotime($time)) . '</u></b>.
                       <b><u>' . $ins_name . '</u></b> will be your trainer. <br>
                       HAPPY LEARNING.
                       ';
        $email_msg .= "<hr style='opacity: .4;'>";


        $email_data['subject'] = 'Batch information';
        $email_data['from'] = get_settings('system_email');
//        $email_data['to'] = $student_details['email'];
        $email_data['to'] = ($student_details['email'] . ',' . 'vinay@skylabstech.com' . ',' . 'achchakhasa@gmail.com');
        $email_data['to_name'] = $student_details['first_name'] . ' ' . $student_details['last_name'];
        $email_data['message'] = $email_msg;
        $email_template = $this->load->view('email/common_template', $email_data, TRUE);
        //$this->send_smtp_mail($email_template, $email_data['subject'], $email_data['to'], $email_data['from']);


        $this->leadofy_mail_api('YjMxNTQ4MDA3Yzk5MTI3MDkxY2M5YTEwYmNhYzhhNTY=', $email_data['subject'], $email_data['to'], '1', $email_template, '#', "Ekon Academy", $email_data['from']);

    }


    public function payment_repay($user_id, $cart_course_id = '', $amount = '')
    {
        $student_details = $this->user_model->get_all_user($user_id)->row_array();

        $course_name = "";
        foreach ($cart_course_id as $id) {
            if ($id != "") {
                $course_details = $this->crud_model->get_course($id);
                if ($course_name == "") {
                    $course_name = $course_details[0]['title'];
                } else {
                    $course_name = $course_name . ',' . $course_details[0]['title'];
                }
            }
        }
        $email_msg .= 'Hi <b>' . $student_details['first_name'] . ' ' . $student_details['last_name'] . '</b>,<br> 
                        Thank You,<br>
                        Your payment repay successfully purchased a course from Us. <br>
                        Course details : - <b>' . $course_name . '</b><br>
                        Repay Money : - <b>' . $amount . '</b><br>
                      ';
        $email_msg .= "<hr style='opacity: .4;'>";

        $email_data['subject'] = 'Courses Purchase';
        $email_data['from'] = get_settings('system_email');
//        $email_data['to'] = $student_details['email'];
        $email_data['to'] = ($student_details['email'] . ',' . 'vinay@skylabstech.com');
        $email_data['to_name'] = $student_details['first_name'] . ' ' . $student_details['last_name'];
        $email_data['message'] = $email_msg;
        $email_template = $this->load->view('email/common_template', $email_data, TRUE);
        //$this->send_smtp_mail($email_template, $email_data['subject'], $email_data['to'], $email_data['from']);

        $this->leadofy_mail_api('YjMxNTQ4MDA3Yzk5MTI3MDkxY2M5YTEwYmNhYzhhNTY=', $email_data['subject'], $email_data['to'], '1', $email_template, '#', "Ekon Academy", $email_data['from']);

//        $this->leadofy_mail_api('YjMxNTQ4MDA3Yzk5MTI3MDkxY2M5YTEwYmNhYzhhNTY=', $email_data['subject'], $email_data['to'], '1', $email_template, '#', "Ekon Academy", $email_data['from'], "Ekon Academy", $email_data['from']);
    }
   

    public function webinar_register_mail($user_email, $webinar_id)
    {
        $email_msg = '';
        $student_details = $this->db->get_where('ck_webinar_register', ['email' => $user_email, 'webinar_id' => $webinar_id])->row_array();
        $webinar_details = $this->db->get_where('ck_webinar', ['id' => $webinar_id])->row_array();
        // print_r($webinar_details['zoom_attend_link']);
        // die;
       
        $email_msg .= "<hr style='opacity: .4;'>";
        $email_msg .= 'Hi <b>' . $student_details['name'] . '</b> ,<br>
                       Your can join this webinar by belwo link. <br>
                       <a target="_blank" href="' . $webinar_details['Joinee_link'] . '">
                              ' . $webinar_details['Joinee_link'] . '
                        </a>';

        $email_msg .= "<hr style='opacity: .4;'>";


        $email_data['subject'] = 'Webinar Register';
        $email_data['from'] = get_settings('system_email');
        $email_data['to'] = $user_email;
        $email_data['to_name'] = $student_details['name'];
        $email_data['message'] = $email_msg;
        $email_template = $this->load->view('email/common_template', $email_data, TRUE);

        $this->leadofy_mail_api('YjMxNTQ4MDA3Yzk5MTI3MDkxY2M5YTEwYmNhYzhhNTY=', $email_data['subject'], $email_data['to'], '1', $email_template, '#', "Ekon Academy", $email_data['from']);

    }
    public function webinar_thank_mail($user_email, $webinar_id)
    {
        $email_msg .= "<hr style='opacity: .4;'>";
        $email_msg .= 'Hi <b>' . $student_details['name'] . '</b> ,<br>
                       Your can join this webinar by belwo link. <br>';
        $email_msg .= "<hr style='opacity: .4;'>";
        $email_data['subject'] = 'Thank Webinar Join';
        $email_data['from'] = get_settings('system_email');
        $email_data['to'] = $user_email;
        $email_data['to_name'] = $student_details['name'];
        $email_data['message'] = $email_msg;
        $email_template = $this->load->view('email/common_template', $email_data, TRUE);

        $this->leadofy_mail_api('YjMxNTQ4MDA3Yzk5MTI3MDkxY2M5YTEwYmNhYzhhNTY=', $email_data['subject'], $email_data['to'], '1', $email_template, '#', "Ekon Academy", $email_data['from']);

    }
    public function webinar_Reminder_mail($user_email, $webinar_id)
    {
   
        $email_msg = '';
        $student_details = $this->db->get_where('ck_webinar_register', ['email' => $user_email, 'webinar_id' => $webinar_id])->row_array();
        $webinar_details = $this->db->get_where('ck_webinar', ['id' => $webinar_id])->row_array();
        // print_r($student_details);
        // die;

        $email_msg .= "<hr style='opacity: .4;'>";
        $email_msg .= 'Hi <b>' . $student_details['name'] . '</b> ,<br>
                       Your can join this webinar by belwo link. <br>
                       <a target="_blank" href="' . $webinar_details['Joinee_link'] . '">
                              ' . $webinar_details['Joinee_link'] . '
                        </a>';

        $email_msg .= "<hr style='opacity: .4;'>";


        $email_data['subject'] = 'Webinar Reminder';
        $email_data['from'] = get_settings('system_email');
        $email_data['to'] = $user_email;
        $email_data['to_name'] = $student_details['name'];
        $email_data['message'] = $email_msg;
        $email_template = $this->load->view('email/common_template', $email_data, TRUE);

        $this->leadofy_mail_api('YjMxNTQ4MDA3Yzk5MTI3MDkxY2M5YTEwYmNhYzhhNTY=', $email_data['subject'], $email_data['to'], '1', $email_template, '#', "Ekon Academy", $email_data['from']);

    }
}
