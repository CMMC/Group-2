<?php $this->load->view('includes/header') ?>
	<?php
		/* Save result from database as AssocArray '$row' */
		if($number_of_reference != 1)
			redirect('librarian');
		
			foreach ($reference_material as $row){}
			/*Session start*/
			session_start();
			$_SESSION['id'] = $row->id;
	?>	
		<form name="edit_form" action="<?= base_url() . 'index.php/librarian/edit_reference/' . $row->id ?>" method="POST">
			
				<h3>Edit Reference Form</h3>
					<span>required fields *</span><br/><br/>
					<label for="title">Title</label>
					<input type="text" id="title" name="title" pattern="^.*[A-Za-z0-9]{1,}.*$" onblur="validate_title()" value="<?php echo $row->title; ?>" required/>*<br/>
					<label for="author">Author</label>
					<input type="text" id="author" name="author" pattern="^[a-zA-Z\ ][a-zA-Z\ \.\,]*$" value="<?php echo $row->author;  ?>" onblur='validate_author()' required/>*<br/>
					<label for="isbn">ISBN</label>
					<input type="text" id="isbn" name="isbn" pattern="^[0-9][0-9\-]{11}[0-9]$" value="<?php echo $row->isbn; ?>" onblur="validate_isbn()"/><br/>
					<label for="category">Category</label>
						<select name="category"  id="category">
									<option value="M" <?php echo ($row->category == "M")? "selected":""; ?>>Magazine</option>
									<option value="T" <?php echo ($row->category == "T")? "selected":""; ?>>Thesis</option>
									<option value="S" <?php echo ($row->category == "S")? "selected":""; ?>>Special Problem</option>
									<option value="B" <?php echo ($row->category == "B")? "selected":""; ?>>Book</option>
									<option value="C" <?php echo ($row->category == "C")? "selected":""; ?>>CD/DVD</option>
									<option value="J" <?php echo ($row->category == "J")? "selected":""; ?>>Journal</option>	
						</select>*<br/>
 					<label for="publisher">Publisher</label>
 					<input type="text" id="publisher" name="publisher" pattern="^.*[A-Za-z0-9]{1,}.*$" value="<?php echo $row->publisher; ?>" onblur="validate_publisher()"/> <br/>
					<label for="publication_year">Publication Year</label>
					<input type="text" id="publication_year" name="publication_year" pattern="^[0-9][0-9][0-9][0-9]$" value="<?php echo $row->publication_year; ?>" onblur="validate_publication_year()"/><br/>
					<label for="access_type">Access Type</label>
						<select name="access_type"  id="access_type">
									<option value="F" <?php echo ($row->access_type == "F")? "selected":""; ?>>Faculty</option>
									<option value="S" <?php echo ($row->access_type == "S")? "selected":""; ?>>Student</option>	
						</select>*<br/>
					<label for="course_code">Course Code</label>
					<input type="text" id="course_code" name="course_code" pattern="^[A-Z][A-Z0-9]{0,4}[0-9]$" value="<?php echo $row->course_code; ?>" onblur="validate_course_code()" required/>*<br/>
					<label for="description">Description</label> 			
					<textarea id="description" name="description" pattern="^.*[A-Za-z0-9]{1,}.*$" onblur="validate_description()"><?php echo $row->description; ?></textarea><br/>
					<label for="total_stock">Total Stock</label>
					<input type="number" min='0' id="total_stock" name="total_stock" onchange="validate_total_stock()" value="<?php echo $row->total_stock; ?>"/>*<br/>
					<input type='hidden' id="total_available" value="<?php echo $row->total_available; ?>"/>
				<input type="submit" onclick="return confirm('Are you sure you want to save these changes?');" value="submit"/>

		</form>
<?= $this->load->view("includes/footer.php") ?>	