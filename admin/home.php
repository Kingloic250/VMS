<?php
include 'header.php';

$d_id = $_SESSION['d_id'];

$select = mysqli_query($connect,"SELECT *FROM citizen JOIN isibo ON(citizen.i_id=isibo.i_id) JOIN village ON(isibo.v_id=village.v_id) JOIN cell_table ON (village.cell_id=cell_table.cell_id) JOIN sector ON (sector.s_id=cell_table.s_id) WHERE d_id = '$d_id'");
$select1 = mysqli_query($connect,"SELECT SUM(nbr_in_house) FROM citizen JOIN isibo ON(citizen.i_id=isibo.i_id) JOIN village ON(isibo.v_id=village.v_id) JOIN cell_table ON (village.cell_id=cell_table.cell_id) JOIN sector ON (sector.s_id=cell_table.s_id) WHERE d_id = '$d_id'");
$fetch = mysqli_fetch_assoc($select1);
$number = $fetch['SUM(nbr_in_house)'];
 ?>
 <title>VMS Dashboard</title>
		  <body onload="myFunction()" style="margin:0;">
  
  <div id="loader"></div>
<div style="display:none;" id="myDiv" class="animate-bottom">
		   <!------main-content-start-----------> 
		<div class="dash-content">
		   <div class="overview">
                <div class="boxes">
                    <div class="box box1">
                        <i class='fas fa-users'></i>
                        <span class="text">Abaturage bari mu karere</span>
                        <span class="number"><?php if ($number != 0) {echo $number;}else{echo 0;} ?></span>
                    </div>
                    <div class="box box2">
                        <i class='fas fa-house'></i>
                        <span class="text">Ingo ziri mu karere</span>
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


