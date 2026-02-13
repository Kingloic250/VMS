<?php
include 'header.php';

$mut_id = $_SESSION['mut_id'];

$select = mysqli_query($connect,"SELECT *FROM citizen JOIN isibo ON(citizen.i_id=isibo.i_id) JOIN mutwarasibo ON(mutwarasibo.i_id=isibo.i_id) WHERE mut_id = '$mut_id'");
$select1 = mysqli_query($connect,"SELECT SUM(nbr_in_house) FROM citizen JOIN isibo ON(citizen.i_id=isibo.i_id) JOIN mutwarasibo ON(mutwarasibo.i_id=isibo.i_id) WHERE mut_id = '$mut_id'");
$fetch = mysqli_fetch_assoc($select1);
$number = $fetch['SUM(nbr_in_house)'];
$get = mysqli_fetch_assoc($select);
 ?>
 <title>VMS Dashboard</title>
		  <body  onload="myFunction()" style="margin:0;">
  
  <div id="loader"></div>
<div style="display:none;" id="myDiv" class="animate-bottom">
		   <!------main-content-start-----------> 
		<div class="dash-content">
		   <div class="overview">
                <div class="boxes">
                    <div class="box box1">
                        <i class='fas fa-users'></i>
                        <span class="text">Abaturage bari mw'isibo</span>
                        <span class="number"><?php if ($number != 0) {echo $number;}else{echo 0;} ?></span>
                    </div>
                    <div class="box box2">
                        <i class='fas fa-home'></i>
                        <span class="text">Ingo ziri mw'isibo</span>
                        <span class="number"><?php echo mysqli_num_rows($select) ?></span>
                    </div>
                    <!-- <div class="box box3">
                        <i class='fas fa-child'></i>
                        <span class="text">Abana bari mw'ishuri</span>
                        <span class="number"><?php //echo $number ?></span>
                    </div> -->
                </div>
            </div>
		</div>
			<?php
			include 'footer.php';
			?>
		 
		 
		 
		 
	  </div>
   
</div>



<!-------complete html----------->





  
    
  
  



  </body>
  
  </html>


