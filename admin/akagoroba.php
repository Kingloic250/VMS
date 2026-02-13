<?php

include 'header.php';


?>



<title>VMS - Report For Akagoroba k'ababyeyi</title>
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
                                        <a href="annual_village.php"><i class="fas fa-arrow-left" style="margin-top:10px;color:#eee;background:rgb(60, 60, 60);"></i></a>
                                            <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                                                <h2 class="ml-lg-2">Report For Akagoroba k'ababyeyi</h2>
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
                                <form action="generate.php" method="post">
                            <div class="form-group">
                                
                                <label>Month</label>
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
                                    <label>Year</label>
                                    <select name="year" class="form-control" id="year">
                                        <option>-- Choose year --</option>
                                        <?php
                                        $x = 2018;
                                        $nyear = date('Y');
                                        while ($x <= $nyear) {
                                            echo "<option>".$x."</option>";
                                            $x++;
                                        }
                                        ?>
                                    </select>
                                </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-success">Generate</button>
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



