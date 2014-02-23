<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_getoptionlist extends CI_Model {

    function load($param)
    {
    
    	if ($param == 'gender')
    	{
		    $query = $this->db->query("SELECT * FROM ispbt_gender");
			return $query->result_array();
		}
		else if ($param == 'year')
		{
			$query = $this->db->query("SELECT * FROM ispbt_years");
			return $query->result_array();
		}
		else if ($param == 'class')
		{
			$query = $this->db->query("SELECT * FROM ispbt_class");
			return $query->result_array();
		}
		else if ($param == 'race')
		{	
			$query = $this->db->query("SELECT * FROM ispbt_race");
			return $query->result_array();
		}
		else if ($param == 'religion')
		{	
			$query = $this->db->query("SELECT * FROM ispbt_religion");
			return $query->result_array();
		}
		else if ($param == 'orphan')
		{	
			$query = $this->db->query("SELECT * FROM ispbt_orphan");
			return $query->result_array();
		}
		else if ($param == 'status')
		{
			$query = $this->db->query("SELECT * FROM ispbt_status");
			return $query->result_array();
		}

    }
}

?>
