<?php
include 'header.php';

$errors = [];

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
	$age = $_POST['age'];
	$national = $_POST['national'];
	$work = $_POST['work'];
	$medical = $_POST['medical'];
	$land = $_POST['land'];
	$house = $_POST['house'];
	$child = $_POST['child'];
	$martial = $_POST['martial'];
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];


	$errormsg = "";

	$c_id = random_num(20);


	if (empty($fname)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Full name required';
	}
	elseif (is_numeric($fname)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Full name must not be numeric';
	}
	elseif (empty($contact)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Contacts required';
	}
	elseif (empty($national)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Nationality required';
	}
	elseif (is_numeric($national)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Nationality must not be numeric';
	}
	elseif (!is_numeric($contact)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Contacts must be numeric';
	}
	elseif (is_numeric($gender)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Gender required';
	}
	elseif (is_numeric($age)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Range of age required';
	}
	elseif (strlen($contact) <= 9 && strlen($contact) >= 11) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Contact must be 10 numbers in total';
	}
	elseif (is_numeric($martial)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Martial status required';
	}
	elseif (!is_numeric($child)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Number of children in school must be numeric';
	}
	elseif (empty($house)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Number of people live in house required';
	}
	elseif (!is_numeric($house)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Number of people live in house must be numeric';
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
	elseif (is_numeric($land)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> land required';
	}


	else {
		$select = mysqli_query($connect,"SELECT *FROM citizen WHERE phone = '$contact'");
		if (mysqli_num_rows($select) == 0) {
			$isibo_id = $_SESSION['i_id'];
			$insert = mysqli_query($connect,"INSERT INTO citizen VALUES ('$c_id','$isibo_id','$fname','$contact','$gender','$age','$national','$martial','$house','$child','$work','$medical','$land','$day','$month','$year')");
			if ($insert == true) {
				// it will automatically insert data in database
			}
			else {
				$errormsg = '<i class="fas fa-exclamation-circle"></i> Unknown error';
			}
		}
		else {
			$errormsg = '<i class="fas fa-exclamation-circle"></i> This Phone number already exist';
		}
	}
}


if (isset($_POST['update'])) {

	$id = $_POST['c_id'];
    $fname = $_POST['fname'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
	$age = $_POST['age'];
	$national = $_POST['national'];
	$work = $_POST['work'];
	$medical = $_POST['medical'];
	$land = $_POST['land'];
	$house = $_POST['house'];
	$child = $_POST['child'];
	$martial = $_POST['martial'];
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
	elseif (empty($national)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Nationality required';
	}
	elseif (is_numeric($national)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Nationality must not be numeric';
	}
	elseif (!is_numeric($contact)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Contacts must be numeric';
	}
	elseif (is_numeric($gender)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Gender required';
	}
	elseif (is_numeric($age)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Range of age required';
	}
	elseif (strlen($contact) <= 9 && strlen($contact) >= 11) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Contact must be 10 numbers in total';
	}
	elseif (is_numeric($martial)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Martial status required';
	}
	elseif (!is_numeric($child)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Number of children in school must be numeric';
	}
	elseif (empty($house)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Number of people live in house required';
	}
	elseif (!is_numeric($house)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Number of people live in house must be numeric';
	}
	elseif (is_numeric($land)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> land required';
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
            $update = mysqli_query($connect,"UPDATE citizen SET fname = '$fname' ,phone = '$contact' ,gender = '$gender' ,age = '$age' ,nationality = '$national' ,
                       martial_status = '$martial' ,nbr_in_house = '$house' ,abana_biga = '$child' ,work_type = '$work' ,medical_ins = '$medical' ,
                        land_pr = '$land' ,reg_day = '$day' , reg_month = '$month' , reg_year = '$year' WHERE c_id = '$id'");
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


$retreive = mysqli_query($connect,"SELECT *FROM citizen JOIN isibo ON (citizen.i_id=isibo.i_id) JOIN mutwarasibo ON (mutwarasibo.i_id=isibo.i_id) WHERE mut_id = '$mut_id' LIMIT $start,$rows_per_page");

$check = mysqli_query($connect,"SELECT *FROM citizen JOIN isibo ON (citizen.i_id=isibo.i_id) JOIN mutwarasibo ON (mutwarasibo.i_id=isibo.i_id) WHERE mut_id = '$mut_id'");

?>
<!------main-content-start-----------> 
<title>VMS - Register</title>
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
							    <h2 class="ml-lg-2">Manage the Citizens (Abaturage) (<?php echo mysqli_num_rows($check) ?>)</h2>
							 </div>
							 <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
							   <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
								<i class="fa-solid fa-plus"></i>
							   <span>Add New Citizen</span>
							   </a>
							   <a href="#deleteAllEmployeeModal" class="btn btn-danger" data-toggle="modal">
								<i class="fas fa-trash"></i>
							   <span>Delete All</span>
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
							   <button id="<?php echo $get['c_id']; ?>" type="button" data-toggle="modal" data-target="#editEmployeeModal" class="edit">	
							    <i class="fas fa-edit" data-toggle="tooltip" title="Edit"></i>
							   </button>
							   <button data-id="<?php echo $get['c_id']; ?>" type="button" data-toggle="modal" data-target="#deleteEmployeeModal" class="delete">
							   <i class="fas fa-trash" data-toggle="tooltip" title="Delete"></i>
							   </button>
							 </th>
							 </tr>
							 <?php
							 $x++;
							 }
							 ?>
							 <!----delete-modal start--------->
		<div class="modal fade" tabindex="-1" id="deleteEmployeeModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete citizen</h5>
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
        <h5 class="modal-title">Add a citizen</h5>
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
				<input type="text" name="fname" class="form-control" >
			</div>
			<div class="form-group">
				<label>Contact</label>
				<input type="text" name="contact" class="form-control" >
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
				<label>Age range</label>
				<select name="age" class="form-control" id="">
					<option value="1">-- Choose age range --</option>
					<option>20-30</option>
					<option>30-50</option>
					<option>50-70</option>
					<option>70-100</option>
				</select>
			</div>
			<div class="form-group">
				<label>Nationality</label>
				<input type="text" name="national" class="form-control" >
			</div>
			<div class="form-group">
				<label>Martial status</label>
				<select name="martial" class="form-control" id="">
					<option value="1">-- Choose martial status --</option>
					<option>Married</option>
					<option>Single</option>
					<option>Widow / Widower</option>
					<option>Divorced</option>
				</select>
			</div>
			<div class="form-group">
				<label>Number of people live in house</label>
				<input type="text" name="house" class="form-control" >
			</div>
			<div class="form-group">
				<label>Number of children in school</label>
				<input type="text" name="child" class="form-control" >
			</div>
			<div class="form-group">
				<label>Work type</label>
				<select name="work" class="form-control" id="">
					<option value="1">-- Choose Work type --</option>
					<option>Akorera leta</option>
					<option>Arikorera</option>
					<option>Akorera abandi</option>
					<option>Ntakazi agira</option>
				</select>
			</div>
			<div class="form-group">
				<label>Type of Medical Insurance</label>
				<select name="medical" class="form-control" id="">
					<option value="1">-- Afite ubwishingizi bwo kwivuza buhe --</option>
					<option>RAMA</option>
					<option>Mituweli</option>
					<option>MMI</option>
					<option>Izindi</option>
					<option>Nta bwishingizi afite</option>
				</select>
			</div>
			<div class="form-group">
				<label>Land property</label>
				<select name="land" class="form-control" id="">
					<option value="1">-- Have Land property --</option>
					<option>Aratuye</option>
					<option>Arakodesha</option>
				</select>
			</div>
			<div class="form-group">
				<label>Igihe Yaziye (Italiki)</label>
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
				<label>Igihe Yaziye (Ukwezi)</label>
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
				<label>Igihe Yaziye (Umwaka)</label>
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
			
	  	   


<!----deleteall-modal start--------->
<div class="modal fade" tabindex="-1" id="deleteAllEmployeeModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete All citizens</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete All citizens</p>
		<p class="text-danger"><small>This action can not be undone</small></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a href="delete.php"><button class="btn btn-danger confirm-delete">Delete Anyway</button></a>
      </div>
    </div>
  </div>
</div>







					   
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
				<label>Age range</label>
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
				<label>Martial status</label>
				<select name="martial" class="form-control" id="martial_status">
					<option value="1">-- Choose martial status again --</option>
					<option>Married</option>
					<option>Single</option>
					<option>Widow / Widower</option>
					<option>Divorced</option>
				</select>
			</div>
			<div class="form-group">
				<label>Number of people live in house</label>
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
				<label>Type of Medical Insurance</label>
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
		location.href = "deletecitiz.php?id= "+id;
	});


	

	$(document).ready(function() {

		// fetching data from database inside update form modal using javaScript

        $(document).on('click', '.edit', function(){  
           var c_id = $(this).attr("id");  

           $.ajax({  
                url:"get.php",  
                method:"POST",  
                data:{fetch:1,c_id: c_id},  
                dataType:"json",  
                success:function(data){  
                	console.log(data);
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

		// updating data from modal using js

	// 	$(document).on("click", "#updateBtn", function() {
    //         var fname = $('#editEmployeeModal #fname').val();
	// 		var i_name = $('#editEmployeeModal #i_name').val();
	// 		var phone = $('#editEmployeeModal #phone').val();
	// 		var gender = $('#editEmployeeModal #gender').val();
	// 		var age = $('#editEmployeeModal #age').val();
	// 		var nationality = $('#editEmployeeModal #nationality').val();
	// 		var martial_status = $('#editEmployeeModal #martial_status').val();
	// 		var nbr_in_house = $('#editEmployeeModal #nbr_in_house').val();
	// 		var abana_biga = $('#editEmployeeModal #abana_biga').val();
    //         var work_type = $('#editEmployeeModal #work_type').val();
	// 		var medical_ins = $('#editEmployeeModal #medical_ins').val();
    //         var land_pr = $('#editEmployeeModal #land_pr').val();
	// 		var c_id = $('#editEmployeeModal #c_id').val();

    //         $.ajax({
    //             url: "updatecitiz.php",
    //             type: "POST",
    //             catch: false,
    //             data: {
    //                 update: 1,
    //                 fname: fname,
    //                 i_name: i_name,
	// 				phone: phone,
	// 				gender: gender,
	// 				age: age,
	// 				nationality: nationality,
	// 				martial_status: martial_status,
	// 				nbr_in_house: nbr_in_house,
	// 				abana_biga: abana_biga,
	// 				work_type: work_type,
	// 				medical_ins: medical_ins,
	// 				land_pr: land_pr,
    //                 c_id: c_id
    //             },
    //             success: function(dataResult) {
    //                 var dataResult = JSON.parse(dataResult);
    //                 if (dataResult.status == 1) {
    //                     swal("Citizen successfully Updated!", {
    //                         icon: "success",
    //                     }).then((result) => {
    //                         location.reload();
    //                     });
    //                 }
	// 				else{
	// 					swal("Updated Faild!", {
    //                         icon: "alert-danger",
    //                     })
	// 				}
    //             }
    //         });
    //     });		
	});
    
</script>