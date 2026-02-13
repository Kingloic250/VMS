<?php
include 'header.php';

$errors = [];

$v_id = $_SESSION['v_id'];

// Inserting data

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $contact = $_POST['contact'];
    $id = $_POST['id'];
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];


	$errormsg = '';

	$num_id = random_num(20);



	if (empty($fname)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Full names required';
	}
	elseif (is_numeric($fname)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i>Full name must not be numeric';
	}
	elseif (empty($contact)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Contacts required';
	}
	elseif (!is_numeric($contact)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Contacts must be numeric';
	}
	elseif (empty($id)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> ID number required';
	}
	elseif (strlen($contact) <= 9 && strlen($contact) >= 11) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Contact must be 10 numbers in total';
	}
	elseif (strlen($id) <= 15 && strlen($id) >= 17) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> ID number must be 16 numbers in total';
	}
    elseif (!is_numeric($day)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Day required';
	}
    elseif (is_numeric($month)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Month required';
	}
    elseif (!is_numeric($year)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Year required';
	}
	else {
		$select = mysqli_query($connect,"SELECT *FROM irondo WHERE contact = '$contact'");
		if (mysqli_num_rows($select) == 0) {
			//if (strlen($password) >= 4) {
				$check = mysqli_query($connect,"SELECT *FROM irondo WHERE id_number = '$id'");
				if (mysqli_num_rows($check) == 0) {
					$insert1 = mysqli_query($connect,"INSERT INTO irondo VALUES ('$num_id','$v_id','$fname','$contact','$id','$day','$month','$year')");
					if ($insert1 == true) {
						// header('location:leader1.php');
					} 
					else {
						$errormsg = '<i class="fas fa-exclamation-circle"></i> Unknown Error';
					}
				}
				else {
					$errormsg = '<i class="fas fa-exclamation-circle"></i> This ID number arleady exist';
				}
			// }
			// else {
			// 	$errormsg = '<i class="fas fa-exclamation-circle"></i> Password must be 4 minimum characters';
			// }
		}
		else {
			$errormsg = '<i class="fas fa-exclamation-circle"></i> This Phone number has been taken';
		}
	}
}

// Updating data


if (isset($_POST['update'])) {

	$fname = $_POST['fname'];
    $contact = $_POST['contact'];
    $id = $_POST['id_number'];
	$i_id = $_POST['id'];
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];


    $errormsgs = '';


	if (empty($fname)) {
		$errormsgs = '<i class="fas fa-exclamation-circle"></i> Full names required';
	}
	elseif (is_numeric($fname)) {
		$errormsgs = '<i class="fas fa-exclamation-circle"></i>Full name must not be numeric';
	}
	elseif (empty($contact)) {
		$errormsgs = '<i class="fas fa-exclamation-circle"></i> Contacts required';
	}
	elseif (!is_numeric($contact)) {
		$errormsgs = '<i class="fas fa-exclamation-circle"></i> Contacts must be numeric';
	}
	elseif (empty($id)) {
		$errormsgs = '<i class="fas fa-exclamation-circle"></i> ID number required';
	}
	elseif (strlen($contact) <= 9 && strlen($contact) >= 11) {
		$errormsgs = '<i class="fas fa-exclamation-circle"></i> Contact must be 10 numbers in total';
	}
	elseif (strlen($id) <= 15 && strlen($id) >= 17) {
		$errormsgs = '<i class="fas fa-exclamation-circle"></i> ID number must be 16 numbers in total';
	}
    elseif (!is_numeric($day)) {
		$errormsgs = '<i class="fas fa-exclamation-circle"></i> Day required';
	}
    elseif (is_numeric($month)) {
		$errormsgs = '<i class="fas fa-exclamation-circle"></i> Month required';
	}
    elseif (!is_numeric($year)) {
		$errormsgs = '<i class="fas fa-exclamation-circle"></i> Year required';
	}
    else {
            $update = mysqli_query($connect,"UPDATE irondo SET fname = '$fname',contact = '$contact',i_day = '$day',i_month = '$month',i_year = '$year' WHERE id = '$i_id'");
            if ($update == true) {
				// automaticaly update
			}
			else {
				$errormsgs = '<i class="fas fa-exclamation-circle"></i> Unknown Error';
			}
        }
}







$m_id = $_SESSION['m_id'];

$start = 0;

$rows_per_page = 4;

$records = mysqli_query($connect,"SELECT *FROM irondo JOIN village ON (irondo.v_id=village.v_id)  JOIN mudugudu ON (mudugudu.v_id=village.v_id) WHERE m_id = '$m_id'");

$nbr_rows = mysqli_num_rows($records);

$pages = ceil($nbr_rows / $rows_per_page);

if (isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;

    $start = $page * $rows_per_page;
}


$retreive = mysqli_query($connect,"SELECT *FROM irondo JOIN village ON (irondo.v_id=village.v_id)  JOIN mudugudu ON (mudugudu.v_id=village.v_id) WHERE m_id = '$m_id' LIMIT $start,$rows_per_page");

?>
<title>VMS - Manage Security</title>
<!------main-content-start-----------> 
<body onload="myFunction()" style="margin:0;">
<div id="loader"></div>
<div style="display:none;" id="myDiv" class="animate-bottom">
<div class="main-content">
			     <div class="row">
				    <div class="col-md-12">
					   <div class="table-wrapper">
					     
					   <div class="table-title">
					     <div class="row">
						     <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
							    <h2 class="ml-lg-2">Manage The Securities (Irondo)</h2>
							 </div>
							 <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
							   <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
								<i class="fas fa-add"></i>
							   <span>Add New Security</span>
							   </a>
							 </div>
					     </div>
					   </div>
					   <?php
					   if (mysqli_num_rows($retreive) > 0) {
					   ?>
					   <table class="table table-striped table-hover">
					      <thead>
						     <tr>
							 <th><span class="custom-checkbox">
							 <input type="checkbox" id="selectAll">
							 <label for="selectAll"></label></th>
							 <th>Full Names</th>
							 <th>Village address</th>
							 <th>Contacts</th>
                             <th>ID number</th>
                             <th>Registed Date</th>
							 <th>Actions</th>
							 </tr>
						  </thead>
						
						  <tbody>
							<?php
							while ($get = mysqli_fetch_assoc($retreive)) {
							?>
						      <tr>
							 <th><span class="custom-checkbox">
							 <input type="checkbox" id="checkbox1" name="option[]" value="1">
							 <label for="checkbox1"></label></th>
							 <th><?php echo $get['fname'] ?></th>
							 <th><?php echo $get['village'] ?></th>
							 <th>0<?php echo $get['contact'] ?></th>
							 <th><?php echo $get['id_number'] ?></th>
                             <th><?php echo $get['i_day'] ."-".$get['i_month']."-".$get['i_year'] ?></th>
							 <th>
                                <button id="<?php echo $get['id']; ?>" type="button" data-toggle="modal" data-target="#editEmployeeModal" class="edit">	
							    <i class="fas fa-edit" data-toggle="tooltip" title="Edit"></i>
							   </button>
							   <button data-id="<?php echo $get['id']; ?>" type="button" data-toggle="modal" data-target="#deleteEmployeeModal" class="delete">
							   <i class="fas fa-trash" data-toggle="tooltip" title="Delete"></i>
							   </button>
							 </th>
							 </tr>
							 <?php
							 }
							 ?>
					   </tbody>
						  <?php
					   }
					   else {
						$errors[] = '<h4><i class="fas fa-exclamation-circle"></i> No records available</h4>';
					   }
					   ?>

</table>
<div class="box">
                        
        <?php if (!empty($errors)): ?>
            <div class="danger btn-danger">
                <?php foreach ($errors as $error):
                    echo $error;
                endforeach ?>
            </div>
        <?php endif ?>
    </div>

							   <!----add-modal start--------->
                               <div class="modal fade" tabindex="-1" id="addEmployeeModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Security</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <?php
	  if (!empty($errormsg)) {
		?>
		<div class="alert alert-danger">
			<?php echo $errormsg; ?>
		</div>
		<?php
	  }
	  ?>
      <form action="#" method="post">
      <div class="modal-body">
        <div class="form-group">
		    <label>Full name</label>
			<input type="text" name="fname" class="form-control" required>
		</div>
		<div class="form-group">
		    <label>Contact</label>
			<input type="text" name="contact" class="form-control" required>
		</div>
        <div class="form-group">
		    <label>ID number</label>
			<input type="text" name="id" class="form-control" required>
		</div>
        <div class="form-group">
				<label>Igihe yaziye (Italiki)</label>
				<select name="day" class="form-control" id="day">
					<option>-- Choose day --</option>
					<?php
					$x = 1;
					while ($x <= 31) {
						echo "<option>".$x."</option>";
						$x++;
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label>Igihe yaziye (Ukwezi)</label>
				<select name="month" class="form-control" id="month">
					<option value="1">-- Choose month --</option>
					<?php
					$x = 0;
					$months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
					while ($x <= 11) {
						echo "<option>".$months[$x]."</option>";
						$x++;
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label>Igihe yaziye (Umwaka)</label>
				<select name="year" class="form-control" id="year">
					<option>-- Choose year --</option>
					<?php
					$x = 2010;
					$nyear = date('Y');
					while ($x <= $nyear) {
						echo "<option>".$x."</option>";
						$x++;
					}
					?>
				</select>
			</div>
        </div>
      <div class="modal-footer">
        <button type="button" name="cancel" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" name="submit" class="btn btn-success">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>

					   <!----edit-modal end--------->
					   
					   
					   
					   
					   
				   <!----edit-modal start--------->
		<div class="modal fade" tabindex="-1" id="editEmployeeModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Security</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <?php
	  if (!empty($errormsgs)) {
		?>
		<div class="alert alert-danger">
			<?php echo $errormsgs; ?>
		</div>
		<?php
	  }
	  ?>
      <form action="#" method="post">
        <div class="modal-body">
        <div class="form-group">
		    <label>Full name</label>
			<input type="text" name="fname" id="fname" class="form-control" required>
		</div>
		<div class="form-group">
		    <label>Contact</label>
			<input type="text" name="contact" id="contact" class="form-control" required>
		</div>
        <div class="form-group">
		    <label>ID number</label>
			<input type="text" name="id_number" id="id_number" class="form-control" required>
		</div>
        <div class="form-group">
			<label>Igihe yaziye (Italiki)</label>
				<select name="day" class="form-control" id="day">
					<option>-- Choose day --</option>
					<?php
					$x = 1;
					while ($x <= 31) {
						echo "<option>".$x."</option>";
						$x++;
					}
					?>
				</select>
		</div>
			<div class="form-group">
				<label>Igihe yaziye (Ukwezi)</label>
				<select name="month" class="form-control" id="month">
					<option value="1">-- Choose month --</option>
					<?php
					$x = 0;
					$months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
					while ($x <= 11) {
						echo "<option>".$months[$x]."</option>";
						$x++;
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label>Igihe yaziye (Umwaka)</label>
				<select name="year" class="form-control" id="year">
					<option>-- Choose year --</option>
					<?php
					$x = 2010;
					$nyear = date('Y');
					while ($x <= $nyear) {
						echo "<option>".$x."</option>";
						$x++;
					}
					?>
				</select>
			</div>
            <input type="hidden" class="form-control" id="id" name="id">
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" name="update" class="btn btn-success">update</button>
      </div>
      </form>
    </div>
  </div>
</div>

					   <!----edit-modal end--------->	   
					   
					   
					 <!----delete-modal start--------->
		<div class="modal fade" tabindex="-1" id="deleteEmployeeModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Security (irondo)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this record ?</p>
		<p class="text-danger"><small>This action can not be undone</small></p>
      </div>
      <div class="modal-footer">
	    <input type="hidden" name="id" value="">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a data-id=""><button class="btn btn-danger confirm-delete">Delete Anyway</button></a>
      </div>
    </div>
  </div>
</div>

<div class="clearfix">
<?php
                        if (!isset($_GET['page-nr'])) {
                            $page = 1;
                        }
                        else {
                            $page = $_GET['page-nr'];
                        }
                        ?>
					     <div class="hint-text">showing <b><?php echo $page ?></b> out of <b><?php echo $pages; ?></b></div>
					     <ul class="pagination">


                            <li class="page-item "><a href="?page-nr=1" class="page-link">First</a></li>



                            <?php
                            if (isset($_GET['page_nr'])) {
                                ?>
                                <li class="page-item "><a href="?page-nr=<?php echo $_GET['page-nr'] - 1; ?>" class="page-link">Previous</a></li>
                                <?php
                            }
                            else {
                                ?>
                                <li class="page-item "><a class="page-link">Previous</a></li>
                                <?php
                            }
                            ?>
                            <?php
                                for ($counter = 1; $counter <= $pages; $counter++) { 
                                    ?>
                                    <li class="page-item "><a href="?page-nr=<?php echo $counter ?>"class="page-link"><?php echo $counter ?></a></li>
                                    <?php
                                }
                            ?>
                            

                            <?php
                            if (!isset($_GET['page-nr'])) {
                                ?>
                                <li class="page-item "><a href="?page-nr=1" class="page-link">Next</a></li>
                                <?php
                            }
                            else {
                                if ($_GET['page-nr'] >= $pages) {
                                    ?>
                                    <li class="page-item "><a class="page-link">Next</a></li>
                                    <?php
                                }
                                else {
                                    ?>
                                    <li class="page-item "><a href="?page-nr=<?php echo $_GET['page-nr'] + 1; ?>" class="page-link">Next</a></li>
                                    <?php
                                }
                            }
                            ?>
                            <li class="page-item "><a href="?page-nr=<?php echo $pages ?>" class="page-link">Last</a></li>
						 </ul>
					   </div>
					   



                       <script src="/vms/js/script.js"></script>
					   <!----edit-modal end--------->   

</div>
<?php
                          include 'footer.php';
                        ?>
<style>
	h4{
		font-size: 17px;
		margin-left: 10px;
		padding: 6px;
	}
	.danger {
		padding: 6px;
		cursor: default;
	}
	th{
        font-weight: 700;
    }
    .fa-edit{
        color: lightgreen;
        transition: .2s;
    }
    .fa-edit:hover{
        color: #333;
    }
    .trash{
        color: #FF5D5D;
        transition: .2s;
    }
    .trash:hover{
        color: #333;
    }
	.delete{
		background: transparent;
		border: none;
	}
    .edit{
		background: transparent;
		border: none;
	}
</style>


<script>
	$('.delete').on('click' , function (e) {
		let id = $(this).attr('data-id');
		$('.confirm-delete').attr('data-id' ,id);
	});
	$(".confirm-delete").on('click', function (e) {
		let id = $(this).attr('data-id');
		console.log(id);
		location.href = "deleteiro.php?id= "+id;
	});


    $(document).ready(function() {

        // fetching data from database inside update form modal using javaScript

        $(document).on('click', '.edit', function(){  
        var id = $(this).attr("id");  
        $.ajax({  
                url:"fetch.php",  
                method:"POST",  
                data:{fetch: 1,id:id},  
                dataType:"json",  
                success:function(data){  
                    $('#editEmployeeModal #fname').val(data.fname); 
                    $('#editEmployeeModal #contact').val(data.contact);
                    $('#editEmployeeModal #id_number').val(data.id_number);
                    $('#editEmployeeModal #day').val(data.i_day); 
                    $('#editEmployeeModal #month').val(data.i_month); 
                    $('#editEmployeeModal #year').val(data.i_year);  
                    $('#editEmployeeModal #id').val(data.id);  
                }  
            });  
        });
    });
</script>