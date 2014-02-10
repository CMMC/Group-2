<?php

class User_model extends CI_Model{

	/* Parameters:
		a. $username - Username of the user
		b. $password - Password of the user
		Description: Check if the user is registered
		Return value: Boolean value true if the user is registered, otherwise, false
	*/
	public function user_exists($username, $password){
		$userCount = $this->db->query("SELECT * FROM users WHERE username='$username' AND password='$password'")->num_rows();

		return ($userCount == 1 ? true : false);
	}

	/* Parameters:
		a. $username - Username of the user
		b. $password - Password of the user
		Description: Returns the id, user type and username of the user
		Return value: Array of information containing the result of the query
	*/
	public function get_user_data($username, $password){
		return $this->db->query("SELECT id, user_type, username FROM users WHERE username='$username' AND password='$password'")->result();
	}

}

?>