<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */


if ( ! function_exists('get_user_role'))
{
	function get_user_role($type = "", $user_id = '') {
		$CI	=&	get_instance();
		$CI->load->database();

        $role_id	=	$CI->db->get_where('users' , array('id' => $user_id))->row()->role_id;
        $user_role	=	$CI->db->get_where('role' , array('id' => $role_id))->row()->name;

        if ($type == "user_role") {
            return $user_role;
        }else {
            return $role_id;
        }
	}
}


if ( ! function_exists('is_purchased'))
{
	function is_purchased($course_id = "") {
		$CI	=&	get_instance();
		$CI->load->library('session');
		$CI->load->database();
		if ($CI->session->userdata('user_login')) {
			$enrolled_history = $CI->db->get_where('enrol' , array('user_id' => $CI->session->userdata('user_id'), 'course_id' => $course_id))->num_rows();
			if ($enrolled_history > 0 && is_access_allowed($course_id,$CI->session->userdata('user_id'))) {
				return true;
			}else {
				return false;
			}
		}else {
			return false;
		}
	}
}

if( ! function_exists('is_access_allowed'))
{
	function is_access_allowed($course,$user){
		$CI	=&	get_instance();
		$CI->load->library('session');
		$CI->load->database();
		$CI->load->model('crud_model');
		$course_data = $CI->crud_model->get_course_by_id($course)->row_array();
		$enrolled_history = $CI->db->get_where('enrol' , array('user_id' => $user, 'course_id' => $course))->row_array();
		$package = $CI->db->get_where('packages' , array('id' => $enrolled_history['access_type']))->row_array();
	    $last_date = date('Y-m-d',$enrolled_history['date_added']);
		$current_date = date('Y-m-d');

		$date_diff = strtotime($current_date) -  strtotime($last_date) ;
		$nominal_diff = strtotime($package['duration'] . " " . $package['duration_unit'],0);
		$time_good = $date_diff < $nominal_diff;
		if($course_data['is_free_course'] == 1 || $enrolled_history['started'] != 1 || $time_good){
			return true;
		}
		
		else return false;
	}
}

function get_package_price($package,$course_price){
	$CI	=&	get_instance();
	$CI->load->database();
	$package = $CI->db->get_where('packages' , array('id' => $package))->row_array();
	if($package['price'] == 0){
		return 0;
	}
	return $package['price'] - $course_price;
}

// ------------------------------------------------------------------------
/* End of file user_helper.php */
/* Location: ./system/helpers/user_helper.php */
