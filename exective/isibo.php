<?php
include 'header.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cell = $_POST['cell'];
    $v_id = $_POST['village'];
    $sub = $_POST['sub'];

    $errormsg = '';

    if (!is_numeric($cell)) {
        $errormsg = '<i class="fas fa-exclamation-circle"></i> Please select a cell name';
    }
    elseif (empty($sub)) {
        $errormsg = '<i class="fas fa-exclamation-circle"></i> Sub Village(Isibo) name required';
    }
    elseif (!is_numeric($v_id)) {
        $errormsg = '<i class="fas fa-exclamation-circle"></i> Village name required';
    }
    else {
        $cell_id = $_SESSION['cell_id'];
        if ($cell == $cell_id) {
            $select = mysqli_query($connect,"SELECT *FROM isibo WHERE v_id = '$v_id' AND i_name = '$sub'");
            if (mysqli_num_rows($select) == 0) {
                $insert = mysqli_query($connect,"INSERT INTO isibo VALUES ('','$v_id','$sub')");
                if ($insert == true) {
                    true;
                }
                else {
                    $errormsg = '<i class="fas fa-exclamation-circle"></i> Unknown Error';
                }
            }
            else {
                $errormsg = '<i class="fas fa-exclamation-circle"></i> This sub village(isibo) already exist.';
            }
        }
        else {
            $errormsg = '<i class="fas fa-exclamation-circle"></i> Please select the cell you lead.';
        }
    }
}
$user_id = $_SESSION['user_id'];
$cell_id = $_SESSION['cell_id'];

$start = 0;

$rows_per_page = 4;

$records = mysqli_query($connect,"SELECT *FROM isibo JOIN  village ON(isibo.v_id=village.v_id) JOIN cell_table ON (village.cell_id=cell_table.cell_id) JOIN exective ON (exective.cell_id=cell_table.cell_id) JOIN sector ON (cell_table.s_id=sector.s_id) JOIN district ON (sector.d_id=district.d_id) JOIN province ON (district.p_id=province.p_id) WHERE e_id = '$user_id'");

$nbr_rows = mysqli_num_rows($records);

$pages = ceil($nbr_rows / $rows_per_page);

if (isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;

    $start = $page * $rows_per_page;
}



$retreive = mysqli_query($connect,"SELECT *FROM isibo JOIN  village ON(isibo.v_id=village.v_id) JOIN cell_table ON (village.cell_id=cell_table.cell_id) JOIN exective ON (exective.cell_id=cell_table.cell_id) JOIN sector ON (cell_table.s_id=sector.s_id) JOIN district ON (sector.d_id=district.d_id) JOIN province ON (district.p_id=province.p_id) WHERE e_id = '$user_id' LIMIT $start,$rows_per_page");

?>
<title>VMS - Manage Sub Village(Isibo)</title>
<!------main-content-start-----------> 
<body onload="myFunction()"  style="margin:0;">
<div id="loader"></div>
<div style="display:none;" id="myDiv" class="animate-bottom">
<div class="main-content">
			     <div class="row">
				    <div class="col-md-12">
					   <div class="table-wrapper">
					     
					   <div class="table-title">
					     <div class="row">
						     <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
							    <h2 class="ml-lg-2">Manage the sub villages (Amasibo)</h2>
							 </div>
							 <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
							   <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
								<i class="fas fa-add icon"></i>
							   <span>Add New sub village</span>
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
							 <th>Provence</th>
							 <th>District</th>
							 <th>Sector</th>
                             <th>Cell</th>
							 <th>Village</th>
                             <th>Sub Village(Isibo)</th>
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
							 <th><?php echo $get['province'] ?></th>
							 <th><?php echo $get['district'] ?></th>
							 <th><?php echo $get['sector'] ?></th>
							 <th><?php echo $get['cell'] ?></th>
							 <th><?php echo $get['village'] ?></th>
                <th><?php echo $get['i_name'] ?></th>
							 <th>
							    <a href="#editEmployeeModal" class="edit" data-toggle="modal">
							   <i class="fas fa-edit" data-toggle="tooltip" title="Edit"></i>
							   </a>
							   <button data-id="<?php echo $get['i_id']; ?>" type="button" data-toggle="modal" data-target="#deleteEmployeeModal" class="delete">
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
        <h5 class="modal-title">Add a sub village</h5>
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
		    <label>Cell (Akagari)</label>
			<select name="cell" class="form-control" id="">
				<option value="1">-- Choose Cell(Akagari) --</option>
				<?php
				 $sql1 = mysqli_query($connect,"SELECT DISTINCT cell_id,cell FROM cell_table");
				 while ($ret = mysqli_fetch_assoc($sql1)) {
				 	echo "<option value='".$ret['cell_id']."'>".$ret['cell']."</option>";
				 }
				?>
			</select>
		</div>
        <div class="form-group">
		    <label>Village (Umudugudu)</label>
			<select name="village" class="form-control" id="">
				<option value="1">-- Choose Village(Umudugudu) --</option>
				<?php
				 $sql1 = mysqli_query($connect,"SELECT DISTINCT v_id,village FROM village WHERE cell_id = '$cell_id'");
				 while ($ret = mysqli_fetch_assoc($sql1)) {
				 	echo "<option value='".$ret['v_id']."'>".$ret['village']."</option>";
				 }
				?>
			</select>
		</div>
		<div class="form-group">
		    <label>Sub village name (Isibo)</label>
            <input type="text" name="sub" class="form-control" required>
		</div>
      </div>
      <div class="modal-footer">
        <button type="reset" name="cancel" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Add</button>
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
        <h5 class="modal-title">Edit Employees</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="#" method="post">
      <div class="modal-body">
        <div class="form-group">
		    <label>Name</label>
			<input type="text" class="form-control" required>
		</div>
		<div class="form-group">
		    <label>Email</label>
			<input type="emil" class="form-control" required>
		</div>
		<div class="form-group">
		    <label>Address</label>
			<input class="form-control" required></input>
		</div>
		<div class="form-group">
		    <label>Contact</label>
			<input type="text" class="form-control" required>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success">update</button>
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
        <h5 class="modal-title">Delete sub village (isibo)</h5>
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
        <a data-id=""><button class="btn btn-danger confirm-delete">Delete</button></a>
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
                                <li class="page-item "><a href="?page-nr=<?php echo $_GET['page-nr'] - 1; ?>"  class="page-link">Previous</a></li>
                                <?php
                            }
                            else {
                                ?>
                                <li class="page-item "><a  class="page-link">Previous</a></li>
                                <?php
                            }
                            ?>
                            <?php
                                for ($counter = 1; $counter <= $pages; $counter++) { 
                                    ?>
                                    <li class="page-item"><a href="?page-nr=<?php echo $counter ?>"class="page-link"><?php echo $counter ?></a></li>
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
  .delete{
		background: transparent;
		border: none;
	}
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
</style>

<script>
	$('.delete').on('click' , function (e) {
		let id = $(this).attr('data-id');
		$('.confirm-delete').attr('data-id' ,id);
	});
	$(".confirm-delete").on('click', function (e) {
		let id = $(this).attr('data-id');
		console.log(id);
		location.href = "deleteisib.php?id= "+id;
	});
</script>