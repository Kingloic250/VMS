<?php

include 'header.php';


?>

<title>VMS - Monthly Report In Village</title>
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
                                        <a href="monthly.php"><i class="fas fa-arrow-left" style="margin-top:10px;color:#eee;background:rgb(60, 60, 60);"></i></a>
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
                                <a href="umuganda.php" class="list-group-item list-group-item-action">Umuganda</a>
                                <a href="akagoroba.php" class="list-group-item list-group-item-action">Akagoroba k'ababyeyi</a>
                                <a href="irondo.php" class="list-group-item list-group-item-action">Abashinzwe Irondo</a>
                                <a href="abishyuye.php" class="list-group-item list-group-item-action">Abishyuye Irondo</a>
                            </div>
                                </div>
                            
                            
</div>

<?php
include 'footer.php';
?>
</div>

</div>


</body>