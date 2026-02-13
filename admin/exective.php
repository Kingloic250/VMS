<?php
include 'header.php';
include '../connection/function.php';

$errors = [];

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $contact = $_POST['contact'];
	$email = $_POST['email'];
    $address = $_POST['address'];
    $id = $_POST['id'];
	$password = $_POST['password'];

	$user_id = random_num(20);

	$errormsg = '';

	if (empty($fname)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Full Name required';
	}
	elseif (is_numeric($fname)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i>Full Name must not be numeric';
	}
	elseif (is_numeric($email)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Email required';
	}
	elseif (empty($contact)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Contacts required';
	}
	elseif (!is_numeric($contact)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Contacts must be numeric';
	}
	elseif (empty($address)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Address required';
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
	else {
		$select = mysqli_query($connect,"SELECT *FROM exective WHERE contact = '$contact'");
		if (mysqli_num_rows($select) == 0) {
			if (strlen($password) >= 4) {
				$check = mysqli_query($connect,"SELECT *FROM exective WHERE id_num = '$id'");
				if (mysqli_num_rows($check) == 0) {
					$d_id = $_SESSION['d_id'];
					$select1 = mysqli_query($connect,"SELECT * FROM exective WHERE email = '$email'");
					if (mysqli_num_rows($select1) == 0) {
                        if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
                            $row = mysqli_query($connect,"SELECT *FROM exective WHERE cell_id = '$address'");
                            if (mysqli_num_rows($row) == 0) {
                                $insert1 = mysqli_query($connect,"INSERT INTO exective VALUES ('$user_id','$address','$fname','$email','$contact','$id','$password')");
                                if ($insert1 == true) {
                                    // header('location:leader1.php');
                                } 
                                else {
                                    $errormsg = '<i class="fas fa-exclamation-circle"></i> Unknown Error';
                                }
                            }
                            else {
                                $errormsg = '<i class="fas fa-exclamation-circle"></i> This Cell has leader';
                            }
                        }
                        else {
                            $errormsg = '<i class="fas fa-exclamation-circle"></i> This email format does not exist';
                        }
					}
					else {
						$errormsg = '<i class="fas fa-exclamation-circle"></i> This email exist in database';
					}
				}
				else {
					$errormsg = '<i class="fas fa-exclamation-circle"></i> This ID number has been taken';
				}
			}
			else {
				$errormsg = '<i class="fas fa-exclamation-circle"></i> Password must be 4 minimum characters';
			}
		}
		else {
			$errormsg = '<i class="fas fa-exclamation-circle"></i> This Phone number has been taken';
		}
	}
}


if (isset($_POST['update'])) {

	$user_id = $_POST['user_id'];
    $fname = $_POST['fname'];
    $contact = $_POST['contact'];
	$email = $_POST['email'];
    $id = $_POST['id'];
	$password = $_POST['password'];


    $errormsgs = '';


	if (empty($fname)) {
		$errormsgs = '<i class="fas fa-exclamation-circle"></i> Full names required';
	}
	elseif (is_numeric($fname)) {
		$errormsgs = '<i class="fas fa-exclamation-circle"></i>Full name must not be numeric';
	}
	elseif (is_numeric($email)) {
		$errormsgs = '<i class="fas fa-exclamation-circle"></i> email required';
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
	elseif (strlen($password) <= 3){
		$errormsgs = '<i class="fas fa-exclamation-circle"></i> Password must be 4 minimum characters';
	}
    else {
        if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $update = mysqli_query($connect,"UPDATE exective SET fullname = '$fname',contact = '$contact',email = '$email',id_num = '$id',password = '$password' WHERE e_id = '$user_id'");
            if ($update == true) {
				// automaticaly update
			}
			else {
				$errormsgs = '<i class="fas fa-exclamation-circle"></i> Unknown Error';
			}
        }
        else {
            $errormsgs = '<i class="fas fa-exclamation-circle"></i> This email format does not exist';
        }
    }
}








$d_id = $_SESSION['d_id'];

$start = 0;

$rows_per_page = 4;

$records = mysqli_query($connect,"SELECT *FROM exective JOIN cell_table ON (exective.cell_id=cell_table.cell_id) JOIN sector ON (sector.s_id=cell_table.s_id) WHERE d_id = '$d_id'");

$nbr_rows = mysqli_num_rows($records);

$pages = ceil($nbr_rows / $rows_per_page);

if (isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;

    $start = $page * $rows_per_page;
}


$retreive = mysqli_query($connect,"SELECT *FROM exective JOIN cell_table ON (exective.cell_id=cell_table.cell_id) JOIN sector ON (sector.s_id=cell_table.s_id) WHERE d_id = '$d_id' LIMIT $start,$rows_per_page");
$fetch = mysqli_query($connect,"SELECT *FROM sector WHERE d_id = '$d_id'");
$now = mysqli_fetch_assoc($fetch);
$sector= $now['s_id'];
?>
<title>VMS - Manage Leaders</title>
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
							    <h2 class="ml-lg-2">Manage the Leaders (Exective)</h2>
							 </div>
							 <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
							   <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
								<i class="fas fa-add"></i>
							   <span>Add New Leader</span>
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
							 <th>Cell address</th>
                             <th>Email</th>
							 <th>Contacts</th>
                             <th>ID number</th>
							 <th>Actions</th>
							 </tr>
						  </thead>
						
						  <tbody>
							<?php
							while ($get = mysqli_fetch_assoc($retreive)) {
							?>
						      <tr>
							 <th>
							 <label for="checkbox1"></label></th>
							 <th><?php echo $get['fullname'] ?></th>
							 <th><?php echo $get['cell'] ?></th>
                             <th><?php echo $get['email'] ?></th>
							 <th>0<?php echo $get['contact'] ?></th>
							 <th><?php echo $get['id_num'] ?></th>
							 <th>
							   <button id="<?php echo $get['e_id']; ?>" type="button" data-toggle="modal" data-target="#editEmployeeModal" class="edit">
							   <i class="fas fa-edit" data-toggle="tooltip" title="Edit"></i>
							   </button>
							   <button data-id="<?php echo $get['e_id']; ?>" type="button" data-toggle="modal" data-target="#deleteEmployeeModal" class="delete">
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
        <h5 class="modal-title">Add a leader</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <?php
	  if (isset($errormsg)) {
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
		    <label>Cell</label>
			<select name="address" class="form-control" id="">
				<option>-- Choose Cell --</option>
				<?php
				$sql1 = mysqli_query($connect,"SELECT cell_id,cell FROM cell_table JOIN sector ON (cell_table.s_id=sector.s_id) WHERE d_id = '$d_id'");
				while ($ret = mysqli_fetch_assoc($sql1)) {
					echo "<option value='".$ret['cell_id']."'>".$ret['cell']."</option>";
				}
				?>
			</select>
		</div>
		<div class="form-group">
		    <label>Contact</label>
			<input type="text" name="contact" class="form-control" required>
		</div>
		<div class="form-group">
		    <label>Email</label>
			<input type="text" name="email" class="form-control" required>
		</div>
        <div class="form-group">
		    <label>ID number</label>
			<input type="text" name="id" class="form-control" required>
		</div>
		<div class="form-group">
		    <label>Password</label>
			<input type="password" name="password" class="form-control" required>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" name="cancel" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" name="submit" class="btn btn-success">Register</button>
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
        <h5 class="modal-title">Edit Leader (Exective)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php
	  if (isset($errormsgs)) {
		?>
		<div class="alert alert-danger">
			<?php echo $errormsgs; ?>
		</div>
		<?php
	  }
	  ?>
      <form method="post">
      <div class="modal-body">
        <div class="form-group">
		    <label>Full name</label>
			<input type="text" name="fname" class="form-control" id="fname">
		</div>
        <div class="form-group">
		    <label>Cell</label>
			<input type="text" name="cell" class="form-control" id="cell">
		</div>
		<div class="form-group">
		    <label>Contact</label>
			<input type="text" name="contact" class="form-control" id="contact">
		</div>
		<div class="form-group">
		    <label>email</label>
			<input type="text" name="email" class="form-control" id="email">
		</div>
        <div class="form-group">
		    <label>ID number</label>
			<input type="text" name="id" class="form-control" id="id_num">
		</div>
		<div class="form-group">
		    <label>Password</label>
			<input type="text" name="password" class="form-control" id="password">
		</div>
		<input type="hidden" name="user_id" id="user_id">
      </div>
      <div class="modal-footer">
        <button type="button" name="cancel" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" name="update" class="btn btn-success">Update</button>
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
        <h5 class="modal-title">Delete Leader (Exective)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this record</p>
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
					     <div class="hint-text">showing <b><?php echo $page ?></b> of <b><?php echo $pages; ?></b></div>
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
                                <li class="page-item "><a href="?page-nr=2" class="page-link">Next</a></li>
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
		location.href = "delete.php?id= "+id;
	});

	$(document).ready(function() {

// fetching data from database inside update form modal using javaScript

        $(document).on('click', '.edit', function(){  
           var user_id = $(this).attr("id");  
           $.ajax({  
                url:"update.php",  
                method:"POST",  
                data:{fetch: 1,user_id:user_id},  
                dataType:"json",  
                success:function(data){  
                     $('#editEmployeeModal #fname').val(data.fullname);
                     $('#editEmployeeModal #cell').val(data.cell); 
					 $('#editEmployeeModal #contact').val(data.contact);
					 $('#editEmployeeModal #email').val(data.email); 
					 $('#editEmployeeModal #id_num').val(data.id_num);
					 $('#editEmployeeModal #password').val(data.password);
                     $('#editEmployeeModal #user_id').val(data.e_id);  
                }  
            });  
        });

});
</script>