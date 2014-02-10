<?= $this->load->view('includes/header') ?>
		<h3>Your file was successfully uploaded!</h3>
		<?= form_open('librarian/add_multipleReferences/'); ?>
			<table border="1px" cellpadding="0" cellspacing="0" width="100%">
			    <tr>
		            <td>TITLE</td>
		            <td>AUTHOR</td>
		            <td>ISBN</td>
		            <td>CATEGORY</td>
		            <td>DESCRIPTION</td>
		            <td>PUBLISHER</td>
		            <td>PUBLICATION YEAR</td>
		            <td>ACCESS TYPE</td>
		            <td>COURSE CODE</td>
		            <td>TOTAL STOCK</td>
			    </tr>
		        <?php $i=0; foreach($csvData as $field): ?>		
		            <tr>
		                <td><input type="text" name="<?= 'title'.$i?>" value="<?= $field['TITLE']?>" required></td>
		                <td><input type="text" name="<?= 'author'.$i?>" value="<?= $field['AUTHOR']?>" required></td>
		                <td><input type="text" name="<?= 'isbn'.$i?>" value="<?= $field['ISBN']?>"></td>
		                <td>
							<select name="<?= 'category'.$i?>" required>
								<option value="B" selected>Book</option>
								<option value="M">Magazine</option>
								<option value="T">Thesis</option>
								<option value="S">Special Problem</option>
								<option value="C">CD/DVD</option>
								<option value="J">Journal</option>
							</select> 
		                </td>
		                <td><input type="text" name="<?= 'description'.$i?>" value="<?= $field['DESCRIPTION']?>"></td>
		                <td><input type="text" name="<?= 'publisher'.$i?>" value="<?= $field['PUBLISHER']?>"></td>
		                <td><input type="number" name="<?= 'year'.$i?>" value="<?= $field['PUBLICATION_YEAR']?>" min="1900" max="2014"></td>
		                <td>
							<select name="<?= 'access_type'.$i?>" required>
								<option value="S" selected>Student</option>
								<option value="F">Faculty</option>
							</select>
		                </td>
		                <td><input type="text" name="<?= 'course_code'.$i?>" value="<?= $field['COURSE_CODE']?>" required></td>
		                <td><input type="number" name="<?= 'total_stock'.$i?>" value="<?= $field['TOTAL_STOCK']?>" min="1" required></td>
		            </tr>
		            <?php $i++; ?>
		        <?php endforeach; ?> 
		        <input type="hidden" name="rowCount" value="<?= $i; ?>">
			</table>

			<input type="submit" name="submit" value="Submit">    
		<?= form_close(); ?>
		<p><?php echo anchor('librarian/file_upload', 'Back'); ?></p>
<?= $this->load->view('includes/footer') ?>