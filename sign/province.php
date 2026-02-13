<?php

include '../connection/connection.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $procence = $_POST['provence'];

    if (!empty($procence)) {
        $select = mysqli_query($connect,"SELECT *FROM province WHERE province = '$procence'");
        if (mysqli_num_rows($select) == 0) {
            $select1 = mysqli_query($connect,"SELECT *FROM province");
            $count = mysqli_num_rows($select1);
            if ($count <= 4) {
                $insert = mysqli_query($connect,"INSERT INTO province VALUES ('','$procence')");
                if ($insert == true) {
                    echo "<script>alert('New provience registered successfully')</script>";
                }
                else {
                    $errors[] = '<h4>Unknown Error</h4>';
                }
            }
            else {
                $errors[] = '<h4>There is 5 province only</h4>';
            }
        }
        else {
            $errors[] = '<h4>This province exist</h4>';
        }
    }
    else {
        $errors[] = '<h4>Empty Fields</h4>';
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
                            <h2>INSERT PROVINCE</h2>
                            <label for="pin">Province</label>
                            <input type="text" name="provence" placeholder="Province">
                            <button type="submit" name="btn" class="button">Insert</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>