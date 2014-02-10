<?php $this->load->view('includes/header') ?>
		<h3>Add a Reference</h3>
        <div id="addReferenceForm">
            <?= form_open('librarian/add_reference/'); ?>
                <label for="inputTitle">Title</label>
                <input name="title" type="text" id="inputNum" required>
                <br/>
                <label for="inputAuthor">Author</label>
                <input name="author" type="text" id="inputAuthor" required>
                <br/>
                <label for="inputISBN">ISBN</label>
                <input name="isbn" type="text" id="inputISBN">
                <br/>
                <label for="inputCategory">Category</label>
                <select name="category" id="inputCategory" required>
                    <option value="B" selected>Book</option>
                    <option value="M">Magazine</option>
                    <option value="T">Thesis</option>
                    <option value="S">Special Problem</option>
                    <option value="C">CD/DVD</option>
                    <option value="J">Journal</option>
                </select> 
                <br/>
                <label for="inputDesc">Description</label><br/> 
                <textarea rows="4" cols="50" name="description" id="inputDesc"></textarea>
                <br/>                               
                <label for="inputPublisher">Publisher</label>
                <input name="publisher" type="text" id="inputPublisher">
                <br/>
                <label for="inputyear">Publication Year</label>
                <input type="number" name="year" id="inputYear" min="1900" max="2014">
                <br/>
                <label for="inputAccess">Access Type</label>
                <select name="access_type" id="inputAccess" required>
                    <option value="S" selected>Student</option>
                    <option value="F">Faculty</option>
                </select>
                <br/>
                <label for="inputCoursecode">Course Code</label>
                <input name="course_code" type="text" id="inputCoursecode" required>
                <br/>       
                <label for="inputTotalSt">Total Stock</label>
                <input type="number" name="total_stock" id="inputTotalSt" min="1" required>
                <br/>  
                <br/>
                <br/>
                <input type="submit" name="submit" value="Submit">                  
            <?= form_close(); ?>
            <a href="<?= site_url('librarian/index') ?>">Back</a>
        </div>
<?php $this->load->view('includes/footer') ?>