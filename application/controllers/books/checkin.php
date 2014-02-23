<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkin extends CI_Controller {

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
		$this->load->view('books/checkin/view_checkin', $data);
		$this->template->load('footer');
		
	}
	
	function check($type, $year, $classInd, $studentInd)
	{	
	
		if ($type == 'classtotal')
		{
			$query = $this->db->query("SELECT * FROM ispbt_students LEFT JOIN ispbt_checkin ON is_students_ind = is_checkin_loaner LEFT JOIN ispbt_status ON is_checkin_stat = is_stat_ind LEFT JOIN ispbt_checkout ON is_students_ind = is_checkout_loaner INNER JOIN ispbt_class ON is_students_class = is_class_ind INNER JOIN ispbt_years ON is_students_year = is_years_digit WHERE is_students_year = $year AND is_class_ind = '$classInd' ORDER BY is_students_name ASC");
		
			$classItems = $query->result();
			$classDetails = $query->row();
		
			$ajaxModal = $this->ajax->load();
			
			if (sizeof($classDetails) <= 0)
			{
				$data = array(
					'errordetail' => 'Maklumat pinjaman tidak wujud dalam sistem!!'
				);
				$this->load->view('view_error', $data);
			}
			else
			{
				$url = site_url('books/checkin/classes/' . $year . '/' . $classInd);
				echo "<script type=\"text/javascript\">window.location = \"$url\"";
			}
		}
		else if ($type == 'record')
		{
			$query = $this->db->query("SELECT * FROM ispbt_checkout WHERE is_checkout_loaner = '$studentInd'");
			$studentrecord = $query->row();
			
			if (sizeof($studentrecord) <= 0)
			{
				$data = array(
					'errordetail' => 'Maklumat pinjaman tidak wujud dalam sistem!!'
				);
				$this->load->view('view_error', $data);
			}
			else
			{
				$url = site_url('books/checkin/studentid/' . $studentInd);
				echo "<script type=\"text/javascript\">window.location = \"$url\"";
			}
		}
	}
	
	public function classes($year, $classInd)
	{
		
		$query = $this->db->query("SELECT * FROM ispbt_students LEFT JOIN ispbt_checkin ON is_students_ind = is_checkin_loaner LEFT JOIN ispbt_status ON is_checkin_stat = is_stat_ind LEFT JOIN ispbt_checkout ON is_students_ind = is_checkout_loaner INNER JOIN ispbt_class ON is_students_class = is_class_ind INNER JOIN ispbt_years ON is_students_year = is_years_digit WHERE is_students_year = $year AND is_class_ind = '$classInd' ORDER BY is_students_name ASC");
		
		$classItems = $query->result();
		$classDetails = $query->row();
		
		$ajaxModal = $this->ajax->load();
		
		if (sizeof($classDetails) <= 0)
		{
			$data = array(
				'errordetail' => 'Maklumat pinjaman tidak wujud dalam sistem!!',
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
			$this->load->view('books/checkin/view_checkin_class', $data);
			$this->template->load('footer');
		}
		
	}
	
	public function studentid($id)
	{
		
		$query = $this->db->query("SELECT * FROM ispbt_students LEFT JOIN ispbt_checkin ON is_students_ind = is_checkin_loaner RIGHT JOIN ispbt_checkout ON is_students_ind = is_checkout_loaner INNER JOIN ispbt_class ON is_students_class = is_class_ind INNER JOIN ispbt_race ON is_students_race = is_race_ind INNER JOIN ispbt_religion ON is_students_religion = is_religion_ind INNER JOIN ispbt_gender ON is_students_gender = is_gender_ind INNER JOIN ispbt_orphan ON is_students_orphan = is_orphan_ind WHERE is_students_ind = $id");
			
		if ($query->num_rows() == 0)
		{
			$data = array(
				'errordetail' => 'Data pengeluaran buku masih tidak wujud dalam sistem!!'
			);
			$this->load->view('view_error', $data);
		}
		else
		{
			$studentDetail = $query->row();
			$studentYear = $studentDetail->is_students_year;
			$checkoutID = $studentDetail->is_checkout_checkoutid;
		
			$query = $this->db->query("SELECT * FROM ispbt_books WHERE is_books_year = $studentYear ORDER BY is_books_title ASC");
			$booksDetail = $query->result_array();
		
			$inLoanedBooks = explode(",", $studentDetail->is_checkin_books);
			$outLoanedBooks = explode(",", $studentDetail->is_checkout_books);
			
			$inDamagedBooks = explode(",", $studentDetail->is_checkin_damage);
			$outDamagedBooks = explode(",", $studentDetail->is_checkout_damage);
		
			$statusArray = $this->Mod_getoptionlist->load('status');

			if ($studentDetail->is_checkin_stat != NULL)
			{
				$inserted = 'yes';
				$status = $studentDetail->is_checkin_stat;
				$remark = $studentDetail->is_checkin_remark;
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
				'indamagedbooks' => $inDamagedBooks,
				'outdamagedbooks' => $outDamagedBooks,
				'checkoutid' => $checkoutID,
				'statusarray' => $statusArray,
				'status' => $status,
				'remark' => $remark,
				'inserted' => $inserted,
				'ajaxmodal' => $ajaxModal
			);
			$this->load->view('books/checkin/view_checkin_details', $data);
			$this->template->load('footer');
		}
	
	}
	
	public function process()
	{
		
		date_default_timezone_set('Asia/Kuala_Lumpur');
		$checkinDate = date('Y-m-d', time());
		$checkinTime = date('G:i:s', time());
		$checkoutID = $_POST['checkoutid'];
		
		$booksArray = array();
		foreach($_POST as $booksData => $value)
		{
			$exBooksData = explode("-", $booksData);
							
			if (($booksData != 'studentid') && ($booksData != 'status') && ($booksData != 'remark') && ($booksData != 'inserted') && ($exBooksData['0'] != 'damagebooks') && ($booksData != 'checkoutid'))
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
			
			if (($damageBooksData != 'studentid') && ($damageBooksData != 'status') && ($damageBooksData != 'remark') && ($damageBooksData != 'inserted') && ($exBooksData['0'] != 'books') && ($damageBooksData != 'checkoutid'))
			{
				$damageBooksArray[] = $value;
			}
		}
		
		$damageBooks = implode(",", $damageBooksArray);
		$damageBooksTotal = sizeof($damageBooksArray);
		
		$loaner = $_POST['studentid'];
		$collector = 1;
		
		$checkinStat = $_POST['status'];
		$checkinRemark = $_POST['remark'];
		
		$query = $this->db->query("SELECT * FROM ispbt_students INNER JOIN ispbt_class ON is_students_class = is_class_ind WHERE is_students_ind = '$loaner'");
		
		$classArray = $query->row();
		$classYear = $classArray->is_students_year;
		$classInd = $classArray->is_class_ind;
		
		if ($_POST['inserted'] == "yes")
		{
			$query = $this->db->query("SELECT is_checkin_books FROM ispbt_checkin WHERE is_checkin_loaner = '$loaner'");
			$result = $query->row();
			$currentBooks = explode(',', $result->is_checkin_books);
			
			$query = $this->db->query("SELECT * FROM ispbt_books WHERE is_books_year = '$classYear'");
			$allYearBooks = $query->result();
			
			$this->load->model('Mod_updatebooks');
			$this->Mod_updatebooks->instocks($currentBooks, $allYearBooks, $booksArray);
			
			$this->db->query("UPDATE ispbt_checkin SET is_checkin_date = '$checkinDate', is_checkin_time = '$checkinTime', is_checkin_books = '$books', is_checkin_damage = '$damageBooks', is_checkin_collector = '$collector', is_checkin_bookstotal = '$booksTotal', is_checkin_damagestotal = '$damageBooksTotal', is_checkin_stat = '$checkinStat', is_checkin_remark = '$checkinRemark' WHERE is_checkin_loaner = '$loaner'");
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
			
				$stocksInTotal = $BooksStocksIn + 1;
				$this->db->query("UPDATE ispbt_books SET is_books_instocks = '$stocksInTotal' WHERE is_books_ind = '$value'");
				
				if ($BooksStocksOut <= 1)
				{
					$stocksOutTotal = 0;
				}
				else
				{
					$stocksOutTotal = $BooksStocksOut - 1;
				}
				$this->db->query("UPDATE ispbt_books SET is_books_outstocks = '$stocksOutTotal' WHERE is_books_ind = '$value'");
			}
			
			$this->db->query("INSERT INTO ispbt_checkin (is_checkin_ind, is_checkin_date, is_checkin_time, is_checkin_books, is_checkin_damage, is_checkin_checkoutid, is_checkin_loaner, is_checkin_collector, is_checkin_bookstotal, is_checkin_damagestotal, is_checkin_stat, is_checkin_remark) VALUES ('', '$checkinDate', '$checkinTime', '$books', '$damageBooks', '$checkoutID', '$loaner', '$collector', '$booksTotal', '$damageBooksTotal', '$checkinStat', '$checkinRemark')");
		}
		
		redirect('books/checkin/classes/' . $classYear . "/" . $classInd, 'refresh');
	}
	
	function confirm($type, $studentid, $formsubmit)
	{
	
		$query = $this->db->query("SELECT is_students_name FROM ispbt_students WHERE is_students_ind = '$studentid'");
		$studentsdetail = $query->row();
			
		if ($type == 'remove')
		{
			$actionurl = site_url('books/checkin/remove/' . $studentid);
			$additionalvalue = $studentsdetail->is_students_name;
			$data = array(
				'confirmquestion' => 'Adakah anda pasti untuk menghapuskan daftar rekod transaksi pemulangan pelajar ini?',
				'additionalvalue' => $additionalvalue,
				'actionurl' => $actionurl,
				'proceedvalue' => 'Ya, sila hapuskan!!',
				'abortvalue' => 'Batal!!',
				'alert' => 'yes',
				'submitform' => $formsubmit
			);
			$this->load->view('view_confirm', $data);
		}
	}
	
	function remove($studentid)
	{
		$query = $this->db->query("SELECT * FROM ispbt_students WHERE is_students_ind = '$studentid'");
		$studentsdetail = $query->row();
		
		$year = $studentsdetail->is_students_year;
		$class = $studentsdetail->is_students_class;
		
		$this->db->query("DELETE FROM ispbt_checkin WHERE is_checkin_loaner = '$studentid'");
		
		redirect('books/checkin/classes/' . $year . '/' . $class, 'refresh');
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
