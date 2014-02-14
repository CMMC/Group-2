<?php $this->load->view('includes/header'); ?>
	<?= anchor(base_url() . 'index.php/librarian/search_reference_index', 'Search Reference') ?>
	<?= anchor(base_url() . 'index.php/librarian/add_reference_index', 'Add Reference') ?>
	<?= anchor(base_url() . 'index.php/librarian/view_report_index', 'Generate Report') ?>
<?php $this->load->view('includes/footer'); ?>