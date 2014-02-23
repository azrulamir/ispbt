<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkout extends CI_Controller {

	public function index()
	{
		
		$query = $this->db->query("SELECT * FROM ispbt_years");
		$result = $query->result();
		
		$yearsList = $result;
		
		$query = $this->db->query("SELECT * FROM ispbt_class");
		$result = $query->result();
		
		$classList = $result;
		
		$ajaxModal = $this->ajax->load();
		
		$this->load->model('Mod_basedetails');
		$totalClassArray = $this->Mod_basedetails->get('all_class_students_total', '');
		
		$this->template->load('header');	
		$data = array(
			'yearslist' => $yearsList,
			'classlist' => $classList,
			'totalstudents' => $totalClassArray,
			'ajaxmodal' => $ajaxModal
		);
		$this->load->view('books/checkout/view_checkout', $data);
		$this->template->load('footer');
		
	}
	
	function check($type, $year, $classInd)
	{
						
		if ($type == 'classtotal')
		{		
		
			$query = $this->db->query("SELECT * FROM ispbt_students LEFT JOIN ispbt_checkout ON is_students_ind = is_checkout_loaner LEFT JOIN ispbt_status ON is_checkout_stat = is_stat_ind INNER JOIN ispbt_class ON is_students_class = is_class_ind INNER JOIN ispbt_years ON is_students_year = is_years_digit WHERE is_students_year = $year AND is_class_ind = '$classInd' ORDER BY is_students_name ASC");
		
				$classItems = $query->result();
				$classDetails = $query->row();
				
			if (sizeof($classDetails) <= 0)
			{				
				$additionalvalue = site_url('profiles/students');
				$data = array(
					'errordetail' => "Maklumat pelajar tidak wujud dalam sistem!! Anda boleh mendaftar pelajar baru di <a href=\"$additionalvalue\">sini</a>.",
					'alert' => 'no'
				);
				$this->load->view('view_error', $data);
			}
			else
			{
				$url = site_url('books/checkout/classes/' . $year . '/' . $classInd);
				echo "<script type=\"text/javascript\">window.location = \"$url\"";
			}
		}
	}
	
	function classes($year, $classInd)
	{
		
		$query = $this->db->query("SELECT * FROM ispbt_students LEFT JOIN ispbt_checkout ON is_students_ind = is_checkout_loaner LEFT JOIN ispbt_status ON is_checkout_stat = is_stat_ind INNER JOIN ispbt_class ON is_students_class = is_class_ind INNER JOIN ispbt_years ON is_students_year = is_years_digit WHERE is_students_year = $year AND is_class_ind = '$classInd' ORDER BY is_students_name ASC");
		
		$classItems = $query->result();
		$classDetails = $query->row();
		
		$ajaxModal = $this->ajax->load();
		
		if (sizeof($classDetails) <= 0)
		{			
			$additionalvalue = site_url('profiles/students');
			$data = array(
				'errordetail' => "Maklumat pelajar tidak wujud dalam sistem!! Anda boleh mendaftar pelajar baru di <a href=\"$additionalvalue\">sini</a>.",
				'alert' => 'no',
				'ajaxmodal' => $ajaxModal
			);
			$this->load->view('view_error', $data);
		}
		else
		{			
			$query = $this->db->query("SELECT is_class_title FROM ispbt_class WHERE is_class_ind = $classInd");
			$result = $query->row();
		
			$classname = $result->is_class_title;
			
			$this->load->model('Mod_basedetails');
			
			$this->template->load('header');
			$data = array(
				'students' => $classItems,
				'classdetail' => $classDetails,
				'ajaxmodal' => $ajaxModal
			);
			$this->load->view('books/checkout/view_checkout_class', $data);
			$this->template->load('footer');
		}
		
	}
	
	function studentid($id)
	{
		
		$query = $this->db->query("SELECT * FROM ispbt_students LEFT JOIN ispbt_checkout ON is_students_ind = is_checkout_loaner LEFT JOIN ispbt_checkin ON is_students_ind = is_checkin_loaner INNER JOIN ispbt_class ON is_students_class = is_class_ind INNER JOIN ispbt_race ON is_students_race = is_race_ind INNER JOIN ispbt_religion ON is_students_religion = is_religion_ind INNER JOIN ispbt_gender ON is_students_gender = is_gender_ind INNER JOIN ispbt_orphan ON is_students_orphan = is_orphan_ind WHERE is_students_ind = $id");
			
		$studentDetail = $query->row();
		$studentYear = $studentDetail->is_students_year;
		$checkoutID = $studentDetail->is_checkout_checkoutid;
	
		$query = $this->db->query("SELECT * FROM ispbt_books WHERE is_books_year = $studentYear ORDER BY is_books_title ASC");
		$booksDetail = $query->result_array();
		
		$inLoanedBooks = explode(",", $studentDetail->is_checkin_books);
		$outLoanedBooks = explode(",", $studentDetail->is_checkout_books);
		$damagedBooks = explode(",", $studentDetail->is_checkout_damage);
	
		$statusArray = $statusArray = $this->Mod_getoptionlist->load('status');
		
		if ($studentDetail->is_checkout_loaner != NULL)
		{
			$inserted = 'yes';
			$status = $studentDetail->is_checkout_stat;
			$remark = $studentDetail->is_checkout_remark;
		}
		else
		{
			$inserted = 'no';
			$status = "";
			$remark = "";
		}			
				
		$ajaxModal = $this->ajax->load();
		
		$this->template->load('header');		
		$data = array(
			'student' => $studentDetail,
			'books' => $booksDetail,
			'inloanedbooks' => $inLoanedBooks,
			'outloanedbooks' => $outLoanedBooks,
			'damagedbooks' => $damagedBooks,
			'checkoutid' => $checkoutID,
			'statusarray' => $statusArray,
			'status' => $status,
			'remark' => $remark,
			'inserted' => $inserted,
			'ajaxmodal' => $ajaxModal
		);
		$this->load->view('books/checkout/view_checkout_details', $data);
		$this->template->load('footer');
	}
	
	function process()
	{
	
		$loaner = $_POST['studentid'];
		
		$query = $this->db->query("SELECT * FROM ispbt_checkin WHERE is_checkin_loaner = '$loaner'");
		$checkoutData = $query->num_rows();

		date_default_timezone_set('Asia/Kuala_Lumpur');
		$checkoutDate = date('Y-m-d', time());
		$checkoutTime = date('G:i:s', time());

		$booksArray = array();
		foreach($_POST as $booksData => $value)
		{
			$exBooksData = explode("-", $booksData);
							
			if (($booksData != 'studentid') && ($booksData != 'status') && ($booksData != 'remark') && ($booksData != 'inserted') && ($exBooksData['0'] != 'damagebooks'))
			{
				$booksArray[] = $value;
			}
		}
				
		$books = implode(",", $booksArray);
		$booksTotal = sizeof($booksArray);
		
		$damageBooksArray = array();
		foreach($_POST as $damageBooksData => $value)
		{
			$exBooksData = explode("-", $damageBooksData);
			
			if (($damageBooksData != 'studentid') && ($damageBooksData != 'status') && ($damageBooksData != 'remark') && ($damageBooksData != 'inserted') && ($exBooksData['0'] != 'books'))
			{
				$damageBooksArray[] = $value;
			}
		}
		
		$damageBooks = implode(",", $damageBooksArray);
		$damageBooksTotal = sizeof($damageBooksArray);
		
		$collector = 1;
		$checkoutID = uniqid('is');
	
		$checkoutStat = $_POST['status'];
		$checkoutRemark = $_POST['remark'];
	
		$query = $this->db->query("SELECT * FROM ispbt_students INNER JOIN ispbt_class ON is_students_class = is_class_ind WHERE is_students_ind = '$loaner'");
	
		$classArray = $query->row();
	
		$classYear = $classArray->is_students_year;
		$classInd = $classArray->is_class_ind;
	
		if ($_POST['inserted'] == "yes")
		{
			
			$query = $this->db->query("SELECT is_checkout_books FROM ispbt_checkout WHERE is_checkout_loaner = '$loaner'");
			$result = $query->row();
			$currentBooks = explode(',', $result->is_checkout_books);
		
			$query = $this->db->query("SELECT * FROM ispbt_books WHERE is_books_year = '$classYear'");
			$allYearBooks = $query->result();
			
			$this->load->model('Mod_updatebooks');
			$this->Mod_updatebooks->outstocks($currentBooks, $allYearBooks, $booksArray);
							
			$this->db->query("UPDATE ispbt_checkout SET is_checkout_date = '$checkoutDate', is_checkout_time = '$checkoutTime', is_checkout_books = '$books', is_checkout_damage = '$damageBooks', is_checkout_collector = '$collector', is_checkout_bookstotal = '$booksTotal', is_checkout_damagestotal = '$damageBooksTotal', is_checkout_stat = '$checkoutStat', is_checkout_remark = '$checkoutRemark' WHERE is_checkout_loaner = '$loaner'");
					
		}
		else
		{
			foreach ($booksArray as $value)
			{
				$query = $this->db->query("SELECT * FROM ispbt_books WHERE is_books_ind = $value");
				$stocks = $query->row();
			
				$BooksInd = $stocks->is_books_ind;
				$BooksStocksIn = $stocks->is_books_instocks;
				$BooksStocksOut = $stocks->is_books_outstocks;
		
				if ($BooksStocksIn <= 1)
				{
					$stocksInTotal = 0;
				}
				else
				{
					$stocksInTotal = $BooksStocksIn - 1;
				}
				$this->db->query("UPDATE ispbt_books SET is_books_instocks = '$stocksInTotal' WHERE is_books_ind = '$value'");
				$stocksOutTotal = $BooksStocksOut + 1;
				$this->db->query("UPDATE ispbt_books SET is_books_outstocks = '$stocksOutTotal' WHERE is_books_ind = '$value'");
			
			}
		
			$this->db->query("INSERT INTO ispbt_checkout (is_checkout_ind, is_checkout_date, is_checkout_time, is_checkout_books, is_checkout_damage, is_checkout_checkoutid, is_checkout_loaner, is_checkout_collector, is_checkout_bookstotal, is_checkout_damagestotal, is_checkout_stat, is_checkout_remark) VALUES ('', '$checkoutDate', '$checkoutTime', '$books', '$damageBooks', '$checkoutID', '$loaner', '$collector', '$booksTotal', '$damageBooksTotal', '$checkoutStat', '$checkoutRemark')");
		}
	
		redirect('books/checkout/classes/' . $classYear . "/" . $classInd, 'refresh');
	}
	
	function confirm($type, $studentid, $formsubmit)
	{
		
		$query = $this->db->query("SELECT is_students_name FROM ispbt_students WHERE is_students_ind = '$studentid'");
		$studentsdetail = $query->row();
			
		if ($type == 'remove')
		{
			$actionurl = site_url('books/checkout/remove/' . $studentid);
			$additionalvalue = $studentsdetail->is_students_name;
			$data = array(
				'confirmquestion' => 'Adakah anda pasti untuk menghapuskan daftar rekod transaksi penyerahan pelajar ini?',
				'additionalvalue' => $additionalvalue,
				'proceedvalue' => 'Ya, sila hapuskan!!',
				'abortvalue' => 'Batal!!',
				'alert' => 'yes',
				'submitform' => $formsubmit
			);
			$this->load->view('view_confirm', $data);
		}
		else if ($type == 'edit')
		{
			
			$query = $this->db->query("SELECT * FROM ispbt_checkin WHERE is_checkin_loaner = '$studentid'");
			$result = $query->num_rows();
			
			if ($result > 0)
			{
				$actionurl = site_url('books/checkout/edit/' . $studentid);
				$additionalvalue = $studentsdetail->is_students_name;
				$data = array(
					'confirmquestion' => 'Proses pemulangan telah bermula. Adakah anda pasti untuk megubahsuai daftar rekod transaksi penyerahan pelajar ini?',
					'additionalvalue' => $additionalvalue,
					'proceedvalue' => 'Ya, sila teruskan!!',
					'abortvalue' => 'Batal!!',
					'alert' => 'no',
					'submitform' => $formsubmit
				);
				$this->load->view('view_confirm', $data);
			}
			else
			{
				echo "
				<script type=\"text/javascript\">
					$('#$formsubmit').submit();
				</script>
				";
			}
		}
	}
	
	function remove($studentid)
	{
		$query = $this->db->query("SELECT * FROM ispbt_students WHERE is_students_ind = '$studentid'");
		$studentsdetail = $query->row();
		
		$year = $studentsdetail->is_students_year;
		$class = $studentsdetail->is_students_class;
		
		$this->db->query("DELETE FROM ispbt_checkout WHERE is_checkout_loaner = '$studentid'");
		$this->db->query("DELETE FROM ispbt_checkin WHERE is_checkin_loaner = '$studentid'");
		
		redirect('books/checkout/classes/' . $year . '/' . $class, 'refresh');
	}
	
	function edit($studentid)
	{
		$query = $this->db->query("SELECT * FROM ispbt_students WHERE is_students_ind = '$studentid'");
		$studentsdetail = $query->row();
	}
	
	function studentinfo($id)
	{
		$query = $this->db->query("SELECT * FROM ispbt_students LEFT JOIN ispbt_checkout ON is_students_ind = is_checkout_loaner LEFT JOIN ispbt_checkin ON is_students_ind = is_checkin_loaner INNER JOIN ispbt_class ON is_students_class = is_class_ind INNER JOIN ispbt_race ON is_students_race = is_race_ind INNER JOIN ispbt_religion ON is_students_religion = is_religion_ind INNER JOIN ispbt_gender ON is_students_gender = is_gender_ind INNER JOIN ispbt_orphan ON is_students_orphan = is_orphan_ind WHERE is_students_ind = $id");
			
		$studentDetail = $query->row();
		$data = array(
			'student' => $studentDetail
		);
		$this->load->view('books/view_students_info', $data);
	}
	
}
