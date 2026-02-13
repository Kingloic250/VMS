<?php
include 'header.php';

$errors = [];

if (isset($_POST['submit'])) {
    $fname = $_POST['search'];
    $contact = $_POST['phone'];
    $gender = $_POST['gender'];
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];


	$errormsg = "";

	$leave_id = random_num(20);


	if (!is_string($fname)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Full Name required';
	}
	elseif (empty($contact)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Contacts required';
	}
	elseif (!is_numeric($contact)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Contacts must be numeric';
	}
	elseif (is_numeric($gender)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Gender required';
	}
	elseif (strlen($contact) <= 9 && strlen($contact) >= 11) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Contact must be 10 numbers in total';
	}
	elseif (!is_numeric($day)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> day required';
	}
	elseif (is_numeric($month)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> month required';
	}
	elseif (!is_numeric($year)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> year required';
	}


	else {
		$select = mysqli_query($connect,"SELECT *FROM citizen WHERE phone = '$contact' AND fname = '$fname'");
		if (mysqli_num_rows($select) == 1) {
			$row = mysqli_fetch_assoc($select);
			$c_id = $row['c_id'];
			$isibo_id = $_SESSION['i_id'];
			$insert = mysqli_query($connect,"INSERT INTO leave_citizen VALUES ('$leave_id','$isibo_id','$fname','$contact','$gender','$day','$month','$year')");
			$delete = mysqli_query($connect,"DELETE FROM citizen WHERE c_id = '$c_id'");
			if ($delete == true && $insert == true) {
				// it will automatically insert data in database
			}
			else {
				$errormsg = '<i class="fas fa-exclamation-circle"></i> Unknown error';
			}
		}
		else {
			$errormsg = '<i class="fas fa-exclamation-circle"></i> This Phone number is not registered to '.$fname.'';
		}
	}
}


if (isset($_POST['update'])) {

	$id = $_POST['l_id'];
	$fname = $_POST['fname'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];


    $errormsg = '';


	if (empty($fname)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Full name required';
	}
	elseif (is_numeric($fname)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Full name must not be numeric';
	}
	elseif (empty($contact)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Contacts required';
	}
	elseif (!is_numeric($contact)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Contacts must be numeric';
	}
	elseif (is_numeric($gender)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Gender required';
	}
	elseif (strlen($contact) <= 9 && strlen($contact) >= 11) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Contact must be 10 numbers in total';
	}
	elseif (!is_numeric($day)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> day required';
	}
	elseif (is_numeric($month)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> month required';
	}
	elseif (!is_numeric($year)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> year required';
	}
    else {
            $update = mysqli_query($connect,"UPDATE leave_citizen SET fname = '$fname' ,phone = '$contact' ,gender = '$gender',reg_day = '$day' , reg_month = '$month' , reg_year = '$year' WHERE l_id = '$id'");
            if ($update == true) {
				// automaticaly update
			}
			else {
				$errormsg = '<i class="fas fa-exclamation-circle"></i> Unknown Error';
			}
        }
}

















$isibo_id = $_SESSION['i_id'];

$mut_id = $_SESSION['mut_id'];

$start = 0;

$rows_per_page = 4;

$records = mysqli_query($connect,"SELECT *FROM citizen JOIN isibo ON (citizen.i_id=isibo.i_id) JOIN mutwarasibo ON (mutwarasibo.i_id=isibo.i_id) WHERE mut_id = '$mut_id'");

$nbr_rows = mysqli_num_rows($records);

$pages = ceil($nbr_rows / $rows_per_page);

if (isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;

    $start = $page * $rows_per_page;
}


$retreive = mysqli_query($connect,"SELECT *FROM leave_citizen JOIN isibo ON (leave_citizen.i_id=isibo.i_id) JOIN mutwarasibo ON (mutwarasibo.i_id=isibo.i_id) WHERE mut_id = '$mut_id' LIMIT $start,$rows_per_page");

$check = mysqli_query($connect,"SELECT *FROM citizen JOIN isibo ON (citizen.i_id=isibo.i_id) JOIN mutwarasibo ON (mutwarasibo.i_id=isibo.i_id)");

?>
<!------main-content-start-----------> 
<title>VMS - Leaving Citizen</title>
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
							    <h2 class="ml-lg-2">Manage leaved Citizens (Abaturage bagiye) (<?php echo mysqli_num_rows($retreive) ?>)</h2>
							 </div>
							 <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
							   <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
								<i class="fas fa-add"></i>
							   <span>Add leaving Citizen</span>
							   </a>
							 </div>
					     </div>
					   </div>
					   <?php
					   if (mysqli_num_rows($retreive) > 0) {
					   ?>
					   <table class="table table-hover">
					      <thead>
						     <tr>
							 <th><span class="custom-checkbox">
							 <input type="checkbox" id="selectAll">
							 <label for="selectAll"></label></th>
							 <th class="text-body">No</th>
							 <th class="text-body">Full name</th>
							 <th class="text-body">isibo</th>
							 <!-- <th class="text-body">Contacts</th> -->
                             <th class="text-body">Gender</th>
							 <th class="text-body">registration date</th>
							 <th class="text-body">Actions</th>
							 </tr>
						  </thead>
						
						  <tbody>
							<?php
							$x=1;
							while ($get = mysqli_fetch_assoc($retreive)) {
								
							?>
						      <tr>
							 <th>
							 <input type="checkbox" hidden id="checkbox1" name="option[]" value="1">
							 <label for="checkbox1"></label></th>
							 <th><?php echo $x ?></th>
							 <th><?php echo $get['fname'] ?></th>
							 <th><?php echo $get['i_name'] ?></th>
							 <!-- <th>0<?php //echo $get['phone'] ?></th> -->
							 <th><?php echo $get['gender'] ?></th>
							 <th><?php echo $get['reg_day'] ."-".$get['reg_month']."-".$get['reg_year'] ?></th>
							 <th>
							   <button id="<?php echo $get['l_id']; ?>" type="button" data-toggle="modal" data-target="#editEmployeeModal" class="edit">	
							    <i class="fas fa-edit" data-toggle="tooltip" title="Edit"></i>
							   </button>
							   <button data-id="<?php echo $get['l_id']; ?>" type="button" data-toggle="modal" data-target="#deleteEmployeeModal" class="delete">
							   <i class="fas fa-trash" data-toggle="tooltip" title="Delete"></i>
							   </button>
							 </th>
							 </tr>
							 <?php
							 $x++;
							 }
							 ?>
							 <?php
							 $fetch = mysqli_fetch_assoc($check);
							 ?>
							 <!----delete-modal start--------->
		<div class="modal fade" tabindex="-1" id="deleteEmployeeModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete leaving citizen</h5>
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
        <h5 class="modal-title">Register Leaving Citizen</h5>
        <button type="reset" class="close" data-dismiss="modal" aria-label="Close">
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
                <select class="js-example-basic-single" name="search" style="width: 100%;">
                  <option></option>
				  <?php 
				  $select = mysqli_query($connect,"SELECT *FROM citizen WHERE i_id = '$isibo_id'");
				  while ($fetch = mysqli_fetch_assoc($select)) {
				  	echo "<option value='".$fetch['fname']."'>".$fetch['fname']."</option>";
				  }
				  ?>
				  
				</select>
			</div>
			<div class="form-group">
				<label>Contact</label>
				<input type="text" name="phone" id="contact" class="form-control" >
			</div>
			<div class="form-group">
				<label>Gender</label>
				<select name="gender" class="form-control" id="gender">
					<option>-- Choose gender --</option>
					<option>Male</option>
					<option>Female</option>
				</select>
			</div>
			<div class="form-group">
				<label>Igihe agendeye (Italiki)</label>
				<select name="day" class="form-control" id="">
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
				<label>Igihe agendeye (Ukwezi)</label>
				<select name="month" class="form-control" id="">
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
				<label>Igihe agendeye (Umwaka)</label>
				<select name="year" class="form-control" id="">
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
        <h5 class="modal-title">Edit citizen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
	  <?php
	  if (!empty($errormsg)) {
		?>
		<div class="alert alert-danger">
			<?php echo $errormsg; ?>
		</div>
		<?php
	  }
	  ?>
      <div class="modal-body">
			<div class="form-group">
				<label>Full name</label>
				<input type="text" name="fname" id="fname" class="form-control" >
			</div>
			<div class="form-group">
				<label>Isibo</label>
				<input type="text" name="isibo" id="i_name" readonly  class="form-control" >
			</div>
			<div class="form-group">
				<label>Contact</label>
				<input type="text" name="contact" id="phone" class="form-control" >
			</div>
			<div class="form-group">
				<label>Gender</label>
				<select name="gender" class="form-control" id="gender">
					<option value="1">-- choose gender again --</option>
					<option>Male</option>
					<option>Female</option>
				</select>
			</div>
			<div class="form-group">
				<label>Igihe Yaziye (Italiki)</label>
				<select name="day" class="form-control" id="reg_day">
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
				<label>Igihe Yaziye (Ukwezi)</label>
				<select name="month" class="form-control" id="reg_month">
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
				<label>Igihe Yaziye (Umwaka)</label>
				<select name="year" class="form-control" id="reg_year">
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
			<div class="form-group">
				<input type="hidden" name="l_id" id="l_id" class="form-control" >
			</div>
		</div>
      <div class="modal-footer">
		<input type="hidden" name="id" value="">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" name="update" id="updateBtn" class="btn btn-success confirm-update">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>
					   <!----edit-modal end--------->	   

					 
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
		text-align: center;
	}
	.danger {
		padding: 6px;
		cursor: default;
	}
	thead th{
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
	p{
		margin: 0;
		font-weight: 600;
		cursor: pointer;
		padding: 7px;
		max-width:100%;
	}
	p:hover{
		background: whitesmoke;
	}
	.result {
		background: #fff;
		box-shadow: 0 1px 7px 1px rgba(0,0,0,0.1);
		width: 100%;
	}
	.single{
		width: 100%;
	}
</style>


<script>

	// passing user_id for deleting in modal using js

	$('.delete').on('click' , function (e) {
		let id = $(this).attr('data-id');
		$('.confirm-delete').attr('data-id' ,id);
	});
	$(".confirm-delete").on('click', function (e) {
		let id = $(this).attr('data-id');
		console.log(id);
		location.href = "delete_leave.php?id= "+id;
	});


    
	

	$(document).ready(function() {

		$(".js-example-basic-single").select2({
		    placeholder: "Select citizen names",
		    dropdownParent: "#addEmployeeModal"
		});

        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }
		// fetching data from database inside update form modal using javaScript

        $(document).on('click', '.edit', function(){  
           var l_id = $(this).attr("id");  
           $.ajax({  
                url:"ret.php",  
                method:"POST",  
                data:{ret: 1,l_id:l_id},  
                dataType:"json",  
                success:function(data){  
                     $('#editEmployeeModal #fname').val(data.fname); 
					 $('#editEmployeeModal #i_name').val(data.i_name);
					 $('#editEmployeeModal #phone').val(data.phone);
					 $('#editEmployeeModal #gender').val(data.gender);
					 $('#editEmployeeModal #reg_day').val(data.reg_day); 
					 $('#editEmployeeModal #reg_month').val(data.reg_month); 
					 $('#editEmployeeModal #reg_year').val(data.reg_year);  
                     $('#editEmployeeModal #l_id').val(data.l_id);  
                }  
            });  
        });

        // live search from database using ajax


        $('#search').keyup(function () {
            let query = $(this).val();
            if (query != "") {
                $.ajax({
                    url: 'live_search.php',
                    method: 'POST',
                    cashe: false,
                    data: {query: query},
                    success: function (data) {
                        $('#result').html(data);
                    }
                });
            }
            else{
                $('#result').empty();
            }
        });

        //set search input value on click

        $(document).on("click","p", function () {
            $('#search').val($(this).text());
            $("#result").empty();
        });

        

	});

	// auto fill data in fields 

	// aData = {}
	// $( "#search" ).autocomplete({
    //   source: function (request, response) {
    //   	$.ajax({
    //   		url: "live.php",
    //   		type: "GET",
    //   		dataType: "json",
    //   		success: function(data) {
    //   			//console.log(data)
    //   			aData = $.map(data, function (value, key) {
    //   				return {
    //   					id: value.c_id,
    //   					fname: value.fname,
    //   					contact: value.phone
    //   				};
    //   			});
    //   			console.log(aData)
    //   			var results = $.ui.autocomplete.filter(aData, request.term);
    //   			response(results);
    //   		}
    //   	});
    //   }
    // });
 
    
</script>