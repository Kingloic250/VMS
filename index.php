<?php
include 'connection/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin = $_POST['admin'];

    $errors = "";

    if (!is_numeric($admin)) {
        $errors = "<i class='fas fa-exclamation-circle'></i> Please select who's using the system";
    }
    else {
        if ($admin == 1) {
            header('location:admin/');
        }
        elseif ($admin == 2) {
            header('location:exective/');
        }
        elseif ($admin == 3) {
            header('location:leader1/');
        }
        else {
            header('location:leader2/');
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VMS Login</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
   <link rel="stylesheet" href="css/bootstrap_min.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/vms.png" type="image/x-icon">


    <!---------  JS libraries ------>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="/vms/js/jquery-3.3.1.min.js"></script>
    
    
</head>
<body>

<!------------- Setting preloader ---------------->
<div id="spinner" style="background: #fff;" class="show position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
   <div class="spinner-border spinning" style="width: 3rem; height: 3rem;" role="status">
      <span class="visually-hidden">Loading...</span>
   </div>
</div>


<div class="img" >
    <img src="img/vms.png" alt="" class="rounded" style="width: 100px;height: 100px;margin-left: 20px;margin-top: 24px;">
</div>
            
                <div class="container-fluid">
                                <div class="row h-100 align-items-center justify-content-center">
                                    <div class="rounded p-4 p-sm-5 my-4 mx-3 col-sm-3 col-md-7" style="backdrop-filter: blur(10px);box-shadow:0 1px 7px 1px rgba(0,0,0,0.2);">
                                    
                <div class="alert alert-danger text-center" id="errormsg" style="display: none; font-family: 'poppins',sans-serif;">
                </div>
                                        <h5 class="text-light" style="margin-top:10px;margin-bottom:0px;font-family: 'poppins',sans-serif;font-size:20px;">WHO'S USING THIS SYSTEM ?</h5>
                                        <form method="post" id="form_admin">
                                            <div class="form-floating">
                                            <select name="admin" id="admin" class="form-select form-control" style="background:transparent;color:white;font-family:'poppins',sans-serif;margin-bottom:30px;margin-top:40px;border-radius:20px;" >
                                                <option></option>
                                                <option value="1">Administration</option>
                                                <option value="2">Exective</option>
                                                <option value="3">Leader 1(Mudugudu)</option>
                                                <option value="4">Leader 2(Mutwarasibo)</option>
                                            </select>
                                            <label for="sel1" class="form-label"style="font-family: 'poppins',sans-serif;color:white;">Choose who's using the system:</label>
                                            <div class="d-grid">
                                                <button type="submit" name="btn" style="font-family: 'poppins',sans-serif;border-radius:20px;" class="btn btn-light btn-block">Next</button>
                                            </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
</body>
</html>

<style>
    body{
        background: url("img/bg.jpg"),no-repeat;
        background-position: center;
        background-size: cover;
    }
    button {
        float: right;
    }
    option{
        background: #303030; 
    }
    #spinner {
        opacity: 0;
        visibility: hidden;
        transition: opacity .5s ease-out, visibility 0s linear .5s;
        z-index: 99999;
    }

    #spinner.show {
        transition: opacity .5s ease-out, visibility 0s linear 0s;
        visibility: visible;
        opacity: 1;
    }
</style>


<script>
  (function ($) {
      // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 3000);
    };
    spinner();
  })(jQuery);

  // $(document).ready(function () {
  //       $('#form_admin').submit(function(e){
  //           e.preventDefault();
  //          var select = $('#admin').val();
  //          $.ajax({
  //           url: "get.php",
  //           type: "POST",
  //           data: {fetch: 20,select:select},
  //           dataType: 'json',
  //           success: function (data) {
  //               console.log(data);
  //               var dataResult = JSON.parse(data);
  //               if(dataResult.status == 1){
  //                   window.location.href = '../admin/';
  //              }
  //              else if(dataResult.status == 2){
  //               window.location.href = '../exective/';
  //              }
  //              else if (dataResult.status == 3) {
  //               window.location.href = '../leader1/';
  //              }
  //              else if (dataResult.status == 4) {
  //               window.location.href = '../leader2/';
  //              }
  //              else{
  //               $('#errormsg').show();
  //               $('#errormsg').html("<i class='fas fa-exclamation-circle'></i> Please select who's using the system");
  //              }
  //           }
  //          });

  //       });
  //   });

</script>