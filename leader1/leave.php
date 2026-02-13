<?php
include 'header.php';

$v_id = $_SESSION['v_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $v_id = $_POST['v_id'];
    $i_id = $_POST['i_id'];

    $errormsg = '';

    if (!is_numeric($v_id)) {
        $errormsg = '<i class="fas fa-exclamation-circle"></i> Please select village';
    }
    elseif (!is_numeric($i_id)) {
		$errormsg = '<i class="fas fa-exclamation-circle"></i> Sub Village(Isibo) required';
	}
    else {
        $_SESSION['i_id'] = $i_id;
        echo "<script>location.href='leaving_citizen.php';</script>";
    }
}

?>
<title>VMS - Choose Sub Village (Isibo)</title>
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
                                                <h2 class="ml-lg-2">Choose the Sub village (Isibo)</h2>
                                            </div>
                                            <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <?php
                                if (isset($errormsg)) {
                                    ?>
                                    <div class="alert alert-danger text-center">
                                        <?php echo $errormsg; ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            <div class="form-group">
                                <form method="post">
		</div>
		<div class="form-group">
		    <label>village name</label>
            <select name="v_id" class="form-control" id="selectId">
                <option>-- Please choose cell before choose village --</option>
                <?php
				 $sql = mysqli_query($connect,"SELECT * FROM village WHERE v_id = '$v_id'");
				 while ($get = mysqli_fetch_assoc($sql)) {
				 	echo "<option value='".$get['v_id']."'>".$get['village']."</option>";
				 }
				?>
            </select>
		</div>
        <div class="form-group">
		    <label>Isibo</label>
            <select name="i_id" class="form-control" id="show">
                <option selected="selected">-- Please choose Village before choose Isibo --</option>
            </select>
		</div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-success">Continue</button>
        </div>
                                </form>
        
                            </div>
                        </div>  
                        
                        <?php
include 'footer.php';


?>
                    </div>
                </div>
            </div>


            <script>
                $(document).ready(function () {
		$('#selectId').change(function () {
			let stdid = $('#selectId').val();

			$.ajax({
				type: 'POST',
				url: 'fetching.php',
				data: {id:stdid},
				success: function (data) {
					$('#show').html(data);
				}
			});
		});
	});
            </script>

