<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Structure extends CI_Controller {

	public function index()
	{
	
		$years = $this->Mod_getoptionlist->load('year');
		$classes = $this->Mod_getoptionlist->load('class');
		$races = $this->Mod_getoptionlist->load('race');
		$religions = $this->Mod_getoptionlist->load('religion');
		$orphans = $this->Mod_getoptionlist->load('orphan');
		
		$this->template->load('header');
		$data = array(
			'yearsdata' => $years,
			'classdata' => $classes,
			'racesdata' => $races,
			'religionsdata' => $religions,
			'orphansdata' => $orphans
		);
		$this->load->view('settings/structure/view_structure_main', $data);
		$this->template->load('footer');
		
	}
	
	public function edit($param)
	{
		
		if ($param == 'year')
		{
			$this->template->load('header');
			$data = array(
				
			);
			$this->load->view('settings/structure/view_structure_edit', $data);
			$this->template->load('footer');
		}
		
		else if ($param == 'class')
		{
			$this->template->load('header');
			$data = array(
				
			);
			$this->load->view('settings/structure/view_structure_edit', $data);
			$this->template->load('footer');
		}
		
		else if ($param == 'race')
		{
			$this->template->load('header');
			$data = array(
				
			);
			$this->load->view('settings/structure/view_structure_edit', $data);
			$this->template->load('footer');
		}
		
		else if ($param == 'religion')
		{
			$this->template->load('header');
			$data = array(
				
			);
			$this->load->view('settings/structure/view_structure_edit', $data);
			$this->template->load('footer');
		}
		
	}
	
}
