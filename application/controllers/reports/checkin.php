<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkin extends CI_Controller {

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
		
		$this->load->view('reports/checkin/view_report_main', $data);
		$this->template->load('footer');
	}
	
	public function classes($year, $classInd)
	{
		
		$this->template->load('header');
		
		$query = $this->db->query("SELECT * FROM ispbt_students LEFT JOIN ispbt_checkin ON is_students_ind = is_checkin_loaner WHERE is_students_year = '$year' AND is_students_class = $classInd");
		$checkInDetails = $query->result();
		
		$query = $this->db->query("SELECT * FROM ispbt_books WHERE is_books_year = '$year' ORDER BY is_books_ind");
		$booksDetails = $query->result();
		
		$query = $this->db->query("SELECT SUM(is_checkin_bookstotal) As bookstotal FROM ispbt_checkin INNER JOIN ispbt_students ON is_checkin_loaner = is_students_ind WHERE is_students_year = '$year' AND is_students_class = $classInd");
		$totalOutEntry = $query->row();
		
		if ($totalOutEntry->bookstotal == "")
		{
			$totalOutEntry = 0;
		}
		else
		{
			$totalOutEntry = $totalOutEntry->bookstotal;
		}

		$query = $this->db->query("SELECT is_checkin_loaner FROM ispbt_checkin INNER JOIN ispbt_students ON is_checkin_loaner = is_students_ind WHERE is_students_year = '$year' AND is_students_class = '$classInd'");
		$totalLoaner = $query->num_rows();
		
		$this->load->model('Mod_basedetails');
		$yearTitle = $this->Mod_basedetails->get('year_title', $year);
		$className = $this->Mod_basedetails->get('class_title', $classInd);
			
		$data = array(
			'yeardigit' => $year,
			'yeartitle' => $yearTitle,
			'classname' => $className,
			'classind' => $classInd,
			'checkindetails' => $checkInDetails,
			'booksdetails' => $booksDetails,
			'totaloutentry' => $totalOutEntry,
			'totalloaner' => $totalLoaner
		);
		$this->load->view('reports/checkin/view_report_class', $data);
		
		$this->template->load('footer');
		
	}
	
	public function printprev($year, $classInd)
	{
		
		$this->template->load('printprev');
		
		$query = $this->db->query("SELECT * FROM ispbt_students LEFT JOIN ispbt_checkin ON is_students_ind = is_checkin_loaner WHERE is_students_year = '$year' AND is_students_class = $classInd");
		$checkoutDetails = $query->result();
		
		$query = $this->db->query("SELECT * FROM ispbt_books WHERE is_books_year = '$year' ORDER BY is_books_ind");
		$booksDetails = $query->result();
		
		$query = $this->db->query("SELECT SUM(is_checkin_bookstotal) As bookstotal FROM ispbt_checkin INNER JOIN ispbt_students ON is_checkin_loaner = is_students_ind WHERE is_students_year = '$year' AND is_students_class = $classInd");
		$totalInEntry = $query->row();
		
		$query = $this->db->query("SELECT is_checkin_loaner FROM ispbt_checkin INNER JOIN ispbt_students ON is_checkin_loaner = is_students_ind WHERE is_students_year = '$year' AND is_students_class = '$classInd'");
		$totalLoaner = $query->num_rows();
		
		$this->load->model('Mod_basedetails');
		$yearTitle = $this->Mod_basedetails->get('year_title', $year);
		$className = $this->Mod_basedetails->get('class_title', $classInd);
		
		$data = array(
			'yeardigit' => $year,
			'yeartitle' => $yearTitle,
			'classname' => $className,
			'checkindetails' => $checkoutDetails,
			'booksdetails' => $booksDetails,
			'totaloutentry' => $totalInEntry,
			'totalloaner' => $totalLoaner
		);
		$this->load->view('reports/checkin/view_report_printprev', $data);
	}
	
	function reportsummary()
	{
		$ajaxModal = $this->ajax->load();
		
		$this->template->load('header');		
		$data = array(
			
		);
		$this->load->view('books/checkout/view_checkout_details', $data);
	}
	
}
