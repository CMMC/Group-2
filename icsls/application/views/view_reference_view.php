<?php $this->load->view('includes/header'); ?>
	<h3>View Reference</h3>

	<?php
		if($number_of_reference == 1)
		foreach ($reference_material as $row) {
			echo "Id = $row->id"; ?>
			</br>
			<?php echo "Title = " . $row->title; ?>
			<br />
			<?php echo "Author = " . $row->author; ?>
			<br />
			<?php echo "ISBN = $row->isbn"; ?>
			<br />
			<?php
			if($row->category == 'B'){
				echo "Category = Book";	
			}else if($row->category == 'M'){
				echo "Category = Magazine";
			}else if($row->category == 'T'){
				echo "Category = Thesis";
			}else if($row->category == 'S'){
				echo "Category = Special Problem";
			}else if($row->category == 'J'){
				echo "Category = Journal";
			}else{
				echo "Category = CD/DVD";
			}
			?>
			<br />
			<?php echo "Description = $row->description"; ?>
			<br />
			<?php echo "Publisher = $row->publisher"; ?>
			<br />
			<?php echo "Publication Year = $row->publication_year"; ?>
			<br />
			<?php
				if($row->access_type=="S"){
					echo "Access Type = Student";	
				}else{
					echo "Access Type = Faculty";
				}
			?>
			<br />
			<?php echo "Course Code = $row->course_code"; ?>
			<br />
			<?php echo "Total Available = $row->total_available"; ?>
			<br />
			<?php echo "Total Stock = $row->total_stock"; ?>
			<br />
			<?php echo "Times Borrowed = $row->times_borrowed"; ?>
			<br />
			<?php echo "For Deletion = $row->for_deletion"; ?>
			<br />
			<?= anchor(base_url() . 'index.php/librarian/edit_reference_index/' . $row->id, 'Edit!') ?>			
	<?php } ?>
	
	<?= anchor(base_url() . 'index.php/librarian/', 'Back') ?>
<?php $this->load->view('includes/footer'); ?>