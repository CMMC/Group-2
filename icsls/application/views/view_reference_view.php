<?php $this->load->view('includes/header'); ?>
	<h3>View Reference</h3>

	<?php

		foreach ($reference_material as $row) {
				echo "Id = $row->id</br>";
				echo "Title = $row->title</br>";
				echo "Author = $row->author</br>";
				echo "ISBN = $row->isbn</br>";
				if($row->category=='B'){
					echo "Category = Book</br>";	
					}else if($row->category=='M'){
						echo "Category = Magazine</br>";
					}else if($row->category=='T'){
						echo "Category = Thesis</br>";
					}else if($row->category=='S'){
						echo "Category = Special Problem</br>";
					}else if($row->category=='J'){
						echo "Category = Journal</br>";
					}else{
						echo "Category = CD/DVD</br>";
					}
					
					echo "Description = $row->description</br>";
					echo "Publisher = $row->publisher</br>";
					echo "Publication Year = $row->publication_year</br>";
					if($row->access_type=="S"){
						echo "Access Type = Student</br>";	
					}else{
						echo "Access Type = Faculty</br>";
					}
					echo "Course Code = $row->course_code</br>";
					echo "Total Available = $row->total_available</br>";
					echo "Total Stock = $row->total_stock</br>";
					echo "Times Borrowed = $row->times_borrowed</br>";
					echo "For Deletion = $row->for_deletion</br>";
					
			}
	?>
	<?= anchor(base_url() . 'index.php/librarian/edit_reference_index/' . $row->id, 'Edit!') ?>
	<?= anchor(base_url() . 'index.php/librarian/', 'Back') ?>
<?php $this->load->view('includes/footer'); ?>