<?php
include 'header.php';

$errors = [];

$v_id = $_SESSION['v_id'];


// Inserting data

$total_money = 2000;



if (isset($_POST['submit'])) {
    
    $fname = $_POST['fname'];
    $amount = $_POST['amount'];
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];

    $num_id = random_num(20);
            

	$errormsg = '';


    if (!is_numeric($fname)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Full Names required';
	}
	elseif (empty($amount)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Money field required';
	}
	elseif (!is_numeric($amount)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Money must be numeric';
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
		
        if ($amount <= 2000) {
            $range = range(1,2000);
            $loan_total = $total_money - $amount;
            $select = mysqli_query($connect,"SELECT *FROM kwishyura WHERE k_month = '$month' AND K_year = '$year' AND c_id = '$fname'");
            if (mysqli_num_rows($select) == 1) {
            	$check = mysqli_query($connect,"SELECT *FROM kwishyura WHERE amount = 2000");
            	$ret = mysqli_fetch_assoc($check);
            	if (mysqli_num_rows($check) == 0) {
            		

            		$amount_money = $ret['amount'] + $amount;
            		$unpaid = $total_money - $amount;

            		mysqli_query($connect,"UPDATE kwishyura SET amount = '$amount_money', unpaid = '$unpaid' WHERE c_id = '$fname'");
            	}
            	else {
                	$errormsg = '<i class="fas fa-exclamation-circle"></i>This person has paid irondo for this month';
                }
            }
            else {
                $insert = mysqli_query($connect,"INSERT INTO kwishyura VALUES ('$num_id','$v_id','$fname','$amount','$total_money','$loan_total','$day','$month','$year')");
	                if ($insert == true) {
	                    // automaticaly insert
	                }
	                else {
	                    $errormsg = '<i class="fas fa-exclamation-circle"></i> Unknwon Error ';
	                }
            }
        }
        else {
            $errormsg = '<i class="fas fa-exclamation-circle"></i> Money for security is 2000 FRW';
        }
	}
}

// Updating data


if (isset($_POST['update'])) {

    $amount = $_POST['amount'];
    $id = $_POST['id'];
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];


    $errormsgs = '';


	if (empty($amount)) {
		$errormsgs = '<i class="fas fa-exclamation-circle"></i> Money paid field required';
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
        if ($amount <= 2000) {
            $loan_total = $total_money - $amount;
            $update = mysqli_query($connect,"UPDATE kwishyura SET amount = '$amount',unpaid = '$loan_total',K_day = '$day',K_month = '$month',K_year = '$year' WHERE k_id = '$id'");
            if ($update == true) {
				// automaticaly update
			}
			else {
				$errormsgs = '<i class="fas fa-exclamation-circle"></i> Unknown Error';
			}
        }
            
    }
}







$m_id = $_SESSION['m_id'];
$v_id = $_SESSION['v_id'];

$start = 0;

$rows_per_page = 4;

$records = mysqli_query($connect,"SELECT *FROM kwishyura JOIN citizen ON (kwishyura.c_id=citizen.c_id) JOIN isibo ON (citizen.i_id=isibo.i_id) JOIN village ON (kwishyura.v_id=village.v_id)  JOIN mudugudu ON (mudugudu.v_id=village.v_id) WHERE m_id = '$m_id'");

$nbr_rows = mysqli_num_rows($records);

$pages = ceil($nbr_rows / $rows_per_page);

if (isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;

    $start = $page * $rows_per_page;
}


$retreive = mysqli_query($connect,"SELECT *FROM kwishyura JOIN citizen ON (kwishyura.c_id=citizen.c_id) JOIN isibo ON (citizen.i_id=isibo.i_id) JOIN village ON (kwishyura.v_id=village.v_id)  JOIN mudugudu ON (mudugudu.v_id=village.v_id) WHERE m_id = '$m_id' LIMIT $start,$rows_per_page");


?>
<title>VMS - Manage Leadres</title>
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
							    <h2 class="ml-lg-2">Manage Security Payment (kwishyura Irondo)</h2>
							 </div>
							 <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
							   <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
								<i class="fas fa-add"></i>
							   <span>Add New Payment</span>
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
							 <th>village</th>
                             <th>Amount Paid</th>
                             <th>Unpaid Amount</th>
                             <th>Payment Date</th>
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
							 <th><?php echo $get['amount'] ?> FRW</th>
                             <?php
                                if ($get['unpaid'] == 0) {
                                    ?>
                                    <th><?php echo $get['unpaid'] ?> FRW</th>
                                    <?php
                                }
                                else {
                                    ?>
                                    <th class="text-danger">-<?php echo $get['unpaid'] ?> FRW</th>
                                    <?php
                                }
                             ?>
                             <th><?php echo $get['k_day'] ."-".$get['k_month']."-".$get['k_year'] ?></th>
							 <th>
                                <button id="<?php echo $get['k_id']; ?>" type="button" data-toggle="modal" data-target="#editEmployeeModal" class="edit">	
							    <i class="fas fa-edit" data-toggle="tooltip" title="Edit"></i>
							   </button>
							   <button data-id="<?php echo $get['k_id']; ?>" type="button" data-toggle="modal" data-target="#deleteEmployeeModal" class="delete">
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
      <form action="#" method="post" autocomplete="off">
      <div class="modal-body">
        <div class="form-group">
		    <label>Full name</label>
			<select class="js-example-basic-single" name="fname" style="width: 100%;">
                  <option></option>
				  <?php 
				  $select = mysqli_query($connect,"SELECT *FROM citizen JOIN isibo ON (citizen.i_id=isibo.i_id) WHERE v_id = '$v_id'");
				  while ($fetch = mysqli_fetch_assoc($select)) {
				  	echo "<option value='".$fetch['c_id']."'>".$fetch['fname']."</option>";
				  }
				  ?>
				  
				</select>
		</div>
		<div class="form-group">
		    <label>Amount Paid(Ayo yishyuye)</label>
			<input type="text" name="amount" class="form-control" required>
		</div>
        <div class="form-group">
				<label>Igihe y'ishyuriye (Italiki)</label>
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
				<label>Igihe y'ishyuriye (Ukwezi)</label>
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
				<label>Igihe y'ishyuriye (Umwaka)</label>
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
			<input type="text" class="form-control" id="fname" readonly name="fname" autocomplete="off">
			<div id="result" class="result"></div>
		</div>
		<div class="form-group">
		    <label>Amount Paid(Ayo yishyuye)</label>
			<input type="text" name="amount" id="amount" class="form-control" required>
		</div>
        <div class="form-group">
		    <label>Unpaid(Ayo atarishyura)</label>
			<input type="text" name="unpaid" id="unpaid" class="form-control" readonly>
		</div>
        <div class="form-group">
				<label>Igihe y'ishyuriye (Italiki)</label>
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
				<label>Igihe y'ishyuriye (Ukwezi)</label>
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
				<label>Igihe y'ishyuriye (Umwaka)</label>
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
        <h5 class="modal-title">Delete Activity (kwishyura)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6>Are you sure you want to delete this record ?</h6>
		<h6 class="text-danger"><small>This action can not be undone</small></h6>
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
    p{
		margin: 0;
		font-weight: 600;
        opacity: .9;
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
</style>


<script>
	$('.delete').on('click' , function (e) {
		let id = $(this).attr('data-id');
		$('.confirm-delete').attr('data-id' ,id);
	});
	$(".confirm-delete").on('click', function (e) {
		let id = $(this).attr('data-id');
		console.log(id);
		location.href = "deletekwi.php?id= "+id;
	});


    $(document).ready(function() {

        // fetching data from database inside update form modal using javaScript

        $(document).on('click', '.edit', function(){  
        var id = $(this).attr("id");  
        $.ajax({  
                url:"ret.php",  
                method:"POST",  
                data:{fetch: 1,id:id},  
                dataType:"json",  
                success:function(data){  
                    $('#editEmployeeModal #fname').val(data.fname); 
                    $('#editEmployeeModal #amount').val(data.amount);
                    $('#editEmployeeModal #unpaid').val(data.unpaid);
                    $('#editEmployeeModal #day').val(data.k_day); 
                    $('#editEmployeeModal #month').val(data.k_month); 
                    $('#editEmployeeModal #year').val(data.k_year);  
                    $('#editEmployeeModal #id').val(data.k_id);  
                }  
            });  
        });


        $(".js-example-basic-single").select2({
		    placeholder: "Select citizen names",
		    dropdownParent: "#addEmployeeModal"
		});


        // live search from database using ajax

        $('#fname').keyup(function () {
            let query = $(this).val();
            if (query != "") {
                $.ajax({
                    url: 'live_search.php',
                    method: 'POST',
                    cashe: false,
                    data: {query: query},
                    success: function (data) {
                        $('#results').html(data);
                    }
                });
            }
            else{
                $('#results').empty();
            }
        });

        // set search input value on click

        $(document).on("click","p", function () {
            $('#fname').val($(this).text());
            $("#results").empty();
        });

	});
</script>