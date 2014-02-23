<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template {
	
	function load($type)
	{
		$CI =& get_instance();
		$CI->load->view('templates/' . $type);
	}
	
}
