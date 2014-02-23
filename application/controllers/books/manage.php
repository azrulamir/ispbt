<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends CI_Controller {

	public function index()
	{
		
		$query = $this->db->query("SELECT * FROM ispbt_books INNER JOIN ispbt_years ON is_books_year = is_years_digit ORDER BY is_books_year, is_books_title ASC");
		$books = $query->result();
		
		$query = $this->db->query("SELECT * FROM ispbt_books INNER JOIN ispbt_years ON is_books_year = is_years_digit GROUP BY is_books_year ASC");
		$classProfile = $query->result();
		
		$ajaxModal = $this->ajax->load();
		
		$this->template->load('header');
		$data = array(
			'books' => $books,
			'classprofile' => $classProfile,
			'ajaxmodal' => $ajaxModal
		);
		$this->load->view('books/manage/view_manage_main', $data);
		$this->template->load('footer');
		
	}
	
	public function classes($year)
	{
		
		$query = $this->db->query("SELECT * FROM ispbt_books INNER JOIN ispbt_years ON is_books_year = is_years_digit WHERE is_books_year = '$year' ORDER BY is_books_year, is_books_title ASC");
		$books = $query->result();
		
		$query = $this->db->query("SELECT * FROM ispbt_books INNER JOIN ispbt_years ON is_books_year = is_years_digit WHERE is_books_year = '$year' GROUP BY is_books_year");
		$classProfile = $query->result();
		
		$ajaxModal = $this->ajax->load();
		
		$this->template->load('header');
		$data = array(
			'books' => $books,
			'classprofile' => $classProfile,
			'ajaxmodal' => $ajaxModal
		);
		$this->load->view('books/manage/view_manage_classes', $data);
		$this->template->load('footer');
	}
	
	public function exist($bookid)
	{
		
		$query = $this->db->query("SELECT * FROM ispbt_books WHERE is_books_ind = $bookid");
		$bookdetail = $query->row();
		
		$data = array(
			'bookdetail' => $bookdetail,
			'yearlist' => $this->Mod_getoptionlist->load('year')
		);
		$this->load->view('books/manage/view_manage_edit', $data);
		
	}
	
	public function add($param)
	{
			
		$this->load->model('Mod_getoptionlist');
		$totalYearArray = $this->Mod_getoptionlist->load('year');

		$data = array(
			'selYear' => $totalYearArray
		);
		$this->load->view('books/manage/view_manage_add', $data);
		
	}
	
	public function confirm($type, $bookid)
	{
		
		$query = $this->db->query("SELECT is_books_code, is_books_title FROM ispbt_books WHERE is_books_ind = '$bookid'");
		$bookdetail = $query->row();
		
		$actionurl = site_url('books/manage/process/remove/' . $bookid);
		$additionalvalue = $bookdetail->is_books_code . " - " . $bookdetail->is_books_title;
		
		$data = array(
			'confirmquestion' => 'Adakah anda pasti untuk menghapuskan daftar rekod buku ini?',
			'additionalvalue' => $additionalvalue,
			'actionurl' => $actionurl,
			'proceedvalue' => 'Ya, sila hapuskan!!',
			'abortvalue' => 'Batal!!'
		);
		$this->load->view('view_confirm', $data);
		
	}
	
	public function process($type, $bookid)
	{
			
		if ($type == 'edit')
		{
			$title = $_POST['title'];
			$code = $_POST['code'];
			$year = $_POST['year'];
			$price = $_POST['price'];
			$author = $_POST['author'];
			$label = $_POST['label'];
		
			$query = $this->db->query("UPDATE ispbt_books SET is_books_title = '$title', is_books_code = '$code', is_books_year = '$year', is_books_price = '$price', is_books_author = '$author', is_books_label = '$label' WHERE is_books_ind = '$bookid'");
			
			redirect('books/manage', 'refresh');
			
		}
		else if ($type == 'remove')
		{
			$query = $this->db->query("DELETE FROM ispbt_books WHERE is_books_ind = '$bookid'");
			redirect('books/manage', 'refresh');
		}
		else
		{	
			$title = $_POST['title'];
			$code = $_POST['code'];
			$year = $_POST['year'];
			$price = $_POST['price'];
			$author = $_POST['author'];
			$label = $_POST['label'];
		
			$query = $this->db->query("INSERT INTO ispbt_books (is_books_title, is_books_code, is_books_year, is_books_price, is_books_author, is_books_label, is_books_outstocks) VALUES ('$title', '$code', '$year', '$price', '$author', '$label', '')");
			redirect('books/manage', 'refresh');
		}
	}
		
}
