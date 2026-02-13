<?php
include 'header.php';

$errors = [];

$v_id = $_SESSION['v_id'];

if (isset($_POST['submit'])) {
    $place = $_POST['place'];
    $text = $_POST['text'];
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];


	$errormsg = '';

	$num_id = random_num(20);


	if (empty($place)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Place field required';
	}
	elseif (is_numeric($place)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Place field must not be numeric';
	}
	elseif (empty($text)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Description required';
	}
	elseif (is_numeric($text)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Description must not be numeric';
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
        $select = mysqli_query($connect,"SELECT *FROM akagoroba WHERE a_day = '$day' AND a_month = '$month' AND a_year = '$year'");
        if (mysqli_num_rows($select) == 0) {
            $insert = "INSERT INTO akagoroba VALUES ('$num_id','$v_id','$place','$text','$day','$month','$year')";
            $res = $connect -> query($insert);
            if ($res == true) {
                // automaticaly insert
            }
            else {
                $errormsg = '<i class="fas fa-exclamation-circle"></i> You can not upload file of this type';
            }
        }
        else {
            $errormsg = '<i class="fas fa-exclamation-circle"></i> Please check date, no two activities in one month';
        }
    }
}





if (isset($_POST['update'])) {

	$id = $_POST['a_id'];
    $place = $_POST['place'];
    $text = $_POST['text'];
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];


    $errormsgs = '';


	if (empty($place)) {
		$errormsgs = '<i class="fas fa-exclamation-circle"></i> Place field required';
	}
	elseif (is_numeric($place)) {
		$errormsgs = '<i class="fas fa-exclamation-circle"></i> Place field must not be numeric';
	}
	elseif (empty($text)) {
		$errormsgs = '<i class="fas fa-exclamation-circle"></i> Description required';
	}
	elseif (is_numeric($text)) {
		$errormsgs = '<i class="fas fa-exclamation-circle"></i> Description must not be numeric';
	}
	elseif (!is_numeric($day)) {
		$errormsgs = '<i class="fas fa-exclamation-circle"></i> day required';
	}
	elseif (is_numeric($month)) {
		$errormsgs = '<i class="fas fa-exclamation-circle"></i> month required';
	}
	elseif (!is_numeric($year)) {
		$errormsgs = '<i class="fas fa-exclamation-circle"></i> year required';
	}
    else {
            $update = mysqli_query($connect,"UPDATE akagoroba SET place = '$place',description = '$text',a_day = '$day',a_month = '$month',a_year = '$year' WHERE a_id = '$id'");
            if ($update == true) {
				// automaticaly update
			}
			else {
				$errormsgs = '<i class="fas fa-exclamation-circle"></i> Unknown Error';
			}
        }
}

















$v_id = $_SESSION['v_id'];

$m_id = $_SESSION['m_id'];

$start = 0;

$rows_per_page = 4;

$records = mysqli_query($connect,"SELECT *FROM akagoroba JOIN village ON (akagoroba.v_id=village.v_id) JOIN mudugudu ON (mudugudu.v_id=village.v_id) WHERE m_id = '$m_id'");

$nbr_rows = mysqli_num_rows($records);

$pages = ceil($nbr_rows / $rows_per_page);

if (isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;

    $start = $page * $rows_per_page;
}


$retreive = mysqli_query($connect,"SELECT *FROM akagoroba JOIN village ON (akagoroba.v_id=village.v_id) JOIN mudugudu ON (mudugudu.v_id=village.v_id) WHERE m_id = '$m_id' LIMIT $start,$rows_per_page");

$check = mysqli_query($connect,"SELECT *FROM akagoroba JOIN village ON (akagoroba.v_id=village.v_id) JOIN mudugudu ON (mudugudu.v_id=village.v_id) WHERE m_id = '$m_id'");

?>
<!------main-content-start-----------> 
<title>VMS - Akagoroba K'ababyeyi</title>
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
							    <h2 class="ml-lg-2">Manage the Activities (Akagoroba k'ababyeyi) (<?php echo mysqli_num_rows($check) ?>)</h2>
							 </div>
							 <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
							   <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
								<i class="fas fa-add"></i>
							   <span>Add New Activity</span>
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
							 <th class="text-body">Village</th>
							 <th class="text-body">Place occured</th>
                             <th class="text-body">Description Of Discussion</th>
							 <th class="text-body">Date happened</th>
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
							 <th><?php echo $get['village'] ?></th>
							 <th><?php echo $get['place'] ?></th>
							 <th><?php echo $get['description'] ?></th>
							 <th><?php echo $get['a_day'] ."-".$get['a_month']."-".$get['a_year'] ?></th>
							 <th>
							   <button id="<?php echo $get['a_id']; ?>" type="button" data-toggle="modal" data-target="#editEmployeeModal" class="edit">	
							    <i class="fas fa-edit" data-toggle="tooltip" title="Edit"></i>
							   </button>
							   <button data-id="<?php echo $get['a_id']; ?>" type="button" data-toggle="modal" data-target="#deleteEmployeeModal" class="delete">
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
        <h5 class="modal-title">Delete Activity (Akagoroba)</h5>
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
        <h5 class="modal-title">Register Activity</h5>
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
				<label>Place (Aho Byabereye)</label>
				<input type="text" name="place" id="place" class="form-control" >
			</div>
			<div class="form-group">
				<label>Description (Ibyakozwe)</label>
				<textarea class="form-control" style="resize: none;" rows="4" id="text" name="text"></textarea>
			</div>
			<div class="form-group">
				<label>Igihe wabereye (Italiki)</label>
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
				<label>Igihe wabereye (Ukwezi)</label>
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
				<label>Igihe wabereye (Umwaka)</label>
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
			<button type="submit" id="btnAdd" name="submit" class="btn btn-success">Submit</button>
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
        <h5 class="modal-title">Delete All Activities</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete All Activities</p>
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
        <h5 class="modal-title">Edit this activity</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
	  <?php
	  if (!empty($errormsgs)) {
		?>
		<div class="alert alert-danger">
			<?php echo $errormsgs; ?>
		</div>
		<?php
	  }
	  ?>
      <div class="modal-body">
            <div class="form-group">
				<label>Village</label>
				<input type="text" name="v_id" id="v_id" readonly class="form-control" >
			</div>
            <div class="form-group">
				<label>Place (Aho Byabereye)</label>
				<input type="text" name="place" id="place" class="form-control" >
			</div>
			<div class="form-group">
				<label>Description</label>
				<textarea class="form-control" style="resize: none;" rows="4" id="text" name="text"></textarea>
			</div>
			<div class="form-group">
				<label>Igihe wabereye (Italiki)</label>
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
				<label>Igihe wabereye (Ukwezi)</label>
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
				<label>Igihe wabereye (Umwaka)</label>
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
			<div class="form-group">
				<input type="hidden" name="a_id" id="a_id" class="form-control" >
			</div>
		</div>
      <div class="modal-footer">
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
		location.href = "deleteaka.php?id= "+id;
	});


	

	$(document).ready(function() {

		// fetching data from database inside update form modal using javaScript

        $(document).on('click', '.edit', function(){  
           var a_id = $(this).attr("id");  
           $.ajax({  
                url:"check.php",  
                method:"POST",  
                data:{get: 1,a_id:a_id},  
                dataType:"json",  
                success:function(data){  
                     $('#editEmployeeModal #place').val(data.place); 
					 $('#editEmployeeModal #v_id').val(data.village);
					 $('#editEmployeeModal #text').val(data.description);
					 $('#editEmployeeModal #day').val(data.a_day); 
					 $('#editEmployeeModal #month').val(data.a_month); 
					 $('#editEmployeeModal #year').val(data.a_year);  
                     $('#editEmployeeModal #a_id').val(data.a_id);  
                }  
            });  
        });

        // Inserting data from modal to database using js & AJAX

		// $(document).on("click", "#btnAdd", function(e) {

        //     e.preventDefault();

        //     var place = $('#place').val();
		// 	var img = $('#img').val();
		// 	var text = $('#text').val();
		// 	var day = $('#day').val();
		// 	var month = $('#month').val();
		// 	var year = $('#year').val();

        //     $.ajax({
        //         url: "add_akagoroba.php",
        //         type: "POST",
        //         catch: false,
        //         data: {
        //             add: 1,
        //             place: place,
        //             img: img,
		// 			text: text,
		// 			day: day,
		// 			age: age,
		// 			month: month,
		// 			year: year
        //         },
        //         success: function(dataResult) {
        //             var dataResult = JSON.parse(dataResult);
        //             if (dataResult.status == 1) {
        //                 swal("Data successfully Added!", {
        //                     icon: "success",
        //                 }).then((result) => {
        //                     location.reload();
        //                 });
        //             }
		// 			else{
		// 				swal("Data Faild!", {
        //                     icon: "alert-danger",
        //                 });
		// 			}
        //         }
        //     });
        // });		
		
	});
    
</script>