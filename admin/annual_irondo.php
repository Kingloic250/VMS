<?php

include 'header.php';


?>

<title>VMS - Report For Abashinzwe Irondo</title>
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
                                                <h2 class="ml-lg-2">Report For Abashinzwe Irondo</h2>
                                            </div>
                                            <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <form action="annual_save.php" method="post">
                                <div class="form-group">
                                    <label>Year</label>
                                    <select name="year" class="form-control" id="year">
                                        <option>-- Choose year --</option>
                                        <?php
                                        $x = 2017;
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


