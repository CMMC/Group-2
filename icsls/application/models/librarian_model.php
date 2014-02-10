<?php

class Librarian_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	/* Store query string from user's POST inputs to the database, returning the insert id as a result */
	function store_query_string($query_array){
		$this->db->insert('query_string', array('query_string' => http_build_query($query_array)));

		return $this->db->insert_id();
	}//end of function store_query_string

	/* Returns the number of rows affected by the user's query */
	function get_number_of_rows($query_array){
		//Match or Like
		if($query_array['match'] == 'like')
			$this->db->like($query_array['category'], $query_array['text']);
		elseif($query_array['match'] == 'match')
			$this->db->where($query_array['category'], $query_array['text']);

		//Display references ONLY for a specific type of people
		if($query_array['accessType'] != 'N')
			$this->db->where('access_type', $query_array['accessType']);

		//Display references to be deleted
		if($query_array['deletion'] != 'N')
			$this->db->where('for_deletion', $query_array['deletion']);

		$result = $this->db->get('reference_material');

		return $result->num_rows();
	}

	/* Gets the results of the user's query */
	function get_search_reference($query_array, $start){

		//Display ALL references

		//Match or Like
		if($query_array['match'] == 'like')
			$this->db->like($query_array['category'], $query_array['text']);
		elseif($query_array['match'] == 'match')
			$this->db->where($query_array['category'], $query_array['text']);

		//Display references ONLY for a specific type of people
		if($query_array['accessType'] != 'N')
			$this->db->where('access_type', $query_array['accessType']);

		//Display references to be deleted
		if($query_array['deletion'] != 'N')
			$this->db->where('for_deletion', $query_array['deletion']);

		//Order
		$this->db->order_by($query_array['sortCategory'], $query_array['orderBy']);

		$this->db->limit($query_array['row'], $start);
		
		return $this->db->get('reference_material');
	}

	//Remove selected references in database
    function delete_references($book_id){
		
		$this->db->where('id',$book_id);
		$query = $this->db->get('reference_material');
		foreach($query->result() as $row):
			//Check books if complete
			if($row->total_available===$row->total_stock){
				$this->load->database();
				$this->db->delete('reference_material', array('id' => $book_id)); 
				return -1;
			}
			else{
				return $book_id;
			}	
		endforeach;
		
    }
	
	//get books with For Deletion value 'T' and complete availability
	function get_ready_for_deletion(){
		$sql = "SELECT a.id,a.title,a.author FROM reference_material a JOIN reference_material b ON a.id=b.id WHERE a.total_available=b.total_stock AND a.for_deletion = 'T'";
		$query = $this->db->query($sql);
		return $query;
		
	}
	
	//get the remaining books
	function get_other_books($idready){
		if(!empty($idready)){
			$this->db->where_not_in('id',$idready);
			return $this->db->get('reference_material');
		}else{
			return $this->db->get('reference_material');
		}
	}
	
	//Given array of selected books retrieve info
	function get_selected_books($selected){
		$info = array();
		foreach($selected as $id):
			$this->db->where('id',$id);
			$info[] = $this->db->get('reference_material');
		endforeach;
		
		return $info;
	}
	
	//Update the for_deletion attribute
	function update_for_deletion($book_id){ //Changes 'For Deletion' attribute of the reference to  'T'
		$this->db->where('id', $book_id);
		$this->db->update('reference_material', array('for_deletion' => 'T')); 
	}

	function add_data(){
          $data = array(
            'TITLE' => $this->input->post('title'),
            'AUTHOR' => $this->input->post('author'),
            'ISBN' => $this->input->post('isbn'),
            'CATEGORY' => $this->input->post('category'),
            'DESCRIPTION' => $this->input->post('description'),
            'PUBLISHER' => $this->input->post('publisher'),
            'PUBLICATION_YEAR' => $this->input->post('year'),
            'ACCESS_TYPE' => $this->input->post('access_type'),
            'COURSE_CODE' => $this->input->post('course_code'),
            'TOTAL_AVAILABLE' => $this->input->post('total_stock'),
            'TOTAL_STOCK' => $this->input->post('total_stock'),
            'TIMES_BORROWED' => '0',  
            'FOR_DELETION' => 'F'       
          );
          
          $this->db->insert('REFERENCE_MATERIAL',$data);

          /*find a more efficient way to do this */
            $this->db->set('isbn',NULL);
            $this->db->where('isbn','');
            $this->db->update('REFERENCE_MATERIAL');

            $this->db->set('description',NULL);
            $this->db->where('description','');
            $this->db->update('REFERENCE_MATERIAL');

            $this->db->set('publisher',NULL);
            $this->db->where('publisher','');
            $this->db->update('REFERENCE_MATERIAL');

            $this->db->set('publication_year',NULL);
            $this->db->where('publication_year','');
            $this->db->update('REFERENCE_MATERIAL');
        }

       function add_multipleData($data,$count){
            for($i=0;$i<$count;$i++) {
               $this->db->insert('REFERENCE_MATERIAL', $data[$i]);
            }

            /*find a more efficient way to do this */
            $this->db->set('isbn',NULL);
            $this->db->where('isbn','');
            $this->db->update('REFERENCE_MATERIAL');

            $this->db->set('description',NULL);
            $this->db->where('description','');
            $this->db->update('REFERENCE_MATERIAL');

            $this->db->set('publisher',NULL);
            $this->db->where('publisher','');
            $this->db->update('REFERENCE_MATERIAL');

            $this->db->set('publication_year',NULL);
            $this->db->where('publication_year','');
            $this->db->update('REFERENCE_MATERIAL');
        }

        public function edit_reference($query_array){
      		$this->db->query("UPDATE reference_material SET 
      			title = '{$query_array['title']}', 
      			author = '{$query_array['author']}', 
      			isbn = '{$query_array['isbn']}', 
      			category = '{$query_array['category']}', 
      			publisher = '{$query_array['publisher']}', 
      			publication_year = '{$query_array['publication_year']}', 
      			access_type = '{$query_array['access_type']}', 
      			course_code = '{$query_array['course_code']}', 
      			description = '{$query_array['description']}', 
      			total_stock = '{$query_array['total_stock']}' 
      			WHERE id = {$query_array['id']}");
    	}

    public function get_reference($referenceId){
        $this->db->where('id', $referenceId);
        return $this->db->get('reference_material')->result();
    }

}

?>