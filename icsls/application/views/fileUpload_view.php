<?php $this->load->view('includes/header'); ?>
		<h3>Upload a File</h3>
        <div id="fileUploadForm">
			<?= form_open_multipart('librarian/file_upload');?>  
				<label for="csvfile">Upload a .csv file only</label>
				<br/>
				<input type="file" name="csvfile" value="" placeholder="" required>
				<br/> 
				<input type="submit" value="Upload" name="upload">
			<?= form_close(); ?>
        </div>
		<a href="<?= site_url('librarian/index') ?>">Back</a>
<?php $this->load->view('includes/footer'); ?>