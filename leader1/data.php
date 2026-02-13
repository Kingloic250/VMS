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
						     <a href="home.php"><i class="fas fa-arrow-left" style="margin-top:10px;color:#eee;background:rgb(60, 60, 60);"></i></a>
						     <div class="col-sm-7 p-0 flex justify-content-lg-start justify-content-center">
							    <h2 class="ml-lg-3">Searching result for <?php echo $search ?> (<?php echo mysqli_num_rows($select) ?>)</h2>
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
							 <th class="text-body">Age range</th>
							 <th class="text-body">Nationality</th>
							 <!-- <th class="text-body">martial status</th> -->
							 <th class="text-body">number in house</th>
							 <th class="text-body">number of kids study</th>
							 <!-- <th class="text-body">work Type</th> -->
							 <th class="text-body">medical insurence</th>
							 <th class="text-body">land property</th>
							 <th class="text-body">registration date</th>
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
							 </tr>
                             
							 <?php
                             $x++;
							 }
							 ?>
							 
					   </tbody>
                       


</table>

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