<?= $this->load->view('includes/header') ?>
<form name="forms" action="<?= base_url().'index.php/librarian/delete_reference/' ?>" method="post">
<table id='booktable' border="1">
	<tr>
		<th>Delete?</td>
		<th>ID</th>
		<th>Title</th>
		<th>Author</th>
		<th>ISBN</th>
		<th>Category</th>
		<th>Description</th>
		<th>Publisher</th>
		<th>Publication Year</th>
		<th>Access Type</th>
		<th>Course Code</th>
		<th>Total Available</th>
		<th>Total Stock</th>
		<th>No of Times Borrowed</th>
		<th>For Deletion?</th>
		
	</tr>
	<?php
		$totalrows = $query->num_rows();
		if($totalrows > 0):
			$count=1;
			foreach ($query->result() as $row):	
	?>
		
		<tr>
		<td><Input type = 'checkbox' class="checkbox" name = "ch[]" id="ch" value ="<?= $row->id;?>" /></td>
		<td><?= $row->id;?></td>
		<td><?= $row->title;?></td>
		<td><?= $row->author;?></td>
		<td><?= $row->isbn;?></td>
		<td><?php 
			if($row->category == 'B')
				echo 'Book';
			else if($row->category == 'M')
				echo 'Magazine';
			else if($row->category == 'T')
				echo 'Thesis';
			else if($row->category == 'S')
				echo 'Special Problem';
			else if($row->category == 'C')
				echo 'CD/DVD';
			else if($row->category == 'J')
				echo 'Journal';
		?>
		</td>
		<td><?= $row->description;?></td>
		<td><?= $row->publisher;?></td>
		<td><?= $row->publication_year;?></td>
		<td><?= $row->access_type;?></td>
		<td><?= $row->course_code;?></td>
		<td><?= $row->total_available;?></td>
		<td><?= $row->total_stock;?></td>
		<td><?= $row->times_borrowed;?></td>
		<td><?php
			if($row->for_deletion == 'T')
				echo 'Yes';
			else echo 'No';
		?>
		</td>
		</tr>
	<?php
			$count++;
			endforeach;
		endif;
	?>
<table>
<p id="par">

</p>
<button type="button" id="markAll" value="markAll" >Mark All</button>
<input type = "Submit" name = "delete" id="delete" value = "Delete selected books" onclick= "confirmDelete()"/>
</form>
<?= $this->load->view('includes/footer') ?>