<?php

include 'header.php';


?>

<title>VMS - Monthly Report</title>
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
                                                <h2 class="ml-lg-2">Choose Monthly Report From </h2>
                                            </div>
                                            <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="modal-body">
                                <div class="list-group">
                                <a href="village.php" class="list-group-item list-group-item-action">Activities In Village</a>
                                <a href="sub.php" class="list-group-item list-group-item-action">Citizens In Sub Village</a>
                            </div>
                                </div>
                            

                            </div>

<?php
include 'footer.php';
?>
</div>

</div>


</body>