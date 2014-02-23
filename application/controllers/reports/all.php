<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class All extends CI_Controller {

	public function index()
	{
		$this->template->load('header');
		$this->load->view('reports/all/view_main');
		$this->template->load('footer');
	}
	
}
