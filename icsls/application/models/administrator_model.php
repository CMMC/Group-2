<?php

class Administrator_model extends CI_Model{

	/* Parameters:
		a. $userType - User type of the account
		Description: Returns the query result containing all users with desired user type
		Return value: Array of information containing the result of the query
	*/
	public function get_all_accounts(){
		return $this->db->query("SELECT * FROM users ORDER BY last_name");
	}

	/* Parameters:
		a. $searchCategory - Column name to be checked
		b. $searchText - User input to be search
		Description: Returns all account information of the matching user/s
		Return value: Array of information containing the result of the query
	*/
	public function get_search_accounts($searchCategory, $searchText){
		if($searchCategory == "username"){
			return $this->db->query("SELECT * FROM users WHERE username='$searchText' ORDER BY last_name ASC");
		}else if($searchCategory == "student_number"){
			return $this->db->query("SELECT * FROM users WHERE student_number='$searchText' ORDER BY last_name ASC");
		}else if($searchCategory == "employee_number"){
			return $this->db->query("SELECT * FROM users WHERE employee_number='$searchText' ORDER BY last_name ASC");
		}else if($searchCategory == "first_name"){
			return $this->db->query("SELECT * FROM users WHERE first_name='$searchText' ORDER BY last_name ASC");
		}else if($searchCategory == "last_name"){
			return $this->db->query("SELECT * FROM users WHERE last_name='$searchText' ORDER BY last_name ASC");
		}
	}

	public function get_sorted_accounts($searchCategory, $searchText, $orderBasis){
		
	}
}

?>