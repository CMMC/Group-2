<!DOCTYPE html>
<html>
	<head>
		<title><?= $title ?></title>
	</head>
	<body>
		<?php if(isset($status)) { ?>
			<h1>Account added</h1>
		<?php unset($status);
			} ?>

		<form action = '<?= base_url() . 'index.php/tester/create_user' ?>' method = "POST">
			<label for = 'fname'>First Name: </label>
			<input type = 'text' id = 'fname' name = 'first' /><br />
			<label for = 'mname'>Middle Name: </label>
			<input type = 'text' id = 'mname' name = 'middle' /><br />
			<label for = 'lname'>Last Name: </label>
			<input type = 'text' id = 'lname' name = 'last'/><br />
			<label for = 'empno'>Employee Number</label>
			<input type = 'text' id = 'empno' name = 'empNo' /><br />
			<select name = 'type'>
				<option value = 'F'>Faculty</option>
				<option value = 'T'>Student</option>
				<option value = 'L'>Librarian</option>
			</select>
			<br />
			<label for = 'uname'>Username: </label>
			<input type = 'text' id = 'uname' name = 'username' /><br />
			<label for = 'pword'>Password: </label>
			<input type = 'password' id = 'pword' name = 'password' /><br />
			<label for = 'colladd'>College Address: </label>
			<input type = 'text' id = 'colladd' name = 'college_add' /><br />
			<label for = 'email'>Email Address: </label>
			<input type = 'email' id = 'email' name = 'email_add' /><br />

			<label>College</label>
			<select name = 'college'>
				<option value = 'CAS'>College of Arts and Sciences(CAS)</option>
				<option value = 'CA'>College of Agriculture(CA)</option>
				<option value = 'CDC'>College of Development Communication(CDC)</option>
				<option value = 'CFNR'>College of Forestry and Natural Resources(CFNR)</option>
				<option value = 'CEAT'>College of Engineering and Agro-Industrial Technology(CEAT)</option>
				<option value = 'CHE'>College of Human Ecology(CHE)</option>
				<option value = 'CVM'>College of Veterinary Medicine(CVM)</option>
			</select>
			<br />
			<label for = 'degree'>Degree</label>
			<input type = 'degree' id = 'degree' name = 'degree' /><br />
			<input type = 'submit' value = 'SUBMIT' />
		</form>
	</body>
</html>