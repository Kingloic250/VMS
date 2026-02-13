<?php
session_start();
include '../connection/connection.php';
include 'function.php';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $provence = $_POST['provence'];
    $district = $_POST['district'];
    $password = $_POST['password1'];
    $confirm = $_POST['password2'];
    if (!empty($fname) && !empty($email) && !empty($phone) && !empty($provence) && !empty($district) && !empty($password) && !empty($confirm)){

        $user_id = random_num(20);

        if (is_numeric($fname)){
            $errors[] = '<h4><i class="fas fa-exclamation-circle"></i> Fullname can not be numeric. </h4>';
        }
        if (strlen($password) <= 3){
            $errors[] = '<h4><i class="fas fa-exclamation-circle"></i> Password can not be less than 4 characters. </h4>';
        }
        elseif (is_numeric($email)){
            $errors[] = '<h4><i class="fas fa-exclamation-circle"></i> Email can not be numeric. </h4>';
        }
        elseif (!is_numeric($provence)){
            $errors[] = '<h4><i class="fas fa-exclamation-circle"></i> Provence  required. </h4>';
        }
        elseif (!is_numeric($district)){
            $errors[] = '<h4><i class="fas fa-exclamation-circle"></i> District required. </h4>';
        }
        elseif (strlen($phone) < 10){
            $errors[] = '<h4><i class="fas fa-exclamation-circle"></i> Your phone number is less than 10 numbers. </h4>';
        }
        else{
            if ($password == $confirm){
                $select = "SELECT *FROM user_table WHERE email = '$email'";
                $sql = mysqli_query($connect,$select);
                if (mysqli_num_rows($sql) == 1){
                    $errors[] = '<h4><i class="fas fa-exclamation-circle"></i> This email already exist. </h4>';
                }
                else{
                        $insert = "INSERT INTO user_table VALUES ('$user_id','$district','$fname','$email','$phone','$password',now())";
                        $query = mysqli_query($connect,$insert);
                        if ($query == true && $reg == true) {
                            echo '<script>alert("Signing up successfully done. ✔");window.location=\'/VMS/admin/\';</script>';
                        }
                        else {
                            $errors[] = '<h4> <i class="fas fa-exclamation-circle"></i> Unkown Error</h4>';
                        }
                }
            }
            else{
                $errors[] = '<h4> <i class="fas fa-exclamation-circle"></i> Passwords are not matching. </h4>';
            }
        }
    }
    else{
        $errors[] = '<h4> <i class="fas fa-exclamation-circle"></i> This fields can not be empty. </h4>';
    }
}
?>


<html>
<head>
    <title>Create Account in VMS</title>
</head>
<link rel="stylesheet" href="/VMS/css/index.css">
<link rel="shortcut icon" href="/VMS/img/vms.png" type="image/x-icon">
<link rel="stylesheet" href="/VMS/css/all.min.css">
<link rel="stylesheet" href="/VMS/css/fontawesome.min.css">
<body>
<div class="img">
    <img src="/VMS/img/vms.png" alt="">
</div>
    <div class="box">
        <?php if (!empty($errors)): ?>
            <div class="danger">
                <?php foreach ($errors as $error):
                    echo $error;
                endforeach ?>
            </div>
        <?php endif ?>
    </div>
    <div class="row">
        <div class="col-75">
            <div class="container">
                <form method="post">
                    <div class="row">
                        <div class="col-50">
                            <h2>CREATE ADMINISTRATION ACCOUNT IN VMS</h2>
                            <label for="fname">Full Name</label>
                            <input type="text" name="fname" placeholder="Full Name">
                            <label for="email"> Email</label>
                            <input type="email" name="email" placeholder="Email">
                            <label for="phone">Phone Number</label>
                            <input type="text" name="phone" placeholder="Phone Number">
                            <label for="pin">Province</label>
                            <select name="provence" id="">
                                <?php
                                $select = mysqli_query($connect,"SELECT *FROM province");
                                while ($fetch = mysqli_fetch_assoc($select)) {
                                    echo "<option value='".$fetch['p_id']."'>".$fetch['province']."</option>";
                                }
                                ?>
                            </select>
                            <label>District</label>
                                <select name="district" id="">
                                <option value="1">-- Choose District --</option>
                                <?php
                                $sql1 = mysqli_query($connect,"SELECT DISTINCT d_id,district FROM district");
                                while ($ret = mysqli_fetch_assoc($sql1)) {
                                    echo "<option value='".$ret['d_id']."'>".$ret['district']."</option>";
                                }
                                ?>
                                </select>
                            <label for="pwrd"> Password</label>
                            <input type="password" name="password1" placeholder="Please Enter your Password">
                            <label for="pwrd1"> Confirm Password</label>
                            <input type="password" name="password2" placeholder="Please Confirm Password">
                            <button type="submit" name="btn" class="button">Sign Up</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>