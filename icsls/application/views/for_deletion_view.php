<?=$this->load->view("includes/header")?>
<form name="forms" action="<?= base_url().'index.php/librarian/change_forDeletion/' ?>" method="post">
<h3>The following resource(s) might still be in use, thus not deleted in the database.</h3>
<h3>Would you like to change to 'For Deletion' status? </h3><br/><br/>

<table id='booktable' border="1">
	<?php
		foreach($forDeletion as $forDelete):
			$totalrows = $forDelete->num_rows();
			if($totalrows > 0):
				foreach ($forDelete->result() as $row):	
	?>
		
		<tr>
		<td><Input type = 'checkbox' class="checkbox" name = "ch[]" id="ch" value ="<?= $row->id;?>" /></td>
		<td><?= $row->id;?></td>
		<td><?= $row->title;?></td>
		<td><?= $row->author;?></td>
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
		<td><?= $row->publication_year;?></td>

		</tr>
	<?php
				endforeach;
			endif;
		endforeach;
	?>
<table>
<p id="par">

</p>
<button type="button" id="markAll" value="markAll" >Mark All</button>
<input type = "Submit" name = "delete" id="delete" value = "Done!" onclick= "return confirmChangeForDeletion()"/>
</form>
<?=$this->load->view("includes/footer")?>