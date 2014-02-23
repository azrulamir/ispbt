<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		$this->load->database();
		$this->load->view('books-checkout/view_signout_main');
	}
	
}
