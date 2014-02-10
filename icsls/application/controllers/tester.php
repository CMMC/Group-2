<?php
	class Tester extends CI_Controller{
		public function index(){
			$data['title'] = 'Hello World';
			$this->load->view('create_user_view', $data);
		}

		public function create_user(){
			$data['title'] = 'Hello World';

			$data['status'] = 'YEA';

				$fname = $this->input->post('first');
				$mname = $this->input->post('middle');
				$lname = $this->input->post('last');
				$empno = $this->input->post('empNo');
				$type = $this->input->post('type');
				$uname = $this->input->post('username');
				$pword = $this->input->post('password');
				$colladd = $this->input->post('college_add');
				$email = $this->input->post('email_add');
				$college = $this->input->post('college');
				$degree = $this->input->post('degree');

			$pword = md5($pword);

			$this->db->query("INSERT INTO users(employee_number,
				last_name, first_name, middle_name,
				user_type, username, password, college_address, email_address,
				degree, college) VALUES(
				'$empno', '$lname', '$fname',
				'$mname','$type', '$uname',
				'$pword', '$colladd', '$email',
				'$degree', '$college'
				)");
			$this->load->view('create_user_view', $data);
		}
	}
?>