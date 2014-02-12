
<?php
/**
 * Controller for librarian-specific modules
 *
 * @author Mark Carlo Dela Torre, Angela Roscel Almoro, Jason Faustino, Jay-ar Hernaez
 * @version 1.0
*/
class Librarian extends CI_Controller{
	/**
	 * Constructor for the controller Librarian
	 *
	 * @access public
	*/
	public function Librarian(){
		parent::__construct();

		//Redirect if user is not logged in or not a librarian
		if(! $this->session->userdata('loggedIn') || $this->session->userdata('user_type') != 'L'){
			redirect('login');
		}

		$this->load->helper(array('html', 'form'));
		$this->load->model("librarian_model");
		$this->load->library('table', 'input');
	}//end of constructor Librarian

	/**
	 * Default Librarian function - Loads view containing links to Librarian sub-modules
	 *
	 * @access public
	*/
	public function index(){
		$data["title"] = "Librarian Search Reference - ICS Library System";
		
		$this->load->view('librarian_main_view', $data);
	}//end of function index

	/* ******************** SEARCH REFERENCE MODULE ******************** */
	/**
	 * Loads the search reference view containing a form and input fields to search references stored in the database
	 *
	 * @access public
	*/
	public function search_reference_index(){
		$data['title'] = "Librarian Search Reference - ICS Library System";
		$this->load->view('search_view', $data);
	}//end of function search_reference_index

	/* Displays search result based on the search_result function */
	/**
	 * Displays search result based on the user's input
	 *
	 * @access public
	*/
	public function display_search_results($query_id = 0, $offset = 0){
		$data['title'] = 'Librarian Search Reference - ICS Library System';

		$query_array = array(
			'category' => $this->input->get('selectCategory'),
			'text' => htmlspecialchars($this->input->get('inputText')),
			'sortCategory' => $this->input->get('selectSortCategory'),
			'row' => $this->input->get('selectRows'),
			'accessType' => $this->input->get('selectAccessType'),
			'orderBy' => $this->input->get('selectOrderBy'),
			'deletion' => $this->input->get('checkDeletion'),
			'match' => $this->input->get('radioMatch')
		);

		//Do not continue if user tried to make the database retrieval fail by editing URL's GET 
		foreach($query_array as $element):
			if($element === FALSE)
				redirect('librarian/search_reference_index');
		endforeach;

		$offset = $this->input->get('per_page') ? $this->input->get('per_page') : 0;

		$data['total_rows'] = $this->librarian_model->get_number_of_rows($query_array);

		$results = $this->librarian_model->get_search_reference($query_array, $offset);

		$data['references'] = $results->result();
		$data['numResults'] = $results->num_rows();

		/* Initialize the pagination class */
		$this->load->library('pagination');
		$config['base_url'] = base_url() . "index.php/librarian/display_search_results?selectCategory={$_GET['selectCategory']}&inputText={$_GET['inputText']}&radioMatch={$_GET['radioMatch']}&selectSortCategory={$_GET['selectSortCategory']}&selectOrderBy={$_GET['selectOrderBy']}&selectAccessType={$_GET['selectAccessType']}&checkDeletion={$_GET['checkDeletion']}&selectRows={$_GET['selectRows']}";// . $query_id;
		$config['total_rows'] = $data['total_rows'];
		$config['per_page'] = $query_array['row']; 
		$config['page_query_string'] = TRUE;
		$this->pagination->initialize($config);

		//Load the Search View Page
		$this->load->view('search_view', $data);
		
	}//end of function display_search_results

	/* ******************** END OF SEARCH REFERENCE MODULE ******************** */

	/* ******************** VIEW REFERENCE MODULE ******************** */
	/**
	 * View a reference specified by its row ID (which is set in the database)
	 *
	 * @access public
	*/
	public function view_reference(){
		$id = $this->uri->segment(3);
		if($id === FALSE)
			redirect('librarian');
	      
	    $result = $this->librarian_model->get_reference($id);
	    $data['reference_material'] = $result->result();
	    $data['number_of_reference'] = $result->num_rows();
	    $this->load->view('view_reference_view', $data);
	}//end of function view_reference

	/* ******************** END OF REFERENCE MODULE ******************** */

	/* ******************** EDIT REFERENCE MODULE ******************** */

	/**
	 * Loads initial state of the reference to be edited
	 *
	 * @access public
	*/
	public function edit_reference_index(){
		$data['title'] = 'Librarian Edit Reference - ICS Library System';

		if($this->uri->segment(3) === FALSE)
			redirect('librarian');

		$queryObj = $this->librarian_model->get_reference($this->uri->segment(3));

		$data['reference_material'] = $queryObj->result();
		$data['number_of_reference'] = $queryObj->num_rows();

		$this->load->view('edit_reference_view', $data);
	}//end of function edit_reference_index

	/**
	 * Edit reference based on the input of the user
	 *
	 * @access public
	*/
	public function edit_reference(){
		$this->load->helper('text');

		$id = $this->uri->segment(3);
		if($id === FALSE)
			redirect('librarian');

		//Filter the user's input of HTML special symbols
		$title = htmlspecialchars(mysql_real_escape_string(trim($this->input->post('title'))));
		$author = htmlspecialchars(mysql_real_escape_string(trim($this->input->post('author'))));
		$isbn = $this->input->post('isbn');
		$category = $this->input->post('category');
		$publisher = htmlspecialchars(mysql_real_escape_string(trim($this->input->post('publisher'))));
		$publication_year = $this->input->post('publication_year');
		$access_type = $this->input->post('access_type');
		$course_code = $this->input->post('course_code');
		$description = htmlspecialchars(mysql_real_escape_string(trim($this->input->post('description'))));
		$total_stock = $this->input->post('total_stock');

		//Store the input from user to be passed on the model
	    $query_array = array(
	       	'id' => $id,
	       	'title' => $title,
	       	'author' => $author,
	       	'isbn' => $isbn,
	       	'category' => $category,
	       	'publisher' => $publisher,
	       	'publication_year' => $publication_year,
	       	'access_type' => $access_type,
	       	'course_code' => $course_code,
	       	'description' => $description,
	       	'total_stock' => $total_stock
	    );

	    $result = $this->librarian_model->edit_reference($query_array);
	    redirect('librarian');
	}//end of function edit_reference

	/* ******************** END OF EDIT REFERENCE MODULE ******************** */

	/* ******************** DELETE REFERENCE MODULE ******************** */
	/*
	public function delete_ready_reference(){
		if(!empty($_POST['chch'])):
			if(count($_POST['chch'])>0):
				$toDelete = $_POST['chch'];
				
				for($i=0;$i< count($toDelete);$i++){
					$result = $this->librarian_model->delete_references($toDelete[$i]);
				}
				 
			endif;
		endif;
		
		redirect( base_url() . 'index.php/librarian','refresh');
	}
	*/

	/**
	 * Delete selected references specified by its respective checkbox
	 *
	 * @access public
	*/
    public function delete_reference(){
        $data['title'] = 'Delete Reference';
		
		$cannotBeDeleted = array();
		if(!empty($_POST['ch'])){
			if(count($_POST['ch'])>0):
				$toDelete = $_POST['ch'];
				
				for($i = 0; $i < count($toDelete); $i++){
					//$result = $this->librarian_model->delete_references($toDelete[$i]);
					if($result != -1) $cannotBeDeleted[] = $result;
				}
				 
			endif;
		}
		
		if(count($cannotBeDeleted)>0){
			//$data['forDeletion'] = $this->librarian_model->get_selected_books($cannotBeDeleted);
			$this->load->view('for_deletion_view',$data);
		}
		redirect(base_url() . 'index.php/librarian','refresh');
    }//end of function delete_reference
	
	/**
	 * Updates for_deletion attribute of references in case they cannot be deleted immediately
	 *
	 * @access public
	*/
	public function change_forDeletion(){
		 $data['title'] = 'Delete Reference';
		 
		 if(!empty($_POST['ch'])):
			$toUpdate = $_POST['ch'];
			for($i = 0; $i < count($toUpdate); $i++){
				$this->librarian_model->update_for_deletion($toUpdate[$i]);
			}
		 endif;
		$readyResult = $this->librarian_model->get_ready_for_deletion();
		$data['readyDeletion']	= $readyResult;
		$idready = array();
		foreach($readyResult->result() as $row):
			$idready[] = $row->id;
		endforeach;
		
		$data['query'] = $this->librarian_model->get_other_books($idready);	
		redirect( base_url() . 'index.php/librarian','refresh');
	}//end of function change_forDeletion

	/* ******************** END OF DELETE REFERENCE MODULE ******************** */

	/* ******************** ADD REFERENCE MODULE ******************** */

	/**
	 * Loads the view for adding references
	 *
	 * @access public
	*/
	public function add_reference_index(){
		$data['title'] = 'Librarian Add Reference - ICS Library System';
		$this->load->view('add_view', $data);
	}//end of function add_reference_index

	/**
	 * Add a reference to the database
	 *
	 * @access public
	*/
	public function add_reference(){
		$data['title'] = 'Librarian Add Reference - ICS Library System';
		$this->load->view("addReference_view", $data);

		if($this->input->post('submit')) {
		    $this->librarian_model->add_data();
		    redirect('librarian/index','refresh');
		}
	}//end of function add_reference

	/**
	 * Loads and validates the file uploaded by the user
	 *
	 * @access public
	*/
	public function file_upload(){
		$data['title'] = 'Librarian Add Reference - ICS Library System';

		if($this->input->post()){
			$config_arr = array(
	            'upload_path' => './uploads/',
	            'allowed_types' => 'text/plain|text/csv|csv',
	            'max_size' => '2048'
	        );

	        $this->load->library('upload', $config_arr);

			if(! $this->upload->do_upload('csvfile')){
				$data['error'] = $this->upload->display_errors();
				$this->load->view("fileUpload_view", $data);
			}
			else{
				$uploadData = array('upload_data' => $this->upload->data());
				$filename='./uploads/'.$uploadData['upload_data']['file_name'];
				$this->load->library('csvreader');
		        $data['csvData'] = $this->csvreader->parse_file($filename);	
				$this->load->view("uploadSuccess_view", $data);
			}
		}
		else{
			$this->load->view("fileUpload_view", $data);     
		}
	}//end of function file_upload

	/**
	 * Adds multiple references to the database using the data in the file
	 *
	 * @access public
	*/
	public function add_multipleReferences(){
		$data['title'] = 'Librarian Add Reference - ICS Library System';
		//$this->load->view("fileUpload_view", $data);
		if($this->input->post()){
		    $count = $this->input->post('rowCount');

		    for($i = 0; $i < $count; $i++) {
				$data[$i] = array(
					'TITLE' => $this->input->post('title' . $i),
					'AUTHOR' => $this->input->post('author' . $i),
					'ISBN' => $this->input->post('isbn' . $i),
					'CATEGORY' => $this->input->post('category' . $i),
					'DESCRIPTION' => $this->input->post('description' . $i),
					'PUBLISHER' => $this->input->post('publisher' . $i),
					'PUBLICATION_YEAR' => $this->input->post('year' . $i),
					'ACCESS_TYPE' => $this->input->post('access_type' . $i),
					'COURSE_CODE' => $this->input->post('course_code' . $i),
					'TOTAL_AVAILABLE' => $this->input->post('total_stock' . $i),
					'TOTAL_STOCK' => $this->input->post('total_stock' . $i),
					'TIMES_BORROWED' => '0',
					'FOR_DELETION' => 'F'    
				);
		    }

	    	$this->librarian_model->add_multipleData($data,$count);
		    redirect('librarian/index','refresh');
		}
	}//end of function add_multipleReferences

	/* ******************** END OF ADD REFERENCE MODULE ******************** */

	public function view_profile(){
		
	}
}

?>