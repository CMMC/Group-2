<?=$this->load->view('includes/header')?>
	<div id='search_container'>
		Search Account:
		<form action="<?=base_url().'index.php/administrator/search_accounts'?>" method='post'>
			<input type='text' id='search_text' name='search_text' title='Must be 4-30 characters.' pattern='[a-z]{1,1}[a-z0-9_]{3,29}' required/>

			<select id='category' name='category' onchange='changeUserSearchTextCriteria()' onload='changeUserSearchTextCriteria()'>
				<option value='username'>Username</option>
				<option value='student_number'>Student Number</option>
				<option value='employee_number'>Employee Number</option>
				<option value='first_name'>First Name</option>
				<option value='last_name'>Last Name</option>
			</select>

			<input type='submit' name='submit'/>
		</form>
	</div>
	
	<div id='category_option_container'>
		<form action="<?=base_url().'index.php/administrator/view_accounts'?>" method='post'>
			Sort by:
				<select id='account_type' name='account_type' onchange='this.form.submit()'>
					<option value='last_name'>Last Name</option>
					<option value='first_name'>First Name</option>
					<option value='employee_number'>Employee Number</option>
					<option value='student_number'>Student Number</option>
					<option value='user_type'>User Type</option>
				</select>
		</form>
	</div>

	<div id='search_result_container'>
		<?php if(isset($searchText)){ ?>
			Found <?=$accountCount?> with <?=$searchCategory?> '<?=$searchText?>'
			<?php if($accountCount > 0) { ?>
			<?=$this->pagination->create_links()?>
			<table>
				<tr>
					<td>No.</td>
					<td>Employee Number</td>
					<td>Student Number</td>
					<td>Last Name</td>
					<td>First Name</td>
					<td>Middle Name</td>
					<td>Account Type</td>
					<td>Action</td>
				</tr>

			<?php
				$i = 1;
				foreach ($accounts as $account) { ?>
					
						<tr>
							<td><?=$i++?></td>
							<td><?=($account->employee_number != NULL ? $account->employee_number : "--")?>
							</td>
							<td><?=($account->student_number != NULL ? $account->student_number : "--")?>
							</td>
							<td><?=$account->last_name?></td>
							<td><?=$account->first_name?></td>
							<td><?=$account->middle_name?></td>
							<td><?php
									if($account->user_type == 'A'){
										echo "Administrator";
									}else if($account->user_type == 'L'){
										echo "Librarian";
									}else if($account->user_type == 'F'){
										echo "Faculty";
									}else if($account->user_type == 'S'){
										echo "Student";
									}
								?>
							</td>
							<td>
								<a href="<?=base_url().'index.php/administrator/view_user_profile/'.$account->username?>">
									<button>View Profile</button>
								</a>
							</td>
						</tr>
				<?php }
			} ?>
			</table>
		<?php } ?>
	</div>

<?=$this->load->view('includes/footer')?>