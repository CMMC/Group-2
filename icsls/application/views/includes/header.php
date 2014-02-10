<!DOCTYPE html>

<html>
	<head>
		<title><?=$title?></title>
		<!-- Link stylesheets here -->
	</head>
	<body>

	<div>
		<?php if($this->session->userdata('loggedIn')){ ?>
			Hi <?=$this->session->userdata('username')?>!
			<br/>
			<a href="<?=base_url().'index.php/logout'?>">
				<button>Logout</button>
			</a>
		<?php }else{ ?>
			<form action="<?=base_url().'index.php/login'?>" method='post'>
				Username: <input type='text' name='username' required/>
				Password: <input type='password' name='password' required/>
				<input type='submit' name='submit' value='submit'/>
			</form>
		<?php } ?>
	</div>