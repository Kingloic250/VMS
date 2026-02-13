<?php
include 'header.php';

$errors = [];

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $contact = $_POST['contact'];
	$gender = $_POST['gender'];
    $address = $_POST['address'];
    $id = $_POST['id'];
	$password = $_POST['password'];

	$user_id = random_num(20);

	$errormsg = '';

	if (empty($fname)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Full names required';
	}
	elseif (is_numeric($fname)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i>Full name must not be numeric';
	}
	elseif (is_numeric($gender)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Gender required';
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
		$select = mysqli_query($connect,"SELECT *FROM mudugudu WHERE phones = '$contact'");
		if (mysqli_num_rows($select) == 0) {
			if (strlen($password) >= 4) {
				$check = mysqli_query($connect,"SELECT *FROM mudugudu WHERE id_num = '$id'");
				if (mysqli_num_rows($check) == 0) {
					$cell_id = $_SESSION['cell_id'];
					$query = mysqli_query($connect,"SELECT *FROM village WHERE v_id = '$address'");
					$data = mysqli_fetch_assoc($query);
					$village = $data['village'];
					$query1 = mysqli_query($connect,"SELECT *FROM cell_table WHERE cell_id = '$cell_id'");
					$row = mysqli_fetch_assoc($query1);
					$cell = $row['cell'];
					$select1 = mysqli_query($connect,"SELECT * FROM village JOIN mudugudu ON (village.v_id=mudugudu.v_id) JOIN cell_table ON (village.cell_id=cell_table.cell_id) WHERE village = '$village' AND cell = '$cell'");
					if (mysqli_num_rows($select1) == 0) {
						$insert1 = mysqli_query($connect,"INSERT INTO mudugudu VALUES ('$user_id','$address','$fname','$contact','$gender','$id','$password',now())");
						if ($insert1 == true) {
							// header('location:leader1.php');
						} 
						else {
							$errormsg = '<i class="fas fa-exclamation-circle"></i> Unknown Error';
						}
					}
					else {
						$errormsg = '<i class="fas fa-exclamation-circle"></i> This village '.$village.' already has leader';
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

	$m_id = $_POST['m_id'];
    $fname = $_POST['fname'];
    $contact = $_POST['contact'];
	$gender = $_POST['gender'];
    $id = $_POST['id'];
	$password = $_POST['password'];


    $errormsgs = '';


	if (empty($fname)) {
		$errormsgs = '<i class="fas fa-exclamation-circle"></i> Full names required';
	}
	elseif (is_numeric($fname)) {
		$errormsgs = '<i class="fas fa-exclamation-circle"></i>Full name must not be numeric';
	}
	elseif (is_numeric($gender)) {
		$errormsgs = '<i class="fas fa-exclamation-circle"></i> Gender required';
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
            $update = mysqli_query($connect,"UPDATE mudugudu SET fullname = '$fname',phones = '$contact',gender = '$gender',id_num = '$id',password = '$password' WHERE m_id = '$m_id'");
            if ($update == true) {
				// automaticaly update
			}
			else {
				$errormsgs = '<i class="fas fa-exclamation-circle"></i> Unknown Error';
			}
        }
}








$cell_id = $_SESSION['cell_id'];

$start = 0;

$rows_per_page = 4;

$records = mysqli_query($connect,"SELECT *FROM mudugudu JOIN village ON (mudugudu.v_id=village.v_id) WHERE cell_id = '$cell_id'");

$nbr_rows = mysqli_num_rows($records);

$pages = ceil($nbr_rows / $rows_per_page);

if (isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;

    $start = $page * $rows_per_page;
}


$retreive = mysqli_query($connect,"SELECT *FROM mudugudu JOIN village ON (mudugudu.v_id=village.v_id) WHERE cell_id = '$cell_id' LIMIT $start,$rows_per_page");

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
							    <h2 class="ml-lg-2">Manage the Leaders (Mudugudu) (<?php echo mysqli_num_rows($records) ?>)</h2>
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
							 <th class="text-body bold">Full Names</th>
							 <th class="text-body bold">Village address</th>
							 <th class="text-body bold">Contacts</th>
							 <th class="text-body bold">Gender</th>
                             <th class="text-body bold">ID number</th>
							 <th class="text-body bold">Actions</th>
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
							 <th><?php echo $get['fullname'] ?></th>
							 <th><?php echo $get['village'] ?></th>
							 <th>0<?php echo $get['phones'] ?></th>
							 <th><?php echo $get['gender'] ?></th>
							 <th><?php echo $get['id_num'] ?></th>
							 <th>
							   <button id="<?php echo $get['m_id']; ?>" type="button" data-toggle="modal" data-target="#editEmployeeModal" class="edit">
							   <i class="fas fa-edit" data-toggle="tooltip" title="Edit"></i>
							   </button>
							   <button data-id="<?php echo $get['m_id']; ?>" type="button" data-toggle="modal" data-target="#deleteEmployeeModal" class="delete">
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
		    <label>Village Address</label>
			<select name="address" class="form-control" id="">
				<option>-- Choose village --</option>
				<?php
				$sql1 = mysqli_query($connect,"SELECT DISTINCT v_id,village FROM village WHERE cell_id = '$cell_id'");
				while ($ret = mysqli_fetch_assoc($sql1)) {
					echo "<option value='".$ret['v_id']."'>".$ret['village']."</option>";
				}
				?>
			</select>
		</div>
		<div class="form-group">
		    <label>Contact</label>
			<input type="text" name="contact" class="form-control" required>
		</div>
		<div class="form-group">
		    <label>Gender</label>
			<select name="gender" class="form-control" id="">
				<option value="1">-- Choose Gender --</option>
				<option>Male</option>
				<option>Female</option>
			</select>
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
        <button type="submit" name="submit" class="btn btn-success">Add</button>
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
        <h5 class="modal-title">Edit Leader (Mudugudu)</h5>
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
		    <label>Contact</label>
			<input type="text" name="contact" class="form-control" id="contact">
		</div>
		<div class="form-group">
		    <label>Gender</label>
			<select name="gender" class="form-control" id="gender">
				<option value="1">-- Choose Gender --</option>
				<option>Male</option>
				<option>Female</option>
			</select>
		</div>
        <div class="form-group">
		    <label>ID number</label>
			<input type="text" name="id" class="form-control" id="id_num">
		</div>
		<div class="form-group">
		    <label>Password</label>
			<input type="text" name="password" class="form-control" id="password">
		</div>
		<input type="hidden" name="m_id" id="m_id">
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
        <h5 class="modal-title">Delete Leader (Mudugudu)</h5>
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
		location.href = "deletemud.php?id= "+id;
	});

	$(document).ready(function() {

// fetching data from database inside update form modal using javaScript

        $(document).on('click', '.edit', function(){  
           var m_id = $(this).attr("id");  
           $.ajax({  
                url:"update.php",  
                method:"POST",  
                data:{fetch: 1,m_id:m_id},  
                dataType:"json",  
                success:function(data){  
                     $('#editEmployeeModal #fname').val(data.fullname); 
					 $('#editEmployeeModal #contact').val(data.phones);
					 $('#editEmployeeModal #gender').val(data.gender); 
					 $('#editEmployeeModal #id_num').val(data.id_num);
					 $('#editEmployeeModal #password').val(data.password);
                     $('#editEmployeeModal #m_id').val(data.m_id);  
                }  
            });  
        });

});
</script>