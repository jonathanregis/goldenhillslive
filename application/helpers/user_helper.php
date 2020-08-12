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
		$enrolled_history = $CI->db->get_where('enrol' , array('user_id' => $user, 'course_id' => $course))->row_array();
		$valid = false;
		if($CI->session->userdata("lesson_started") == $course ) return true;
		if($enrolled_history['access_type'] == 1){
			$valid = $enrolled_history['date_added'] > time() - (84 * 86400);
		}
		if($enrolled_history['access_type'] == 0){
			$valid = $enrolled_history['date_added'] > time() - 86400;
		}
		if($enrolled_history['access_type'] < 0){
			$valid = false;
		}
		return $valid;
	}
}

// ------------------------------------------------------------------------
/* End of file user_helper.php */
/* Location: ./system/helpers/user_helper.php */
