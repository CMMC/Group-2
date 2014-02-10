<?= $this->load->view('includes/header') ?>
	<a href="<?= site_url('librarian/add_reference') ?>">Add Reference</a>
	<a href="<?= site_url('librarian/file_upload') ?>">File Upload</a>
	<?= anchor(base_url() . 'index.php/librarian', 'Back') ?>
<?= $this->load->view('includes/footer') ?>