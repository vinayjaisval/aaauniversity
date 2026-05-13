<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lazyloaddata_model extends CI_Model
{

  // constructor
  function __construct()
  {
    parent::__construct();
  }

  // Servre side testing
  function courses($limit, $start, $col, $dir, $filter_data)
  {
    $this->db->limit($limit, $start);
    $this->db->order_by($col, $dir);

    // apply the filter data
    // check if the user is admin. Admin can not see the draft courses
    if (strtolower($this->session->userdata('role')) == 'admin') {
      $this->db->where("status !=", 'draft');
    }
    if ($filter_data['selected_category_id'] != 'all') {
      $this->db->where('sub_category_id', $filter_data['selected_category_id']);
    }
    if ($filter_data['selected_instructor_id'] != "all") {
      //      $this->db->where('user_id', $filter_data['selected_instructor_id']);

      /*************  Chanchal Code **************/
      $this->db->where("user_id LIKE '%" . $filter_data['selected_instructor_id'] . "%'");
    }
    if ($filter_data['selected_price'] != "all") {
      if ($filter_data['selected_price'] == "paid") {
        $this->db->where('is_free_course', null);
      } elseif ($filter_data['selected_price'] == "free") {
        $this->db->where('is_free_course', 1);
      }
    }
    if ($filter_data['selected_status'] != "all") {
      $this->db->where('status', $filter_data['selected_status']);
    }
    $query = $this->db->get('course');
    if ($query->num_rows() > 0)
      return $query->result();
    else
      return null;
  }

  function course_search($limit, $start, $search, $col, $dir, $filter_data)
  {
    $this->db->like('title', $search);
    $this->db->limit($limit, $start);
    $this->db->order_by($col, $dir);
    // apply the filter data
    // check if the user is admin. Admin can not see the draft courses
    if (strtolower($this->session->userdata('role')) == 'admin') {
      $this->db->where("status !=", 'draft');
    }
    if ($filter_data['selected_category_id'] != 'all') {
      $this->db->where('sub_category_id', $filter_data['selected_category_id']);
    }
    if ($filter_data['selected_instructor_id'] != "all") {
      //      $this->db->where('user_id', $filter_data['selected_instructor_id']);

      /*************  Chanchal Code **************/
      $this->db->where("user_id LIKE '%" . $filter_data['selected_instructor_id'] . "%'");
    }
    if ($filter_data['selected_price'] != "all") {
      if ($filter_data['selected_price'] == "paid") {
        $this->db->where('is_free_course', null);
      } elseif ($filter_data['selected_price'] == "free") {
        $this->db->where('is_free_course', 1);
      }
    }
    if ($filter_data['selected_status'] != "all") {
      $this->db->where('status', $filter_data['selected_status']);
    }

    $query = $this->db->get('course');
    if ($query->num_rows() > 0)
      return $query->result();
    else
      return null;
  }

  function course_search_count($search)
  {
    $query = $this
      ->db
      ->like('title', $search)
      ->get('course');

    return $query->num_rows();
  }

  function count_all_courses($filter_data = array())
  {
    // apply the filter data
    // check if the user is admin. Admin can not see the draft courses
    if (strtolower($this->session->userdata('role')) == 'admin') {
      $this->db->where("status !=", 'draft');
    }
    if ($filter_data['selected_category_id'] != 'all') {
      $this->db->where('sub_category_id', $filter_data['selected_category_id']);
    }

    if ($filter_data['selected_instructor_id'] != "all") {
      //      $this->db->where('user_id', $filter_data['selected_instructor_id']);

      /*************  Chanchal Code **************/

      $this->db->where("user_id LIKE '%" . $filter_data['selected_instructor_id'] . "%'");
    }
    if ($filter_data['selected_price'] != "all") {
      if ($filter_data['selected_price'] == "paid") {
        $this->db->where('is_free_course', null);
      } elseif ($filter_data['selected_price'] == "free") {
        $this->db->where('is_free_course', 1);
      }
    }
    if ($filter_data['selected_status'] != "all") {
      $this->db->where('status', $filter_data['selected_status']);
    }
    $query = $this->db->get('course');
    return $query->num_rows();
  }







  /*--------------------------- Attendance Total Time By chanchal Kumar-------------------------- */

  public function time_in_hours($start_time, $end_time)
  {

    $time1 = explode(':', $start_time);
    $time2 = explode(':', $end_time);

    $hours1 = $time1[0];
    $hours2 = $time2[0];
    $mins1 = $time1[1];
    $mins2 = $time2[1];
    $hours = $hours2 - $hours1;
    $mins = 0;
    if ($hours < 0) {
      $hours = 24 + $hours;
    }
    if ($mins2 >= $mins1) {
      $mins = $mins2 - $mins1;
    } else {
      $mins = ($mins2 + 60) - $mins1;
      $hours--;
    }
    if ($mins < 9) {
      $mins = str_pad($mins, 2, '0', STR_PAD_LEFT);
    }
    if ($hours < 9) {
      $hours = str_pad($hours, 2, '0', STR_PAD_LEFT);
    }
    return  $hours . ' hours ,' . $mins . ' minutes';
  }


  public function total_data($start_time, $end_time)
  {

    $time1 = explode(':', $start_time);
    $time2 = explode(':', $end_time);

    $hours1 = $time1[0];
    $hours2 = $time2[0];
    $mins1 = $time1[1];
    $mins2 = $time2[1];
    $hours = $hours2 - $hours1;
    $mins = 0;
    if ($hours < 0) {
      $hours = 24 + $hours;
    }

    if ($mins2 >= $mins1) {
      $mins = $mins2 - $mins1;
    } else {
      $mins = ($mins2 + 60) - $mins1;
      $hours--;
    }


    if ($mins < 9) {
      $mins = str_pad($mins, 2, '0', STR_PAD_LEFT);
    }
    if ($hours < 9) {
      $hours = str_pad($hours, 2, '0', STR_PAD_LEFT);
    }

    return array(
      "hours" => $hours,
      "min" => $mins
    );
  }

  public function thousand_upper_number_change_in_k($param){
      if ($param > 999999) {
          $data = floatval($param / 1000000)."/ M";
      }
      elseif ($param > 999) {
          $data = floatval($param / 1000)."/ K";
      }
      else{
         $data =  $param."/ +";
      }
      return $data;

  }





  /*--------------------------- Attendance Total Time By chanchal Kumar End-------------------------- */
}
