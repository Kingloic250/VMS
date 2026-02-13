<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('location:home.php');
}
include '../connection/connection.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    

    $errors = '';

    if (empty($email)) {
        $errors = '<i class="fas fa-exclamation-circle"></i> Email required';
    }
    elseif (empty($password)) {
        $errors = '<i class="fas fa-exclamation-circle"></i> Password required';
    }
    else {
        $select = mysqli_query($connect,"SELECT *FROM exective WHERE email = '$email'");
        if (mysqli_num_rows($select) == 1) {
            $fetch = mysqli_fetch_assoc($select);
            $id = $fetch['cell_id']; 
            $_SESSION['cell_id'] = $id;
            if ($fetch['password'] == $password) {
                $_SESSION['email'] = $email;
                $_SESSION['user_id'] = $fetch['e_id'];
                $_SESSION['last_timestamp'] = time();
                header('location:home.php');
            }
            else {
                $errors = '<i class="fas fa-exclamation-circle"></i> Wrong password';
            }
        }
        else {
            $errors = '<i class="fas fa-exclamation-circle"></i> Invalid email';
        }
    }
}

if (isset($_POST['back'])) {
    header('location:../');
}

?>

<html>
<head>
    <title>Sign In VMS</title>
</head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="shortcut icon" href="../img/vms.png" type="image/x-icon">
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<link rel="stylesheet" href="css/bootstrap_min.css"> 
<script src="/vms/js/jquery-3.3.1.min.js"></script>
<body>

<!------------- Setting preloader ---------------->
<div id="spinner" style="background: #fff;" class="show position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
   <div class="spinner-border spinning" style="width: 3rem; height: 3rem;" role="status">
      <span class="visually-hidden">Loading...</span>
   </div>
</div>

<div class="img">
    <img src="../img/vms.png" alt="" style="width: 100px;height: 100px;margin-left: 20px;margin-top: 24px;">
</div>

                <div class="container-fluid">
                    <form method="post" autocomplete="off">
                        <div class="row align-items-center justify-content-center">
                            <div class="rounded p-4 p-sm-5 my-4 mx-3 col-sm-3 col-md-7" style="backdrop-filter: blur(10px);box-shadow:0 1px 7px 1px rgba(0,0,0,0.2);">
                            <?php if (isset($errors)): ?>
                <div class="alert alert-danger text-center alert-dismissible fade show" style="font-family: 'poppins',sans-serif;">
                    <?php
                        echo $errors; ?>
                </div>
            <?php endif ?>
                                <h2 style="font-family: 'poppins',sans-serif;" class="text-light">SIGN IN VMS AS EXECTIVE</h2>
                                <div class="form-floating mb-3 mt-3" style="margin-top:40px;">
                                    <input type="text" style="color:white;font-family: 'poppins',sans-serif;border-radius:20px;background: transparent;" name="email" class="form-control" placeholder="example@example.com">
                                    <label for="uname" style="color:white;font-family: 'poppins',sans-serif;">Email</label>
                                    
                                </div>
                                <div class="form-floating mb-3 mt-3">
                                    <input type="password" style="color:white;font-family: 'poppins',sans-serif;border-radius:20px;background: transparent;" name="password" class="form-control" placeholder="Please Enter your Password">
                                    <label for="pwrd" style="color:white;font-family: 'poppins',sans-serif;;">Password</label>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                                <div class="d-grid gap-3"style="margin-top:4=3=20px;">
                                    <button name="back" style="font-family: 'poppins',sans-serif;border-radius:20px;height:40px;" class="btn btn-secondary btn-block">Go back to the first page</button>
                                    <button type="submit" name="btn" style="font-family: 'poppins',sans-serif;border-radius:20px;height:40px;" class="btn btn-light btn-block">Sign In</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
</body>
</html>

<style>
    body{
        background: url("../img/bg.jpg"),no-repeat;
        background-position: center;
        background-size: cover;
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
        }, 5000);
    };
    spinner();
  })(jQuery);
</script>