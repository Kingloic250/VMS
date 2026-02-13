<?php

include 'header.php';

$user_id = $_SESSION['admin'];

include '../connection/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $year = $_POST['year'];

    $errormsg = '';

    if (!is_numeric($year)) {
        $errormsg = '<i class="fas fa-exclamation-circle"></i> Year field required';
    }
    else {
        $select = mysqli_query($connect,"SELECT *FROM kwishyura JOIN village ON (kwishyura.v_id=village.v_id)
                 JOIN cell_table ON (cell_table.cell_id=village.cell_id) JOIN sector ON (cell_table.s_id=sector.s_id)
                  JOIN district ON (district.d_id=sector.d_id) JOIN user_table ON (district.d_id=user_table.d_id)
                   WHERE k_year = '$year' AND user_id = '$user_id'");

        if (mysqli_num_rows($select) > 0) {
            ?>
            <title>VMS - Abishyuye Irondo</title>
<div class="main-content">
			     <div class="row">
				    <div class="col-md-12">
					   <div class="table-wrapper">
					     
					   <div class="table-title">
					     <div class="row">
                         <a href="annual_abishyuye.php"><i class="fas fa-arrow-left" style="margin-top:10px;color:#eee;background:rgb(60, 60, 60);"></i></a>
						     <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
							    <h2 class="ml-lg-2">Report from (<?php echo $year ?>)</h2>
							 </div>
							 <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
							 </div>
					     </div>
					   </div>
                       
            <table class="table table-hover">
					      <thead>
						     <tr>
							 <th><span class="custom-checkbox">
							 <input type="checkbox" id="selectAll">
							 <label for="selectAll"></label></th>
                             <th class="text-body">District</th>
                             <th class="text-body">Sector</th>
                             <th class="text-body">Cell</th>
							 <th class="text-body">Village</th>
							 <th class="text-body">Full Name</th>
                             <th class="text-body">Amount Paid</th>
                             <th class="text-body">Unity Amount</th>
                             <th class="text-body">Unpaid Money</th>
							 <th class="text-body">Date happened</th>
							 </tr>
						  </thead>
						
						  <tbody>
							<?php
							$x=1;
							while ($get = mysqli_fetch_assoc($select)) {
								
							?>
						      <tr>
							 <th>
							 <input type="checkbox" hidden id="checkbox1" name="option[]" value="1">
							 <label for="checkbox1"></label></th>
                             <th><?php echo $get['district'] ?></th>
                             <th><?php echo $get['sector'] ?></th>
                             <th><?php echo $get['cell'] ?></th>
							 <th><?php echo $get['village'] ?></th>
							 <th><?php echo $get['fname'] ?></th>
							 <th><?php echo $get['amount'] ?> FRW</th>
                             <th><?php echo $get['unity_amount'] ?> FRW</th>
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
							 <th><?php echo $get['k_month']."-".$get['k_year'] ?></th>
							
							 </tr>
							 <?php
							 $x++;
							 }
							 ?>
                             </tbody>
                            </table>
                            </div></div>
                            
            <?php
        }
        else {
            $errormsg = '<i class="fas fa-exclamation-circle"></i> No data availble in '.$year.'';
        }
    }
}
?>
<div class="modal-body">
<?php
                                if (isset($errormsg)) {
                                    ?>
                                    <div class="alert alert-danger text-center" style="margin:50px;">
                                        <?php echo $errormsg; ?>
                                    </div>
                                    <a href="annual_abishyuye.php"><button class="btn btn-secondary" style="margin-left:450px;">Back</button></a>
                                    <?php
                                }
                                ?>
</div>

<?php
include 'footer.php';