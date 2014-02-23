<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Students extends CI_Controller {

	public function index()
	{
		
		$query = $this->db->query("SELECT * FROM ispbt_years");
		$result = $query->result();
		
		$yearsList = $result;
		
		$query = $this->db->query("SELECT * FROM ispbt_class");
		$result = $query->result();
		
		$classList = $result;
		
		$this->load->model('Mod_basedetails');
		$totalClassArray = $this->Mod_basedetails->get('all_class_students_total', '');
		
		$ajaxModal = $this->ajax->load();
		
		$this->template->load('header');
		$data = array(
			'yearslist' => $yearsList,
			'classlist' => $classList,
			'totalstudents' => $totalClassArray,
			'ajaxmodal' => $ajaxModal
		);
		$this->load->view('profiles/students/view_profiles_main', $data);
		$this->template->load('footer');
		
	}
	
	function classes($year, $classInd)
	{
		$query = $this->db->query("SELECT * FROM ispbt_students INNER JOIN ispbt_class ON is_students_class = is_class_ind INNER JOIN ispbt_gender ON is_students_gender = is_gender_ind INNER JOIN ispbt_race ON is_students_race = is_race_ind INNER JOIN ispbt_religion ON is_students_religion = is_religion_ind INNER JOIN ispbt_years ON is_students_year = is_years_digit INNER JOIN ispbt_orphan ON is_students_orphan = is_orphan_ind WHERE is_students_year = $year AND is_class_ind = '$classInd' ORDER BY is_students_name ASC");
		
		$classItems = $query->result();
		
		$query = $this->db->query("SELECT * FROM ispbt_years INNER JOIN ispbt_class WHERE is_years_digit = $year AND is_class_ind = $classInd");
		
		$classDetails = $query->row();
		
		$ajaxModal = $this->ajax->load();
		
		$this->template->load('header');
		$data = array(
			'students' => $classItems,
			'classdetails' => $classDetails,
			'ajaxmodal' => $ajaxModal
		);
		$this->load->view('profiles/students/view_profile_classes', $data);
		$this->template->load('footer');
	}
	
	function detail($studentid)
	{
		$this->template->load('header');
		$this->load->view('profiles/students/view_profiles_students');
		$this->template->load('footer');
	}
	
	function manage($managetype, $params)
	{
	
		if ($managetype == 'edit')
		{
			$query = $this->db->query("SELECT * FROM ispbt_students INNER JOIN ispbt_class ON is_students_class = is_class_ind INNER JOIN ispbt_gender ON is_students_gender = is_gender_ind INNER JOIN ispbt_race ON is_students_race = is_race_ind INNER JOIN ispbt_religion ON is_students_religion = is_religion_ind INNER JOIN ispbt_orphan ON is_students_orphan = is_orphan_ind WHERE is_students_ind = '$params'");
			$studentDetail = $query->row();
			
			$genderlist = $this->Mod_getoptionlist->load('gender');
			$yearlist = $this->Mod_getoptionlist->load('year');
			$classlist = $this->Mod_getoptionlist->load('class');
			$racelist = $this->Mod_getoptionlist->load('race');
			$religionlist = $this->Mod_getoptionlist->load('religion');
			$orphanlist = $this->Mod_getoptionlist->load('orphan');
			
			//$this->template->load('header');	
			$data = array(
				'studentdetail' => $studentDetail,
				'managetype' => $managetype,
				'genderlist' => $genderlist,
				'yearlist' => $yearlist,
				'classlist' => $classlist,
				'racelist' => $racelist,
				'religionlist' => $religionlist,
				'orphanlist' => $orphanlist
			);
			$this->load->view('profiles/students/view_manage_edit', $data);
			//$this->template->load('footer');
		}
		else {
		
			$genderlist = $this->Mod_getoptionlist->load('gender');
			$yearlist = $this->Mod_getoptionlist->load('year');
			$classlist = $this->Mod_getoptionlist->load('class');
			$racelist = $this->Mod_getoptionlist->load('race');
			$religionlist = $this->Mod_getoptionlist->load('religion');
			$orphanlist = $this->Mod_getoptionlist->load('orphan');
			
			//$this->template->load('header');
			$data = array(
				'genderlist' => $genderlist,
				'yearlist' => $yearlist,
				'classlist' => $classlist,
				'racelist' => $racelist,
				'religionlist' => $religionlist,
				'orphanlist' => $orphanlist
			);
			$this->load->view('profiles/students/view_manage_add', $data);
			//$this->template->load('footer');
		}
	}
	
	function confirm($managetype, $studentid)
	{
		if ($managetype == 'remove')
		{	
			$query = $this->db->query("SELECT is_students_name FROM ispbt_students WHERE is_students_ind = '$studentid'");
			$studentsdetail = $query->row();
		
			$actionurl = site_url('profiles/students/process/remove/' . $studentid);
			$additionalvalue = $studentsdetail->is_students_name;
			
			$data = array(
				'confirmquestion' => 'Adakah anda pasti untuk menghapuskan daftar rekod pelajar ini? Kesemua data transaksi turut akan dihapuskan.',
				'additionalvalue' => $additionalvalue,
				'actionurl' => $actionurl,
				'proceedvalue' => 'Ya, sila hapuskan!!',
				'abortvalue' => 'Batal!!'
			);
			$this->load->view('view_confirm', $data);
		}
		else
		{
			
		}
	}
	
	function process($managetype, $studentid)
	{		
		if ($managetype == 'edit')
		{
			$name = $_POST['name'];
			$gender = $_POST['gender'];
			$year = $_POST['year'];
			$class = $_POST['class'];
			$race = $_POST['race'];
			$religion = $_POST['religion'];
			$orphan = $_POST['orphan'];
			
			$query = $this->db->query("UPDATE ispbt_students SET is_students_name = '$name', is_students_gender = '$gender', is_students_year = '$year', is_students_class = '$class', is_students_race = '$race', is_students_religion = '$religion', is_students_orphan = '$orphan' WHERE is_students_ind = $studentid");
			
			redirect('profiles/students/classes/' . $year . "/" . $class,'refresh');
			
		}
		else if ($managetype == 'remove')
		{
			$query = $this->db->query("SELECT * FROM ispbt_students WHERE is_students_ind = $studentid");
			$studentDetail = $query->row();
			
			$query = $this->db->query("DELETE FROM ispbt_students WHERE is_students_ind = '$studentid'");
			$query = $this->db->query("DELETE FROM ispbt_checkin WHERE is_checkin_loaner = '$studentid'");
			$query = $this->db->query("DELETE FROM ispbt_checkout WHERE is_checkout_loaner = '$studentid'");
			
			redirect('profiles/students/classes/' . $studentDetail->is_students_year . '/' . $studentDetail->is_students_class, 'refresh');
		}
		else
		{
			$name = $_POST['name'];
			$gender = $_POST['gender'];
			$year = $_POST['year'];
			$class = $_POST['class'];
			$race = $_POST['race'];
			$religion = $_POST['religion'];
			$orphan = $_POST['orphan'];
			
			$query = $this->db->query("INSERT INTO ispbt_students (is_students_ind, is_students_name, is_students_gender, is_students_year, is_students_class, is_students_race, is_students_religion, is_students_orphan) VALUES ('', '$name', $gender, $year, $class, $race, $religion, $orphan)");
			
			redirect('profiles/students/classes/' . $year . "/" . $class,'refresh');
		}
		
	}
	
}
