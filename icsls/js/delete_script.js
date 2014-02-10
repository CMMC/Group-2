//Confirm to Delete the selected books
function confirmDelete(){
	var noOfBooksToDelete = $('#booktable').find("input:checkbox:checked").length;
	if(noOfBooksToDelete > 0){
		var option= confirm("Are you Sure?");
		if(option==true){		
			alert(noOfBooksToDelete+" Book"+((noOfBooksToDelete>1)?'s':'')+" Selected.");
		}else{
			return false;
		}
	}else{
		alert("No books selected.");
		return false;
		}
	}

//Confirm To Delete Ready for Deletion Books
function confirmDeleteReady(){
	var noOfBooksToDelete = $('#readytodeletetable').find("input:checkbox:checked").length;
	if(noOfBooksToDelete > 0){
		var option= confirm("Are you Sure?");
		if(option==true){		
			alert(noOfBooksToDelete+" Book"+((noOfBooksToDelete>1)?'s':'')+" Selected.");
		}else{
			return false;
		}
	}else{
		alert("No books selected.");
		return false;
		}
	}

//Confirm to change the ForDeletion 
function confirmChangeForDeletion(){
	var noOfBooksToDelete = $('#booktable').find("input:checkbox:checked").length;
	if(noOfBooksToDelete > 0){
		var option= confirm("Are you Sure?");
		if(option==true){		 
			alert(noOfBooksToDelete+" Book"+((noOfBooksToDelete>1)?'s':'')+" Selected.");
		}else{
			return false;
		}
	}else{
		alert("No books selected.");
		}
	}
	
//Mark All checkboxes when choosing
$('#markAll').click(function (){
	var buttonText = $('#markAll').text();
	if(buttonText === 'Mark All'){
		$('#booktable').find('input[name="ch[]"]').each(function(){
			$(this).prop('checked', true);
		});
		$('#markAll').text('UnMark All');
	}
	else if(buttonText === 'UnMark All'){
		$('#booktable').find('input[name="ch[]"]').each(function(){
			$(this).prop('checked', false);
		});
		$('#markAll').text('Mark All');
	}
});
$('#markAlla').click(function (){
	var buttonText = $('#markAlla').text();
	if(buttonText === 'Mark All'){
		$('#readytodeletetable').find('input[name="chch[]"]').each(function(){
			$(this).prop('checked', true);
		});
		$('#markAlla').text('UnMark All');
	}
	else if(buttonText === 'UnMark All'){
		$('#readytodeletetable').find('input[name="chch[]"]').each(function(){
			$(this).prop('checked', false);
		});
		$('#markAlla').text('Mark All');
	}
});
		