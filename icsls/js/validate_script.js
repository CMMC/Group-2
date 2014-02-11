		/*
			The following codes are javascript validations
		*/

		/* Title : 
		 *	Required field
		 *	Any characters(symbols & alphanumeric characters)
		 *  Must have at least one Alphanumeric characters	
		 */
		function validate_title(){
				var title = edit_form.title.value;
				var error = "";

				if(title==""){ 
					error = "Title is required";
					alert(error);
					document.getElementById('title').focus(); 
				}else if(!title.match(/^.*[A-Za-z0-9]{1,}.*$/)){ 
					error = "Must have atleast one alphanumeric character.";
					alert(error); 
					document.getElementById('title').focus();
				}

				if(error=="") return true;
		}

		/* Author : 
		 *	Required field
		 *	Alphabets, spaces, periods, and commas only
		 * 	Must start with an alphabet	
		 */


		function validate_author(){
				var author = edit_form.author.value;
				var error = "";

				if(author==""){ 
					error = "Author is required";
					alert(error);
					document.getElementById('author').focus(); 
				}else if(!author.match(/^[a-zA-Z\ ][a-zA-Z\ \.\,]*$/)){ 
					error = "Alphabet, periods and commas only. Must start with an alphabet.";
					alert(error); 
					document.getElementById('author').focus();
				}
				if(error=="") return true;
		}


		/* ISBN : 
		 *	Numbers and hypens only
		 *  Must start and end with a number
		 *  Length must be 13 characters	
		 */

		function validate_isbn(){
				var isbn = edit_form.isbn.value;
				var error = "";

				if(isbn==""){ 
					return true;
				}else if(!isbn.match(/^[0-9][0-9\-]{11}[0-9]$/)){ 
					error = "Numbers and hypens only. Must start and end with a number. Length must be 13 characters.";
					alert(error); 
					document.getElementById('isbn').focus();
				}
				if(error=="") return true;
		}

		/* Publisher : 
		 *	Any characters(symbols & alphanumeric characters)
		 *  Must have at least one Alphanumeric characters	
		 */

		function validate_publisher(){
				var publisher = edit_form.publisher.value;
				var error = "";

				if(publisher==""){ 
					return true;
				}else if(!publisher.match(/^.*[A-Za-z0-9]{1,}.*$/)){ 
					error = "Must have atleast one alphanumeric character.";
					alert(error); 
					document.getElementById('publisher').focus();
				}

				if(error=="") return true;
		}

		/* Publication year : 
		 *	Numbers only
		 *  Year format : xxxx
		 *  Length: 4	
		 */

		function validate_publication_year(){
				var publication_year = edit_form.publication_year.value;
				var error = "";

				if(publication_year==""){
					return true;
				}else if(!publication_year.match(/^[0-9][0-9][0-9][0-9]$/)){ 
					error = "Four numbers only. Year Format: xxxx";
					alert(error); 
					document.getElementById('publication_year').focus();
				}

				if(error=="") return true;
		}

		/* Course code : 
		 *	Required field
		 *	Uppercase letters and numbers only
		 *  Max length: 6
		 */
		function validate_course_code(){
				var course_code = edit_form.course_code.value;
				var error = "";

				if(course_code==""){ 
					error = "Course code is required";
					alert(error);
					document.getElementById('course_code').focus(); 
				}else if(!course_code.match(/^[A-Z][A-Z0-9]{0,4}[0-9]$/)){ 
					error = "Uppercase letters and numbers only. Max length is six characters.";
					alert(error); 
					document.getElementById('course_code').focus();
				}

				if(error=="") return true;
		}

		/* Description : 
		 *	Any characters(symbols & alphanumeric characters)
		 *  Must have at least one Alphanumeric characters	
		 */


		function validate_description(){
				var description = edit_form.description.value;
				var error = "";

				if(description==""){
					return true; 
				}else if(!description.match(/^.*[A-Za-z0-9]{1,}.*$/)){ 
					error = "Must have atleast one alphanumeric character.";
					alert(error); 
					document.getElementById('description').focus();
				}
				if(error=="") return true;
		}

		/* Total stock : 
		 *	Must be greater or equal to total available	
		 */

		function validate_total_stock(){
				var total_stock = document.getElementById('total_stock');
				var error = "";
				var total_available = document.getElementById('total_available');

				if(parseInt(total_stock.value) < parseInt(total_available.value)){
					error = "Total stock can't be less than the total available.";
					alert(error);
					total_stock.value = parseInt(total_stock.value) + 1;
				}else{
					return true;
				}

		}