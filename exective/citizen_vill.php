<?php
include 'header.php';

$v_id = $_SESSION['v_id'];


$start = 0;

$rows_per_page = 4;

$records = mysqli_query($connect,"SELECT * FROM citizen JOIN isibo ON (citizen.i_id=isibo.i_id) WHERE v_id = '$v_id'");

$nbr_rows = mysqli_num_rows($records);

$pages = ceil($nbr_rows / $rows_per_page);

if (isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;

    $start = $page * $rows_per_page;
}


$retreive = mysqli_query($connect,"SELECT *FROM citizen JOIN isibo ON (citizen.i_id=isibo.i_id) WHERE v_id = '$v_id' LIMIT $start,$rows_per_page");

$sql = mysqli_query($connect,"SELECT *FROM village JOIN cell_table ON (village.cell_id=cell_table.cell_id) WHERE v_id = '$v_id'");
$fetch = mysqli_fetch_assoc($sql);

$check = mysqli_query($connect,"SELECT *FROM citizen JOIN isibo ON (citizen.i_id=isibo.i_id) WHERE v_id = '$v_id'");
?>

<title>VMS - Manage Citizens</title>
<body onload="myFunction()" style="margin:0;">
<div id="loader"></div>
<div style="display:none;" id="myDiv" class="animate-bottom">
<div class="main-content">
			     <div class="row">
				    <div class="col-md-12">
					   <div class="table-wrapper">
					     
					   <div class="table-title">
					     <div class="row">
						     <a href="umudugudu.php"><i class="fas fa-arrow-left" style="margin-top:10px;color:#eee;background:rgb(60, 60, 60);"></i></a>
						     <div class="col-sm-7 p-0 flex justify-content-lg-start justify-content-center">
							    <h2 class="ml-lg-3">Manage Citizens(Abaturage) in village (<?php echo mysqli_num_rows($check) ?>)</h2>
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
							 <th class="text-body">No</th>
							 <th class="text-body">Full name</th>
							 <th class="text-body">Cell</th>
                             <th class="text-body">Village</th>
							 <th class="text-body">Isibo</th>
							 <!-- <th class="text-body">Contacts</th> -->
                             <th class="text-body">Gender</th>
							 <th class="text-body">Age range</th>
							 <th class="text-body">Nationality</th>
							 <!-- <th class="text-body">martial status</th> -->
							 <th class="text-body">number in house</th>
							 <th class="text-body">number of kids study</th>
							 <!-- <th class="text-body">work Type</th> -->
							 <th class="text-body">medical insurence</th>
							 <th class="text-body">land property</th>
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
							 <th><?php echo $fetch['cell'] ?></th>
                             <th><?php echo $fetch['village'] ?></th>
							 <th><?php echo $get['i_name'] ?></th>
							 <!-- <th>0<?php //echo $get['phone'] ?></th> -->
							 <th><?php echo $get['gender'] ?></th>
							 <th><?php echo $get['age'] ?></th>
							 <th><?php echo $get['nationality'] ?></th>
							 <!-- <th><?php //echo $get['martial_status'] ?></th> -->
							 <th><?php echo $get['nbr_in_house'] ?></th>
							 <th><?php echo $get['abana_biga'] ?></th>
							 <!-- <th><?php //echo $get['work_type'] ?></th> -->
							 <th><?php echo $get['medical_ins'] ?></th>
							 <th><?php echo $get['land_pr'] ?></th>
							 <th><?php echo $get['reg_day'] ."-".$get['reg_month']."-".$get['reg_year'] ?></th>
							 <th>
                               
							   <button data-id="<?php echo $get['c_id']; ?>" type="button" data-toggle="modal" data-target="#deleteEmployeeModal" class="delete">
							   <i class="fas fa-trash" data-toggle="tooltip" title="Delete"></i>
							   </button>
							 </th>
							 </tr>
                             
							 <?php
                             $x++;
							 }
							 ?>
							 
					   </tbody>
						  <?php
					   }
					   else {
						$errors[] = '<h4><i class="fas fa-exclamation-circle"></i> No records available</h4>';
					   }
					   ?>


                       <!----delete-modal start--------->
		<div class="modal fade" tabindex="-1" id="deleteEmployeeModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Employees</h5>
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
        <a data-id=""><button class="btn btn-danger confirm-delete">Delete</button></a>
      </div>
    </div>
  </div>
</div>


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
        <h5 class="modal-title">Add a citizen</h5>
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
				<label>full name</label>
				<input type="text" name="fname" class="form-control" required>
			</div>
			<div class="form-group">
				<label>contact</label>
				<input type="text" name="contact" class="form-control" required>
			</div>
			<div class="form-group">
				<label>ID number</label>
				<input type="text" name="id" class="form-control" required>
			</div>
			<div class="form-group">
				<label>school level</label>
				<select name="level" class="form-control" id="">
					<option value="1">-- Choose School Level --</option>
					<option>Primary Level</option>
					<option>High School level</option>
					<option>University level</option>
					<option>Masters & PHD level</option>
				</select>
			</div>
			<div class="form-group">
				<label>Work type</label>
				<input type="text" name="work" class="form-control" required>
			</div>
			<div class="form-group">
				<label>Disability</label>
				<input type="text" name="disa" class="form-control" required>
			</div>
			<div class="form-group">
				<label>Medical Insurance</label>
				<input type="text" name="medical" class="form-control" required>
			</div>
			<div class="form-group">
				<label>Land property</label>
				<select name="land" class="form-control" id="">
					<option value="1">-- Have Land property --</option>
					<option>Yes</option>
					<option>No</option>
				</select>
			</div>
			<div class="form-group">
				<label>UPI</label>
				<input type="text" name="upi" class="form-control" required>
			</div>
			<div class="form-group">
				<label>Settle</label>
				<input type="text" name="settle" class="form-control" required>
			</div>
			<div class="form-group">
				<label>energy source</label>
				<input type="text" name="energy" class="form-control" required>
			</div>
			<div class="form-group">
				<label>martial status</label>
				<select name="martial" class="form-control" id="">
					<option value="1">-- Choose martial status --</option>
					<option>single</option>
					<option>married</option>
					<option>Widow / widower</option>
					<option>divorced</option>
				</select>
			</div>
			<div class="form-group">
				<label>cattle</label>
				<select name="cattle" class="form-control" id="">
					<option value="1">-- Choose cattle --</option>
					<option>cows</option>
					<option>goats</option>
					<option>hens</option>
					<option>sheeps</option>
					<option>No cattle</option>
				</select>
			</div>
			<div class="form-group">
				<label>settling day</label>
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
				<label>settling month</label>
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
				<label>settling year</label>
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
			<button type="submit" class="btn btn-success">Submit</button>
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
	  if (isset($errormsg)) {
		?>
		<div class="alert alert-danger">
			<?php echo $errormsg; ?>
		</div>
		<?php
	  }
	  ?>
      <div class="modal-body">
			<div class="form-group">
				<label>full name</label>
				<input type="text" name="fname" id="fname" class="form-control" >
			</div>
			<div class="form-group">
				<label>Isibo</label>
				<input type="text" name="isibo" id="i_name" readonly  class="form-control" >
			</div>
			<div class="form-group">
				<label>contact</label>
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
				<label>age range</label>
				<select name="age" class="form-control" id="age">
					<option value="1">-- Choose age range again --</option>
					<option>20-30</option>
					<option>30-50</option>
					<option>50-70</option>
					<option>70-100</option>
				</select>
			</div>
			<div class="form-group">
				<label>Nationality</label>
				<input type="text" name="national" id="nationality" class="form-control" >
			</div>
			<div class="form-group">
				<label>martial status</label>
				<select name="martial" class="form-control" id="martial_status">
					<option value="1">-- Choose martial status again --</option>
					<option>Married</option>
					<option>Single</option>
					<option>Widow / Widower</option>
					<option>Divorced</option>
				</select>
			</div>
			<div class="form-group">
				<label>number of people live in house</label>
				<input type="text" id="nbr_in_house" name="house" class="form-control" >
			</div>
			<div class="form-group">
				<label>Number of children in school</label>
				<input type="text" name="child" id="abana_biga" class="form-control" >
			</div>
			<div class="form-group">
				<label>Work type</label>
				<select name="work" class="form-control" id="work_type">
					<option value="1">-- Choose Work type again --</option>
					<option>Akorera leta</option>
					<option>Arikorera</option>
					<option>Akorera abandi</option>
					<option>Ntakazi agira</option>
				</select>
			</div>
			<div class="form-group">
				<label>type of Medical Insurance</label>
				<select name="medical" class="form-control" id="medical_ins">
					<option value="1">-- hitamo nanone ubwishingizi bwo kwivuza afite --</option>
					<option>RAMA</option>
					<option>Mituweli</option>
					<option>MMI</option>
					<option>Izindi</option>
					<option>Nta bwishingizi afite</option>
				</select>
			</div>
			<div class="form-group">
				<label>Land property</label>
				<select name="land" class="form-control" id="land_pr">
					<option value="1">-- Have Land property again --</option>
					<option>Aratuye</option>
					<option>Arakodesha</option>
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
				<input type="hidden" name="c_id" id="c_id" class="form-control" >
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
</style>

<script>

	//passing citizen id in deleting modal using ajax js

	$('.delete').on('click' , function (e) {
		let id = $(this).attr('data-id');
		$('.confirm-delete').attr('data-id' ,id);
	});
	$(".confirm-delete").on('click', function (e) {
		let id = $(this).attr('data-id');
		console.log(id);
		location.href = "delete.php?id= "+id;
	});

	// fetching data from database to edit modal using ajax js

	$(document).ready(function () {
		$(document).on('click', '.edit', function(){  
           var c_id = $(this).attr("id");  
           $.ajax({  
                url:"get.php",  
                method:"POST",  
                data:{fetch: 1,c_id:c_id},  
                dataType:"json",  
                success:function(data){  
                     $('#editEmployeeModal #fname').val(data.fname); 
					 $('#editEmployeeModal #i_name').val(data.i_name);
					 $('#editEmployeeModal #phone').val(data.phone);
					 $('#editEmployeeModal #gender').val(data.gender); 
					 $('#editEmployeeModal #age').val(data.age);
					 $('#editEmployeeModal #nationality').val(data.nationality);
					 $('#editEmployeeModal #martial_status').val(data.martial_status);
					 $('#editEmployeeModal #nbr_in_house').val(data.nbr_in_house);
					 $('#editEmployeeModal #abana_biga').val(data.abana_biga);
					 $('#editEmployeeModal #work_type').val(data.work_type);
                     $('#editEmployeeModal #medical_ins').val(data.medical_ins);  
					 $('#editEmployeeModal #land_pr').val(data.land_pr); 
					 $('#editEmployeeModal #reg_day').val(data.reg_day); 
					 $('#editEmployeeModal #reg_month').val(data.reg_month); 
					 $('#editEmployeeModal #reg_year').val(data.reg_year);  
                     $('#editEmployeeModal #c_id').val(data.c_id);  
                }  
            });  
        });
	});
</script>