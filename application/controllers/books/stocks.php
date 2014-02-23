<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stocks extends CI_Controller {

	public function index()
	{
		$this->template->load('header');
		
		$query = $this->db->query("SELECT * FROM ispbt_books INNER JOIN ispbt_years ON is_books_year = is_years_digit ORDER BY is_books_year, is_books_title ASC");
		$books = $query->result();
		
		$query = $this->db->query("SELECT * FROM ispbt_books INNER JOIN ispbt_years ON is_books_year = is_years_digit GROUP BY is_books_year ASC");
		$classProfile = $query->result();
		
		$query = $this->db->query("SELECT SUM(is_books_instocks) AS instocks, SUM(is_books_outstocks) AS outstocks, SUM(is_books_instocks + is_books_outstocks) AS totalstocks FROM ispbt_books");
		$stocks = $query->row();
		
		$ajaxModal = $this->ajax->load();
		
		$data = array(
			'books' => $books,
			'classprofile' => $classProfile,
			'stocks' => $stocks,
			'ajaxmodal' => $ajaxModal
		);
		
		$this->load->view('books/stocks/view_stocks_main', $data);
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
		$this->load->view('books/stocks/view_stocks_classes', $data);
		$this->template->load('footer');
	}
	
	public function edit($bookid)
	{		
	
		$query = $this->db->query("SELECT * FROM ispbt_books INNER JOIN ispbt_years ON is_books_year = is_years_digit WHERE is_books_ind = $bookid");
		$bookdetail = $query->row();
		
		$query = $this->db->query("SELECT SUM(is_books_instocks) AS instocks, SUM(is_books_outstocks) AS outstocks, SUM(is_books_instocks + is_books_outstocks) AS totalstocks FROM ispbt_books WHERE is_books_ind = $bookid");
		$stocks = $query->row();
		
		$data = array(
			'bookdetail' => $bookdetail,
			'stocks' => $stocks
		);
		$this->load->view('books/stocks/view_stocks_edit', $data);
		
	}
	
	public function process($type, $bookid)
	{
		if ($type == 'edit')
		{
			$instocks = $_POST['instocks'];
			$this->db->query("UPDATE ispbt_books SET is_books_instocks = '$instocks' WHERE is_books_ind = $bookid");
			redirect('books/stocks', 'refresh');
		}
	}
	
	public function stocksummary()
	{
		$query = $this->db->query("SELECT SUM(is_books_instocks) AS instocks, SUM(is_books_outstocks) AS outstocks, SUM(is_books_instocks + is_books_outstocks) AS totalstocks FROM ispbt_books");
		$stocks = $query->row();

		$data = array(
			'stocks' => $stocks
		);
		$this->load->view('books/stocks/view_stock_summary', $data);
	}
	
}
