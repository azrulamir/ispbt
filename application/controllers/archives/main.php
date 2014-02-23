<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		$this->template->load('header');
		$this->load->view('archives/view_archives_main');
		$this->template->load('footer');
	}
	
}
