<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkout extends CI_Controller {

	public function index()
	{
		$this->template->load('header');
		
		$query = $this->db->query("SELECT * FROM ispbt_years");
		$result = $query->result();
		
		$yearsList = $result;
		
		$query = $this->db->query("SELECT * FROM ispbt_class");
		$result = $query->result();
		
		$classList = $result;
		
		$this->load->model('Mod_basedetails');
		$totalClassArray = $this->Mod_basedetails->get('all_class_students_total', '');
				
		$data = array(
			'yearslist' => $yearsList,
			'classlist' => $classList,
			'totalstudents' => $totalClassArray
		);
		
		$this->load->view('reports/checkout/view_report_main', $data);
		$this->template->load('footer');
	}
	
	public function classes($year, $classInd)
	{
		
		$this->template->load('header');
		
		$query = $this->db->query("SELECT * FROM ispbt_students LEFT JOIN ispbt_checkout ON is_students_ind = is_checkout_loaner WHERE is_students_year = '$year' AND is_students_class = $classInd");
		$checkoutDetails = $query->result();
		
		$query = $this->db->query("SELECT * FROM ispbt_books WHERE is_books_year = '$year' ORDER BY is_books_ind");
		$booksDetails = $query->result();
		
		$query = $this->db->query("SELECT SUM(is_checkout_bookstotal) As bookstotal FROM ispbt_checkout INNER JOIN ispbt_students ON is_checkout_loaner = is_students_ind WHERE is_students_year = '$year' AND is_students_class = $classInd");
		$totalOutEntry = $query->row();
		
		if ($totalOutEntry->bookstotal == "")
		{
			$totalOutEntry = 0;
		}
		else
		{
			$totalOutEntry = $totalOutEntry->bookstotal;
		}

		$query = $this->db->query("SELECT is_checkout_loaner FROM ispbt_checkout INNER JOIN ispbt_students ON is_checkout_loaner = is_students_ind WHERE is_students_year = '$year' AND is_students_class = '$classInd'");
		$totalLoaner = $query->num_rows();
		
		$this->load->model('Mod_basedetails');
		$yearTitle = $this->Mod_basedetails->get('year_title', $year);
		$className = $this->Mod_basedetails->get('class_title', $classInd);
		
		$query = $this->db->query("SELECT * FROM ispbt_checkout");
		
		$ajaxModal = $this->ajax->load();
		
		$data = array(
			'yeardigit' => $year,
			'yeartitle' => $yearTitle,
			'classname' => $className,
			'classind' => $classInd,
			'checkoutdetails' => $checkoutDetails,
			'booksdetails' => $booksDetails,
			'totaloutentry' => $totalOutEntry,
			'totalloaner' => $totalLoaner,
			'ajaxmodal' => $ajaxModal
		);
		$this->load->view('reports/checkout/view_report_class', $data);
		
		$this->template->load('footer');
		
	}
	
	public function printprev($year, $classInd)
	{
		
		$this->template->load('printprev');
		
		$query = $this->db->query("SELECT * FROM ispbt_students LEFT JOIN ispbt_checkout ON is_students_ind = is_checkout_loaner WHERE is_students_year = '$year' AND is_students_class = $classInd");
		$checkoutDetails = $query->result();
		
		$query = $this->db->query("SELECT * FROM ispbt_books WHERE is_books_year = '$year' ORDER BY is_books_ind");
		$booksDetails = $query->result();
		
		$query = $this->db->query("SELECT SUM(is_checkout_bookstotal) As bookstotal FROM ispbt_checkout INNER JOIN ispbt_students ON is_checkout_loaner = is_students_ind WHERE is_students_year = '$year' AND is_students_class = $classInd");
		$totalOutEntry = $query->row();
		
		$query = $this->db->query("SELECT is_checkout_loaner FROM ispbt_checkout INNER JOIN ispbt_students ON is_checkout_loaner = is_students_ind WHERE is_students_year = '$year' AND is_students_class = '$classInd'");
		$totalLoaner = $query->num_rows();
		
		$this->load->model('Mod_basedetails');
		$yearTitle = $this->Mod_basedetails->get('year_title', $year);
		$className = $this->Mod_basedetails->get('class_title', $classInd);
		
		$query = $this->db->query("SELECT * FROM ispbt_checkout");
		
		$data = array(
			'yeardigit' => $year,
			'yeartitle' => $yearTitle,
			'classname' => $className,
			'checkoutdetails' => $checkoutDetails,
			'booksdetails' => $booksDetails,
			'totaloutentry' => $totalOutEntry,
			'totalloaner' => $totalLoaner
		);
		$this->load->view('reports/checkout/view_report_printprev', $data);
	}
	
	function reportsummary()
	{
	
		
			
		$data = array(
			
		);
		$this->load->view('reports/view_summary_report', $data);
		
	}
}
