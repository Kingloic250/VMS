<title>Searching <?php echo $search ?></title>
<body onload="myFunction()" style="margin:0;">
<div id="loader"></div>
<div style="display:none;" id="myDiv" class="animate-bottom">
<div class="main-content">
			     <div class="row">
				    <div class="col-md-12">
					   <div class="table-wrapper">
					     
					   <div class="table-title">
					     <div class="row">
						     <a href="leave.php"><i class="fas fa-arrow-left" style="margin-top:10px;color:#eee;background:rgb(60, 60, 60);"></i></a>
						     <div class="col-sm-7 p-0 flex justify-content-lg-start justify-content-center">
							    <h2 class="ml-lg-3">Searching results for <?php echo $search ?> (<?php echo mysqli_num_rows($select2) ?>)</h2>
							 </div>
					     </div>
					   </div>
					   <table class="table table-striped table-hover">
					      <thead>
						     <tr>
							 <th><span class="custom-checkbox">
							 <input type="checkbox" id="selectAll">
							 <label for="selectAll"></label></th>
							 <th class="text-body">No</th>
							 <th class="text-body">Full name</th>
                             <th class="text-body">Isibo</th>
							 <!-- <th class="text-body">Contacts</th> -->
                             <th class="text-body">Gender</th>
							 <th class="text-body">registration date</th>
							 </tr>
						  </thead>
						
						  <tbody>
							<?php
							$x=1;
							while ($get = mysqli_fetch_assoc($select2)) {
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
							 </tr>
                             
							 <?php
                             $x++;
							 }
							 ?>
							 
					   </tbody>
                    </table>