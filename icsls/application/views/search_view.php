<?= $this->load->view('includes/header') ?>
	<?= anchor(base_url() . 'index.php/librarian', 'Back') ?>

		<!-- Form Searching References -->
		<form action = "<?= base_url() . 'index.php/librarian/display_search_results' ?>" method = 'GET'>
			<select name = 'selectCategory'>
				<option value = 'title' <?php echo ($this->input->get('selectCategory') == 'title') ? "selected" : ""; ?>>Title</option>
				<option value = 'author' <?php echo ($this->input->get('selectCategory') == 'author') ? "selected" : ""; ?>>Author</option>
				<option value = 'isbn' <?php echo ($this->input->get('selectCategory') == 'isbn') ? "selected" : ""; ?>>ISBN</option>
				<option value = 'course_code' <?php echo ($this->input->get('selectCategory') == 'course_code') ? "selected" : ""; ?>>Course Code</option>
				<option value = 'publisher' <?php echo ($this->input->get('selectCategory') == 'publisher') ? "selected" : ""; ?>>Publisher</option>
			</select>
			
			<input type = 'text' name = 'inputText' pattern = '.{1,}' value = '<?= $this->input->get('inputText') ?>'/>
			<br />
			<strong>Advanced Search</strong>
			<br />
			<label for = 'likeRadio'>Like</label>
			<input type = 'radio' id = 'likeRadio' name = 'radioMatch' value = 'like' <?php echo ($this->input->get('radioMatch') != 'match') ? "checked" : ""; ?> />
			<br />
			<label for = 'matchRadio'>Exact Match</label>
			<input type = 'radio' id = 'matchRadio' name = 'radioMatch' value = 'match' <?php echo ($this->input->get('radioMatch') == 'match') ? "checked" : ""; ?> />
			<br />
			<br />

			<label><strong>Sort By:</strong></label>
			<label for = 'selectSortCategory'>Category:</label>
			<select id = 'selectSortCategory' name = 'selectSortCategory'>
				<option value = 'title' <?php echo ($this->input->get('selectSortCategory') == 'title') ? "selected" : ""; ?>>Title</option>
				<option value = 'author' <?php echo ($this->input->get('selectSortCategory') == 'author') ? "selected" : ""; ?>>Author</option>
				<option value = 'category' <?php echo ($this->input->get('selectSortCategory') == 'category') ? "selected" : ""; ?>>Reference Type</option>
				<option value = 'course_code' <?php echo ($this->input->get('selectSortCategory') == 'course_code') ? "selected" : ""; ?>>Course Code</option>
				<option value = 'times_borrowed' <?php echo ($this->input->get('selectSortCategory') == 'times_borrowed') ? "selected" : ""; ?>>Number of times borrowed</option>
				<option value = 'total_stock' <?php echo ($this->input->get('selectSortCategory') == 'total_stock') ? "selected" : ""; ?>>Total stock</option>
			</select>
			<label for = 'selectOrderBy'>Order:</label>
			<select id = 'selectOrderBy' name = 'selectOrderBy'>
				<option value = 'ASC' <?php echo ($this->input->get('selectOrderBy') == 'ASC') ? "selected" : ""; ?>>Ascending</option>
				<option value = 'DESC' <?php echo ($this->input->get('selectOrderBy') == 'DESC') ? "selected" : ""; ?>>Descending</option>
			</select>

			<br />
			<label><strong>Search only: </strong></label>
			<br />
			<label for = 'selectAccessType'>Access Type: </label>
			<select id = 'selectAccessType' name = 'selectAccessType'>
				<option value = 'N' <?php echo ($this->input->get('selectAccessType') == 'N') ? "selected" : ""; ?>></option>
				<option value = 'F' <?php echo ($this->input->get('selectAccessType') == 'F') ? "selected" : ""; ?>>Faculty</option>
				<option value = 'S' <?php echo ($this->input->get('selectAccessType') == 'S') ? "selected" : ""; ?>>Student</option>
			</select>
			<br />
			<label for = 'del'>Status</label>
			<select id = 'del' name = 'checkDeletion'>
				<option value = 'N' <?php echo ($this->input->get('checkDeletion') == 'N') ? "selected" : ""; ?>></option>
				<option value = 'T' <?php echo ($this->input->get('checkDeletion') == 'T') ? "selected" : ""; ?>>To be Removed</option>
				<option value = 'F' <?php echo ($this->input->get('checkDeletion') == 'F') ? "selected" : ""; ?>>Available</option>
			</select>

			<br />
			<label for = 'selectRows'>Rows per page</label>
			<select id  = 'selectRows' name = 'selectRows'>
				<option value = '10' <?php echo ($this->input->get('selectRows') == '10') ? "selected" : ""; ?>>10</option>
				<option value = '20' <?php echo ($this->input->get('selectRows') == '20') ? "selected" : ""; ?>>20</option>
				<option value = '50' <?php echo ($this->input->get('selectRows') == '50') ? "selected" : ""; ?>>50</option>
				<option value = '100' <?php echo ($this->input->get('selectRows') == '100') ? "selected" : ""; ?>>100</option>
			</select>
			<br />
			<input type = 'submit' name = 'submit' value = 'Submit' />
		</form>
		<!-- End of Form for Searching Reference -->

		<form name = "forms" action = "<?= base_url() . 'index.php/librarian/delete_reference/' ?>" method = "POST">
		<!-- Display table for references not ready or not scheduled for deletion -->
		<!-- Form for displaying, deleting, and viewing searched references -->
		<?php if(isset($references) && $numResults > 0){ ?>
		
				<button type = "button" id = "markAll" value = "markAll">Mark All</button>
				<input type = "submit" value = "Delete Selected" onclick = "return confirmDelete()" />
				<br />
				<center><?= $this->pagination->create_links() ?></center>
				<table id = 'booktable' border = "1" cellpadding = "5" cellspacing = "2">
					<thead>
						<tr>
							<th></th>
							<th>Row</th>
							<th>Course Code</th>
							<th>Title</th>
							<th>Author/s</th>
							<th>Reference Type</th>
							<th>Access Type</th>
							<th>Times Borrowed</th>
							<th>Current number</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody style = "text-align: center" >

					<?php
						$offset = $this->input->get('per_page') ? $this->input->get('per_page') : 0;
						$rowID = 1 + $offset;
						foreach($references as $r): ?>
							<tr>
								<td><input type = "checkbox" id = "ch" class = "checkbox" name = "ch[]" value = '<?= $r->id ?>'/></td>
								<td><?= $rowID++ ?></td>
								<td><?= $r->course_code ?></td>
								<td><?= (anchor(base_url() . 'index.php/librarian/view_reference/' . $r->id, $r->title)) ?></td>
								<td><?= ($r->author) ?></td>
								<td>
									<?php
										if($r->category == 'B')
											echo 'Book';
										else if($r->category == 'M')
											echo 'Magazine';
										else if($r->category == 'T')
											echo 'Thesis';
										else if($r->category == 'S')
											echo 'Special Problem';
										else if($r->category == 'C')
											echo 'CD/DVD';
										else if($r->category == 'J')
											echo 'Journal';
										?>
								</td>
								<td>
									<?php
										if($r->access_type == 'F')
											echo 'Faculty';
										else if($r->access_type == 'S')
											echo 'Student';
									?>
								</td>
								<td><?= $r->times_borrowed ?></td>
								<td><?= $r->total_available . ' / ' . $r->total_stock ?></td>
								<td>
									<?php
										if($r->for_deletion == 'F')
											echo 'Available';
										else if($r->for_deletion == 'T')
											echo 'To be removed';
									?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<center><?= $this->pagination->create_links() ?></center>
				<?= 'Number of rows retrieved: ' . $total_rows ?>
				
			</form>
		<?php } ?>
		<!-- End of form for displaying, deleting, and viewing searched references -->
		
<?= $this->load->view('includes/footer') ?>