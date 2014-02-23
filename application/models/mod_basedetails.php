<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_basedetails extends CI_Model {

    function get($param, $param2)
    {
    
    	if ($param == 'class_title')
    	{
    	
    		$query = $this->db->query("SELECT * FROM ispbt_class WHERE is_class_ind = '$param2'");
    		$result = $query->row();
    		return $result->is_class_title;
    	}
    	
    	else if ($param == 'year_title')
    	{
    	
    		$query = $this->db->query("SELECT * FROM ispbt_years WHERE is_years_digit = '$param2'");
    		$result = $query->row();
    		return $result->is_years_title;
    	}
    	
    	else if ($param == 'year_total')
    	{
    		
    		$query = $this->db->query("SELECT * FROM ispbt_years");
    		$result = $query->result();
    		return $result->num_rows();
    			
    	}
    	
    	else if ($param == 'class_total')
    	{
    		
    		$query = $this->db->query("SELECT * FROM ispbt_class");
    		$result = $query->result();
    		return $result->num_rows();
    	
    	}
    	
    	else if ($param == 'all_class_students_total')
    	{
    	
    		$returnArray = array();
    		$query = $this->db->query("SELECT * FROM ispbt_years");
    		$yearTotal = $query->result_array();
    		
    		$query = $this->db->query("SELECT * FROM ispbt_class");
    		$classTotal = $query->result_array();
    		
    		foreach($yearTotal as $value)
    		{
    			$currentYear = $value["is_years_digit"];
    			
    			foreach($classTotal as $value2)
    			{
    				$currentClass = $value2["is_class_ind"];
    				$query2 = $this->db->query("SELECT * FROM ispbt_students WHERE is_students_year = '$currentYear' AND is_students_class = '$currentClass'");
    				$returnArray["$currentYear"]["$currentClass"] = $query2->num_rows();
    			}
    		}
    	
    		return $returnArray;
    		
    	}
    	
    	else if ($param == 'get_days')
    	{
    		
    		$malayDays = array(
    			'1' => 'Isnin',
    			'2' => 'Selasa',
    			'3' => 'Rabu',
    			'4' => 'Khamis',
    			'5' => 'Jumaat',
    			'6' => 'Sabtu',
    			'7' => 'Ahad'
    		);
    		
    		$output = "";
    		foreach($malayDays as $key => $value)
    		{
    			if ($key == $param2)
    			{
    				$output = $value;
    			}
    		}
    		
    		return $output;
    	}
    	
    	else if ($param == 'get_months')
    	{
    		
    		$malayMonths = array(
    			'1' => 'Januari',
    			'2' => 'Febuari',
    			'3' => 'Mac',
    			'4' => 'April',
    			'5' => 'Mei',
    			'6' => 'Jun',
    			'7' => 'Julai',
    			'8' => 'Ogos',
    			'9' => 'September',
    			'10' => 'Oktober',
    			'11' => 'November',
    			'12' => 'Disember'
    		);
    		
    		$output = "";
    		foreach($malayMonths as $key => $value)
    		{
    			if ($key == $param2)
    			{
    				$output = $value;
    			}
    		}
    		
    		return $output;
    	}
    	
    }

}
